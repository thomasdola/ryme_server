import Vue from "vue";
var VueValidator = require('vue-validator');

Vue.use(require('vue-resource'));
Vue.use(VueValidator);
Vue.config.warnExpressionErrors = false;

//import components
//import { Datepicker } from 'vue-strap';

var numberUtils = require('mout/number');

Vue.filter('abbreviate', function(value){
    return numberUtils.abbreviate(value)
});

new Vue({
    el: "section.content",
    components: {},
    methods: {
        saveCompany(){
            let name = this.newCompany.name.trim();
            if(name){
                this.savingCompany = true;
                console.log(name);
            }
        },
        saveAd(){
            let title = this.newAd.title.trim();
            let startDate = this.newAd.startDate;
            let endDate = this.newAd.endDate;
            let company_id = this.newAd.company_id;
            var formData = new FormData();
            if( title && company_id && endDate && startDate){
                this.savingAd = true;
                formData.append('file', this.$els.audio.files[0]);
                this.newAd.audio_file = formData;
            }
        }
    },
    data: {
        savingCompany: false,
        savingAd: false,
        companies: [
            {name: 'Airtel', id: 1},
            {name: 'Tigo', id: 2},
            {name: 'Glo', id: 3},
            {name: 'Vodafone', id: 4}
        ],
        ads: [],
        newCompany:{
            name: ''
        },
        newAd:{
            title: "",
            startDate: "",
            endDate: "",
            company_id: null,
            audio_file: {}
        }
    },
    created(){},
    ready(){}
});