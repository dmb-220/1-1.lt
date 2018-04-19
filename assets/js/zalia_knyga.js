Vue.http.options.emulateJSON = true; // send as
//Vue.component('v-select', VueSelect.VueSelect);


new Vue({
    el: '#zalia_knyga',
    data: {
        errors:[],
        dokumento_numeris: '',
        data: '',
        organizacija: '',
        dok_rusis: 0,
        kiekis: '',
        mato_vnt: '',
        atsiskaitymas: '',
        be_pvm: 0,
        pvm: 0,
        bendra_suma: 0,
        pvm_kodas: [],
        pvm_nr: 0,
        atsiskaitymo_data: '',
        asm_reikmes: '',
        rodyti_asmeninius: false,
        //jei pasirenkam kad yra asmeniniu
        be_pvm2: 0,
        pvm2: 0,
        bendra_suma2: 0,
        pvm_kodas2: [],
        pvm_nr2: 0,
        //priskirti PVM kodus pasirinkus dokumentu rusi
        dokumento_rusis: [
            {id: 0, pavadinimas: 'Pasirinkite', pvm: ''},
            {id: 1, pavadinimas: 'Pirkimas', pvm: 8}, //PVM1
            {id: 2, pavadinimas: 'Pardavimas', pvm: 8}, //PVM1
            {id: 3, pavadinimas: 'Draudimas', pvm: 14}, //PVM5
            {id: 4, pavadinimas: 'Asmeninės lėšos, paėmimas', pvm: 15}, //PVM6
            {id: 5, pavadinimas: 'Asmeninės lėšos, įnešimas', pvm: ''},
            {id: 6, pavadinimas: 'Grynųjų paėmimas', pvm: ''},
            {id: 7, pavadinimas: 'Grynųjų įnešimas', pvm: ''},
            {id: 8, pavadinimas: 'Sumokėta bauda, netesybos, neleistinos palūkanos', pvm: 50}, //PVM100
            {id: 9, pavadinimas: 'Gauta paskola', pvm: ''},
            {id: 10, pavadinimas: 'Sumokėta paskola'},
            {id: 11, pavadinimas: 'Išskirta einam. Metų paskolos dalis', pvm: ''},
            {id: 12, pavadinimas: 'Sunaudota asmenninėms reikmėms ūkio produkcija', pvm: 15}, //PVM6
            {id: 13, pavadinimas: 'Sėja', pvm: ''},
            {id: 14, pavadinimas: 'Derlius', pvm: ''},
            {id: 15, pavadinimas: 'Sumokėtas gyventojų pajamų mokestis', pvm: ''},
            {id: 16, pavadinimas: 'Sumokėtos sodros įmokos', pvm: ''},
            {id: 17, pavadinimas: 'Sumokėtas darbo užmokestis', pvm: ''},
            {id: 18, pavadinimas: 'Ilgalaikio turto pirkimas', pvm: ''},
            {id: 19, pavadinimas: 'Ilgalaikio turto pardavimas', pvm: ''},
            {id: 20, pavadinimas: 'Ilgalaikio turto nusidėvėjimas', pvm: ''},
            {id: 21, pavadinimas: 'Ilgalaikio turto nurašymas', pvm: ''},
            {id: 22, pavadinimas: 'Ilgalaikio turto perkainojimas', pvm: ''}
        ],
        pvm_kodai: [],
        selectPVM: [],
        pvm_info: false,
        organizacijos: [],
        zalia_knyga: [],
        vnt: ['', 'vnt', 'kg', 't', 'l', 'pora'],
        eur: ['', 'Bankas', 'Kasa', 'Skola'],
        redaguoti_irasa: [],
        istrinti_irasa: []
    },
    computed: {

        pvm: function() {
            return parseInt(this.be_pvm)+parseInt(this.pvm);
        }
    },

    mounted: function () {
            this.$http.get('zalia_knyga')
                .then(function (response) {
                    //sukraunam organizaciju sarasa i kintamaji is DB
                    for (var i = 0; i < response.body.length; i++) {
                        this.zalia_knyga.push(response.body[i]);
                    }
                    //isrykiaujam kad naujausi irasai, virsuje
                    this.zalia_knyga.sort((a, b) => b.za_id - a.za_id);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    methods: {
        suma: function() {
            this.bendra_suma = parseInt(this.be_pvm)+parseInt(this.pvm);
        },

        knyga_redaguoti: function (todo) {
            $('#editmodal').modal('show');
            this.redaguoti_irasa = todo;
        },
        knyga_istrinti: function (todo) {
            $('#deletemodal').modal('show');
            this.istrinti_irasa = todo;
        },

        rodyti_asm_reikmes: function () {
            this.rodyti_asmeninius = !this.rodyti_asmeninius;
            this.be_pvm2 = 0; this.pvm2 = 0;
            this.bendra_suma2 = 0; this.pvm_nr2 = 15;
        },

        rastiPVM: function() {
            this.pvm_info = true;
            for(var i = 0; i < this.pvm_kodai.length; i++){
                if(this.pvm_kodai[i].id == this.pvm_nr){
                    this.pvm_kodas = this.pvm_kodai[i];
                    this.pvm_info = true;
                }
            }
        },

        //priskiriam PVM koda kai pasirenkamas dokumento rusis
        priskirtiPVM: function () {
            //console.log(this.pvm_kodai);
            if (this.dokumento_rusis[this.dok_rusis].pvm !== '') {
                this.pvm_nr = this.dokumento_rusis[this.dok_rusis].pvm;
                for(var i = 0; i < this.pvm_kodai.length; i++){
                    if(this.pvm_kodai[i].id == this.pvm_nr){
                        this.pvm_kodas = this.pvm_kodai[i];
                        this.pvm_info = true;
                    }
                }
            }else{
                this.pvm_nr = 0;}
        },

        //nauja iraso tikrinimas
        checkForm: function() {
            if(this.dokumento_numeris && this.data) return true;
            this.errors = [];
            if(!this.dokumento_numeris) this.errors.push("Įveskite dokumento numerį.");
            if(!this.data) this.errors.push("Pasirinkite dokumento datą.");
        },
        //gaunam irasus apie organizacijas ir pvm
        gauti_sarasa: function () {
            //pasiimam organizaciju sarasus
            this.organizacijos = [];
            this.$http.get('organizaciju_sarasas')
                .then(function (response) {
                    //sukraunam organizaciju sarasa i kintamaji is DB
                    for (var i = 0; i < response.body.length; i++) {
                        this.organizacijos.push(response.body[i]);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            //pasiimam pvm sarasus
            this.pvm_kodai = [];
            this.$http.get('pvm_sarasas')
                .then(function (response) {
                    //sukraunam organizaciju sarasa i kintamaji is DB
                    for (var i = 0; i < response.body.length; i++) {
                        this.pvm_kodai.push(response.body[i]);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        //irasom nauja irasa
        irasyti_nauja_irasa: function () {
            if (this.checkForm()) {
                this.$http.post('naujas_irasas', {
                    numeris: this.dokumento_numeris,
                    data: this.data,
                    organizacija: this.organizacija,
                    dok_rusis: this.dok_rusis,
                    kiekis: this.kiekis,
                    mato_vnt: this.mato_vnt,
                    atsiskaitymas: this.atsiskaitymas,
                    atsiskaitymo_data: this.atsiskaitymo_data,
                    be_pvm: this.be_pvm,
                    pvm: this.pvm,
                    pvm_kodas: this.pvm_kodas
                })
                    .then(function (response) {
                        //this.israsas = response.body;
                        console.log(response.body);
                        //$('#naujas_irasas').modal('hide');
                        window.location.href = "https://1-1.lt/zalia_knyga/knyga"
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
});