<script setup lang="ts">
import StarterKit from '@tiptap/starter-kit'
import { EditorContent, useEditor } from '@tiptap/vue-3'
import { watch } from 'vue'

const modelValue = defineModel<string>()

const editor = useEditor({
    extensions: [StarterKit],
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose-base lg:prose-lg xl:prose-2xl m-2 focus:outline-none',
        },
    },
    content: modelValue.value,
    onUpdate: ({ editor }) => {
        modelValue.value = editor.getHTML()
    },
})

watch(modelValue, (value) => {
    if (editor.value?.isActive) {
        editor.value?.commands.setContent(value ?? '')
    }
})
</script>

<template>
    <EditorContent :editor="editor" class="rounded-lg border border-gray-300" />
</template>

<style>
.tiptap {
    @apply min-h-32;
}

.tiptap h1 {
    @apply text-4xl;
}

.tiptap h2 {
    @apply text-3xl;
}

.tiptap h3 {
    @apply text-2xl;
}
</style>
