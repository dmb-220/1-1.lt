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
});
