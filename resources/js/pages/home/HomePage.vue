<script setup lang="ts">
import * as yup from 'yup'
import { defineAsyncComponent, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import type { TProject, TProjectForm } from '@/entities/project/project.types.ts'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import Paginator from 'primevue/paginator'
import { Icon } from '@iconify/vue'
import { AppRouters } from '@/app/router/app-router.ts'
import projectApi from '@/entities/project/project.api.ts'
import { useConfirm } from '@/shared/composables/useConfirm.ts'
import { useForm } from '@/shared/composables/useForm.ts'
import { usePagination } from '@/shared/composables/usePagination.ts'
import { useToast } from '@/shared/composables/useToast.ts'
import ApiError from '@/shared/services/api/ApiError.ts'
import { ProjectTable } from '@/widgets/project-table'

const AsyncProjectForm = defineAsyncComponent(() => import('@/widgets/project-form/ProjectForm.vue'))

const router = useRouter()
const toast = useToast()
const confirm = useConfirm()
const projects = ref<TProject[]>([])
const pagination = usePagination(loadProjects)

function handleError(error: Error | unknown) {
    toast.error(error instanceof ApiError ? error.displayMessage : 'An error occurred. Please try again later.')
}

const form = useForm<TProjectForm>({
    initialValues: {
        id: undefined,
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
                await projectApi.updateProject(data.id, data)
            } else {
                await projectApi.createProject(data)
            }

            form.close()
            await loadProjects()
        } catch (error) {
            handleError(error)
        }
    },
})

async function loadProjects() {
    await projectApi.fetchProjects(pagination.queryParams.value).then(({ data, meta }) => {
        projects.value = data
        pagination.setFormResponseMeta(meta)
    })
}

async function onClickDelete(id: string) {
    if (!id) {
        return
    }

    confirm.require({
        message: 'Are you sure you want to delete this project?',
        accept: async () => {
            await projectApi.deleteProject(id).then(loadProjects).catch(handleError)
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

        <ProjectTable with-actions :projects="projects" @row:click="onRowClick">
            <template #actions="{ data }">
                <div class="flex items-center justify-center gap-x-1">
                    <Button text rounded severity="primary" @click="form.open(data)">
                        <template #icon>
                            <Icon icon="mdi:pencil" />
                        </template>
                    </Button>

                    <Button text rounded severity="danger" @click="onClickDelete(data.id)">
                        <template #icon>
                            <Icon icon="mdi:trash" />
                        </template>
                    </Button>
                </div>
            </template>
        </ProjectTable>

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
