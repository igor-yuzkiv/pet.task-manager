import type { TProject, TProjectForm } from '@/entities/project/project.types.ts'
import type { PaginateMetaResponse } from '@/shared/types/api.types.ts'
import { apiClient } from '@/shared/services/api/api.client.ts'

const baseUrl = '/projects'

export default {
    async fetchProjects(query?: Record<string, string>): Promise<{ data: TProject[]; meta: PaginateMetaResponse }> {
        const url = query ? `${baseUrl}?${new URLSearchParams(query).toString()}` : baseUrl
        return apiClient.get(url).then((response) => response.data)
    },

    async fetchProject(id: string): Promise<TProject> {
        return await apiClient.get(`${baseUrl}/${id}`).then((response) => response.data)
    },

    async createProject(data: TProjectForm): Promise<TProject> {
        return await apiClient.post(baseUrl, data)
    },

    async updateProject(id: string, data: TProjectForm): Promise<TProject> {
        return await apiClient.put(`${baseUrl}/${id}`, data)
    },

    async deleteProject(id: string): Promise<void> {
        return await apiClient.delete(`${baseUrl}/${id}`)
    },
}
