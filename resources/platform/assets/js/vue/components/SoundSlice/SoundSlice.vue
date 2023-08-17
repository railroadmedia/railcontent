<script setup>
import { onMounted, onBeforeUnmount, ref, reactive } from 'vue';
import LoadingAnimation from '../../vuesora/components/LoadingAnimation/LoadingAnimation.vue';
import ProgressTracker from '../../vuesora/assets/js/classes/progress-tracker';
import ContentService from "../../vuesora/assets/js/services/content";
import { openDB, saveToDB, getFromDB, storeExists } from "../../../services/indexedDB";

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
const ssiframeReady = ref(false);
const progressTrackerEventListener = ref(null);

//Static 
let progressTracker = new ProgressTracker(); //????
let intervalId = null;

//IndexedDB Settings
const dbName = "SoundSliceDB";
const globalStore = "globalSettings";
const uniqueStore = props.soundsliceSlug;

//Reactive Objects
const localSettings = reactive({
    startTime: 0,
    track: false, 
    speed: 0,
    countIn: 0,
    metronome: false,
    transposition: 0, 
});

/**********************  
    Methods
**********************/

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
    openDB(dbName).then(db => {
        saveToDB(db, globalStore, 'volume', val)
    })
}, 250);
//Update Zoom Value
const saveZoom = debounce(function(val){
    openDB(dbName).then(db => {
        saveToDB(db, globalStore, 'zoom', val)
    })
}, 250);
//Update Layout Value
const saveLayout = (val) => {
    openDB(dbName).then(db => {
        saveToDB(db, globalStore, 'layout', val)
    })
};
//Save Audio Source Value
const saveAudioSource = (val) => {
    openDB(dbName).then(db => {
        saveToDB(db, uniqueStore, 'audio_source', val)
    })
};

//listen For Soundslice Events....
const handleSoundsliceEvent = (event) => {
    if (event.origin === 'https://www.soundslice.com') {
        const cmd = JSON.parse(event.data);
        switch (cmd.method) {
            //GLOBAL SETTINGS
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
                localSettings.startTime = Math.floor(cmd.arg);
                //Start Counter
                if(isPlaying.value) startCounter();
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
                if (false && props.autoplay) {
                    setTimeout(() => {
                        const soundsliceWrapper = document.getElementById('soundslice-container');
                        const { x, y } = soundsliceWrapper.getBoundingClientRect();
                        click(x + 153, y + 130);
                        console.log('done calling')
                    }, 600);
                }
                break;
        }
    }
};

const sendProgressTracking = () => {
    progressTracker.send({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });
}

//Counters
const startCounter = () => {
    intervalId = setInterval( ()=> {
        if ( localSettings.startTime < endTime.value ) {
            localSettings.startTime ++;

            //SAVE TO LOCAL STORAGE { settingType, value }
            localStorage.setItem("SS_startTime", JSON.stringify(localSettings.startTime));
        } else {
            clearInterval(intervalId);
        }
    }, 1000)                 
}
const stopCounter = () => {
    clearInterval(intervalId);
}

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

const handlePause = () => {
    progressTracker.stop();
    stopCounter();
}

const iframeReady = () => {
    ssiframeReady.value = true;
}

//Load Global Settings 
const loadGlobalSettings = () => {
    openDB(dbName).then(db => {
        return getFromDB(db, globalStore, 'volume');
    })
    .then(data => {
        ssiframe.value.contentWindow.postMessage(`{"method": "setVolume", "arg": ${data}}`, 'https://www.soundslice.com');
        isLoading.value = false;
    })
}
//Load Unique Settings
const loadUniqueSettings = () => {
    openDB(dbName).then(db => {
        // return getFromDB(db, uniqueStore, 'volume');
    })
    .then(data => {
        ssiframe.value.contentWindow.postMessage(`{"method": "setVolume", "arg": ${data}}`, 'https://www.soundslice.com');
        isLoading.value = false;
    })
}


/**********************  
    Lifecycle Hooks
**********************/
onMounted(() => {
    window.addEventListener('message', handleSoundsliceEvent);
    document.addEventListener('keyup', spacebarToPlayPause);

    //Check if Soundslice store exists in DB
    storeExists(dbName, uniqueStore).then(exists => {
        if (exists) {
            //Load Data
            if(ssiframeReady.value) {
                loadUniqueSettings
            } else {
                ssiframe.value.addEventListener('load', loadUniqueSettings);
            }
        } else {
            //Initialize New Store in DB
            openDB(dbName, `${uniqueStore}`).then(db => {
                saveToDB(db, uniqueStore, 'current_time', 0);
                saveToDB(db, uniqueStore, 'audio_source', 1);
            });
        }
    })
    //Check if globalSettings exist
    storeExists(dbName, globalStore).then(exists => {
        if (exists) {
            //Load Data
            if(ssiframeReady.value) {
                loadGlobalSettings
            } else {
                ssiframe.value.addEventListener('load', loadGlobalSettings);
            }
        } else {
            //Initialize New Store in DB
            openDB(dbName, `${globalStore}`).then(db => {
                saveToDB(db, globalStore, 'volume', 1);
                saveToDB(db, globalStore, 'zoom', 0);
                saveToDB(db, globalStore, 'layout', 4);
            })
        }
    })
});

onBeforeUnmount(() => {
    progressTracker.sendAsync({
        mediaId: props.contentId,
        mediaType: 'assignment',
        mediaCategory: 'soundslice',
    });

    progressTracker = null;

    ssiframe.value.removeEventListener('load', loadGlobalSettings);
    window.removeEventListener('unload', () => sendProgressTracking);
    window.removeEventListener('message', handleSoundsliceEvent);
    document.removeEventListener('keyup', spacebarToPlayPause);
});
</script>

<template>
    <div v-if="soundsliceSlug" class="tw-h-full tw-w-full tw-relative" :class="{ 'lg:-tw-ml-[256px]': isLoading }">
        <div class="flex flex-column tw-h-full">
            <slot name="soundsliceControls"></slot>
            <div class="flex flex-row grow">
                <div id="soundslice-container" class="flex flex-column relative">
                    <iframe 
                        ref="ssiframe"
                        id="ssEmbed"
                        :src="'https://www.soundslice.com/' + scoreOrSlice() + '/' + soundsliceSlug + '/embed/?api=1&scroll_type=2&branding=0&top_controls=1&u=' + userId + additionalParams"
                        frameBorder="0" allowfullscreen @load="iframeReady()"></iframe>
                </div>
            </div>
        </div>
        <div v-if="isLoading" class="loading-exercise heading">
            <LoadingAnimation :theme-color="themeColor" />
        </div>
    </div>
</template>
