//TODO Will this be updated in real time? Need to have exits and updates
//TODO check on sizes of the svg
//TODO check on style information

//some useful constants & style variables
var duration = 500,
    Tau = 2 * Math.PI,
    radii = {outer:230,middle:180,inner:125,padding:15},
    padAngle = 0.05,
    arcCorner = 0,
    arrivalPadding = 2,
    arrivalStartY = 20;
    waitCenterGroupStartY = 250;

//is this all cases?
var arrivalIcons = {
    Ambulance :{icon: "ambulance", scale:0.011},
    "Private Transport":{icon:"male", scale:0.01}
};

//read metadata
//var fname = "../../js/ane/data/data.csv";
//create Initial DOM

var svg = initialize({selector:"#d3_app", x:0, y:0, tooltip:1});

var arcMinor = d3.svg.arc()
        .innerRadius(radii.inner)
        .outerRadius(radii.middle-radii.padding)
        .cornerRadius(arcCorner)
        .padAngle(padAngle),
    arcMajor = d3.svg.arc()
        .innerRadius(radii.middle+radii.padding)
        .outerRadius(radii.outer)
        .cornerRadius(arcCorner)
        .padAngle(padAngle);

//create the svg groups for the layout
svg.append("g")
    .attr("id","treated")
    .attr("transform","translate(20,"+arrivalStartY+")")
    .append("text")
    .text("Treated")
    .style("font-size","1.5em");

svg.append("g")
    .attr("id","triage2seen")
    .attr("transform","translate(20,"+(arrivalStartY+300)+")");


svg.append("g")
    .attr("id","arr2triage")
    .attr("transform","translate(780,"+(arrivalStartY+300)+")");

svg.append("g")
    .attr("id","arrival")
    .attr("transform","translate(820,"+arrivalStartY+")")
    .append("text")
    .text("Arrival Mode")
    .style("font-size","1.5em");

svg.append("g")
    .attr({"id":"waitTime","transform":"translate(500,"+waitCenterGroupStartY+")"});

var jsonUrl='current-status-data';
d3.json(jsonUrl,function(err,data) {
    if (err) throw err;
    //trim the white space in the values
    /*d3.keys(data[0]).map(function(key) {
        data.forEach(function(d) {
            return d[key] = d[key].trim();
        });
    });*/
    //d3.select("h3").text("Report: "+moment(findLastTime(data)).format('MMMM Do YYYY h:mm a'));

D = data;
    data.forEach(function(d) {
        if (d["ARRIVAL_MODE_DESC"].match("Ambulance")) d["ARRIVAL_MODE_DESC"] = "Ambulance"
        else d["ARRIVAL_MODE_DESC"] = "Private Transport"
        if (d["TRIAGE_CAT_CODE"].match("Maj")) d["TRIAGE_CAT_CODE"] = "Major";
        if (d["TRIAGE_CAT_CODE"].match("Min")) d["TRIAGE_CAT_CODE"] = "Minor";
        if (d["TRIAGE_CAT_CODE"].match("IMMED")) d["TRIAGE_CAT_CODE"] = "Major";
    })
    arrivals(data,"ARRIVAL_MODE_DESC");
    treated(data,"LOS_Seen_Ref_Minutes");
    triage2seen(data,"LOS_Tri_Seen_Minutes");
    arr2triage(data,"LOS_Arr_Tri_Minutes");
    decorateWait();
    //this should include the major minor numbers
    [0,1,2,3].forEach(function(d) {textArcs(data,"LOS_Hour_Bands",d)})
    textCenter(data,{breach:"4_Hours_Breach_Flag","category":"TRIAGE_CAT_CODE"});
    waitArcs(data,{"category":"TRIAGE_CAT_CODE","hourBand":"LOS_Hour_Bands"});
});

function triage2seen(data,colname) {
    subset = data.filter(function(d) {return d[colname]!=""});

    var overall = d3.mean(pluck(subset,colname));
    var major = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Major"});
    var majorA = d3.mean(pluck(major,colname));
    var minor = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Minor"});
    var minorA = d3.mean(pluck(minor,colname));

    d3.select("#triage2seen").append("text")
        .text("Time from Triage to Seen:")
        .attr("dy","2em")
        .style("font-weight","bold");

    d3.select("#triage2seen").append("text")
        .text("Overall Average: "+d3.format(",.2f")(overall)+" minutes")
        .attr("dy","3.5em")

    d3.select("#triage2seen").append("text")
        .text("Major ("+major.length+"): "+d3.format(',.2f')(majorA)+" minutes")
        .attr("dy","5em")

    d3.select("#triage2seen").append("text")
        .text("Minor ("+minor.length+"): "+d3.format(',.1%')(minorA)+" minutes")
        .attr("dy","6.5em")

    d3.select("#triage2seen").append("line")
        .attr({
            "x1":0,
            "x2":150,
            "y1":"7em",
            "y2":"7em"
        })
        .style({"stroke-width":"1px","stroke":"black"});

    d3.select("#triage2seen").append("text")
        .text(d3.format(",.1%")(subset.length/data.length)+" patients Seen")
        .attr("dy","8em")

}

function arr2triage(data,colname) {
    subset = data.filter(function(d) {return d[colname]!=""});

    var overall = d3.mean(pluck(subset,colname));
    var major = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Major"});
    var majorA = d3.mean(pluck(major,colname));
    var minor = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Minor"});
    var minorA = d3.mean(pluck(minor,colname));

    d3.select("#arr2triage").append("text")
        .text("Time from Arrival to Triage:")
        .attr("dy","2em")
        .style("font-weight","bold");

    d3.select("#arr2triage").append("text")
        .text("Overall Average: "+d3.format(",.2f")(overall)+" minutes")
        .attr("dy","3.5em")

    d3.select("#arr2triage").append("text")
        .text("Major ("+major.length+"): "+d3.format(',.2f')(majorA)+" minutes")
        .attr("dy","5em")

    d3.select("#arr2triage").append("text")
        .text("Minor ("+minor.length+"): "+d3.format(',.2f')(minorA)+" minutes")
        .attr("dy","6.5em")

    d3.select("#arr2triage").append("line")
        .attr({
            "x1":0,
            "x2":150,
            "y1":"7em",
            "y2":"7em"
        })
        .style({"stroke-width":"1px","stroke":"black"});

    d3.select("#arr2triage").append("text")
        .text(d3.format(",.1%%")(subset.length/data.length)+" patients Triaged")
        .attr("dy","8em")

}

function treated(data,colname) {
    subset = data.filter(function(d) {return d[colname]!=""});

    var overall = d3.mean(pluck(subset,colname));
    var major = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Major"});
    var majorA = d3.mean(pluck(major,colname));
    var minor = subset.filter(function(d) {return d["TRIAGE_CAT_CODE"]=="Minor"});
    var minorA = d3.mean(pluck(minor,colname));


    d3.select("#treated").append("text")
        .text("Time from Seen to Treated:")
        .attr("dy","2em")
        .style("font-weight","bold");

    d3.select("#treated").append("text")
        .text("Overall Average: "+d3.format(",.2f")(overall)+" minutes")
        .attr("dy","3.5em")

    d3.select("#treated").append("text")
        .text("Major ("+major.length+"): "+d3.format(',.2f')(majorA)+" minutes")
        .attr("dy","5em")

    d3.select("#treated").append("text")
        .text("Minor ("+minor.length+"): "+d3.format(',.2f')(minorA)+" minutes")
        .attr("dy","6.5em")

    d3.select("#treated").append("line")
        .attr({
            "x1":0,
            "x2":150,
            "y1":"7em",
            "y2":"7em"
        })
        .style({"stroke-width":"1px","stroke":"black"});

    d3.select("#treated").append("text")
        .text(d3.format(",.1%")(subset.length/data.length)+" patients Treated")
        .attr("dy","8em")

}

function arrivals(data,colname) {
    var Arrtypes = d3.set(data.map(function(d) {return d[colname]})).values()
        .map(function(key) {var obj =
        {
            key: key,
            value: data.filter(function(d) {return d[colname]==key}).length
        };
            return obj
        })
        .sort(function(a,b) {return b.value - a.value});

    var sample = d3.select("#arrival")
        .selectAll(".info").data(Arrtypes,function(d) {return d.key});
    sEnter = sample.enter().append("g")
        .classed("info",1);

    d3.select("#arrival").selectAll(".info")
        .attr("transform","translate(25,0)");

    //add the icons
    sEnter.each(function(d,i) {
        getIcon(arrivalIcons[d.key].icon,this, arrivalIcons[d.key].scale,{x:0,y:-30}
            ,function(g) {
                d3.select(g).insert("text","icon")
                    .classed("label",1)
                    .text(function(d) {return d.key})
                    .style("font-size","0.5em");

                d3.select(g).append("text")
                    .classed("number",1)
                    .text(function(d) {return d.value})
                    .attr({"text-anchor":"end","transform":"translate(100,-10)"})
                    .style("font-size","1.5em");

                //if we've done the last one, then adjust the heights
                if (!g.nextSibling) {
                    d3.selectAll("#arrival .info")
                        .attr("transform",function(d,i) {
                            return "translate(0,"+((g.getBBox().height+arrivalPadding)*(i+1))+")"
                        });
                    d3.selectAll("svg svg").attr("y",-30);
                }

            })
    });

    sample.selectAll(".label")
        .text(function(d) {return d.key})
        .style("font-size","0.5em")

    sample.selectAll(".number")
        .text(function(d) {return d.value});

    sample.exit()
        .transition().duration(duration)
        .style("opacity",1e-6)
        .remove();
} //arrivals

function decorateWait() {
    var w = d3.select("#waitTime");

    //add the background circles
    w.append("path")
        .datum({startAngle: 0, endAngle: Tau})
        .classed("arc", 1)
        .attr("d", arcMajor)
        .style({
            "fill": "#AAAAAA",
            "stroke": "#404040"
        });

    w.append("path")
        .datum({startAngle: 0, endAngle: Tau})
        .classed("arc", 1)
        .attr("d", arcMinor)
        .style({
            "fill": "#C8C8C8",
            "stroke": "#404040"
        });

    //add the lines and the clock and the numbers
    var padding = 20;
    var linedata = [
        {x2: 0, y2: radii.outer + padding, x1: 0, y1: radii.inner},
        {x2: radii.outer + padding, y2: 0, x1: radii.inner, y2: 0},
        {x2: 0, y2: -radii.outer - padding, x1: 0, y1: -radii.inner},
        {x2: -radii.outer - padding, y2: 0, x1: -radii.inner, y1: 0}
    ];

    w.selectAll("line").data(linedata).enter().append("line")
        .attr({
            "x1": function (d) {return d.x1},
            "y1": function (d) {return d.y1},
            "x2": function (d) {return d.x2},
            "y2": function (d) {return d.y2}
        })
        .style({
            "stroke": "grey",
            "stroke-width": 2.5,
            "display":"none"
        });

    //clock hands
    //hour angle = Tau/12
    /*w.append("line")
        .attr({
            "id":"hourHand",
            "x1":0,
            "y1":0,
            "x2":(radii.inner-50)*Math.cos(Tau/12),
            "y2":(radii.inner-50)*Math.sin(Tau/12),
            "stroke-linecap":"round"
        })
        .style({
            "stroke":"#CC0000",
            "stroke-width":15,
            "stroke-opacity":0.5,
        })

    w.append("line")
        .attr({
            "id":"minHand",
            "x1":0,
            "y1":0,
            "x2":(radii.inner-46)*Math.cos(-Tau/4),
            "y2":(radii.inner-46)*Math.sin(-Tau/4),
            "stroke-linecap":"round"
        })
        .style({
            "stroke":"#CC0000",
            "stroke-width":10,
            "stroke-opacity":0.5,
            "stroke-linecap":"round"
        })

    w.append("circle")
        .attr({
            "r":9
        })
        .style({
            "fill":"#cc0000",
            "fill-opacity":0.75
        })*/


}

function findLastTime(data) {
    var lastTime = new Date(0);
    data.forEach(function(d) {
        for (key in d) {
            if (key.match("DTTM")) {
                var t = new Date(d[key]);
                if (new Date(d[key]) > lastTime) {
                    lastTime = t
                }
            }
        }
    });
    return lastTime
}

function getIcon(name,group,scale,translate,callback) {
    d3.xml("/images/"+name +".svg","image/svg+xml",function(err,xml) {
        //if (err) throw err
        var importedNode = document.importNode(xml.documentElement, true);
        g = group.appendChild(importedNode.cloneNode(true));
        //the ambulance is headed in the wrong direction, fix it.
        if (name=="ambulance") transfString = "translate(22,0)scale(-"+scale+","+scale+")"
        else transfString = "translate(5,0)scale("+scale+")"
        d3.select(g).select("path").attr("transform",transfString)
            .classed("icon",1);
        callback(group);
    })
}

function initialize(obj) {
    var geom = {top:10, right:10, bottom:10, left:10, width:960, height:400},
        svg = d3.select(obj.selector).append("svg")
            .attr({"viewBox":"0 0 1024 500"})
            .append("g")
            .attr({
                "id" : "chart",
                "transform" : "translate("+geom.left+","+geom.top+")"
            });
    if (obj.x) svg.append("g")
        .classed({"x":1,"axis":1});
    if (obj.y) svg.append("g")
        .classed({"y":1,"axis":1});


    if (obj.tooltip) {
        var tooltip = d3.select(obj.selector).append("div")
            .attr("id", "tooltip");

        //have some kind of object to determine what goes in the tooltip
        ["header1", "header-rule", "header2"]
            .forEach(function (c) {
                tooltip.append("div")
                    .classed(c, 1);
            });
    }
    //we're going to need 3 sets of these at different radii
    var defs = svg.append("defs");
    d3.range(0,4).forEach(function(i) {
        defs.append("path")
            .attr({
                "id":"quadrant"+i,
                "d": getTextPath({radius:178,quadrant:i,center:{x:0,y:0}})
            })
    });
    function getTextPath(obj) {
        var center = obj.center;
        var startAngle = obj.quadrant*Tau/4+0;
        var endAngle = startAngle+Tau/4+0;
        var r = obj.radius+((obj.quadrant>2)?0:0);
        /*the arc should:
         have radius r (rx=ry=r)
         start at cx+r*cos(theta_start),cy+r*sin(theta_start)
         end at cx+r*cos(theta_end),cy+r*sin(theta_end)
         no x-axis rotation
         large arc-flag: smalls
         sweep arc-flag: CW if startY is less than 0
         */
        var startX = obj.center.x+r*Math.cos(startAngle), startY = center.y+r*Math.sin(startAngle);
        var endX = center.x+r*Math.cos(endAngle), endY =  center.y+(r)*Math.sin(endAngle);
        var sweep = startY>center.x?0:1;
        sweep = 1;

        //should do this with ternary statements instead of the regex stuff
        var path =  'M' + startX + ',' + startY + ' '+
            'A' + r + ',' + r + ' 0 0 '+ sweep +' '+endX + ', '+endY;
        if (endAngle<=Tau/2) {
            var startLoc = /M(.*?)A/,
                middleLoc = /A(.*?)0 0 1/,
                endLoc = /0 0 1 (.*?)$/;
            var newStart = endLoc.exec(path)[1];
            var newEnd = startLoc.exec(path)[1];
            var middleSec = middleLoc.exec(path)[1];
            var middleSec = middleLoc.exec(path)[1];
            path = "M" + newStart + "A" + middleSec + "0 0 0 " + newEnd;
        }
        return path
    }

    return svg
}//end initialize

function pluck(arr,key) {
    return arr.map(function(d) {return d[key]});
}

function textArcs(data,colname,quadrant) {
    var TextObject = d3.select("#waitTime").append("text");
    var number = data
        .map(function(d) {return d[colname][0]})
        .filter(function(dat) {return dat==quadrant}).length;
    TextObject.append("textPath")
        .attr({
            "id" : "quadText"+quadrant,
            "startOffset":"50%",
            "xlink:href" : "#quadrant"+(quadrant+3)%4
        })        .attr("transform","rotate(-"+Tau/2+")")
        .text(number+" patients waiting "+quadrant+" to "+(quadrant+1)+" hours")
        .attr({
            "text-anchor":"middle",
            "alignment-baseline":"middle"
        })

}

function textCenter(data,colnames) {
    //TODO will need to update this
    var N = data.length;
    var breach = data.filter(function(d) {return d[colnames.breach]=="1"});
    var L = breach.length;
    var textgroup = d3.select("#waitTime").append("g").attr("id","centerText");

    //TODO align center
    //font-size
    textgroup.append("text")
        .attr({"id":"percentText","x":0,"y":-30})
        .html(d3.format(",.1%")(L/N)+" of patients")
        .style({
            "text-anchor": "middle",
            "font-size": "18px"
        });

    textgroup.append("text")
        .attr({"id":"numText","x":0,"y":10})
        .text(L+" breaches")
        .style({
            "text-anchor": "middle",
            "font-size": "18px"
        });

    textgroup.append("text")
        .attr({"id":"majorText","x":-50,"y":45})
        .text(breach.filter(function(d) {return d[colnames.category].slice(0,3)=="Maj"}).length+" major")
        .style({
            "text-anchor": "middle",
            "font-size": "18px"
        });

    textgroup.append("text")
        .attr({"id":"minorText","x":50,"y":45})
        .text(breach.filter(function(d) {return d[colnames.category].slice(0,3)=="Min"}).length+" minor")
        .style({
            "text-anchor": "middle",
            "font-size": "18px"
        });
}


//TODO will want to tween this
//TODO IMPORTANT: might want to change structure of the arcs
function waitArcs(data,colnames) {
    var timenest = d3.nest()
        .key(function(d) {return d[colnames.hourBand]})
        .rollup(function(leaves) {return leaves.length})
        .entries(data);
    var nested = d3.nest()
        .key(function(d) {return d[colnames.category].slice(0,3)})
        .key(function(d) {return d[colnames.hourBand]})
        .rollup(function(leaves) {return leaves.length})
        .entries(data)
        .filter(function(n) {
            return n.key=="Maj" || n.key =="Min"
        }).sort(d3.descending);

    [   {"type":"Maj","class":"major",arcfunction:arcMajor,"fill":"#CC0000"},
        {"type":"Min","class":"minor",arcfunction:arcMinor,"fill":"#FF6600"}
    ].forEach(createArcs);

    function createArcs(obj) {
        var Arcs = d3.select("#waitTime").selectAll(obj.class)
            .data(nested
                .filter(function (d) {
                    return d.key == obj.type
                })[0].values
                .filter(function (v) {
                    return v.key[0] != "G"
                })
            , function (d) {
                return d.key
            });

        Arcs.enter()
            .append("path")
            .classed(obj.class+" arc",1)

        //TODO need a transition
        //have them start from 0 and rotate in
        d3.selectAll(".arc."+obj.class)
            .attr("d", obj.arcfunction
                .startAngle(function (d) {
                    return +d.key[0]*(Tau/4)
                })
                .endAngle(function (d) {
                    var tot = timenest.filter(function(t) {return t.key== d.key})[0].values;
                    var ang =  +d.key[0]+ d.values/tot;
                    return ang*(Tau/4)
                })
        ).style({
                "fill": obj.fill,
                "stroke":d3.rgb(obj.fill).darker(2).toString()
            });
        //TODO need a transition
        Arcs.exit().remove();
    }



} //waitArcs



