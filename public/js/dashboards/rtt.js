jQuery(document).ready(function ($) {
    $('.side-filter-box').on('click', ".filter-box.open", function (e) {
        jQuery(".side-filter-box").animate({
            left: '-160px'
        }, 1000);
        $(this).addClass('closed');
        $(this).removeClass('open');
    });
    $('.side-filter-box').on('click', ".filter-box.closed", function (e) {
        jQuery(".side-filter-box").animate({
            left: 0
        }, 1000);
        $(this).addClass('open');
        $(this).removeClass('closed');
    });
    jQuery(".btn-filter").on('click', function(e){
        e.preventDefault();
        var i=0;
        jQuery("input[name='start_date[]']:checked").each(function(index, element){
            i++;
        });
        if(i!=2)
        {
            alert('Select exact 2 years');
        }
        else {
            document.getElementById('filter_form').submit();
        }
    });

    jQuery(".cog-widget-outer .glyphicon").on('click', function(e){
        $(".cog-widget").toggle('slow');
    });
});