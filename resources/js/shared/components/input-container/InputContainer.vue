<script setup lang="ts">
import Message from 'primevue/message'

defineProps<{
    label?: string
    error?: string
}>()
</script>

<template>
    <div class="flex flex-col">
        <label class="text-sm font-semibold" v-if="label">{{ label }}</label>
        <slot></slot>
        <Message v-if="error" severity="error" size="small" variant="simple">{{ error }}</Message>
    </div>
</template>

<style scoped></style>
