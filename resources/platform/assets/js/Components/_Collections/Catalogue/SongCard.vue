<template>
    <div class="tw-snap-center tw-flex tw-flex-col tw-group tw-shrink-0"
        :class="[
            class_object,
            { 'tw-mb-4 sm:tw-mb-2': addMarginBottom },
            `${isGroupedView ? 'tw-w-[145px] sm:tw-w-[170px] lg:tw-w-auto tw-mr-3 lg:tw-mr-0 lg:[&:nth-child(n+6)]:tw-hidden 2xl:[&:nth-child(n+6)]:tw-flex 2xl:[&:nth-child(n+8)]:tw-hidden' : 'tw-w-full'}`,
        ]">
        <div class="tw-flex tw-items-center" :class="`${isGroupedView ? 'tw-flex-col' : 'tw-flex-row sm:tw-flex-col'}`">
            <!-- Thumbnail Section -->
            <component :is="isReleased ? 'a' : 'div' " :href="item.url" class="tw-no-underline tw-flex tw-flex-col tw-aspect-square tw-mr-[10px] sm:tw-mr-0" :class="[
                { 'tw-w-full': isGroupedView },
                { 'tw-w-[90px] sm:tw-w-full tw-flex-shrink-0': !isGroupedView },
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
            </component>
            <!-- Description Section -->
            <div class="tw-flex tw-w-full tw-justify-between tw-break-all">
                <div class="tw-w-full tw-flex tw-flex-wrap lg:tw-block tw-grow-0 tw-shrink">
                    <a :href="item.url"
                        class="tw-flex-auto tw-flex-col tw-rounded-lg tw-pt-2 tw-flex">
                        <div class="tw-flex tw-flex-col">
                            <!-- Song Title -->
                            <h4 class="tw-text-[13px] sm:tw-text-sm tw-leading-[18px] tw-text-[#00101D] tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white tw-line-clamp-2 tw-break-words">
                                {{ mappedData.black_title }}
                            </h4>
                        </div>
                        <!-- Artist Name -->
                        <h6 class="tw-flex tw-items-center tw-flex-wrap tw-text-[11px] sm:tw-text-xs tw-leading-[18px] tw-font-normal tw-text-[#3F3F46] tw-uppercase dark:tw-text-[#9EC0DC] ">
                            <div v-if="artistName && artistName !== ''" class="tw-mb-0.5 tw-break-words tw-line-clamp-1">
                                <span>{{ artistName }}</span>
                            </div>
                        </h6>
                        <p
                            class="tw-flex tw-items-center tw-flex-wrap tw-text-[11px] sm:tw-text-xs tw-leading-[18px] tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC]">
                            <!-- Difficulty Label -->
                            <span v-if="mappedData.difficulty" class="tw-flex tw-items-center tw-mb-0.5">
                                <DifficultyLabel class="tw-text-xs" :difficultyValue="mappedData.difficulty"
                                    textCase="capitalize" />
                            </span>
                        </p>
                    </a>
                </div>
                <!-- Add to Playlist -->
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
import useCatalogueItem from '@hooks/useCatalogueItem.js';
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';

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
    addMarginBottom: {
        type: Boolean,
        default: () => true,
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
