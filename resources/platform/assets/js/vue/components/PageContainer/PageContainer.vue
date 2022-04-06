<script>
import { ref } from 'vue'
import Navbar from '../Navbar/Navbar.vue'
import Sidebar from '../Sidebar/Sidebar.vue'
import Footer from '../Footer/Footer.vue'
import { useRouter, useRoute } from 'vue-router'
import SpriteSheet from '../MusoraIcons/SpriteSheet.vue'
import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

export default {
    name: 'PageContainer',
    components: { Navbar, Sidebar, Footer, SpriteSheet, },
    data() {
        return {
            brand: 'drumeo'
        }
    },

    setup(props, context) {
        const isSidebarCollapsed = ref(false)
        const isSidebarHidden = ref(false)
        const isDarkModeSelected = ref(false)
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
                isDarkModeSelected.value = val;
                localStorage.setItem('darkMode', val);
            } else {
                isDarkModeSelected.value = !isDarkModeSelected.value;
                localStorage.setItem('darkMode', isDarkModeSelected.value);
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
            onCollapseSidebar,
            onColorModeToggle,
            onBrandSelect
        }
    },

    beforeMount() {
        //Set Dark Mode Based on User Preferences
        if( localStorage.getItem('darkMode') ) {
            this.isDarkModeSelected = JSON.parse(localStorage.getItem('darkMode'));
        } else {
            this.isDarkModeSelected = window.matchMedia("(prefers-color-scheme: dark)").matches;
        }
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
        <sprite-sheet></sprite-sheet>

        <Navbar
            :brand="brand"
            :isSidebarHidden="isSidebarHidden"
            :isDarkModeSelected="isDarkModeSelected"
            :isSidebarCollapsed="isSidebarCollapsed"
            @onBrandSelect="onBrandSelect"
            @onCollapseSidebar="onCollapseSidebar"
            @onColorModeToggle="onColorModeToggle"
        />

        <!-- Page Container -->
        <div class="tw-flex tw-flex-row tw-w-full tw-h-screen tw-transition-colors dark:tw-bg-[#000C17] tw-overflow-hidden">

            <!-- Sidebar -->
            <Sidebar :brand="brand" 
                     :isSidebarCollapsed="isSidebarCollapsed" 
                     :isSidebarHidden="isSidebarHidden"
            />

            <!-- Content Container -->
            <main class="tw-flex tw-w-full tw-h-full tw-min-h-screen tw-pt-[58px] tw-flex-col tw-relative tw-overflow-y-auto tw-overflow-x-hidden" data-simplebar>

                <!-- Content -->
                <section class="tw-flex tw-flex-col tw-grow tw-w-full">

                    <slot />

                </section>

                <!-- Footer -->
                <Footer />

                <!-- Sidebar Content Wrapper -->
                <Transition name="fade">
                    <div v-if="!isSidebarCollapsed && !isSidebarHidden" 
                        @click="isSidebarHidden = true"
                        class="tw-absolute md:tw-hidden tw-top-0 tw-left-0 tw-w-full tw-h-full tw-z-10 tw-bg-black/30">
                    </div>
                </Transition>
            </main>
        </div>
    </main>
</template>
