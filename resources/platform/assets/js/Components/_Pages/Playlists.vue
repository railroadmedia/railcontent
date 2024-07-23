<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="[{ title: 'My Playlists' }]" />
        <PageHeader pageType="playlists" title="My Playlists" iconName="playlist" :ctas="ctaConfig"
            :infoData="headerInfoData" />
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <PlaylistCollectionCatalog :playlists="playlists" :playlist-count="playlistCount"
                    :filterOptions="filterOptions" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue';

//Components
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PlaylistCollectionCatalog from '@collections/Playlists/PlaylistCollection/PlaylistCollectionCatalog';
import PageHeader from '@collections/PageHeader/PageHeader.vue';

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

const ctaConfig = computed(() => {
    return [
        {
            type: 'CreatePlaylistCta'
        },
    ];
});

const headerInfoData = computed(() => {
    return [`${props.playlistCount}`]
})
</script>
