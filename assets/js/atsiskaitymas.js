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
    $('#metai, #menesis').on('change',function() {
        if(url === "aprasymas" || url === "nustatymai"){}else{
            uzklausa();
        }
    });


////////////////////////////////////////////////////////////////////////// Banko israsu IKELIMAS/////////////////////////////////////////////
    //atidarom sub-meniu
    $('#israsai_ikelti').on('click', function() {
        $('#in_israsai_ikelti').toggle();
        $("").hide();
        $("#data").html("");
        url = "tuscia";
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