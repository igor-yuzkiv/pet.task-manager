<script setup lang="ts">
import type { TProjectForm } from '@/entities/project/project.types.ts'
import InputText from 'primevue/inputtext'
import InputContainer from '@/components/input-container/InputContainer.vue'
import TiptapEditor from '@/components/tiptap-editor/TiptapEditor.vue'

const props = defineProps<{
    errors?: Record<string, string | string[]>
}>()

const formData = defineModel<TProjectForm>({
    default: {
        name: '',
        description: '',
    },
})

const fieldError = (field: keyof TProjectForm) => {
    const error = props.errors?.[field]
    if (Array.isArray(error)) {
        return error[0]
    }

    return error
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <InputContainer label="Name" :error="fieldError('name')">
            <InputText v-model="formData.name" />
        </InputContainer>

        <InputContainer label="Key" :error="fieldError('key')">
            <InputText v-model="formData.key" />
        </InputContainer>

        <InputContainer label="Description" :error="fieldError('description')">
            <TiptapEditor v-model="formData.description" />
        </InputContainer>
    </div>
</template>

<style scoped></style>
