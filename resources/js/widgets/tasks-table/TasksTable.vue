<script setup lang="ts">
import type { TTask } from '@/entities/task/task.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'

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
        <Column field="id" v-if="withActions" class="w-12">
            <template #body="{ data }">
                <slot name="actions" v-bind="{ data }"></slot>
            </template>
        </Column>
        <Column field="key" header="Key" class="w-24" />
        <Column field="name" header="Name"></Column>
    </DataTable>
</template>

<style scoped></style>
