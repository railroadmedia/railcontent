import { createApp } from 'vue'
import './tailwind.css'
import App from './App.vue'
import { routes } from './routes.js'
import { createRouter, createWebHistory } from 'vue-router'

const app = createApp(App)

app.directive('click-outside', {
  mounted(el, binding, vnode) {
    setTimeout(() => {
      el.clickOutsideEvent = (event) => {
        if (!(el === event.target || el.contains(event.target))) {
          binding.value()
        }
      }
      document.body.addEventListener('click', el.clickOutsideEvent)
    }, 100)
  },
  unmounted(el) {
    document.body.removeEventListener('click', el.clickOutsideEvent)
  }
})

const router = createRouter({
  history: createWebHistory(),
  routes
})

app.use(router)
app.mount('#app')
