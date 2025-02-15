<script setup lang="ts">
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import type { TNavItem } from '@/widgets/navigation/navigation.types.ts'
import { Icon } from '@iconify/vue'

const props = defineProps({
    item: {
        type: Object as () => TNavItem,
        required: true,
    },
    mini: {
        type: Boolean,
        default: false,
    },
})

const route = useRoute()

const isActive = computed(() => {
    if (typeof props.item.is_active === 'function') {
        return props.item.is_active(props.item, route)
    }

    return props.item.is_active
})

function onClick(item: TNavItem) {
    if (item.disabled || item?.to || !item.command) {
        return
    }

    item.command(item)
}
</script>

<template>
    <component
        :is="item.to && !item.disabled ? 'router-link' : 'div'"
        :to="item.to"
        @click.stop="onClick(item)"
        class="flex cursor-pointer items-center gap-x-2 rounded px-2 py-1"
        :class="{
            'bg-green-500 text-white': isActive,
            'hover:bg-gray-100': !isActive,
            'text-gray-400': item.disabled,
        }"
    >
        <Icon :icon="item.icon" class="h-6 w-6" />
        <span v-if="!mini" class="font-sans text-lg">{{ item.title }}</span>
    </component>
</template>

<style scoped></style>
