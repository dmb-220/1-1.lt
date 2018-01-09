// Set the global configs to synchronous
$.ajaxSetup({
    async: false
});

//sutartties sablono sukurimas
$(document).ready(function(){
    $("#deklaracija").select2({
        placeholder: "Pasirinkite ...",
        theme: "bootstrap"
    });

    //Pirminiai dokumentai
    var dokumentai = [];
    //Darbuotojai
    var darbuotojai = [];
    //Galvijai
    var galvijai = [];
    //Deklaracija
    var deklaruota = [];

    //Bankai, Kreditai, Saskaitu planas ir t.t.
    var kita = [];

    var saskaita_menuo = 0, saskaita_metai = 0;
    var kuras_menuo = 0, kuras_metai = 0;
    var apsauga_menuo = 0, apsauga_metai = 0;
    var europa_menuo = 0, europa_metai = 0;

    var pirminiai_kiek=0, pirminiai_menuo=0, pirminiai_metai=0;
    var darb_2_kiekis=0, darb_2_menuo=0, darb_2_metai=0;
    var darb_kiekis=0, darb_menuo=0, darb_metai=0;
    var viso_menuo=0, viso_metai=0;
    var galvijai_menuo=0, galvijai_metai=0, galvijai_banda;
    var dek_menuo=0, dek_metai=0;
    var bankai_kiek=0, bankai_menuo=0, bankai_metai=0;
    var kreditai_kiek=0, kreditai_menuo=0, kreditai_metai=0;
    var deklaracija=[], deklaracija_menuo=0, deklaracija_metai=0;
    var judejimas_menuo = 0, judejimas_metai = 0;
    var nuolaida_menuo = 0, nuolaida_metai = 0;
    var dydis;

    var laukas = [];

    //nuskaitom JSON kainu failiuka
    $.getJSON("https://1-1.lt/assets/js/kainos.json", function (data) {
        var arrItems = [];
        $.each(data, function (index, value) {
            arrItems.push(value);
        });
        //nustatom reiksmes i tam tikrus kintamuosius
        darbuotojai = arrItems[0];
        dokumentai = arrItems[1];
        galvijai = arrItems[2];
        deklaruota = arrItems[3];
        kita = arrItems[4];
    });

    //FUNKCIJOS
    function deklaracija_darbuotojai_prideti() {
        //I deklaracijas iterpiam pasirinta forma
        $("#deklaracija").append('<option value="FR572_12" selected>FR572 x12</option>');
        $("#deklaracija").append('<option value="FR573" selected>FR573</option>');

    }

    function deklaracija_darbuotojai_pasalinti() {
        $("#deklaracija option[value='FR572_12']").remove();
        $("#deklaracija option[value='FR573']").remove();
    }

    //pasirenkam ukininka, redirect i php koda kuris nustatys pasirinkta ukininka
    $('#pasirinkti_ukininka').click(function(e) {
        e.preventDefault();
        var ukininkas = $("#ukininkas").val();
        window.location.href = "pasirinkti_ukininka/"+ukininkas;
    });

    //reik nustatytik koks ukio tipas: MAZAS, VIDUTINIS, DIDELIS
    var kiek = $("#galvijai_kiekis").val();
    if(kiek <= 50){dydis = 0;}else
        if(kiek > 50 && kiek <= 150 ){dydis = 1;}else
            if(kiek > 150){ dydis = 2;}


    //sukaiciuojam piminiu dokumentu ruosimo kaina, pagal pasirinktus duomenis
    $('#pirminiai').change(function() {
        pirminiai_kiek = $("#pirminiai").val();
        pirminiai_menuo = dokumentai[dydis].kaina*pirminiai_kiek
        pirminiai_metai = (dokumentai[dydis].kaina*pirminiai_kiek)*12;
        //skaiciuojam tik pirmini
        $('#pirminiai_metai').val(pirminiai_metai.toFixed(2)+' €');
        $('#pirminiai_menuo').val(pirminiai_menuo.toFixed(2)+' €');
    });

    //sukaiciuojam darbuotojus, ir ir kokiu
    $('#darbuotojai_2_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_2_menuo = (darbuotojai['be_vykdomu_rastu']*darb_2_kiekis)/12;
        darb_2_metai = darbuotojai['be_vykdomu_rastu']*darb_2_kiekis;
        //skaiciuojam darbuotojus be rastu
        $('#darbuotojai_2_metai').val(darb_2_metai.toFixed(2)+' €');
        $('#darbuotojai_2_menesis').val(darb_2_menuo.toFixed(2)+' €');

        //deklaracija darbuotoju, pagal ju kieki
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        deklaracija_menuo = 0;
        deklaracija_metai = 0;
        deklaracija = $("#deklaracija").val();
        $.each(deklaracija, function (index, value) {
            var kinta = value + '_kaina';
            if(value == "FR572_12" || value == "FR573"){
                deklaracija_menuo += (kita[kinta]/12)*darbas;
                deklaracija_metai += kita[kinta]*darbas;}else{
                    deklaracija_menuo += (kita[kinta]/12);
                    deklaracija_metai += kita[kinta];
            }
        });
        $('#deklaracija_metai').val(deklaracija_metai.toFixed(2)+' €');
        $('#deklaracija_menesis').val(deklaracija_menuo.toFixed(2)+' €');
    });

    $('#darbuotojai_kiekis').change(function() {
        darb_kiekis = $("#darbuotojai_kiekis").val();
        darb_menuo = (darbuotojai['vykdomi_rastai']*darb_kiekis)/12;
        darb_metai = darbuotojai['vykdomi_rastai']*darb_kiekis;
        //skaiciuojam darbuotojus su  rastais
        $('#darbuotojai_metai').val(darb_metai.toFixed(2)+' €');
        $('#darbuotojai_menesis').val(darb_menuo.toFixed(2)+' €');

        //deklaracija darbuotoju, pagal ju kieki
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        deklaracija_menuo = 0;
        deklaracija_metai = 0;
        deklaracija = $("#deklaracija").val();
        $.each(deklaracija, function (index, value) {
            var kinta = value + '_kaina';
            if(value == "FR572_12" || value == "FR573"){
            deklaracija_menuo += (kita[kinta]/12)*darbas;
            deklaracija_metai += kita[kinta]*darbas;}else{
                deklaracija_menuo += (kita[kinta]/12);
                deklaracija_metai += kita[kinta];
            }
        });
        $('#deklaracija_metai').val(deklaracija_metai.toFixed(2)+' €');
        $('#deklaracija_menesis').val(deklaracija_menuo.toFixed(2)+' €');
    });

    $('#is_darbininkai').change(function() {
        if($(this).is(":checked")) {
            $("#inp_darbininkai").show();
        } else {
            $("#inp_darbininkai").hide();
            darb_kiekis=0; darb_menuo=0; darb_metai=0;
            $('#darbuotojai_metai').val('');
            $('#darbuotojai_menesis').val('');
            $('#darbuotojai_kiekis').val('');
        }
    });

    $('#is_darbininkai_2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_darbininkai_2").show();
            deklaracija_darbuotojai_prideti();
        } else {
            $("#inp_darbininkai_2").hide();
            deklaracija_darbuotojai_pasalinti();
            darb_2_kiekis=0; darb_2_menuo=0; darb_2_metai=0;
            $('#darbuotojai_2_metai').val('');
            $('#darbuotojai_2_menesis').val('');
            $('#darbuotojai_2_kiekis').val('');

            $("#inp_darbininkai").hide();
            darb_kiekis=0; darb_menuo=0; darb_metai=0;
            $("#is_darbininkai").prop( "checked", false );
            $('#darbuotojai_metai').val('');
            $('#darbuotojai_menesis').val('');
            $('#darbuotojai_kiekis').val('');
        }
    });

    //duomenys i INPUT paduodami is PHP, todel apskaiciuoja uzsikraunant puslapiui
    //skaiciujam gyvulinkystes kaina
    //nusistatom kiek galviju ir kokia kaina pagal kieki
    //masyvas = $.grep(galvijai, function (idx) {
        //return idx.kiekis >= kiek;
    //});
    //masyvas = masyvas[0];

    //skaiciuojam deklaruota plota
    var plotas = $("#dek_plotas").val();
    laukas = $.grep(deklaruota, function (idx) {
        return idx.kiekis >= plotas;
    });
    laukas = laukas[0];

    console.log(galvijai[dydis]);

    //paimam reiksme kokia bandos tipas
    galvijai_banda = $('input[name=banda]:checked').val();

    //pagal bandos tipa, skaiciuoja kaina
    if(galvijai_banda == 2){
        galvijai_menuo = (galvijai[dydis].ne_melziamos*kiek)/12;;
        galvijai_metai = galvijai[dydis].ne_melziamos*kiek;
        dek_menuo = (laukas.parduodantys*plotas)/12;
        dek_metai = laukas.parduodantys*plotas;
    }
    if(galvijai_banda == 1){
        galvijai_menuo = (galvijai[dydis].melziamos*kiek)/12;
        galvijai_metai = galvijai[dydis].melziamos*kiek;
        dek_menuo = (laukas.savo_reikmems*plotas)/12;
        dek_metai = laukas.savo_reikmems*plotas;
    }
    if(galvijai_banda == 3){
        galvijai_menuo = (((galvijai[dydis].ne_melziamos + galvijai[dydis].melziamos)*kiek)/2)/12;
        galvijai_metai = ((galvijai[dydis].ne_melziamos + galvijai[dydis].melziamos)*kiek)/2;
        dek_menuo = (((laukas.parduodantys + laukas.savo_reikmems)/2)*plotas)/12;
        dek_metai = (((laukas).parduodantys + laukas.savo_reikmems)/2)*plotas;
    }

    //sukelia gyvulinkystes sumas
    $('#galvijai_menesis').val(galvijai_menuo.toFixed(2) + ' €');
    $('#galvijai_metai').val(galvijai_metai.toFixed(2) + ' €');
    $('#dek_menesis').val(dek_menuo.toFixed(2)+ ' €');
    $('#dek_metai').val(dek_metai.toFixed(2) + ' €');

    //Bankai, kreditai
    $('#bankai').change(function() {
        bankai_kiek = $("#bankai").val();
        bankai_menuo = bankai_kiek*kita.bankas;
        bankai_metai= (bankai_kiek*kita.bankas)*12;
        $('#bankai_menesis').val(bankai_menuo.toFixed(2) + ' €');
        $('#bankai_metai').val(bankai_metai.toFixed(2) + ' €');
    });
    $('#kreditai').change(function() {
        kreditai_kiek = $("#kreditai").val();
        kreditai_menuo = kreditai_kiek*kita.kreditas;
        kreditai_metai= (kreditai_kiek*kita.kreditas)*12;
        $('#kreditai_menesis').val(kreditai_menuo.toFixed(2) + ' €');
        $('#kreditai_metai').val(kreditai_metai.toFixed(2) + ' €');
    });

    //deklaraciju skaiciavimai
    $('#deklaracija').change(function() {
        deklaracija_menuo = 0;
        deklaracija_metai = 0;
        deklaracija = $("#deklaracija").val();

        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        $.each(deklaracija, function (index, value) {
            var kinta = value + '_kaina';
            if(value == "FR572_12" || value == "FR573"){
                deklaracija_menuo += (kita[kinta]/12)*darbas;
                deklaracija_metai += kita[kinta]*darbas;}else{
                deklaracija_menuo += (kita[kinta]/12);
                deklaracija_metai += kita[kinta];
            }
        });
        $('#deklaracija_metai').val(deklaracija_metai.toFixed(2)+' €');
        $('#deklaracija_menesis').val(deklaracija_menuo.toFixed(2)+' €');
    });

    //jei reikalinga kuro apskaita, atsiranda laukelis ivesti kiek transporto priemoniu yra
    $('#kuras').change(function() {
        if($(this).is(":checked")) {
            $("#inp_kuras").show();
            //patikrinti ar ivestas
            $('#kuras_kiekis').change(function() {
                var kiekis = $("#kuras_kiekis").val();
                kuras_menuo = kita.kuras_kaina * kiekis;
                kuras_metai = (kita.kuras_kaina * kiekis) * 12;
                $('#kuras_menesis').val(kuras_menuo.toFixed(2) + ' €');
                $('#kuras_metai').val(kuras_metai.toFixed(2) + ' €');
            });
        } else {
            $("#inp_kuras").hide();
            $('#kuras_kiekis').val('');
            $('#kuras_menesis').val('');
            $('#kuras_metai').val('');
            kuras_menuo = 0; kuras_metai = 0;
        }
    });

    //tvarkyti dokumentus susijusius su gamtos apsauga
    $('#gamtos_apsauga').change(function() {
        if($(this).is(":checked")) {
            $("#inp_apsauga").show();
            apsauga_menuo = kita.gamtos_apsauga/12;
            apsauga_metai = kita.gamtos_apsauga;
            $('#apsauga_menesis').val(apsauga_menuo.toFixed(2) + ' €');
            $('#apsauga_metai').val(apsauga_metai.toFixed(2) + ' €');
        } else {
            $("#inp_apsauga").hide();
            $('#apsauga_menesis').val('');
            $('#apsauga_metai').val('');
            apsauga_metai = 0; apsauga_menuo = 0;
        }
    });

    //ES paramos gavimas, jei taip papildomai tvarkomi dokumentai, uztai irgi reik moketi
    $('#europa').change(function() {
        if($(this).is(":checked")) {
            $("#inp_europa").show();
            europa_menuo = kita.europa_kaina/12;
            europa_metai = kita.europa_kaina;
            $('#europa_menesis').val(europa_menuo.toFixed(2) + ' €');
            $('#europa_metai').val(europa_metai.toFixed(2) + ' €');
        } else {
            $("#inp_europa").hide();
            $('#europa_menesis').val('');
            $('#europa_metai').val('');
            europa_menuo = 0; europa_metai = 0;
        }
    });

    //SASKAITU PLANAS jei ukininkas naujai atejes
    $('#saskaita').change(function() {
        if($(this).is(":checked")) {
            $("#inp_saskaita").show();
            saskaita_menuo = kita.saskaita_kaina/12;
            saskaita_metai = kita.saskaita_kaina;
            $('#saskaita_menesis').val(saskaita_menuo.toFixed(2) + ' €');
            $('#saskaita_metai').val(saskaita_metai.toFixed(2) + ' €');
        } else {
            $("#inp_saskaita").hide();
            $('#saskaita_menesis').val('');
            $('#saskaita_metai').val('');
            saskaita_menuo = 0; saskaita_metai = 0;
        }
    });

    //galviju judejimo skaiciavimas
    $('#judejimas').change(function() {
        if($(this).is(":checked")) {
            $("#inp_judejimas").show();
            judejimas_menuo = kita.galviju_judejimas;
            judejimas_metai = kita.galviju_judejimas*12;
            $('#judejimas_menesis').val(judejimas_menuo.toFixed(2) + ' €');
            $('#judejimas_metai').val(judejimas_metai.toFixed(2) + ' €');
        } else {
            $("#inp_judejimas").hide();
            $('#judejimas_menesis').val('');
            $('#judejimas_metai').val('');
            judejimas_menuo = 0; judejimas_metai = 0;
        }
    });

    //pasidarom kad nereiketu vesti
    $('#bankai').bootstrapNumber();
    $('#kreditai').bootstrapNumber();
    $('#kuras_kiekis').bootstrapNumber();
    $('#darbuotojai_2_kiekis').bootstrapNumber();
    $('#darbuotojai_kiekis').bootstrapNumber();
    $('#nuolaida').bootstrapNumber();


    //Skaiciuojam viska, arba naujam lange suformuojam, kainyno ataskaita
    $("#skaitciuoti").click(function(e) {
        e.preventDefault();
        var nuolaida = $("#nuolaida").val();
        viso_menuo = pirminiai_menuo + darb_2_menuo + darb_menuo + galvijai_menuo + dek_menuo + kreditai_menuo + bankai_menuo + europa_menuo + saskaita_menuo + kuras_menuo + apsauga_menuo + deklaracija_menuo + judejimas_menuo;
        viso_metai = pirminiai_metai + darb_2_metai + darb_metai + galvijai_metai + dek_metai + kreditai_metai + bankai_metai + europa_metai + saskaita_metai + kuras_metai + apsauga_metai + deklaracija_metai + judejimas_metai;
        nuolaida_menuo = viso_menuo * (nuolaida/100);
        nuolaida_metai = viso_metai * (nuolaida/100);
        viso_menuo = viso_menuo - nuolaida_menuo;
        viso_metai = viso_metai - nuolaida_metai;
        $('#nuolaida_menesis').val(nuolaida_menuo.toFixed(2) + ' €');
        $('#nuolaida_metai').val(nuolaida_metai.toFixed(2) + ' €');

        $('#viso_menesis').val(viso_menuo.toFixed(2) + ' €');
        $('#viso_metai').val(viso_metai.toFixed(2) + ' €');
    });

});