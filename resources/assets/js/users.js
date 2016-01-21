import Vue from "vue";
Vue.use(require('vue-resource'));

//import components
var numberUtils = require('mout/number');

Vue.filter('abbreviate', function(value){
    return numberUtils.abbreviate(value)
});

new Vue({
    el: "section.content",
    components: {},
    methods: {},
    data: {
        users: []
    },
    created(){},
    ready(){}
});


