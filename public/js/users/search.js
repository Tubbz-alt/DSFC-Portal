jQuery(document).ready(function($){
	
	//*** highlight keyword //****
	var keyword = $("#search").val();
	$(".table").highlight(keyword, false);
});