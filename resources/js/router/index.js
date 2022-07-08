import { createWebHistory, createRouter } from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Companies from '../components/Companies';

export const routes = [{
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'companies',
        path: '/companies',
        component: Companies
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;