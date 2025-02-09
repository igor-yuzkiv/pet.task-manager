<script setup lang="ts">
import { computed } from 'vue'
import type { StatusMap } from '@/shared/types/status.types.ts'
import Tag from 'primevue/tag'

const props = defineProps<{
    value: string
    statusMap: StatusMap<string>
}>()

const status = computed(() => props.statusMap?.[props.value] ?? null)
</script>

<template>
    <Tag v-if="status" :style="{ backgroundColor: status.color, color: 'white' }" :value="status.label" />
</template>
