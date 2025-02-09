import Aura from '@primevue/themes/aura'
import 'primeicons/primeicons.css'
import type { App } from 'vue'
import PrimeVue from 'primevue/config'
import ConfirmationService from 'primevue/confirmationservice'
import ToastService from 'primevue/toastservice'

export default function (app: App) {
    app.use(PrimeVue, {
        theme: {
            preset: Aura,
            options: {
                darkModeSelector: '.dark-mode',
                cssLayer: {
                    name: 'primevue',
                    order: 'tailwind-base, primevue, tailwind-utilities',
                },
            },
        },
    })

    app.use(ConfirmationService)
    app.use(ToastService)
}
