import type { SignInForm, User } from '@/entities/user/user.types.ts'
import { apiClient } from '@/services/api.client.ts'

export async function login(data: SignInForm): Promise<boolean> {
    return apiClient.post('auth/login', data).then(({ data }) => {
        console.log(data)
        return Boolean(data?.status)
    })
}

export async function fetchCurrentUser(): Promise<{ data: User }> {
    return apiClient.get('auth/me').then((response) => response.data)
}
