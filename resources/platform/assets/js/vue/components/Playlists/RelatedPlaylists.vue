<script setup>
import { onBeforeMount, onMounted, inject, ref, reactive, computed } from 'vue';
import { usePlaylistsStore } from '../../../stores/playlists';

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
                <div class="tw-h-[100px] tw-w-[100px] tw-overflow-hidden">
                    <img class="tw-object-cover tw-h-[100px] tw-w-[100px] tw-rounded" :src="playlist.thumbnail_url" />
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
