var rttColorArray = new Array();
rttColorArray['Admitted Adjusted'] = '#0087bc';
rttColorArray['Incomplete'] = '#003893';
rttColorArray['Non Admitted'] = '#a00054';


var finYearColorArray = new Array();
finYearColorArray[2] = '#003893';
finYearColorArray[1] = '#0087bc';
finYearColorArray[0] = '#a00054';

var tooltip1 = d3.select("body")
        .append("div")
        .style("position", "absolute")
        .style("z-index", "10")
        .style("visibility", "hidden")
        .style("color", "white")
        .style("padding", "8px")
        .style("top", "0")
        .style("background-color", "rgba(0, 0, 0, 0.75)")
        .style("border-radius", "6px")
        .style("font", "12px sans-serif")
        .text("tooltip");


var chartWidth = $("#specialitiesChart").width();

$(window).resize(function () {
    $("#specialitiesChart svg").remove();
    chartWidth = $("#specialitiesChart").width();
    renderSpcecialitiesChart(sepcialitiesChartDataString, chartWidth);
});




renderSpcecialitiesBulletChart(sepcialitiesChartDataStringAdmit, chartWidth, 'specialitiesChartAdmit');
renderSpcecialitiesBulletChart(sepcialitiesChartDataStringNonAdmit, chartWidth, 'specialitiesChartNonAdmit');
renderSpcecialitiesBulletChart(sepcialitiesChartDataStringInComplete, chartWidth, 'specialitiesChartIncomplete');
function renderSpcecialitiesBulletChart(data, chartWidth, chartId) {



    var width = 30,
            height = 200;

    var barCntTotal = Math.ceil(data.length);
    var rowCnt = Math.ceil(barCntTotal / 10);
    var barCntHalf = Math.ceil(barCntTotal / rowCnt);
    var chartWid = $(".col-fulwid").width();
    widPerBar = 60;
    if (barCntTotal > 10 || chartWid < "1300")
    {

        var availBarinRow = chartWid / barCntHalf;
        if (availBarinRow != 10)
        {
            var widPerBar = availBarinRow - width - 10;
            var widPerBar = widPerBar / 2;
        }


    }

    var margin = {top: 5, right: widPerBar, bottom: 50, left: widPerBar};

    var chart = d3.bullet()
            .orient("bottom")
            .width(width)
            .height(height);


    var svg = d3.select("#" + chartId).selectAll("svg")
            .data(data)
            .enter().append("svg")
            .attr("class", "bullet")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
            .call(chart);

    var title = svg.append("g")
            .style("text-anchor", "start")

            .attr("transform", "translate(" + width + "," + (height + 20) + ")");

    title.append("text")
            .attr("class", "title")
            .attr("x", 33)
            .attr("y", -55)
            .attr('transform', "rotate(-90)")
            .text(function (d) {
                return d.title;
            });

    title.append("text")
            .attr("class", "subtitle")
            .attr("dy", "1em")
            .text(function (d) {
                return d.subtitle;
            });

    var keys = d3.values(finArray).filter(function (key) {
        return key !== "date";
    });

    var finYearColorArrayGen = new Array();
    keys.forEach(function (d, i) {
        finYearColorArrayGen[d] = finYearColorArray[i];
    });



    var legendul = d3.select("#" + chartId + "_Legend");
    legendul.selectAll('.leg')
            .data(keys)
            .enter().append("li")
            .html(function (d) {
                return '<svg height="20" width="20"><circle cx="10" cy="10" r="8"  fill="' + finYearColorArrayGen[d] + '" /></svg>' + d;
            });




}


//// arc charts
drawHalfPieChart(data111, data222, data333, 'week18MonthYearComp');

function drawHalfPieChart(data11, data22, data33, fieldId)
{

    var widthPlus = 200;
    var w = 350,
            h = w,
            r = (w / 2) - 20,
            arcThikness = 26,
            pi = Math.PI;
    xvalue = w / 2 + widthPlus / 2;
    yvalue = h / 2;

    color = new Array();
    color[2] = finYearColorArray[2];
    color[1] = finYearColorArray[1];
    color[0] = finYearColorArray[0];
    color[3] = "red";
    color['b'] = "white";
    var vis1 = d3.select("#" + fieldId).append("svg").attr("id", 'chart').attr("width", w + widthPlus)
            .attr("height", h + widthPlus / 4);

    var centerHeaderPosition = w / 2 + 10;
    vis1.append("svg:text")
            .attr("transform", function (d) {
                return "translate(" + ((w / 2) + widthPlus / 2) + "," + centerHeaderPosition + ")";
            })
            .attr('class', 'centerTableHead')
            .attr("text-anchor", "middle")
            .text("52 Week Breaches");


    //TableCenter           
    $('#comparisongraph_legend').html('');
    var legendul = d3.select('#comparisongraph_legend');
    legendul.selectAll('.leg').data(TableCenter)
            .enter().append("li").html(function (d, i) {
        return '<svg height="20" width="20"><circle cx="10" cy="10" r="8"  fill="' + color[i] + '" /></svg>' + d.finyear;
    });



    createChart(data33, 'bottom', vis1);
    createChart(data11, 'left', vis1);
    createChart(data22, 'right', vis1);

    vis1.append("text")
            .attr("x", 40)
            .attr("y", h / 3)
            .style("font-size", "large")
            .text("Admitted");

    vis1.append("text")
            .attr("x", w + 90)
            .attr("y", h / 3)
            .style("font-size", "large")
            .text("Non-Admitted");

    vis1.append("text")
            .attr("x", w / 2 + widthPlus / 2 - 35)
            .attr("y", h + 5)
            .style("font-size", "large")
            .text("Incomplete");
    /*
     $pathString="M 100, 100 m -75, 0 a 50,50 0 1,0 150,0 a 50,50 0 1,0 -150,0"
     vis1.append("defs").append("path").attr("id","leftText").attr("d","M 150, 150 m -75, 0 a 50,50 0 1,0 150,0 -150,0");
     vis1.append("svg:text").attr("x","10").attr("y","100").append("textPath").attr("xlink:href","#leftText").text("Admitted Adjusted");
     
     vis1.append("defs").append("path").attr("id","bottomText").attr("d","M 150, 150 m -75, 25 a 50,50 0 1,0 150,0 -150,0");
     vis1.append("svg:text").attr("x","10").attr("y","100").append("textPath").attr("xlink:href","#bottomText").text("Non-Admitted");
     
     */
    function createChart(data1, side, vis) {


        vis = d3.select("#chart").append("svg:g")
                .data([data1])
                .append("svg:g")
                .attr("transform", "translate(" + xvalue + "," + yvalue + ")");
        if (side == 'bottom')
        {
            var startingAngle = "120";
            var endingAngle = "240";


        } else if (side == 'left') {
            var startingAngle = "-120";
            var endingAngle = "0";
        }
        else if (side == 'right') {
            var startingAngle = "0";
            var endingAngle = "120";
        }
        else
        {
            var startingAngle = "0";
            var endingAngle = "0";
        }

        for (var j = 0; j < Object.keys(data1[0].value[0]).length; j++) {

            setSlides(j);
        }

        function setSlides(id) {
            var arc3 = d3.svg.arc()
                    .outerRadius(r - arcThikness * id)
                    .innerRadius(r - arcThikness * (id + 1));

            var pie3 = d3.layout.pie()
                    .value(function (d, i) {
                        if (d.value[0][Object.keys(d.value[0])[id]] == 0) {
                            return .000001;
                        } else {
                            return d.value[0][Object.keys(d.value[0])[id]]
                        }
                    })
                    .startAngle(startingAngle * (pi / 180))
                    .endAngle(endingAngle * (pi / 180))
                    .sort(null);

            var arcs3 = vis.selectAll("g.slice" + id)
                    .data(pie3)
                    .enter()
                    .append("svg:g")
                    .attr("class", "slice3" + id)
                    .on("mouseover", function (d) {
                        tooltip1.html(d.data.type + " (" + Object.keys(d.data.value[0])[id] + ") : " + d.data.value[0][Object.keys(d.data.value[0])[id]] + "%")
                        tooltip1.style("visibility", function () {
                            if (d.data.label == 'b') {
                                return "hidden";
                            }
                            return "visible";
                        });
                    })
                    .on("mousemove", function () {
                        return tooltip1.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
                    })
                    .on("mouseout", function () {
                        return tooltip1.style("visibility", "hidden");
                    });

            arcs3.append("svg:path")
                    .attr("fill", "white")
                    //.transition()
                    //.duration(2000)
                    //.ease("linear")
                    .attr("fill", function (d, i) {
                        if (d.data.label == 'a') {

                            if (d.data.value[0][Object.keys(d.data.value[0])[id]] == 0) {
                                return 'white';
                            }
                            return color[id];
                        } else {
                            return 'white';
                        }
                    })
                    .attr("d", arc3);

            arcs3.append("svg:text")
                    .attr("transform", function (d) {

                        return "translate(" + arc3.centroid(d) + ")";
                    })
                    .attr("text-anchor", "middle")
                    .style("font-size", "larger")
                    .style("font-weight", "bold")
                    .text(function (d, i) {
                        if (d.data.label == 'a') {
                            if (d.data.value[0][Object.keys(d.data.value[0])[id]] != 0) {
                                return data1[i].value[0][Object.keys(data1[i].value[0])[id]] + "%";
                            }
                        }
                        else {
                            return "";
                        }
                    });


        }
    }




}

function hasWhiteSpace(s) {
    return s.indexOf(' ') >= 0;
}


renderMultiSeriesLineChart('seriesLineChartAdmitAdjust', admitAdjustLineChartData, targetAdmit, finArray);
renderMultiSeriesLineChart('seriesLineChartNonAdmit', nonAdmitLineChartData, targetNonAdmit, finArray);
renderMultiSeriesLineChart('seriesLineChartIncomplete', incompleteLineChartData, targetIncomplete, finArray);

function renderMultiSeriesLineChart(chartId, data, target, finArray) {

    if (data.length == 0)
    {
        $("#" + chartId).html('<div class="null">No data available</div>');
        return 1;
    }


    var margin = {top: 20, right: 20, bottom: 30, left: 60},
    width = $("#" + chartId).width();
    width = width - margin.left - margin.right,
            height = 250 - margin.top - margin.bottom;

    var x1 = d3.scale.ordinal()
            .domain(["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"])
            .rangeBands([0, width]);

    var y = d3.scale.linear()
            .range([height, 0]);
    var color = d3.scale.category10();

    var xAxis = d3.svg.axis()
            .scale(x1)
            .orient("bottom");

    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(5);

    var preMonth = new Array('', '', '');


    var predata = new Array('', '', '');
    var countX = -1;
    var line = d3.svg.line()
            // .interpolate("basis")
            .x(function (d, i) {
                if (i == 0) {
                    countX++;
                }

                if (typeof (d.tempvalue) != 'undefined') {
                    return x1(d.date) + (x1.rangeBand() / 2);
                } else {
                    if (preMonth[countX] == '')
                    {
                        var start = findkey(data, finArray[countX]);
                        preMonth[countX] = start['date'];

                    }
                    return x1(preMonth[countX]) + (x1.rangeBand() / 2);
                }
            })
            .y(function (d, i) {

                if (typeof (d.tempvalue) != 'undefined') {
                    preMonth[countX] = d.date;
                    predata[countX] = d.tempvalue;
                    return y(d.tempvalue);
                } else {
                    if (predata[countX] == '')
                    {
                        var start = findkey(data, finArray[countX]);
                        predata[countX] = start[finArray[countX]];


                    }
                    return y(predata[countX]);
                }

            });

    var svg = d3.select("#" + chartId).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    color.domain(d3.values(finArray).filter(function (key) {
        return key !== "date";
    }));
    var keys = d3.values(finArray).filter(function (key) {
        return key !== "date";
    });

    var finYearColorArrayGen = new Array();
    keys.forEach(function (d, i) {
        finYearColorArrayGen[d] = finYearColorArray[i];
    });


    var cities = color.domain().map(function (name) {
        return {
            name: name,
            values: data.map(function (d) {
                return {date: d.date, tempvalue: d[name]};
            })
        };
    });

    y.domain([
        d3.min(cities, function (c) {
            return d3.min(c.values, function (v) {
                if (parseFloat(target[1]) > v.tempvalue) {
                    return v.tempvalue - 2;
                } else {
                    return parseFloat(target[1]) - 2;
                }
            });
        }),
        d3.max(cities, function (c) {

            return d3.max(c.values, function (v) {
                if (parseFloat(target[0]) < v.tempvalue) {
                    return v.tempvalue + 2;
                } else {
                    return parseFloat(target[0]) + 2;
                }
            });
        })
    ]);

    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .text("Performance")
            .attr("transform", "rotate(-90)")
            .attr("y", -50)
            .attr("dy", ".71em")
            .style("text-anchor", "end");

    var city2 = svg.selectAll(".city")
            .data(cities)
            .enter().append("g")
            .attr("class", "city");

    svg.append("g").append("line")
            .attr("class", "Greenline")
            .attr("x1", 0)
            .attr("y1", y(target[0]))
            .attr("x2", width)
            .attr("y2", y(target[0]))

            .style("stroke", function (d) {
                return "green";
            });
    svg.append("g").append("line")
            .attr("class", "redline")
            .attr("x1", 0)
            .attr("y1", y(target[1]))
            .attr("x2", width)
            .attr("y2", y(target[1]))
            .attr("stroke-dasharray", "1,2")
            .style("stroke", function (d) {
                return "red";
            });
    svg.append("g").append("line")
            .attr("class", "amberline")
            .attr("x1", 0)
            .attr("y1", y(target[2]))
            .attr("x2", width)
            .attr("y2", y(target[2]))
            .attr("stroke-dasharray", "1,2")
            .style("stroke", function (d) {
                return "#ff7e00";
            });

    var path2 = city2.append("path")
            .attr("class", "line")
            .attr("d", function (d, i) {
                return line(d.values);
            })
            .style("stroke", function (d) {
                return finYearColorArrayGen[d.name];
            });
    $.each(cities, function (index) {
        svg.append("g").selectAll("circle").data(cities[index]['values'])
                .enter().append("circle").attr("cx", function (d, i) {

            return x1(d['date']) + (x1.rangeBand() / 2);
        }).attr("cy", function (d) {
            if (d['tempvalue'] == undefined)
            {
                this.style.display = 'none';
            } else
                return y(d['tempvalue']);
        }).attr("r", "3").style("fill", function (d, i) {

            return finYearColorArray[index]
        })
                .on("mouseover", function (d) {
                    this.setAttribute("r", 5);
                    tooltip1.html(d.date + " : " + d.tempvalue + "%");
                    tooltip1.style("visibility", function () {
                        return "visible";
                    });
                })
                .on("mousemove", function () {
                    return tooltip1.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
                })
                .on("mouseout", function () {
                    this.setAttribute("r", 3);
                    return tooltip1.style("visibility", "hidden");

                });


    });

    /*  city2.append("text")
     .datum(function(d) {
     return {name: d.name, value: d.values[d.values.length - 1]};
     })
     .attr("transform", function(d,i) {
     
     if (typeof (d.value.tempvalue) != 'undefined') {
     return "translate(" + (x1(d.value.date)+(x1.rangeBand()/2)) + "," + y(d.value.tempvalue) + ")";
     } else {
     return "translate(" + (x1(preMonth[i])+(x1.rangeBand()/2)) + "," + y(predata[i]) + ")";
     }
     
     
     })
     .attr("x", 3)
     .attr("dy", ".35em")
     .text(function(d) {
     return d.name;
     });*/



    var legendul = d3.select("#" + chartId + '_legend');
    legendul.selectAll('.leg').data(cities)
            .enter().append("li").html(function (d) {

        return '<svg height="20" width="20"><circle cx="10" cy="10" r="8"  fill="' + finYearColorArrayGen[d.name] + '" /></svg>' + d.name;
    });
}


drawAnnualPerformAdmitPieCharts('AnnualPerformAdmitPie', AnnualPerformAdmitPieData, 'donut');
drawAnnualPerformAdmitPieCharts('AnnualPerformNonAdmitPie', AnnualPerformNonAdmitPieData, 'donut');
drawAnnualPerformAdmitPieCharts('AnnualPerformIncompletePie', AnnualPerformIncompletePieData, 'donutCut');

function drawAnnualPerformAdmitPieCharts(chartId, AnnualPerformAdmitPieData, chartType) {

    if (AnnualPerformAdmitPieData.length == 0)
    {
        $("#" + chartId).after('<div class="null">No data available</div>');
        return 1;
    }
    d3.select("#" + chartId)
            .selectAll(".sec-row")
            .data(AnnualPerformAdmitPieData)
            .enter()
            .append("div")
            .attr("id", function (d, i) {
                return chartId + "_" + i;
            })
            .attr("class", function (d, i) {
                drawPieChartsWithLabel(d.value, chartId + "_" + i, 150, 150, i, chartType)
                return "sub-col-qr";
            });

    // drawPieChartsWithLabel(AnnualPerformAdmitPieData,chartId+"_"+1, 150, 150,2);

}



function drawPieChartsWithLabel(data, id, pieWidth, pieHeight, yearNo, chartType)
{
    var width = pieWidth,
            height = pieHeight,
            radius = 65;

    var svg = d3.select("#" + id).
            append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");



    svg.append("g")
            .attr("class", "slices");
    svg.append("g")
            .attr("class", "labels");
    svg.append("g")
            .attr("class", "lines");



    var pie = d3.layout.pie()
            .sort(null)
            .value(function (d) {
                return d.value;
            });
    var arc = d3.svg.arc()
            .outerRadius(radius);
    if (chartType == 'pie') {
        arc.innerRadius(0);
    } else {
        arc.innerRadius(35);
    }

    var outerArc = d3.svg.arc()
            .innerRadius(radius)
            .outerRadius(radius);

    svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var key = function (d) {
        return d.data.value;
    };

    var color = d3.scale.ordinal()
            .domain([0, 1, 2])
            .range([finYearColorArray[0], finYearColorArray[1], finYearColorArray[2]]);



    change(data);

    function change(data) {

        /* ------- PIE SLICES -------*/
        var slice = svg.select(".slices").selectAll("path.slice")
                .data(pie(data), key);

        slice.enter()
                .insert("path")
                .style("fill", function (d) {
                    if (d.data.type == 'v2') {
                        if (chartType == 'donutCut') {
                            return 'white'
                        } else {
                            return "rgba(221,221,221,1)";
                        }

                    } else {
                        return color(yearNo);
                    }
                })
                .attr("class", "slice")
                .on("mouseover", function (d) {
                    tooltip1.html(d.value + "%");
                    tooltip1.style("visibility", function () {
                        if (d.data.type != 'v1') {
                            return "hidden";
                        }
                        return "visible";
                    });
                })
                .on("mousemove", function () {
                    return tooltip1.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
                })
                .on("mouseout", function () {
                    return tooltip1.style("visibility", "hidden");
                });

        slice
                .transition().duration(1000)
                .attrTween("d", function (d) {
                    this._current = this._current || d;
                    var interpolate = d3.interpolate(this._current, d);
                    this._current = interpolate(0);
                    return function (t) {
                        return arc(interpolate(t));
                    };
                })

        slice.exit()
                .remove();

        /* ------- TEXT LABELS -------*/

        var text = svg.select(".labels").selectAll("text")
                .data(pie(data), key);

        text.enter()
                .append("text")
                // .attr("dy", ".35em")
                .text(function (d) {
                    if (d.data.value > 50) {
                        return round2Fixed(d.data.value) + " %  ";
                    }
                });

        function midAngle(d) {
            return d.startAngle + (d.endAngle - d.startAngle) / 2;
        }
        if (chartType == 'pie') {
            text.transition().duration(1000)
                    .attrTween("transform", function (d) {
                        this._current = this._current || d;
                        var interpolate = d3.interpolate(this._current, d);
                        this._current = interpolate(0);
                        return function (t) {
                            var d2 = interpolate(t);
                            var pos = outerArc.centroid(d2);
                            pos[0] = 36 * (midAngle(d2) < Math.PI ? 1 : -1);
                            return "translate(" + pos + ")";
                        };
                    })
                    .styleTween("text-anchor", function (d) {
                        this._current = this._current || d;
                        var interpolate = d3.interpolate(this._current, d);
                        this._current = interpolate(0);
                        return function (t) {
                            var d2 = interpolate(t);
                            return midAngle(d2) < Math.PI ? "start" : "end";
                        };
                    });
        } else {
            text.attr("transform", "translate(" + -width / 6 + "," + height / 25 + ")");
            text.attr("style", "font-size:16px;");
        }
        text.exit()
                .remove();

    }
}

drawGroupedBarChart(breachAdmitedBarData, 'breachAdmitedBarChart');
drawGroupedBarChart(breachNonAdmitedBarData, 'breachNonAdmitedBarChart');
drawGroupedBarChart(breachIncompleteBarData, 'breachIncompleteBarChart');

function drawGroupedBarChart(data, ChartId) {
    if (data.length == 0)
    {
        $("#" + ChartId).html('<div class="null">No data available</div>');
        return 1;
    }
    width = $("#" + ChartId).width();
    var margin = {top: 20, right: 20, bottom: 30, left: 63},
    width = width - margin.left - margin.right,
            height = 250 - margin.top - margin.bottom;

    var x0 = d3.scale.ordinal()
            .rangeRoundBands([0, width], .4);

    var x1 = d3.scale.ordinal();

    var y = d3.scale.linear()
            .range([height, 0]);

    var color = d3.scale.ordinal()
            .domain([0, 1, 2])
            .range([finYearColorArray[0], finYearColorArray[1], finYearColorArray[2]]);

    var xAxis = d3.svg.axis()
            .scale(x0)
            .orient("bottom");




    var svg = d3.select("#" + ChartId).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

//d3.csv("data.csv", function(error, data) {
    var finYears = d3.keys(data[0]).filter(function (key) {
        return key !== "monthName";
    });

    var flag = 0;
    data.forEach(function (d) {
        d.ages = finYears.map(function (name) {

            if (d[name] > 0)
            {
                flag = 1;
            }
            return {name: name, value: d[name]};
        });
    });

    if (flag == 0)
    {
        $("#" + ChartId).html('<div class="nulldisplay">NO BREACHES</div>');
        return 1;
    }

    var legendul = d3.select("#" + ChartId + '_legend');
    legendul.selectAll('.leg').data(finYears)
            .enter().append("li").html(function (d, i) {
        return '<svg height="20" width="20"><circle cx="10" cy="10" r="8"  fill="' + color(i) + '" /></svg>' + d;
    });
    x0.domain(data.map(function (d) {
        return d.monthName;
    }));
    x1.domain(finYears).rangeRoundBands([0, x0.rangeBand()]);
    var maxValue = d3.max(data, function (d) {
        return d3.max(d.ages, function (d) {
            return d.value;
        });
    });

    y.domain([0, d3.max(data, function (d) {
            return d3.max(d.ages, function (d) {
                return d.value;
            });
        })]);
    if (maxValue > 5)
    {
        var tickValue = 4;
    }
    else
    {
        var tickValue = maxValue;
    }
    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .tickFormat(d3.format(".s"))
            .ticks(tickValue);


    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);
    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .text("Breaches")
            .attr("transform", "rotate(-90)")
            .attr("y", -53)

            .style("text-anchor", "end");


    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);

    var state = svg.selectAll(".month")
            .data(data)
            .enter().append("g")
            .attr("class", "g")
            .attr("transform", function (d) {
                return "translate(" + x0(d.monthName) + ",0)";
            });

    state.selectAll("rect")
            .data(function (d) {
                return d.ages;
            })
            .enter().append("rect")
            .attr("width", x1.rangeBand() - 3)
            .attr("x", function (d) {

                return x1(d.name);
            })
            .attr("y", function (d) {

                if (typeof (d.value) != 'undefined') {
                    return y(d.value);
                } else {
                    return y(0);
                }
            })
            .attr("height", function (d) {
                if (typeof (d.value) != 'undefined') {
                    return height - y(d.value);
                } else {
                    return height - y(0);
                }
            })
            .style("fill", function (d, i) {
                return color(i);
            })
            .on("mouseover", function (d, i, s) {

                tooltip1.html(data[s].monthName + ' (' + addCommas(d.value) + ')');
                tooltip1.style("visibility", function () {
                    return "visible";
                });
            })
            .on("mousemove", function () {
                return tooltip1.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
            })
            .on("mouseout", function () {
                return tooltip1.style("visibility", "hidden");
            });
}
function findkey(data, key)
{
    var res = '';
    $.each(data, function (index, element) {

        if (element[key] != undefined)
        {

            res = element;
            return false;

        }

    });
    return res;
}

function round2Fixed(value) {
    value = +value;

    if (isNaN(value))
        return NaN;

    // Shift
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + 2) : 2)));

    // Shift back
    value = value.toString().split('e');
    return (+(value[0] + 'e' + (value[1] ? (+value[1] - 2) : -2))).toFixed(1);
}
function addCommas(nStr)
{
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
function explicitlySetStyle(element) {

    var cSSStyleDeclarationComputed = getComputedStyle(element);
    var i, len, key, value;
    var computedStyleStr = "";
    for (i = 0, len = cSSStyleDeclarationComputed.length; i < len; i++) {
        key = cSSStyleDeclarationComputed[i];
        value = cSSStyleDeclarationComputed.getPropertyValue(key);
        if (value !== emptySvgDeclarationComputed.getPropertyValue(key)) {
            computedStyleStr += key + ":" + value + ";";
        }
    }
    element.setAttribute('style', computedStyleStr);
}
var emptySvgDeclarationComputed = getComputedStyle($('#emptysvg')[0]);
function savePDF(from)
{
    if (from != 'iframe')
    {
        $('#preloader').show();
    }

    $(".sec-status").hide();
    $(".TargetBtn").hide();
    var form = document.getElementById("svgform");
    $("#svgform").append($("#searchdropdown").html());
    $(".rdo-list").hide();
    var allElements = new Array();
    for (i = 0; i < $(".line").length; i++)
    {
        allElements.push($(".line")[i])
    }
    for (i = 0; i < $(".axis text").length; i++)
    {
        allElements.push($(".axis text")[i])
    }
    for (i = 0; i < $(".axis text").length; i++)
    {
        allElements.push($(".axis text")[i])
    }
    for (i = 0; i < $(".axis path").length; i++)
    {
        allElements.push($(".axis path")[i])
    }

    for (i = 0; i < $(".background path").length; i++)
    {
        allElements.push($(".background path")[i])
    }

    for (i = 0; i < $(".foreground path").length; i++)
    {
        allElements.push($(".foreground path")[i])
    }


    // alert(allElements);
    var i = allElements.length;
    while (i--) {
        explicitlySetStyle(allElements[i]);
    }

    canvg()


    html2canvas($("#ae-dash"), {
        onrendered: function (canvas) {
            theCanvas = canvas;
            var src = Canvas2Image.saveAsPNG(canvas, true);
            $.ajax({
                url: baseurl + "/ajax.php?canvas2image=1",
                type: 'POST',
                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_header.png',
                success: function (data) {
                    html2canvas($(".rtt-content-header"), {
                        onrendered: function (canvas) {
                            theCanvas = canvas;
                            var src = Canvas2Image.saveAsPNG(canvas, true);
                            $.ajax({
                                url: baseurl + "/ajax.php?canvas2image=1",
                                type: 'POST',
                                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_summary.png',
                                success: function (data) {
                                    html2canvas($("#section1"), {
                                        onrendered: function (canvas) {
                                            theCanvas = canvas;
                                            var src = Canvas2Image.saveAsPNG(canvas, true);
                                            $.ajax({
                                                url: baseurl + "/ajax.php?canvas2image=1",
                                                type: 'POST',
                                                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_section1.png',
                                                success: function (data) {
                                                    html2canvas($("#section2"), {
                                                        onrendered: function (canvas) {
                                                            theCanvas = canvas;
                                                            var src = Canvas2Image.saveAsPNG(canvas, true);
                                                            $.ajax({
                                                                url: baseurl + "/ajax.php?canvas2image=1",
                                                                type: 'POST',
                                                                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_section2.png',
                                                                success: function (data) {
                                                                    html2canvas($("#section3"), {
                                                                        onrendered: function (canvas) {
                                                                            theCanvas = canvas;
                                                                            var src = Canvas2Image.saveAsPNG(canvas, true);
                                                                            $.ajax({
                                                                                url: baseurl + "/ajax.php?canvas2image=1",
                                                                                type: 'POST',
                                                                                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_section3.png',
                                                                                success: function (data) {
                                                                                    html2canvas($("#section4"), {
                                                                                        onrendered: function (canvas) {
                                                                                            theCanvas = canvas;
                                                                                            var src = Canvas2Image.saveAsPNG(canvas, true);
                                                                                            $.ajax({
                                                                                                url: baseurl + "/ajax.php?canvas2image=1",
                                                                                                type: 'POST',
                                                                                                data: 'image=' + src + '&imageName=rtt' + $(".seesion_id").val() + '_section4.png',
                                                                                                success: function (data) {
                                                                                                    if (from != 'iframe')
                                                                                                    {
                                                                                                        form.submit();
                                                                                                    }
                                                                                                }
                                                                                            });

                                                                                        }
                                                                                    });
                                                                                }
                                                                            });

                                                                        }
                                                                    });
                                                                }
                                                            });

                                                        }
                                                    });
                                                    //form.submit();
                                                }
                                            });

                                        }
                                    });
                                }
                            });
                        }
                    });

                }
            });

        }
    });



}

//renderSpcecialitiesChart(sepcialitiesChartDataString, chartWidth);
function renderSpcecialitiesChart(datas1, chartWidth) {
    var margin = {top: 120, right: 70, bottom: 10, left: 10},
    width = chartWidth - margin.left - margin.right,
            height = 320 - margin.top - margin.bottom;

    var x = d3.scale.ordinal().rangePoints([0, width], 1),
            y = {},
            dragging = {};

    var line = d3.svg.line(),
            axis = d3.svg.axis().orient("left"),
            background,
            foreground;
    line.interpolate("monotone");
    var svg = d3.select("#specialitiesChart").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


    // Extract the list of dimensions and create a scale for each.
    /*
     x.domain(dimensions = d3.keys(datas1[0]).filter(function(d) {
     return d != "name" && (y[d] = d3.scale.linear()
     .domain(d3.extent(datas1, function(p) {
     return +p[d];
     }))
     .range([height, 0]));
     }));*/
    // 100 % domain
    x.domain(dimensions = d3.keys(datas1[0]).filter(function (d) {
        return d != "name" && (y[d] = d3.scale.linear()
                .domain([0, 100])
                .range([height, 0]));
    }));

    // Add grey background lines for context.
    background = svg.append("g")
            .attr("class", "background")
            .selectAll("path")
            .data(datas1)
            .enter().append("path")
            .attr("d", path);

    // Add blue foreground lines for focus.
    foreground = svg.append("g")
            .attr("class", "foreground")
            .selectAll("path")
            .data(datas1)
            .enter().append("path")
            .attr("stroke", function (d) {
                return rttColorArray[d.name];
            })
            .attr("d", path);
    var path2 = foreground;

    var totalLength = '4000';
    path2
            .attr("stroke-dasharray", totalLength + " " + totalLength)
            .attr("stroke-dashoffset", totalLength)

            .attr("stroke-dashoffset", 0);


    // Add a group element for each dimension.
    var g = svg.selectAll(".dimension")
            .data(dimensions)
            .enter().append("g")
            .attr("class", "dimension")
            .attr("transform", function (d) {
                return "translate(" + x(d) + ")";
            })
            .call(d3.behavior.drag()
                    .origin(function (d) {
                        return {x: x(d)};
                    })
                    .on("dragstart", function (d) {
                        dragging[d] = x(d);
                        background.attr("visibility", "hidden");
                    })
                    .on("drag", function (d) {
                        dragging[d] = Math.min(width, Math.max(0, d3.event.x));
                        foreground.attr("d", path);
                        dimensions.sort(function (a, b) {
                            return position(a) - position(b);
                        });
                        x.domain(dimensions);
                        g.attr("transform", function (d) {
                            return "translate(" + position(d) + ")";
                        })
                    })
                    .on("dragend", function (d) {
                        delete dragging[d];
                        transition(d3.select(this)).attr("transform", "translate(" + x(d) + ")");
                        transition(foreground).attr("d", path);
                        background
                                .attr("d", path)
                                .transition()
                                .delay(500)
                                .duration(0)
                                .attr("visibility", null);
                    }));

    // Add an axis and title.
    g.append("g")
            .attr("class", "axis")
            .each(function (d) {
                d3.select(this).call(axis.scale(y[d]));
            })
            .append("text")
            .style("text-anchor", "right")
            .attr("transform", "rotate(-40)")
            .attr("y", -5)
            .attr("x", 5)
            .attr("class", "color")
            .text(function (d) {
                return d;
            });

    // Add and store a brush for each axis.
    g.append("g")
            .attr("class", "brush")
            .each(function (d) {
                d3.select(this).call(y[d].brush = d3.svg.brush().y(y[d]).on("brushstart", brushstart).on("brush", brush));
            })
            .selectAll("rect")
            .attr("x", -8)
            .attr("width", 16);

    function position(d) {
        var v = dragging[d];
        return v == null ? x(d) : v;
    }

    function transition(g) {
        return g.transition().duration(500);
    }

// Returns the path for a given data point.
    function path(d) {
        return line(dimensions.map(function (p) {
            return [position(p), y[p](d[p])];
        }));
    }

    function brushstart() {
        d3.event.sourceEvent.stopPropagation();
    }

// Handles a brush event, toggling the display of foreground lines.
    function brush() {
        var actives = dimensions.filter(function (p) {
            return !y[p].brush.empty();
        }),
                extents = actives.map(function (p) {
                    return y[p].brush.extent();
                });
        foreground.style("display", function (d) {
            return actives.every(function (p, i) {
                return extents[i][0] <= d[p] && d[p] <= extents[i][1];
            }) ? null : "none";
        });
    }
}
