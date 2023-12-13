<template>
    <!--  Instructor Thumbnail  -->
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
        <a class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white">
            <img class="tw-rounded-full tw-w-20 tw-h-20 tw-border-2 tw-border-white tw-border-solid tw-mr-[10px]" :src="`https://www.musora.com/musora-cdn/image/width=200/${item.head_shot_picture_url}`" :alt="`${item.name} Image`" />
            <div>
                <h3 class="tw-font-bold">{{ item.name }}</h3>
                <div class="tw-font-semibold">{{ item.lessons.length }} Workouts</div>
            </div>
        </a>
        <a class="tw-text-[#00101D] dark:tw-text-white tw-uppercase tw-font-bebas-neue xl:tw-text-lg hover:tw-underline" style="text-underline-offset: 6px;">
            See All
        </a>
    </div>

    <div>
        <transition appear name="fade">
            <CatalogueCardContainer :pre-loaded-content="item.lessons" />
        </transition>
    </div>
</template>

<script setup>
import CatalogueCardContainer from "../Catalogue/CatalogueCardContainer";

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
})
</script>
