
import Router from 'vue-router'
import Home from './components/GearListComponent.vue'
import Create from './components/GearCreateComponent.vue'


export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/gears',
            name: 'home',
            component:Home
        },
        {
            path: '/gears/create',
            name: 'create',
            component:Create
        },
    ]
});
