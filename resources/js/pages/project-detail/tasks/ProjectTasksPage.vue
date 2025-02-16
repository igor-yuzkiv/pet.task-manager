<script setup lang="ts">
import { inject, onMounted, type Ref, ref } from 'vue'
import type { TProject } from '@/entities/project/project.types.ts'
import { TaskStatusMetadataMap, type TTask } from '@/entities/task/task.types.ts'
import type { TEntityTableColumns } from '@/shared/components/entity-table/entity-table.types.ts'
import { PriorityMetadataMap } from '@/shared/types/priority.types.ts'
import Paginator from 'primevue/paginator'
import taskApi from '@/entities/task/task.api.ts'
import { ProjectDetailsSymbol } from '@/pages/project-detail'
import { EntityTable } from '@/shared/components/entity-table'
import EnumBadge from '@/shared/components/enum-badge/EnumBadge.vue'
import { usePagination } from '@/shared/composables/usePagination.ts'
import { useToast } from '@/shared/composables/useToast.ts'
import ApiError from '@/shared/services/api/modules/ApiError.ts'

const toast = useToast()
const project = inject<Ref<TProject>>(ProjectDetailsSymbol)
const isLoading = ref<boolean>(true)
const tasks = ref<TTask[]>([])
const pagination = usePagination(loadTasks)

const tableColumns: TEntityTableColumns[] = [
    { field: 'key', header: 'Key', class: 'w-32 py-0' },
    { field: 'name', header: 'Name', class: 'py-0' },
    { field: 'priority', header: 'Priority', class: 'w-32' },
    { field: 'status', header: 'Status', class: 'w-32 py-0' },
]

async function loadTasks() {
    if (!project || !project.value?.id) {
        return
    }

    try {
        isLoading.value = true
        const response = await taskApi.fetchList(pagination.queryParams.value, [
            `integer(name:project_id,value:${project.value.id},matchMode:equals)`,
        ])

        tasks.value = response.data

        if (response.meta) {
            pagination.setFormResponseMeta(response.meta)
        }
    } catch (error) {
        toast.error(error instanceof ApiError ? error.message : 'Failed to load tasks')
    } finally {
        isLoading.value = false
    }
}

onMounted(loadTasks)
</script>

<template>
    <div>
        <EntityTable :columns="tableColumns" :items="tasks" :is-loading="isLoading">
            <template #column:priority="{ data }">
                <EnumBadge :value="data.priority" :status-map="PriorityMetadataMap" class="w-full" />
            </template>
            <template #column:status="{ data }">
                <EnumBadge :value="data.status" :status-map="TaskStatusMetadataMap" class="w-full" />
            </template>
        </EntityTable>
        <Paginator
            :total-records="pagination.total.value"
            :rows="pagination.perPage.value"
            :rows-per-page-options="pagination.rowPerPageOptions.value"
            @page="pagination.onChangeState"
        />
    </div>
</template>

<style scoped></style>
