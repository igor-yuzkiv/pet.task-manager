<script setup lang="ts"></script>

<template>
    <div class="flex h-screen w-full overflow-hidden">
        <nav class="flex h-full w-64 shrink-0 bg-gray-100">Nav</nav>
        <main class="flex flex-grow flex-col overflow-auto">
            <slot></slot>
        </main>
    </div>
</template>

<style scoped></style>
