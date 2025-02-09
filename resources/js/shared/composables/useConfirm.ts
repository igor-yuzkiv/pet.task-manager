import type { ConfirmationOptions } from 'primevue/confirmationoptions'
import { useConfirm as useBaseConfirm } from 'primevue/useconfirm'

const DefaultConfirmationOptions: ConfirmationOptions = {
    header: 'Confirm',
}

export function useConfirm() {
    const baseConfirm = useBaseConfirm()

    function require(option: ConfirmationOptions) {
        baseConfirm.require({
            ...DefaultConfirmationOptions,
            ...option,
        })
    }

    function asyncRequire(option: ConfirmationOptions): Promise<boolean | null> {
        return new Promise((resolve) => {
            baseConfirm.require({
                ...DefaultConfirmationOptions,
                ...option,
                accept: () => resolve(true),
                reject: () => resolve(false),
                onHide: () => resolve(null),
            })
        })
    }

    return {
        require,
        asyncRequire,
        close: baseConfirm.close,
    }
}
