<script>
import { textColor, bgColor, bgBottomGradients } from '../../../constants/brands.js'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
    components: { MusoraIcon },
    data() {
        return {
            brandLearningPathProgressPercent: 0,
            brandLearningPathLevel: '1.1',
            brandUserMetric: [
                {
                    icon: 'trophy-filled',
                    value: 0,
                    label: 'Enthusiast I',
                },
                {
                    icon: 'messages-filled',
                    value: 0,
                    label: 'Forum Post Likes',
                },
                {
                    icon: 'thumb-like',
                    value: 0,
                    label: 'Comment Likes',
                },
                {
                    icon: 'clock-filled',
                    value: 0,
                    label: 'Minutes Practiced',
                },
            ],
        }
    },
    props: {
        brand: {
            type: String,
            default: 'drumeo'
        },
        nextLearningPathProgressPercent: {
            type: Number,
            default: 0
        },
        nextLearningPathLevel: {
            type: String,
            default: '1.1'
        },
        userMetrics: {
            type: Array,
            default: [],
        }
    },
    setup(_props) {
        return {
            textColor,
            bgColor,
            bgBottomGradients,
        }
    },

    watch: {
        brand(newBrand, oldBrand) {
            //fetch user metrics when prop changes and change brandUserMetric data
        },
    },

    beforeMount() {
        //Initial data
        //set brand specific user metric to prop
        if(this.userMetrics.length > 0) {
            this.brandUserMetric = this.userMetrics;
        }
    },


}
</script>

<template>

    <section id="stats-section" class="tw-flex tw-flex-col tw-mb-5 tw-text-[#00101D] dark:tw-text-white tw-w-full">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <a href="" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">My Stats</h2>
            </a>
            <a href="https://www.drumeo.com/laravel/public/members/profile" 
                aria-label="See My Dashboard" 
                class="tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                Dashboard
            </a>
        </div> 

        <!-- Method Progress -->
        <div class="tw-flex tw-flex-col lg:tw-flex-row tw-justify-center tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] lg:tw-pr-6 tw-bg-gradient-to-b" :class="bgBottomGradients[brand]">
            <div class="tw-flex tw-items-center tw-justify-center tw-px-8 tw-w-full lg:tw-w-7/12">
                <img :src="`https://musora-ui.s3.amazonaws.com/logos/${ brand }-method.svg`" :alt="brand" class="tw-max-w-[200px] lg:tw-max-w-[567px] tw-w-full tw-mb-4 lg:tw-mb-0" />
            </div> 
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-px-8 tw-w-full lg:tw-w-5/12">
                <div class="tw-text-center tw-w-full tw-max-w-[287px]">
                    <h3 class="text-white tw-text-4xl xl:tw-text-[54px] tw-font-bold tw-leading-none tw-mb-2 tw-uppercase">Level {{ nextLearningPathLevel }}</h3> 
                    <!-- progress bar -->
                    <div class="tw-bg-white tw-relative tw-w-full tw-h-[26px] tw-rounded-full tw-border-white tw-border-[3px]">
                        <div class="tw-absolute tw-h-full tw-rounded-full tw-top-0 tw-left-0" :class="[bgColor[brand]]" :style="`width: ${nextLearningPathProgressPercent}%;`">
                            <span class="tw-absolute tw-top-0 tw-h-full tw-font-bold tw-translate-x-full tw-text-sm tw-right-[-5px]" :class="textColor[brand]">{{nextLearningPathProgressPercent}}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!-- User Metrics -->
        <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
            <a v-for="(metric, i) in brandUserMetric" 
                :key="i" 
                href="/members/profile"
                class="tw-inline-flex tw-w-full tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-justify-items-stretch tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-center"
            >
                <musora-icon :icon-name="metric.icon" 
                                width="35" 
                                height="35" 
                                class="" 
                                :class="textColor[brand]"
                />
                <h4 class="tw-text-3xl md:tw-text-5xl tw-my-1 tw-font-bold">{{ metric.value }}</h4> 
                <h6 class="tw-text-xs md:tw-text-sm xl:tw-text-base tw-font-bebas-neue tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-px-5">{{ metric.label }}</h6>
            </a> 
        </div>
    </section>
</template>