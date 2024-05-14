<template>
    <div class="tw-full">
        <Breadcrumb
            :breadcrumbs="[{ title: 'My Playlists', url: `/${ brand }/playlists` }, { title: playlist['name'] }]"
            classOverride="tw-container tw-mx-auto tw-px-4 lg:tw-px-8"
        />

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-4">
            <PlaylistHeader
                :playlist="playlist"
                :has-access="playlist['has_access']"
                :lessons="lessons"
            />
        </div>

        <PlaylistCatalog
            :has-access="playlist['has_access']"
            :lessons="lessons"
        />
    </div>
</template>

<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";

//Components
import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';
import PlaylistHeader from '../components/Playlists/Playlist/PlaylistHeader';
import PlaylistCatalog from '../components/Playlists/Playlist/PlaylistCatalog';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    playlist: {
        type: Object,
        default: {}
    },
    lessons: {
        type: [Array,Object],
        default: []
    }
})
</script>
