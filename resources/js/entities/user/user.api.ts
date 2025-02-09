import type { TSignInForm, TUser } from '@/entities/user/user.types.ts'
import { apiClient } from '@/shared/services/api/api.client.ts'

export async function login(data: TSignInForm): Promise<boolean> {
    return apiClient.post('auth/login', data).then(({ data }) => Boolean(data?.status))
}

export async function fetchCurrentUser(): Promise<{ data: TUser }> {
    return apiClient.get('auth/me').then((response) => response.data)
}
