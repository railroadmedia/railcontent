<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../Services/playlists.js';
    import { usePlaylistsStore } from '../../../Stores/playlists';
    import MuButton from '../../Button/MuButton';

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
        index: {
            type: Number,
            default: null
        }
    });

    //--------Reactive Data--------//
    const state = reactive({
        isPublic: false,
    })

    //-----------Methods-----------//

    //Send request
    const handleConfirm = () => {
        //Update Playlist Store
        playlistsStore.activePlaylist.private = false;

        //Close Modal
        emit('onCloseModal')

        PlaylistService.setToPrivate(props.data.id, isPublic, token)
            .then((response) => {
                if (response.status === 201) {
                    //show success message
                    window.shownotification({
                        icon: 'fa-lock-open',
                        text: `${props.data.name} is now public.`
                    })
                }
            })
            .catch(function (error) {
                //Revert
                playlistsStore.activePlaylist.private = true;

                if (error.response) {
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                }
            });
    };

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <div class="tw-flex tw-items-start">
            <p class="dark:tw-text-white tw-mr-10">
                Private playlists can't be shared. Would you like to make your playlist public?
            </p>

            <div class="tw-flex tw-flex-col">
                <div class="tw-inline-flex tw-relative tw-w-[48px] tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1">
                    <input tabindex="0" type="checkbox" name="public" id="isPublic" class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px]" v-model="state.isPublic">
                    <label tabindex="-1" for="isPublic" class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74]" :class="`peer-checked:tw-bg-${brand}`"></label>
                    <label tabindex="-1" for="isPublic" class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></label>
                </div>
                <label tabindex="-1" for="isPublic" class="tw-cursor-pointer dark:tw-text-white tw-uppercase tw-font-bold">Public</label>
            </div>
        </div>

        <div class="tw-pt-[30px] tw-flex tw-justify-end">
            <!-- Close Modal -->
            <MuButton @click="() => emit('onCloseModal')" class="tw-mr-[10px]" variant="secondary">Cancel</MuButton>
            <!-- Delete Lesson -->
            <MuButton @click.prevent="handleConfirm" :disabled="!state.isPublic">Confirm</MuButton>
        </div>
    </div>
</template>
