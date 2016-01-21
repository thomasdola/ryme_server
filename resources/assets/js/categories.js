import Vue from 'vue';
Vue.use(require('vue-resource'));

//import components
import CategoryDetail from "./components/category_detail.vue";
import CategoryList from "./components/category_list.vue";
var numberUtils = require('mout/number');

Vue.filter('abbreviate', function(value){
    return numberUtils.abbreviate(value)
});
new Vue({
    el: "section.content",
    components: {CategoryDetail, CategoryList},
    data: {
        newCategory: {
            name: '',
            saving: false
        },
        categories: [
            {
                name: 'dancehall',
                followers: 10000000
            },
            {
                name: 'highlife',
                followers: 10000000
            },
            {
                name: 'hip hop',
                followers: 10000000
            },
            {
                name: 'gospel',
                followers: 10000000
            },
        ],
        active: {}
    },
    methods: {
        saveCategory(){
            var text = this.newCategory.name.trim();
            if(text){
                this.newCategory.saving = true;
                console.log(text);
                this.newCategory.name = '';
            }
        },
        setActiveCategory(category){
            this.active = category;
        }
    },
    computed: {},
    created(){
        this.setActiveCategory(this.categories[0]);
        this.$emit('initial-active-category', this.active);
        console.log('main component created');
    },
    ready(){
        console.log('main component is now ready');
    },
    events: {
        'category-changed': function(category){
            this.setActiveCategory(category);
            console.log('category changed');
        }
    }
});