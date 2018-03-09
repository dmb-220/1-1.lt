// Set the global configs to synchronous
$.ajaxSetup({
    async: false
});

//sutartties sablono sukurimas
$(document).ready(function(){
    var dokumentai = [], darbuotojai = [], ukis = [], deklaracija = [];
    var kita = [], procentai = [];

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
    var dek_menuo2=0, dek_metai2=0, dek_plotas2 = 0;
    var technika_menuo=0,technika_metai=0;
    //deklaracijos
    var pvm_x12_menuo=0, pvm_x12_metai=0;
    var pvm_x2_menuo=0, pvm_x2_metai=0;
    var fr457_menuo=0, fr457_metai=0;
    var gpm308_menuo=0, gpm308_metai=0;
    var sav1_menuo=0, sav1_metai=0;
    var ivaz_menuo=0, ivaz_metai=0;
    var isaf_12_menuo=0, isaf_12_metai=0;
    var isaf_2_menuo=0, isaf_2_metai=0;
    //kitos paslaugos
    var bankai_kiek=0, bankai_menuo=0, bankai_metai=0;
    var kreditai_kiek=0, kreditai_menuo=0, kreditai_metai=0;
    var saskaita_menuo = 0, saskaita_metai = 0;
    var europa_menuo = 0, europa_metai = 0;
    var kuras_menuo = 0, kuras_metai = 0;
    var kitos_paslaugos_menuo = 0, kitos_paslaugos_metai = 0;
    var apsauga_menuo = 0, apsauga_metai = 0;
    var zemes_menuo = 0, zemes_metai = 0;
    var judejimas_menuo = 0, judejimas_metai = 0;
    //papildomi nustatymai
    var laiku_atsiskaito = 0, seimos_nariai = 0;
    var nuolaida = 0, nuolaida_input = 0, nuolaida_menuo = 0, nuolaida_metai = 0;
    var viso_menuo=0, viso_metai=0;
    //atskyru skyriu viso skaiciavimui
    var baz_menesis = 0, baz_metai = 0;
    var uzm_menesis = 0, uzm_metai = 0;
    var uki_menesis = 0, uki_metai = 0;
    var dk_menesis = 0, dk_metai = 0;
    var kt_menesis = 0, kt_metai = 0;

    //pasidarom kad nereiketu vesti
    $('#bankai').bootstrapNumber();
    $('#kreditai').bootstrapNumber();
    $('#kuras_kiekis').bootstrapNumber();
    $('#kitos_paslaugos_kiekis').bootstrapNumber();
    $('#darbuotojai_2_kiekis').bootstrapNumber();
    $('#darbuotojai_kiekis').bootstrapNumber();
    $('#nuolaida').bootstrapNumber();
    $('#zemes_kiekis').bootstrapNumber();
    $('#technika_kiekis').bootstrapNumber();
    $('#ivaz_kiekis').bootstrapNumber();
    $('#sav1_kiekis').bootstrapNumber();
    $('#fr457_kiekis').bootstrapNumber();

    //nuskaitom JSON kainu failiuka
    $.getJSON("https://1-1.lt/assets/js/kainos.json", function (data) {
        var arrItems = [];
        $.each(data, function (index, value) {
            arrItems.push(value);
        });
        //nustatom reiksmes i tam tikrus kintamuosius
        dokumentai = arrItems[0];
        darbuotojai = arrItems[1];
        ukis = arrItems[2];
        deklaracija = arrItems[3];
        kita = arrItems[4];
        procentai = arrItems[5];
    });


    //pasirenkam ukininka, redirect i php koda kuris nustatys pasirinkta ukininka
    $('#pasirinkti_ukininka').click(function(e) {
        e.preventDefault();
        var ukininkas = $("#ukininkas").val();
        window.location.href = "pasirinkti_ukininka/"+ukininkas;
    });


/////////////////////////////////////////////////////////////////////////// BAZINE KAINA ///////////////////////////////////////////////////
    //sukaiciuojam piminiu dokumentu ruosimo kaina, pagal pasirinktus duomenis
    $('#pirminiai').change(function() {
        pirminiai_kiek = $("#pirminiai").val();
        pirminiai_menuo = (dokumentai['pirminiai']*pirminiai_kiek)/12;
        pirminiai_metai = dokumentai['pirminiai']*pirminiai_kiek;
        //skaiciuojam tik pirmini
        $('#pirminiai_metai').val(pirminiai_metai.toFixed(2)+' €');
        $('#pirminiai_menuo').val(pirminiai_menuo.toFixed(2)+' €');
        //skaiciuojam VISO
        bazine_viso();
    });

    //Metine inventorizacija
    $('#inventorizacija_kiekis').change(function() {
        var kiekis = $("#inventorizacija_kiekis").val();
        inventorizacija_menuo = (dokumentai['inventorizacija']*kiekis)/12;
        inventorizacija_metai = dokumentai['inventorizacija']*kiekis;
        $('#inventorizacija_menesis').val(inventorizacija_menuo.toFixed(2) + ' €');
        $('#inventorizacija_metai').val(inventorizacija_metai.toFixed(2) + ' €');
        //skaiciuojam VISO
        bazine_viso();
    });

    //Bankai
    $('#bankai').change(function() {
        bankai_kiek = $("#bankai").val();
        bankai_menuo = bankai_kiek*dokumentai['bankas'];
        bankai_metai= (bankai_kiek*dokumentai['bankas'])*12;
        $('#bankai_menesis').val(bankai_menuo.toFixed(2) + ' €');
        $('#bankai_metai').val(bankai_metai.toFixed(2) + ' €');
        //skaiciuojam VISO
        bazine_viso();
    });
    //kreditai
    $('#kreditai').change(function() {
        kreditai_kiek = $("#kreditai").val();
        kreditai_menuo = kreditai_kiek*dokumentai['kreditas'];
        kreditai_metai= (kreditai_kiek*dokumentai['kreditas'])*12;
        $('#kreditai_menesis').val(kreditai_menuo.toFixed(2) + ' €');
        $('#kreditai_metai').val(kreditai_metai.toFixed(2) + ' €');
        //skaiciuojam VISO
        bazine_viso();
    });

    //SASKAITU PLANAS jei ukininkas naujai atejes
    $('#saskaita').change(function() {
        if($(this).is(":checked")) {
            $("#inp_saskaita").show();
            saskaita_menuo = dokumentai['saskaita_kaina']/12;
            saskaita_metai = dokumentai['saskaita_kaina'];
            $('#saskaita_menesis').val(saskaita_menuo.toFixed(2) + ' €');
            $('#saskaita_metai').val(saskaita_metai.toFixed(2) + ' €');
        } else {
            $("#inp_saskaita").hide();
            $('#saskaita_menesis').val('');
            $('#saskaita_metai').val('');
            saskaita_menuo = 0; saskaita_metai = 0;
        }
        //skaiciuojam VISO
        bazine_viso();
    });

    //funkcija skaiciuoti VISO menesis ir metai
    function bazine_viso(){
        baz_menesis = parseFloat(pirminiai_menuo) + parseFloat(inventorizacija_menuo) + parseFloat(bankai_menuo) + parseFloat(kreditai_menuo) + parseFloat(saskaita_menuo);
        baz_metai = parseFloat(pirminiai_metai) + parseFloat(inventorizacija_metai) + parseFloat(bankai_metai) + parseFloat(kreditai_metai) + parseFloat(saskaita_metai);
        $('#bazine_menesis').val(baz_menesis.toFixed(2) + ' €');
        $('#bazine_metai').val(baz_metai.toFixed(2) + ' €');
    }

/////////////////////////////////////////////////////////////////////////////// DARBO UZMOKESCIO APSKAITOS KAINA ///////////////////////////////////
    //jei turima darbuotoju rodomas laukelis ivesti darbuotoju skaiciu
    $('#is_darbininkai_2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_darbininkai_2").show();
            //skaiciuojam viso
            uzmokestis_viso();
        } else {
            $("#inp_darbininkai_2").hide();
            $("#darbuotoju_deklaracijos").hide();
            darb_2_kiekis = 0; darb_2_menuo = 0; darb_2_metai = 0;

            $('#darbuotojai_2_metai').val('');
            $('#darbuotojai_2_menesis').val('');
            $('#darbuotojai_2_kiekis').val('');

            $("#inp_darbininkai").hide();
            darb_kiekis = 0; darb_menuo = 0; darb_metai = 0;

            $("#is_darbininkai").prop( "checked", false );
            $('#darbuotojai_metai').val('');
            $('#darbuotojai_menesis').val('');
            $('#darbuotojai_kiekis').val('');
            //isvalom viso laukelis jei atzimejom
            $('#uzmokestis_menesis').val('');
            $('#uzmokestis_metai').val('');
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
        //skaiciuojam viso
        uzmokestis_viso();
    });

    //sukaiciuojam darbuotojus, deklaracijas ju kainas
    $('#darbuotojai_2_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_kiekis = $("#darbuotojai_kiekis").val();
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        if(darbas > 0) {
            $("#darbuotoju_deklaracijos").show();
            fr572_menuo = (darbuotojai['FR572_kaina']/12);
            fr572_metai = darbuotojai['FR572_kaina'];
            $('#fr572_metai').val(fr572_metai.toFixed(2)+' €');
            $('#fr572_menesis').val(fr572_menuo.toFixed(2)+' €');

            fr573_menuo = (darbuotojai['FR573_kaina']/12);
            fr573_metai = darbuotojai['FR573_kaina'];
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
        //skaiciuojam viso
        uzmokestis_viso();
    });

    $('#darbuotojai_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_kiekis = $("#darbuotojai_kiekis").val();
        var darbas = parseInt(darb_kiekis) + parseInt(darb_2_kiekis);
        if(darbas > 0) {
            $("#darbuotoju_deklaracijos").show();
            fr572_menuo = (darbuotojai['FR572_kaina']/12);
            fr572_metai = darbuotojai['FR572_kaina'];
            $('#fr572_metai').val(fr572_metai.toFixed(2)+' €');
            $('#fr572_menesis').val(fr572_menuo.toFixed(2)+' €');

            fr573_menuo = (darbuotojai['FR573_kaina']/12);
            fr573_metai = darbuotojai['FR573_kaina'];
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
        //skaiciuojam viso
        uzmokestis_viso();
    });

    //deklaraciju SAM skaiciavimas
    $('#sam_kiekis').change(function() {
        sam_kiekis = $("#sam_kiekis").val();
        sam_menuo = (darbuotojai['SAM_kaina']*sam_kiekis)/12;
        sam_metai = darbuotojai['SAM_kaina']*sam_kiekis;
        //skaiciuojam darbuotojus be rastu
        $('#sam_metai').val(sam_metai.toFixed(2)+' €');
        $('#sam_menesis').val(sam_menuo.toFixed(2)+' €');
        //skaiciuojam viso
        uzmokestis_viso();
    });

    //deklaraciju SD skaiciavimas
    $('#sd_kiekis').change(function() {
        sd_kiekis = $("#sd_kiekis").val();
        sd_menuo = darbuotojai['SD_kaina']*sd_kiekis;
        sd_metai = (darbuotojai['SD_kaina']*sd_kiekis)*12;
        //skaiciuojam darbuotojus be rastu
        $('#sd_metai').val(sd_metai.toFixed(2)+' €');
        $('#sd_menesis').val(sd_menuo.toFixed(2)+' €');
        //skaiciuojam viso
        uzmokestis_viso();
    });

    //funkcija skaiciuoti VISO menesis ir metai
    function uzmokestis_viso(){
        uzm_menesis = parseFloat(sd_menuo) + parseFloat(sam_menuo) + parseFloat(darb_menuo) + parseFloat(darb_2_menuo) + parseFloat(fr573_menuo) + parseFloat(fr572_menuo);
        uzm_metai = parseFloat(sd_metai) + parseFloat(sam_metai) + parseFloat(darb_metai) + parseFloat(darb_2_metai) + parseFloat(fr573_metai) + parseFloat(fr572_metai);
        $('#uzmokestis_menesis').val(uzm_menesis.toFixed(2) + ' €');
        $('#uzmokestis_metai').val(uzm_metai.toFixed(2) + ' €');
    }

///////////////////////////////////////////////////////////////////////////////// UKIO APSKAITOS KAINA /////////////////////////////////////////////////////////
    //duomenys i INPUT paduodami is PHP, todel apskaiciuoja uzsikraunant puslapiui
    galviju_kiekis();
    deklaruotas_plotas();
    //tada vel sumas padaro, i 0
    dek_metai = 0; dek_menuo = 0;
    //skaiciuojam viso
    ukis_viso();
    //jei pazymeta vel nustatom kainas, jei atzimeta keiciam sumas i 0
    $('#deklaruojas_plotas').change(function() {
        if($(this).is(":checked")) {
            $("#inp_deklaruojamas_plotas").show();
            $('#dek_plotas').val(dek_plotas2);
            deklaruotas_plotas();
        } else {
            $("#inp_deklaruojamas_plotas").hide();
            $('#dek_metai').val('');
            $('#dek_menesis').val('');
            $('#dek_plotas').val('');
            dek_metai = 0; dek_menuo = 0;
        }
        //skaiciuojam viso
        ukis_viso();
    });

    //jei norima redaguoti reiksmes
    $('#galvijai_kiekis').change(function() {
       galviju_kiekis();
        //skaiciuojam viso
        ukis_viso();
    });
    $('#dek_plotas').change(function() {
        //deklaruoto ploto kiekis,
        dek_plotas2 = $("#dek_plotas").val();
        deklaruotas_plotas();
        //skaiciuojam viso
        ukis_viso();
    });

    //galviju judejimo skaiciavimas
    $('#judejimas').change(function() {
        if($(this).is(":checked")) {
            $("#inp_judejimas").show();
            judejimas_menuo = ukis['galviju_judejimas'];
            judejimas_metai = ukis['galviju_judejimas']*12;
            $('#judejimas_menesis').val(judejimas_menuo.toFixed(2) + ' €');
            $('#judejimas_metai').val(judejimas_metai.toFixed(2) + ' €');
        } else {
            $("#inp_judejimas").hide();
            $('#judejimas_menesis').val('');
            $('#judejimas_metai').val('');
            judejimas_menuo = 0; judejimas_metai = 0;
        }
        //skaiciuojam viso
        ukis_viso();
    });

    //TECHNIKA
    $('#technika').change(function() {
        if($(this).is(":checked")) {
            $("#inp_technika").show();
            //patikrinti ar ivestas
            $('#technika_kiekis').change(function() {
                var kiekis = $("#technika_kiekis").val();
                technika_menuo = ukis['technika_kaina'] * kiekis;
                technika_metai = (ukis['technika_kaina'] * kiekis) * 12;
                $('#technika_menesis').val(technika_menuo.toFixed(2) + ' €');
                $('#technika_metai').val(technika_metai.toFixed(2) + ' €');
                //skaiciuojam viso
                ukis_viso();
            });
        } else {
            $("#inp_technika").hide();
            $('#technika_kiekis').val('');
            $('#technika_menesis').val('');
            $('#technika_metai').val('');
            technika_menuo = 0; technika_metai = 0;
            //skaiciuojam viso
            ukis_viso();
        }
    });

    //funkcija skaiciuoti VISO menesis ir metai
    function ukis_viso(){
        uki_menesis = parseFloat(galvijai_menuo) + parseFloat(dek_menuo) + parseFloat(technika_menuo) + parseFloat(judejimas_menuo);
        uki_metai = parseFloat(galvijai_metai) + parseFloat(dek_metai) + parseFloat(technika_metai) + parseFloat(judejimas_metai);
        $('#ukis_menesis').val(uki_menesis.toFixed(2) + ' €');
        $('#ukis_metai').val(uki_metai.toFixed(2) + ' €');
    }

////////////////////////////////////////////////////////////////////DEKLARACIJOS///////////////////////////////////////////////////////////////////
    $('#pvm_x12').change(function() {
        if($(this).is(":checked")) {
            $("#inp_pvm_x12").show();
            pvm_x12_menuo = deklaracija['pvm_12_kaina']/12;
            pvm_x12_metai = deklaracija['pvm_12_kaina'];
            $('#pvm_x12_menesis').val(pvm_x12_menuo.toFixed(2) + ' €');
            $('#pvm_x12_metai').val(pvm_x12_metai.toFixed(2) + ' €');
        } else {
            $("#inp_pvm_x12").hide();
            $('#pvm_x12_menesis').val('');
            $('#pvm_x12_metai').val('');
            pvm_x12_metai = 0; pvm_x12_menuo = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    $('#pvm_x2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_pvm_x2").show();
            pvm_x2_menuo = deklaracija['pvm_2_kaina']/12;
            pvm_x2_metai = deklaracija['pvm_2_kaina'];
            $('#pvm_x2_menesis').val(pvm_x2_menuo.toFixed(2) + ' €');
            $('#pvm_x2_metai').val(pvm_x2_metai.toFixed(2) + ' €');
        } else {
            $("#inp_pvm_x2").hide();
            $('#pvm_x2_menesis').val('');
            $('#pvm_x2_metai').val('');
            pvm_x2_metai = 0; pvm_x2_menuo = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    //deklaraciju FR457
    $('#fr457').change(function() {
        if($(this).is(":checked")) {
            $("#inp_fr457").show();
            //patikrinti ar ivestas
            $('#fr457_kiekis').change(function() {
                var kiekis = $("#fr457_kiekis").val();
                fr457_menuo = (deklaracija['FR457_kaina'] * kiekis)/12;
                fr457_metai = deklaracija['FR457_kaina'] * kiekis;
                $('#fr457_menesis').val(fr457_menuo.toFixed(2) + ' €');
                $('#fr457_metai').val(fr457_metai.toFixed(2) + ' €');

                //skaiciuojam VISO
                teikimas_viso();
            });
        } else {
            $("#inp_fr457").hide();
            $('#fr457_kiekis').val('');
            $('#fr457_menesis').val('');
            $('#fr457_metai').val('');
            fr457_menuo = 0; fr457_metai = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    $('#gpm308').change(function() {
        if($(this).is(":checked")) {
            $("#inp_gpm308").show();
            gpm308_menuo = deklaracija['GPM308_kaina']/12;
            gpm308_metai = deklaracija['GPM308_kaina'];
            $('#gpm308_menesis').val(gpm308_menuo.toFixed(2) + ' €');
            $('#gpm308_metai').val(gpm308_metai.toFixed(2) + ' €');
        } else {
            $("#inp_gpm308").hide();
            $('#gpm308_menesis').val('');
            $('#gpm308_metai').val('');
            gpm308_metai = 0; gpm308_menuo = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    //deklaraciju SAV1
    $('#sav1').change(function() {
        if($(this).is(":checked")) {
            $("#inp_sav1").show();
            //patikrinti ar ivestas
            $('#sav1_kiekis').change(function() {
                var kiekis = $("#sav1_kiekis").val();
                sav1_menuo = (deklaracija['SAV1_kaina'] * kiekis)/12;
                sav1_metai = deklaracija['SAV1_kaina'] * kiekis;
                $('#sav1_menesis').val(sav1_menuo.toFixed(2) + ' €');
                $('#sav1_metai').val(sav1_metai.toFixed(2) + ' €');

                //skaiciuojam VISO
                teikimas_viso();
            });
        } else {
            $("#inp_sav1").hide();
            $('#sav1_kiekis').val('');
            $('#sav1_menesis').val('');
            $('#sav1_metai').val('');
            sav1_menuo = 0; sav1_metai = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    $('#isaf_12').change(function() {
        if($(this).is(":checked")) {
            $("#inp_isaf_12").show();
            isaf_12_menuo = deklaracija['isaf_12_kaina']/12;
            isaf_12_metai = deklaracija['isaf_12_kaina'];
            $('#isaf_12_menesis').val(isaf_12_menuo.toFixed(2) + ' €');
            $('#isaf_12_metai').val(isaf_12_metai.toFixed(2) + ' €');
        } else {
            $("#inp_isaf_12").hide();
            $('#isaf_12_menesis').val('');
            $('#isaf_12_metai').val('');
            isaf_12_metai = 0; isaf_12_menuo = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    $('#isaf_2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_isaf_2").show();
            isaf_2_menuo = deklaracija['isaf_2_kaina']/12;
            isaf_2_metai = deklaracija['isaf_2_kaina'];
            $('#isaf_2_menesis').val(isaf_2_menuo.toFixed(2) + ' €');
            $('#isaf_2_metai').val(isaf_2_metai.toFixed(2) + ' €');
        } else {
            $("#inp_isaf_2").hide();
            $('#isaf_2_menesis').val('');
            $('#isaf_2_metai').val('');
            isaf_2_metai = 0; isaf_2_menuo = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    //deklaraciju I-VAZ
    $('#ivaz').change(function() {
        if($(this).is(":checked")) {
            $("#inp_ivaz").show();
            //patikrinti ar ivestas
            $('#ivaz_kiekis').change(function() {
                var kiekis = $("#ivaz_kiekis").val();
                ivaz_menuo = deklaracija['ivaz_kaina'] * kiekis;
                ivaz_metai = (deklaracija['ivaz_kaina'] * kiekis) * 12;
                $('#ivaz_menesis').val(ivaz_menuo.toFixed(2) + ' €');
                $('#ivaz_metai').val(ivaz_metai.toFixed(2) + ' €');

                //skaiciuojam VISO
                teikimas_viso();
            });
        } else {
            $("#inp_ivaz").hide();
            $('#ivaz_kiekis').val('');
            $('#ivaz_menesis').val('');
            $('#ivaz_metai').val('');
            ivaz_menuo = 0; ivaz_metai = 0;
        }
        //skaiciuojam VISO
        teikimas_viso();
    });

    //funkcija skaiciuoti VISO menesis ir metai
    function teikimas_viso(){
        dk_menesis = parseFloat(ivaz_menuo) + parseFloat(isaf_2_menuo) + parseFloat(isaf_12_menuo) + parseFloat(sav1_menuo) + parseFloat(gpm308_menuo) + parseFloat(fr457_menuo) + parseFloat(pvm_x2_menuo) + parseFloat(pvm_x12_menuo);
        dk_metai = parseFloat(ivaz_metai) + parseFloat(isaf_2_metai) + parseFloat(isaf_12_metai) + parseFloat(sav1_metai) + parseFloat(gpm308_metai) + parseFloat(fr457_metai) + parseFloat(pvm_x2_metai) + parseFloat(pvm_x12_metai);
        $('#teikimas_menesis').val(dk_menesis.toFixed(2) + ' €');
        $('#teikimas_metai').val(dk_metai.toFixed(2) + ' €');
    }

/////////////////////////////////////////////////////////////////////////////////////////////// KITOS PASLAUGOS ////////////////////////////////////////////////////////
    //jei reikalinga kuro apskaita, atsiranda laukelis ivesti kiek transporto priemoniu yra
    $('#kuras').change(function() {
        if($(this).is(":checked")) {
            $("#inp_kuras").show();
            //patikrinti ar ivestas
            $('#kuras_kiekis').change(function() {
                var kiekis = $("#kuras_kiekis").val();
                kuras_menuo = kita['kuras_kaina'] * kiekis;
                kuras_metai = (kita['kuras_kaina'] * kiekis) * 12;
                $('#kuras_menesis').val(kuras_menuo.toFixed(2) + ' €');
                $('#kuras_metai').val(kuras_metai.toFixed(2) + ' €');

                //skaiciuojam viso
                kiti_viso();
            });
        } else {
            $("#inp_kuras").hide();
            $('#kuras_kiekis').val('');
            $('#kuras_menesis').val('');
            $('#kuras_metai').val('');
            kuras_menuo = 0; kuras_metai = 0;
        }
        //skaiciuojam viso
        kiti_viso();
    });

    //tvarkyti dokumentus susijusius su gamtos apsauga
    $('#gamtos_apsauga').change(function() {
        if($(this).is(":checked")) {
            $("#inp_apsauga").show();
            apsauga_menuo = kita['gamtos_apsauga']/12;
            apsauga_metai = kita['gamtos_apsauga'];
            $('#apsauga_menesis').val(apsauga_menuo.toFixed(2) + ' €');
            $('#apsauga_metai').val(apsauga_metai.toFixed(2) + ' €');
        } else {
            $("#inp_apsauga").hide();
            $('#apsauga_menesis').val('');
            $('#apsauga_metai').val('');
            apsauga_metai = 0; apsauga_menuo = 0;
        }
        //skaiciuojam viso
        kiti_viso();
    });

    //Zemes mokestis
    $('#zemes_mokestis').change(function() {
        if($(this).is(":checked")) {
            $("#inp_zemes").show();
            $('#zemes_kiekis').change(function() {
                var kiekis = $("#zemes_kiekis").val();
                zemes_menuo = (kita['zemes_mokestis']*kiekis)/12;
                zemes_metai = kita['zemes_mokestis']*kiekis;
                $('#zemes_menesis').val(zemes_menuo.toFixed(2) + ' €');
                $('#zemes_metai').val(zemes_metai.toFixed(2) + ' €');

                //skaiciuojam viso
                kiti_viso();
            });
        } else {
            $("#inp_zemes").hide();
            $('#zemes_kiekis').val('');
            $('#zemes_menesis').val('');
            $('#zemes_metai').val('');
            zemes_metai = 0; zemes_menuo = 0;
        }
        //skaiciuojam viso
        kiti_viso();
    });

    //ES paramos gavimas, jei taip papildomai tvarkomi dokumentai, uztai irgi reik moketi
    $('#europa').change(function() {
        if($(this).is(":checked")) {
            $("#inp_europa").show();
            europa_menuo = kita['europa_kaina']/12;
            europa_metai = kita['europa_kaina'];
            $('#europa_menesis').val(europa_menuo.toFixed(2) + ' €');
            $('#europa_metai').val(europa_metai.toFixed(2) + ' €');
        } else {
            $("#inp_europa").hide();
            $('#europa_menesis').val('');
            $('#europa_metai').val('');
            europa_menuo = 0; europa_metai = 0;
        }
        //skaiciuojam viso
        kiti_viso();
    });

    //KITOS PASLAUGOS
    $('#kitos_paslaugos').change(function() {
        if($(this).is(":checked")) {
            $("#inp_kitos_paslaugos").show();
            //patikrinti ar ivestas
            $('#kitos_paslaugos_kiekis').change(function() {
                var kiekis = $("#kitos_paslaugos_kiekis").val();
                kitos_paslaugos_menuo = kita['kitos_paslaugos_kaina'] * kiekis;
                kitos_paslaugos_metai = (kita['kitos_paslaugos_kaina'] * kiekis) * 12;
                $('#kitos_paslaugos_menesis').val(kitos_paslaugos_menuo.toFixed(2) + ' €');
                $('#kitos_paslaugos_metai').val(kitos_paslaugos_metai.toFixed(2) + ' €');

                //skaiciuojam viso
                kiti_viso();
            });
        } else {
            $("#inp_kitos_paslaugos").hide();
            $('#kitos_paslaugos_kiekis').val('');
            $('#kitos_paslaugos_menesis').val('');
            $('#kitos_paslaugos_metai').val('');
            kitos_paslaugos_menuo = 0; kitos_paslaugos_metai = 0;
        }
        //skaiciuojam viso
        kiti_viso();
    });



    //funkcija skaiciuoti VISO menesis ir metai
    function kiti_viso(){
        kt_menesis = parseFloat(europa_menuo) + parseFloat(zemes_menuo) + parseFloat(apsauga_menuo) + parseFloat(kuras_menuo) + parseFloat(kitos_paslaugos_menuo);
        kt_metai = parseFloat(europa_metai) + parseFloat(zemes_metai) + parseFloat(apsauga_metai) + parseFloat(kuras_metai) + parseFloat(kitos_paslaugos_metai);
        $('#kiti_menesis').val(kt_menesis.toFixed(2) + ' €');
        $('#kiti_metai').val(kt_metai.toFixed(2) + ' €');
    }

//////////////////////////////////////////////////////////////////////////////////////// NUOLAIDOS //////////////////////////////////
    //NUolaidos
    $('#laiku_atsiskaito').change(function() {
        nuolaida_input = $("#nuolaida").val();
        if($(this).is(":checked")) {
            nuolaida = parseInt(nuolaida_input)+ procentai['laiku_atsiskaito'];
            $('#nuolaida').val(nuolaida);
        } else {
            nuolaida = parseInt(nuolaida_input) - procentai['laiku_atsiskaito'];
            $('#nuolaida').val(nuolaida);
        }
    });

    $('#seimos_nariai').change(function() {
        nuolaida_input = $("#nuolaida").val();
        if($(this).is(":checked")) {
            nuolaida = parseInt(nuolaida_input) + procentai['seimos_nariai'];
            $('#nuolaida').val(nuolaida);
        } else {
            nuolaida = parseInt(nuolaida_input) - procentai['seimos_nariai'];
            $('#nuolaida').val(nuolaida);
        }
    });

    $('#laiku_dokumentai').change(function() {
        nuolaida_input = $("#nuolaida").val();
        if($(this).is(":checked")) {
            nuolaida = parseFloat(nuolaida_input) + procentai['laiku_dokumentai'];
            $('#nuolaida').val(nuolaida);
        } else {
            nuolaida = parseFloat(nuolaida_input) - procentai['laiku_dokumentai'];
            $('#nuolaida').val(nuolaida);
        }
    });

    //Skaiciuojam viska, arba naujam lange suformuojam, kainyno ataskaita
    $("#skaitciuoti").click(function(e) {
        e.preventDefault();
        nuolaida_input = $("#nuolaida").val();


        //sutvarkyti pagal taip kaip isdestyta
        viso_menuo = baz_menesis + uki_menesis + dk_menesis + kt_menesis + uzm_menesis;
        viso_metai = baz_metai + uki_metai + dk_metai + kt_metai + uzm_metai;

        //paskaiciuojam nuolaida
        nuolaida_menuo = viso_menuo * (nuolaida_input/100);
        nuolaida_metai = viso_metai * (nuolaida_input/100);

        viso_menuo = viso_menuo - nuolaida_menuo;
        viso_metai = viso_metai - nuolaida_metai;

        $('#nuolaida').val(nuolaida_input);
        $('#nuolaida_menesis').val(nuolaida_menuo.toFixed(2) + ' €');
        $('#nuolaida_metai').val(nuolaida_metai.toFixed(2) + ' €');

        $('#viso_menesis').val(viso_menuo.toFixed(0) + ' €');
        $('#viso_metai').val(viso_metai.toFixed(0) + ' €');
    });

    function deklaruotas_plotas(){
        //deklaruoto ploto kiekis,
        var plotas = $("#dek_plotas").val();
        //paimam reiksme kokia bandos tipas
        galvijai_banda = $('input[name=banda]:checked').val();

        if(!galvijai_banda){
            dek_menuo = (ukis['augalai']*plotas)/12;
            dek_metai = ukis['augalai']*plotas;
        }else{
            dek_menuo = (ukis['galvijai']*plotas)/12;
            dek_metai = ukis['galvijai']*plotas;
        }
        //issisaugojam reiksmes, is php paimtas, kad uzdarius laukeliai issivalytu, o atidarius vel atsirastu
        dek_plotas2 = plotas;

        //sukelia gyvulinkystes sumas
        $('#dek_menesis').val(dek_menuo.toFixed(2)+ ' €');
        $('#dek_metai').val(dek_metai.toFixed(2) + ' €');
    }


    function galviju_kiekis(){
        var kiek = $("#galvijai_kiekis").val();
        //paimam reiksme kokia bandos tipas
        galvijai_banda = $('input[name=banda]:checked').val();

        //pagal bandos tipa, skaiciuoja kaina
        if(galvijai_banda === '2'){
            galvijai_menuo = (ukis['ne_melziamos']*kiek)/12;;
            galvijai_metai = ukis['ne_melziamos']*kiek;
        }
        if(galvijai_banda === '1'){
            galvijai_menuo = (ukis['melziamos']*kiek)/12;
            galvijai_metai = ukis['melziamos']*kiek;
        }
        if(galvijai_banda === '3'){
            galvijai_menuo = (((ukis['ne_melziamos'] + ukis['melziamos'])*kiek)/2)/12;
            galvijai_metai = ((ukis['ne_melziamos'] + ukis['melziamos'])*kiek)/2;
        }

        //sukelia gyvulinkystes sumas
        $('#galvijai_menesis').val(galvijai_menuo.toFixed(2) + ' €');
        $('#galvijai_metai').val(galvijai_metai.toFixed(2) + ' €');
    }

///////////////////////////////////////////////////////////////// KITKA //////////////////////////////////////////////////////////////////////////////

});