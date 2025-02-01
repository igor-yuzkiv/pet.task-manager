<script setup lang="ts">
import * as yup from 'yup'
import Button from 'primevue/button'
import Checkbox from 'primevue/checkbox'
import InputGroup from 'primevue/inputgroup'
import InputGroupAddon from 'primevue/inputgroupaddon'
import InputText from 'primevue/inputtext'
import Message from 'primevue/message'
import { useToast } from 'primevue/usetoast'
import { Icon } from '@iconify/vue'
import { useForm } from '@/composables/useForm.ts'
import * as types from './types.ts'

const toast = useToast()

const form = useForm<types.SignInForm>({
    initialValues: {
        email: '',
        password: '',
        remember: false,
    },
    validationSchema: yup.object({
        email: yup.string().email().required().label('Email'),
        password: yup.string().required().label('Password'),
    }),
    submit: async (values) => {
        console.log('submit', values)
        toast.add({
            severity: 'error',
            summary: 'Success',
            detail: 'Invalid email or password',
            life: 3000,
        })
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
