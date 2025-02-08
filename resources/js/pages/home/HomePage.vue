<script setup lang="ts">
import { EProjectStatus, ProjectStatusMap } from '@/entities/project/project.types.ts'
import StatusBadge from '@/components/status-badge/StatusBadge.vue'
</script>

<template>
    <div class="flex flex-grow flex-col">
        <StatusBadge :value="EProjectStatus.in_progress" :status-map="ProjectStatusMap" />
    </div>
</template>

<style scoped></style>
