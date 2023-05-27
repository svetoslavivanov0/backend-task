/**
 * External dependencies
 */
import { createRouter, createWebHistory } from 'vue-router';

/**
 * Internal dependencies
 */
import Credits from './components/Credits.vue';
import CreatePayment from './components/CreatePayment.vue';
import CreateCredit from './components/CreateCredit.vue';

const routes = [
    {
        path: '/',
        name: 'companies.index',
        component: Credits,
    },
    {
        path: '/create-payment',
        name: 'create.payment',
        component: CreatePayment,
    },
    {
        path: '/create-credit',
        name: 'create.credit',
        component: CreateCredit,
    }
]

const router =  createRouter({
    history: createWebHistory(),
    routes
})

export default router;