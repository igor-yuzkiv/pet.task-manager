import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAppStore = defineStore('app', () => {
    const isLoading = ref<boolean>(false)

    function toggleLoading(value?: boolean) {
        isLoading.value = typeof value === 'boolean' ? value : !isLoading.value
    }

    return {
        isLoading,
        toggleLoading,
    }
})
