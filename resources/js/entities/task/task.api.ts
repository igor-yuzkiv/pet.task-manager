import type { TTask } from '@/entities/task/task.types.ts'
import { apiClient } from '@/shared/services/api/api.client.ts'
import { EntityApi } from '@/shared/services/api/modules/EntityApi.ts'

class TaskApi extends EntityApi<TTask> {
    constructor() {
        super('/tasks', apiClient)
    }
}

export default new TaskApi()
