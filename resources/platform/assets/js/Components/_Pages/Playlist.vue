<template>
    <div class="tw-full">
        <Breadcrumb
            :breadcrumbs="[{ title: 'My Playlists', url: `/${ brand }/playlists` }, { title: playlist['name'] }]"
            classOverride="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8"
        />

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-4">
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
import { useUserStore } from "../../Stores/user";

//Components
import Breadcrumb from '../Breadcrumb/Breadcrumb.vue';
import PlaylistHeader from '../Playlists/Playlist/PlaylistHeader';
import PlaylistCatalog from '../Playlists/Playlist/PlaylistCatalog';

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
