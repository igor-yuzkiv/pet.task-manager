<script setup lang="ts" generic="T extends Record<string, unknown>">
import type { TEntityTableColumns } from '@/components/entity-table/entity-table.types.ts'
import Column from 'primevue/column'
import DataTable from 'primevue/datatable'
import Skeleton from 'primevue/skeleton'

defineProps<{
    columns: TEntityTableColumns[]
    items: T[]
    isLoading?: boolean
}>()

defineEmits<{
    (e: 'row:click', data: T): void
}>()
</script>

<template>
    <DataTable v-if="isLoading" :value="Array.from({ length: 20 })" size="small">
        <Column
            v-for="column in columns"
            :key="column.field"
            :field="column.field"
            :header="column.header"
            :class="column.class"
        >
            <template #body>
                <Skeleton class="my-2 w-full" height="18px" border-radius="25px" />
            </template>
        </Column>
    </DataTable>
    <DataTable v-else :value="items" size="small" selectionMode="single" @row-click="$emit('row:click', $event.data)">
        <Column
            v-for="column in columns"
            :key="column.field"
            :field="column.field"
            :header="column.header"
            :class="column.class"
        >
            <template #body="{ data }">
                <slot :name="`column:${column.field}`" v-bind="{ data }">
                    {{ data[column.field] }}
                </slot>
            </template>
        </Column>
    </DataTable>
</template>

<style scoped></style>
