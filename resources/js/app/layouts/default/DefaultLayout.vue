<script setup lang="ts">
import { computed, ref } from 'vue'
import { useRoute } from 'vue-router'
import Button from 'primevue/button'
import { DefaultLayoutMenu } from '@/app/layouts/default/default-layout.menu.ts'
import { useNavigationStore } from '@/store/useNavigationStore.ts'
import { NavigationSidebar } from '@/widgets/navigation'

const route = useRoute()
const navigationStore = useNavigationStore()
navigationStore.setNavItems(DefaultLayoutMenu)

const title = computed(() => {
    return navigationStore.pageTitle || route.meta?.title
})

const miniSidebar = ref<boolean>(false)
</script>

<template>
    <div class="flex h-screen w-full overflow-hidden">
        <NavigationSidebar :nav-items="navigationStore.navigationItems" v-model:mini="miniSidebar" />
        <div class="flex flex-1 flex-col">
            <div
                class="flex w-full shrink-0 items-center gap-x-3 border-b border-gray-200 px-3"
                style="height: var(--app-header-height)"
            >
                <Button v-if="miniSidebar" icon="pi pi-bars" text @click="miniSidebar = false" />
                <h1 class="text-lg font-bold" v-if="title">{{ title }}</h1>
            </div>
            <main class="flex flex-grow flex-col overflow-auto">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<style scoped></style>
