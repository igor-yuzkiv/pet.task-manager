import { defineStore } from 'pinia'
import { ref } from 'vue'
import type { TNavItem } from '@/widgets/navigation/navigation.types.ts'

export const useNavigationStore = defineStore('app.navigation', () => {
    const items = ref<TNavItem[]>([])
    const pageTitle = ref<string>('')

    function setNavItems(navItems: TNavItem[]): void {
        items.value = navItems
    }

    return {
        navigationItems: items,
        setNavItems,
        pageTitle,
    }
})
