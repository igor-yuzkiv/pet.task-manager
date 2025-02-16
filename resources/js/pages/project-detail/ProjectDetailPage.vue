<script setup lang="ts">
import { onMounted, provide, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import type { TProject } from '@/entities/project/project.types.ts'
import Tab from 'primevue/tab'
import TabList from 'primevue/tablist'
import Tabs from 'primevue/tabs'
import DefaultLayout from '@/app/layouts/default/DefaultLayout.vue'
import { AppRouters } from '@/app/router/app-router.ts'
import projectApi from '@/entities/project/project.api.ts'
import { ProjectDetailsSymbol } from '@/pages/project-detail/index.ts'
import { useToast } from '@/shared/composables/useToast.ts'
import ApiError from '@/shared/services/api/ApiError.ts'

const route = useRoute()
const router = useRouter()
const toast = useToast()

const navItems = [
    { title: 'Overview', route: AppRouters.projectOverview.name },
    { title: 'Tasks', route: AppRouters.projectTasks.name },
    { title: 'Documents', route: AppRouters.projectDocuments.name },
    { title: 'Changes', route: AppRouters.home.name },
]

const project = ref<TProject>()

async function loadProject() {
    try {
        project.value = await projectApi.fetchById(route.params.id as string)
    } catch (error) {
        if (error instanceof ApiError) {
            toast.error(error.displayMessage)
        } else {
            toast.error('An error occurred. Please try again later.')
        }

        await router.push({ name: AppRouters.projects.name })
    }
}

onMounted(() => {
    loadProject()
})

provide(ProjectDetailsSymbol, project)
</script>

<template>
    <DefaultLayout>
        <template #header>
            <div class="flex h-full flex-col justify-between">
                <div class="flex items-center gap-x-1 pl-2 text-lg font-bold" v-if="project">
                    <div class="text-gray-400">{{ project.key }}</div>
                    <div>{{ project.name }}</div>
                </div>

                <Tabs :value="route.name as string" class="mt-0.5">
                    <TabList>
                        <router-link v-for="navItem in navItems" :key="navItem.title" :to="{ name: navItem.route }">
                            <Tab :value="navItem.route" class="px-2 py-1">{{ navItem.title }}</Tab>
                        </router-link>
                    </TabList>
                </Tabs>
            </div>
        </template>
        <div class="flex h-full w-full flex-col p-2">
            <router-view></router-view>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>
