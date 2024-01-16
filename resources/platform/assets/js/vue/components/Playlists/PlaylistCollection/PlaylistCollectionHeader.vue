<template>
    <platform-header
        title="Playlist Library"
        titleIcon="playlist"
        backgroundImage="https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg"
        class="tw-min-h-[180px]"
    >
        <template v-slot:content>
            <p class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#7E9AB1]">
                {{ playlistsStore.playlistsQuantity }} Playlists
            </p>
        </template>
        <template v-slot:ctas>
            <div v-if="playlistsStore.playlistsQuantity" class="tw-flex tw-items-center tw-justify-start tw-ml-auto tw-w-full md:tw-w-auto tw-mt-4">
                <button class="tw-btn-secondary tw-text-white hover:tw-bg-white hover:tw-text-black"
                        @click="handleCreatePlaylist"
                >
                    <musora-icon icon-name="plus" class="tw-w-[30px] tw-mr-1" />
                    Create Playlist
                </button>
            </div>
        </template>
    </platform-header>
</template>
<script setup>
import { onBeforeMount, reactive, onUpdated } from 'vue';
import { usePlaylistsStore } from '../../../../stores/playlists';
import { useUserStore } from "../../../../stores/user";
import {storeToRefs} from "pinia/dist/pinia";

//Pinia Stores
const playlistsStore = usePlaylistsStore();
const userStore = useUserStore();

const { brand } = storeToRefs(userStore);

//-----------Props-----------//
const props = defineProps({
    playlistCount: {
        type: Number,
        default: 0
    },
});

//-----------Reactive Data-----------//
const state = reactive({
    searchTerm: '',
    sortbyValue: '',
})

//-----------Methods-----------//
const handleCreatePlaylist = () => {
    window.openplaylistmodal({
        modalType: 'create',
        brand: brand.value,
        data: {
            name: '',
            category: 'General',
            thumbnail_url: null,
            description: '',
            term: state.searchTerm,
            sort: state.sortbyValue,
        }
    });
};

//-----------Lifecycle Hooks -----------//
onBeforeMount(()=> {
    playlistsStore.playlistsQuantity = props.playlistCount;
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    //Update Params
    state.searchTerm = params.search || '';
    state.sortbyValue = params.sortby_val || '-created_at';
})

onUpdated(()=> {
    //Get URL Params
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    state.searchTerm = params.search || '';
    state.sortbyValue = params.sortby_val || '-created_at';
})
</script>
