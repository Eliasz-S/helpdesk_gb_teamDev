require('./bootstrap')

import Vue from 'vue'

import Buefy from "buefy"
import 'buefy/dist/buefy.css'

import VueRouter from 'vue-router'
import router from './router'
import App from './components/App'
import Tickets from './components/pages/tickets/Index'
import Users from './components/pages/users/Index'

Vue.component('tickets', Tickets);
Vue.component('users', Users);

// будут перенесены в определенные компоненты
// import route from './route.js'
// import Lang from './lang'

// Vue.component('example-component', require('./components/ExampleComponent.vue'))

Vue.use(Buefy)
Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    render: h => h(App), // компонент, кот. рендерится в начальный момент времени
    router
})
