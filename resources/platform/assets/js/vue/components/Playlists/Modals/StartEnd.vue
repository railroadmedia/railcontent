<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import InputLabel from '../../InputLabel/InputLabel.vue';

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
        duration: 0,
        start_second: 0,
        end_second: 0,
    })

    //-----------Methods-----------//

    //Format Duration (in seconds)
    const duration_formatted = (seconds) => {
        let time = seconds;
        if( time ) { //does it exist
            const hrs = Math.floor(time / 3600);
            const min = Math.floor(time / 60);
            const sec = time - min * 60;
            const hrsFormatted = hrs < 10 ? `0${hrs}` : hrs;
            const minFormatted = min < 10 ? `0${min}` : min;
            const secFormatted = sec < 10 ? `0${sec}` : sec;
            return `${hrsFormatted}:${minFormatted}:${secFormatted}`;
        } else {
            return false;
        }
    }

    //Revert To Seconds
    const revertToSeconds = (duration) => {
        const hrs = Math.floor(time / 3600);
        const min = Math.floor(time / 60);
        const sec = time - min * 60;
        const hrsFormatted = hrs < 10 ? `0${hrs}` : hrs;
        const minFormatted = min < 10 ? `0${min}` : min;
        const secFormatted = sec < 10 ? `0${sec}` : sec;
        return `${hrsFormatted}:${minFormatted}:${secFormatted}`;
    }

    //Start Time Change
    const handleStartTimeChange = (val) => {
        state.end_second = val;
    }

    //End Time Change
    const handleEndTimeChange = (val) => {
        state.start_second = val;
    }

    //Send request
    const handleConfirm = () => {
        const payload = {
            user_playlist_item_id: props.data.id,
            position: props.index,
            start_second: state.start_second,
            end_second: state.end_second,
            brand: props.brand,
        };
        //Update UI

        //Send Request
        console.log('start seconds ', state.start_second)
        // PlaylistService.updatePlaylistItem(payload, token)
        //     .then(function(response) {
        //         if (response.status === 201) {
        //             // playlistsStore.loadingItems = true;
        //             //show success message
        //             window.shownotification({
        //                 icon: 'fa-pen-to-square',
        //                 text: `You have successfully set the Start and End time of '${state.title}'`
        //             })
        //             //load Playlists
        //             // playlistsStore.getPlaylistItems({ 
        //             //     playlist_id: props.playlist.id,
        //             // }, token);      
        //         } else {
        //             console.log('edit response code', response)
        //         }
        //     })
        //Close Modal
        emit('onCloseModal')
    };

    //----------Lifecycle Hooks----------//
    onBeforeMount(()=> {
        console.log('lesson is: ', props.data)
        //Get Playlist Name
        const title = props.data.fields.find(field => field.key === 'title');
        state.title = title.value;
        //Set Reactive Values
        state.duration = props.data.duration;
        state.start_second = props.data.start_second;
        state.end_second = props.data.end_second;
    })

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="ttw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Set Start/End Time</h2>
        <p class="tw-italic tw-text-sm tw-w-full tw-text-[#00101D] dark:tw-text-[#7E9AB1] tw-text-center tw-mb-2">Please enter time in 00:00:00 format</p>

        <div class="tw-flex tw-pt-[29px]">
            <InputLabel :maskaConfig="{  dataMaska: 'T#:T#:T#', maskaTokens: 'T:[0-5]' }"
                        :initialValue="duration_formatted(state.start_second) || '00:00:00'" 
                        labelValue="Start Time" 
                        placeholder="00:00:00" 
                        inputOverride="!tw-rounded-[8px] tw-ml-[13px] tw-w-full tw-bg-[#000]/[.05]" 
                        @onChange="handleStartTimeChange" 
            />
            <InputLabel :maskaConfig="{  dataMaska: 'T#:T#:T#', maskaTokens: 'T:[0-5]' }" 
                        :initialValue="duration_formatted(state.end_second) || duration_formatted(data.duration) || '00:00:00'"
                        labelValue="End Time" 
                        placeholder="00:00:00" 
                        inputOverride="!tw-rounded-[8px] tw-ml-[13px] tw-w-full tw-bg-[#000]/[.05]" 
                        @onChange="handleEndTimeChange" 
            />
        </div>
        <div class="tw-pt-[30px] tw-flex tw-justify-end tw-w-full">
            <!-- Close Modal -->
            <button @click="() => emit('onCloseModal')"
                    class="tw-btn-primary tw-btn-small tw-text-base dark:tw-text-white tw-text-[#0D0D0D] hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-w-[218px]">
                    CANCEL
            </button>
            <!-- Delete Lesson -->
            <button :class="`tw-mb-2 tw-btn-primary tw-btn-small tw-text-base tw-bg-${brand} tw-px-[30px] tw-w-[218px]`"
                    @click.prevent="handleConfirm()"
            >
                CONFIRM
            </button>
        </div>
    </div>
</template>