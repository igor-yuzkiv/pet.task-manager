<script setup lang="ts">
import { NavigationSidebar } from 'resources/js/components/navigation'
import { useRoute } from 'vue-router'
import Avatar from 'primevue/avatar'
import Button from 'primevue/button'
import { DefaultLayoutMenu } from '@/app/layouts/default/default-layout.menu.ts'
import { useNavigationStore } from '@/store/useNavigationStore.ts'

const route = useRoute()
const navigationStore = useNavigationStore()
navigationStore.setNavItems(DefaultLayoutMenu)
</script>

<template>
    <div class="flex h-screen w-full overflow-hidden">
        <NavigationSidebar :nav-items="navigationStore.navigationItems" v-model:mini="navigationStore.isMinimized" />

        <div class="flex flex-1 flex-col">
            <div
                class="flex w-full shrink-0 items-center border-b border-gray-200 px-3"
                style="height: var(--app-header-height)"
            >
                <div class="flex flex-1 items-center gap-x-3">
                    <Button
                        v-if="navigationStore.isMinimized"
                        icon="pi pi-bars"
                        text
                        @click="navigationStore.isMinimized = false"
                    />

                    <slot name="header">
                        <h1 class="text-lg font-bold" v-if="route.meta?.title">{{ route.meta?.title }}</h1>
                    </slot>
                </div>

                <div>
                    <Avatar icon="pi pi-user" />
                </div>
            </div>

            <main class="flex flex-grow flex-col overflow-auto">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<style scoped></style>
