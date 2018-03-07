$(document).ready(function(){
    //KINTAMIEJI
    var metai, menesis;
    var pr_metai, pr_menesis;
    //URL kur kreiptis AJAX
    var url = "aprasymas";

    //uzsikrauna puslapis parodoma ir informacija.
    uzklausa();

    //Animacija, atnaujinat duomenis
    $(document).ajaxStart(function(){
        $("#loading").show();
    });
    $(document).ajaxComplete(function(){
        $("#loading").hide();
    });

    //pasirenkus ukininka, metus ar menesi, turi uzsikrauti informacija
    $('#metai, #menesis').change(function() {
        if(url === "aprasymas" || url === "nustatymai"){}else{
            uzklausa();
        }
    });


////////////////////////////////////////////////////////////////////////// SASKAITU IKELIMAS/////////////////////////////////////////////
    //atidarom sub-meniu
    $('#saskaitas_ikelti').on('click', function() {
        //$('#metai').val(pr_metai);
        //$('#menesis').val(pr_menesis);
        $('#in_saskaitas_ikelti').toggle();
        $("").hide();
        $("#data").html("");
        url = "tuscias";
    });


///////////////////////////////////////////////////////////////////////////// FUNKCIJOS /////////////////////////////////////////////////////////////////////////
    //siunciam pagrindinius duomenis, ukininkas, metai, menesis
    function uzklausa(){
        metai = $("#metai").val();
        menesis = $("#menesis").val();
        $.post(url, {
            metai: metai,
            menesis: menesis},
            function(result) {
                $("#data").html(result);
            });
    }

});