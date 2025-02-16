export type EnumMetadata = {
    label: string
    color: string
}

export type EnumMetadataMap<T extends string> = Record<T, EnumMetadata>
