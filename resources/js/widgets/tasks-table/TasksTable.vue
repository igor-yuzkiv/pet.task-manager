<script setup lang="ts">
import { TaskStatusMetadataMap, type TTask } from '@/entities/task/task.types.ts'
import { PriorityMetadataMap } from '@/shared/types/priority.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import EnumBadge from '@/shared/components/enum-badge/EnumBadge.vue'

defineProps({
    tasks: {
        type: Array as () => TTask[],
        required: true,
    },
    withActions: {
        type: Boolean,
        default: false,
    },
})

defineEmits<{
    (e: 'row:click', task: TTask): void
}>()
</script>

<template>
    <DataTable :value="tasks" size="small" selectionMode="single" @row-click="$emit('row:click', $event.data)">
        <Column field="id" v-if="withActions" class="w-32">
            <template #body="{ data }">
                <slot name="actions" v-bind="{ data }"></slot>
            </template>
        </Column>
        <Column field="key" header="Key" class="w-32" />
        <Column field="name" header="Name"></Column>
        <Column field="priority" header="Priority" class="w-32">
            <template #body="{ data }">
                <EnumBadge :value="data.priority" :status-map="PriorityMetadataMap" class="w-full" />
            </template>
        </Column>
        <Column field="status" header="Status" class="w-32">
            <template #body="{ data }">
                <EnumBadge :value="data.status" :status-map="TaskStatusMetadataMap" class="w-full" />
            </template>
        </Column>
    </DataTable>
</template>

<style scoped></style>
