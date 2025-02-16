import type { AxiosInstance } from 'axios'
import type { TProject } from '@/entities/project/project.types.ts'
import type { PaginateMetaResponse } from '@/shared/types/api.types.ts'

export abstract class EntityApi<T> {
    baseUrl: string
    apiClient: AxiosInstance

    protected constructor(baseUrl: string, apiClient: AxiosInstance) {
        this.baseUrl = baseUrl
        this.apiClient = apiClient
    }

    async fetchList(query?: Record<string, string>): Promise<{ data: TProject[]; meta: PaginateMetaResponse }> {
        const url = query ? `${this.baseUrl}?${new URLSearchParams(query).toString()}` : this.baseUrl
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
