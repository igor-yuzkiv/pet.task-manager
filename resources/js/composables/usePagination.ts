import { computed, ref } from 'vue'
import type { PaginateMetaResponse } from '@/services/api/api.types.ts'
import type { PageState } from 'primevue/paginator'

export function usePagination(onChangeCallback: () => Promise<void>) {
    const currentPage = ref<number>(1)
    const perPage = ref<number>(20)
    const total = ref<number>(0)
    const rowPerPageOptions = ref([10, 20, 50, 100])

    const queryParams = computed(() => {
        return {
            page: currentPage.value + '',
            per_page: perPage.value + '',
        }
    })

    function setFormResponseMeta(meta: PaginateMetaResponse) {
        currentPage.value = meta.current_page
        perPage.value = meta.per_page
        total.value = meta.total
    }

    async function onChangeState(state: PageState) {
        currentPage.value = state.page + 1
        perPage.value = state.rows
        await onChangeCallback()
    }

    return {
        currentPage,
        perPage,
        total,
        rowPerPageOptions,
        queryParams,
        onChangeState,
        setFormResponseMeta,
    }
}
