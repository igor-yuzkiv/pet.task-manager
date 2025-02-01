import { createApp } from 'vue'
import AppComponent from '@/app/App.vue'
import registerPlugins from '@/app/plugins/registerPlugins.ts'
import router from '@/app/router'

const app = createApp(AppComponent)

app.use(router)
registerPlugins(app)

app.mount('#app')
