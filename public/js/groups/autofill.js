// replace capital letter and space
$("#name").keyup(function(){
    var str = $('#name').val();
	str = str.replace(/\s+/g, '-').toLowerCase();
	$("#slug").val(str);
})