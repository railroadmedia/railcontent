<template>
    <div class="tw-flex tw-flex-col lg:tw-flex-row tw-bg-white dark:tw-bg-[#002039] tw-w-full tw-h-[158px] lg:tw-h-[188px] tw-rounded-[10px] tw-overflow-hidden tw-justify-center lg:tw-justify-start">
        <div :class="isSidebarCollapsed ? 'tw-w-[240px] xl:tw-w-[280px]' : 'tw-w-[188px] xl:tw-w-[240px] 2xl:tw-w-[280px]'"class="tw-hidden lg:tw-flex tw-shrink-0 tw-relative tw-overflow-hidden">
            <div :class="isSidebarCollapsed ? 'lg:tw-pr-[60px] xl:tw-pr-[80px]' : 'lg:tw-pr-[50px] xl:tw-pr-[60px] 2xl:tw-pr-[80px]'" class="tw-bg-[linear-gradient(270deg,_#F4F4F5_0%,_#FFFFFF_100%)] dark:tw-bg-[linear-gradient(270deg,_#081825_0%,_#002039_100%)] tw-absolute -tw-top-[94px] tw-right-0 tw-flex tw-justify-end tw-items-center tw-w-[376px] tw-h-[376px] tw-rounded-r-[376px]">
                <NewMusoraIcon :brand="brand" :variant="variant"
                    :svgClass="isSidebarCollapsed ? 'tw-w-[80px] tw-h-[80px] xl:tw-w-[120px] xl:tw-h-[120px]' : 'tw-w-[50px] tw-h-[50px] lg:tw-w-[80px] lg:tw-h-[80px] xl:tw-w-[120px] xl:tw-h-[120px]'" />
            </div>
        </div>
        <div class="lg:tw-hidden tw-w-full tw-flex tw-justify-center tw-items-center tw-pb-[10px]">
            <NewMusoraIcon :brand="brand" :variant="variant"
                svgClass="tw-w-[50px] tw-h-[50px]" />
        </div>
        <div :class="isSidebarCollapsed ? 'lg:tw-pl-[50px] 2xl:tw-pl-[60px]' : 'lg:tw-pl-[30px] 2xl:tw-pl-[60px]'" class="tw-flex tw-flex-col tw-justify-center tw-font-bebas-neue tw-w-full tw-items-center lg:tw-items-start">
            <div :class="isSidebarCollapsed ? 'tw-text-[40px] lg:tw-text-[60px] tw-leading-[40px] lg:tw-leading-[72px]' : 'tw-text-[40px] xl:tw-text-[60px] tw-leading-[40px] xl:tw-leading-[72px]'">{{ topText }}</div>
            <div :class="isSidebarCollapsed ? 'tw-text-[15px] lg:tw-text-[30px] tw-leading-[18px] lg:tw-leading-[36px]' : 'tw-text-[15px] xl:tw-text-[30px] tw-leading-[18px] xl:tw-leading-[36px]'">{{ bottomText }}</div>
        </div>
    </div>
</template>

<script setup>
import NewMusoraIcon from '@collections/NewMusoraIcon/NewMusoraIcon.vue';
import { useUserStore } from "@stores/user";
import { usePageContainerStore } from '@stores/pageContainer';
import { storeToRefs } from "pinia/dist/pinia";

const pageContainerStore = usePageContainerStore();

const props = defineProps({
    topText: {
        type: String,
        required: true
    },
    bottomText: {
        type: String,
        required: true
    },
    variant: {
        type: String,
        required: true
    },
    brand: {
        type: String,
        required: true
    }
});


const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const { isSidebarCollapsed } = storeToRefs(pageContainerStore);
</script>
