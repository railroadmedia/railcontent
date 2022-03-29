<script>
import { textColor, bgColor } from '../../../constants/brands.js'
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
            bgColor
        }
    },
}
</script>

<template>

    <section class="tw-flex tw-flex-col tw-mb-6 md:tw-mb-8 tw-text-[#00101D] dark:tw-text-white tw-w-full">

            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">My Stats</h2>
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   aria-label="See My Dashboard" 
                   class="tw-uppercase tw-font-bebas-neue tw-tracking-wide"
                >
                    Dashboard
                </a>
            </div> 

            <!-- Method Progress -->
            <div class="tw-flex tw-flex-wrap tw-items-center tw-w-full tw-rounded-full tw-min-h-[89px]" :class="bgColor[brand]">
                <div class="tw-flex tw-w-1/2 tw-items-center tw-px-8 tw-justify-center">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/pack-logos/drumeo-method-logo.png" class="tw-max-w-[300px]" alt="The drumeo Method Logo">
                </div> 
                <div class="tw-flex tw-flex-col tw-w-1/2 tw-items-center tw-px-8">
                    <h3 class="text-white tw-text-4xl tw-font-bold tw-uppercase">Level 2.3</h3> 
                    <div class="progress-bar bg-white ba-white-3 relative">
                        <div class="progress bg-drumeo" style="width: 15%;">
                            <span class="amount text-white tiny font-bold text-drumeo right">15%</span>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- More Stats -->
            <div class="tw-mt-4 tw-grid tw-gap-8 tw-grid-cols-4 tw-w-full">
                <!-- XP Level -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[108px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center">
                    <i class="icon-experience-points text-drumeo text-center nowrap mb-1" style="line-height: 32px;"></i> 
                    <h4 class="large-display text-black text-center tw-nowrap tw-text-4xl" style="line-height: 0.8em;">18.8K</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase nowrap" style="line-height: 32px;">Pro III</h6>
                </a> 
                <!-- Forum Post Likes -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[108px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center">
                    <i class="fa fa-comments text-drumeo text-center nowrap mb-1" style="line-height: 32px;"></i> 
                    <h4 class="large-display text-black text-center nowrap tw-text-4xl" style="line-height: 0.8em;">0</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap" style="line-height: 32px;">Forum Post Likes</h6>
                </a> 
                <!-- Comment Likes -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[108px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center">
                    <i class="icon-comments-liked text-drumeo text-center nowrap mb-1" style="line-height: 32px;"></i> 
                    <h4 class="large-display text-black text-center nowrap tw-text-4xl" style="line-height: 0.8em;">0</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap" style="line-height: 32px;">Comment Likes</h6>
                </a> 
                <!-- Minutes Practiced -->
                <a href="https://www.drumeo.com/laravel/public/members/profile" 
                   class="tw-inline-flex tw-min-h-[108px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center">
                    <i class="icon-minutes-practiced text-drumeo text-center nowrap mb-1" style="line-height: 32px;"></i> 
                    <h4 class="large-display text-black text-center tw-nowrap tw-text-4xl" style="line-height: 0.8em;">1</h4> 
                    <h6 class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-nowrap" style="line-height: 32px;">Minutes Practiced</h6>
                </a>
            </div>
    </section>
</template>