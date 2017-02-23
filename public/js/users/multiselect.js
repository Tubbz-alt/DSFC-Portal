//multiselect
$(function () {
            $('#roles').multiselect({
                includeSelectAllOption: true
            });
});

$(function () {
            $('#wards').multiselect({
                includeSelectAllOption: true
            });
});

$(function () {
    $('#permission').multiselect({
        includeSelectAllOption: true
    });
});
$(function () {
    $('#permission_create').multiselect({
        includeSelectAllOption: true
    });
});

/*Data challenge */
$(function () {
            $('#challenge_category').multiselect({
                 includeSelectAllOption: true,
                 nonSelectedText: 'Challenge Category',
            });
});
$(function () {
            $('#challenge_category_tab').multiselect({
                 includeSelectAllOption: true,
                 nonSelectedText: 'Challenge Category',
            });
});
$(function () {
            $('.cds_filter_date').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'CDS Date',
           

               
            });
});

$(function () {
    $('.division_nhs').multiselect({
        includeSelectAllOption: true,
        nonSelectedText: 'Division',



    });
});

$(function () {
    $('.speciality_nhs').multiselect({
        includeSelectAllOption: true,
        nonSelectedText: 'Speciality',



    });
});

$(function () {
            $('#checked_date').multiselect({
                includeSelectAllOption: true,
                nonSelectedText:'',
                buttonClass: 'down'
            });
});


/*Data challenge */

/*Data challenge */
$(function () {
    $('#category_commissioner').multiselect({
        includeSelectAllOption: true,
        nonSelectedText: 'Challenge Category',
    });
});

/*Missing Nhs */
$(function () {
    $('#category_wrong_gp').multiselect({
        includeSelectAllOption: true,
        nonSelectedText: 'Challenge Category',
    });
});

