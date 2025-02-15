import { createRouter, createWebHashHistory } from 'vue-router'
import { AppLayouts, AppRouters } from '@/app/router/app-router.ts'
import authMiddleware from '@/app/router/middleware/auth.middleware.ts'

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            name: AppRouters.signIn.name,
            path: AppRouters.signIn.path,
            component: () => import('@/pages/auth/sign-in/SignInPage.vue'),
            meta: {
                layoutComponent: AppLayouts.auth,
            },
        },
        {
            name: AppRouters.home.name,
            path: AppRouters.home.path,
            component: () => import('@/pages/home/HomePage.vue'),
            meta: {
                layoutComponent: AppLayouts.default,
                middleware: authMiddleware,
                title: 'Home',
            },
        },
        {
            name: AppRouters.projects.name,
            path: AppRouters.projects.path,
            component: () => import('@/pages/projects/ProjectsPage.vue'),
            meta: {
                layoutComponent: AppLayouts.default,
                middleware: authMiddleware,
                title: 'Projects',
            },
        },

        // Project details
        {
            name: AppRouters.projectDetails.name,
            path: AppRouters.projectDetails.path,
            redirect: { name: AppRouters.projectOverview.name },
            component: () => import('@/pages/project-detail/ProjectDetailPage.vue'),
            meta: {
                layoutComponent: AppLayouts.default,
                middleware: authMiddleware,
            },
            children: [
                {
                    name: AppRouters.projectOverview.name,
                    path: AppRouters.projectOverview.path,
                    component: () => import('@/pages/project-detail/overview/ProjectOverviewPage.vue'),
                },
                {
                    name: AppRouters.projectTasks.name,
                    path: AppRouters.projectTasks.path,
                    component: () => import('@/pages/project-detail/tasks/ProjectTasksPage.vue'),
                },
                {
                    name: AppRouters.projectDocuments.name,
                    path: AppRouters.projectDocuments.path,
                    component: () => import('@/pages/project-detail/documents/ProjectDocumentsPage.vue'),
                },
            ],
        },
    ],
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
