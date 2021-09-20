import VueRouter from 'vue-router';
import Users from './components/User';
import Tickets from './components/pages/tickets/Index';


export default new VueRouter({
    // передаем литерал объекта
    routes : [
        {
            path: '/wl',
            component: Users
        },
        {
            path: '/admin/tickets',
            component: Tickets
        },

    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
