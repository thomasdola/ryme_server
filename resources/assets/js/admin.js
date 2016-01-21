import Vue from 'vue';
Vue.use(require('vue-resource'));
var numberUtils = require('mout/number');

//import components
import StaffTable from './components/staff-table.vue';
import EditModal from './components/edit-staff-form.vue';

Vue.config.debug = true;
Vue.filter('abbreviate', function(value){
    return numberUtils.abbreviate(value);
});
new Vue({
    el: "section.content",
    methods: {
        saveRole(){
            this.savingRole = true;
            console.log(this.newRole);
        },
        saveStaff(){
            this.savingStaff = true;
            console.log(this.newStaff);
        }
    },
    components: {StaffTable, EditModal},
    events: {},
    created(){
        console.log('main Component created');
    },
    ready(){
        console.log('now ready');
    },
    data: {
        savingRole: false,
        savingStaff: false,
        newRole: {
            title: ''
        },
        newStaff: {
            name: '',
            email: '',
            role_id: ''
        },
        roles: [
            {title: 'Admin', id: 1, users: 3},
            {title: 'Marketing', id: 2, users: 3},
            {title: 'Manager', id: 3, users: 3}
        ],
        staffs: [
            {
                name: 'thomas dola',
                email: 'thomasdolar@gmail.com',
                role: {title: 'Admin', id: 1}
            },
            {
                name: 'son selorm',
                email: 'sonselorm@gmail.com',
                role: {title: 'Admin', id: 1}
            }
        ],
        staff: {}
    }
});