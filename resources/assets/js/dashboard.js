import Vue from 'vue';
Vue.use(require('vue-resource'));

//import components
import InfoBox from "./components/infoBox.vue";
import TrendingTracks from "./components/trendingTracks.vue";
import TrendingArtists from "./components/trendingArtists.vue";

new Vue({
    el:"section.content",
    data:{
        data: {
            users: {
                title:'users', total:2000000
            },
            tracks: {
                title: 'tracks', total: 200000
            },
            artists: {
                title:'artists', total:2000000
            },
            activeAds: {
                title:'activeAds', total:2000000
            },
            trendingTracks: [
                {
                    title: 'Kai Kai',
                    artist: {
                        name: 'shattaWale'
                    },
                    category: {
                        name: 'DanceHall'
                    },
                    streams: [
                        {
                            user_id: 1
                        },
                        {
                            user_id: 2
                        }
                    ],
                    downloads: [
                        {
                            user_id: 1
                        },
                        {
                            user_id: 2
                        }
                    ]
                }
            ],
            trendingArtists: [
                {
                    name: "Stone Bowy",
                    photo: {
                        photo: {
                            path: 'img/user1-128x128.jpg'
                        }
                    }
                },
                {
                    name: "ShataWale",
                    photo: {
                        photo: {
                            path: "img/user1-128x128.jpg"
                        }
                    }
                }
            ]
        }
    },
    components:{InfoBox, TrendingTracks, TrendingArtists},
    ready(){
        this.data = JSON.parse(this.fetchDashboardData());
        console.log(this.data);
    },
    methods:{
        fetchDashboardData(){

        }
    }
});