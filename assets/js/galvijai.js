$(document).ready(function(){
    //KINTAMIEJI
    var ukininkas, metai, menesis;
    var laikotarpis = 0, rinktis = 0;

    var pr_metai, pr_menesis;
    //URL kur kreiptis AJAX
    var url = "aprasymas";

    var Va_Laikotarpis_pasarai = $("#laikotarpis_pasarai");
    var Va_Laikotarpis_meslas = $("#laikotarpis_meslas");
    var Va_Laikotarpis_ganyklos = $("#laikotarpis_ganyklos");

    //paimam php reiksmes ikeltas i INPUT, jie bus priskirti kai pasirenki, nauja kategorija
    pr_metai = $("#metai").val();
    pr_menesis = $("#menesis").val();
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
    $('#ukininkas, #metai, #menesis').change(function() {
        if(url === "aprasymas" || url === "nustatymai"){}else{
            uzklausa();
        }

        //cia reik sutvarkyti, kad keiciant metus, ukininka neissivalytu laikotarpis
        if($('select[name=menesis]').val() != ""){
            Va_Laikotarpis_pasarai.val('');
            laikotarpis = 0;
        }
        if($('select[name=menesis]').val() != ""){
            Va_Laikotarpis_meslas.val('');
            laikotarpis = 0;
        }
        if($('select[name=menesis]').val() != ""){
            Va_Laikotarpis_ganyklos.val('');
            laikotarpis = 0;
        }
    });

    //jei pasirenkam, laikotarpi, issivalo menesio INPUT
    //jei pasirenkam, menesi, issivalo laikotarpio INPUT
    Va_Laikotarpis_pasarai.change( function(){
        if($('select[name=laikotarpis_pasarai]').val() != 0){
            uzklausa();
            $('#menesis').val('');
        }else{
            $('#menesis').val(pr_menesis);
        }
    });

    Va_Laikotarpis_meslas.change( function(){
        if($('select[name=laikotarpis_meslas]').val() != 0){
            uzklausa();
            $('#menesis').val('');
        }else{
            $('#menesis').val(pr_menesis);
        }
    });

    Va_Laikotarpis_ganyklos.change( function(){
        if($('select[name=laikotarpis_ganyklos]').val() != 0){
            uzklausa();
            $('#menesis').val('');
        }else{
            $('#menesis').val(pr_menesis);
        }
    });

//////////////////////////////////////////////////////////////////////// GALVIJU JUDEJIMAS //////////////////////////////////////////////////////
    //galviju sarasas
    $('#galviju_sarasas').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        url = "galviju_sarasas";
        uzklausa();
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
    });

    //suformuojama lentele su galviju judejimu
    $('#galviju_judejimas').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        url = "galviju_judejimas";
        uzklausa();
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
    });
////////////////////////////////////////////////////////////////////////// DUOMENU IKELIMAS IS VIC.lT /////////////////////////////////////////////
    //atidarom sub-meniu
    $('#viclt').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        $('#in_viclt').toggle();
        $("#in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
        $("#data").html("");
        url = "tuscias";
    });

    //vykdom duomenu ikelima is vic.lt
    $('#ikelti_viclt').on('click', function() {
        url = "ikelti_viclt";
        uzklausa();
        url = "tuscias";
    });

    //triname duomenis
    $('#istrinti_viclt').on('click', function() {
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
            .one('click', '#delete', function() {
                url = "istrinti_viclt";
                uzklausa();
                url = "tuscias";
            });
    });

//////////////////////////////////////////////////////////////// PASARU APSKAICIAVIMAS /////////////////////////////////////
    //atidarom sub-meniu
    $('#skaiciuoti_pasarus').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        $('#in_skaiciuoti_pasarus').toggle();
        $("#in_viclt, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
        $("#data").html("");
        url = "tuscias";
    });

    //pasaru skaiciavimas
    $('#pasarai').on('click', function() {
        url = "skaitciuoti_pasarus";
        uzklausa();
        url = "tuscias";
        //$("#in_viclt").hide();
    });
////////////////////////////////////////////////////////////////////////////// PRIESVORIS ////////////////////////////////////////////////////////////////
    //priesvorio skaiciavimas
    $('#priesvoris').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        url = "skaiciuoti_priesvori";
        uzklausa();
        //url = "tuscias";
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
    });

//////////////////////////////////////////////////////////////////////////////// MESLAS /////////////////////////////////////////////////////////////////////////
    //atidarom sub-meniu
    $('#skaiciuoti_meslus').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        $('#in_skaiciuoti_meslus').toggle();
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_ganykliniai_pasarai, #in_nustatymai").hide();
        $("#data").html("");
        url = "tuscias";
    });

    //meslo skaiciavimas
    $('#meslas').on('click', function() {
        url = "skaiciuoti_meslus";
        uzklausa();
        url = "tuscias";
        //$("#in_viclt, #in_skaiciuoti_pasarus").hide();
    });

////////////////////////////////////////////////////////////////////////////// GANYKLINIAI PASARAI /////////////////////////////////////////////////////////////
    //atidarom sub-meniu
    $('#ganykliniai_pasarai').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        $('#in_ganykliniai_pasarai').toggle();
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_nustatymai").hide();
        $("#data").html("");
        url = "tuscias";
    });

    //meslo skaiciavimas
    $('#ganyklos').on('click', function() {
        url = "ganykliniai_pasarai";
        uzklausa();
        url = "tuscias";
        //$("#in_viclt, #in_skaiciuoti_pasarus").hide();
    });

////////////////////////////////////////////////////////////////////////////// NUSTATYMAI ///////////////////////////////////////////////////////////////////////
    //atidarom sub-meniu
    $('#nustatymai').on('click', function() {
        $('#metai').val(pr_metai);
        $('#menesis').val(pr_menesis);
        $('#in_nustatymai').toggle();
        $("#in_viclt, #in_skaiciuoti_pasarus, #in_skaiciuoti_meslus, #in_ganykliniai_pasarai").hide();
        $("#data").html("");
        url = "nustatymai";
    });

    //triname duomenis
    $('#pasaru_normos').on('click', function() {
        $('#pasaru_normos_langas').modal({
            backdrop: 'static',
            keyboard: false
        })
            .one('click', '#delete', function() {
                url = "istrinti_viclt";
                uzklausa();
                url = "tuscias";
            });
    });

///////////////////////////////////////////////////////////////////////////// FUNKCIJOS /////////////////////////////////////////////////////////////////////////
    //siunciam pagrindinius duomenis, ukininkas, metai, menesis
    function uzklausa(){
        ukininkas = $("#ukininkas").val();
        metai = $("#metai").val();
        menesis = $("#menesis").val();
        if(Va_Laikotarpis_pasarai.val() !== ""){
            laikotarpis = Va_Laikotarpis_pasarai.val();}
        if(Va_Laikotarpis_meslas.val() !== ""){
            laikotarpis = Va_Laikotarpis_meslas.val();}
        if(Va_Laikotarpis_ganyklos.val() !== ""){
            laikotarpis = Va_Laikotarpis_ganyklos.val();}
        rinktis = $("#rinktis").val();
        $.post(url, {
            ukininkas: ukininkas,
            metai: metai,
            menesis: menesis,
            laikotarpis: laikotarpis,
            rinktis: rinktis},
            function(result) {
                $("#data").html(result);
            });
    }


});