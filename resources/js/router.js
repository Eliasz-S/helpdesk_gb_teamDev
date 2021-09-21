import VueRouter from 'vue-router';
import Test from './components/User';
import Tickets from './components/pages/tickets/Index';
import Users from './components/pages/users/Index'


export default new VueRouter({
    // передаем литерал объекта
    routes : [
        {
            path: '/wl',
            component: Test
        },
        {
            path: '/admin/tickets',
            component: Tickets
        },
        {
            path: '/admin/users',
            component: Users
        }

    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
