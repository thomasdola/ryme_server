import Vue from 'vue';
Vue.use(require('vue-resource'));

//import components
import InfoBox from "./components/infoBox.vue";
import Search from "./components/search.vue";
import TrendingArtists from "./components/trendingArtistTable.vue";
import VouchingRequests from "./components/vouchingRequestsTable.vue";
var numberUtils = require('mout/number');

Vue.filter('abbreviate', function(value){
    return numberUtils.abbreviate(value)
});

new Vue({
    el: 'section.content',
    data: {
        data: {
            joinedToday:{
                title: 'Artists Joined Today',
                total: 2000
            },
            joinedThisWeek:{
                title: 'Artists Joined This Week',
                total: 2000
            },
            joinedThisMonth:{
                title: 'Artists Joined This Month',
                total: 2000
            },
            all:{
                title: 'Total Artists',
                total: 2000
            },
            requests: [
                {
                    user:{
                        name: 'thomas paul',
                        stage_name: 'pinana pijo',
                        category: {
                            name: 'hip hop'
                        }
                    },
                    end_date: "12/02/2016"
                },
                {
                    user:{
                        name: 'thomas paul',
                        stage_name: 'pinana pijo',
                        category: {
                            name: 'hip hop'
                        }
                    },
                    end_date: "12/02/2016"
                }
            ],
            artists: [
                {
                    name: "Stone Bowy",
                    category: {
                        name: 'dancehall'
                    },
                    followers: [
                        {user_id:1},
                        {user_id:1},
                        {user_id:1}
                    ],
                    tracks: [
                        {track_id:1},
                        {track_id:1},
                        {track_id:1}
                    ]
                }
            ]
        }
    },
    components: {Search, InfoBox, TrendingArtists, VouchingRequests},
    methods: {},
    ready(){}
});
