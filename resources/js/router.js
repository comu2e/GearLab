
import Router from 'vue-router'
import Home from './components/GearListComponent.vue'
import Create from './components/GearCreateComponent.vue'
import Liked from './components/LikeListComponent.vue'
import Registerd from './components/RegisterdGearComponent.vue'
import Follow from './components/FollowListComponent.vue'
import EditGear from "./components/EditGear";
import UserGear from "./components/UserGearComponent";


export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/gears',
            name: 'home',
            component:Home
        },
        {
            path: '/user_gears',
            name: 'user_gears',
            component:UserGear
        },
        {
            path: '/gears/create',
            name: 'create',
            component:Create
        },
        {
            path: '/likes',
            name: 'likes',
            component:Liked
        },
        {
            path: '/follows',
            name: 'follows',
            component:Follow
        },
        {
            path: '/registerd',
            name: 'registerd',
            component:Registerd,
            props:true

        },

        {
            path: '/gears/:gearId',
            name: 'edit',
            component:EditGear,
            props:true
        },
    ]
});
