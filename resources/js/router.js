import VueRouter from 'vue-router';
import Roles from './components/roles/Index';
import Tickets from './components/pages/tickets/Index';
import Users from './components/pages/users/Index'


export default new VueRouter({
    // передаем литерал объекта
    routes : [
        {
            path: '/my-tickets',
            component: Tickets
        },
        {
            path: '/admin/tickets',
            component: Tickets
        },
        {
            path: '/admin/users',
            component: Users
        },
        {
            path: '/admin/roles',
            component: Roles
        },
    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
