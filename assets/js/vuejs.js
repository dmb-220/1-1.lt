var datepickerComponent = Vue.extend({
    //v-el:select
    template: '<div class="input-group date" v-el:inputgroup>' +
    '<input name="data" type="text" class="form-control" v-model="value"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' +
    '</div>',
    props: {
        value: ''
    },
    data: function() {
        return {};
    },
    ready: function() {
        $(this.$els.inputgroup).datepicker({
            weekStart: 1,
            defaultViewDate: "today",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    }
});

Vue.component('datepicker', datepickerComponent);

new Vue({
    el: '#app',

    data: {
        startDate_1: '',
        startDate_2: '',
        paslaugu_sutartis: '',
    },
    ready: function() {},
    methods: {},
    watch: {}
});
