jQuery(document).ready(function($){
    $('#check_all_wards').on('click',function(){
        if(this.checked){
            $('.ward_list').each(function(){
                this.checked = true;
            });
        }else{
             $('.ward_list').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.ward_list').on('click',function(){
        if($('.ward_list:checked').length == $('.group_list').length){
            $('#check_all_wards').prop('checked',true);
        }else{
            $('#check_all_wards').prop('checked',false);
        }
    });

	$('#delete_all').click(function(evnt){
        evnt.preventDefault();
        var ids = [];
        var token_element = document.getElementsByName('_token');
        var form_token = $(token_element).val();
        if($('.ward_list:checked').length>0)
        {
    		$('.ward_list:checked').each(function(index, value){
    			ids[index] = $(value).val();
            });
            //****************** ajax code started ******************//
    		$.ajax({
    			method: "POST",
    			url: "ward/delete-all",
    			data: {'ids': ids, '_token':form_token }
    		})
    		.done(function( msg ) {
    			if(msg == "true"){
                    location.reload();
                }
		    });
        }
        else
        {
            alert("Please select a row")
        }

            
       
	});
        
});