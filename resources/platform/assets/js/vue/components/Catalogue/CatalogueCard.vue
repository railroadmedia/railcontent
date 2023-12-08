<template>
    <!-- 
        - Cards can be mini with the 'isMiniCard' for continue section
        - Cards can be inline with the 'displayInline' prop for the Related Lessons sections
        - Cards can break to list view in mobile with the 'breakToListView' prop for large catalogs
    -->
    <div v-if="!isMiniCard"
        class="tw-snap-center tw-flex tw-flex-col tw-group"
        :class="[
            class_object, 
            displayInline || breakToListView ? 'tw-py-3 tw-w-full' : 'tw-w-[267px] lg:tw-w-1/4 2xl:tw-w-1/5 4xl:tw-w-1/6 tw-shrink-0 lg:tw-mb-6 tw-pr-[8px] xl:tw-pr-[12px] 3xl:tw-pr-[18px]',
            { 'tw-py-3 tw-w-full lg:tw-py-0 lg:tw-w-1/4 2xl:tw-w-1/5 4xl:tw-w-1/6 lg:tw-mb-6 lg:tw-pr-[8px] xl:tw-pr-[12px] 3xl:tw-pr-[18px]' : breakToListView }
        ]">
        <div class="tw-flex" :class="[
            displayInline || breakToListView ? 'tw-flex-row' : 'tw-flex-col',
            { 'lg:tw-flex-col' : breakToListView }
        ]">
            <!-- Thumbnail Section -->
            <a :href="renderLink ? item.url : null" class="tw-no-underline tw-flex tw-flex-col" :class="[
                { 'tw-w-[142px] tw-mr-3': displayInline || breakToListView },
                { 'lg:tw-w-full lg:tw-mr-0': breakToListView },
                item.type === 'song' && displayInline ? 'tw-max-w-[121px]' : '',
                item.type + '-thumbnail'
            ]">
                <div class="tw-relative tw-overflow-hidden tw-rounded-[10px]" 
                    :class="item.type === 'song' && displayInline ? 'tw-aspect-square' : 'tw-aspect-video'"
                >
                    <!-- Video Thumbnail -->
                    <img :src="`https://www.musora.com/musora-cdn/image/width=500/${mappedData.thumbnail} `"
                        class="tw-absolute tw-transition-opacity tw-duration-500tw-opacity-0" :class="[
                            item.type === 'song' ? 'tw-blur-sm' : ''
                        ]" loading="lazy" onload="this.classList.remove('tw-opacity-0')">
                    <!-- Song Overlay -->
                    <div v-if="item.type === 'song'"
                        class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                        <img class="tw-h-full tw-object-cover" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
                    </div>
                    <!-- Workouts Pill -->
                    <div v-if="item.type === 'challenge' && isReleased"
                         class="tw-bg-black/70 tw-absolute tw-leading-none tw-uppercase tw-font-bold tw-bottom-1 tw-right-1 tw-rounded tw-text white tw-text-[10px] tw-p-1">
                        # Workouts
                    </div>
                    <!-- Progress -->
                    <div class="lesson-progress overflow">
                        <span class="progress" :class="`tw-bg-${brand}`" :style="'width:' + progress_percent + '%'"></span>
                    </div>
                    <div v-if="showTrophy" class="bundle-complete tw-justify-center">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <!-- CHALLENGE: Not Released -->
                    <div v-else-if="item.type === 'challenge' && !isReleased && hasProduct"
                         class="tw-bg-black/70 tw-absolute tw-leading-none tw-uppercase tw-font-bold tw-bottom-1 tw-right-1 tw-rounded tw-text white tw-text-[10px] tw-p-1">
                        Upcoming
                    </div>
                    <!-- CHALLENGE: Not Enrolled -->
                    <div v-else-if="item.type === 'challenge' && !isReleased && !hasProduct"
                         class="tw-bg-black/70 tw-absolute tw-leading-none tw-uppercase tw-font-bold tw-bottom-1 tw-right-1 tw-rounded tw-text white tw-text-[10px] tw-p-1">
                        Enroll Now
                    </div>
                    <!-- EVERYTHING ELSE -->
                    <div v-else
                        class="tw-absolute tw-flex tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-w-full tw-h-full tw-justify-center tw-items-center tw-text-white tw-text-center">
                        <i class="fas" :class="thumbnailIcon"></i>
                        <p v-if="!isReleased" class="tw-text-sm text-white font-bold">
                            {{ releaseDate }}
                        </p>
                    </div>
                </div>
            </a>
            <!-- Description Section -->
            <div class="tw-flex tw-w-full">
                <div class="tw-w-full tw-flex tw-flex-wrap lg:tw-block">
                    <a :href="renderLink ? item.url : null"
                        class="card-info tw-flex tw-flex-auto tw-flex-col tw-px-2 tw-rounded-lg"
                        :class="[displayInline || breakToListView ? 'tw-justify-center tw-pt-1' : 'tw-pt-2', { 'lg:tw-pt-2 lg:tw-justify-start' : breakToListView }]">
                        <div class="tw-flex tw-flex-col">
                            <!-- Video Title -->
                            <h4 class="tw-text-sm tw-leading-snug tw-text-[#00101D] font-compressed tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white tw-line-clamp-2"
                                :class="{ 'tw-text-center': isGuitareoChordAndScale }">
                                {{ mappedData.black_title }}
                            </h4>
                            <!-- Video Description -->
                            <p v-if="mappedData.show_description"
                                class="tw-text-xs tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-mb-1 tw-line-clamp-2"
                            >{{  mappedData.description.replace(/<[^>]+>/g, '') }}</p>
                            <!-- Content -->
                            <h6 class="tw-flex tw-items-center tw-flex-wrap tw-text-xs tw-font-normal tw-text-[#3F3F46] tw-uppercase dark:tw-text-[#9EC0DC] tw-mb-0.5"
                                :class="[{ 'tw-text-center': isGuitareoChordAndScale },{ 'tw-order-first lg:tw-order-last' : breakToListView }]">
                                <div v-if="contentCreator && contentCreator !== ''" class="tw-mb-0.5">
                                    <span>{{ contentCreator }}</span>
                                </div>
                            </h6>
                        </div>
                        <p class="tw-flex tw-items-center tw-flex-wrap tw-text-xs tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC]">
                            <!-- Difficulty Label -->
                            <span v-if="mappedData.difficulty" class="tw-flex tw-items-center tw-mb-0.5">
                                <DifficultyLabel class="tw-text-xs" :difficultyValue="mappedData.difficulty"
                                    textCase="capitalize" />
                                    <span class="tw-mx-1 tw-text-base tw-leading-none">·</span>
                            </span>
                            <span class="tw-mb-0.5">
                                {{ contentTypeString }}
                            </span>
                        </p>
                    </a>
                    <!-- CHALLENGE CTA's -->
                    <template v-if="contentType === 'challenge'">
                        <a v-if="!isReleased && !hasProduct" 
                            :href="item.slug" 
                            class="tw-mt-1 tw-inline-flex tw-items-center tw-justify-center tw-uppercase tw-text-sm tw-px-4 tw-leading-none tw-font-bebas-neue tw-h-[36px] tw-rounded-2xl dark:tw-bg-[#0E2031] dark:tw-text-[#F1F1F1] tw-text-[#00101D]"
                        >
                            Enroll Now
                        </a>
                        <button v-if="!isReleased && hasProduct" data-open-modal="notifyModal" class="tw-mt-1 tw-inline-flex tw-items-center tw-justify-center tw-uppercase tw-text-sm tw-px-4 tw-leading-none tw-font-bebas-neue tw-h-[36px] tw-rounded-2xl dark:tw-bg-[#0E2031] dark:tw-text-[#F1F1F1] tw-text-[#00101D]">
                            <musora-icon icon-name="bell" class="tw-w-5 tw-h-5 tw-mr-1"/>
                            Notify Me 
                        </button>
                    </template>
                </div>
                <!-- 
                    Add to Playlist 
                    Don't show if the user has not enrolled in a challenge (does not own Product)
                -->
                <div v-if="item.type !== 'challenge' || hasProduct" class="tw-inline-flex tw-items-start tw-pt-1 tw-px-1 tw-relative">
                    <div class="tw-relative" v-click-outside="() => { state.dropdownOpen = false }">
                        <button :id="`${item.id}-action-btn-big`" v-if="item.type !== 'pack-bundle' && showMyListAction"
                            class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#00101D] dark:tw-text-white"
                            :class="is_added ? 'is-added' + `tw-text-${brand}` : 'tw-text-[#00101D] dark:tw-text-white'"
                            :title="is_added ? 'Remove from Playlist' : 'Add to Playlist'" :data-content-id="item.id"
                            :data-content-type="item.type"
                            @click.prevent="showDropdown ? handleShowDropdown(`${item.id}-action-btn-big`) : $emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })">
                            <DotsHorizontalIcon v-if="showDropdown" class="tw-h-[24px] tw-w-[24px]" />
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>

                        <Dropdown v-if="showDropdown" :brand="brand" :item="item" :is-open="state.dropdownOpen"
                            :dropdownOptions="dropdownOptions" @closeDropdown="state.dropdownOpen = false"
                            :position="state.dropdownPosition"
                            @addToList="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })"
                            @progressReset="emitResetProgress({ content_id: item.id })" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else
        class="tw-group tw-flex tw-items-center tw-py-[4px] tw-h-[78px] tw-relative tw-w-[365px] lg:tw-w-auto tw-shrink-0">
        <!-- Thumbnail Image -->
        <a :href="renderLink ? item.url : null"
            class="tw-flex-none tw-h-[70px] tw-w-[121px] tw-relative tw-overflow-hidden tw-rounded-[5px]">
            <div
                class="tw-rounded-[5px] tw-absolute tw-flex tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-h-[70px] tw-w-[121px] tw-justify-center tw-items-center tw-text-white tw-text-center tw-z-[50]">
                <i class="fas" :class="thumbnailIcon"></i>
                <p v-if="!isReleased" class="tw-text-sm text-white font-bold">
                    {{ releaseDate }}
                </p>
            </div>
            <img :src="mappedData.thumbnail" :alt="`${mappedData.color_title} thumbnail`"
                class="tw-h-[70px] tw-w-[121px] tw-rounded-[5px]" :class="item.type === 'song' ? 'tw-blur-sm' : ''">

            <div v-if="item.type === 'song'"
                class="tw-absolute tw-h-[70px] tw-w-[121px] tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center tw-rounded-[5px]">
                <img class="tw-h-full tw-object-cover" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
            </div>
        </a>

        <!-- Instructor Name and Title -->
        <a :href="renderLink ? item.url : null"
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
                @progressReset="emitResetProgress({ content_id: item.id })" />
        </div>
    </div>
</template>
<script setup>
import { computed, onUnmounted, reactive, onMounted } from 'vue';
import { DotsHorizontalIcon } from '@heroicons/vue/outline';
import useCatalogueItem from '../../hooks/useCatalogueItem.js';
import Dropdown from './Dropdown';
import DifficultyLabel from '../DifficultyLabel/DifficultyLabel';
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';
import { snakeToCapitalized } from "../../utils";
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

//Pinia Stores
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);


const props = defineProps({
    item: {
        type: Object,
        default: () => ({}), // Default empty object
    },
    brand: {
        type: String,
        default: ''
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
    breakToListView: {
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
    displayInline: {
        type: Boolean,
        default: false
    },
    showDropdown: {
        type: Boolean,
        default: false
    },
    isMiniCard: {
        type: Boolean,
        default: false
    },
});

const {
    noAccess,
    contentModel,
    thumbnailIcon,
    renderLink,
    thumbnailType,
    progress_percent,
    isReleased,
    releaseDate,
} = useCatalogueItem(props);

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

const contentTypeString = computed(() => {
    return snakeToCapitalized(contentModel.value.post.type)
})

const isSongContent = computed(() => {
    return contentModel.value.post.type === 'song'
})

const hasProduct = computed(() => {
    return true; //for now..
})

const contentCreator = computed(() => {
    if (isSongContent.value) {
        return contentModel.value.post.fields.find(field => field.key === 'artist')?.value || ''
    }
    return contentModel.value.post.fields.find(field => field.key === 'instructor')?.value.name || ''
})

const mappedData = computed(() => {
    const difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty').value
    if (Number.isFinite(Number(difficultyValue))) {
        contentModel.value.card.difficulty = difficultyValue;
    }
    else {
        contentModel.value.card.difficulty = 'all';
    }

    return contentModel.value.card
});

const class_object = computed(() => ({
    'no-access': noAccess.value,
    completed: props.item.completed,
    'bb-grey-1-1 dark:tw-border-[#223F57]': props.displayInline,
    'display-inline': props.displayInline,
}));

const getWrapperClass = computed(() => {
    if (props.isMiniCard) {
        return `tw-group tw-py-[4px] tw-h-[78px] tw-relative tw-w-[365px] lg:tw-w-auto tw-shrink-0`;
    }
    else {
        return `tw-snap-center tw-flex tw-flex-col tw-group tw-w-[267px] lg:tw-w-1/4 2xl:tw-w-1/5 4xl:tw-w-1/6 tw-shrink-0 tw-pr-[8px] xl:tw-pr-[12px] 3xl:tw-pr-[18px] ${class_object.value} ${props.displayInline ? 'tw-py-3' : 'tw-pb-2'}`;
    }
});

const is_added = computed(() => props.item.is_added_to_primary_playlist);
const showTrophy = computed(() => props.item.type === 'pack-bundle' && props.item.completed === true);
const isGuitareoChordAndScale = computed(() => brand === 'guitareo' && props.item.type === 'chord-and-scale');

const closeDropdownOnScroll = () => {
    if (state.dropdownOpen) {
        state.dropdownOpen = false;
    }
};

const openNotifyModal = () => {
    console.log('TODO')
}

onMounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer.addEventListener('scroll', closeDropdownOnScroll);
});

onUnmounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer.removeEventListener('scroll', closeDropdownOnScroll);
});

const emit = defineEmits(['addToList', 'progressReset']);

const { emitResetProgress } = useUserCatalogueEvents(props, { emit });

</script>
