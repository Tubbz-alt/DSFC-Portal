jQuery(document).ready(function($){
// **************success message bag timeout// **************
	$('#success').delay(3000).slideUp(300);
	setTimeout( "jQuery('.loader-bg').hide();",2000 );
	window.onload = function() {
		
		setInterval(
			function pageLoad() {
				var host = window.location.host;
				$.ajax({
					type: 'get',
					async: false,
					url: (host == '134.213.154.56')? host+'/ibox/public/dashboard/common/pageload':host+'/dashboard/common/pageload',
					success: function () {
						console.log('success');
					},
					timeout: 3000
				});
			},
			5 * 60 * 1000
		);
	}

/*	$('#topmenu ul li a').click(function(e){
		e.preventDefault();
		$('#topmenu ul li').removeClass("is-active");
		var title = $(this).attr('data-title');
		var ref = $('#topmenu ul li');
		if(title)
		{
			if((title == 'User Logs List') || (title=='Page Logs List')|| (title=='Search Logs')|| (title=='Patient Detail') ||(title=='User Clicks Details'))
			{
				$(this).addClass("is-active");
			}else if(title=='Board Round')
			{
				$(this).addClass("is-active");
			}
			else if(title=='Help Field List')
			{
				$(this).addClass("is-active");
			}
			else if(title=='Down Time')
			{
			$(this).addClass("is-active");
			}
			else if(title=='Ward List')
			{
				$(this).addClass("is-active");
			}
			else if(title=='Group List')
			{
				$(this).addClass("is-active");
			}
			else if(title=='Patient List')
			{
				$(this).addClass("active");
			}
		}


	});*/

});
