
// vueとvue-routerの定義
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from "./router";
import ImgInputer from 'vue-img-inputer'
import 'vue-img-inputer/dist/index.css'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./resume_scripts');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('gear-component', require('./components/GearComponent.vue').default);
Vue.component('gear-category-component', require('./components/GearCategoryComponent.vue').default);
Vue.component('gear-list-component', require('./components/GearListComponent.vue').default);
Vue.component('gear-show-component', require('./components/GearShowComponent.vue').default);
Vue.component('gear-create-component', require('./components/GearCreateComponent.vue').default);
Vue.component('app', require('./components/App.vue').default);
Vue.component('landing-pp', require('./components/LandingApp.vue').default);

Vue.component('ImgInputer', ImgInputer)
/*
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// vue-routerを使う宣言
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router
});
