import { Schema, ValidationError } from 'yup'
import { ref } from 'vue'

export interface IFormOptions<T> {
    initialValues: T
    submit: (values: T) => Promise<void>
    validationSchema?: Schema<Partial<T>>
}

export function useForm<T extends Record<string, unknown>>(options: IFormOptions<T>) {
    const isVisible = ref(false)
    const data = ref<T>(options.initialValues)
    const errors = ref<Partial<Record<keyof T, string | string[]>>>({})

    function open(partialData: Partial<T> = {}) {
        data.value = { ...options.initialValues, ...partialData }
        isVisible.value = true
    }

    function close() {
        isVisible.value = false
    }

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

    function getFieldError(field: keyof T): string | undefined {
        const error = errors.value?.[field]
        if (Array.isArray(error)) {
            return error[0]
        }

        return error
    }

    return {
        isVisible,
        data,
        errors,
        open,
        close,
        validateForm,
        submitForm,
        getFieldError,
    }
}
