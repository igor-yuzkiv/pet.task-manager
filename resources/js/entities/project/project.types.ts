import type { StatusMap } from '@/types/status.types.ts'

export type Project = {
    id: string
    key: string
    name: string
    description: string
    status: string
}

export enum EProjectStatus {
    open = 'open',
    active = 'active',
    in_progress = 'in_progress',
    closed = 'closed',
}

export const ProjectStatusMap: StatusMap<EProjectStatus> = {
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
