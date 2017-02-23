//read metadata
var fname = "../../js/ane/data/A&E Live Data v1.0 - A&E Data.csv";
var tohideobjects1 ="";
var tohideobjects2 ="";
var tohideobjects3 ="";
var tohideobjects4 ="";

//change key names per the requirements.docx dated December 2, 2015
//order by node name
//have an entry for every column we want to keep, even if it's not being renamed
var renameKeys = [
        //would like to include hour of arrival, but can't order them
        //also distorts field.
        {orig: "ARRIVAL_MODE_DESC", new: "Arrival"},
        {orig: "ARRV_DTTM", new: "Arrival Time"},
        {orig: "TRIAGE_CAT_CODE", new: "Triage"},
        {orig: "LOS_Hour_Bands", new: "Hours"},
        {orig: "BREACH_REASON_DESC", new: "Breach Reason"},
        {orig: "DISP_METH_DESC", new: "Disposed"},
        {orig: "REFTO_SPEC_DESC", new: "Specialty"},
        {orig: "4_Hours_Breach_Flag", new: "BreachFlag"}
    ],

    nodeKeys = pluck(renameKeys, "new");

//note: the order in the documents allow us to easily construct the arrays of labels
//if the order switches, then these will have to change

//These are the labels used for the sankey nodes
var labels = nodeKeys.slice(0, nodeKeys.length - 1);
//these are the column labels for the table
var tableColumns = labels;
//note: with the current sample size, this would probably be fine as just function(d) {return d}
format = function (d) {
    return d3.format(",0f")(d)
};

//create Initial DOM
var margin = {top: 10, right: 10, bottom: 10, left: 10};
margin.width = 1000 - margin.left - margin.right;
margin.height = 300 - margin.top - margin.bottom;

var svg = initialize({selector: ".d3_app#chart", x: 0, y: 0, tooltip: 1, geom: margin});

var jsonUrl = 'last15-hour-flow-data';
//capture data
d3.json(jsonUrl, function (err, data) {
    if (err) throw "Error reading " + fname + ": " + err;

    //d3.select("h3").text("Report: "+moment(findLastTime(data)).format('MMMM Do YYYY h:mm a'))
    $('.loader-bg').hide();
    data.forEach(function (d) {
        renameKeys.forEach(function (pair) {
            switchKeyNames(d, pair)
        })
    });

    //will want to have a category
    //data = keepKeys(data,nodeKeys) //eliminate the keys that are not used in the chart or table
    //.map(fixValues);

    //stash this data so the highlighting can reverse through it to find the appropriate paths
    d3.select(".d3_app").datum(data);

    //draws the sankey
    plotSankey({svg: svg, background: 1}, mkSankeyData(data, margin));


    //add the labels for the columns
    //TODO this will need to be programmed better because the positions are hard-coded
    /*d3.select("g#chart").selectAll(".labeling")
     .data(nodeKeys.slice(0,nodeKeys.length-1)).enter()
     .append("g").classed("labeling",1)
     .attr("transform",function(d,i) {return d=="Disposed"?"translate("+(160*i)+",297)":"translate("+(160*i)+",278)"})
     .append("text")
     .text(function(d) {return d})
     //TODO this is a style issue that will change programmatically? How should it be handled better?
     .attr({"dy":function(d) {return d=="Disposed"?"-0.3em":"1.5em"}})
     .attr({"dx":function(d) {return d=="Arrival"?"1em":""}})
     .style({
     "font-size":"0.6em",
     "text-anchor":function(d,i) {return i==(nodeKeys.length-2)?"end":"middle"},
     })*/

    //sets up the table
    mkTable2(".d3_app.table", tableColumns, data);
    mkPrintButton();

    //called when the radio buttons are changed
    toggleBehavior({svg: svg, background: 1, margin: margin}, data);


    //turn on highlighting behavior & click behavior
    d3.selectAll(".link .main").on({
        "mouseenter": highlighton,
        "mouseleave": highlightoff,
            "click": linkfilter
    });

    d3.selectAll(".node rect").on({
        "mouseenter": boxHighlighton,
        "mouseleave": highlightoff,
        "click": nodefilter
    });

    //functions
    function mkTable2(selector, K, data) {
        var oTable = $(selector).DataTable({
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: "A_E Data"
                }
            ],
            columns: K.map(function (d) {
                return {"title": d}
            }),
            data: data.map(function (d) {
                return K.map(function (k) {
                    return d[k]
                })
            }),
            dom: 'Blfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            pageLength: -1
        });
        var reset = d3.select(".dataTables_length").append("p").append("button").datum(-1)
            .append("text")
            .text(" Reset table");
        reset.on("click", function () {
            clearTable(".d3_app.table", tableColumns, d3.select(".d3_app").datum(), d3.select(this).datum());
        });
        d3.select("select").style("background", "#ccc");
    }

    function boxHighlighton() {
        var tempdata = d3.select(".d3_app").datum(),
            filter = d3.select(this).datum(),
            subset = tempdata.filter(function (d) {
                return d[filter.stype] == filter.name
            });
        var S = d3.selectAll(".d3_app .link").filter(function (d) {
            delete d.sz
            var sz = subset.filter(function (datum) {
                return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
            })
                .length;
            if (sz > 0) {
                d.sz = sz * d.dy / d.value;
            }
            return sz > 0
        });
        //   S.select(".main").style("stroke-opacity",0.5);
        S.select(".highlighter")
            .attr({
                "d": function (d) {
                    return newlink(d)
                }
            })
            .style({
                "stroke-width": function (d) {
                    return d.sz
                },
                "stroke-opacity": 0.75,
                "stroke": "black"
            });

    }

    function clearTable(selector, K, data, pageLength) {
        var table = $(selector).DataTable()
        table.clear().draw();

        var J = data.map(function (d) {
            var row = [];
            K.forEach(function (k) {
                row.push(d[k]);
            });
            return row
        });
        T = table;
        table.rows.add(J);
        table.page.len(pageLength).draw();
    }

    function fixValues(d) {
        var ArrivalLabels = {0: "overnight (12 am - 8 am)", 8: "daytime (8 am - 4 pm)", 16: "evening (4 pm - 12 am)"};
        d["Arrival Time"] = ArrivalLabels[Math.floor(+d["Arrival Time"].split(" ")[1].split(":")[0] / 8) * 8];

        if (d["Arrival"].match("Ambulance")) d["Arrival"] = "Ambulance"
        else d["Arrival"] = "Self";

        if (d["Triage"] == "z    ") d["Triage"] = "Not set";
        else if (d["Triage"] == "PRIME") d["Triage"] = "Primary";
        else if (d["Triage"].slice(0, 3) == "Maj") d["Triage"] = "Major"
        else if (d["Triage"].slice(0, 3) == "Min") d["Triage"] = "Minor"
        else if (d["Triage"] == "IMMED") d["Triage"] = "Major";

        d["Hours"] = d["Hours"].replace(/_/g, " ").replace("Hours", "Hrs")
        //       if (d["Movement"] =="Not Set") d["Movement"] = "-";
        if (d["Hours"][0] != "G") d["Breach Reason"] = "no breach";
        else {
            d["Hours"] = "Breach";
            if (d["Breach Reason"].trim() == "") d["Breach Reason"] = "Not set";
            if (d["Breach Reason"][0] == "V") d["Breach Reason"] = d["Breach Reason"].split(" ").slice(2).join(" ");
            if (d["Breach Reason"].match("Bed")) {
                d["Breach Reason"] = d["Breach Reason"]
                    .replace("Medical", "")
                    .replace("monitor", "")
                    .replace(" cardiac ", "cardiac")
                    .replace(/\(\)/, "")
            }
            d["Breach Reason"] = d["Breach Reason"].replace("Assessment", "Ax");
            d["Breach Reason"] = d["Breach Reason"].replace("1st", "First");
        }
        d["Disposed"] = d["Disposed"].replace("Streamed to", "")
        if (d["Specialty"] == "") d["Specialty"] = "Not set"
        return d
    }

    function highlighton() {
        var tempdata = d3.select(".d3_app").datum(),
            filter = d3.select(this).datum(),
            subset = tempdata.filter(function (d) {
                return d[filter.stype] == filter.source.name && d[filter.ttype] == filter.target.name
            });

        var S = d3.selectAll(".d3_app .link").filter(function (d) {
            delete d.sz;
            var sz = subset.filter(function (datum) {
                return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
            })
                .length;
            if (sz > 0) {
                d.sz = sz * d.dy / d.value;
            }
            return sz > 0
        });
        //   S.select(".main").style("stroke-opacity",0.5);
        S.select(".highlighter")
            .attr({
                "d": function (d) {
                    return newlink(d)
                }
            })
            .style({
                "stroke-width": function (d) {
                    return d.sz
                },
                "stroke-opacity": 0.75,
            });
    }

    function highlightoff() {
        d3.selectAll(".d3_app .link .main").style({"stroke-opacity": 0.2});
        d3.selectAll(".d3_app .link .highlighter").style("stroke-width", 0);


        if(tohideobjects1!="" && tohideobjects2 !="") {

            var tempdata = tohideobjects1,
                filter = tohideobjects2,
                subset = tempdata.filter(function (d) {
                    return d[filter.stype] == filter.source.name && d[filter.ttype] == filter.target.name
                });

            var S = d3.selectAll(".d3_app .link").filter(function (d) {
                delete d.sz;
                var sz = subset.filter(function (datum) {
                    return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
                })
                    .length;
                if (sz > 0) {
                    d.sz = sz * d.dy / d.value;
                }
                return sz > 0
            });
            //   S.select(".main").style("stroke-opacity",0.5);
            S.select(".highlighter")
                .attr({
                    "d": function (d) {
                        return newlink(d)
                    }
                })
                .style({
                    "stroke-width": function (d) {
                        return d.sz
                    },
                    "stroke-opacity": 0.75,
                });

        }


        if(tohideobjects3!="" && tohideobjects4 !="") {

            var tempdata = tohideobjects3,
                filter = tohideobjects4,
                subset = tempdata.filter(function (d) {
                    return d[filter.stype] == filter.name
                });
            var S = d3.selectAll(".d3_app .link").filter(function (d) {
                delete d.sz
                var sz = subset.filter(function (datum) {
                    return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
                })
                    .length;
                if (sz > 0) {
                    d.sz = sz * d.dy / d.value;
                }
                return sz > 0
            });
            //   S.select(".main").style("stroke-opacity",0.5);
            S.select(".highlighter")
                .attr({
                    "d": function (d) {
                        return newlink(d)
                    }
                })
                .style({
                    "stroke-width": function (d) {
                        return d.sz
                    },
                    "stroke-opacity": 0.75,
                    "stroke": "black"
                });

        }

    }






























    function keepKeys(arr, keepers) {
        var keySet = d3.keys(arr[0]);
        keySet.forEach(function (key) {
            if (keepers.indexOf(key) == -1) {
                arr.forEach(function (d) {
                    delete d[key]
                });
            }
        });
        return arr;
    }

    function linkfilter() {
        d3.event.stopPropagation();
        var tempdata = d3.select(".d3_app").datum(),
            filter = d3.select(this).datum(),
            subset = tempdata.filter(function (d) {
                return d[filter.stype] == filter.source.name && d[filter.ttype] == filter.target.name
            });
        clearTable(".d3_app.table", tableColumns, subset, -1);

        tohideobjects1       =   tempdata;
        tohideobjects2       =   filter;

        tohideobjects3       =   "";
        tohideobjects4       =   "";

        d3.selectAll(".d3_app .link .main").style({"stroke-opacity": 0.2});
        d3.selectAll(".d3_app .link .highlighter").style("stroke-width", 0);



        var S = d3.selectAll(".d3_app .link").filter(function (d) {
            delete d.sz;
            var sz = subset.filter(function (datum) {
                return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
            })
                .length;
            if (sz > 0) {
                d.sz = sz * d.dy / d.value;
            }
            return sz > 0
        });

        S.select(".highlighter")
            .attr({
                "d": function (d) {
                    return newlink(d)
                }
            })
            .style({
                "stroke-width": function (d) {
                    return d.sz
                },
                "stroke-opacity": 0.75,
            });
    }

    function mkSankeyData(data, geom) {
        d3.sankey = function () {
            var sankey = {},
                nodeWidth = 12,
                nodePadding = 10,
                nodes = [],
                links = [];

            sankey.nodeWidth = function (_) {
                if (!arguments.length) return nodeWidth;
                nodeWidth = +_;
                return sankey;
            };

            sankey.nodePadding = function (_) {
                if (!arguments.length) return nodePadding;
                nodePadding = +_;
                return sankey;
            };

            sankey.nodes = function (_) {
                if (!arguments.length) return nodes;
                nodes = _;
                return sankey;
            };

            sankey.links = function (_) {
                if (!arguments.length) return links;
                links = _;
                return sankey;
            };

            sankey.size = function (_) {
                if (!arguments.length) return size;
                size = _;
                return sankey;
            };

            sankey.layout = function (iterations) {
                computeNodeLinks();
                computeNodeValues();
                computeNodeBreadths();
                computeNodeDepths(iterations);
                computeLinkDepths();
                return sankey;
            };

            sankey.relayout = function () {
                computeLinkDepths();
                return sankey;
            };

            sankey.link = function () {
                var curvature = 0.5;

                function link(d) {
                    var x0 = d.source.x + d.source.dx,
                        x1 = d.target.x,
                        xi = d3.interpolateNumber(x0, x1),
                        x2 = xi(curvature),
                        x3 = xi(1 - curvature),
                        y0 = d.source.y + d.sy + d.dy / 2,
                        y1 = d.target.y + d.ty + d.dy / 2;
                    return "M" + x0 + "," + y0
                        + "C" + x2 + "," + y0
                        + " " + x3 + "," + y1
                        + " " + x1 + "," + y1;
                }

                link.curvature = function (_) {
                    if (!arguments.length) return curvature;
                    curvature = +_;
                    return link;
                };

                return link;
            };

            // Populate the sourceLinks and targetLinks for each node.
            // Also, if the source and target are not objects, assume they are indices.
            function computeNodeLinks() {
                nodes.forEach(function (node) {
                    node.sourceLinks = [];
                    node.targetLinks = [];
                });

                links.forEach(function (link, i) {
                    var source = link.source,
                        target = link.target;
                    if (typeof source === "number") source = link.source = nodes[link.source];
                    if (typeof target === "number") target = link.target = nodes[link.target];
                    source.sourceLinks.push(link);
                    target.targetLinks.push(link);
                });
            }

            // Compute the value (size) of each node by summing the associated links.
            function computeNodeValues() {
                nodes.forEach(function (node) {
                    node.value = Math.max(
                        d3.sum(node.sourceLinks, value),
                        d3.sum(node.targetLinks, value)
                    );
                });
            }

            // Iteratively assign the breadth (x-position) for each node.
            // Nodes are assigned the maximum breadth of incoming neighbors plus one;
            // nodes with no incoming links are assigned breadth zero, while
            // nodes with no outgoing links are assigned the maximum breadth.
            function computeNodeBreadths() {
                var remainingNodes = nodes,
                    nextNodes,
                    x = 0;

                while (remainingNodes.length) {
                    nextNodes = [];
                    remainingNodes.forEach(function (node) {
                        node.x = x;
                        node.dx = nodeWidth;
                        node.sourceLinks.forEach(function (link) {
                            nextNodes.push(link.target);
                        });
                    });
                    remainingNodes = nextNodes;
                    ++x;
                }

                //
                moveSinksRight(x);

                //TODO
                scaleNodeBreadths((960 - nodeWidth) / (x - 1));
            }

            function moveSourcesRight() {
                nodes.forEach(function (node) {
                    if (!node.targetLinks.length) {
                        node.x = d3.min(node.sourceLinks, function (d) {
                                return d.target.x;
                            }) - 1;
                    }
                });
            }

            function moveSinksRight(x) {
                nodes.forEach(function (node) {
                    if (!node.sourceLinks.length) {
                        node.x = x - 1;
                    }
                });
            }

            function scaleNodeBreadths(kx) {
                nodes.forEach(function (node) {
                    node.x *= kx;
                });
            }

            function computeNodeDepths(iterations) {
                nodesByBreadth = d3.nest()
                    .key(function (d) {
                        return d.x;
                    })
                    .sortKeys(d3.ascending)
                    .entries(nodes)
                    .map(function (d) {
                        return d.values;
                    });


                initializeNodeDepth();
                resolveCollisions();
                for (var alpha = 1; iterations > 0; --iterations) {
                    relaxRightToLeft(alpha *= .99);
                    resolveCollisions();
                    relaxLeftToRight(alpha);
                    resolveCollisions();
                }

                function initializeNodeDepth() {
                    var ky = d3.min(nodesByBreadth, function (nodes) {
                        return (size[1] - (nodes.length - 1) * nodePadding) / d3.sum(nodes, value);
                    });

                    nodesByBreadth.forEach(function (nodes) {
                        nodes.forEach(function (node, i) {
                            node.y = i;
                            node.dy = node.value * ky;
                        });
                    });

                    links.forEach(function (link) {
                        link.dy = link.value * ky;
                    });
                }

                function relaxLeftToRight(alpha) {
                    nodesByBreadth.forEach(function (nodes, breadth) {
                        nodes.forEach(function (node) {
                            if (node.targetLinks.length) {
                                var y = d3.sum(node.targetLinks, weightedSource) / d3.sum(node.targetLinks, value);
                                node.y += (y - center(node)) * alpha;
                            }
                        });
                    });

                    function weightedSource(link) {
                        return center(link.source) * link.value;
                    }
                }

                function relaxRightToLeft(alpha) {
                    nodesByBreadth.slice().reverse().forEach(function (nodes) {
                        nodes.forEach(function (node) {
                            if (node.sourceLinks.length) {
                                var y = d3.sum(node.sourceLinks, weightedTarget) / d3.sum(node.sourceLinks, value);
                                node.y += (y - center(node)) * alpha;
                            }
                        });
                    });

                    function weightedTarget(link) {
                        return center(link.target) * link.value;
                    }
                }

                function resolveCollisions() {
                    nodesByBreadth.forEach(function (nodes) {
                        var node,
                            dy,
                            y0 = 0,
                            n = nodes.length,
                            i;

                        // Push any overlapping nodes down.
                        nodes.sort(ascendingDepth);
                        for (i = 0; i < n; ++i) {
                            node = nodes[i];
                            dy = y0 - node.y;
                            if (dy > 0) node.y += dy;
                            y0 = node.y + node.dy + nodePadding;
                        }

                        // If the bottommost node goes outside the bounds, push it back up.
                        dy = y0 - nodePadding - size[1];
                        if (dy > 0) {
                            y0 = node.y -= dy;

                            // Push any overlapping nodes back up.
                            for (i = n - 2; i >= 0; --i) {
                                node = nodes[i];
                                dy = node.y + node.dy + nodePadding - y0;
                                if (dy > 0) node.y -= dy;
                                y0 = node.y;
                            }
                        }
                    });
                }

                function ascendingDepth(a, b) {
                    return b.y - a.y;
                }
            }

            function computeLinkDepths() {
                nodes.forEach(function (node) {
                    node.sourceLinks.sort(ascendingTargetDepth);
                    node.targetLinks.sort(ascendingSourceDepth);
                });
                nodes.forEach(function (node) {
                    var sy = 0, ty = 0;
                    node.sourceLinks.forEach(function (link) {
                        link.sy = sy;
                        sy += link.dy;
                    });
                    node.targetLinks.forEach(function (link) {
                        link.ty = ty;
                        ty += link.dy;
                    });
                });

                function ascendingSourceDepth(a, b) {
                    return a.source.y - b.source.y;
                }

                function ascendingTargetDepth(a, b) {
                    return a.target.y - b.target.y;
                }
            }

            function center(node) {
                return 0;
            }

            function value(link) {
                return link.value;
            }

            return sankey;
        };

        var sank = {nodes: [], links: []};
        for (var i = 1; i < labels.length; i++) {
            var links = mkLink(labels[i - 1], labels[i], data);
            sank.nodes.push(links.map(function (l) {
                return {name: l.key, stype: labels[i - 1]}
            }));
            links.forEach(function (link) {
                sank.links.push(link.values.map(function (leaf) {
                    return {
                        source: link.key,
                        stype: labels[i - 1],
                        target: leaf.key,
                        ttype: labels[i],
                        value: leaf.values
                    }
                }));
            });
        }

        //create the last set of nodes
        links = mkLink(labels[labels.length - 1], labels[0], data);
        sank.nodes.push(links.map(function (l) {
            return {name: l.key, stype: labels[labels.length - 1]}
        }));

        sank.nodes = d3.merge(sank.nodes);
        sank.links = d3.merge(sank.links);
        var nodehash = sank.nodes.map(function (d) {
            return d.name + "_" + d.stype
        });

        sank.links.forEach(function (link) {
            link.source = nodehash.indexOf(link.source + "_" + link.stype);
            link.target = nodehash.indexOf(link.target + "_" + link.ttype);
        });
        sank.nWidth = 10;

        sank.path = d3.sankey()
            .nodeWidth(sank.nWidth)
            .nodePadding(10)
            .size([geom.width, geom.height - 20])
            .nodes(sank.nodes)
            .links(sank.links)
            .layout(1) //don't worry about reiterating on optimal solution; choose faster
            .link();

        return sank
        function mkLink(key1, key2, data) {
            return d3.nest()
                .key(function (d) {
                    return d[key1]
                })
                .sortKeys(d3.ascending)
                .key(function (d) {
                    return d[key2]
                })
                .sortKeys(d3.ascending)
                .rollup(function (leaves) {
                    return leaves.length || 1e-6
                })
                .entries(data);
        }
    }

    function nodefilter() {
        d3.event.stopPropagation();
        var tempdata = d3.select(".d3_app").datum(),
            filter = d3.select(this).datum(),
            subset = tempdata.filter(function (d) {
                return d[filter.stype] == filter.name
            });
        clearTable(".d3_app.table", tableColumns, subset, -1);

        tohideobjects3       =   tempdata;
        tohideobjects4       =   filter;

        tohideobjects1       =   "";
        tohideobjects2       =   "";

        d3.selectAll(".d3_app .link .main").style({"stroke-opacity": 0.2});
        d3.selectAll(".d3_app .link .highlighter").style("stroke-width", 0);



        var S = d3.selectAll(".d3_app .link").filter(function (d) {
            delete d.sz;
            var sz = subset.filter(function (datum) {
                return datum[d.stype] == d.source.name && datum[d.ttype] == d.target.name
            })
                .length;
            if (sz > 0) {
                d.sz = sz * d.dy / d.value;
            }
            return sz > 0
        });
        tohideobjects       =   S;
        S.select(".highlighter")
            .attr({
                "d": function (d) {
                    return newlink(d)
                }
            })
            .style({
                "stroke-width": function (d) {
                    return d.sz
                },
                "stroke-opacity": 0.75,
            });



    }

    function newlink(d) {
        var x0 = d.source.x + d.source.dx,
            x1 = d.target.x,
            xi = d3.interpolateNumber(x0, x1),
            x2 = x3 = xi(0.5),
            y0 = d.source.y + d.sy + d.dy / 2,
            y1 = d.target.y + d.ty + d.dy / 2;
        return "M" + x0 + "," + y0
            + "C" + x2 + "," + y0
            + " " + x3 + "," + y1
            + " " + x1 + "," + y1;
    }

    //add a button to pdf the visualization
    function mkPrintButton() {
        d3.select(".dt-buttons a").html("<i class = 'fa fa-file-excel-o fa-2x'></i>")
        d3.select(".dt-buttons").insert("a", "a")
            .html("<i class = 'fa fa-file-pdf-o fa-2x'></i>")
        d3.select(".fa-file-pdf-o").on("click", printit);
    }

    function reorderValues(label) {
        console.log(sankey);
    }

    function plotSankey(obj, sankey) {
        sankey.links.forEach(function (s) {
            s.linkname = s.source.name + "_" + s.target.name
        });

        //define the svg paths that link the nodes
        var link = obj.svg.selectAll(".link")
            .data(sankey.links, function (d) {
                return d.stype + d.linkname + d.type
            });

        link.exit().remove();


        linkE = link.enter().append("g")
            .classed("link", 1);

        linkE.append("path")
            .classed("main", 1)
            .attr({"d": sankey.path})
            .style("stroke-width", function (d) {
                return Math.max(1, d.dy);
            });

        linkE.append("path")
            .classed("highlighter", 1);

        link.select("path.main")
            .transition().duration(500)
            .attr("d", sankey.path)
            .style("stroke-width", function (d) {
                return Math.max(1, d.dy);
            });


        linkE.append("title")

        link.select("title")
            .text(function (d) {
                return d.source.name.trim() + " =>" + d.target.name.trim() + ": " + format(d.value);
            });

        d3.selectAll(".link").sort(function (a, b) {
            return b.dy - a.dy;
        });

        //define the nodes
        var node = obj.svg.selectAll(".node")
            .data(sankey.nodes, function (d) {
                return d.stype + d.name
            });

        node.exit().remove();

        var nodeE = node.enter().append("g")
            .classed("node", 1)
            .attr("transform", function (d) {
                return "translate(" + d.x + "," + d.y + ")"
            });

        node.transition().duration(500)
            .attr("transform", function (d) {
                return "translate(" + d.x + "," + d.y + ")"
            });

        nodeE.append("rect")
            .classed("nodebox", 1)
            //note:1 see css for colors by id  tag
            .attr("id", function (d) {
                var name = d.name;
                if (isFinite(name[0])) name = "n" + name;
                return name.replace(/\.|\/|-|\(|\)|\s/g, "")
            })
            .attr({
                "height": function (d) {
                    return d.dy;
                },
                "width": sankey.nWidth
            })
            .append("title")
            .text(function (d) {
                return d.name + ": " + format(d.value);
            });

        node.select("rect.nodebox")
            .classed("nodebox", 1)
            .attr({
                "height": function (d) {
                    return d.dy;
                },
                "width": sankey.nWidth
            });

        node.select("rect.nodebox").select("title")
            .text(function (d) {
                return d.name + ": " + format(d.value);
            });

        nodeE.append("text")
            .attr({
                "x": function (d) {
                    return (d.x < 490) ? 10 : 0
                },
                "dx": function (d) {
                    return (d.x < 490) ? 1 : -1
                },
                "y": function (d) {
                    return d.dy / 2
                },
                "dy": ".35em",
                "transform": null,
                "text-anchor": function (d) {
                    return d.x < 490 ? "start" : "end"
                }
            })
            .text(function (d) {
                return d.name;
            });

        node.select("text")
            .attr({
                "y": function (d) {
                    return d.dy / 2
                }
            });
        d3.selectAll(".node").moveToFront();

    }

    function printit() {
        var n = d3.select("#chart").node();
        d3.select(".table-responsive").style("display", "none")
        window.print();
        d3.select(".table-responsive").style("display", "block")
    }

    function switchKeyNames(d, keys) {
        if (keys.new != keys.orig)
            d[keys.new] = d[keys.orig];
    }

    function toggleBehavior(obj, data) {
        d3.selectAll("input[type=radio").on("change", function () {
            var newdata = data;
            if (d3.select("input[value='UEI']").property("checked"))
                newdata = newdata.filter(function (d) {
                    return d["Inspection Type"] == "UEI"
                });
            if (d3.select("input[value='CCIP']").property("checked"))
                newdata = newdata.filter(function (d) {
                    return d["Inspection Type"] == "CCIP"
                });

            if (d3.select("input[value='Primary']").property("checked"))
                newdata = newdata.filter(function (d) {
                    return d["Root Cause Type"] == "Primary"
                });
            if (d3.select("input[value='Contributing']").property("checked"))
                newdata = newdata.filter(function (d) {
                    return d["Root Cause Type"] == "Contributing"
                });

            d3.select(".d3_app").datum(newdata);
            d3.selectAll(".link").style("display", "block");
            plotSankey(obj, mkSankeyData(newdata, obj.margin));
            clearTable(".d3_app.table", tableColumns, newdata, -1);
        })
    }

});//d3.csv callback


function pluck(arr, key) {
    return arr.map(function (d) {
        return d[key]
    });
}

function findLastTime(data) {
    var lastTime = new Date(0);
    data.forEach(function (d) {
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

function initialize(obj) {
    svg = d3.select(obj.selector).append("svg")
        .attr({"viewBox": "0 0 " + obj.geom.width + " " + obj.geom.height})
        .append("g")
        .attr({
            "id": "chart",
            "transform": "translate(" + obj.geom.left + "," + obj.geom.top + ")"
        });
    if (obj.x) svg.append("g")
        .classed({"x": 1, "axis": 1});
    if (obj.y) svg.append("g")
        .classed({"y": 1, "axis": 1});

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
}


d3.selection.prototype.moveToFront = function () {
    return this.each(function () {
        this.parentNode.appendChild(this);
    });
};


