import type { TTask } from '@/entities/task/task.types.ts'
import { apiClient } from '@/services/api/api.client.ts'
import { EntityApi } from '@/services/api/modules/EntityApi.ts'

class TaskApi extends EntityApi<TTask> {
    constructor() {
        super('/tasks', apiClient)
    }
}

export default new TaskApi()
