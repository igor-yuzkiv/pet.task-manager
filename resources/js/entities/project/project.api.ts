import type { TProject } from '@/entities/project/project.types.ts'
import { apiClient } from '@/shared/services/api/api.client.ts'
import { EntityApi } from '@/shared/services/api/modules/EntityApi.ts'

class ProjectApi extends EntityApi<TProject> {
    constructor() {
        super('/projects', apiClient)
    }
}

export default new ProjectApi()
