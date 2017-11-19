function PrintElem(elem) {
    window.print();
}

$(function(){
    $("#btnPrint").printPreview({
        obj2print: '.table-responsive',
        width: '1620',

        /*optional properties with default values*/
        //obj2print:'body',     /*if not provided full page will be printed*/
        //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
        //width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
        //height:screen.height, /*if not provided its height will be equal to screen height*/
        //top:0,                /*if not provided its top position will be zero*/
        //left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
        //resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
        //scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
        //status:'no',          /*yes or no default is yes, * do not work in some browsers*/
        title:'Spausdinimas' /*title of print preview popup window*/
    });

});

function Popup(data) {
    var myWindow = window.open('', 'Spausdinti', 'height=800,width=1200');
    myWindow.document.write('<html><head><title>Spausdinti</title>');
    /*optional stylesheet*/ myWindow.document.write('<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">');
    /*optional stylesheet*/ myWindow.document.write('<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/mano.css" media="print">');

    myWindow.document.write('</head><body >');
    myWindow.document.write(data);
    myWindow.document.write('</body></html>');
    myWindow.document.close(); // necessary for IE >= 10

    myWindow.onload=function(){ // necessary if the div contain images

        myWindow.focus(); // necessary for IE >= 10
        myWindow.print();
        myWindow.close();
    };
}

$(document).ready(function() {
    $('#btn_view').on('click', function (e) {
        $('#kiekis').val('');
        $('#kiekis').val($(this).data("value"));
    });
});

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

    $('#is_kuras').change(function() {
        if($(this).is(":checked")) {$("#inp_kuras").show();} else {$("#inp_kuras").hide();}
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

$(document).ready(function(){
    var bazine_kaina = {
        darbuotojai: {vykdomi_rastai: 12, be_vykdomu_rastu: 10},
        pirminiai_dokumentai: {p100: 75, p250: 150, p500: 200, p750: 250, p1000: 300}
    };
    var galvijai = [
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
        {kiekis: 25, parduodantys: 2.50, savo_reikmems: 1.50},
        {kiekis: 50, parduodantys: 3.00, savo_reikmems: 2.00},
        {kiekis: 75, parduodantys: 3.50, savo_reikmems: 2.50},
        {kiekis: 100, parduodantys: 4.00, savo_reikmems: 3.00},
        {kiekis: 1000, parduodantys: 4.50, savo_reikmems: 2.25}
    ];
    var bankas = 7;
    var kreditas = 6;

    var pirminiai_kiek=0, pirminiai_menuo=0, pirminiai_metai=0;
    var darb_2_kiekis=0, darb_2_menuo=0, darb_2_metai=0;
    var darb_kiekis=0, darb_menuo=0, darb_metai=0;
    var viso_menuo=0, viso_metai=0;
    var galvijai_menuo=0, galvijai_metai=0, galvijai_banda;
    var dek_menuo=0, dek_metai=0;
    var bankai_kiek=0, bankai_menuo=0, bankai_metai=0;
    var kreditai_kiek=0, kreditai_menuo=0, kreditai_metai=0;

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

    //duomenys i INPUT paduodami s PHP, todel apskaiciuoja uzsikraunant puslapiui
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

    //Bankai, kreditai, deklaraciju teikimas
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


    //Skaiciuojam viska, arba naujam lange suformuojam, kainyno ataskaita
    $("#skaitciuoti").click(function(e) {
        e.preventDefault();
        viso_menuo = pirminiai_menuo + darb_2_menuo + darb_menuo + galvijai_menuo + dek_menuo + kreditai_menuo + bankai_menuo;
        viso_metai = pirminiai_metai + darb_2_metai + darb_metai + galvijai_metai + dek_metai + kreditai_metai + bankai_metai;
        $('#viso_menesis').val(viso_menuo.toFixed(2) + ' €');
        $('#viso_metai').val(viso_metai.toFixed(2) + ' €');
    });

    $("#formuoti").click(function(e) {
        e.preventDefault();
        alert('paspausta');
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
        }
    });

});