<template>
    <div
        class="tw-flex tw-flex-col tw-gap-[10px] tw-justify-center tw-p-[10px] sm:tw-px-[17px] tw-h-[107px] tw-relative tw-w-[310px] lg:tw-w-auto tw-shrink-0 tw-border-[1px] tw-border-[#CBCBCD80] hover:tw-shadow-[0_4px_4px_0px_rgba(0,0,0,0.1)] dark:tw-border-none tw-bg-white dark:tw-bg-[#0020398C] hover:tw-bg-[rgba(255,255,255,0.8)] dark:hover:tw-bg-[#002039] tw-rounded-[10px]">
        <div v-if="!isCurrentSeeAllCard" class="tw-group tw-flex tw-items-center">
            <!-- Thumbnail Image -->
            <a @click="handleClick" :href="renderLink && !forceNoLinks ? item.url : null"
                class="tw-flex-none tw-h-[72px] tw-w-[130px] tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#0E2031] tw-rounded-[5px]">
                <div v-if="noAccess"
                    class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-[rgba(0,12,23,0.85)] tw-z-20 tw-flex tw-justify-center tw-items-center">
                    <musora-icon class="tw-w-[30px]" icon-name="lock-icon"></musora-icon>
                </div>
                <div v-else
                    class="tw-rounded-[5px] tw-absolute tw-flex tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-h-[58px] sm:tw-h-[78px] tw-w-[109px] sm:tw-w-[144px] tw-justify-center tw-items-center tw-text-white tw-text-center tw-z-[50]">
                    <i class="fas" :class="thumbnailIcon"></i>
                    <p v-if="!isReleased" class="tw-text-[12px] tw-text-white tw-font-bold">
                        {{ releaseDate }}
                    </p>
                </div>
                <img :src="mappedData.thumbnail" :alt="`${mappedData.color_title} thumbnail`"
                    class="tw-transition-opacity tw-h-[72px] tw-w-[130px] tw-rounded-[5px] tw-opacity-0"
                    :class="item.type === 'song' ? 'tw-blur-sm' : ''" loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')">
                <div v-if="item.type === 'song'"
                    class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center tw-items-center">
                    <img class="tw-h-[70px]" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
                </div>
                <div v-if="false" class="tw-absolute tw-right-1 tw-bottom-1 tw-p-1 tw-bg-black/70 tw-text-[12px] tw-rounded-[6px]">
                    {{ contentTypeString }}
                </div>
            </a>

            <!-- Instructor Name and Title -->
            <a @click="handleClick" :href="renderLink && !forceNoLinks ? item.url : null"
                class="tw-flex tw-flex-col tw-justify-between tw-flex-grow tw-ml-[10px] tw-font-open-sans tw-h-[72px] tw-max-h-[72px] tw-overflow-hidden tw-h-full">
                <div>
                    <!-- Title -->
                    <div
                        class="tw-text-[#00101D] dark:tw-text-white tw-text-[12px] tw-line-clamp-2 tw-font-[700] tw-leading-[12px]">
                        {{ mappedData.black_title }}
                    </div>
                    <!-- Instructor Name -->
                    <div
                        class="tw-font-semibold tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-[12px] tw-uppercase tw-truncate tw-leading-[12px] tw-pt-[5px]">
                        {{ contentCreator }}
                    </div>
                </div>
                <p
                    class="tw-flex tw-items-center tw-flex-wrap tw-text-[10px] tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC] tw-truncate">
                    <!-- Difficulty Label -->
                    <span v-if="mappedData.difficulty" class="tw-flex tw-items-center">
                        <DifficultyLabel :hideDot="true" class="tw-text-[10px]" :difficultyValue="mappedData.difficulty"
                            textCase="capitalize" />
                            <span class="tw-mx-1 tw-text-base tw-leading-none">·</span>
                        <span class="tw-overflow-hidden tw-line-clamp-1">
                            {{ contentTypeString }}
                        </span>
                    </span>
                </p>
            </a>

            <!-- Action Button -->
            <div
                class="tw-flex tw-flex-col tw-justify-start sm:tw-justify-between tw-pl-[5px] tw-relative tw-h-[58px] sm:tw-h-[78px]">
                <button class="sm:tw-hidden" @click="toggleDropdown">
                    <svg class="" width="21" height="21" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                </button>
                <ul v-if="showDropdown"
                    class="tw-absolute tw-top-2 tw-right-0 tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-right-0 tw-z-50 sm:tw-hidden tw-text-[12px]"
                    v-click-outside="closeDropdown">
                    <li>
                        <button
                            class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap"
                            @click="addToList">
                            <PlusIcon class="tw-h-[10px] tw-w-[10px] dark:tw-text-white tw-mr-2" /> Add
                        </button>
                    </li>
                    <li>
                        <button
                            class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap"
                            @click="resetProgress">
                            <svg class="tw-mr-2" width="10" height="10" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.5857 0.571415C1.5857 0.287379 1.35543 0.0571289 1.07141 0.0571289C0.787402 0.0571289 0.557129 0.287379 0.557129 0.571415V4.32142C0.557129 4.60544 0.787402 4.8357 1.07141 4.8357H4.82139C5.10547 4.8357 5.33568 4.60544 5.33568 4.32142C5.33568 4.03738 5.10547 3.80713 4.82139 3.80713H2.4061C3.39857 2.17547 5.19348 1.0857 7.24284 1.0857C10.3672 1.0857 12.9 3.61849 12.9 6.74284C12.9 9.8672 10.3672 12.4 7.24284 12.4C5.16159 12.4 3.34282 11.2761 2.36039 9.60204C2.25844 9.42831 2.07582 9.31427 1.87436 9.31427C1.49153 9.31427 1.23458 9.70367 1.42348 10.0366C2.57234 12.062 4.748 13.4286 7.24284 13.4286C10.9353 13.4286 13.9286 10.4353 13.9286 6.74284C13.9286 3.05042 10.9353 0.0571289 7.24284 0.0571289C4.86088 0.0571289 2.7699 1.30277 1.5857 3.17816V0.571415Z"
                                    fill="currentColor" />
                            </svg> Reset
                        </button>
                    </li>
                </ul>


                <button @click="addToList" class="tw-hidden sm:tw-block">
                    <PlusIcon class="tw-h-[18px] tw-w-[18px] dark:tw-text-white" />
                </button>
                <button
                    class="tw-h-[18px] tw-w-[18px] tw-flex tw-items-center tw-justify-center tw-text-center dark:tw-text-white tw-hidden sm:tw-block"
                    @click="resetProgress">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.5857 0.571415C1.5857 0.287379 1.35543 0.0571289 1.07141 0.0571289C0.787402 0.0571289 0.557129 0.287379 0.557129 0.571415V4.32142C0.557129 4.60544 0.787402 4.8357 1.07141 4.8357H4.82139C5.10547 4.8357 5.33568 4.60544 5.33568 4.32142C5.33568 4.03738 5.10547 3.80713 4.82139 3.80713H2.4061C3.39857 2.17547 5.19348 1.0857 7.24284 1.0857C10.3672 1.0857 12.9 3.61849 12.9 6.74284C12.9 9.8672 10.3672 12.4 7.24284 12.4C5.16159 12.4 3.34282 11.2761 2.36039 9.60204C2.25844 9.42831 2.07582 9.31427 1.87436 9.31427C1.49153 9.31427 1.23458 9.70367 1.42348 10.0366C2.57234 12.062 4.748 13.4286 7.24284 13.4286C10.9353 13.4286 13.9286 10.4353 13.9286 6.74284C13.9286 3.05042 10.9353 0.0571289 7.24284 0.0571289C4.86088 0.0571289 2.7699 1.30277 1.5857 3.17816V0.571415Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>
        </div>
        <ProgressBar v-if="showProgressBar" :progress="progress_percent" />
        <a class="tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center" v-if="isCurrentSeeAllCard">
            <div
                class="tw-flex tw-text-[10px] tw-leading-[10px] tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-w-full tw-text-center tw-justify-center">
                <div>See All</div>
                <ChevronRightIcon class="tw-h-[24px] tw-w-[24px]" />
            </div>
        </a>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue';
import { PlusIcon, ChevronRightIcon } from '@heroicons/vue/outline';
import useCatalogueItem from '@hooks/useCatalogueItem.js';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';
import userJourney from '@services/userJourney';
import { usePlatformStore } from "../../../Stores/platform";
import { contentTypes } from "../../../utils";
import ProgressBar from './ProgressBar.vue';
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';


//Pinia Stores
const platformStore = usePlatformStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    index: {
        type: Number,
        default: 0
    },
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
    trackingSection: {
        type: String,
        default: '',
    },
    showSeeAllCard: {
        type: Boolean,
        default: false,
    },
});

const {
    contentModel,
    thumbnailIcon,
    renderLink,
    isReleased,
    releaseDate,
    noAccess,
    progress_percent,
} = useCatalogueItem({ ...props, brand: brand.value });

const showDropdown = ref(false);

const mappedData = computed(() => {
    let difficultyValue = 0; //default
    if (contentModel.value.post.fields) {
        difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty')?.value || 0;
    }

    contentModel.value.card.difficulty = difficultyValue;

    return contentModel.value.card
});

const isSongContent = computed(() => {
    return contentModel.value.post.type === 'song'
})

const contentCreator = computed(() => {
    if (contentModel.value.post.fields) {
        if (isSongContent.value) {
            return contentModel.value.post.fields.find(field => field.key === 'artist')?.value || brand.value
        }
        return contentModel.value.post.fields.find(field => field.key === 'instructor')?.value.name || brand.value
    }
    return '';

})

const contentTypeString = computed(() => {
    if (contentModel.value?.post?.type && contentTypes[contentModel.value.post.type]?.singular) {
        return contentTypes[contentModel.value.post.type].singular
    }
    return '';
})

const isCurrentSeeAllCard = computed(() => {
    return props.showSeeAllCard && props.index === 5;
})

const showProgressBar = computed(() => {
    return !isCurrentSeeAllCard.value
    && !isSongContent.value
    && !noAccess.value
    && !contentModel.value.post.type !== 'play-along'
    && !contentModel.value.post.type !== 'play-along-part';
})

const emit = defineEmits(['addToList', 'progressReset']);

const handleClick = (event) => {
    if (noAccess.value) {
        event.preventDefault();
        platformStore.openMembershipUpgradeModal();
    } else if (renderLink.value && props.trackingSection && props.trackingSection.length) {
        event.preventDefault();

        userJourney.trackHomeContentClick({
            payload: {
                contentId: props.item.id,
                brand: brand.value,
                section: props.trackingSection,
            }
        }).finally(() => {
            window.location.href = props.item.url;
        });
    }
}

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
}

const closeDropdown = () => {
    showDropdown.value = false;
}

const addToList = () => {
    showDropdown.value = false;

    emit('addToList', { content_id: props.item.id, type: props.item.type, name: mappedData.value.black_title, description: mappedData.value.description, thumbnail_url: mappedData.value.thumbnail })
}

const resetProgress = () => {
    showDropdown.value = false;
    emit('progressReset', { content_id: props.item.id });
}
</script>
