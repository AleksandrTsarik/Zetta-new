import './assets/style/main.scss'

import { createApp } from 'vue'
import App from './App.vue'
import gsap from 'gsap'
import router from './router/router'

const app = createApp(App)
app.use(router)
app.provide('gsap', gsap)
app.mount('#app')
