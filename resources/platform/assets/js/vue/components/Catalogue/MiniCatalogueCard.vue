<template>
    <div
        class="tw-group tw-flex tw-items-center tw-py-[4px] tw-h-[78px] tw-relative tw-w-[365px] lg:tw-w-auto tw-shrink-0">
        <!-- Thumbnail Image -->
        <a :href="renderLink  && !forceNoLinks ? item.url : null"
            class="tw-flex-none tw-h-[70px] tw-w-[121px] tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#0E2031] tw-rounded-[5px]">
            <div
                class="tw-rounded-[5px] tw-absolute tw-flex tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-h-[70px] tw-w-[121px] tw-justify-center tw-items-center tw-text-white tw-text-center tw-z-[50]">
                <i class="fas" :class="thumbnailIcon"></i>
                <p v-if="!isReleased" class="tw-text-sm tw-text-white tw-font-bold">
                    {{ releaseDate }}
                </p>
            </div>
            <img :src="mappedData.thumbnail"
                :alt="`${mappedData.color_title} thumbnail`"
                class="tw-transition-opacity tw-h-[70px] tw-w-[121px] tw-rounded-[5px] tw-opacity-0"
                :class="item.type === 'song' ? 'tw-blur-sm' : ''"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            >
            <div v-if="item.type === 'song'"
                class="tw-absolute tw-h-[70px] tw-w-[121px] tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center tw-rounded-[5px]">
                <img class="tw-h-full tw-object-cover" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
            </div>
        </a>

        <!-- Instructor Name and Title -->
        <a :href="renderLink  && !forceNoLinks ? item.url : null"
            class="tw-flex tw-flex-col tw-justify-center tw-flex-grow tw-ml-[10px] tw-font-open-sans tw-h-[70px] tw-overflow-hidden">
            <!-- Instructor Name -->
            <div
                class="tw-font-semibold tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-[10px] tw-uppercase tw-truncate tw-leading-[15px]">
                {{ mappedData.color_title }}
            </div>
            <!-- Title -->
            <div
                class="tw-text-[#00101D] dark:tw-text-white tw-text-[12px] tw-line-clamp-2 tw-font-[700] tw-leading-[18px]">
                {{ mappedData.black_title }}
            </div>
        </a>

        <!-- Action Button -->
        <div class="tw-inline-flex tw-items-start tw-p-1 tw-relative"
            v-click-outside="() => { state.dropdownOpen = false }">
            <button :id="`${item.id}-action-btn-small`" v-if="item.type !== 'pack-bundle' && showMyListAction"
                class="tw-flex-none tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#00101D] dark:tw-text-white"
                :class="is_added ? 'is-added' + `tw-text-${brand}` : 'tw-text-[#00101D] dark:tw-text-white'" title="More"
                :data-content-id="item.id" :data-content-type="item.type"
                @click.prevent="handleShowDropdown(`${item.id}-action-btn-small`)">
                <DotsHorizontalIcon class="tw-h-[24px] tw-w-[24px]" />
            </button>
            <Dropdown v-if="showDropdown" :brand="brand" :item="item" :is-open="state.dropdownOpen"
                :dropdownOptions="dropdownOptions" @closeDropdown="state.dropdownOpen = false"
                :position="state.dropdownPosition"
                @addToList="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })"
                @progressReset="$emit('progressReset', { content_id: item.id })" />
        </div>
    </div>
</template>
<script setup>
import { computed, onUnmounted, reactive, onMounted } from 'vue';
import { DotsHorizontalIcon } from '@heroicons/vue/outline';
import useCatalogueItem from '../../hooks/useCatalogueItem.js';
import Dropdown from './Dropdown';
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
    showDropdown: {
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

const state = reactive({
    dropdownOpen: false,
    dropdownPosition: {
        top: 0,
        left: 0,
        opacity: 0,
    }
});

//-----------Static Data-----------//
const dropdownOptions = [
    {
        name: "Add to Playlist",
        action: "addToList"
    },
    {
        name: "Reset Progress",
        action: "progressReset"
    },
]

const handleShowDropdown = (className) => {
    const { top, left } = document.getElementById(className).getBoundingClientRect();
    const { innerHeight, innerWidth } = window;

    state.dropdownOpen = !state.dropdownOpen;

    //opacity 0 to avoid flicker
    state.dropdownPosition = { ...state.dropdownPosition, opacity: 0 }

    //wait for element to appear on screen
    window.setTimeout(() => {
        const { width, height } = document.getElementById('catalogue-card-dropdown-div').getBoundingClientRect();

        state.dropdownPosition = {
            top: (top + height + 30) < innerHeight ? top + 30 : top - height,
            left: (left + width) < innerWidth ? left : left - width + 26,
            opacity: 1,
        };
    }, 0)
};

const mappedData = computed(() => {
    let difficultyValue = 0; //default
    if(contentModel.value.post.fields) {
        difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty')?.value || 0;
    }

    contentModel.value.card.difficulty = difficultyValue;

    return contentModel.value.card
});

const is_added = computed(() => props.item.is_added_to_primary_playlist);

const closeDropdownOnScroll = () => {
    if (state.dropdownOpen) {
        state.dropdownOpen = false;
    }
};

onMounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer.addEventListener('scroll', closeDropdownOnScroll);
});

onUnmounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer.removeEventListener('scroll', closeDropdownOnScroll);
});

const emit = defineEmits(['addToList', 'progressReset']);

</script>
