<template>
    <!--  Instructor Thumbnail  -->
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
        <a class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white">
            <img class="tw-rounded-full tw-w-20 tw-h-20 tw-border-2 tw-border-white tw-border-solid tw-mr-[10px]" src="https://d1923uyy6spedc.cloudfront.net/2022-04-18-HEADSHOTS-Brandon-Toews-101-1-1650867796.jpeg" alt="Instructor Image" />
            <div>
                <h3 class="tw-font-bold">Gene Hoglan</h3>
                <div class="tw-font-semibold">11 Workouts</div>
            </div>
        </a>
        <a class="tw-text-[#00101D] dark:tw-text-white tw-uppercase tw-font-bebas-neue xl:tw-text-lg hover:tw-underline" style="text-underline-offset: 6px;">
            See All
        </a>
    </div>

    <div>
        <transition appear name="fade">
            <CatalogueCardContainer :pre-loaded-content="preLoadedContent" />
        </transition>
    </div>
</template>

<script setup>
import CatalogueCardContainer from "../Catalogue/CatalogueCardContainer";

const props = defineProps({
    preLoadedContent: {
        type: [Array, Object],
        default: () => [],
    },
})
</script>
