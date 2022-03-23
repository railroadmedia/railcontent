<script>
import { ref } from 'vue'
import Navbar from '../Navbar/Navbar.vue'
import Sidebar from '../Sidebar/Sidebar.vue'
import Footer from '../Footer/Footer.vue'
import { useRouter, useRoute } from 'vue-router'

export default {
    name: 'PageContainer',
    components: { Navbar, Sidebar, Footer },

    setup(props, context) {
        const isSidebarCollapsed = ref(false)
        const isSidebarHidden = ref(false)
        const isDarkModeSelected = ref(false)
        const brand = ref('drumeo')
        const route = useRoute()
        const router = useRouter()
        
        const onCollapseSidebar = (val) => {
            if (typeof val === 'boolean') {
                isSidebarCollapsed.value = val;
                isSidebarHidden.value = val;
            } else {           
                const smallBreakpoint = window.matchMedia('(max-width: 767px)');
                if(smallBreakpoint.matches) {
                    isSidebarHidden.value = !isSidebarHidden.value;
                    isSidebarCollapsed.value = false;  
                } else {
                    isSidebarHidden.value = false;
                    isSidebarCollapsed.value = !isSidebarCollapsed.value;
                }
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
            const urlSearchParams = new URLSearchParams(window.location.search)
            if (typeof val === 'string') {
                brand.value = val;
                urlSearchParams.set('brand', val);
                //if using router
                router.push({path:'/members', query:{brand: val}})
            }
        }

        return {
            isSidebarCollapsed,
            isSidebarHidden,
            isDarkModeSelected,
            brand,
            onCollapseSidebar,
            onColorModeToggle,
            onBrandSelect
        }
    },

    beforeMount() {
        //Set Dark Mode Based on User Preferences
        this.isDarkModeSelected = window.matchMedia("(prefers-color-scheme: dark)").matches;
        //Get Query String
        const urlSearchParams = new URLSearchParams(window.location.search)
        const brandParam = urlSearchParams.get('brand');
        this.brand = brandParam || 'drumeo';

        //Set Sidebar State
        const smallBreakpoint = window.matchMedia('(max-width: 767px)');
        if(smallBreakpoint.matches) {
            this.isSidebarHidden = true;
            this.isSidebarCollapsed = false;
        }
    },

    created() {
        this.$watch(
            //Watch for changes in route params
            () => this.$route.query,
            (toParams, previousParams) => {
                this.brand = this.$route.query.brand;
            }
        )
        //Check if Mobile on Resize
        window.addEventListener("resize", this.onResize);
    },

    destroyed() {
        window.removeEventListener("resize", this.onResize);
    },

    methods: {
        onResize(e) {
            const smallBreakpoint = window.matchMedia('(max-width: 767px)');
            if(smallBreakpoint.matches) {
                this.isSidebarHidden = true;
                this.isSidebarCollapsed = false;
            }
        },
    },
}
</script>

<template>
    <main :class="isDarkModeSelected ? 'tw-dark' : 'tw-block'"
          class="tw-min-h-screen tw-w-screen"
    >
        <Navbar
            :brand="brand"
            :isSidebarHidden="isSidebarHidden"
            :isSidebarCollapsed="isSidebarCollapsed"
            @onBrandSelect="onBrandSelect"
            @onCollapseSidebar="onCollapseSidebar"
            @onColorModeToggle="onColorModeToggle"
        />

        <!-- Page Container -->
        <div class="tw-flex tw-flex-row tw-w-full tw-min-h-screen tw-pt-[58px] tw-transition-colors dark:tw-bg-[#000C17]">

            <!-- Sidebar -->
            <Sidebar :brand="brand" 
                     :isSidebarCollapsed="isSidebarCollapsed" 
                     :isSidebarHidden="isSidebarHidden"
            />

            <!-- Content Container -->
            <main class="tw-flex tw-grow tw-flex-col">

                <!-- Content -->
                <section class="tw-h-full tw-w-full">

                    <slot />

                </section>

                <!-- Footer -->
                <Footer />
            </main>
        </div>
    </main>
</template>
