<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '@services/playlists.js';
    import { usePlaylistsStore } from '@stores/playlists';
    import LoadingSpinner from '@units/LoadingSpinner/LoadingSpinner.vue';
    import MuButton from '@units/Button/MuButton';
    import {deletePlaylistItem, deletePlaylist} from 'musora-content-services';

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        },
        data: {
            type: Object,
            default: {}
        },
        mode: {
            type: String,
            default: null
        },
        index: {
            type: Number,
            default: null
        }
    });

    //--------Computed Properties--------//


    //--------Reactive Data--------//
    const state = reactive({
        isLoading: false,
        title: '',
    })

    //-----------Methods-----------//
    const handleDeletePlaylist = () => {
        deletePlaylist(props.data.id)
            .then(function(response) {

                if (response.success === true) {
                    //update pinia stores (if pinned)
                    playlistsStore.unpinPlaylist(props.data.id)

                    //Redirect on Playlist Page
                    if(props.data.id === playlistsStore.activePlaylist.id) {
                        state.isLoading = true;
                        window.location.href = `/${brand}/playlists/`;
                        //Possibly store the deleted playlist name in session storage for notification
                    } else {
                        if(playlistsStore.playlistsQuantity <=10) {
                            playlistsStore.deletePlaylist(props.data);
                        } else {
                            //load
                            playlistsStore.loadingPlaylists = true;
                            playlistsStore.getPlaylists({ brand: props.brand, page: playlistsStore.resultsPage, limit: 10 }, token);
                        }
                        //show success message
                        window.shownotification({
                            icon: 'fa-trash',
                            text: `The playlist has been deleted from your library.`
                        })
                        //Close Modal
                        emit('onCloseModal')

                        //load sidebar playlists
                        playlistsStore.getSidebarPlaylists({
                            brand: brand,
                            page: 1,
                            limit: 10,
                            term: '',
                            sort: 'most_recent',
                        }, token);
                    }
                }
            })
            .catch(function (error) {
                if (error.response) {
                    //handle error
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                    //Close Modal
                    emit('onCloseModal')
                }
            });
    }

    const handleDeleteLesson = () => {
        //Delete from UI first
        playlistsStore.deletePlaylistItem(props.data);
        //Close Modal
        emit('onCloseModal');
        //Send Request
        deletePlaylistItem(props.data).then(function(response) {
                if (response.status === 200) {
                    if(props.data.index === 0) playlistsStore.getPlaylist({ playlist_id: playlistsStore.activePlaylist.id }, token);

                    //show success message
                    window.shownotification({
                        icon: 'fa-trash',
                        text: `${state.title} was removed from your playlist.`
                    })
                }
            })
            .catch(function (error) {
                if (error.response) {
                    //handle error
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                }
            });
    }

    onBeforeMount(()=> {
        // console.log(playlistsStore.playlists.length)
        if(props.mode === "lesson") {
            const title = props.data.title;
            state.title = title;
        }
    })
</script>

<template>
    <div class="tw-h-full tw-w-full tw-flex tw-flex-col">
        <template v-if="!state.isLoading">
            <p class="dark:tw-text-white">
                <span v-if="mode === 'lesson'">Are you sure? This action can not be undone.</span>
                <span v-else>Warning: this action can not be undone.</span>
            </p>
            <div class="tw-mt-5 tw-flex tw-justify-end tw-w-full">
                <!-- Close Modal -->
                <MuButton variant="secondary" class="tw-mr-[10px]" @click="() => emit('onCloseModal')">Cancel</MuButton>
                <!-- Delete Playlist -->
                <MuButton @click.prevent="mode !== 'lesson' ? handleDeletePlaylist() : handleDeleteLesson()">Confirm</MuButton>
            </div>
        </template>
        <template v-else>
            <LoadingSpinner classOverride="tw-w-[48px] tw-h-[48px] tw-text-[#00101D] dark:tw-text-white" />
            <p class="tw-text-center tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-my-4 tw-italic">Redirecting to Playlist Page...</p>
        </template>
    </div>
</template>
