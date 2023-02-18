<script setup>
    import { inject, reactive, onBeforeMount } from 'vue';
    import PlaylistService from '../../../../services/playlists';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import UnpinItem from './UnpinItem.vue';

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
                PlaylistService.unpinPlaylist(p, brand, token)
                    .then((response) => {
                        if(response.status === 200) { 
                            playlistsStore.unpinPlaylist(p)
                        }
                    })
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
            <h2 class="tw-text-[24px] tw-font-bold tw-w-full  tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
                You've reached your Pinned Playlist limit
            </h2>
            <p class="dark:tw-text-white tw-text-center tw-text-sm">You have reached your Sidebar Pinned List Limit. Unpin one or more of your playlists to free up space and pin <span :class="`tw-text-${brand}`" class="tw-font-bold">{{ props.playlist.name }}</span></p>
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
        <div class="tw-pt-[30px] tw-flex tw-justify-center">
            <button @click="() => emit('onCloseModal')" class="tw-w-[150px] tw-btn-primary tw-btn-small tw-text-center tw-justify-center tw-items-center dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10">CANCEL</button>
            <button @click="() => handleUnpinPlaylists()" :class="`tw-ml-2 tw-btn-primary tw-btn-small tw-bg-${brand} tw-text-center tw-flex tw-justify-center tw-items-center tw-p-0 tw-w-[150px] tw-px-[30px]`"><span>CONFIRM</span></button>
        </div>
    </div>
</template>