import VueRouter from 'vue-router';

import Users from './components/users/Index'
import Roles from './components/roles/Index';
import Tickets from './components/tickets/Index';
import TicketTypes from './components/ticket-types/Index';


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
            path: '/admin/ticket-types',
            component: TicketTypes
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
