<script setup lang="ts">
import { useRoute } from 'vue-router'
import ConfirmDialog from 'primevue/confirmdialog'
import Toast from 'primevue/toast'

const route = useRoute()
</script>

<template>
    <component v-if="route.meta?.layoutComponent" :is="route.meta?.layoutComponent">
        <router-view />
    </component>

    <router-view v-else />

    <Toast />
    <ConfirmDialog />
</template>

<style scoped></style>
