import type { RouteLocationNormalizedLoaded } from 'vue-router'

export type TNavItem = {
    title?: string
    icon: string
    command?: (item: TNavItem) => void
    to?: string
    items?: TNavItem[]
    is_section?: boolean
    divider?: boolean
    is_active?: boolean | ((item: TNavItem, route?: RouteLocationNormalizedLoaded) => boolean)
    disabled?: boolean
    extra?: unknown
}
