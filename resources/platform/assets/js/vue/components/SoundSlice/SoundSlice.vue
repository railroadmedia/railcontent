<script setup>
import { onMounted, onBeforeMount, onBeforeUnmount, reactive, ref} from 'vue';
import LoadingAnimation from '../../vuesora/components/LoadingAnimation/LoadingAnimation.vue';
import ProgressTracker from '../../vuesora/assets/js/classes/progress-tracker';
import ContentService from "../../vuesora/assets/js/services/content";
import { openDB, saveToDB, getMultipleFromDB, storeExists } from "../../../services/indexedDB";

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
const globalStore = "globalSettings";
const uniqueStore = props.soundsliceSlug;

//Reactive Objs
const globalSettings = reactive([    
    {
        name: "volume",
        method: "setVolume",
        value: 1
    },
    {
        name: "zoom",
        method: "setZoom",
        value: 0
    }
]);
const uniqueSettings = reactive([
    {
        name: 'current_time',
        method: "seek",
        value: 1
    },
    {
        name: 'audio_source',
        method: "changeAudioByIndex",
        value: 1
    }
])

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
            case 'ssPlayerReady':
                //Set Volume
                console.log(globalSettings[0].method, globalSettings[0].value)
                ssiframe.value.contentWindow.postMessage(`{"method": "${globalSettings[0].method}", "arg": ${globalSettings[0].value} }`, 'https://www.soundslice.com');
                //Set CurrentTime
                ssiframe.value.contentWindow.postMessage(`{"method": "${uniqueSettings[0].method}", "arg": ${uniqueSettings[0].value} }`, 'https://www.soundslice.com');
                //Set Audio Source
                ssiframe.value.contentWindow.postMessage(`{"method": "${uniqueSettings[1].method}", "arg": ${uniqueSettings[0].value} }`, 'https://www.soundslice.com');
                isLoading.value = false;
                break 
            case 'ssNotationLoaded':
                //Set Zoom
                ssiframe.value.contentWindow.postMessage(`{"method": "${globalSettings[1].method}", "arg": "${globalSettings[1].value}" }`, 'https://www.soundslice.com');
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

//Counters
const startCounter = (currentTime) => {
    intervalId = setInterval( ()=> {
        if ( currentTime < endTime.value ) {
            currentTime ++;
            //SAVE TO LOCAL STORAGE { settingType, value }
            localStorage.setItem("SS_startTime", JSON.stringify(currentTime));
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

//Load Global Settings 
const loadSettings = (storeName, settings) => {
    const keys = settings.map(key => key.name);
    openDB(dbName, storeName)
        .then(db => {
            return getMultipleFromDB(db, storeName, keys)
        }) 
        .then(values => {
            settings.forEach((setting,i) => {
                setting.value = values[i];
            })
            console.log(storeName, settings)
        })   
        .catch(error => {
            console.log("Error:", error)
        })
}

/**********************  
    Lifecycle Hooks
**********************/
onBeforeMount(()=> {
    //Load Global Settings
    loadSettings(globalStore, globalSettings)
    //Load Local Settings
    loadSettings(uniqueStore, uniqueSettings)
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
