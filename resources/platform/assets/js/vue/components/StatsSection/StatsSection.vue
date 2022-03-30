<script>
import { textColor, bgColor, bgBottomGradients } from '../../../constants/brands.js'
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
        data: {
            type: Array,
            default: [],
        },
    },
    setup() {
        return {
            textColor,
            bgColor,
            bgBottomGradients
        }
    },
}
</script>

<template>

    <section class="tw-flex tw-flex-col tw-mb-6 md:tw-mb-12 tw-text-[#00101D] dark:tw-text-white tw-w-full">

            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-5 tw-w-full tw-justify-between">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">My Stats</h2>
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   aria-label="See My Dashboard" 
                   class="tw-p-3 tw-pb-2 tw-rounded-full tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-[#102230] dark:focus:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] focus:tw-bg-[#F5F5F6]"
                >
                    Dashboard
                </a>
            </div> 

            <!-- Method Progress -->
            <div class="tw-flex tw-flex-wrap tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] tw-px-14 tw-bg-gradient-to-b" :class="bgBottomGradients[brand]">
                <div class="tw-flex tw-w-1/2 tw-items-center tw-px-8 tw-shrink-0">
                    <img :src="`https://musora-ui.s3.amazonaws.com/logos/${brand}-method.svg`" :alt="brand" class="tw-max-w-[567px] tw-w-full" />
                </div> 
                <div class="tw-flex tw-flex-col tw-w-1/2 tw-items-end tw-px-8">
                    <div class="tw-text-center">
                        <h3 class="text-white tw-text-[54px] tw-font-bold tw-uppercase">Level 2.3</h3> 
                        <!-- progress bar -->
                        <div class="tw-bg-white tw-relative tw-w-full tw-max-w-[260px] tw-h-[26px] tw-rounded-full tw-border-white tw-border-[3px]">
                            <div class="tw-absolute tw-h-full tw-rounded-full tw-top-0 tw-left-0" :class="bgColor[brand]" style="width: 15%;">
                                <span class="tw-absolute tw-top-0 tw-h-full tw-font-bold tw-translate-x-full tw-text-sm tw-right-[-5px]" :class="textColor[brand]">15%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- More Stats -->
            <div class="tw-grid tw-gap-4 tw-grid-cols-4 tw-w-full">
                <!-- XP Level -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]">
                    <i class="icon-experience-points tw-text-3xl" :class="textColor[brand]"></i> 
                    <h4 class="tw-text-5xl tw-my-1 tw-font-bold">18.8K</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase nowrap">Pro III</h6>
                </a> 
                <!-- Forum Post Likes -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]">
                    <i class="fa fa-comments tw-text-3xl" :class="textColor[brand]"></i> 
                    <h4 class="tw-text-5xl tw-my-1 tw-font-bold">0</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap">Forum Post Likes</h6>
                </a> 
                <!-- Comment Likes -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]">
                    <i class="icon-comments-liked tw-text-3xl" :class="textColor[brand]"></i> 
                    <h4 class="tw-text-5xl tw-my-1 tw-font-bold">0</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap">Comment Likes</h6>
                </a> 
                <!-- Minutes Practiced -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]">
                    <i class="icon-minutes-practiced tw-text-3xl" :class="textColor[brand]"></i> 
                    <h4 class="tw-text-5xl tw-my-1 tw-font-bold">1</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap">Minutes Practiced</h6>
                </a>
            </div>
    </section>
</template>