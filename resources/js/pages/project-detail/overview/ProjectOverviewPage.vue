<script setup lang="ts">
import { inject } from 'vue'
import type { TProject } from '@/entities/project/project.types.ts'
import { ProjectDetailsSymbol } from '@/pages/project-detail'

const projectDetails = inject<TProject>(ProjectDetailsSymbol)
</script>

<template>
    <pre>{{ projectDetails }}</pre>
</template>

<style scoped></style>
