<script setup lang="ts">
import { useRoute } from 'vue-router'
import Toast from 'primevue/toast'
import { AppLayouts } from '@/app/router/app-router.types.ts'

const route = useRoute()
console.log(route.meta)
</script>

<template>
    <Toast />
    <component :is="route.meta?.layoutComponent ?? AppLayouts.default">
        <router-view />
    </component>
</template>

<style scoped></style>
