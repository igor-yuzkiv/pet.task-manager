import type { AxiosInstance } from 'axios'
import type { PaginateMetaResponse } from '@/shared/services/api/api.types.ts'

function resolveFiltersQuery(filters: string[]): Record<string, string> {
    return filters && filters.length
        ? Object.fromEntries(filters.map((filter, index) => [`filters[${index}]`, filter]))
        : {}
}

export abstract class EntityApi<T> {
    baseUrl: string
    apiClient: AxiosInstance

    protected constructor(baseUrl: string, apiClient: AxiosInstance) {
        this.baseUrl = baseUrl
        this.apiClient = apiClient
    }

    async fetchList(
        query?: Record<string, string>,
        filters?: string[]
    ): Promise<{
        data: T[]
        meta: PaginateMetaResponse
    }> {
        const queryString = new URLSearchParams({
            ...(query || {}),
            ...resolveFiltersQuery(filters || []),
        }).toString()

        const url = query ? `${this.baseUrl}?${queryString}` : this.baseUrl
        return this.apiClient.get(url).then((response) => response.data)
    }

    async fetchById(id: string): Promise<T> {
        return await this.apiClient.get(`${this.baseUrl}/${id}`).then((response) => response.data)
    }

    async create(data: Partial<T>): Promise<T> {
        return await this.apiClient.post(this.baseUrl, data)
    }

    async update(id: string, data: Partial<T>): Promise<T> {
        return await this.apiClient.put(`${this.baseUrl}/${id}`, data)
    }

    async delete(id: string): Promise<void> {
        return await this.apiClient.delete(`${this.baseUrl}/${id}`)
    }
}
