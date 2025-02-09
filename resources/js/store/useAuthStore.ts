import { defineStore } from 'pinia'
import { ref } from 'vue'
import type { User } from '@/entities/user/user.types.ts'
import { fetchCurrentUser } from '@/entities/user/user.api.ts'

export const useAuthStore = defineStore('authStore', () => {
    const user = ref<User | null>()

    async function checkIfAuthenticated(): Promise<boolean> {
        if (user.value) {
            return true
        }

        user.value = await fetchCurrentUser()
            .then((response) => response.data)
            .catch(() => null)

        return Boolean(user.value)
    }

    return {
        user,
        checkIfAuthenticated,
    }
})
