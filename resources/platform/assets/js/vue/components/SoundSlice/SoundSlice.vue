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

//Static 
let progressTracker = new ProgressTracker(); //????
let intervalId = null;

//IndexedDB Settings
const dbName = "SoundSliceDB";

//Reactive Objs
const globalSettings = reactive({
    volume: 1,
    zoom: 0,
});
const uniqueSettings = reactive({
    time: 1,
    audioSource: 1,
})

/**********************  
    Methods
**********************/

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

const click = (x, y) => {
    var ev = new MouseEvent('click', {
        'view': window,
        'bubbles': true,
        'cancelable': true,
        'screenX': x,
        'screenY': y
    });
    var el = document.elementFromPoint(x, y);
    el.dispatchEvent(ev);
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
//Update Volume Value
const saveVolume = debounce(function(val){
    localStorage.setItem("ssVolume", val);
}, 250);
//Update Zoom Value
const saveZoom = debounce(function(val){
    localStorage.setItem("ssZoom", val);
}, 250);
//Save Audio Source Value
const saveAudioSource = (val) => {
    localStorage.setItem("ssAudioSource", val);
};

//Counters
const startCounter = (currentTime) => {
    intervalId = setInterval( ()=> {
        if ( currentTime < endTime.value ) {
            currentTime ++;
            //Save currentTime
            console.log(currentTime)
            localStorage.setItem(`${ props.soundsliceSlug }_currentTime`, currentTime);
        } else {
            clearInterval(intervalId);
        }
    }, 1000)                 
}
const stopCounter = () => {
    clearInterval(intervalId);
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
                //Set Volume
                ssiframe.value.contentWindow.postMessage(`{"method": "setVolume", "arg": ${globalSettings.volume} }`, 'https://www.soundslice.com');
                //Set Zoom
                ssiframe.value.contentWindow.postMessage(`{"method": "setZoom", "arg": ${globalSettings.zoom} }`, 'https://www.soundslice.com');
                //Set Audio Source
                ssiframe.value.contentWindow.postMessage(`{"method": "changeAudioByIndex", "arg": "${uniqueSettings.audioSource}" }`, 'https://www.soundslice.com');
                //Get Current Time
                ssiframe.value.contentWindow.postMessage(`{"method": "seek", "arg": ${uniqueSettings.time} }`, 'https://www.soundslice.com');
                //Done
                isLoading.value = false;
                break
            case 'ssVolumeChange': 
                ssiframe.value.contentWindow.postMessage('{"method": "getVolume"}', 'https://www.soundslice.com');
                break;
            case 'ssVolume':
                saveVolume(cmd.arg)
                break
            case 'ssZoom':
                saveZoom(cmd.arg)
                break
            case 'ssLayoutChange':
                saveLayout(cmd.arg)
                break
            //UNIQUE SETTINGS
            case 'ssCurrentTime':
                console.log('ssCurrentTime')
                //Start Counter
                if(isPlaying.value) startCounter(Math.floor(cmd.arg));
                break
            case 'ssSpeed ':
                console.log('speed', cmd.arg)
                break
            case 'ssAudioSourceChanged':
                saveAudioSource(cmd.arg)
                break;
            //PLAYBACK SETTINGS
            case 'ssPlay':
                handlePlay(event);
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

const handlePlay = (event) => {
    isPlaying.value = true;
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

/**********************  
    Lifecycle Hooks
**********************/
onBeforeMount(()=> {
    //Global Settings
    if(localStorage.getItem("ssVolume")) {
        globalSettings.volume = localStorage.getItem("ssVolume");
    }
    if(localStorage.getItem("ssZoom")) {
        globalSettings.zoom = localStorage.getItem("ssZoom");
    }
    //Unique Settings
    if(localStorage.getItem("ssAudioSource")) {
        uniqueSettings.audioSource = localStorage.getItem("ssAudioSource");
    }
    //Get CurrentTime
    if(localStorage.getItem(`${ props.soundsliceSlug }_currentTime`)) {
        uniqueSettings.time = localStorage.getItem(`${ props.soundsliceSlug }_currentTime`);
    }
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
                        :src="'https://www.soundslice.com/' + scoreOrSlice() + '/' + soundsliceSlug + '/embed/?api=1&scroll_type=2&branding=0&top_controls=1&u=' + userId + additionalParams"
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
