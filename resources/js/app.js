require('./bootstrap')

import Vue from 'vue'

import Buefy from "buefy"
import 'buefy/dist/buefy.css'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import VueRouter from 'vue-router'
import router from './router'
import App from './components/App'
import Tickets from './components/tickets/Index'
import Users from './components/users/Index'

Vue.component('tickets', Tickets);
Vue.component('users', Users);

// будут перенесены в определенные компоненты
// import route from './route.js'
// import Lang from './lang'

Vue.use(Buefy)
Vue.use(VueRouter)

const app = new Vue({
    // el: '#app',
    data() {
        return {
            isActive: true
        }
    },
    // render: h => h(App), // компонент, кот. рендерится в начальный момент времени
    router
}).$mount('#app-vue')
