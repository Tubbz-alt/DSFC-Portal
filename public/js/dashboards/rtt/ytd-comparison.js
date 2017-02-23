/*jQuery('document').ready(function($){

    var base_url = window.location.origin;*/

    // admittedchart 2014
    /*jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-admitted",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                bindto: '#admittedchart14',
                data:{
                        columns: [
                            ['within_18_weeks',msg.data1.within_18_weeks],
                            ['above_18_weeks',msg.data1.above_18_weeks],
                        ],
                        mimeType: 'json',
                        type : 'donut',

                    },
                size: {
                    height: 90,
                    width: 100
                },

                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
        //            value: d3.format(',') // apply this format to both y and y2
                }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });



jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-non-admitted",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                bindto: '#nonadmittedchart14',
                data:{
                        columns: [
                            ['within_18_weeks',msg.data1.within_18_weeks],
                            ['above_18_weeks',msg.data1.above_18_weeks],
                        ],
                        mimeType: 'json',
                        type : 'donut',

                    },
                size: {
                    height: 90,
                    width: 100
                },

                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
        //            value: d3.format(',') // apply this format to both y and y2
                }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });

     */
/*
jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-admitted2",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                 bindto: '#admittedchart15',
                data:{
                        columns: [
                            ['within_18_weeks',msg.data1.within_18_weeks],
                            ['above_18_weeks',msg.data1.above_18_weeks],
                        ],
                        mimeType: 'json',
                        type : 'donut',

                    },
                size: {
                    height: 90,
                    width: 100
                },

                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
        //            value: d3.format(',') // apply this format to both y and y2
                }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });


jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-non-admitted2",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                bindto: '#nonadmittedchart15',
                data:{
                        columns: [
                            ['within_18_weeks',msg.data1.within_18_weeks],
                            ['above_18_weeks',msg.data1.above_18_weeks],
                        ],
                        mimeType: 'json',
                        type : 'donut',

                    },
                size: {
                    height: 90,
                    width: 100
                },

                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
        //            value: d3.format(',') // apply this format to both y and y2
                }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });


    jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-incomplete",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                bindto: '#nonechart14',
                data:{
                    columns: [
                        ['within_18_weeks',msg.data1.within_18_weeks],
                        ['above_18_weeks',msg.data1.above_18_weeks]
                    ],
                    mimeType: 'json',
                    type : 'donut'
                },
                size: {
                    height: 90,
                    width: 100
                },
                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
                        //            value: d3.format(',') // apply this format to both y and y2
                    }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });


    jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/avg-incomplete2",
        dataType: "json",
        success:function( msg ) {
            var chart = c3.generate({
                bindto: '#nonechart15',
                data:{
                    columns: [
                        ['within_18_weeks',msg.data1.within_18_weeks],
                        ['above_18_weeks',msg.data1.above_18_weeks]
                    ],
                    mimeType: 'json',
                    type : 'donut'
                },
                size: {
                    height: 90,
                    width: 100
                },
                legend: {
                    show : false
                },
                tooltip: {
                    grouped: false,

                    format: {

                        value: function (value, ratio, id) {

                            var format = id === 'data1' ? d3.format(',') : d3.format('');
                            return format(value);
                        }
                        //            value: d3.format(',') // apply this format to both y and y2
                    }
                },
                color: {
                    pattern: ['#D7EDF9', '#008AD6']
                },
                donut: {
                    title: msg.total,
                    width :10,


                    label: {
                        show :false
                    }
                }
            });
        }
    });

});
*/
//donetchart

jQuery('document').ready(function(){
    var base_url = window.location.origin;

    jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/rtt/ytd-comparison",
        dataType: "json",
        success:function( msg ) {
            var config = {
                type: 'doughnut',
                data: msg,
                options: {
                    responsive: true
                }
            };
            var ctx = document.getElementById("chart-area").getContext("2d");
            var myDoughnut = new Chart(ctx, config);
        }
        
    });
    
});

/*var base_url = window.location.origin;
// totalchart
jQuery.ajax({
    method: "GET",
    url: base_url+"/dashboard/rtt/total-chart",
    dataType: "json",
    success:function( msg ) {

        var chart = c3.generate({
            bindto: '#totalchart',

            data:{
                columns: [
                    ['within_18_weeks', msg.datasets.avg1],
                    ['above_18_weeks', msg.datasets.avg2]
                ],
                mimeType: 'json',
                type : 'pie'
            },

            color: {
                pattern: ['#D7EDF9', '#008AD6'],
            },
            legend: {
                position:'center'
            },
            tooltip: {
                grouped: false,

                format: {
                    value: function (value, ratio, id) {
                        var format = id === 'data1' ? d3.format(',') : d3.format('');
                        return format(value);
                    }
                    //            value: d3.format(',') // apply this format to both y and y2
                }
            },
            size: {
                height: 200,
                width:400

            },

            pie: {
                label: {

                    format: function (value,ratio,id) {
                        return d3.format('')(value);
                    }
                }
            }
        });
    }
});

*/