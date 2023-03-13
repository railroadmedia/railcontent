<script setup>
    import { onBeforeMount, reactive, onMounted, onUpdated } from 'vue';
    import platformHeader from "../../PlatformHeader/platform-header.vue";
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        playlistCount: {
            type: Number,
            default: 0
        },
        brand: {
            type: String, 
            default: 'drumeo'
        }
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
            brand: props.brand,
            data: { 
                name: '', 
                category: 'My List', 
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
<template>
    <platform-header
        title="Playlists"
        titleIcon="playlist"
        backgroundImage="https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg"
    >
        <template v-slot:content> 
            <p v-if="playlistsStore.playlistsQuantity" class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#7E9AB1]">
                {{ playlistsStore.playlistsQuantity }} Playlists    
            </p> 
        </template>
        <template v-slot:ctas> 
            <div class="tw-flex tw-items-center tw-justify-start tw-ml-auto tw-w-full md:tw-w-auto tw-mt-4">
                <button class="tw-btn-secondary tw-text-white"
                        @click="handleCreatePlaylist"
                >
                    <musora-icon icon-name="plus" class="tw-w-[30px] tw-mr-1" />
                    Create Playlist
                </button>
            </div>
        </template>
    </platform-header>
</template>