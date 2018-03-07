//Spauzdinimas
function PrintElem(elem) {
    window.print();
}
//////////////////////////////////////////////// Vidurkiai ///////////////////////////

//////////////////////////////////////////////// Ukininkai ////////////////////////////////////////////////////////////
$(document).ready(function() {
    var vic_lt = '#vic_lt';
    var papildomi = '#papildomi';

    //jei turi VIC.LT, pazymi ir gali suvesti prisijungimo duomenis
    $(vic_lt).change(function() {
        if($(this).is(":checked")) {
            $("#in_vic_lt").show();
        } else {
            $("#in_vic_lt").hide();
        }
    });

    $(papildomi).change(function() {
        if($(this).is(":checked")) {
            $("#in_papildomi").show();
        } else {
            $("#in_papildomi").hide();
        }
    });

    //jei yra klaidu, persikrauna FORMA. jei buvo pazymeta, lieka ir atsidaro tie laukai
    if($('#vic_lt').is(":checked")) {
        $("#in_vic_lt").show();}

    if($('#papildomi').is(":checked")) {
        $("#in_papildomi").show();}

    if($("input:radio[name=tipas][value='0']").is(":checked")){
        $("#in_galviju_banda").show();
    }


    //pagal ukio tipa, atsiranda pasirinkimas, pakolkas gyvulininkyste skirstoma i bandas
    $('input[type=radio][name=tipas]').change(function() {
        if (this.value == '0') {
            $("#in_galviju_banda").show();}else{
            $("#in_galviju_banda").hide();
        }
        //galimybe praplesti, jei reikes kitus tipus skirstyti
    });

});
////////////////////////////////////////////////////////////////////// SENAS KODAS /////////////////////////////////////////////////////////////
//permeta duomenis i MODAL
$('#prideti').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var uid = button.data('id');
    var uname = button.data('name');
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-title').text('Pridėti narius į ' + uname);
    modal.find('.modal-body #recipient-name').val(uname);
    modal.find('.modal-body #recipient-name-2').val(uid);
});


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
