jQuery(document).ready(function($){
	$('.side-filter-box1').on('click', ".filter-box.open", function(e) {
        jQuery(".side-filter-box1").animate({
			left: '-330px'
			}, 1000);
			$(this).addClass('closed');
		$(this).removeClass('open');	
    });	
	$('.side-filter-box1').on('click', ".filter-box.closed", function(e) {
        jQuery(".side-filter-box1").animate({
			left: 0
			}, 1000);
		$(this).addClass('open');
		$(this).removeClass('closed');	
    });
});