<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';

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
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">This Playlist is Currently Private</h2>
        <p class="dark:tw-text-white tw-text-center tw-mt-2">
            Private playlists can't be shared. <br>
            Would you like to make your playlist public?
        </p>

        <div class="tw-flex tw-items-center tw-justify-center tw-mt-4">
            <label tabindex="-1" for="isPublic" class="tw-cursor-pointer dark:tw-text-white tw-mr-4 tw-uppercase tw-font-bold">Public</label>
            <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1 tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1">
                <input tabindex="0" type="checkbox" name="public" id="isPublic" class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px]" v-model="state.isPublic">
                <label tabindex="-1" for="isPublic" class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74]" :class="`peer-checked:tw-bg-${brand}`"></label>
                <label tabindex="-1" for="isPublic" class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></label>
            </div>
        </div>

        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-secondary tw-mr-4 tw-w-[218px] tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button class="tw-mb-2 tw-ml-auto tw-btn-primary tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] tw-px-[30px] tw-w-[218px] disabled:tw-pointer-events-none disabled:tw-opacity-70 dark:hover:tw-text-white"
                    :disabled="!state.isPublic"
                    @click.prevent="handleConfirm"
            >
                Confirm
            </button>
        </div>
    </div>
</template>
