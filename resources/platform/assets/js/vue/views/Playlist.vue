<template>
    <PlaylistBreadCrumb
        :first-level-url="`/${ brand }/playlists`"
        first-level-title="Playlists"
        :last-level-title="playlist['name']"
    />

    <PlaylistHeader
        :playlist="playlist"
        :has-access="playlist['has_access']"
        :lessons="listLessons"
    />

    <PlaylistCatalog
        :has-access="playlist['has_access']"
        :lessons="lessons"
    />
</template>

<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";

//Components
import PlaylistBreadCrumb from '../components/Playlists/Breadcrumb';
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
        type: Array,
        default: []
    }
})
</script>
