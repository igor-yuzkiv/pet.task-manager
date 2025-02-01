import { createRouter, createWebHashHistory } from 'vue-router'
import { AppRouters } from '@/app/router/app-router.types.ts'

const router = createRouter({
    history: createWebHashHistory(),
    routes: [AppRouters.signIn, AppRouters.home],
})

export default router
