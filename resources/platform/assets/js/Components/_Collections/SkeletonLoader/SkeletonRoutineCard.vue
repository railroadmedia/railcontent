<template>
    <div class="tw-animate-pulse tw-flex tw-flex-col pa-1 tw-border-box tw-w-full tw-mb-4 md:tw-mb-0">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full">
            <!-- Thumbnail -->
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-lg tw-w-full tw-aspect-square tw-relative md:tw-h-[280px] md:tw-w-[280px] tw-mb-4 md:tw-mb-0 tw-flex-shrink-0"></div>

            <div class="tw-flex tw-justify-between tw-w-full">
                <!-- Card Info -->
                <div class="tw-w-full tw-flex tw-flex-col tw-px-4 tw-justify-center">
                    <!-- Title -->
                    <h2 class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-h-7 tw-w-[350px]"></h2>
                    <!-- Description -->
                    <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-h-5 tw-w-full xl:tw-w-[600px] tw-mb-4 tw-mt-3"></div>

                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-flex-wrap">
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-full md:tw-w-32 tw-h-[35px] md:tw-h-10 tw-mb-4 md:tw-mb-2 md:tw-mr-4"></div>
                        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-full md:tw-w-32 tw-h-[35px] md:tw-h-10 md:tw-mb-2"></div>
                    </div>
                </div>
                <!-- Add to Playlist -->
                <div class="tw-inline-flex md:tw-items-center tw-p-1">
                    <button class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-h-8 tw-w-8"></button>
                </div>
            </div>

        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import useCatalogueItem from "@hooks/useCatalogueItem";

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
    brand: {
        type: String,
        default: () => 'drumeo',
    },
    userId: {
        type: String,
        default: () => '',
    },
    contentTypeOverride: {
        type: String,
        default: '',
    },
    forceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    lockUnowned: {
        type: Boolean,
        default: () => false,
    },
    resetProgress: {
        type: Boolean,
        default: () => false,
    },
    overview: {
        type: Boolean,
        default: () => false,
    },
    index: {
        type: [Number, String],
        default: () => '',
    },
    active: {
        type: Boolean,
        default: () => false,
    },
    displayUserInteractions: {
        type: Boolean,
        default: () => true,
    },
    showNumbers: {
        type: Boolean,
        default: () => false,
    },
    noLink: {
        type: Boolean,
        default: () => false,
    },
    is_search: {
        type: Boolean,
        default: false,
    },
    destroyOnListRemoval: {
        type: Boolean,
        default: () => false,
    },
    compactLayout: {
        type: Boolean,
        default: () => false,
    },
})

const emit = defineEmits(['showRoutineSoundSlice']);

const {
    contentModel,
} = useCatalogueItem(props);

const mappedData = computed(() => {
    return contentModel.value.card;
})

const showRoutineSoundSlice = (type) => {
    let soundSliceSlug = contentModel.value[`${type}_soundslice_slug`];

    emit('showRoutineSoundSlice', { soundSliceSlug, title: contentModel.value.title, routineId: contentModel.value.id });
}
</script>
