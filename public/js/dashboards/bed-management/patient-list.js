jQuery(document).ready(function(e){


	

});

$(document).ready(function() {
    $('#arrowR').click(function(event) {
        
        event.preventDefault();
        $('#myDiv').animate({scrollLeft:'+=152'}, 'fast');        
    });
    $('#arrowL').click(function(event) {
        event.preventDefault();
        $('#myDiv').animate({scrollLeft:'-=152'}, 'fast');        
    });
});