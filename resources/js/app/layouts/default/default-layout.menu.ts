import type { RouteLocationNormalizedLoaded } from 'vue-router'
import type { TNavItem } from '@/widgets/navigation/navigation.types.ts'
import { AppRouters } from '@/app/router/app-router.ts'

export const DefaultLayoutMenu = [
    {
        title: 'Home',
        icon: 'material-symbols:home-rounded',
        to: AppRouters.home.path,
        is_active: (item: TNavItem, route?: RouteLocationNormalizedLoaded) => {
            return route?.name === AppRouters.home.name
        },
    },
    {
        title: 'Report',
        icon: 'mdi:report-line-variant',
        disabled: true,
    },
    {
        title: 'Projects',
        icon: 'solar:case-bold',
        to: AppRouters.projects.path,
        is_active: (item: TNavItem, route?: RouteLocationNormalizedLoaded) => {
            return route?.name === AppRouters.projects.name
        },
    },
    {
        is_section: true,
        title: 'Overview',
        items: [
            {
                title: 'Tasks',
                icon: 'mingcute:task-2-fill',
            },
            {
                title: 'Bugs',
                icon: 'solar:bug-bold',
            },
            {
                title: 'Timesheets',
                icon: 'material-symbols:timer-outline',
            },
        ],
    },
] as TNavItem[]
