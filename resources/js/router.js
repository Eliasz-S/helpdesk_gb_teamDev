import VueRouter from 'vue-router';

import Users from './components/users/Index'
import Roles from './components/roles/Index';
import Tickets from './components/tickets/Index';
import TicketTypes from './components/ticket-types/Index';
import TicketStatus from './components/ticket-status/Index';
import TicketPriority from './components/ticket-priority/Index';
import Teams from './components/teams/Index';


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
            path: '/admin/ticket-status',
            component: TicketStatus
        },
        {
            path: '/admin/ticket-priority',
            component: TicketPriority
        },
        {
            path: '/admin/users',
            component: Users
        },
        {
            path: '/admin/roles',
            component: Roles
        },
        {
            path: '/admin/teams',
            component: Teams
        },
    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
