//d3.json("data.json", doAllThings);

if (!Array.prototype.find) {
    Array.prototype.find = function (predicate) {
        if (this === null) {
            throw new TypeError('Array.prototype.find called on null or undefined');
        }
        if (typeof predicate !== 'function') {
            throw new TypeError('predicate must be a function');
        }
        var list = Object(this);
        var length = list.length >>> 0;
        var thisArg = arguments[1];
        var value;

        for (var i = 0; i < length; i++) {
            value = list[i];
            if (predicate.call(thisArg, value, i, list)) {
                return value;
            }
        }
        return undefined;
    };
}

var q = d3_queue.queue();
q.defer(d3.json, "../ane/ane-dashboard-top-graph-data");
//q.defer(d3.csv, "data/data_circles.csv");
q.defer(d3.json, "../ane/ane-dashboard-top-bar-graph-data");
//q.defer(d3.json, "/js/ane/data/data_strips.csv");
q.await(doAllThings);


function doAllThings(error, data, data_strips) {

    if (error) throw error;

    data_strips.forEach(function (d) {
        d.Minutes = +d.Minutes;
    })

    data_strips = data_strips.filter(function (d) {
        return d.Location_Group !== "Other"
    });

    //var tempData = data_strips.filter(function (d) {return d.Location_Group !== "Other"});

    //console.log(data.patient_safety.status_overall)

    // patient safety // Number of patients waiting longer than > 15 mins for triage assessment
    // EDD Capacity // Total number of patients
    // Edd Flow // Number of patients waiting with a Decision to Admin(DTA) > 30 mins


    //console.log(data_strips.filter(function (n) {return n.Location_Group === "Majors"}));

    var patientSafetyArr = [{name: "Majors", value: data.patient_safety.majors},
        {name: "Minors", value: data.patient_safety.minors},
        {name: "Paeds Eds", value: data.patient_safety.paeds_ED},
        {name: "ED Obs", value: data.patient_safety.ED_Obs}];

    var eddCapacityArr = [{name: "Majors", value: data.EDD_capacity.majors},
        {name: "Minors", value: data.EDD_capacity.minors},
        {name: "Paeds Eds", value: data.EDD_capacity.paeds_ED},
        {name: "ED Obs", value: data.EDD_capacity.ED_Obs}];

    var eddFlowArr = [{name: "Majors", value: data.EDD_flow.majors},
        {name: "Minors", value: data.EDD_flow.minors},
        {name: "Paeds Eds", value: data.EDD_flow.paeds_ED},
        {name: "ED Obs", value: data.EDD_flow.ED_Obs}];


    var colorTopCircle = ["#E1D091", "#FEBF00", "#B59814", "#848413"];
    var colorLeftCircle = ["#BF7CAE", "#8B668A", "#954594", "#BF0090"];
    var colorRightCircle = ["#AFD9B4", "#00B68E", "#00A776", "#007457"];

    var rLR = 77;
    var rTop = 105;
    var textOffset = 24;


    //console.log(patientSafetyArr, eddCapacityArr, eddFlowArr)                        

    var width = 1200,
        height = 800;
    var svg = d3.select(".svg").append("svg").attr({width: width, height: height})
        .append("g")
        .attr("transform", "translate(0, -190)");

    // filters go in defs element
    var defs = svg.append("defs");

    // create filter with id #drop-shadow
    // height=130% so that the shadow is not clipped
    var filter = defs.append("filter")
        .attr("id", "dropshadow")
        .attr("height", "130%");

    // SourceAlpha refers to opacity of graphic that this filter will be applied to
    // convolve that with a Gaussian with standard deviation 3 and store result
    // in blur
    filter.append("feGaussianBlur")
        .attr("in", "SourceAlpha")
        .attr("stdDeviation", 5);

    // translate output of Gaussian blur to the right and downwards with 2px
    // store result in offsetBlur
    filter.append("feOffset")
        .attr("dx", -4)
        .attr("dy", 4)
        .attr("result", "offsetBlur");

    var feComponentTransfer = filter.append("feComponentTransfer");

    feComponentTransfer.append("feFuncA")
        .attr("type", "linear")
        .attr("slope", "0.2")

    // overlay original SourceGraphic over translated blurred opacity by using
    // feMerge filter. Order of specifying inputs is important!
    var feMerge = filter.append("feMerge");

    feMerge.append("feMergeNode")
    /*    .attr("in", "offsetBlur")*/
    feMerge.append("feMergeNode")
        .attr("in", "SourceGraphic");

    var tooltip = {
        element: null,
        init: function () {
            this.element = d3.select("body").append("div").attr("class", "tooltip_ane").style("opacity", 0)
        },
        show: function (t) {
            this.element.html(t).transition().duration(200).style("left", d3.event.pageX + 15 + "px").style("top", d3.event.pageY + (-10) + "px").style("opacity", .7)
        },
        move: function () {
            this.element.transition().duration(30).ease("linear").style("left", d3.event.pageX + 15 + "px").style("top", d3.event.pageY + (-10) + "px").style("opacity", .7)
        },
        hide: function () {
            this.element.transition().duration(500).style("opacity", 0)
        }
    };

    tooltip.init();


    //var circles_path = "m 544.53061,662.71082 c 0,-22.065 -17.88865,-39.95402 -39.95734,-39.95402 -8.2458,0 -15.90552,2.49549 -22.27142,6.77911 -6.62024,4.45355 -15.14619,5.07982 -22.34514,1.637 l -13.17044,-6.30655 c -7.82559,-3.74508 -12.82026,-11.66762 -12.82026,-20.34138 l 0,-0.007 c 0,-23.58699 -13.94452,-43.91953 -34.04114,-53.20113 -10.69338,-4.93569 -17.55322,-15.65413 -17.55322,-27.43196 l 0,-22.61423 c 0,-11.7771 6.85615,-22.48891 17.55322,-27.42828 20.09662,-9.2816 34.04114,-29.61413 34.04114,-53.20518 -10e-6,-32.35328 -26.22293,-58.57989 -58.57768,-58.57989 -32.35402,0 -58.5773,26.22661 -58.5773,58.57952 0,23.59105 13.94526,43.92358 34.04188,53.20518 10.69117,4.93569 17.55211,15.65487 17.55211,27.42828 l 0,22.61423 c 0,11.78077 -6.85689,22.49185 -17.55211,27.43196 -20.09662,9.2816 -34.04188,29.61414 -34.04188,53.20113 0,6.96304 -3.85161,13.35474 -10.00297,16.61031 l -17.26275,9.14042 c -7.06405,3.73513 -15.60401,3.34034 -22.29207,-1.031 -6.27374,-4.09932 -13.77238,-6.48091 -21.82577,-6.48091 -22.06758,0 -39.95807,17.88902 -39.95807,39.95402 0,22.06906 17.89049,39.9566 39.95807,39.9566 22.06758,0 39.95807,-17.88754 39.95807,-39.9566 l -0.007,-0.78477 c -0.16292,-8.28672 4.36435,-15.96118 11.69047,-19.83896 l 7.46694,-3.95077 c 9.00218,-4.76318 20.05753,-2.71002 26.76772,4.95302 10.73429,12.26366 26.5038,20.01147 44.08466,20.01147 17.09429,0 32.48007,-7.32023 43.18821,-19.00074 6.52439,-7.11418 16.94131,-9.14153 25.64788,-4.97329 l 7.92512,3.78968 c 7.61548,3.64887 12.46639,11.35356 12.46639,19.79436 0,22.06906 17.88865,39.9566 39.95733,39.9566 22.0687,0 39.95734,-17.88754 39.95734,-39.9566";
    var circles_path = "M 375.03125 416.3125 C 353.02063 416.3125 335.1875 434.14563 335.1875 456.15625 C 335.1875 467.45752 339.912 477.65342 347.46875 484.90625 C 348.96552 487.22705 351.75595 489.43635 356.5625 491.65625 C 367.25367 496.59194 368.40625 507.50784 368.40625 519.28125 L 368.40625 523.875 C 368.40625 535.65577 361.53897 546.37239 350.84375 551.3125 C 330.74713 560.5941 316.8125 580.94426 316.8125 604.53125 C 316.8125 611.49429 312.96386 617.86943 306.8125 621.125 L 289.53125 630.28125 C 282.4672 634.01638 273.93806 633.62134 267.25 629.25 C 260.97626 625.15068 253.49089 622.75 245.4375 622.75 C 223.36992 622.75 205.46875 640.65375 205.46875 662.71875 C 205.46875 684.78781 223.36992 702.65625 245.4375 702.65625 C 267.50508 702.65625 285.375 684.78781 285.375 662.71875 L 285.375 661.9375 C 285.21208 653.65078 289.73638 645.97153 297.0625 642.09375 L 304.53125 638.125 C 313.53343 633.36182 324.60231 635.43071 331.3125 643.09375 C 342.04679 655.35741 357.79414 663.09375 375.375 663.09375 C 392.46929 663.09375 407.85436 655.77426 418.5625 644.09375 C 425.08689 636.97957 435.51218 634.95676 444.21875 639.125 L 452.15625 642.90625 C 459.77173 646.55512 464.625 654.27795 464.625 662.71875 C 464.625 684.78781 482.49382 702.65625 504.5625 702.65625 C 526.6312 702.65625 544.53125 684.78781 544.53125 662.71875 C 544.53125 640.65375 526.63119 622.75 504.5625 622.75 C 496.3167 622.75 488.6784 625.24763 482.3125 629.53125 C 475.69226 633.9848 467.1677 634.63032 459.96875 631.1875 L 446.78125 624.875 C 438.95566 621.12992 433.96875 613.20501 433.96875 604.53125 C 433.96875 580.94426 420.03412 560.5941 399.9375 551.3125 C 389.24412 546.37681 382.375 535.65283 382.375 523.875 L 382.375 519.28125 C 382.375 507.50415 383.30293 496.37687 394 491.4375 C 394.45844 491.10319 394.79265 490.84601 395.21875 490.53125 C 406.99412 483.60573 414.90625 470.80512 414.90625 456.15625 C 414.90625 434.14563 397.04187 416.3125 375.03125 416.3125 z "

    /*    var projection = d3.geo.mercator()
     .scale((width + 1) / 2 / Math.PI)
     .translate([width / 2, 600])
     .precision(.1);

     var path = d3.geo.path()
     .projection(projection);

     var graticule = d3.geo.graticule();


     svg.append("path")
     .datum(graticule)
     .attr("class", "graticule")
     .attr("d", path);



     d3.json("world.json", function(error, world) {
     if (error) throw error;

     svg.insert("path", ".graticule")
     .datum(topojson.feature(world, world.objects.land))
     .attr("class", "land")
     .attr("d", path);

     svg.insert("path", ".graticule")
     .datum(topojson.mesh(world, world.objects.countries, function(a, b) { return a !== b; }))
     .attr("class", "boundary")
     .attr("d", path);
     });*/


    // title    
    /*var titleText = svg.append("text")
        .attr({
            "transform": "translate(270, 160)",
            "class": "titleText",
        }).style({
            "font-size": "30px",
            "font-weight": "bold",
            "fill": "#55585a"
        }).text("A&E Department Status");*/
    //console.log(data.patient_safety.updated_date.replace('-', ' ').replace('-', ' '));
    var refreshed_date=new Date(data.patient_safety.updated_date.replace('-', ' ').replace('-', ' '));
    d3.select('.class-page-title')
        .text('Emergency Department - '+refreshed_date.format("ddd mmm dS yyyy HH:MM"))
        .style('color', '#ffffff');


    // arcs
    // top arcs
    /*    var arcTop = d3.svg.arc()
     .innerRadius(70)
     .outerRadius(120)
     .startAngle(-1.5)
     .endAngle(1.5);

     var arc2Top = d3.svg.arc()
     .innerRadius(70)
     .outerRadius(70)
     .startAngle(-1.5)
     .endAngle(1.5);


     svg.append("path")
     .attr("class", "arcTop")
     .attr("d", arc2Top)
     .attr("transform", "translate(437,296)");*/
    //

    var arcTop = d3.svg.arc()
        .innerRadius(52)
        .outerRadius(90);

    var arc2Top = d3.svg.arc()
        .innerRadius(52)
        .outerRadius(52);

    var pieTop = d3.layout.pie()
        .value(function (d) {
            return 1;
        })
        .startAngle(-2)
        .endAngle(1);


    var arcsTopGroup = svg.selectAll("g.sliceTop")
        .data(pieTop(patientSafetyArr))
        .enter()
        .append("g")
        .attr("transform", "translate(355,362)")
        .attr("class", "slice");

    arcsTopGroup.append("path")
        .attr("class", "arcTop")
        .attr("fill", function (d, i) {
            //console.log(d)
            return colorTopCircle[i];
        })
        .attr("d", arcTop)
        .on("click", function (d) {
            d3.select("table")
                .classed("hidden", false)
        })

    arcsTopGroup.append("text")
        .attr("transform", function (d) {

            return "translate(" + arcTop.centroid(d) + ")";
        })
        .attr("class", "textArc")
        .attr("text-anchor", "middle")
        .attr("alignment-baseline", "middle")
        .text(function (d, i) {
            return d.data.value;
        });

    arcsTopGroup
        .append("text")
        .attr("class", "textArcDesc")
        .attr("transform", function (d) {
            return "translate(" + Math.cos(((d.startAngle + d.endAngle - Math.PI) / 2)) * (rLR + textOffset) +
                "," + Math.sin((d.startAngle + d.endAngle - Math.PI) / 2) * (rLR + textOffset) + ")";
        })
        .attr("dy", function (d) {
            if ((d.startAngle + d.endAngle) / 2 > Math.PI / 2 && (d.startAngle + d.endAngle) / 2 < Math.PI * 1.5) {
                return 17;
            } else {
                return 5;
            }
        })
        .attr("text-anchor", function (d) {
            if (d.startAngle >= 0) {
                return "beginning";
            } else {
                return "end";
            }
        })
        .text(function (d, i) {
            return d.data.name === "Majors" ? "Major/Resus" : d.data.name;
        });

    // left arcs

    var arcLeft = d3.svg.arc()
        .outerRadius(52)
        .innerRadius(90);

    var arc2Left = d3.svg.arc()
        .outerRadius(52)
        .innerRadius(52);

    var pieLeft = d3.layout.pie()
        .value(function (d) {
            return 1;
        })
        .startAngle(-3.7)
        .endAngle(-0.7);


    var arcsLeftGroup = svg.selectAll("g.sliceLeft")
        .data(pieLeft(eddFlowArr))
        .enter()
        .append("g")
        .attr("transform", "translate(316,676)")   // 316,676 //   +46,  +65
        .attr("class", "slice");

    arcsLeftGroup.append("path")
        .attr("class", "arcLeft")
        .attr("fill", function (d, i) {
            //console.log(d)
            return colorLeftCircle[i];
        })
        .attr("d", arcLeft)
        .on("click", function (d) {
            d3.select("table")
                .classed("hidden", false)
        })

    arcsLeftGroup.append("text")
        .attr("transform", function (d) {

            return "translate(" + arcLeft.centroid(d) + ")";
        })
        .attr("class", "textArc")
        .attr("text-anchor", "middle")
        .attr("alignment-baseline", "middle")
        .text(function (d, i) {
            return d.data.value;
        });

    arcsLeftGroup
        .append("text")
        .attr("transform", function (d) {

            return "translate(" + arcLeft.centroid(d) + ")";
        })
        .attr("class", "textArcDesc")
        .attr("transform", function (d) {
            return "translate(" + Math.cos(((d.startAngle + d.endAngle - Math.PI) / 2)) * (rLR + textOffset) +
                "," + Math.sin((d.startAngle + d.endAngle - Math.PI) / 2) * (rLR + textOffset) + ")";
        })
        .attr("dy", function (d) {
            if ((d.startAngle + d.endAngle) / 2 > Math.PI / 2 && (d.startAngle + d.endAngle) / 2 < Math.PI * 1.5) {
                return 17;
            } else {
                return 7;
            }
        })
        .attr("text-anchor", function (d) {

            return d.data.name === "Majors"? "middle" : "end";
        })
        .text(function (d, i) {
            return d.data.name === "Majors" ? "Major/Resus" : d.data.name;
        });


    // right arcs
    /*    var arcRight = d3.svg.arc()
     .innerRadius(52)
     .outerRadius(90)
     .startAngle(3.5)
     .endAngle(0.5);

     var arc2Right = d3.svg.arc()
     .innerRadius(52)
     .outerRadius(52)
     .startAngle(3.5)
     .endAngle(0.5);

     svg.append("path")
     .attr("class", "arcRight")
     .attr("d", arc2Right)
     .attr("transform", "translate(606,612)");  */

//

    var arcRight = d3.svg.arc()
        .outerRadius(52)
        .innerRadius(90);

    var arc2Right = d3.svg.arc()
        .outerRadius(52)
        .innerRadius(52);

    var pieRight = d3.layout.pie()
        .value(function (d) {
            return 1;
        })
        .startAngle(3.09)
        .endAngle(0.09);


    var arcsRightGroup = svg.selectAll("g.sliceRight")
        .data(pieRight(eddCapacityArr))
        .enter()
        .append("g")
        .attr("transform", "translate(622,534)")
        .attr("class", "slice");

    arcsRightGroup.append("path")
        .attr("class", "arcRight")
        .attr("fill", function (d, i) {
            //console.log(d)
            return colorRightCircle[i];
        })
        .attr("d", arcRight)
        .on("click", function (d) {
            var name = d.data.name.split(" ").join("_");
            if(name=='Paeds_Eds')
            {
                name='Paed_Eds';
            }
            d3.selectAll(".chart rect").style("opacity", 0.7);
            d3.selectAll(".chart rect" + "." + name).style("opacity", 1);


        })

    arcsRightGroup.append("text")
        .attr("transform", function (d) {
            return "translate(" + arcRight.centroid(d) + ")";
        })
        .attr("class", "textArc")
        .attr("text-anchor", "middle")
        .attr("alignment-baseline", "middle")
        .text(function (d, i) {
            return d.data.value;
        });

    arcsRightGroup
        .append("text")
        .attr("class", "textArcDesc")
        .attr("transform", function (d) {
            return "translate(" + Math.cos(((d.startAngle + d.endAngle - Math.PI) / 2)) * (rLR + textOffset) +
                "," + Math.sin((d.startAngle + d.endAngle - Math.PI) / 2) * (rLR + textOffset) + ")";
        })
        .attr("dy", function (d) {
            if ((d.startAngle + d.endAngle) / 2 > Math.PI / 2 && (d.startAngle + d.endAngle) / 2 < Math.PI * 1.5) {
                return 5;
            } else {
                return 5;
            }
        })
        .attr("text-anchor", function (d) {
            /*        if ( (d.startAngle+d.endAngle)/2 < Math.PI ){
             return "beginning";
             } else {
             return "end";
             }*/
            return "beginning";
        })
        .text(function (d, i) {
            return d.data.name === "Majors" ? "Major/Resus" : d.data.name;
        });


    // arcs    

    var centerGroup = svg.append("g");

    centerGroup
        .append("path").attr("d", circles_path)
        .classed("circles_path", true)
        .attr("stroke", "none")
        .attr("fill-opacity", 1)
        .attr("fill", "#e6e7e8")
        .attr("transform", "translate(-201,-252) scale(1.3) rotate(-25,437,344)")
        .attr("filter", "url(#dropshadow)");

    var topCircleGroup = centerGroup.append("g")
        .attr("transform", "translate(355,362)");

    var topCircle = topCircleGroup.append("circle").attr({
        /*        "cx": 438,
         "cy": 297,*/
        "r": 38,
        "fill": "#848413"
    }).attr("class", "topCircle").attr("filter", "url(#dropshadow)");

    /*    var topCircleText = topCircleGroup.append("text").text("Patient safety")
     //.attr("transform", "translate(438,535)")
     .attr({
     "alignment-baseline": "middle",
     "text-anchor": "middle"
     });
     */

    var topCircleText = topCircleGroup.append("text")
        .attr({
            "transform": "translate(0, -5)",
            "class": "textInCircle",
        });

    topCircleText
        .append('tspan')
        .text("Patient");

    topCircleText
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("Safety");

    var topCircleDescription = topCircleGroup.append("text")
        .attr({
            "transform": "translate(-210, 70)",
            "class": "textDescription",
        });

    topCircleDescription
        .append('tspan')
        .text("Number of patients");

    topCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("waiting longer than");

    topCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 18
        })
        .text("> 15 mins for triage");

    topCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 19
        })
        .text("assessment");


    var leftCircleGroup = centerGroup.append("g")
        .attr("transform", "translate(316,676)");

    var leftCircle = leftCircleGroup.append("circle").attr({
        /*        "cx": 269,
         "cy": 611,*/
        "r": 38,
        "fill": "#BF0090"
    }).attr("class", "leftCircle").attr("filter", "url(#dropshadow)");

    /*    var leftCircleText = leftCircleGroup.append("text").text("ED flow")
     //.attr("transform", "translate(438,535)")
     .attr({
     "alignment-baseline": "middle",
     "text-anchor": "middle"
     });  */

    var leftCircleText = leftCircleGroup.append("text")
        .attr({
            "transform": "translate(0, -5)",
            "class": "textInCircle",
        });

    leftCircleText
        .append('tspan')
        .text("EDD");

    leftCircleText
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("Flow");


    var leftCircleDescription = leftCircleGroup.append("text")
        .attr({
            "transform": "translate(60,0)",
            "class": "textDescriptionLeft",
        });

    leftCircleDescription
        .append('tspan')
        .text("Number of patients");

    leftCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("waiting with a Decision");

    leftCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 18
        })
        .text("to Admin(DTA) > 30 mins");

    var rightCircleGroup = centerGroup.append("g")
        .attr("transform", "translate(622,534)");

    var rightCircle = rightCircleGroup.append("circle").attr({
        /*        "cx": 606,
         "cy": 611,*/
        "r": 38,
        "fill": "#007457"
    }).attr("class", "rightCircle").attr("filter", "url(#dropshadow)");

    var rightCircleText = rightCircleGroup.append("text")
        .attr({
            "transform": "translate(0, -5)",
            "class": "textInCircle",
            /*                "alignment-baseline": "middle",
             "text-anchor": "middle",
             "text-align": "center"*/
        })

    rightCircleText
        .append('tspan')
        .text("EDD")

    rightCircleText
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("Capacity")

    var rightCircleDescription = rightCircleGroup.append("text")
        .attr({
            "transform": "translate(-50, -130)",
            "class": "textDescriptionRight",
        });

    rightCircleDescription
        .append('tspan')
        .text("");

    rightCircleDescription
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        })
        .text("Total number of patients");


    var centerCircleGroup = centerGroup.append("g")
        .attr("transform", "translate(436,536)")

    var centerCircle = centerCircleGroup.append("circle").attr({
        /*        "cx": 438,
         "cy": 535,*/
        "r": 61,
        "fill": "#007457"
    }).attr("class", "centerCircle").attr("filter", "url(#dropshadow)");

    var centerCircleText = centerCircleGroup.append("text").text("")
        .attr("transform", "translate(1,40)")
        .attr({
            "class": "centerText"
        });
    centerCircleText.text(data.EDD_capacity.status_overall);
    var centerCircleTitle = centerCircleGroup.append("text")
        .attr({
            "transform": "translate(0, -35)",
            "class": "textInCircle"
        })

    var centerCircleTitleLine1= centerCircleTitle
        .append('tspan');

    var centerCircleTitleLine2=centerCircleTitle
        .append('tspan')
        .attr({
            x: 0,
            dy: 16.5
        });
    centerCircleTitleLine1.text('EDD');
    centerCircleTitleLine2.text('Capacity');

    //centerCircleText.text("55")

    topCircle.on("mouseover", function (d) {

            //d3.select(this).transition().duration(200).attr("d", arc2);
            tooltip.show("Patient Safety");
        })
        .on("mousemove", function (d) {
            tooltip.move();
        })
        .on("mouseout", function (d, i) {
            //d3.select(this).transition().duration(200).attr("d", arc);
            tooltip.hide();
        });

    topCircle.on("click", function () {
        // patient safety
        /*
         topCircleDescription
         .transition()
         .attr({
         "transform": "translate(90, 10)"
         });


         rightCircleDescription
         .transition()
         .attr({
         "transform": "translate(-30, -80)"
         });

         leftCircleDescription
         .transition()
         .attr({
         "transform": "translate(-180, -80)"
         });

         */

        centerCircle.transition().attr({
            "fill": "#848413"
        })

        centerCircleText.text(data.patient_safety.status_overall);
        centerCircleTitleLine1.text('Patient');
        centerCircleTitleLine2.text('Safety');
        /*        d3.selectAll(".arcTop").transition().duration(200).attr("d", arcTop);
         d3.selectAll(".arcLeft").transition().duration(200).attr("d", arc2Left);
         d3.selectAll(".arcRight").transition().duration(200).attr("d", arc2Right);
         */
    })

    rightCircle.on("mouseover", function (d) {

            //d3.select(this).transition().duration(200).attr("d", arc2);
            tooltip.show("EDD Capacity");
        })
        .on("mousemove", function (d) {
            tooltip.move();
        })
        .on("mouseout", function (d, i) {
            //d3.select(this).transition().duration(200).attr("d", arc);
            tooltip.hide();
        });

    rightCircle.on("click", function () {

        centerCircle.transition().attr({
            "fill": "#007457"
        });
        // EDD Capacity
        centerCircleText.text(data.EDD_capacity.status_overall);
        centerCircleTitleLine1.text('EDD');
        centerCircleTitleLine2.text('Capacity');

    });

    leftCircle.on("mouseover", function (d) {

            //d3.select(this).transition().duration(200).attr("d", arc2);
            tooltip.show("EDD Flow");

        })
        .on("mousemove", function (d) {
            tooltip.move();
        })
        .on("mouseout", function (d, i) {

            tooltip.hide();
        });

    leftCircle.on("click", function () {

        centerCircle
            .transition()
            .attr({
                "fill": "#BF0090"
            })

        centerCircleText.text(data.EDD_flow.status_overall);
        centerCircleTitleLine1.text('EDD');
        centerCircleTitleLine2.text('Flow');
        /*        d3.selectAll(".arcTop").transition().duration(200).attr("d", arc2Top);
         d3.selectAll(".arcLeft").transition().duration(200).attr("d", arcLeft);
         d3.selectAll(".arcRight").transition().duration(200).attr("d", arc2Right);  */
    })


    // chart

    var chartWidth = 420,
        chartHeight = 550;

    var chart = svg.append("g")
        .classed("chart", true)
        .attr("transform", "translate(800,250)")

    function createChart(data) {
        var marginTop = 20;

        var y = d3.scale.ordinal()
            .domain(data.map(function (d) {
                return d.EXTERNAL_ID;
            }))
            .rangeRoundBands([0, chartHeight], .1);


        var x = d3.scale.linear()
            .domain([0, d3.max(data, function (d) {
                return d.Minutes;
            })])
            .range([0, chartWidth]);


        // axis
        var xAxis = d3.svg.axis()
            .scale(x)
            .tickSize(chartHeight)
            //.tickFormat(formatCurrency)            
            .orient("bottom");

        var gy = chart.append("g")
            .attr("class", "x axis")
            //.attr("transform", "translate(0," + chartHeight + ")")
            .call(xAxis)
        /*            .selectAll("text")
         //.attr("x", null)
         .attr("dy", -20)
         //.style("text-anchor", null)*/

        gy.selectAll("g").filter(function (d) {
                return d;
            })
            .classed("minor", true);

        chart.selectAll(".tick text").attr("transform", "translate(0," + -(chartHeight + 15) + ")")
            .attr("fill", "#000")
            .style("font-size", 11)

        // axis    

        var bar = chart.selectAll("g.bar")
            .data(data)
            .enter()
            .append("g")
            .attr("transform", function (d, i) {
                return "translate(0," + i * (y.rangeBand() + y.rangeBand() * 0.1) + ")";
            });

        bar.append("rect")
            .attr("width", function (d) {
                return x(d.Minutes);
            })
            .attr("height", y.rangeBand())
            .attr("class", function (d) {
                var name = d.Location_Group.split(" ").join("_");
                return name;
            })
            .style("fill", "#007457");

        bar.append("text")
            .attr("x", function (d) {
                return x(d.Minutes) - 4;
            })
            .attr("y", y.rangeBand() / 2)
            .attr("dy", ".35em")
            .attr("class", "chartLabels")
            .text(function (d) {
                return d.Minutes;
            });

    }

    createChart(data_strips);
}

