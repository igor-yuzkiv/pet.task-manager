<script setup lang="ts">
import { type TProject, TProjectStatusMap } from '@/entities/project/project.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import StatusBadge from '@/shared/components/status-badge/StatusBadge.vue'

defineProps({
    projects: {
        type: Array as () => TProject[],
        required: true,
    },
    withActions: {
        type: Boolean,
        default: false,
    },
})
defineEmits<{
    (e: 'row:click', project: TProject): void
}>()
</script>

<template>
    <DataTable :value="projects" size="small" selectionMode="single" @row-click="$emit('row:click', $event.data)">
        <Column field="id" v-if="withActions" class="w-12">
            <template #body="{ data }">
                <slot name="actions" v-bind="{ data }"></slot>
            </template>
        </Column>
        <Column field="key" header="Key" class="w-24" />
        <Column field="name" header="Name"></Column>
        <Column field="status" header="Status">
            <template #body="{ data }">
                <StatusBadge :value="data.status" :status-map="TProjectStatusMap" />
            </template>
        </Column>
    </DataTable>
</template>

<style scoped></style>
