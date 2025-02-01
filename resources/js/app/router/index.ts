import { createRouter, createWebHashHistory } from 'vue-router'
import { AppRouters } from '@/app/router/app-router.ts'

const router = createRouter({
    history: createWebHashHistory(),
    routes: [AppRouters.signIn, AppRouters.home],
})

router.beforeEach(async (to, from, next) => {
    if (!to.meta?.middleware) {
        next()
        return
    }

    const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware]
    for (const item of middleware) {
        const location = await item(to, from)
        if (location) {
            return next(location)
        }
    }

    next()
})

export default router
