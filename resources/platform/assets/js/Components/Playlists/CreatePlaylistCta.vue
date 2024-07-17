<script setup>
import PageHeaderCta from "../PageHeader/PageHeaderCta.vue";
import { onBeforeMount, reactive, onUpdated } from 'vue';
import { usePlaylistsStore } from '../../Stores/playlists';
import { useUserStore } from "../../Stores/user";
import { storeToRefs } from "pinia/dist/pinia";

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
onBeforeMount(() => {
    playlistsStore.playlistsQuantity = props.playlistCount;
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    //Update Params
    state.searchTerm = params.search || '';
    state.sortbyValue = params.sortby_val || '-created_at';
})

onUpdated(() => {
    //Get URL Params
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    state.searchTerm = params.search || '';
    state.sortbyValue = params.sortby_val || '-created_at';
})

const handleShowModal = () => {
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

</script>
<template>
    <PageHeaderCta v-bind="$attrs" faIconClass="fa-plus" text="Create Playlist" @click="handleShowModal" />
</template>
