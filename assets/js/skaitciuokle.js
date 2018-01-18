// Set the global configs to synchronous
$.ajaxSetup({
    async: false
});

//sutartties sablono sukurimas
$(document).ready(function(){
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

    //pirminiai dokumentai, darbuotojai ir ju deklaracijos
    var pirminiai_kiek=0, pirminiai_menuo=0, pirminiai_metai=0;
    var inventorizacija_metai = 0, inventorizacija_menuo = 0;
    var darb_2_kiekis=0, darb_2_menuo=0, darb_2_metai=0;
    var darb_kiekis=0, darb_menuo=0, darb_metai=0;
    var fr572_menuo=0, fr572_metai=0;
    var fr573_menuo=0, fr573_metai=0;
    var sam_kiekis=0, sam_menuo=0, sam_metai=0;
    var sd_kiekis=0, sd_menuo=0, sd_metai=0;
    //galvijai ir deklaruotas plotas
    var galvijai_menuo=0, galvijai_metai=0, galvijai_banda;
    var dek_menuo=0, dek_metai=0;
    var technika_menuo=0,technika_metai=0;
    //deklaracijos
    var pvm_x12_menuo=0, pvm_x12_metai=0;
    var pvm_x2_menuo=0, pvm_x2_metai=0;
    var fr457_menuo=0, fr457_metai=0;
    var gpm308_menuo=0, gpm308_metai=0;
    var sav1_menuo=0, sav1_metai=0;
    //kitos paslaugos
    var bankai_kiek=0, bankai_menuo=0, bankai_metai=0;
    var kreditai_kiek=0, kreditai_menuo=0, kreditai_metai=0;
    var saskaita_menuo = 0, saskaita_metai = 0;
    var europa_menuo = 0, europa_metai = 0;
    var kuras_menuo = 0, kuras_metai = 0;
    var apsauga_menuo = 0, apsauga_metai = 0;
    var zemes_menuo = 0, zemes_metai = 0;
    var judejimas_menuo = 0, judejimas_metai = 0;
    //papildomi nustatymai
    var laiku_atsiskaito = 0, seimos_nariai = 0;
    var nuolaida = 0, nuolaida_input = 0, nuolaida_menuo = 0, nuolaida_metai = 0;
    var viso_menuo=0, viso_metai=0;
    //ukio dydis
    var dydis;

    //$('#deklaraciju_ivedimas').modal({
        //show: 'false'
    //});

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

    //pasirenkam ukininka, redirect i php koda kuris nustatys pasirinkta ukininka
    $('#pasirinkti_ukininka').click(function(e) {
        e.preventDefault();
        var ukininkas = $("#ukininkas").val();
        window.location.href = "pasirinkti_ukininka/"+ukininkas;
    });


    //sukaiciuojam piminiu dokumentu ruosimo kaina, pagal pasirinktus duomenis
    $('#pirminiai').change(function() {
        pirminiai_kiek = $("#pirminiai").val();
        pirminiai_menuo = dokumentai[dydis].kaina*pirminiai_kiek
        pirminiai_metai = (dokumentai[dydis].kaina*pirminiai_kiek)*12;
        //skaiciuojam tik pirmini
        $('#pirminiai_metai').val(pirminiai_metai.toFixed(2)+' €');
        $('#pirminiai_menuo').val(pirminiai_menuo.toFixed(2)+' €');
    });

    //jei turima darbuotoju rodomas laukelis ivesti darbuotoju skaiciu
    $('#is_darbininkai_2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_darbininkai_2").show();
        } else {
            $("#inp_darbininkai_2").hide();
            $("#darbuotoju_deklaracijos").hide();
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

    //sukaiciuojam darbuotojus, deklaracijas ju kainas
    $('#darbuotojai_2_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_kiekis = $("#darbuotojai_kiekis").val();
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        if(darbas > 0) {
            $("#darbuotoju_deklaracijos").show();
            fr572_menuo = (kita['FR572_12_kaina']/12)*darbas;
            fr572_metai = kita['FR572_12_kaina']*darbas;
            $('#fr572_metai').val(fr572_metai.toFixed(2)+' €');
            $('#fr572_menesis').val(fr572_menuo.toFixed(2)+' €');

            fr573_menuo = (kita['FR573_kaina']/12)*darbas;
            fr573_metai = kita['FR573_kaina']*darbas;
            $('#fr573_metai').val(fr573_metai.toFixed(2)+' €');
            $('#fr573_menesis').val(fr573_menuo.toFixed(2)+' €');
        }else{
            $("#darbuotoju_deklaracijos").hide();
            fr572_menuo = 0; fr572_menuo = 0;
            fr573_menuo = 0; fr573_menuo = 0;
        }
        darb_2_menuo = (darbuotojai['be_vykdomu_rastu']*darb_2_kiekis)/12;
        darb_2_metai = darbuotojai['be_vykdomu_rastu']*darb_2_kiekis;
        //skaiciuojam darbuotojus be rastu
        $('#darbuotojai_2_metai').val(darb_2_metai.toFixed(2)+' €');
        $('#darbuotojai_2_menesis').val(darb_2_menuo.toFixed(2)+' €');
    });

    $('#darbuotojai_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_kiekis = $("#darbuotojai_kiekis").val();
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        if(darbas > 0) {
            $("#darbuotoju_deklaracijos").show();
            fr572_menuo = (kita['FR572_12_kaina']/12)*darbas;
            fr572_metai = kita['FR572_12_kaina']*darbas;
            $('#fr572_metai').val(fr572_metai.toFixed(2)+' €');
            $('#fr572_menesis').val(fr572_menuo.toFixed(2)+' €');

            fr573_menuo = (kita['FR573_kaina']/12)*darbas;
            fr573_metai = kita['FR573_kaina']*darbas;
            $('#fr573_metai').val(fr573_metai.toFixed(2)+' €');
            $('#fr573_menesis').val(fr573_menuo.toFixed(2)+' €');
        }else{
            $("#darbuotoju_deklaracijos").hide();
            fr572_menuo = 0; fr572_menuo = 0;
            fr573_menuo = 0; fr573_menuo = 0;
        }
        darb_menuo = (darbuotojai['vykdomi_rastai']*darb_kiekis)/12;
        darb_metai = darbuotojai['vykdomi_rastai']*darb_kiekis;
        //skaiciuojam darbuotojus su  rastais
        $('#darbuotojai_metai').val(darb_metai.toFixed(2)+' €');
        $('#darbuotojai_menesis').val(darb_menuo.toFixed(2)+' €');
    });

    //deklaraciju SAM SD skaiciavimas
    $('#sam_kiekis').change(function() {
        sam_kiekis = $("#sam_kiekis").val();
        sam_menuo = (kita['SAM_kaina']*sam_kiekis)/12;
        sam_metai = kita['SAM_kaina']*sam_kiekis;
        //skaiciuojam darbuotojus be rastu
        $('#sam_metai').val(sam_metai.toFixed(2)+' €');
        $('#sam_menesis').val(sam_menuo.toFixed(2)+' €');
    });

    $('#sd_kiekis').change(function() {
        sd_kiekis = $("#sd_kiekis").val();
        sd_menuo = kita['SD_kaina']*sd_kiekis;
        sd_metai = (kita['SD_kaina']*sd_kiekis)*12;
        //skaiciuojam darbuotojus be rastu
        $('#sd_metai').val(sd_metai.toFixed(2)+' €');
        $('#sd_menesis').val(sd_menuo.toFixed(2)+' €');
    });


    //duomenys i INPUT paduodami is PHP, todel apskaiciuoja uzsikraunant puslapiui
    //skaiciujam kaina
    galviju_kiekis();
    deklaruotas_plotas();
    //jei norima redaguoti reiksmes
    $('#galvijai_kiekis').change(function() {
       galviju_kiekis();
    });
    $('#dek_plotas').change(function() {
        deklaruotas_plotas();
    });

    //TECHNIKA
    $('#technika').change(function() {
        if($(this).is(":checked")) {
            $("#inp_technika").show();
            //patikrinti ar ivestas
            $('#technika_kiekis').change(function() {
                var kiekis = $("#technika_kiekis").val();
                technika_menuo = kita['technika_kaina'] * kiekis;
                technika_metai = (kita['technika_kaina'] * kiekis) * 12;
                $('#technika_menesis').val(technika_menuo.toFixed(2) + ' €');
                $('#technika_metai').val(technika_metai.toFixed(2) + ' €');
            });
        } else {
            $("#inp_technika").hide();
            $('#technika_kiekis').val('');
            $('#technika_menesis').val('');
            $('#technika_metai').val('');
            technika_menuo = 0; technika_metai = 0;
        }
    });

    ////////////////////////////////////////////////////////////////////DEKLARACIJOS///////////////////////////////////////////////////////////////////
    $('#pvm_x12').change(function() {
        if($(this).is(":checked")) {
            $("#inp_pvm_x12").show();
            pvm_x12_menuo = kita['pvm_12_kaina']/12;
            pvm_x12_metai = kita['pvm_12_kaina'];
            $('#pvm_x12_menesis').val(pvm_x12_menuo.toFixed(2) + ' €');
            $('#pvm_x12_metai').val(pvm_x12_metai.toFixed(2) + ' €');
        } else {
            $("#inp_pvm_x12").hide();
            $('#pvm_x12_menesis').val('');
            $('#pvm_x12_metai').val('');
            pvm_x12_metai = 0; pvm_x12_menuo = 0;
        }
    });

    $('#pvm_x2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_pvm_x2").show();
            pvm_x2_menuo = kita['pvm_2_kaina']/12;
            pvm_x2_metai = kita['pvm_2_kaina'];
            $('#pvm_x2_menesis').val(pvm_x2_menuo.toFixed(2) + ' €');
            $('#pvm_x2_metai').val(pvm_x2_metai.toFixed(2) + ' €');
        } else {
            $("#inp_pvm_x2").hide();
            $('#pvm_x2_menesis').val('');
            $('#pvm_x2_metai').val('');
            pvm_x2_metai = 0; pvm_x2_menuo = 0;
        }
    });

    $('#fr457').change(function() {
        if($(this).is(":checked")) {
            $("#inp_fr457").show();
            fr457_menuo = kita['FR457_kaina']/12;
            fr457_metai = kita['FR457_kaina'];
            $('#fr457_menesis').val(fr457_menuo.toFixed(2) + ' €');
            $('#fr457_metai').val(fr457_metai.toFixed(2) + ' €');
        } else {
            $("#inp_fr457").hide();
            $('#fr457_menesis').val('');
            $('#fr457_metai').val('');
            fr457_metai = 0; fr457_menuo = 0;
        }
    });

    $('#gpm308').change(function() {
        if($(this).is(":checked")) {
            $("#inp_gpm308").show();
            gpm308_menuo = kita['GPM308_kaina']/12;
            gpm308_metai = kita['GPM308_kaina'];
            $('#gpm308_menesis').val(gpm308_menuo.toFixed(2) + ' €');
            $('#gpm308_metai').val(gpm308_metai.toFixed(2) + ' €');
        } else {
            $("#inp_gpm308").hide();
            $('#gpm308_menesis').val('');
            $('#gpm308_metai').val('');
            gpm308_metai = 0; gpm308_menuo = 0;
        }
    });

    $('#sav1').change(function() {
        if($(this).is(":checked")) {
            $("#inp_sav1").show();
            sav1_menuo = kita['SAV1_kaina']/12;
            sav1_metai = kita['SAV1_kaina'];
            $('#sav1_menesis').val(sav1_menuo.toFixed(2) + ' €');
            $('#sav1_metai').val(sav1_metai.toFixed(2) + ' €');
        } else {
            $("#inp_sav1").hide();
            $('#sav1_menesis').val('');
            $('#sav1_metai').val('');
            sav1_metai = 0; sav1_menuo = 0;
        }
    });

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
        deklaraciju_isskaiciavimas()

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

    //Zemes mokestis
    $('#zemes_mokestis').change(function() {
        if($(this).is(":checked")) {
            $("#inp_zemes").show();
            $('#zemes_kiekis').change(function() {
                var kiekis = $("#zemes_kiekis").val();
                zemes_menuo = (kita.zemes_mokestis*kiekis)/12;
                zemes_metai = kita.zemes_mokestis*kiekis;
                $('#zemes_menesis').val(zemes_menuo.toFixed(2) + ' €');
                $('#zemes_metai').val(zemes_metai.toFixed(2) + ' €');
            });
        } else {
            $("#inp_zemes").hide();
            $('#zemes_kiekis').val('');
            $('#zemes_menesis').val('');
            $('#zemes_metai').val('');
            zemes_metai = 0; zemes_menuo = 0;
        }
    });

    //inventorizacija
    $('#inventorizacija_kiekis').change(function() {
        var kiekis = $("#inventorizacija_kiekis").val();
        inventorizacija_menuo = (kita.inventorizacija*kiekis)/12;
        inventorizacija_metai = kita.inventorizacija*kiekis;
        $('#inventorizacija_menesis').val(inventorizacija_menuo.toFixed(2) + ' €');
        $('#inventorizacija_metai').val(inventorizacija_metai.toFixed(2) + ' €');
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
    $('#zemes_kiekis').bootstrapNumber();

    //NUolaidos
    $('#laiku_atsiskaito').change(function() {
        nuolaida_input = $("#nuolaida").val();
        if($(this).is(":checked")) {
            nuolaida = parseInt(nuolaida_input)+ kita['laiku_atsiskaito'];
            $('#nuolaida').val(nuolaida);
        } else {
            nuolaida = parseInt(nuolaida_input) - kita['laiku_atsiskaito'];
            $('#nuolaida').val(nuolaida);
        }
    });

    $('#seimos_nariai').change(function() {
        nuolaida_input = $("#nuolaida").val();
        if($(this).is(":checked")) {
            nuolaida = parseInt(nuolaida_input) + kita['seimos_nariai'];
            $('#nuolaida').val(nuolaida);
        } else {
            nuolaida = parseInt(nuolaida_input) - kita['seimos_nariai'];
            $('#nuolaida').val(nuolaida);
        }
    });
    //Skaiciuojam viska, arba naujam lange suformuojam, kainyno ataskaita
    $("#skaitciuoti").click(function(e) {
        e.preventDefault();
        nuolaida_input = $("#nuolaida").val();
        var bazine_menuo = pirminiai_menuo + darb_2_menuo + inventorizacija_menuo + fr572_menuo + fr573_menuo + sam_menuo + sd_menuo;
        var bazine_metai = pirminiai_metai + darb_2_metai + inventorizacija_metai + fr572_metai + fr573_metai + sam_metai + sd_metai;
        var ukis_menuo = galvijai_menuo + dek_menuo + technika_menuo;
        var ukis_metai = galvijai_metai + dek_metai + technika_metai;
        var deklaracija_menuo = pvm_x12_menuo + pvm_x2_menuo + fr457_menuo + gpm308_menuo + sav1_menuo;
        var deklaracija_metai = pvm_x12_metai + pvm_x2_metai + fr457_metai + gpm308_metai + sav1_metai;
        var paslaugos_menuo = kreditai_menuo + bankai_menuo + europa_menuo + saskaita_menuo + kuras_menuo + apsauga_menuo + zemes_menuo + judejimas_menuo;
        var paslaugos_metai = kreditai_metai + bankai_metai + europa_metai + saskaita_metai + kuras_metai + apsauga_metai + zemes_metai + judejimas_metai;
        viso_menuo = bazine_menuo + ukis_menuo + deklaracija_menuo + paslaugos_menuo;
        viso_metai = bazine_metai + ukis_metai + deklaracija_metai + paslaugos_metai;
        //paskaiciuojam nuolaida
        //nuolaida = parseInt(nuolaida) + parseInt(laiku_atsiskaito) + parseInt(seimos_nariai);
        nuolaida_menuo = viso_menuo * (nuolaida_input/100);

        nuolaida_metai = viso_metai * (nuolaida_input/100);
        viso_menuo = viso_menuo - nuolaida_menuo;
        viso_metai = viso_metai - nuolaida_metai;
        $('#nuolaida').val(nuolaida_input);
        $('#nuolaida_menesis').val(nuolaida_menuo.toFixed(2) + ' €');
        $('#nuolaida_metai').val(nuolaida_metai.toFixed(2) + ' €');

        $('#viso_menesis').val(viso_menuo.toFixed(2) + ' €');
        $('#viso_metai').val(viso_metai.toFixed(2) + ' €');
    });

    function deklaruotas_plotas(){
        //deklaruoto ploto kiekis,
        var plotas = $("#dek_plotas").val();
        var kieki = 1;

        //paimam reiksme kokia bandos tipas
        galvijai_banda = $('input[name=banda]:checked').val();

        //pagal bandos tipa, skaiciuoja kaina
        /*if(galvijai_banda == 2){
            dek_menuo = (deklaruota[kieki].parduodantys*plotas)/12;
            dek_metai = deklaruota[kieki].parduodantys*plotas;
        }
        if(galvijai_banda == 1){
            dek_menuo = (deklaruota[kieki].savo_reikmems*plotas)/12;
            dek_metai = deklaruota[kieki].savo_reikmems*plotas;
        }
        if(galvijai_banda == 3){
            dek_menuo = (((deklaruota[kieki].parduodantys + deklaruota[kieki].savo_reikmems)/2)*plotas)/12;
            dek_metai = ((deklaruota[kieki].parduodantys + deklaruota[kieki].savo_reikmems)/2)*plotas;
        }*/
        if(!galvijai_banda){
            dek_menuo = (deklaruota[kieki].augalai*plotas)/12;
            dek_metai = deklaruota[kieki].augalai*plotas;
        }else{
            dek_menuo = (deklaruota[kieki].galvijai*plotas)/12;
            dek_metai = deklaruota[kieki].galvijai*plotas;
        }

        //sukelia gyvulinkystes sumas
        $('#dek_menesis').val(dek_menuo.toFixed(2)+ ' €');
        $('#dek_metai').val(dek_metai.toFixed(2) + ' €');
    }

    function galviju_kiekis(){
        //reik nustatytik koks ukio tipas: MAZAS, VIDUTINIS, DIDELIS
        var kiek = $("#galvijai_kiekis").val();
        if(kiek <= 50){dydis = 0;}else
        if(kiek > 50 && kiek <= 150 ){dydis = 1;}else
        if(kiek > 150){ dydis = 2;}

        //paimam reiksme kokia bandos tipas
        galvijai_banda = $('input[name=banda]:checked').val();

        //pagal bandos tipa, skaiciuoja kaina
        if(galvijai_banda == 2){
            galvijai_menuo = (galvijai[dydis].ne_melziamos*kiek)/12;;
            galvijai_metai = galvijai[dydis].ne_melziamos*kiek;
        }
        if(galvijai_banda == 1){
            galvijai_menuo = (galvijai[dydis].melziamos*kiek)/12;
            galvijai_metai = galvijai[dydis].melziamos*kiek;
        }
        if(galvijai_banda == 3){
            galvijai_menuo = (((galvijai[dydis].ne_melziamos + galvijai[dydis].melziamos)*kiek)/2)/12;
            galvijai_metai = ((galvijai[dydis].ne_melziamos + galvijai[dydis].melziamos)*kiek)/2;
        }

        //sukelia gyvulinkystes sumas
        $('#galvijai_menesis').val(galvijai_menuo.toFixed(2) + ' €');
        $('#galvijai_metai').val(galvijai_metai.toFixed(2) + ' €');
    }

    /*function deklaraciju_isskaiciavimas(){
        //deklaracija darbuotoju, pagal ju kieki
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        deklaracija_menuo = 0;
        deklaracija_metai = 0;
        deklaracija = $("#deklaracija").val();
        $.each(deklaracija, function (index, value) {
            var kinta = value + '_kaina';
            if(value == "FR572_12" || value == "FR573"){
                deklaracija_menuo += (kita[kinta]/12)*darbas;
                deklaracija_metai += kita[kinta]*darbas;}else
                    if(value == "SAM"){
                deklaracija_menuo += (kita[kinta])*sam;
                deklaracija_metai += (kita[kinta]*sam)*12;}else
                    if(value == "SD"){
                        deklaracija_menuo += (kita[kinta])*sd;
                        deklaracija_metai += (kita[kinta]*sd)*12;}else{
                        deklaracija_menuo += (kita[kinta]/12);
                        deklaracija_metai += kita[kinta];
            }
        });
    }*/

});