<script setup>
import { onBeforeMount, onMounted, inject, ref, reactive, computed } from 'vue';
import { usePlaylistsStore } from '../../Stores/playlists';

//Inject
const token = inject('csrf_token');

//Pinia Stores
const playlistsStore = usePlaylistsStore();

//Emits
const emit = defineEmits(['closeDropdown', 'pinItem', 'makePublic']);

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    playlists: {
        type: Object,
        default: {}
    },
})
</script>
<template>
    <section class="tw-z-10 dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-mb-4">
        <!-- Related Lessons -->
        <div v-if="playlists.data.length"
            class="tw-w-full tw-flex tw-flex-col tw-max-h-[540px] tw-overflow-y-auto tw-relative">
            <!-- Print Each Card -->
            <a v-if="playlists?.data?.length" v-for="(playlist, i) in playlists.data" :key="i + 'playlist-card-related'"
                :class="`tw-flex tw-py-[16px]${i !== playlists.data.length - 1 ? ' tw-border-b-[1px] tw-border-[#e5e7ea] dark:tw-border-[#002039]' : ''}`"
                :href="playlist.playback_url">
                <div class="tw-h-[100px] tw-w-[100px] tw-overflow-hidden tw-rounded">
                    <div v-if="playlist.thumbnail_url" class="tw-relative tw-w-full tw-h-full tw-aspect-square">
                        <img
                            :src="`https://musora.com/cdn-cgi/image/width=200/${playlist.thumbnail_url}`"
                            alt="playlist thumbnail"
                            class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                        <!-- Image Mask -->
                        <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                            <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=200/${playlist.thumbnail_url}`" alt="playlist thumbnail">
                        </div>
                    </div>

                    <!-- placeholder (no image or items) -->
                    <div v-else class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                        <musora-icon icon-name="playlist" class="tw-w-1/2 tw-h-1/2 tw-text-white" />
                    </div>
                </div>

                <div class="tw-flex tw-flex-col tw-pl-[16px]">
                    <div class="tw-text-black dark:tw-text-[#9EC0DC] tw-text-[14px] tw-pt-[10px]">
                        {{ playlist.category }}
                    </div>
                    <div class="tw-text-black dtw-text-[16px] tw-font-bold dark:tw-text-white tw-pt-[1px]">
                        {{ playlist.name }}
                    </div>
                    <div class="tw-text-black dtw-pt-[7px] dark:tw-text-[#9EC0DC] tw-text-[14px]">
                        {{ playlist.duration_formated }}
                    </div>
                </div>
            </a>
        </div>
    </section>
</template>


