<template>
    <Breadcrumb
        :breadcrumbs="[{ title: 'My Playlists' }]"
    />

    <PlaylistCollectionHeader :playlist-count="playlistCount" />

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-2 tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">

                <PlaylistCollectionCatalog :playlists="playlists" :playlist-count="playlistCount" :filterOptions="filterOptions" />
            </div>
        </div>
    </div>
</template>
<script setup>

//Components
import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';
import PlaylistCollectionHeader from '../components/Playlists/PlaylistCollection/PlaylistCollectionHeader';
import PlaylistCollectionCatalog from '../components/Playlists/PlaylistCollection/PlaylistCollectionCatalog';

const props = defineProps({
    playlists: {
        type: Array,
        default: []
    },
    playlistCount: {
        type: Number,
        default: 0
    },
    filterOptions: {
        type: [Object, Array],
        default: null
    },
})
</script>
