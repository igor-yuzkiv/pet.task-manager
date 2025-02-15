<script setup lang="ts">
import type { TNavItem } from '@/widgets/navigation/navigation.types.ts'
import NavigationListItem from '@/widgets/navigation/NavigationListItem.vue'
import NavigationListSection from '@/widgets/navigation/NavigationListSection.vue'

defineProps({
    items: {
        type: Array as () => Array<TNavItem>,
        required: true,
    },
    mini: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
    <nav class="flex flex-col">
        <ul class="space-y-3">
            <li v-for="(item, index) in items" :key="item?.is_section ? 'section-' : 'item-' + index">
                <component
                    :is="item.is_section ? NavigationListSection : NavigationListItem"
                    :item="item"
                    :mini="mini"
                />
            </li>
        </ul>
    </nav>
</template>
<style scoped></style>
