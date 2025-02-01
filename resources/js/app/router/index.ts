import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'home',
            path: '/',
            component: () => import('@/pages/home/HomePage.vue'),
        },
    ],
})

export default router
