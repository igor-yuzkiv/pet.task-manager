import type { SignInForm, User } from '@/entities/user/user.types.ts'
import { apiClient } from '@/shared/services/api.client.ts'

export async function login(data: SignInForm): Promise<boolean> {
    return apiClient.post('auth/login', data).then(({ data }) => Boolean(data?.status))
}

export async function fetchCurrentUser(): Promise<{ data: User }> {
    return apiClient.get('auth/me').then((response) => response.data)
}
