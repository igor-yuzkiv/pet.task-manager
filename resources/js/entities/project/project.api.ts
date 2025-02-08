import type { Project } from '@/entities/project/project.types.ts'
import { apiClient } from '@/services/api.client.ts'

export async function fetchProjects(): Promise<{ data: Project }> {
    return apiClient.get('/projects').then((response) => response.data)
}
