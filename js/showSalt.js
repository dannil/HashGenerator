$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        if($(this).attr("value")==="salt"){
            $("#salt").toggle();
        }
    });
});