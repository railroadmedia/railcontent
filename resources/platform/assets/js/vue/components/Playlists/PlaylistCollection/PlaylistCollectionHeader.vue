<script setup>
    import { onBeforeMount, onMounted } from 'vue';
    import platformHeader from "../../PlatformHeader/platform-header.vue";
    import { usePlaylistsStore } from '../../../../stores/playlists';


    //-----------Props-----------//
    const props = defineProps({
        playlistCount: {
            type: Number,
            default: 0
        },
    });

    //Methods
    const handleCreatePlaylist = () => {
        window.openplaylistmodal({ modalType: 'create', data: { name: '', category: 'My List', thumbnail_url: null, description: ''} });
    };
    
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //lifecycle hooks
    onBeforeMount(()=> {
        playlistsStore.playlistsQuantity = props.playlistCount;
    })
    onMounted(()=> {
        // console.log(props.playlistCount)
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