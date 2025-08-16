import './assets/style/main.scss'

import { createApp } from 'vue'
import App from './App.vue'
import gsap from 'gsap'
import router from './router/router'

const app = createApp(App)

app
  .directive("click-outside", {
    mounted(element, { value }) {
      element.clickOutside = function (event) {
        if (!(element === event.target || element.contains(event.target))) {
          value(event);
        }
      };
      document.body.addEventListener("click", element.clickOutside);
    },
    unmounted(element) {
      document.body.removeEventListener("click", element.clickOutside);
    },
  })
    .use(router)
    .provide('gsap', gsap)
    .mount('#app')
