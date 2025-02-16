import type { EnumMetadataMap } from '@/shared/types/enum-metadata.types.ts'

export enum EPriority {
    low = 'low',
    medium = 'medium',
    high = 'high',
}

export const TPriorityMap: EnumMetadataMap<EPriority> = {
    [EPriority.low]: {
        label: 'Low',
        color: '#50bd56',
    },
    [EPriority.medium]: {
        label: 'Medium',
        color: '#ffa500',
    },
    [EPriority.high]: {
        label: 'High',
        color: '#ff4c4c',
    },
}
