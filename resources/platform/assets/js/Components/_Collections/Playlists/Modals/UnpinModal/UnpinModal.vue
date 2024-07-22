<script setup>
    import { inject, reactive, onBeforeMount } from 'vue';
    import PlaylistService from '@services/playlists.js';
    import { usePlaylistsStore } from '@stores/playlists.js';
    import UnpinItem from './UnpinItem.vue';
    import MuButton from '@units/Button/MuButton';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        },
        playlist: {
            type: Object,
            default: {}
        }
    });

    //-----------Static Data-----------//
    const unpinnedPlaylists = [];

    //Emits
    const emit = defineEmits(['onCloseModal']);
    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Methods-----------//
    const storeUnpinnedItem = id => {
        //Store IDs in unpinnedPlaylists Array
        unpinnedPlaylists.push(id);
    }

    const handleUnpinPlaylists = () => {
        if(unpinnedPlaylists.length) {

            unpinnedPlaylists.forEach(p => {
                //Remove Pin First
                playlistsStore.unpinPlaylist(p)
                //Then send unpin request
                PlaylistService.unpinPlaylist(p, brand, token);
                //fail silently?
            })
            //Confirmation
            window.shownotification({
                icon: 'playlist',
                text: `${unpinnedPlaylists.length} playlists have been unpinned from the sidebar.`
            })
        }
        emit('onCloseModal');
    }

    onBeforeMount(()=> {
        // console.log(playlistsStore.playlists.length)
    })
</script>

<template>
    <div class="tw-h-full tw-w-full">
        <div class="tw-mb-6">
            <p class="dark:tw-text-white tw-text-center tw-text-sm">You have reached your Sidebar Pinned List Limit. Unpin one or more of your playlists to free up space and pin <span :class="`tw-text-${brand}`" class="tw-font-bold tw-whitespace-nowrap">{{ props.playlist.name }}</span></p>
        </div>
        <!-- Playlists -->
        <section class="tw-w-full tw-relative tw-flex tw-flex-col">
            <!-- Playlist Item -->
            <unpin-item
                v-for="list in playlistsStore.pinnedPlaylists"
                :key="list.id"
                :list="list"
                @onUnpin="storeUnpinnedItem"
            />
        </section>

        <!-- Modal CTAs -->
        <div class="tw-pt-[30px] tw-flex tw-justify-end">
            <MuButton @click="() => emit('onCloseModal')" variant="secondary" class="tw-mr-[10px]">Cancel</MuButton>
            <MuButton @click="() => handleUnpinPlaylists()">Confirm</MuButton>
        </div>
    </div>
</template>../../../_Units/Button/MuButton.js