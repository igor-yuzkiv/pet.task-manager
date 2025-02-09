<script setup lang="ts">
import { onMounted, ref } from 'vue'
import type { Project } from '@/entities/project/project.types.ts'
import Paginator from 'primevue/paginator'
import projectApi from '@/entities/project/project.api.ts'
import { usePagination } from '@/shared/composables/usePagination.ts'
import { ProjectTable } from '@/widgets/project-table'

const projects = ref<Project[]>([])
const pagination = usePagination(loadProjects)

async function loadProjects() {
    await projectApi.fetchProjects(pagination.queryParams.value).then(({ data, meta }) => {
        projects.value = data
        pagination.setFormResponseMeta(meta)
    })
}

onMounted(() => {
    loadProjects()
})
</script>

<template>
    <div class="flex flex-grow flex-col">
        <ProjectTable :projects="projects" />
        <Paginator
            :total-records="pagination.total.value"
            :rows="pagination.perPage.value"
            :rows-per-page-options="pagination.rowPerPageOptions.value"
            @page="pagination.onChangeState"
        />
    </div>
</template>

<style scoped></style>
