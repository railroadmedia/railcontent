<script setup>
    import { onBeforeMount, onMounted, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../stores/playlists';
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        list: {
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
        isLink: {
            type: Boolean,
            default: true,
        }
    });
</script>
<template>
        <!-- Playlist thumbnail -->
        <a :href="isLink ? list.url : false"
            class="tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-square"
           :class="isListView ? 'tw-h-[48px] tw-w-[48px] tw-rounded tw-shrink-0' : 'tw-row-span-5 tw-col-span-5 tw-rounded-lg'"
        >
            <!-- Image Conatiner -->
            <div class="tw-relative tw-w-full tw-h-full" v-if="list.thumbnail_url || img">
                <img
                    :src="`https://musora.com/cdn-cgi/image/width=200/${list.thumbnail_url || img}`"
                    alt="playlist thumbnail"
                    class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                />
                <!-- Image Mask -->
                <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                    <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=330/${list.thumbnail_url || img}`" alt="playlist thumbnail">
                </div>
            </div>

            <!-- placeholder (no image or items) -->
            <div v-else class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                <musora-icon icon-name="playlist" class="tw-w-1/2 tw-h-1/2 tw-text-white" />
            </div>

            <!-- hover overlay -->
            <div v-if="!props.isListView"
                 class="tw-h-full tw-w-full tw-absolute tw-top-0 tw-left-0 tw-transition-colors tw-z-30 group-hover:tw-bg-black/30">
            </div>
        </a>
</template>
