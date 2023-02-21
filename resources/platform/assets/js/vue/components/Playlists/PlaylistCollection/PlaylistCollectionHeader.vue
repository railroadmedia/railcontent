<script setup>
    import platformHeader from "../../PlatformHeader/platform-header.vue";
    import { usePlaylistsStore } from '../../../../stores/playlists';

    //Methods
    const handleCreatePlaylist = () => {
        window.openplaylistmodal({ modalType: 'create' });
    };
    
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();
</script>
<template>
    <platform-header
        title="Playlists"
        titleIcon="playlist"
        backgroundImage="https://musora-web-platform.s3.amazonaws.com/playlists/playlist-background.png"
    >
        <template v-slot:content> 
            <p v-if="playlistsStore.playlistsQuantity" class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#7E9AB1]">
                {{ playlistsStore.playlistsQuantity }} Playlists    
            </p> 
        </template>
        <template v-slot:ctas> 
            <button class="tw-btn-secondary tw-text-white"
                    @click="handleCreatePlaylist"
            >
                <musora-icon icon-name="plus" class="tw-w-[30px] tw-mr-1" />
                Create Playlist
            </button>
        </template>
    </platform-header>
</template>