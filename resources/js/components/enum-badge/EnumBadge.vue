<script setup lang="ts">
import { computed } from 'vue'
import type { EnumMetadataMap } from '@/types/enum-metadata.types.ts'
import Tag from 'primevue/tag'

const props = defineProps<{
    value: string
    statusMap: EnumMetadataMap<string>
}>()

const displayValue = computed(() => props.statusMap?.[props.value] ?? null)
</script>

<template>
    <Tag
        v-if="displayValue"
        :style="{ backgroundColor: displayValue.color, color: 'white' }"
        :value="displayValue.label"
    />
</template>
