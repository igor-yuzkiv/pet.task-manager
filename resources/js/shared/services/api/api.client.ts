import axios, { type AxiosResponse } from 'axios'
import ApiError from '@/shared/services/api/modules/ApiError.ts'

const apiClient = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
})

function responseHandler(response: AxiosResponse) {
    return response
}

function errorHandler(error: Error) {
    return Promise.reject(axios.isAxiosError(error) ? new ApiError(error) : error)
}

apiClient.interceptors.response.use(responseHandler, errorHandler)

export { apiClient }
