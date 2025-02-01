import { defineAsyncComponent } from 'vue'

export const AppLayouts = {
    auth: defineAsyncComponent(() => import('@/layouts/auth/AuthLayout.vue')),
    default: defineAsyncComponent(() => import('@/layouts/default/DefaultLayout.vue')),
}

export const AppRouters = {
    signIn: {
        name: 'auth.signIn',
        path: '/sign-in',
        component: () => import('@/pages/auth/sign-in/SignInPage.vue'),
        meta: {
            layoutComponent: AppLayouts.auth,
        },
    },
    home: {
        name: 'home',
        path: '/',
        component: () => import('@/pages/home/HomePage.vue'),
        meta: {
            layoutComponent: AppLayouts.default,
        },
    },
}
