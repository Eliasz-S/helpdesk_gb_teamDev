// require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './router';
import App from './components/App';

// будут перенесены в определенные компоненты
import route from './route.js';
import Lang from './lang';
// import Vue from 'vue';

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    render: h => h(App), // компонент, кот. рендерится в начальный момент времени
    router
});

console.log(route('login'));
