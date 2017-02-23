
//read metadata
var fname = "data/A&E Data v1.0 - A&E Data.csv",
    timeFormat = d3.time.format("%Y-%m-%d %H:%M:%S"),
    colors = {0:"#009933",1:"#009933",2:"#ffff00",3:"#ff6600",4:"#003300",5:"#003300",6:"#003300"},
    duration = 500;

//create Initial DOM
var margin = {top: 9, right: 10, bottom: 9, left: 10};
margin.width = 1024 - margin.left - margin.right;
margin.height = 300 - margin.top - margin.bottom;
var svg = initialize({selector:"#d3_app", x:1, y:0, tooltip:1,geom:margin});

    svg.append("rect")
        .classed("border",1)
        .attr({
            "width":1002,
            "height":600,
            "rx":10,
            "ry":10
        })
        .style({
            "stroke":"black",
            "fill":"none"
        });


time1Scale = d3.scale.linear()
    .range([100,1000])
    .domain([0,8]);
//fill in the domain of the data once the file is read in
time2Scale = d3.time.scale()
    .range([100,1000]);


svg.select(".x.axis").attr({"transform":"translate(0,570)"})
    .call(d3.svg.axis()
        .scale(time1Scale)
        .tickValues(d3.range(0,8))
        );

svg.append("text").text("Elapsed Hours:")
    .attr("id","test")
    .attr("transform","translate(10,575)")
    .style("font-size","75%");

row = svg.selectAll(".row")
    .data(["Arrived","Triaged","Seen","Treated"])
    .enter().append("g")
    .classed("row",1)
    .attr({
        "id": function (d) {
            return d
        },
        "transform": function (d, i) {
            return "translate(0," +83 * i + ")"
        }
    });
row.append("text")
    .text(function(d) {return d})
    .attr("transform",function(d,i) {return "translate(10,41)"});

row.append("line")
    .attr({
        "x1":0,
        "x2":1002,
        "y1":82,
        "y2":82
    })
    .style("stroke","black");

d3.select("#tooltip").on("click",function() {
    d3.select(this).style({
        "display":"none",
        "opacity":1e-6
    });
})

var jsonUrl='bubble-data';

d3.json(jsonUrl,function(err,data) {
    if (err) throw err;
    var lastTime = findLastTime(data),
        firstTime = findFirstTime(data);
    time2Scale.domain([firstTime,lastTime]);

    d3.select("h3")
        .datum(lastTime)
        .text(moment(firstTime).format('MMM Do YYYY H:mm')+" - "+moment(lastTime).format('MMM Do YYYY H:mm'))
    $('.loader-bg').hide();
    timeDataset = [];
    //TODO CHECK THESE DEFINITIONS

    mkDeparted(data.filter(function(row) {return row["Still_in_AE"]==0}));
    data = data.filter(function(row) {return row["Still_in_AE"]==1});

    data.forEach(function(row,i) {
        obj = {
            start:timeFormat.parse(row.ARRV_DTTM),
            triageCat:(row.TRIAGE_CAT_CODE.match("Maj")||row.TRIAGE_CAT_CODE.match("IMMED"))?"Major":"Minor",
            ID:row.PATIENT_HOSP_ID
        };
        if (row.REFRL_DTTM) {
            obj.cat = "Treated";
            obj.time = timeFormat.parse(row.REFRL_DTTM);
        } else if (row.SEEN_DTTM) {
            obj.cat = "Seen";
            obj.time = timeFormat.parse(row.SEEN_DTTM);
        } else if (row.TRIAGE_DTTM) {
            obj.cat = "Triaged";
            obj.time = timeFormat.parse(row.TRIAGE_DTTM);
        } else {
            obj.cat = "Arrived";
            obj.time = timeFormat.parse(row.ARRV_DTTM);
        }
        timeDataset.push(obj);
    });
    T = timeDataset;
    var circles = row.selectAll(".patient").data(function(d) {
            return timeDataset.filter(function(info) {return info.cat==d})
            },function(d) {return d.ID});

        circles.enter().append("circle")
            .classed("patient",1)
            .attr({
                "r":5,
                "cx" :function(info) {return time1Scale((info.time-info.start)/(3600000))},
                "cy":function(info) {return info.triageCat=="Major"?20:60}
            })
            .style({
                "fill":function(info) {var hr = Math.floor((info.time-info.start)/3600000); hr = (hr<=6)?hr:hr; return colors[hr]}
            })
            .on("click",function() {
                d3.select("#tooltip")
                    .style({
                        "display":"block",
                        "opacity":1,
                        "top": d3.select(this).node().getBoundingClientRect().bottom+"px",
                        "left":d3.select(this).node().getBoundingClientRect().left+"px"
                    });
                d3.select("#tooltip .header1").text("Patient:");
                d3.select("#tooltip .header2").text("What specific information goes here?");
            });

        circles.transition().duration(duration)
            .attr({
                "cx" :function(info) {return time1Scale((info.time-info.start)/(3600000))},
                "cy":function(info) {return info.triageCat=="Major"?20:60}
                })
            .style({
                "fill":function(info) {var hr = Math.floor((info.time-info.start)/3600000); hr = (hr<=6)?hr:hr; return colors[hr]}
                });

    circles.exit().remove();



});

function findFirstTime(data) {
    var firstTime = new Date();
    data.forEach(function(d) {
        for (key in d) {
            if (key.match("DTTM")) {
                if(d[key]!=null) {
                    var t = new Date(d[key].replace(/-/g, "/"));
                    if (t < firstTime) {
                        firstTime = t
                    }
                }
            }
        }
    });
    return firstTime
}

function findLastTime(data) {
    var lastTime = new Date(0);
    data.forEach(function(d) {
        for (key in d) {
            if (key.match("DTTM")) {
                if(d[key]!=null) {
                    var t = new Date(d[key].replace(/-/g, "/"));
                    if (t > lastTime) {
                        lastTime = t
                    }
                }
            }
        }
    });
    return lastTime;
}

function mkDeparted(data) {
    var ystart = 249+82; var yend = ystart+200;
    svg.append("g")
        .attr({
            "id":"Departed",
            "transform":"translate(0,"+ystart+")"
        });

    d3.select("#Departed").append("text").text("Departed")
        .attr("transform","translate(10,15)");


    var lastTime = d3.select("h3").datum();
    var lastHr = lastTime.getHours()+lastTime.getDate()*24;
    data.forEach(function(row) {
        row.index = row.startDate * 24 + row.startHour;
        row.start = timeFormat.parse(row.ARRV_DTTM);
        row.time = timeFormat.parse(row.DISP_DTTM||row.clock_stop_dttm);
        if (!row.time) console.log(row)
        row.index = row.time.getDate()*24+row.time.getHours();
    });

     //sort the data by the hour they arrived
        nested = d3.nest().key(function(d) {return d.index})
            .entries(data)
            .filter(function(d) {return d.key>=lastHr-10});

    //TODO should check if any are missing and fill them in.

        depByHr = d3.select("#Departed").selectAll(".hour").data(nested,function(d) {return d.key});

        depByHr.enter().append("g")
            .classed("hour",1);

        depByHr.append("rect")
            .attr({
                "height":18,
                "width":1000
            })
            .style("fill",function(d,i) {return i%2?"#FFF":"#CCC"});

        depByHr.append("text")
            .attr({
                "x":10,
                "y":9,
                "alignment-baseline":"middle"
            })
            .style("font-size","75%")
            .text(function(d) {return d.values[0].time.getHours()+":00"});


        depByHr.selectAll("circle").data(function(d,i) {return d.values}).enter()
            .append("circle")
            .attr({
                "r":5,
                "cy":9,
                "cx":function(e) {return time1Scale((e.time-e.start)/3600000)}
            })
            .style({
                "fill":function(info) {var hr = ~~time1Scale.invert(+d3.select(this).attr("cx")); hr = (hr<=6)?hr:hr; return colors[hr]}
            });

        depByHr
            .attr("transform",function(d,i) {return "translate(0,"+(18*(i+1))+")"});

        depByHr.exit().remove();

}

function initialize(obj) {
    var svg = d3.select(obj.selector).append("svg")
            .attr({"viewBox":"0 0 1024 620"})
            .append("g")
            .attr({
                "id" : "chart",
                "transform" : "translate("+obj.geom.left+","+obj.geom.top+")"
            });
    if (obj.x) svg.append("g")
        .classed({"x":1,"axis":1});
    if (obj.y) svg.append("g")
        .classed({"y":1,"axis":1});
    if (obj.tooltip) {
        var tooltip = d3.select(obj.selector).append("div")
            .attr("id", "tooltip");

        ["header1", "header-rule", "header2"]
            .forEach(function (c) {
                tooltip.append("div")
                    .classed(c, 1);
            });
    }
    return svg
}//end initialize
