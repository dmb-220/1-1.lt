Vue.http.options.emulateJSON = true; // send as

Vue.component('tr-item', {
    props: ['todo'],
    template: '<tr><td>{{ todo.debetas_kreditas }}</td><td>{{ todo.operacijos_suma }}</td><td>{{ todo.moketojas }}</td><td>{{ todo.gavejas }}</td></tr>'
});

new Vue({
    el: '#israsu_redagavimas',
    data: {
        metai: '2017',
        menesis: '10',
        rodyti_redagavima: false,
        israso_sarasas: false,
        israsas: []
    },
    methods: {
        pasirinkti_israsus: function () {
            this.rodyti_redagavima = !this.rodyti_redagavima;
        },

        rinktis_israsus: function () {
            this.$http.post('israsu_redagavimas', {
                metai: this.metai,
                menesis: this.menesis
            })
                .then(function (response) {
                    this.israsas = response.body;
                    this.israso_sarasas = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }}
});



$(document).ready(function (e) {
    $("#banko_israsas").on('submit',(function(e) {
        e.preventDefault();
        $("#data").empty();
        $.ajax({
            url: "ikelti", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                $("#data").html(data);
            }
        });
    }));

    $(function() {
        $("#israsas").change(function() {
            $("#message").empty();
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["application/xml","text/xml"];
            if(!((imagefile == match[0]) || (imagefile == match[1]))) {
                $("#message").html("<div class='alert alert-danger'>Prašome pasirinkti tinkamą failą. Tinkami failai ISO 20022 XML formato!</div>");
                return false;
            }else{
                $("#message").html("<div class='alert alert-success'>Pasirinktas tinkamo formato failas, galite įkelt!</div>");
                return true;
            }
        });
    });
});

$(document).ready(function(){
    //KINTAMIEJI
    var metai, menesis;
    var pr_metai, pr_menesis;
    //URL kur kreiptis AJAX
    var url = "aprasymas";

    var israsas;

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
    /*$('#metai, #menesis').on('change',function() {
        if(url === "aprasymas" || url === "nustatymai"){}else{
            uzklausa();
        }
    });*/


////////////////////////////////////////////////////////////////////////// Banko israsu IKELIMAS/////////////////////////////////////////////
    //atidarom sub-meniu
    $('#israsai_ikelti').on('click', function() {
        $('#in_israsai_ikelti').toggle();
        $("#in_israsu_redagavimas").hide();
        $("#data").html("");
        url = "tuscia";
    });

////////////////////////////////////////////////////////////////////////// Israsu sarasas /////////////////////////////////////////////
    $('#israsai_sarasas').on('click', function() {
        url = "israsai_sarasas";
        uzklausa();
        url = "tuscias";
        $("#in_israsai_ikelti, #in_israsu_redagavimas").hide();
    });

////////////////////////////////////////////////////////////////////////// ukininkai /////////////////////////////////////////////
    $('#ukininkai').on('click', function() {
        url = "ukininkai";
        uzklausa();
        url = "tuscias";
        $("#in_israsai_ikelti, #in_israsu_redagavimas").hide();
    });

////////////////////////////////////////////////////////////////////////// redagavimas /////////////////////////////////////////////

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