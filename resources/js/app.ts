import AppComponent from '@/app/App.vue'
import registerPlugins from '@/app/plugins/registerPlugins.ts'
import router from '@/app/router'
import { createApp } from 'vue'

const app = createApp(AppComponent)

app.use(router)
registerPlugins(app)

app.mount('#app')
