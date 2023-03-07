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
        duration: {
            hrs: 0,
            min: 0,
            sec: 0,
        },
        start: {
            hrs: 0,
            min: 0,
            sec: 0,
        },
        end: {
            hrs: 0,
            min: 0,
            sec: 0,            
        }
    })

    //-----------Methods-----------//

    //Format Duration (in seconds)
    const splitSeconds = (type, seconds) => {
        let time = seconds;
        if( time ) { //does it exist
            const hrs = Math.floor(time / 3600);
            const min = Math.floor(time / 60);
            const sec = time - min * 60;
            if(type==='start') {
                state.start.hrs = hrs;
                state.start.min = min;
                state.start.sec = sec;
            } else if (type==='end') {
                state.end.hrs = hrs;
                state.end.min = min;
                state.end.sec = sec;
            } else {
                state.duration.hrs = hrs;
                state.duration.min = min;
                state.duration.sec = sec;
            }
        }
    }

    const getSeconds = (hrs, min, sec) => {
        const hrsInSecs = hrs*3600;
        const minInSecs = min*60;
        return hrsInSecs+minInSecs+sec;
    }

    //Send request
    const handleConfirm = () => {
        const payload = {
            user_playlist_item_id: props.data.user_playlist_item_id,
            position: props.index,
            start_second: getSeconds(state.start.hrs,state.start.min,state.start.sec),
            end_second: getSeconds(state.end.hrs,state.end.min,state.end.sec),
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
                if (response.status === 201) {
                    //show success message
                    window.shownotification({
                        icon: 'fa-pen-to-square',
                        text: `You have successfully set the Start and End time of '${state.title}'`
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
        const title = props.data.fields.find(field => field.key === 'title');
        state.title = title.value;
        //Format start/end values
        let startTime = props.data.start_second || 0;
        let endTime = props.data.end_second || props.data.duration || 0;
        let durationTime = props.data.duration || 0;
        //Get HrsMinSec Values
        splitSeconds('duration', durationTime)
        splitSeconds('start', startTime );
        splitSeconds('end', endTime );
    })

</script>
<template>
    <div class="tw-h-full tw-w-full">
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">Set Start/End Time</h2>
        
        <div class="tw-flex tw-pt-[29px] tw-pb-4">
            <!-- Start Time -->
            <div class="tw-w-full tw-flex-col tw-px-3">
                <p class="tw-text-sm tw-pb-[5px] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-1">Start Time</p>
                <div class="tw-flex">
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number"
                               v-model="state.start.hrs"
                               placeholder="00"
                        >
                        <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">HRS</span>
                    </label>
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number" 
                               max="59"
                               v-model="state.start.min"
                               placeholder="00"
                        >
                         <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">MIN</span>
                    </label>
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number" 
                               max="59"
                               v-model="state.start.sec"
                               placeholder="00"
                        >
                        <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">SEC</span>
                    </label>
                </div>
            </div>
            <!-- End Time -->
            <div class="tw-w-full tw-flex-col tw-px-3">
                <p class="tw-text-sm tw-pb-[5px] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-1">End Time</p>
                <div class="tw-flex">
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number" 
                               v-model="state.end.hrs"
                               placeholder="00"
                        >
                        <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">HRS</span>
                    </label>
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number" 
                               max="59"
                               v-model="state.end.min"
                               placeholder="00"
                        >
                         <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">MIN</span>
                    </label>
                    <label class="tw-flex tw-flex-col tw-items-center tw-px-1" for="">
                        <input class="tw-text-center tw-py-[9px] placeholder:tw-text-[#0D0D0D] dark:placeholder:tw-text-white tw-text-[#0D0D0D] dark:tw-text-white tw-w-full tw-bg-[#000]/[.05] dark:tw-bg-[#00101D] tw-px-[14px] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[8px] tw-text-[14px]" 
                               id=""
                               v-maska
                               data-maska="##"
                               data-maska-eager 
                               type="number" 
                               max="59"
                               v-model="state.end.sec"
                               placeholder="00"
                        >
                        <span class="tw-pt-1 tw-text-xs tw-text-[#00101D] dark:tw-text-[#9EC0DC]">SEC</span>
                    </label>
                </div>
            </div>
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