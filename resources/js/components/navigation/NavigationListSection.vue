<script setup lang="ts">
import type { TNavItem } from '@/components/navigation/navigation.types.ts'
import Panel from 'primevue/panel'
import NavigationList from '@/components/navigation/NavigationList.vue'

defineProps({
    item: {
        type: Object as () => TNavItem,
        required: true,
    },
    mini: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
    <Panel
        toggleable
        class="border-none bg-transparent pt-2"
        :pt="{ header: { class: 'p-0' }, content: { class: 'p-1' } }"
        :toggle-button-props="{ text: true, severity: 'secondary' }"
    >
        <template #header>
            <span v-if="!mini">{{ item.title }}</span>
        </template>

        <NavigationList v-if="item.items" :items="item.items" :mini="mini" />
    </Panel>
</template>

<style scoped></style>
