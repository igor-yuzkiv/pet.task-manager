export type EnumMetadata = {
    label: string
    color: string
    weight?: number
}

export type EnumMetadataMap<T extends string> = Record<T, EnumMetadata>
