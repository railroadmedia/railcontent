<script>
import ContentCatalogue from '../../vuesora/views/catalogues/ContentCatalogue.vue';

export default {
    components: { ContentCatalogue },
    data() {
        return {
            cardData: [],
        }
    },
    props: {
        id: {
            type: String,
            default: 'section'
        },
        brand: {
            type: String,
            default: 'drumeo'
        },
        type: {
            type: String,
            default: 'video'
        },
        title: {
            type: String,
            default: 'Section'
        },
        isVisible: {
            type: Boolean,
            default: true
        },
        preloadedContent: {
            type: Array,
            default: [],
        },
        contentEndpoint: {
            type: String,
            default: '/',
        },
        url: {
            type: String,
            default: '/'
        }
    },
    watch: {
        // whenever brand changes, this function will run
        brand(newBrand, oldBrand) {
            this.getCardData(newBrand);
        }
    },           
}
</script>

<template>
    <section :id="id" v-if="this.isVisible" class="tw-my-8 tw-text-[#00101D] dark:tw-text-white">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <a href="" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">{{ title }}</h2>
            </a>
            <a href="https://www.drumeo.com/laravel/public/members/profile" 
                aria-label="See My Dashboard" 
                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                See All
            </a>
        </div> 
        
        <div class="tw-flex">
            <!-- Video Cards -->
            <template v-if="type === 'video'">
                <transition name="fade">
                    <content-catalogue
                            :theme-color="brand"
                            :use-theme-color="true"
                            :content-endpoint="contentEndpoint"
                            catalogue-type="grid"
                            limit="16"
                            :lock-unowned="true"
                            :six-wide="true"
                            :force-wide-thumbs="true"
                            :pre-loaded-content="false"
                    >
                        <div class="tw-flex">
                            <!-- Skeleton Loader -->
                        </div>
                    </content-catalogue>
                </transition>
            </template>

            <template v-if="type === 'coach'">
                
            </template>

            <template v-if="type === 'forum'">
                <i>Print Forum Cards</i>
            </template>

            <template v-if="type === 'playlist'">
                <i>Print Playlist Cards</i>
            </template>
            
        </div>
  
    </section>
</template>