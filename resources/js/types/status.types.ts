export type StatusMetadata = {
    label: string
    color: string
}

export type StatusMap<T extends string> = Record<T, StatusMetadata>
