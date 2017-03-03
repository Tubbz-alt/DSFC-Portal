jQuery('document').ready(function () {

    var base_url = window.location.origin;

// Incomplete Performance Chart

    // Incomplete Penalty

    jQuery.ajax({
            method: "GET",
            url: base_url + "/dummy/data.json",
            dataType: "json"
        })
        .done(function (msg) {
            var chart = c3.generate({
                bindto: '#incomplete-penalty-chart',
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

    // Incomplete YTD
    jQuery.ajax({
            method: "GET",
            url: base_url + "/dashboard/rtt/ytd-for-month-incomplete",
            dataType: "json"
        })
        .done(function (msg) {
            var chart = c3.generate({
                bindto: '#incomplete-ytd-chart',
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