<script setup lang="ts">
import { useRoute } from 'vue-router'
import ConfirmDialog from 'primevue/confirmdialog'
import Toast from 'primevue/toast'
import { AppLayouts } from '@/app/router/app-router.ts'

const route = useRoute()
</script>

<template>
    <component :is="route.meta?.layoutComponent ?? AppLayouts.default">
        <router-view />
    </component>
    <Toast />
    <ConfirmDialog />
</template>

<style scoped></style>
