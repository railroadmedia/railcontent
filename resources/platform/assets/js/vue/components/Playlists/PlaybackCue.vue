<script setup>
    import { onBeforeMount, onMounted, inject, reactive, computed } from 'vue';
    import PlaylistService from '../../../services/playlists.js';
    import PlaylistCard from './Playlist/PlaylistCard.vue';
    import { usePlaylistsStore } from '../../../stores/playlists';
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

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
        playlistName: {
            type: String,
            default: "Playlist"
        },
        lessons: {
            type: Array,
            default: []
        }
    })

    //-----------Reactive Data-----------//
    const state = reactive({

    })

    onBeforeMount(()=> {
        // console.log(props.lessons)
    })
</script>
<template>
    <section class="tw-z-10 tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-mb-4">
        <!-- Header -->
        <div class="tw-flex tw-flex-col tw-mb-5 dark:tw-bg-[#002039] tw-bg-[#e5e7ea] tw-py-[17px] tw-px-[10px]">
            <h6 class="tw-large tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                {{ playlistName }}
            </h6>
        </div>
        <!-- Items -->
        <div v-if="lessons.length" 
             class="tw-w-full tw-flex tw-flex-col tw-max-h-[540px] tw-overflow-y-auto"
        >
            <!-- Print Each Card -->
            <playlist-card 
                v-for="(lesson,i) in lessons" 
                :key="i" 
                :index="i"
                :lesson="lesson"
                :token="token"
                :brand="brand"
                :cue-version="true"
            /> 
        </div>
    </section>
</template>