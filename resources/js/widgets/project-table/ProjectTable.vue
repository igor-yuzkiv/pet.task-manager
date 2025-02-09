<script setup lang="ts">
import { type Project, ProjectStatusMap } from '@/entities/project/project.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import StatusBadge from '@/shared/components/status-badge/StatusBadge.vue'

defineProps<{ projects: Project[] }>()
defineEmits<{
    (e: 'row:click', project: Project): void
}>()
</script>

<template>
    <DataTable
        :value="projects"
        size="small"
        show-gridlines
        selectionMode="single"
        @row-click="$emit('row:click', $event.data)"
    >
        <Column field="key" header="Key"></Column>
        <Column field="name" header="Name"></Column>
        <Column field="status" header="Status">
            <template #body="{ data }">
                <StatusBadge :value="data.status" :status-map="ProjectStatusMap" />
            </template>
        </Column>
    </DataTable>
</template>

<style scoped></style>
