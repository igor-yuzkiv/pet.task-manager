<script setup lang="ts">
import { useRoute } from 'vue-router'
import Tab from 'primevue/tab'
import TabList from 'primevue/tablist'
import Tabs from 'primevue/tabs'
import { AppRouters } from '@/app/router/app-router.ts'

const route = useRoute()
const navItems = [
    { title: 'Overview', route: AppRouters.projectOverview.name },
    { title: 'Tasks', route: AppRouters.projectTasks.name },
    { title: 'Documents', route: AppRouters.projectDocuments.name },
]
</script>

<template>
    <div class="flex flex-grow flex-col">
        <Tabs :value="route.name as string">
            <TabList>
                <router-link v-for="navItem in navItems" :key="navItem.title" :to="{ name: navItem.route }">
                    <Tab :value="navItem.route" class="px-3 py-1">{{ navItem.title }}</Tab>
                </router-link>
            </TabList>
        </Tabs>
        <div class="flex h-full w-full flex-col p-2">
            <router-view></router-view>
        </div>
    </div>
</template>

<style scoped></style>
