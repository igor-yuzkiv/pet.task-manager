import type { TTask } from '@/entities/task/task.types.ts'
import type { StatusMap } from '@/shared/types/status.types.ts'

export type TProject = {
    id: string
    key: string
    name: string
    description: string
    status: string

    tasks?: TTask[]
}

export type TProjectForm = Partial<Pick<TProject, 'id' | 'key' | 'name' | 'description' | 'status'>>

export enum EProjectStatus {
    open = 'open',
    active = 'active',
    in_progress = 'in_progress',
    closed = 'closed',
}

export const TProjectStatusMap: StatusMap<EProjectStatus> = {
    [EProjectStatus.open]: {
        label: 'Open',
        color: '#289dff',
    },
    [EProjectStatus.active]: {
        label: 'Active',
        color: '#50bd56',
    },
    [EProjectStatus.in_progress]: {
        label: 'In Progress',
        color: '#ffa500',
    },
    [EProjectStatus.closed]: {
        label: 'Closed',
        color: '#817f91',
    },
}
