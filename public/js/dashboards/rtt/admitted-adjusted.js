jQuery('document').ready(function () {

    var base_url = window.location.origin;

    jQuery.ajax({
            method: "GET",
            url: base_url + "/dashboard/rtt/admitted-adjusted-default-data",
            dataType: "json"
        })
        .done(function (msg) {

            var admitted = c3.generate({
                bindto: '#admitted-adj-performance-chart',
                size: {
                    height: 325,
                    width: 580
                },
                data: {
                    json: msg,
                    colors: {
                        '2013-14': '#2062C4',
                        '2014-15': '#ff7f0e'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        categories: ['Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'March']
                    }
                },
                grid: {
                    y: {
                        lines: [
                            {value: 0.80, show: 'true', class: 'line_red'},
                            {value: 0.85, show: 'true', class: 'line_amber'},
                            {value: 0.90, show: 'true', class: 'line_green'}
                        ]
                    }
                },
                tooltip: {
                    grouped: false,

                    format: {
                        value: function (value, ratio, id) {
                            var format = id === 'data1' ? d3.format(',') : d3.format('%');
                            return format(value);
                        }
//            value: d3.format(',') // apply this format to both y and y2
                    }
                },
                legend: {
                    show: true,
                    position: 'inset',
                    inset: {
                        anchor: 'top-right',
                        x: 0,
                        y: 0,
                        step: 5
                    }
                }
            });
        });

// Admitted Adjusted Performance Chart

// Admitted Adjusted Penalty

    jQuery.ajax({
            method: "GET",
            url: base_url + "/dummy/data.json",
            dataType: "json"
        })
        .done(function (msg) {
            var chart = c3.generate({
                bindto: '#admitted-adj-penalty-chart',
                size: {
                    height: 325,
                    width: 580
                },
                data: {
                    json: msg,
                    type: 'bar',
                    colors: {
                        '2013-14': '#2062C4',
                        '2014-15': '#ff7f0e'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        categories: ['Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'March'],
                    }
                },
                bar: {
                    width: {
                        ratio: 0.5
                    }
                },
                tooltip: {
                    grouped: false,
                },
                legend: {
                    show: true,
                    position: 'inset',
                    inset: {
                        anchor: 'top-right',
                        x: 0,
                        y: 0,
                        step: 5
                    }
                },
            });
        });

    // Admitted Adjusted YTD
    jQuery.ajax({
            method: "GET",
            url: base_url + "/dashboard/rtt/ytd-for-month-admitted",
            dataType: "json"
        })
        .done(function (msg) {
            var chart = c3.generate({
                bindto: '#admitted-adj-ytd-chart',
                data: {
                    json: msg,
                    type: 'bar',
                    colors: {
                        '2013-14': '#2062C4',
                        '2014-15': '#ff7f0e'
                    }
                },
                bar: {
                    width: {
                        ratio: 0.3
                    }
                },
                tooltip: {
                    grouped: false,
                },
                legend: {
                    show: true,
                    position: 'inset',
                    inset: {
                        anchor: 'top-right',
                        x: 0,
                        y: 0,
                        step: 5
                    }
                },

            });

        });
});