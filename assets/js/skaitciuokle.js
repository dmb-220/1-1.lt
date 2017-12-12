//sutartties sablono sukurimas
$(document).ready(function(){
    var bazine_kaina = {
        darbuotojai: {vykdomi_rastai: 12, be_vykdomu_rastu: 10},
        pirminiai_dokumentai: {p100: 75, p250: 150, p500: 200, p750: 250, p1000: 300}
    };
    var galvijai = [
        {kiekis: 0, melziamos: 0, ne_melziamos: 0},
        {kiekis: 20, melziamos: 20, ne_melziamos: 15},
        {kiekis: 40, melziamos: 30, ne_melziamos: 20},
        {kiekis: 60, melziamos: 35, ne_melziamos: 20},
        {kiekis: 80, melziamos: 60, ne_melziamos: 25},
        {kiekis: 100, melziamos: 75, ne_melziamos: 25},
        {kiekis: 120, melziamos: 75, ne_melziamos: 20},
        {kiekis: 140, melziamos: 75, ne_melziamos: 25},
        {kiekis: 160, melziamos: 80, ne_melziamos: 30},
        {kiekis: 180, melziamos: 100, ne_melziamos: 35},
        {kiekis: 200, melziamos: 110, ne_melziamos: 40},
        {kiekis: 250, melziamos: 120, ne_melziamos: 45},
        {kiekis: 3000, melziamos: 150, ne_melziamos: 65}
    ];
    var deklaruota = [
        {kiekis: 0, parduodantys: 0, savo_reikmems: 0},
        {kiekis: 25, parduodantys: 2.50, savo_reikmems: 1.50},
        {kiekis: 50, parduodantys: 3.00, savo_reikmems: 2.00},
        {kiekis: 75, parduodantys: 3.50, savo_reikmems: 2.50},
        {kiekis: 100, parduodantys: 4.00, savo_reikmems: 3.00},
        {kiekis: 1000, parduodantys: 4.50, savo_reikmems: 2.25}
    ];
    var bankas = 7;
    var kreditas = 6;
    var saskaita_kaina = 45;
    var kuras_kaina = 5;
    var gamtos_apsauga = 100;
    var europa_kaina = 30;

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

    console.log(JSON.stringify(galvijai));

    $.getJSON('kainos.json', function (data) {
        console.log(JSON.stringify(data));
    });

    //sukaiciuojam piminiu dokumentu ruosimo kaina, pagal pasirinktus duomenis
    $('#pirminiai').change(function() {
        pirminiai_kiek = $("#pirminiai").val();
        pirminiai_menuo = bazine_kaina.pirminiai_dokumentai['p'+pirminiai_kiek]/12;
        pirminiai_metai = bazine_kaina.pirminiai_dokumentai['p'+pirminiai_kiek];
        //skaiciuojam tik pirmini
        $('#pirminiai_metai').val(pirminiai_metai.toFixed(2)+' €');
        $('#pirminiai_menuo').val(pirminiai_menuo.toFixed(2)+' €');
    });
    //sukaiciuojam darbuotojus, ir ir kokiu
    $('#darbuotojai_2_kiekis').change(function() {
        darb_2_kiekis = $("#darbuotojai_2_kiekis").val();
        darb_2_menuo = (bazine_kaina.darbuotojai['be_vykdomu_rastu']*darb_2_kiekis)/12;
        darb_2_metai = bazine_kaina.darbuotojai['be_vykdomu_rastu']*darb_2_kiekis;
        //skaiciuojam darbuotojus be rastu
        $('#darbuotojai_2_metai').val(darb_2_metai.toFixed(2)+' €');
        $('#darbuotojai_2_menesis').val(darb_2_menuo.toFixed(2)+' €');
    });

    $('#darbuotojai_kiekis').change(function() {
        darb_kiekis = $("#darbuotojai_kiekis").val();
        darb_menuo = (bazine_kaina.darbuotojai['vykdomi_rastai']*darb_kiekis)/12;
        darb_metai = bazine_kaina.darbuotojai['vykdomi_rastai']*darb_kiekis;
        //skaiciuojam darbuotojus su  rastais
        $('#darbuotojai_metai').val(darb_metai.toFixed(2)+' €');
        $('#darbuotojai_menesis').val(darb_menuo.toFixed(2)+' €');
    });

    //duomenys i INPUT paduodami is PHP, todel apskaiciuoja uzsikraunant puslapiui
    //skaiciujam gyvulinkystes kaina
    var kiek = $("#galvijai_kiekis").val();
    var masyvas = $.grep(galvijai, function (idx) {
        return idx.kiekis >= kiek;
    });
    //skaiciuojam deklaruota plota
    var plotas = $("#dek_plotas").val();
    var laukas = $.grep(deklaruota, function (idx) {
        return idx.kiekis >= plotas;
    });

    //paimam reiksme kokia bandos tipas
    galvijai_banda = $('input[name=banda]:checked').val();

    //pagal bandos tipa, skaiciuoja kaina
    if(galvijai_banda == 2){
        galvijai_menuo = masyvas[0].ne_melziamos;
        galvijai_metai = masyvas[0].ne_melziamos*12;
        dek_menuo = (laukas[0].parduodantys*plotas)/12;
        dek_metai = laukas[0].parduodantys*plotas;
    }
    if(galvijai_banda == 1){
        galvijai_menuo = masyvas[0].melziamos;
        galvijai_metai = masyvas[0].melziamos*12;
        dek_menuo = (laukas[0].savo_reikmems*plotas)/12;
        dek_metai = laukas[0].savo_reikmems*plotas;
    }
    if(galvijai_banda == 3){
        galvijai_menuo = (masyvas[0].ne_melziamos + masyvas[0].melziamos)/2;
        galvijai_metai = ((masyvas[0].ne_melziamos + masyvas[0].melziamos)/2)*12;
        dek_menuo = (((laukas[0].parduodantys + laukas[0].savo_reikmems)/2)*plotas)/12;
        dek_metai = (((laukas[0]).parduodantys + laukas[0].savo_reikmems)/2)*plotas;
    }

    //sukelia gyvulinkystes sumas
    $('#galvijai_menesis').val(galvijai_menuo.toFixed(2) + ' €');
    $('#galvijai_metai').val(galvijai_metai.toFixed(2) + ' €');
    $('#dek_menesis').val(dek_menuo.toFixed(2)+ ' €');
    $('#dek_metai').val(dek_metai.toFixed(2) + ' €');

    //Bankai, kreditai
    $('#bankai').change(function() {
        bankai_kiek = $("#bankai").val();
        bankai_menuo = bankai_kiek*bankas;
        bankai_metai= (bankai_kiek*bankas)*12;
        $('#bankai_menesis').val(bankai_menuo.toFixed(2) + ' €');
        $('#bankai_metai').val(bankai_metai.toFixed(2) + ' €');
    });
    $('#kreditai').change(function() {
        kreditai_kiek = $("#kreditai").val();
        kreditai_menuo = kreditai_kiek*kreditas;
        kreditai_metai= (kreditai_kiek*kreditas)*12;
        $('#kreditai_menesis').val(kreditai_menuo.toFixed(2) + ' €');
        $('#kreditai_metai').val(kreditai_metai.toFixed(2) + ' €');
    });

    //jei reikalinga kuro apskaita, atsiranda laukelis ivesti kiek transporto priemoniu yra
    $('#kuras').change(function() {
        if($(this).is(":checked")) {
            $("#inp_kuras").show();
            //patikrinti ar ivestas
            $('#kuras_kiekis').change(function() {
                var kiekis = $("#kuras_kiekis").val();
                kuras_menuo = kuras_kaina * kiekis;
                kuras_metai = (kuras_kaina * kiekis) * 12;
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
            apsauga_menuo = gamtos_apsauga/12;
            apsauga_metai = gamtos_apsauga;
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
            europa_menuo = europa_kaina/12;
            europa_metai = europa_kaina;
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
            saskaita_menuo = saskaita_kaina/12;
            saskaita_metai = saskaita_kaina;
            $('#saskaita_menesis').val(saskaita_menuo.toFixed(2) + ' €');
            $('#saskaita_metai').val(saskaita_metai.toFixed(2) + ' €');
        } else {
            $("#inp_saskaita").hide();
            $('#saskaita_menesis').val('');
            $('#saskaita_metai').val('');
            saskaita_menuo = 0; saskaita_metai = 0;
        }
    });

    //pasidarom kad nereiketu vesti
    $('#bankai').bootstrapNumber();
    $('#kreditai').bootstrapNumber();
    $('#kuras_kiekis').bootstrapNumber();
    $('#darbuotojai_2_kiekis').bootstrapNumber();
    $('#darbuotojai_kiekis').bootstrapNumber();


    //Skaiciuojam viska, arba naujam lange suformuojam, kainyno ataskaita
    $("#skaitciuoti").click(function(e) {
        e.preventDefault();
        viso_menuo = pirminiai_menuo + darb_2_menuo + darb_menuo + galvijai_menuo + dek_menuo + kreditai_menuo + bankai_menuo + europa_menuo + saskaita_menuo + kuras_menuo + apsauga_menuo;
        viso_metai = pirminiai_metai + darb_2_metai + darb_metai + galvijai_metai + dek_metai + kreditai_metai + bankai_metai + europa_metai + saskaita_metai + kuras_metai + apsauga_metai;
        $('#viso_menesis').val(viso_menuo.toFixed(2) + ' €');
        $('#viso_metai').val(viso_metai.toFixed(2) + ' €');
    });


    //isjungiam ijungiam pagal pasirinkima
    $('#is_rastai').change(function() {
        if($(this).is(":checked")) {
            $("#inp_rastai").show();
        } else {
            $("#inp_rastai").hide(); $("#inp_darbininkai").hide(); $("#inp_darbininkai_2").hide();
            $("#is_darbininkai").prop( "checked", false );
            $("#is_darbininkai_2").prop( "checked", false );
            pirminiai_kiek=0; pirminiai_menuo=0; pirminiai_metai=0;
            darb_2_kiekis=0; darb_2_menuo=0; darb_2_metai=0;
            darb_kiekis=0; darb_menuo=0; darb_metai=0;
            $('#pirminiai_metai').val('');
            $('#pirminiai_menuo').val('');
            $('#darbuotojai_2_metai').val('');
            $('#darbuotojai_2_menesis').val('');
            $('#darbuotojai_2_kiekis').val('');
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

    $('#is_darbininkai_2').change(function() {
        if($(this).is(":checked")) {
            $("#inp_darbininkai_2").show();
        } else {
            $("#inp_darbininkai_2").hide();
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

});