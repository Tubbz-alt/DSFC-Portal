jQuery('document').ready(function(){	

	//bar chart
var base_url = window.location.origin;
        // Ward G // All wards
        
        jQuery.ajax({
        method: "GET",
        url: base_url+"/dashboard/json-ward-all",
        dataType: "json",
        success:function( msg ) {
	var chart = c3.generate({
		bindto: '#wardG',
	    size: {
	        height: 200,
	        width: 200
	    },
	    padding: {
	        top: 0,
	    },
	    data: {
	         columns: [  ['Open - Occupied',msg.graphdata.Occupied],
                        ['Open - Empty',msg.graphdata.Empty],
                     ],
	        mimeType: 'json',
	        type : 'donut'
	    },
	    color: {
            pattern: ['#1950A9', '#FEFEFE'],
        },
	    legend: {
	        show: false
	    },
	    tooltip: {
            show: false
        },
	    donut: {
	        title: msg.title+"%",
	        width: 30,
	        expand: false,
	        label: {
			    show: false
			}
	    }
	});
	}
});

	
});