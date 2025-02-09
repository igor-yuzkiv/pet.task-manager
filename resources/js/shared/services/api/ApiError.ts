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
        super()

        this.error = error
    }

    get status(): number | undefined {
        return this.error.response?.status
    }

    get response(): ErrorResponseData | undefined {
        return this.error.response?.data as ErrorResponseData
    }

    get displayMessage(): string {
        if (this.response?.message) {
            return this.response.message
        }

        if (this.status && this.status in STATUS_CODE_MESSAGES) {
            return STATUS_CODE_MESSAGES[this.status]
        }

        return DEFAULT_MESSAGE
    }
}
