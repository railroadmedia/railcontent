import { createApp } from 'vue'
import VueImgix from 'vue-imgix'
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

app.use(VueImgix, {
    domain: 'https://musora.imgix.net',
    defaultIxParams: {
        // This enables the auto format imgix parameter by default for all images, which we recommend to reduce image size, but you might choose to turn this off.
        auto: 'format'
    }
})

const router = createRouter({
    history: createWebHistory(),
    routes
})

app.use(router)
app.mount('#app')
