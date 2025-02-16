<script setup lang="ts">
import { inject, onMounted, type Ref, ref } from 'vue'
import type { TProject } from '@/entities/project/project.types.ts'
import type { TTask } from '@/entities/task/task.types.ts'
import Paginator from 'primevue/paginator'
import taskApi from '@/entities/task/task.api.ts'
import { ProjectDetailsSymbol } from '@/pages/project-detail'
import { usePagination } from '@/shared/composables/usePagination.ts'
import { useToast } from '@/shared/composables/useToast.ts'
import ApiError from '@/shared/services/api/modules/ApiError.ts'
import { TasksTable } from '@/widgets/tasks-table'

const toast = useToast()
const project = inject<Ref<TProject>>(ProjectDetailsSymbol)
const tasks = ref<TTask[]>([])
const pagination = usePagination(loadTasks)

async function loadTasks() {
    if (!project || !project.value?.id) {
        return
    }

    const response = await taskApi
        .fetchList(pagination.queryParams.value, [
            `integer(name:project_id,value:${project.value.id},matchMode:equals)`,
        ])
        .catch((error) => {
            toast.error(error instanceof ApiError ? error.message : 'Failed to load tasks')
            return { data: [], meta: null }
        })

    tasks.value = response.data
    if (response.meta) {
        pagination.setFormResponseMeta(response.meta)
    }
}

onMounted(loadTasks)
</script>

<template>
    <TasksTable :tasks="tasks" />
    <Paginator
        :total-records="pagination.total.value"
        :rows="pagination.perPage.value"
        :rows-per-page-options="pagination.rowPerPageOptions.value"
        @page="pagination.onChangeState"
    />
</template>

<style scoped></style>
