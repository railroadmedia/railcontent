<script>
export default {
    props: {
        id: {
            type: String,
            default: 'text-input'
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
        data: {
            type: Array,
            default: [],
        },
        isVisible: {
            type: Boolean,
            default: true
        }
    },
}
</script>

<template>
    <section class="tw-text-[#00101D] dark:tw-text-white">
        <div class="tw-my-8">

            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">{{ title }}</h2>
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   aria-label="See My Dashboard" 
                   class="tw-uppercase tw-font-bebas-neue tw-tracking-wide"
                >
                    See All
                </a>
            </div> 
            
            <template v-if="type === 'video'">
                <i>Print Video Cards</i>
            </template>

            <template v-if="type === 'coach'">
                <i>Print Coach Cards</i>
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