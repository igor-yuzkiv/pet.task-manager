import type { RouteLocationNormalized, RouteLocationRaw } from 'vue-router'
import { AppRouters } from '@/app/router/app-router.ts'
import { useAuthStore } from '@/store/useAuthStore.ts'

export default async function (to: RouteLocationNormalized): Promise<RouteLocationRaw | void> {
    const authStore = useAuthStore()
    if (!(await authStore.checkIfAuthenticated()) && to.name !== AppRouters.signIn.name) {
        return { name: AppRouters.signIn.name }
    }
}
