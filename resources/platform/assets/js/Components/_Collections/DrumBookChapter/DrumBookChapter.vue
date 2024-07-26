<template>
    <component :is="hasAccess ? 'a' : 'div'" :href="hasAccess && chapter['contentLink']" class="tw-scroll-mt-[68px] tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-py-[10px] tw-border-t tw-border-[#e5e8e8] tw-no-underline tw-transition-all content-table-row tw-cursor-pointer" @click="!hasAccess && emit('openLoginModal')">
        <div class="thumbnail-col book-thumbnail tw-p-[10px]">
            <div class="thumb-wrap tw-rounded-[3px]">
                <div class="thumb-img tw-aspect-[4/3] tw-bg-center"
                     :style="`background-image:url('${chapter['thumbnail']}')`"></div>

                <span class="thumb-hover heading tw-flex tw-justify-center tw-items-center">
                <i :class="`fas ${hasAccess ? 'fa-arrow-circle-right' : 'fa-sign-in'}`"></i>
            </span>
            </div>
        </div>

        <div class="tw-flex tw-grow">
            <div class="tw-flex tw-flex-col tw-justify-center tw-p-[10px]">
                <p class="tw-text-[13px] tw-text-drumeo tw-uppercase">Chapter {{ chapterNumber }} - {{ chapter['chapterTitle'] }}</p>
                <h6 class="body tw-font-bold tw-text-black dark:tw-text-white">{{ chapter['title'] }}</h6>
                <p class="tw-text-[13px] tw-text-black dark:tw-text-white">{{ chapter['description'] }}</p>
            </div>
        </div>

        <div class="tw-w-1/12 tw-hidden sm:tw-flex"></div>

        <template v-if="hasAccess">
            <div class="sm:tw-flex tw-items-center icon-col tw-hidden">
                <i class="fas fa-arrow-circle-right tw-text-[#d1d1d1]"></i>
            </div>
        </template>
        <template v-else>
            <div class="tw-flex tw-items-center tw-px-[10px] lg:tw-px-[15px] login-col">
                <button
                    class="tw-btn-secondary tw-text-[13px] tw-border-[#ccd3d3] tw-text-[#ccd3d3] tw-px-[30px] tw-w-full sm:tw-w-auto"
                    style="white-space:nowrap;"
                    title="Login To Drumeo"
                    data-open-modal="loginModal"
                >
                    <i class="fas fa-sign-in tw-mr-[10px]"></i> Login To Drumeo
                </button>
            </div>
        </template>
    </component>
</template>
<script setup>

const props = defineProps({
    chapter:{
        type: Object,
        default: {}
    },
    chapterNumber: {
        type: Number,
        default: 0,
    },
    hasAccess: {
        type: Boolean,
        default: false
    },
})

const emit = defineEmits(['openLoginModal'])
</script>
