Vue.http.options.emulateJSON = true; // send as

Vue.component('option-item', {
    props: ['option'],
    template: '<option :value=option.id>{{ option.pavadinimas }}</option>'
});

Vue.component('option-pvm', {
    props: ['option'],
    template: '<option :value=option.id>{{ option.kodas }}</option>'
});

Vue.component('tr-item', {
    props: ['todo', 'vnt', 'eur', 'rusis'],
    template: '<tr><td>{{ todo.numeris }}</td><td>{{ todo.metai }}-{{todo.menesis}}-{{ todo.diena }}</td><td>{{ todo.pavadinimas }}</td><td>{{ rusis[todo.dokumento_rusis].pavadinimas }}</td>' +
    '<td>{{ todo.kiekis }}</td><td>{{ vnt[todo.mato_vnt] }}</td><td>{{ eur[todo.atsiskaitymas] }}</td><td>{{ todo.atsiskaitymo_data }}</td><td>{{ todo.be_PVM}}</td>' +
    '<td>{{ todo.PVM }}</td><td>{{ parseFloat(todo.be_PVM) + parseFloat(todo.PVM) }}</td><td>{{ todo.kodas }}</td><td></td></tr>'
});

new Vue({
    el: '#zalia_knyga',
    data: {
        errors:[],
        dokumento_numeris: '',
        data: '',
        organizacija: '',
        dok_rusis: '',
        kiekis: '',
        mato_vnt: '',
        atsiskaitymas: '',
        be_pvm: 0,
        pvm: 0,
        bendra_suma: 0,
        pvm_kodas: '',
        atsiskaitymo_data: '',

        dokumento_rusis: [
            {id: 1, pavadinimas: 'Pirkimas'},
            {id: 2, pavadinimas: 'Pardavimas'},
            {id: 3, pavadinimas: 'Asmeninės lėšos, paėmimas'},
            {id: 4, pavadinimas: 'Asmeninės lėšos, įnešimas'},
            {id: 5, pavadinimas: 'Grynųjų paėmimas'},
            {id: 6, pavadinimas: 'Grynųjų įnešimas'},
            {id: 7, pavadinimas: 'Sumokėta bauda, netesybos, neleistinos palūkanos'},
            {id: 8, pavadinimas: 'Gauta paskola'},
            {id: 9, pavadinimas: 'Sumokėta paskola'},
            {id: 10, pavadinimas: 'Išskirta einam. Metų paskolos dalis'},
            {id: 11, pavadinimas: 'Sunaudota asmenninėms reikmėms ūkio produkcija'},
            {id: 12, pavadinimas: 'Sėja'},
            {id: 13, pavadinimas: 'Derlius'},
            {id: 14, pavadinimas: 'Sumokėtas gyventojų pajamų mokestis'},
            {id: 15, pavadinimas: 'Sumokėtos sodros įmokos'},
            {id: 16, pavadinimas: 'Sumokėtas darbo užmokestis'},
            {id: 17, pavadinimas: 'Ilgalaikio turto pirkimas'},
            {id: 18, pavadinimas: 'Ilgalaikio turto pardavimas'},
            {id: 19, pavadinimas: 'Ilgalaikio turto nusidėvėjimas'},
            {id: 20, pavadinimas: 'Ilgalaikio turto nurašymas'},
            {id: 21, pavadinimas: 'Ilgalaikio turto perkainojimas'}
        ],
        pvm_kodai: [],
        selectPVM: [],
        pvm_info: false,
        organizacijos: [],
        zalia_knyga: [],
        vnt: ['', 'vnt', 'kg', 't', 'l', 'pora'],
        eur: ['', 'Bankas', 'Kasa', 'Skola']
    },
    computed: {
        suma: function() {
            this.bendra_suma = parseInt(this.be_pvm)+parseInt(this.pvm);
        }
    },

    mounted: function() {
        this.$http.get('zalia_knyga')
            .then(function (response) {
                //sukraunam organizaciju sarasa i kintamaji is DB
                for (var i = 0; i < response.body.length; i++) {
                    this.zalia_knyga.push(response.body[i]);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    },

    methods: {
        rastiPVM: function() {
            this.pvm_info = true;
            var length = this.pvm_kodai.length;
            for(var i = 0; i < length; i++) {
                if(this.pvm_kodai[i]['id'] == this.pvm_kodas){
                    this.selectPVM = this.pvm_kodai[i];
                    //console.log(this.pvm_kodai[i]);
                }
            }
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