import type { AxiosError } from 'axios'

const DEFAULT_MESSAGE = 'An error occurred. Please try again later.'

const STATUS_CODE_MESSAGES: Record<number, string> = {
    401: 'Unauthorized',
    403: 'Forbidden',
    404: 'Not Found',
    422: 'Unprocessable Entity',
    500: 'Internal Server Error',
}

interface ErrorResponseData {
    message?: string

    [key: string]: unknown
}

export default class ApiError extends Error {
    error: AxiosError

    constructor(error: AxiosError) {
        super(error.message || DEFAULT_MESSAGE)

        this.name = 'ApiError'
        this.error = error
    }

    get status(): number | undefined {
        return this.error.response?.status
    }

    get isValidationError(): boolean {
        return this.status === 422
    }

    get response(): ErrorResponseData | undefined {
        return this.error.response?.data as ErrorResponseData
    }

    get validationErrors(): Record<string, unknown> | undefined {
        return this.isValidationError ? (this.response?.errors as Record<string, unknown>) : undefined
    }

    get displayMessage(): string {
        if (this.isValidationError && this.response?.message) {
            return this.response.message
        }

        return STATUS_CODE_MESSAGES[this.status ?? 0] ?? DEFAULT_MESSAGE
    }
}
