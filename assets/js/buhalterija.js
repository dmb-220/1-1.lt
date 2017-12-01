//perkrovus puslapi, lieka paskutinis aktyvus TAB'AS
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

//rodo tik tai kas pasirinkta / paspausta
$(document).ready(function() {

    $('#pradiniai_likuciai').click(function () {
        $('#pradiniai_likuciai_show').toggle();
        $('#apyvarta_show, #fr0457_show, #nusidevejimas_show, #momentiniai_likuciai_show, #paramos_perskaiciavimas_show').hide()
    });

    $('#apyvarta').click(function () {
        $('#apyvarta_show').toggle();
        $('#pradiniai_likuciai_show, #fr0457_show, #nusidevejimas_show, #momentiniai_likuciai_show, #paramos_perskaiciavimas_show').hide()
    });

    $('#fr0457').click(function () {
        $('#fr0457_show').toggle();
        $('#pradiniai_likuciai_show, #apyvarta_show, #nusidevejimas_show, #momentiniai_likuciai_show, #paramos_perskaiciavimas_show').hide()
    });

    $('#nusidevejimas').click(function () {
        $('#nusidevejimas_show').toggle();
        $('#pradiniai_likuciai_show, #apyvarta_show, #fr0457_show, #momentiniai_likuciai_show, #paramos_perskaiciavimas_show').hide()
    });

    $('#momentiniai_likuciai').click(function () {
        $('#momentiniai_likuciai_show').toggle();
        $('#pradiniai_likuciai_show, #apyvarta_show, #fr0457_show, #nusidevejimas_show, #paramos_perskaiciavimas_show').hide()
    });

    $('#paramos_perskaiciavimas').click(function () {
        $('#paramos_perskaiciavimas_show').toggle();
        $('#pradiniai_likuciai_show, #apyvarta_show, #fr0457_show, #nusidevejimas_show, #momentiniai_likuciai_show').hide()
    });

    //pasirenkam eksplotacijos data
    $('#data_eksplotacija .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });
    //pasirenkam EU paramos gavimo data
    $('#data_paramos_gavimo .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });
    //pasirenkam isigyjimo data
    $('#data_isigyjimo .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });
});

//kitos funkcijos