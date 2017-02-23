jQuery(document).ready(function($){
	$("#top-menu-wrapper").hide();
	$(".navbar-brand").click(function(){
		$("#top-menu-wrapper").fadeToggle("fade");
	});
})