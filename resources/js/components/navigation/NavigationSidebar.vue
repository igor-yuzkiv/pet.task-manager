<script setup lang="ts">
import type { TNavItem } from '@/components/navigation/navigation.types.ts'
import Button from 'primevue/button'
import NavigationList from '@/components/navigation/NavigationList.vue'

defineProps<{
    navItems: TNavItem[]
}>()

const mini = defineModel<boolean>('mini')
</script>

<template>
    <aside class="flex h-full shrink-0 flex-col border-b bg-gray-50" :class="mini ? 'w-16' : 'w-64'">
        <router-link
            to="/"
            class="flex items-center justify-around border-b border-gray-200"
            style="height: var(--app-header-height)"
        >
            <img src="../../assets/logo/logo.svg" alt="Logo" class="h-12 w-12" />
            <h1 v-if="!mini" class="text-2xl font-semibold">Brand</h1>
            <Button v-if="!mini" icon="pi pi-bars" text @click.prevent="mini = true" />
        </router-link>
        <NavigationList class="flex-1 p-3" :items="navItems" :mini="mini" />
    </aside>
</template>

<style scoped></style>
