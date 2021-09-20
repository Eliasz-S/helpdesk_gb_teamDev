import VueRouter from 'vue-router';
import Users from './components/User';


export default new VueRouter({
    // передаем литерал объекта
    routes : [
        {
            path: '/wl',
            component: Users
        },

    ],
    // в историю записываются перемещения при переходах
    mode: 'history'
})
