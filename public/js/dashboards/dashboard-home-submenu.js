jQuery(document).ready(function($){
	 $("a.dash-bord-main-link").on('click', function(e) {
		e.preventDefault();
		var classPart=$(this).attr('data-name');
		if(jQuery(".sub-cover-"+classPart).hasClass('active'))
		{
			jQuery(".dash-bord-sub-menu-cover").hide('slow');
			jQuery(".sub-cover-"+classPart).removeClass('active');
		}
		else
		{
			jQuery(".dash-bord-sub-menu-cover").removeClass('active');
			jQuery(".dash-bord-sub-menu-cover").hide('slow');
			jQuery(".sub-cover-"+classPart).addClass('active');
			jQuery(".sub-cover-"+classPart).show('slow');
		}
    });
});