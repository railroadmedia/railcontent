<script setup>
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

    //-----------Props-----------//
    const props = defineProps({
        listElement: {
            type: Object,
            default: {}
        },
        isListView: {
            type: Boolean,
            default: true,
        },
        img: {
            type: String,
            default: "",
        },
        isThumbnailUpload: {
            type: Boolean,
            default: false,
        },
        isMiniCatalog: {
            type: Boolean,
            default: false,
        },
        linkUrl: {
            type: String,
            default: "",
        },
    });
</script>
<template>
        <!-- Playlist thumbnail -->
        <a id="playlist-list-view-thumbnail" :href="linkUrl.length ? linkUrl : false"
            class="tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-square"
           :class="isListView ? 'tw-h-[72px] tw-w-[72px] tw-rounded tw-shrink-0' : `tw-row-span-5 tw-col-span-5 tw-rounded-lg ${isMiniCatalog ? 'tw-h-auto' : ''} `"
        >
            <!-- Image Conatiner -->
            <div class="tw-relative tw-w-full tw-h-full" v-if="listElement.thumbnail_url || img">
                <img
                    :src="`https://musora.com/cdn-cgi/image/width=200/${listElement.thumbnail_url || img}`"
                    alt="playlist thumbnail"
                    class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                />
                <!-- Image Mask -->
                <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                    <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=330/${listElement.thumbnail_url || img}`" alt="playlist thumbnail">
                </div>
            </div>

            <!-- placeholder (no image or items) -->
            <div v-else class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                <musora-icon icon-name="playlist" class="tw-w-1/2 tw-h-1/2 tw-text-white" />
            </div>

            <!-- hover overlay -->
            <div id="playlist-list-view-thumbnail-overlay" v-if="!isThumbnailUpload"
                 class="tw-hidden tw-h-full tw-w-full tw-text-white tw-absolute tw-top-0 tw-left-0 tw-transition-colors tw-z-30 tw-bg-black/30 tw-justify-center tw-items-center">
                 <div class="tw-relative tw-flex tw-justify-center tw-items-center" :class="isListView ? 'tw-h-[26px] tw-w-[26px]' : 'tw-h-[60px] tw-w-[60px]'">
                    <div class="tw-absolute tw-bg-black tw-rounded-full" :class="isListView ? 'tw-h-[20px] tw-w-[20px]' : 'tw-h-[40px] tw-w-[40px]'"></div>
                    <MusoraIcon icon-name="play-circle-filled" class="tw-absolute" :class="isListView ? 'tw-h-[26px] tw-w-[26px]' : 'tw-h-[60px] tw-w-[60px]'" />
                 </div>
            </div>
        </a>
</template>

<style>
    #playlist-list-view-thumbnail:hover #playlist-list-view-thumbnail-overlay,
    #playlist-list-view-thumbnail:focus  #playlist-list-view-thumbnail-overlay {
        display: flex !important;
    }
</style>
