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
        sekcija: 0,
        rodyti_skyrius: false,
        skyrius: 0,
        skyriu_sarasas: [],
        rodyti_grupe: false,
        grupe: 0,
        grupiu_sarasas: [],
        rodyti_klase: false,
        klase: 0,
        klasiu_sarasas: [],
        rodyti_poklase: false,
        poklase: 0,
        poklasiu_sarasas: [],
        //darbuotojai
        darbuotojai: 0,
        rodyti_darbuotojus: false,
        darbuotojai2: 0,
        rodyti_darbuotojus2: false,
        darbuotojai_kiekis: 0,
        darbuotojai2_kiekis: 0,
        darbuotoju_deklaracijos: false,
        //deklaracijos
        pvm: 0,
        rodyti_pvm: false,
        gpm: 0,
        rodyti_gpm: false
    },

    computed: {
    },

    methods: {
        rodyti_deklaracijas: function () {
            if(this.darbuotojai_kiekis > 0 || this.darbuotojai2_kiekis > 0){
                this.darbuotoju_deklaracijos = true;
            }else{
                this.darbuotoju_deklaracijos = false;
            }
        },
        //reiketu isvalyti sasrasus ir nustatytimi i pradine reiksme
        gauti_skyriu: function () {
            if(this.sekcija != 0) {
                this.$http.post('EVRK_skyriai', {
                    sekcija: this.sekcija
                })
                    .then(function (response) {
                        this.skyriu_sarasas = response.body;
                        this.rodyti_skyrius = true;
                        this.rodyti_grupe = false;
                        this.rodyti_klase = false;
                        this.rodyti_poklase = false;
                        this.skyrius = 0;
                        //console.log(response.body);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }else{ this.rodyti_skyrius = false;}
        },
        gauti_grupe: function () {
            if(this.skyrius != 0) {
                this.$http.post('EVRK_grupes', {
                    skyrius: this.skyrius
                })
                    .then(function (response) {
                        this.grupiu_sarasas = response.body;
                        this.rodyti_grupe = true;
                        this.rodyti_klase = false;
                        this.rodyti_poklase = false;
                        this.grupe = 0;
                        //console.log(response.body);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }else{this.rodyti_grupe = false;}
        },
        gauti_klase: function () {
            if(this.grupe != 0) {
                this.$http.post('EVRK_klases', {
                    grupe: this.grupe
                })
                    .then(function (response) {
                        this.klasiu_sarasas = response.body;
                        this.rodyti_klase = true;
                        this.rodyti_poklase = false;
                        this.klase = 0;
                        //console.log(response.body);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }else{this.rodyti_klase = false;}
        },

        gauti_poklase: function () {
            if(this.klase != 0) {
                this.$http.post('EVRK_poklases', {
                    klase: this.klase
                })
                    .then(function (response) {
                        this.poklasiu_sarasas = response.body;
                        if(this.poklasiu_sarasas.length > 0){
                            this.rodyti_poklase = true;
                        }else{
                            this.rodyti_poklase = false;
                            this.poklasiu_sarasas = [];
                            this.poklase = 0;
                        }
                        console.log(response.body);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }else{this.rodyti_poklase = false;}
        },
    }

});