<template>
    <div class="tw-snap-center tw-flex tw-flex-col tw-group tw-shrink-0 sm:tw-pr-[12px]"
        :class="[
            class_object,
            `sm:tw-w-1/4 lg:tw-w-1/5 xl:tw-w-1/7 tw-mb-4 lg:tw-mb-6 ${isGroupedView ? 'tw-w-[145px] sm:tw-w-[170px] tw-mr-[12px] lg:tw-mr-0' : 'tw-w-full'}`,
        ]">
        <div class="tw-flex tw-items-center" :class="`${isGroupedView ? 'tw-flex-col' : 'tw-flex-row sm:tw-flex-col'}`">
            <!-- Thumbnail Section -->
            <a :href="item.url" class="tw-no-underline tw-flex tw-flex-col tw-aspect-square tw-mr-[5px] sm:tw-mr-0" :class="[
                { 'tw-w-full': isGroupedView },
                { 'tw-w-[65px] sm:tw-w-full tw-flex-shrink-0': !isGroupedView },
            ]">
                <div
                    :class="`tw-relative tw-overflow-hidden ${isGroupedView ? 'tw-rounded-[9px]' : 'tw-rounded-[5px] sm:tw-rounded-[9px]'} tw-bg-white dark:tw-bg-[#0E2031] tw-aspect-square`">
                    <!-- Thumbnail -->
                    <img :src="`https://www.musora.com/musora-cdn/image/width=500/${mappedData.thumbnail} `"
                        class="tw-absolute tw-transition-opacity tw-duration-500 tw-opacity-0 tw-aspect-square" loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')">

                    <!-- Progress -->
                    <div class="lesson-progress overflow">
                        <span class="progress" :class="`tw-bg-${brand}`" :style="'width:' + progress_percent + '%'"></span>
                    </div>
                    <div
                        class="tw-absolute tw-flex tw-flex-col tw-opacity-0 group-hover:tw-opacity-100 tw-bg-black/30 tw-w-full tw-h-full tw-justify-center tw-items-center tw-text-white tw-text-center">
                        <i class="fas tw-text-xl" :class="thumbnailIcon"></i>
                        <p v-if="!isReleased" class="tw-mt-1 tw-text-sm text-white font-bold">
                            {{ releaseDate }}
                        </p>
                    </div>
                </div>
            </a>
            <!-- Description Section -->
            <div class="tw-flex tw-w-full tw-justify-between tw-break-all">
                <div class="tw-w-full tw-flex tw-flex-wrap lg:tw-block tw-grow-0 tw-shrink">
                    <a :href="item.url"
                        class="tw-flex-auto tw-flex-col tw-rounded-lg tw-pt-2"
                        :class="isGroupedView ? 'tw-flex' : 'tw-hidden sm:tw-flex'">
                        <div class="tw-flex tw-flex-col">
                            <!-- Song Title -->
                            <h4 class="tw-text-[14px] tw-leading-[18px] tw-text-[#00101D] tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white tw-line-clamp-2">
                                {{ mappedData.black_title }}
                            </h4>
                        </div>
                        <!-- Artist Name -->
                        <h6 class="tw-flex tw-items-center tw-flex-wrap tw-text-[12px] tw-leading-[18px] tw-font-normal tw-text-[#3F3F46] tw-uppercase dark:tw-text-[#9EC0DC]">
                            <div v-if="artistName && artistName !== ''" class="tw-mb-0.5">
                                <span>{{ artistName }}</span>
                            </div>
                        </h6>
                        <p
                            class="tw-flex tw-items-center tw-flex-wrap tw-text-[12px] tw-leading-[18px] tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC]">
                            <!-- Difficulty Label -->
                            <span v-if="mappedData.difficulty" class="tw-flex tw-items-center tw-mb-0.5">
                                <DifficultyLabel class="tw-text-xs" :difficultyValue="mappedData.difficulty"
                                    textCase="capitalize" />
                            </span>
                        </p>
                    </a>
                    <a :href="item.url"
                        class="tw-flex-auto tw-flex-col tw-rounded-lg tw-h-full tw-justify-center"
                        :class="isGroupedView ? 'tw-hidden' : 'tw-flex sm:tw-hidden'">
                        <div class="tw-flex tw-flex-col">
                            <!-- Song Title -->
                            <h4 class="tw-text-[14px] tw-leading-[18px] tw-text-[#00101D] tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white tw-break-all tw-line-clamp-1">
                                {{ mappedData.black_title }}
                            </h4>
                        </div>
                        <p
                            class="tw-flex tw-items-center tw-flex-wrap tw-text-[12px] tw-leading-[18px] tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC]">
                            <!-- Difficulty Label -->
                            <span v-if="mappedData.difficulty">
                                <DifficultyLabel  :difficultyValue="mappedData.difficulty"
                                    textCase="capitalize" />
                            </span>
                            <span class="tw-mx-1 tw-text-base tw-leading-none">·</span>
                            <!-- Artist Name -->
                            <span>
                                {{ artistName }}
                            </span>
                        </p>
                    </a>
                </div>
                <!--
                    Add to Playlist
                -->
                <div class="tw-inline-flex tw-pt-1 lg:tw-pt-2 tw-items-start tw-relative sm:tw-justify-end tw-shrink-0">
                    <div class="tw-relative">
                        <button :id="`${item.id}-action-btn-big`"
                            class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#00101D] dark:tw-text-white"
                            :class="is_added ? 'is-added' + `tw-text-${brand}` : 'tw-text-[#00101D] dark:tw-text-white'"
                            :title="is_added ? 'Remove from Playlist' : 'Add to Playlist'" :data-content-id="item.id"
                            :data-content-type="item.type"
                            @click.prevent="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.black_title, description: mappedData.description, thumbnail_url: mappedData.thumbnail })">
                            <PlusIcon :class="`${isGroupedView ? 'tw-h-[14px] tw-w-[14px] lg:tw-h-[32px] lg:tw-w-[32px]' : 'tw-h-[20px] tw-w-[20px]'}`" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue';
import { PlusIcon } from '@heroicons/vue/outline';
import useCatalogueItem from '../../hooks/useCatalogueItem.js';
import DifficultyLabel from '../DifficultyLabel/DifficultyLabel';
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
    isAdmin: {
        type: Boolean,
        default: false
    },
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});

const {
    noAccess,
    contentModel,
    thumbnailIcon,
    progress_percent,
    isReleased,
    releaseDate,
} = useCatalogueItem({ ...props, brand: brand.value, contentTypeOverride: 'song' });

const artistName = computed(() => {
    if (contentModel.value.post.fields) {
        return contentModel.value.post.fields.find(field => field.key === 'artist')?.value || ''
    }
    return '';
})

const mappedData = computed(() => {
    let difficultyValue = 0; //default
    if (contentModel.value.post.fields) {
        difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty')?.value || 0;
    }

    contentModel.value.card.difficulty = difficultyValue;

    return contentModel.value.card
});

const class_object = computed(() => ({
    'no-access': noAccess.value,
    completed: props.item.completed,
}));

const is_added = computed(() => props.item.is_added_to_primary_playlist);

const closeDropdownOnScroll = () => {
    if (state.dropdownOpen) {
        state.dropdownOpen = false;
    }
};

const emit = defineEmits(['addToList']);

</script>
