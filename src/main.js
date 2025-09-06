// main.js
import './assets/style/main.scss'

import { createApp } from 'vue'
import App from './App.vue'
import gsap from 'gsap'
import router from './router/router'
import VueTheMask from 'vue-the-mask' // ✅ импорт

const app = createApp(App)

app
  .directive("click-outside", {
    mounted(el, { value }) {
      el.clickOutside = (event) => {
        if (!(el === event.target || el.contains(event.target))) {
          value(event)
        }
      }
      document.body.addEventListener("click", el.clickOutside)
    },
    unmounted(el) {
      document.body.removeEventListener("click", el.clickOutside)
    },
  })
  .use(VueTheMask) // ✅ .use(), а не .directive()
  .use(router)
  .provide('gsap', gsap)
  .mount('#app')