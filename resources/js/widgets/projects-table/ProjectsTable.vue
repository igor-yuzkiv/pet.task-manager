<script setup lang="ts">
import { ProjectStatusMetadataMap, type TProject } from '@/entities/project/project.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import EnumBadge from '@/shared/components/enum-badge/EnumBadge.vue'

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
                <EnumBadge :value="data.status" :status-map="ProjectStatusMetadataMap" />
            </template>
        </Column>
    </DataTable>
</template>

<style scoped></style>
