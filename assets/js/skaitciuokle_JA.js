// Set the global configs to synchronous
$.ajaxSetup({
    async: false
});

//sutartties sablono sukurimas
$(document).ready(function(){
    //Pagrindiniai kintamieji
    var pvm_moketojas;

    //Ziurim ar PVM moketojas ar ne
    $('input:radio[name=pvm_moketojas]').change(function() {
        pvm_moketojas = $('input[name=pvm_moketojas]:checked').val();
        if(pvm_moketojas === '2'){
            $("#inp_pvm_moketojas").show();
        }else{
            $("#inp_pvm_moketojas").hide();
        }
        console.log(pvm_moketojas);
    });

});

Vue.http.options.emulateJSON = true; // send as
//Vue.component('v-select', VueSelect.VueSelect);


new Vue({
    el: '#skaitciuokle_JA',
    data: {
        rodyti_pvm_moketoja: false,
        pvm_moketojas: '',
        sekcija: '',
        rodyti_skyrius: false,
        skyrius: '',
        skyriu_sarasas: []
    },

    computed: {
    },

    methods: {
        gauti_skyriu: function () {
            this.$http.post('EVRK_JA', {
                sekcija: this.sekcija
            })
                .then(function (response) {
                    this.skyriu_sarasas = response.body;
                    this.rodyti_skyrius=true;
                    //console.log(response.body);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        rodo_pvm_moketoja: function () {
            this.rodyti_pvm_moketoja = true;
        },
        nerodo_pvm_moketoja: function () {
            this.rodyti_pvm_moketoja = false;
        }
    }

});