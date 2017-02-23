
jQuery('document').ready(function(){	

	var chart = c3.generate({
		bindto: '#chart1',
		size: {
	        height: 350,
	        width: 550
	    },
	    padding: {
	        top: 50,
	        bottom: 30,
	    },
	    data: {
	        // columns: [
	        //     ['Open - Empty', 20, 30, 40],
	        //     ['Open - Occupied', 5, 10, 5]
	        // ],

	        // json: {
	        // 	"LAMU": {"Open - Empty":75,"Open - Occupied":30}
	        // 	"Kingfisher": {"Open - Empty":30,"Open - Occupied":32}
	        // 	"Jupiter": {"Open - Empty":31,"Open - Occupied":22}
	        // }


	        json: {
	        	"Open - Empty": [20, 30, 40],
	            "Open - Occupied": [5, 10, 5]
	        },

	        // url: 'convert-json',
        	// mimeType: 'json',

	        type: 'bar',
	        
	        colors: {
	            'Open - Empty': '#6FA9DA',
	            'Open - Occupied': '#3882D5',
	        },
	    },
	    legend: {
	    		position: 'right'
	    },
	    axis: {
	        x: {
	            type: 'category',
	            categories: ['LAMU', 'Kingfisher', 'Jupiter'],
	        },
	        y: {
				tick: {
					// values: [10, 20, 30, 40, 50],
					count: 5,
					color: {
						pattern: ['#008AD6']
					}
				}
			}
	    },
	    bar: {
	        width: {
	            ratio: 0.60 // this makes bar width 50% of length between ticks
	        }
	    },
	    grid: {
	        y: {
	            lines: [{value:0}]
	        }
	    }
	});
});


