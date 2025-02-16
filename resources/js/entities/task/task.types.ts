import type { TProject } from '@/entities/project/project.types.ts'
import type { TUser } from '@/entities/user/user.types.ts'
import type { EnumMetadataMap } from '@/shared/types/enum-metadata.types.ts'
import type { EPriority } from '@/shared/types/priority.types.ts'

export type TTask = {
    id: string
    project_id: string
    task_list_id: string | null
    name: string
    key: string
    description: string | null
    status: ETaskStatus
    priority: EPriority | null
    due_date: string | null

    owners?: TUser[]
    project?: TProject
}

export enum ETaskStatus {
    open = 'open',
    in_progress = 'in_progress',
    completed = 'completed',
    closed = 'closed',
}

export const TaskStatusMetadataMap: EnumMetadataMap<ETaskStatus> = {
    [ETaskStatus.open]: {
        label: 'Open',
        color: '#289dff',
    },
    [ETaskStatus.in_progress]: {
        label: 'In Progress',
        color: '#ffa500',
    },
    [ETaskStatus.completed]: {
        label: 'Completed',
        color: '#50bd56',
    },
    [ETaskStatus.closed]: {
        label: 'Closed',
        color: '#817f91',
    },
}
