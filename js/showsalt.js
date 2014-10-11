$(document).ready(function() {
    $('input[type="checkbox"]').click(function(){
        if($(this).attr("name") === "saltCheckbox") {
            $("#salt").toggle();
        }
    });
});