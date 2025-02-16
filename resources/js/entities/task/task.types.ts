import type { TProject } from '@/entities/project/project.types.ts'
import type { TUser } from '@/entities/user/user.types.ts'

export type TTask = {
    id: string
    project_id: string
    task_list_id: string | null
    name: string
    key: string
    description: string | null
    priority: string
    due_date: string | null

    owners?: TUser[]
    project?: TProject
}
