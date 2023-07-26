<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import LoadingSpinner from '../../LoadingSpinner/LoadingSpinner.vue';

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
        PlaylistService.deletePlaylist(props.data.id, token)
            .then(function(response) {
                if (response.status === 200) {
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
        PlaylistService.deletePlaylistItem(props.data.user_playlist_item_id, token)
            .then(function(response) {
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
    <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
        <template v-if="!state.isLoading">
            <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
                <span v-if="mode === 'lesson'">Remove from playlist?</span>
                <span v-else>Delete <span :class="`tw-text-${brand}`" class="tw-mr-0.5">{{ data.name }}</span>?</span>
            </h2>
            <p class="dark:tw-text-white tw-text-center">
                <span v-if="mode === 'lesson'">Are you sure? This action can not be undone.</span>
                <span v-else>Warning: this action can not be undone.</span>
            </p>
            <div class="tw-pt-8 tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-justify-center tw-w-full">
                <!-- Delete Playlist -->
                <button v-if="mode !== 'lesson'" :class="`tw-mb-2 tw-btn-primary tw-px-[30px] tw-w-[218px] sm:tw-order-1 sm:tw-ml-2 sm:tw-order-1 tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57]`"
                        @click.prevent="handleDeletePlaylist()"
                >
                    CONFIRM
                </button>
                <!-- Delete Lesson -->
                <button v-else :class="`tw-mb-2 tw-btn-primary tw-px-[30px] tw-w-[218px] sm:tw-order-1 sm:tw-ml-2 sm:tw-order-1 tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57]`"
                        @click.prevent="handleDeleteLesson()"
                >
                    CONFIRM
                </button>
                <!-- Close Modal -->
                <button @click="() => emit('onCloseModal')"
                        class="tw-btn-primary tw-w-[218px] sm:tw-mr-2 tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">
                        CANCEL
                </button>
            </div>
        </template>
        <template v-else>
            <LoadingSpinner classOverride="tw-w-[48px] tw-h-[48px] tw-text-[#00101D] dark:tw-text-white" />
            <p class="tw-text-center tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-my-4 tw-italic">Redirecting to Playlist Page...</p>
        </template>
    </div>
</template>
