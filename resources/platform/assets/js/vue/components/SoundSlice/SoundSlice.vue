<script setup>
import { onMounted, onBeforeMount, onBeforeUnmount, reactive, ref} from 'vue';
import LoadingAnimation from '../../vuesora/components/LoadingAnimation/LoadingAnimation.vue';
import ProgressTracker from '../../vuesora/assets/js/classes/progress-tracker';
import ContentService from "../../vuesora/assets/js/services/content";

//Props
const props = defineProps({
    themeColor: {
        type: String,
        default: () => 'drumeo',
    },
    additionalParams: {
        type: String,
        default: '',
    },
    soundsliceSlug: {
        type: String,
        default: () => '',
    },
    userId: {
        type: [Number, String],
        default: () => 0,
    },
    contentId: {
        type: [Number, String]
    },
    autoplay: {
        type: Boolean,
        default: false,
    },
    forceStartTime: {
        type: Boolean,
        default: false,
    },
    loop: {
        type: Boolean,
        default: false,
    },
    startTime: {
        type: Number,
        default: 0,
    },
    endTime: {
        type: Number,
        default: null,
    }
});

//Emits
const emit = defineEmits(['onAudioEnd']);

const scoreOrSlice = () => {
    if (/^\d+$/.test(props.soundsliceSlug)) {
        return 'scores';
    }
    return 'slices';
};

//Refs
const isPlaying = ref(false);
const isLoading = ref(true);
const hasBeenPlayed = ref(false);
const playEventsRan = ref(0);
const endTime = ref(30); //get end time depending on user settings
const ssiframe = ref(null);
const progressTrackerEventListener = ref(null);
const ssURL = ref(`https://www.soundslice.com/${scoreOrSlice()}/${props.soundsliceSlug}/embed/?api=1&scroll_type=2&branding=0&recording_idx=2&top_controls=1&u=${props.userId}${props.additionalParams}`);

//Static 
let progressTracker = new ProgressTracker(); //????
let intervalId = null;


//Reactive Objs
const globalSettings = reactive({
    volume: 1,
    zoom: 0,
    layout: 4,
});
const uniqueSettings = reactive({
    time: 0,
    audioSource: null,
});

/**********************  
    Methods
**********************/
const handlePlay = (event) => {
    playEventsRan.value ++; //HACK: SoundSlice is sending 2 messages on 'ssPlay'
    
    //Start Counter
    if(playEventsRan.value > 1) {
        ssiframe.value.contentWindow.postMessage('{"method": "getCurrentTime"}', 'https://www.soundslice.com');
    }
    //Update Content Service
    if (!hasBeenPlayed.value) {
        hasBeenPlayed.value = true;
        ContentService.markContentAsStarted(props.contentId);
    }
    //Progress Tracker
    progressTracker.start();
    if (!progressTrackerEventListener.value) {
        progressTrackerEventListener.value = true;
        window.addEventListener('unload', sendProgressTracking);
    }
}

const handlePause = () => {
    progressTracker.stop();
    stopCounter();
}

const sendProgressTracking = () => {
    progressTracker.send({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });
}

const spacebarToPlayPause = (event) => {
    if (event.keyCode === 32) {
        event.preventDefault();
        if (isPlaying.value) {
            ssiframe.value.contentWindow.postMessage('{"method": "pause"}', 'https://www.soundslice.com');
        } else {
            ssiframe.value.contentWindow.postMessage('{"method": "play"}', 'https://www.soundslice.com');
        }
    }
};

//Counter
const startCounter = (currentTime) => {
    intervalId = setInterval( ()=> {
        if ( currentTime < endTime.value ) {
            currentTime ++;
            //SET Current Time
            saveCurrentTime(currentTime);
        } else {
            clearInterval(intervalId);
        }
    }, 1000)                 
}
const stopCounter = () => {
    clearInterval(intervalId);
}

//DEBOUNCE
const debounce = (cb, delay = 1000) => {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout( ()=> {
            cb(...args)
        }, delay)
    }; 
}

//SET Volume
const saveVolume = debounce(function(val){
    localStorage.setItem("ssVolume", val);
}, 250);
//SET Layout
const saveLayout = (val) => {
    localStorage.setItem("ssLayout", val);
};
//SET Zoom
const saveZoom = debounce(function(val){
    //localStorage.setItem("ssZoom", val);
}, 250);
//SET Audio Source 
const saveAudioSource = (val) => {
    //localStorage.setItem(`${ props.soundsliceSlug }_audioSource`, val);
};
//SET Current Time
const saveCurrentTime = (val) => {
    localStorage.setItem(`${ props.soundsliceSlug }_currentTime`, val);
}

//listen For Soundslice Events....
const handleSoundsliceEvent = (event) => {
    if (event.origin === 'https://www.soundslice.com') {
        const cmd = JSON.parse(event.data);
        switch (cmd.method) {
            //GLOBAL SETTINGS
            case 'ssPlayerReady':
                break 
            case 'ssNotationLoaded':
                //Get Duration
                ssiframe.value.contentWindow.postMessage(`{"method": "getDuration" }`, 'https://www.soundslice.com');
                
                //Set Volume
                ssiframe.value.contentWindow.postMessage(`{"method": "setVolume", "arg": ${globalSettings.volume} }`, 'https://www.soundslice.com');
                
                //Set Zoom
                //ssiframe.value.contentWindow.postMessage(`{"method": "setZoom", "arg": ${globalSettings.zoom} }`, 'https://www.soundslice.com');
                //Set Audio Source
                // if(uniqueSettings.audioSource) {
                //     ssiframe.value.contentWindow.postMessage(`{"method": "changeAudioByIndex", "arg": "${uniqueSettings.audioSource}" }`, 'https://www.soundslice.com');
                // }

                //Get Current Time
                ssiframe.value.contentWindow.postMessage(`{"method": "seek", "arg": ${uniqueSettings.time} }`, 'https://www.soundslice.com');
                
                //Set Loop
                if(props.loop) ssiframe.value.contentWindow.postMessage(`{"method": "setLoop", "arg": [${props.startTime}, ${props.endTime}]}`, 'https://www.soundslice.com');
                
                //Done
                isLoading.value = false;
                break
            case 'ssDuration':
                endTime.value = cmd.arg;
                break
            case 'ssSeek':
                //SET Current Time
                saveCurrentTime( Math.floor(cmd.arg) );
                break;
            case 'ssVolumeChange': 
                ssiframe.value.contentWindow.postMessage('{"method": "getVolume"}', 'https://www.soundslice.com');
                break;
            case 'ssVolume':
                saveVolume(cmd.arg)
                break
            case 'ssLayoutChange':
                saveLayout(cmd.arg)
                break
            case 'ssZoom':
                saveZoom(cmd.arg);
                break
            //UNIQUE SETTINGS
            case 'ssCurrentTime':
                //Start Counter
                if(isPlaying.value && uniqueSettings.audioSource !== "0") startCounter(Math.floor(cmd.arg));
                break
            case 'ssAudioSourceChanged':
                stopCounter();
                saveAudioSource(cmd.arg)
                break;
            //PLAYBACK SETTINGS
            case 'ssPlay':
                isPlaying.value = true;
                handlePlay(event);
                if(isPlaying.value && uniqueSettings.audioSource === "0") startCounter(Math.floor(cmd.arg));
                break;
            case 'ssPause':
                isPlaying.value = false;
                handlePause();
                break;
            case 'ssAudioEnd':
                const isRepeatOn = localStorage.getItem("playbackRepeatOn") ? JSON.parse(localStorage.getItem("playbackRepeatOn")) : false;
                const isInPlaybackMode = window.location.href.includes('playlist-item');
                if (isRepeatOn && isInPlaybackMode) {
                    ssiframe.value.contentWindow.postMessage('{"method": "seek", "arg": 0}', 'https://www.soundslice.com');
                    ssiframe.value.contentWindow.postMessage('{"method": "play"}', 'https://www.soundslice.com');
                } else {
                    emit('onAudioEnd');
                }
                break;
            case 'ssAudioLoaded':
                if (props.autoplay) {
                    //Do Something on Autoplay....
                }
                break;
        }
    }
};

/**********************  
    Lifecycle Hooks
**********************/
onBeforeMount(()=> {
    let url = new URL(ssURL.value);
    let params = new URLSearchParams(url.search);

    //GET Volume
    if(localStorage.getItem("ssVolume")) {
        globalSettings.volume = localStorage.getItem("ssVolume");
    }
    //GET Current Time
    if(!props.forceStartTime) {
        if(localStorage.getItem(`${ props.soundsliceSlug }_currentTime`) ) {
            uniqueSettings.time = localStorage.getItem(`${ props.soundsliceSlug }_currentTime`);
        }
    } else {
        uniqueSettings.time = props.startTime;
    }


    //GET Layout
    if(localStorage.getItem("ssLayout")) {
        globalSettings.layout = localStorage.getItem("ssLayout");
        params.set('layout', globalSettings.layout);
        url.search = params.toString();
        ssURL.value = url.toString();
    }

    //GET Zoom
    // if(localStorage.getItem("ssZoom")) {
    //     globalSettings.zoom = localStorage.getItem("ssZoom");
    // }

    //GET Audio Source
    // if(localStorage.getItem(`${ props.soundsliceSlug }_audioSource`)) {
    //     uniqueSettings.audioSource = localStorage.getItem(`${ props.soundsliceSlug }_audioSource`);
    //     params.set('recording_idx', uniqueSettings.audioSource);
    //     url.search = params.toString();
    //     ssURL.value = url.toString();
    // }
})

onMounted(() => {
    window.addEventListener('message', handleSoundsliceEvent);
    document.addEventListener('keyup', spacebarToPlayPause);
});

onBeforeUnmount(() => {
    progressTracker.sendAsync({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });
    progressTracker = null;
    window.removeEventListener('unload', () => sendProgressTracking);
    window.removeEventListener('message', handleSoundsliceEvent);
    document.removeEventListener('keyup', spacebarToPlayPause);
});
</script>

<template>
    <div v-if="soundsliceSlug" class="tw-h-full tw-w-full tw-relative">
        <div class="flex flex-column tw-h-full">
            <slot name="soundsliceControls"></slot>
            <div class="flex flex-row grow">
                <div id="soundslice-container" class="flex flex-column relative">
                    <iframe 
                        ref="ssiframe"
                        id="ssEmbed"
                        :src="ssURL"
                        frameBorder="0" allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
        <div v-if="isLoading" class="loading-exercise heading">
            <LoadingAnimation :theme-color="themeColor" />
        </div>
    </div>
</template>