import { defineAsyncComponent } from 'vue'

export const AppLayouts = {
    auth: defineAsyncComponent(() => import('@/app/layouts/auth/AuthLayout.vue')),
    default: defineAsyncComponent(() => import('@/app/layouts/default/DefaultLayout.vue')),
}

export const AppRouters = {
    signIn: {
        name: 'auth.signIn',
        path: '/sign-in',
    },
    home: {
        name: 'home',
        path: '/',
    },
    projects: {
        name: 'projects.list',
        path: '/projects',
    },
    projectDetails: {
        name: 'project.details',
        path: '/projects/:id',
    },
    projectOverview: {
        name: 'project.detail.overview',
        path: '/projects/:id',
    },
    projectTasks: {
        name: 'project.detail.tasks',
        path: '/projects/:id/tasks',
    },
    projectDocuments: {
        name: 'project.detail.documents',
        path: '/projects/:id/documents',
    },
}
