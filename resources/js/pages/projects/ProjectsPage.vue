<script setup lang="ts">
import * as yup from 'yup'
import { defineAsyncComponent, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import type { TEntityTableColumns } from '@/components/entity-table/entity-table.types.ts'
import { ProjectStatusMetadataMap, type TProject, type TProjectForm } from '@/entities/project/project.types.ts'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import Paginator from 'primevue/paginator'
import { AppRouters } from '@/app/router/app-router.ts'
import projectApi from '@/entities/project/project.api.ts'
import { useConfirm } from '@/composables/useConfirm.ts'
import { useForm } from '@/composables/useForm.ts'
import { usePagination } from '@/composables/usePagination.ts'
import { useToast } from '@/composables/useToast.ts'
import { EntityTable } from '@/components/entity-table'
import EnumBadge from '@/components/enum-badge/EnumBadge.vue'
import ApiError from '@/services/api/modules/ApiError.ts'

const AsyncProjectForm = defineAsyncComponent(() => import('@/components/project-form/ProjectForm.vue'))

const isLoading = ref<boolean>(true)
const router = useRouter()
const toast = useToast()
const confirm = useConfirm()
const projects = ref<TProject[]>([])
const pagination = usePagination(loadProjects)

const tableColumns: TEntityTableColumns[] = [
    { field: 'id', header: '', class: 'w-32 py-0' },
    { field: 'key', header: 'Key', class: 'w-32 py-0' },
    { field: 'name', header: 'Name', class: 'py-0' },
    { field: 'status', header: 'Status', class: 'w-32 py-0' },
]

const form = useForm<TProjectForm>({
    initialValues: {
        id: '',
        key: '',
        name: '',
        description: '',
    },
    validationSchema: yup.object({
        name: yup.string().required().label('Name'),
        description: yup.string().required().label('Description'),
    }),
    submit: async (data) => {
        try {
            if (data.id) {
                await projectApi.update(data.id, data)
            } else {
                await projectApi.create(data)
            }

            form.close()
            await loadProjects()
        } catch (error) {
            if (!(error instanceof ApiError)) {
                toast.error('An error occurred. Please try again later.')
                return
            }

            if (error.isValidationError && error.validationErrors) {
                form.setErrors(error.validationErrors)
                return
            }

            toast.error(error.displayMessage)
        }
    },
})

async function loadProjects() {
    isLoading.value = true
    await projectApi
        .fetchList(pagination.queryParams.value)
        .then(({ data, meta }) => {
            projects.value = data
            pagination.setFormResponseMeta(meta)
        })
        .finally(() => (isLoading.value = false))
}

async function onClickDelete(id: string) {
    if (!id) {
        return
    }

    confirm.require({
        message: 'Are you sure you want to delete this project?',
        accept: async () => {
            await projectApi
                .delete(id)
                .then(loadProjects)
                .catch((error) => {
                    toast.error(
                        error instanceof ApiError ? error.displayMessage : 'An error occurred. Please try again later.'
                    )
                })
        },
    })
}

function onRowClick(project: TProject) {
    router.push({ name: AppRouters.projectDetails.name, params: { id: project.id } })
}

onMounted(() => {
    loadProjects()
})
</script>

<template>
    <div class="flex flex-grow flex-col">
        <div class="flex items-center justify-end px-2 py-3">
            <div class="flex items-center gap-x-2">
                <Button @click="form.open()">New Project</Button>
            </div>
        </div>

        <EntityTable :columns="tableColumns" :items="projects" :is-loading="isLoading" @row:click="onRowClick">
            <template #column:id="{ data }">
                <div class="flex items-center justify-center gap-x-1">
                    <Button text rounded severity="primary" @click="form.open(data)" icon="pi pi-pencil" />
                    <Button text rounded severity="danger" @click="onClickDelete(data.id)" icon="pi pi-trash" />
                </div>
            </template>
            <template #column:status="{ data }">
                <EnumBadge :value="data.status" :status-map="ProjectStatusMetadataMap" class="w-full" />
            </template>
        </EntityTable>

        <Paginator
            :total-records="pagination.total.value"
            :rows="pagination.perPage.value"
            :rows-per-page-options="pagination.rowPerPageOptions.value"
            @page="pagination.onChangeState"
        />

        <Dialog v-model:visible="form.isVisible.value" position="right" class="w-96" header="Project">
            <AsyncProjectForm v-model="form.data.value" :errors="form.errors.value" />
            <template #footer>
                <div class="flex w-full items-center justify-between">
                    <Button text severity="secondary" class="font-bold" @click="form.close">Cancel</Button>
                    <Button text severity="success" class="font-bold" @click="form.submitForm">Save</Button>
                </div>
            </template>
        </Dialog>
    </div>
</template>

<style scoped></style>
