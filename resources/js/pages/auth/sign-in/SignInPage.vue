<script setup lang="ts">
import { AxiosError } from 'axios'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import type { SignInForm } from '@/entities/user/user.types.ts'
import Button from 'primevue/button'
import Checkbox from 'primevue/checkbox'
import InputGroup from 'primevue/inputgroup'
import InputGroupAddon from 'primevue/inputgroupaddon'
import InputText from 'primevue/inputtext'
import Message from 'primevue/message'
import { Icon } from '@iconify/vue'
import { AppRouters } from '@/app/router/app-router.ts'
import { login } from '@/entities/user/user.api.ts'
import { useForm } from '@/shared/composables/useForm.ts'
import { useToast } from '@/shared/composables/useToast.ts'

const toast = useToast()
const router = useRouter()

const form = useForm<SignInForm>({
    initialValues: {
        email: '',
        password: '',
        remember: false,
    },
    validationSchema: yup.object({
        email: yup.string().email().required().label('Email'),
        password: yup.string().required().label('Password'),
    }),
    submit: async (data) => {
        try {
            await login(data)
            await router.push({ name: AppRouters.home.name })
        } catch (error) {
            const message =
                error instanceof AxiosError && error.response?.status === 401
                    ? 'Invalid email or password'
                    : 'Something went wrong. Please try again later'

            toast.error(message)
        }
    },
})
</script>

<template>
    <div class="flex w-96 flex-col gap-y-3 rounded-xl bg-white p-3 shadow-xl">
        <h1 class="text-xl font-bold">Sign In</h1>

        <div>
            <InputGroup>
                <InputGroupAddon>
                    <Icon icon="mdi:user" />
                </InputGroupAddon>
                <InputText
                    placeholder="Email"
                    type="email"
                    v-model="form.data.value.email"
                    aria-label="email"
                    :invlide="true"
                />
            </InputGroup>
            <Message v-if="form.errors.value.email" severity="error" variant="simple" size="small">
                {{ form.errors.value.email }}
            </Message>
        </div>

        <div>
            <InputGroup>
                <InputGroupAddon>
                    <Icon icon="mdi:password" />
                </InputGroupAddon>
                <InputText
                    placeholder="Password"
                    type="password"
                    v-model="form.data.value.password"
                    :invlide="!form.data.value.password"
                />
            </InputGroup>
            <Message v-if="form.errors.value.password" severity="error" variant="simple" size="small">
                {{ form.errors.value.password }}
            </Message>
        </div>

        <div class="flex items-center">
            <Checkbox v-model="form.data.value.remember" binary name="remember" inputId="remember" />
            <label for="remember" class="ml-2">Remember me</label>
        </div>

        <Button @click="form.submitForm">Sign In</Button>
    </div>
</template>

<style scoped></style>
