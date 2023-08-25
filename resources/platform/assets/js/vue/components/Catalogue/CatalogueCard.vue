<template>
    <div class="tw-snap-center tw-flex tw-flex-col tw-group tw-w-[267px] lg:tw-w-auto tw-shrink-0 lg:tw-shrink tw-pr-[8px] xl:tw-pr-[12px] 3xl:tw-pr-[18px]" :class="[class_object, displayInline ? 'tw-py-3' : 'tw-pb-2']">
        <div class="tw-flex" :class="displayInline ? 'tw-flex-row' : 'tw-flex-col'">
            <!-- Thumbnail Section -->
            <a :href="renderLink ? item.url : null" class="tw-no-underline tw-flex tw-flex-col" :class="[
                { 'thumbnail-col tw-mr-3': displayInline },
                item.type + '-thumbnail'
            ]">
                <div class="tw-relative tw-overflow-hidden tw-rounded-[10px] tw-aspect-video">
                    <!-- Video Thumbnail -->
                    <img :src="`https://www.musora.com/musora-cdn/image/width=500/${mappedData.thumbnail} `"
                        class="tw-absolute tw-transition-opacity tw-duration-500" :class="[
                            item.imageLoaded ? 'tw-opacity-100' : 'tw-opacity-0',
                            item.type === 'song' ? 'tw-blur-sm' : ''
                        ]" loading="lazy" @load="item.imageLoaded = true">
                    <!-- Song Overlay -->
                    <div v-if="item.type === 'song'"
                        class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                        <img class="tw-h-full tw-object-cover" :src="mappedData.thumbnail" :alt="mappedData.black_title" />
                    </div>

                    <!-- Progress -->
                    <div class="lesson-progress overflow">
                        <span class="progress" :class="themeBgClass" :style="'width:' + progress_percent + '%'"></span>
                    </div>
                    <div v-if="showTrophy" class="bundle-complete tw-justify-center">
                        <i class="fas fa-trophy"></i>
                    </div>
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
                <a :href="renderLink ? item.url : null" class="card-info tw-flex tw-flex-col tw-p-1 tw-rounded-lg"
                    :class="displayInline ? 'tw-justify-center' : 'tw-py-2'">
                    <!-- Coach Title -->
                    <div v-if="item.type !== 'song-part'">
                        <h5 class="tw-text-xs tw-font-normal tw-leading-none tw-text-[#3F3F46] tw-mb-1 tw-uppercase dark:tw-text-[#9EC0DC]"
                            v-if="!isGuitareoChordAndScale" v-html="mappedData.color_title">
                        </h5>
                    </div>

                    <!-- Video Title -->
                    <h4 class="tw-text-sm tw-leading-snug tw-text-[#00101D] font-compressed tw-font-bold tw-capitalize tw-mb-1 dark:tw-text-white tw-line-clamp-2"
                        :class="{ 'tw-text-center': isGuitareoChordAndScale }">
                        {{ mappedData.black_title }}
                    </h4>
                    <!-- Video Description -->
                    <p v-if="mappedData.show_description"
                        class="tw-text-xs font-compressed tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-pb-1 tw-mb-1 item-description tw-line-clamp-2"
                        v-html="mappedData.description.replace(/<[^>]+>/g, '')"></p>
                    <!-- Content -->
                    <h6 class="tw-text-xs tw-font-normal tw-text-[#3F3F46] tw-capitalize dark:tw-text-[#9EC0DC]"
                        :class="{ 'tw-text-center': isGuitareoChordAndScale }">
                        <span v-html="mappedData.content_type"></span>
                        <span v-if="mappedData.grey_title && mappedData.grey_title !== ''">
                            - {{ mappedData.grey_title }}
                        </span>
                        &nbsp;
                    </h6>
                </a>
                <!-- Add to Playlist -->
                <div class="tw-inline-flex tw-items-start tw-p-1">
                    <button v-if="item.type !== 'pack-bundle' && showMyListAction"
                        class="add-to-list tw-inline-flex tw-rounded-full tw-p-0.5 tw-text-[#00101D] dark:tw-text-white"
                        :class="is_added ? 'is-added' + themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                        :title="is_added ? 'Remove from Playlist' : 'Add to Playlist'" :data-content-id="item.id"
                        :data-content-type="item.type"
                        @click.stop.prevent="$emit('addToList', { content_id: item.id, type: item.type, name: mappedData.color_title, description: mappedData.black_title, thumbnail_url: mappedData.thumbnail })">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, onBeforeUnmount, onBeforeMount } from 'vue';
import useCatalogueItem from '../../hooks/useCatalogueItem.js';
import useThemeClasses from '../../hooks/useThemeClasses.js';

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}), // Default empty object
    },
    contentType: {
        type: String,
        default: '' // Default empty string
    },
    brand: {
        type: String,
        default: ''
    },
    themeColor: {
        type: String,
        default: '#000000' // Default color black
    },
    useThemeColor: {
        type: Boolean,
        default: false
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
    forceWideThumbs: {
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

const { themeBgClass } = useThemeClasses(props);

onBeforeMount(() => {
    //console.log('props', props)
    //console.log('contentModel', contentModel.value)
})

const mappedData = computed(() => contentModel.value.card);

const class_object = computed(() => ({
    'no-access': noAccess.value,
    completed: props.item.completed,
    'bb-grey-1-1 dark:tw-border-[#223F57]': props.displayInline,
    'display-inline': props.displayInline,
}));

const is_added = computed(() => props.item.is_added_to_primary_playlist);

const showTrophy = computed(() => props.item.type === 'pack-bundle' && props.item.completed === true);

const isGuitareoChordAndScale = computed(() => props.brand.value === 'guitareo' && props.item.type === 'chord-and-scale');

onBeforeUnmount(() => {
    mappedData.value = null;
});
</script>
