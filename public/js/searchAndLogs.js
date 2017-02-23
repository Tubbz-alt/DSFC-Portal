
$(document).ready(function () {

    $('#errormsg').hide();
    $('.loadimg').hide();
    
    $('#detailedrecord').hide();

    var pagetitle = document.title;
    var tok = $('#tok').val();
    $.ajax({
        url: "/dashboard/common/pagelogs",
        type: 'POST',
        dataType: 'json',
        data: {"pagetitle": pagetitle, "_token": tok},
        success: function (data) {
            console.log('success');
        }
    });
    // for patient search functionality images/loading-detail.gif {{url("dashboard/common/patientsearch")
    $("#searchbtn").click(function () {
        var searchword = $('#searchdata').val();
        if (searchword != '') {
            $('.loadimg').show();
            $('.tableBody').html('<span class="image-loader"><img src=" url(images/loading-detail.gif)"></span>');
            $.ajax({
                url: "/dashboard/common/patientsearch",
                data: 'searchdata=' + searchword,
                success: function (msg) {
                    $('#errormsg').hide();
                    $('.loadimg').hide();
                    $('#searchresults').show();
                    //$('#detailedrecord').hide();
                    $('#searchresults').html(msg);
                }
            });
        } else {
            $('#errormsg').show();
            $('#searchresults').hide();
            $('#errormsg').html(' * The search box must be filled!');
        }
    });
});

function divDetails(id) {
    var recordid = id;
    if (recordid > 0) {
        $.ajax({
            url: "dashboard/common/patientdetail",
            data: 'id=' + recordid,
            success: function (msg) {
              //  $('#searchresults').hide();
                $('#detailedrecord').show();
                 $('#detailedrecord1').html(msg);
            }
        });
    }
}
