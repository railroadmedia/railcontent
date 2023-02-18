<script setup>
    import { inject, onBeforeMount } from 'vue';
    import PlaylistService from '../../../services/playlists';
    import { usePlaylistsStore } from '../../../stores/playlists';

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

    //Emits
    const emit = defineEmits(['onCloseModal']);
    //Inject
    const token = inject('csrf_token');
    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Methods-----------//
    const handleDeletePlaylist = () => {
        PlaylistService.deletePlaylist(props.playlist.id, token)
            .then(function(response) {
                if (response.status === 200) {
                    //update pinia stores (if pinned)
                    playlistsStore.unpinPlaylist(props.playlist.id)
                    if(playlistsStore.playlists.length <=10) {
                        playlistsStore.deletePlaylist(props.playlist);
                    }
                    //show success message
                    window.shownotification({
                        icon: 'fa-not-equal',
                        text: `${props.playlist.name} was removed from your library.`
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
    })
</script>

<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-[24px] tw-font-bold tw-w-full  tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-4">
            Delete <span :class="`tw-text-${brand}`" class="tw-mr-0.5">{{ playlist.name }}</span>?
        </h2>
        <p class="dark:tw-text-white tw-text-center">This action can not be undone</p>

        <div class="tw-pt-12 tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
            <button :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="handleDeletePlaylist()"
            >
                CONFIRM
            </button>
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-primary tw-btn-small tw-text-base dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-w-[218px]">
                    CANCEL
            </button>
        </div>
    </div>
</template>