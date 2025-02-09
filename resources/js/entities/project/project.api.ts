import type { Project } from '@/entities/project/project.types.ts'
import type { PaginateMetaResponse } from '@/shared/types/api.types.ts'
import { apiClient } from '@/shared/services/api.client.ts'

export default {
    async fetchProjects(query?: Record<string, string>): Promise<{ data: Project[]; meta: PaginateMetaResponse }> {
        let url = '/projects'
        if (query) {
            url += '?' + new URLSearchParams(query).toString()
        }

        return apiClient.get(url).then((response) => response.data)
    },
}
