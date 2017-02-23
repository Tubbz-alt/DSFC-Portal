jQuery('document').ready(function(){

	var base_url = window.location.origin;

	// Non Admitted Performance Chart

	jQuery.ajax({
		method: "GET",
		url: base_url+"/dashboard/rtt/non-admitted-default-data",
		dataType: "json"
	})
	.done(function( msg ) {

		var chart = c3.generate({
			bindto: '#non-admitted-performance-chart',
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
					categories: ['Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'March'],
				}
			},
			grid: {
				y: {
					lines: [
					{value: 0.70, show: 'true', class: 'grid80'},
					{value: 0.90, class: 'grid90'}
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
	},
	});

	});

	// Non Admitted Penalty Chart


	jQuery.ajax({
		method: "GET",
		url: base_url+"/dummy/data.json",
		dataType: "json"
	})
	.done(function( msg ) {
		var chart = c3.generate({
			bindto: '#non-admitted-penalty-chart',
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

	// Non Admitted YTD Chart

	jQuery.ajax({
		method: "GET",
		url: base_url+"/dashboard/rtt/ytd-for-month-non-admitted",
		dataType: "json"
	})
	.done(function( msg ) {
		var chart = c3.generate({
			bindto: '#non-admitted-ytd-chart',
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