$(document).ready(function(){
    //KINTAMIEJI
    var ukininkas, metai, menesis;
    //URL kur kreiptis AJAX
    var url = "aprasymas";

    //uzsikrauna puslapis parodoma ir informacija
    uzklausa();

    //Animacija, atnaujinat duomenis
    $(document).ajaxStart(function(){
        $("#loading").show();
    });
    $(document).ajaxComplete(function(){
        $("#loading").hide();
    });

    //pasirenkus ukininka, metus ar menesi, turi uzsikrauti informacija
    $('#ukininkas, #metai, #menesis').change(function() {
        if(url != "aprasymas"){
            uzklausa();}
    });

//////////////////////////////////////////////////////////////////////// GALVIJU JUDEJIMAS //////////////////////////////////////////////////////
    //galviju sarasas
    $('#galviju_sarasas').click(function() {
        url = "galviju_sarasas";
        uzklausa();
        $("#in_viclt").hide();
    });

    //suformuojama lentele su galviju judejimu
    $('#galviju_judejimas').click(function() {
        url = "galviju_judejimas";
        uzklausa();
        $("#in_viclt").hide();
    });
////////////////////////////////////////////////////////////////////////// DUOMENU IKELIMAS IS VIC.lT /////////////////////////////////////////////
    //atidarom sub-meniu
    $('#viclt').click(function() {
        $('#in_viclt').toggle();
        //$('#apyvarta_show').hide()
        $("#data").html("");
    });

    //vykdom duomenu ikelima is vic.lt
    $('#ikelti_viclt').click(function() {
        url = "ikelti_viclt";
        uzklausa();
    });
    //triname duomenis
    $('#istrinti_viclt').click(function() {
        url = "istrinti_viclt";
        uzklausa();
    });

///////////////////////////////////////////////////////////////////////////// FUNKCIJOS //////////////////////////////////////////////////////////////////
    //siunciam pagrindinius duomenis, ukininkas, metai, menesis
    function uzklausa(){
        ukininkas = $("#ukininkas").val();
        metai = $("#metai").val();
        menesis = $("#menesis").val();
        $.post(url, {
                ukininkas: ukininkas,
                metai: metai,
                menesis: menesis},
            function(result) {
                $("#data").html(result);
            });
    }

});