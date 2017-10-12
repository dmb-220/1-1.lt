function PrintElem(elem) {
    Popup($(elem).html());
}

$(document).ready(function() {
    $(".add-more").click(function(){
        var html = $(".copy").html();
        $(".after-add-more").after(html);
    });

    $("body").on("click",".remove",function(){
        $(this).parents(".control-group").remove();
    });


    $('#is_check').change(function() {
        if($(this).is(":checked")) {$("#inp").show();} else {$("#inp").hide();}
    });

});

$(document).ready(function() {
    $('input[type=radio][name=operacija]').change(function() {
        if (this.value == '1') {
            $("#dot").show();
        }
        else if (this.value == '2') {
            $("#dot").show();
        }else{
            $("#dot").hide();
        }
    });
});
