<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import InputLabel from '../../InputLabel/InputLabel.vue';
    import { vMaska } from 'maska';

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
        title: '',
        durationTime: 0,
        startTime: 0,
        endTime: 0
    })

    //-----------Methods-----------//

    //Format Duration (istate.startTimen seconds)
    const splitSeconds = (seconds) => {
        let time = seconds || 0;
        const hrs = Math.floor(time / 3600);
        const min = Math.floor( (time % 3600) / 60);
        const sec = time % 60;
        //Formatted
        const hrsFormatted = hrs < 10 ? `0${hrs}` : hrs;
        const minFormatted = min < 10 ? `0${min}` : min;
        const secFormatted = sec < 10 ? `0${sec}` : sec;

        return `${hrsFormatted}:${minFormatted}:${secFormatted}`;
    }

    //Send request
    const handleConfirm = () => {
        const payload = {
            user_playlist_item_id: props.data.user_playlist_item_id,
            position: props.index,
            start_second: state.startTime,
            end_second: state.endTime,
            brand: props.brand,
        };
        //Update UI
        playlistsStore.updatePlaylistItem({
            user_playlist_item_id: props.data.user_playlist_item_id,
            index: props.index,
            start: payload.start_second,
            end: payload.end_second
        })
        //Send Request
        PlaylistService.updatePlaylistItem(payload, token)
            .then(function(response) {
                if (response.status === 200) {
                    //show success message
                    window.shownotification({
                        icon: 'fa-pen-to-square',
                        text: `You have successfully set the start and end time for '${state.title}'.`
                    })
                } else {
                    console.log('edit response code', response)
                }
            })
        //Close Modal
        emit('onCloseModal')
    };

    //----------Lifecycle Hooks----------//
    onBeforeMount(()=> {
        //Get Playlist Name
        const title = props.data.title;
        state.title = title;
        //Format start/end values
        let startTime = props.data.start_second || 0;
        let endTime = props.data.end_second || props.data.duration || 0;
        let duration = props.data.duration || 0;
        //Get HrsMinSec Values
        state.durationTime = duration;
        state.startTime = startTime;
        state.endTime = endTime;
    })

    const handleStartTime = (e) => {
        let val = parseInt(e.target.value);
        if (val >= state.endTime) {
            e.target.value = state.endTime;
            return;
        }
        state.startTime = val;
    }

    const handleEndTime = (e) => {
        let val = parseInt(e.target.value);
        if (val <= state.startTime) {
            e.target.value = state.startTime;
            return;
        }
        state.endTime = val;
    }

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Set Start/End Time</h2>

        <div class="tw-flex tw-pt-[29px] tw-pb-4">
            <!-- Start Time -->
            <div class="tw-w-full tw-flex-col tw-px-3">
                <p class="tw-text-sm tw-pb-[5px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]">Start Time</p>
                <h3 class="tw-mb-2 dark:tw-text-white tw-text-3xl">{{ splitSeconds(state.startTime ) }}</h3>
            </div>
            <!-- End Time -->
            <div class="tw-w-full tw-flex-col tw-px-3">
                <p class="tw-text-sm tw-pb-[5px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]">End Time</p>
                <h3 class="tw-mb-2 dark:tw-text-white tw-text-3xl">{{ splitSeconds(state.endTime ) }}</h3>
            </div>
        </div>
        <!-- Slider -->
        <div class="tw-relative tw-w-full">
            <input type="range"
                class="tw-absolute tw-w-full tw-h-2 tw-bg-transparent tw-rounded-lg tw-appearance-none tw-cursor-pointer tw-bg-gray-300 dark:tw-bg-gray-700"
                @input="handleStartTime"
                :value="state.startTime"
                step="1"
                :min="0"
                :max="state.durationTime"
            >
            <input type="range"
                class="tw-absolute tw-w-full tw-h-2 tw-bg-transparent tw-rounded-lg tw-appearance-none tw-cursor-pointer tw-bg-gray-300 dark:tw-bg-gray-700"
                @input="handleEndTime"
                :value="state.endTime"
                step="1"
                :min="0"
                :max="state.durationTime"
            >
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-secondary tw-text-[#002039] dark:tw-text-white tw-mr-4 tw-w-[218px]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button :class="`tw-mb-2 tw-ml-auto tw-btn-primary tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="handleConfirm()"
            >
                SAVE
            </button>
        </div>
    </div>
</template>
<style>
    input[type=range]::-webkit-slider-thumb {
        z-index: 2;
        position: relative;
    }
</style>
