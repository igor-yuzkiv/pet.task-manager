import { useToast as useBaseToast } from 'primevue/usetoast'

export function useToast(life = 3000) {
    const toast = useBaseToast()

    function info(detail: string, summary = 'Info') {
        toast.add({ severity: 'info', summary, detail, life })
    }

    function error(detail: string, summary = 'Error') {
        toast.add({ severity: 'error', summary, detail, life })
    }

    function success(detail: string, summary = 'Success') {
        toast.add({ severity: 'success', summary, detail, life })
    }

    return { error, success, info }
}
