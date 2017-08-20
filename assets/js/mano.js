$(function() {
    $( "#datepicker1" ).datepicker({
        showAnim: "slide",
        dateFormat:"yy-mm-dd",
        altField: "#datepicker1",
        monthNames: [ "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis" ],
        dayNamesMin: [ "S", "Pr", "A", "T", "K", "P", "Š" ],
        nextText: "Sekantis",
        prevText: "Ankstesnis",
        showOtherMonths: true,
        changeMonth:true,
        monthNamesShort: [ "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis" ],
        numberOfMonths: [1,3],
        firstDay: 1,
        defaultDate: '-2m',
        stepMonths: 3,
    });
});

$(function() {
    $( "#datepicker2" ).datepicker({
        showAnim: "slide",
        dateFormat:"yy-mm-dd",
        altField: "#datepicker2",
        monthNames: [ "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis" ],
        dayNamesMin: [ "S", "Pr", "A", "T", "K", "P", "Š" ],
        nextText: "Sekantis",
        prevText: "Ankstesnis",
        changeMonth:true,
        monthNamesShort: [ "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis" ],
        numberOfMonths: [1,3],
        firstDay: 1,
        defaultDate: '-2m',
        stepMonths: 3,
    });
});


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
