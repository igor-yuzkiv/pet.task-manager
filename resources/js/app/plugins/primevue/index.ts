import Aura from '@primevue/themes/aura'
import PrimeVue from 'primevue/config'
import type { App } from 'vue'

export default function (app: App) {
    app.use(PrimeVue, {
        theme: {
            preset: Aura,
            options: {
                darkModeSelector: '.dark-mode',
            },
        },
    })
}
