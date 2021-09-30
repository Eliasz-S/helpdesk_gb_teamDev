import VueRouter from 'vue-router';

import Users from './components/users/Index'
import Roles from './components/roles/Index';
import Tickets from './components/tickets/Index';
import TicketTypes from './components/ticket-types/Index';
import TicketStatus from './components/ticket-status/Index';
import TicketPriority from './components/ticket-priority/Index';
import Teams from './components/teams/Index';
import Profile from './components/profile/Index';


export default new VueRouter({
    // передаем литерал объекта
    routes : [
        {
            path: '/my-tickets',
            name: 'my-tickets',
            component: Tickets
        },
        {
            path: '/admin/tickets',
            name: 'admin.tickets',
            component: Tickets
        },
        {
            path: '/admin/ticket-types',
            name: 'admin.ticket-types',
            component: TicketTypes
        },
        {
            path: '/admin/ticket-status',
            name: 'admin.ticket-status',
            component: TicketStatus
        },
        {
            path: '/admin/ticket-priority',
            name: 'admin.ticket-priority',
            component: TicketPriority
        },
        {
            path: '/admin/users',
            name: 'admin.users',
            component: Users
        },
        {
            path: '/admin/roles',
            name: 'admin.roles',
            component: Roles
        },
        {
            path: '/admin/teams',
            name: 'admin.teams',
            component: Teams
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile
        },
    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
