<template>
    <div class="tw-group tw-flex tw-items-center tw-py-[4px] tw-px-[17px] tw-h-[99px] tw-relative tw-w-[377px] lg:tw-w-auto tw-shrink-0 tw-border-[1px] tw-border-[#CBCBCD80] hover:tw-shadow-[0_4px_4px_0px_rgba(0,0,0,0.1)] dark:tw-border-none tw-bg-white dark:tw-bg-[#0020398C] hover:tw-bg-[rgba(255,255,255,0.8)] dark:hover:tw-bg-[#002039] tw-rounded-[10px]">
        <!-- Thumbnail Image -->
        <a :href="renderLink && !forceNoLinks ? item.url : null"
            class="tw-flex-none tw-h-[78px] tw-w-[144px] tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#0E2031] tw-rounded-[5px]">
            <div
                class="tw-rounded-[5px] tw-absolute tw-flex tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-h-[78px] tw-w-[144px] tw-justify-center tw-items-center tw-text-white tw-text-center tw-z-[50]">
                <i class="fas" :class="thumbnailIcon"></i>
                <p v-if="!isReleased" class="tw-text-sm tw-text-white tw-font-bold">
                    {{ releaseDate }}
                </p>
            </div>
            <img :src="mappedData.thumbnail" :alt="`${mappedData.color_title} thumbnail`"
                class="tw-transition-opacity tw-h-[78px] tw-w-[144px] tw-rounded-[5px] tw-opacity-0"
                :class="item.type === 'song' ? 'tw-blur-sm' : ''" loading="lazy"
                onload="this.classList.remove('tw-opacity-0')">
            <div v-if="item.type === 'song'"
                class="tw-absolute tw-h-[70px] tw-w-[121px] tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center tw-rounded-[5px]">
                <img class="tw-h-full tw-object-cover" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
            </div>
        </a>

        <!-- Instructor Name and Title -->
        <a :href="renderLink && !forceNoLinks ? item.url : null"
            class="tw-flex tw-flex-col tw-justify-start tw-flex-grow tw-ml-[9px] tw-font-open-sans tw-h-[78px] tw-overflow-hidden">
            <!-- Title -->
            <div
                class="tw-text-[#00101D] dark:tw-text-white tw-text-[14px] tw-line-clamp-2 tw-font-[700] tw-leading-[21px]">
                {{ mappedData.black_title }}
            </div>
            <!-- Instructor Name -->
            <div
                class="tw-font-semibold tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-[12px] tw-uppercase tw-truncate tw-leading-[18px] tw-pt-[5px]">
                {{ mappedData.color_title }}
            </div>
        </a>

        <!-- Action Button -->
        <div class="tw-flex tw-flex-col tw-justify-between tw-pl-[5px] tw-relative tw-h-[78px]">
            <button @click="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })">
                <PlusIcon class="tw-h-[18px] tw-w-[18px] dark:tw-text-white" />
            </button>
            <button class="tw-h-[18px] tw-w-[18px] tw-flex tw-items-center tw-justify-center tw-text-center dark:tw-text-white" @click="$emit('progressReset', { content_id: item.id })">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5857 0.571415C1.5857 0.287379 1.35543 0.0571289 1.07141 0.0571289C0.787402 0.0571289 0.557129 0.287379 0.557129 0.571415V4.32142C0.557129 4.60544 0.787402 4.8357 1.07141 4.8357H4.82139C5.10547 4.8357 5.33568 4.60544 5.33568 4.32142C5.33568 4.03738 5.10547 3.80713 4.82139 3.80713H2.4061C3.39857 2.17547 5.19348 1.0857 7.24284 1.0857C10.3672 1.0857 12.9 3.61849 12.9 6.74284C12.9 9.8672 10.3672 12.4 7.24284 12.4C5.16159 12.4 3.34282 11.2761 2.36039 9.60204C2.25844 9.42831 2.07582 9.31427 1.87436 9.31427C1.49153 9.31427 1.23458 9.70367 1.42348 10.0366C2.57234 12.062 4.748 13.4286 7.24284 13.4286C10.9353 13.4286 13.9286 10.4353 13.9286 6.74284C13.9286 3.05042 10.9353 0.0571289 7.24284 0.0571289C4.86088 0.0571289 2.7699 1.30277 1.5857 3.17816V0.571415Z" fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue';
import { PlusIcon } from '@heroicons/vue/outline';
import useCatalogueItem from '../../hooks/useCatalogueItem.js';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

//Pinia Stores
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);


const props = defineProps({
    item: {
        type: Object,
        default: () => ({}), // Default empty object
    },
    contentType: {
        type: String,
        default: '' // Default empty string
    },
    userId: {
        type: String,
        default: ''
    },
    isAdmin: {
        type: Boolean,
        default: false
    },
    lockUnowned: {
        type: Boolean,
        default: false
    },
    contentTypeOverride: {
        type: String,
        default: ''
    },
    showMyListAction: {
        type: Boolean,
        default: false
    },
    forceNoLinks: {
        type: Boolean,
        default: false
    },
});

const {
    contentModel,
    thumbnailIcon,
    renderLink,
    isReleased,
    releaseDate,
} = useCatalogueItem({ ...props, brand: brand.value });

const mappedData = computed(() => {
    let difficultyValue = 0; //default
    if (contentModel.value.post.fields) {
        difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty')?.value || 0;
    }

    contentModel.value.card.difficulty = difficultyValue;

    return contentModel.value.card
});

const is_added = computed(() => props.item.is_added_to_primary_playlist);

const emit = defineEmits(['addToList', 'progressReset']);

</script>
