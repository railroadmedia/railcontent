<template>
    <Breadcrumb :breadcrumbs="[{ title: 'My Playlists' }]" />

    <PageHeader pageType="playlists" title="My Playlists" iconName="playlist" :ctas="ctaConfig"
        :infoData="headerInfoData" />

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-2 tw-pb-14">
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
import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';
import PlaylistCollectionCatalog from '../components/Playlists/PlaylistCollection/PlaylistCollectionCatalog';
import PageHeader from '../components/PageHeader/PageHeader.vue';

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
