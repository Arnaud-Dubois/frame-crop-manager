require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter)
Vue.use(BootstrapVue)

Vue.component('app', require('./App.vue').default);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Vue.component('Gallery', require('./views/Gallery/index.vue').default)
        },
        {
            path: '/media/:mediaId',
            name: 'media.show',
            component: Vue.component('Media', require('./views/Gallery/Media/index.vue').default)
        },
        {
            path: '/create-media',
            name: 'media.add',
            component: Vue.component('MediaAdd', require('./views/Gallery/Media/Add.vue').default)
        },
    ]
})

window.Vue = require('vue');

const app = new Vue({
    router,
    el: '#app',
});
