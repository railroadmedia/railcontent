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
                            icon: 'fa-not-equal',
                            text: `'${props.data.name}' was removed from your library.`
                        })
                        //Close Modal
                        emit('onCloseModal')
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
        //Delete from UI First
        playlistsStore.deleteLesson(props.data, props.index);
        //Send Request
        console.log('id ', props.data.id)
        PlaylistService.deleteLesson(props.data.id, token)
            .then(function(response) {
                if (response.status === 200) {   
                    //show success message
                    window.shownotification({
                        icon: 'fa-not-equal',
                        text: `'${state.title}' was removed from your playlist.`
                    })
                    //Close Modal
                    emit('onCloseModal')
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

    onBeforeMount(()=> {
        // console.log(playlistsStore.playlists.length)
        if(props.mode === "lesson") {
            const title = props.data.fields.find(field => field.key === 'title');
            state.title = title.value;
        }
    })
</script>

<template>
    <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
        <template v-if="!state.isLoading">
            
            <h2 class="tw-text-2xl tw-font-bold tw-w-full  tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
                Delete 
                <span :class="`tw-text-${brand}`" class="tw-mr-0.5">
                    <span v-if="mode === 'lesson'">{{ state.title }}</span>
                    <span v-else>{{ data.name }}</span>
                </span>?
            </h2>

            <p class="dark:tw-text-white tw-text-center">This action can not be undone</p>

            <div class="tw-pt-8 tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
                <!-- Delete Playlist -->
                <button v-if="mode !== 'lesson'" :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                        @click.prevent="handleDeletePlaylist()"
                >
                    CONFIRM
                </button>
                <!-- Delete Lesson -->
                <button v-else :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                        @click.prevent="handleDeleteLesson()"
                >
                    CONFIRM
                </button>
                <!-- Close Modal -->
                <button @click="() => emit('onCloseModal')"
                        class="tw-btn-primary tw-btn-small tw-text-base dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-w-[218px]">
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