<script>
import { ref } from 'vue'
import Navbar from '../Navbar/Navbar.vue'
import Sidebar from '../Sidebar/Sidebar.vue'
import Footer from '../Footer/Footer.vue'

export default {
    name: 'PageContainer',
    components: { Navbar, Sidebar, Footer },
    setup(props, context) {
        const isSidebarCollapsed = ref(false)
        const isDarkModeSelected = ref(true)
        const brand = ref('drumeo')

        const onCollapseSidebar = (val) => {
            console.log(val)
            if (typeof val === 'boolean') {
                isSidebarCollapsed.value = val
            } else {
                isSidebarCollapsed.value = !isSidebarCollapsed.value
            }
        }

        const onColorModeToggle = (val) => {
            if (typeof val === 'boolean') {
                isDarkModeSelected.value = val
            } else {
                isDarkModeSelected.value = !isDarkModeSelected.value
            }
        }

        const onBrandSelect = (val) => {
            if (typeof val === 'string') {
                brand.value = val
            }
        }

        return {
            isSidebarCollapsed,
            isDarkModeSelected,
            brand,
            onCollapseSidebar,
            onColorModeToggle,
            onBrandSelect
        }
    }
}
</script>

<template>
    <main :class="isDarkModeSelected ? 'tw-dark' : 'tw-block'"
          class="tw-min-h-screen"
    >
        <Navbar
            :brand="brand"
            @onBrandSelect="onBrandSelect"
            @onCollapseSidebar="onCollapseSidebar"
            @onColorModeToggle="onColorModeToggle"
        />

        <!-- Page Container -->
        <div class="tw-flex tw-flex-row tw-min-h-screen tw-pt-[58px] dark:tw-bg-[#000C17]">

            <!-- Sidebar -->
            <Sidebar :brand="brand" :isSidebarCollapsed="isSidebarCollapsed" />

            <!-- Content Container -->
            <main class="content-container tw-flex tw-grow tw-flex-col">

                <!-- Content -->
                <section class="main-content tw-h-full tw-w-full">
                    
                    <div class="tw-container tw-mx-auto sm:tw-px-4 tw-px-8">
                        <slot />
                    </div>

                </section>

                <!-- Footer -->
                <Footer />
            </main>
        </div>
    </main>
</template>
