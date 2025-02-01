import { Schema, ValidationError } from 'yup'
import { ref } from 'vue'

export interface IFormOptions<T> {
    initialValues: T
    submit: (values: T) => Promise<void>
    validationSchema?: Schema<Partial<T>>
}

export function useForm<T extends Record<string, unknown>>(options: IFormOptions<T>) {
    const data = ref<T>(options.initialValues)
    const errors = ref<Partial<Record<keyof T, string>>>({})

    async function validateForm() {
        if (!options.validationSchema) return true

        try {
            await options.validationSchema.validate(data.value, { abortEarly: false })
            errors.value = {}
            return true
        } catch (err) {
            if (err instanceof ValidationError) {
                errors.value = err.inner.reduce(
                    (acc, curr) => {
                        acc[curr.path as keyof T] = curr.message
                        return acc
                    },
                    {} as Partial<Record<keyof T, string>>
                )
            }
            return false
        }
    }

    async function submitForm() {
        if (await validateForm()) {
            await options.submit(data.value)
        }
    }

    return {
        data,
        errors,
        validateForm,
        submitForm,
    }
}
