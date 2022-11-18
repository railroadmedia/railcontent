<!-- Composition API -->
<script setup>
import { ref, onMounted, onBeforeUnmount, computed, onUpdated } from 'vue';
import shaka from 'shaka-player';
import Utils from '../../assets/js/helper-functions/utils.js';
import Screenfull from 'screenfull';
import ContentService from '../../assets/js/services/content';
import PlayerUtils from './player-utils';
import ChromeCastPlugin from './chromecast';
// import ThemeClasses from '../../mixins/ThemeClasses';
import PlayerButton from './_PlayerButton.vue';
import PlayerProgress from './_PlayerProgress.vue';
import PlayerVolume from './_PlayerVolume.vue';
import PlayerSettings from './_PlayerSettings.vue';
import PlayerCaptions from './_PlayerCaptions.vue';
// import EventHandlers from './event-handlers';
import LoadingAnimation from '../LoadingAnimation/LoadingAnimation.vue';
import PlayerShortcuts from './_PlayerShortcuts.vue';
import PlayerError from './_PlayerError.vue';
import PlayerRanges from './_PlayerRanges.vue';
import Intercom from '../../assets/js/services/intercom';
import Helpscout from '../../assets/js/services/helpscout';
import useEventHandlers from './useEventHandlers.js';

const props = defineProps({
    contentType: {
        type: String,
    },
    themeColor: {
        type: String,
    },
    useThemeColor: {

        type: Boolean,
    },
    brand: {
        type: String,
        default: () => 'drumeo',
    },

    hlsManifestUrl: {
        type: String,
        default: () => null,
    },

    sources: {
        type: Array,
        default: () => [],
    },

    captions: {
        type: String,
        default: () => null,
    },

    poster: {
        type: String,
        default: () => null,
    },

    chapters: {
        type: Array,
        default: () => [],
    },

    currentSecond: {
        type: [Number, String],
        default: () => 0,
    },

    contentId: {
        type: [Number, String],
        default: () => null,
    },

    videoId: {
        type: [Number, String],
        default: () => null,
    },

    castTitle: {
        type: String,
        default: () => '',
    },

    useKeyboard: {
        type: Boolean,
        default: () => true,
    },

    controls: {
        type: Object,
        default: () => ({
            chromecast: true,
            airplay: true,
            forward: true,
            backward: true,
            progress: true,
            play: true,
            time: true,
            volume: true,
            settings: true,
            fullscreen: true,
            captions: true,
        }),
    },

    useIntersectionObserver: {
        type: Boolean,
        default: () => true,
    },

    ranges: {
        type: Object,
        default: () => ({}),
    },

    rangesVideoIds: {
        type: Object,
        default: () => ({}),
    },

    showRangeButtons: {
        type: Boolean,
        default: () => false,
    },
});

const emit = defineEmits('play', 'pause', 'canplaythrough', 'loadedmetadata', 'durationchange', 'waiting', 'playing', 'timeupdate', 'cc-time', 'cc-playpause', 'cc-media', 'cc-disconnect', 'cc-state');

// Non reactive vars
let shakaPlayer = null;

const mediaElement = ref(null);
const isShakaInitialized = ref(false);

// Template refs
const container = ref(null);
const player = ref({});
const contextMenu = ref(null);
const videoWrap = ref(null);

// Data refs
const source = ref(props.hlsManifestUrl);
const loading = ref(false);
const playerError = ref(false);
const playerErrorCode = ref(null);
const isFullscreen = ref(false);
const showContextMenu = ref(false);
const textTracks = ref([]);
const currentTextTrackLanguage = ref(null);
const playerReady = ref(false);
const userActive = ref(true);
const userActiveTimeout = ref(null);
const isPlaying = ref(false);
const lastPlayPauseToggleTime = ref(Date.now());
const currentTime = ref(0);
const totalDuration = ref(0);
const mousedown = ref(false);
const currentMouseX = ref(0);
const currentVolume = ref(1);
const settingsDrawer = ref(false);
const captionsDrawer = ref(false);
const chromeCast = ref(null);
const isChromeCastSupported = ref(false);
const isChromeCastConnected = ref(false);
const isAirplaySupported = ref(false);
const isAirplayConnected = ref(false);
const performanceNow = ref(0);
const currentMousePosition = ref({ x: 0, y: 0 });
const contextMenuPosition = ref(null);
const isPipEnabled = ref(false);
const isExperimentalPictureInPictureEnabled = ref(false);
const isKeyboardControlsEnabled = ref(false);
const hasBeenPlayed = ref(false);
const currentPlaybackRate = ref(1);
const hasRetriedSource = ref(false);
const dialogs = ref({
    stats: false,
    keyboardShortcuts: false,
});
const intersection = ref(null);
const timeouts = ref({
    controlWrapClick: null,
    isTransitioning: null,
});
const isTransitioning = ref(false);
const currentRange = ref('original');

defineExpose({
    ...props,
    source,
    loading,
    playerError,
    playerErrorCode,
    isFullscreen,
    showContextMenu,
    textTracks,
    currentTextTrackLanguage,
    playerReady,
    userActive,
    userActiveTimeout,
    isPlaying,
    lastPlayPauseToggleTime,
    currentTime,
    totalDuration,
    mousedown,
    currentMouseX,
    currentVolume,
    settingsDrawer,
    captionsDrawer,
    chromeCast,
    isChromeCastSupported,
    isChromeCastConnected,
    isAirplaySupported,
    isAirplayConnected,
    performanceNow,
    currentMousePosition,
    contextMenuPosition,
    isPipEnabled,
    isExperimentalPictureInPictureEnabled,
    isKeyboardControlsEnabled,
    hasBeenPlayed,
    currentPlaybackRate,
    hasRetriedSource,
});

//methods

function getDefaultPlaybackQualityIndex() {
    const widthToCheck = window.localStorage.getItem('vuesoraDefaultVideoQuality')
        || document.documentElement.clientWidth;
    const matchedQualities = playbackQualities.value.filter(quality => quality.width >= widthToCheck);
    return matchedQualities[0] || playbackQualities.value[0];
}

function getSource(src) {
    if (src) {
        source.value = src;
    } else {
        source.value = getDefaultPlaybackQualityIndex();
    }
}

function loadSource(src) {
    getSource(src);

    return new Promise((resolve) => {
        mediaElement.value.src = source.value.file;

        setTimeout(() => {
            resolve();
        }, 100);
    });
}

function setRange({ range }) {
    if (props.ranges[range] && props.ranges[range].length) {
        currentRange.value = range;
        window.localStorage.setItem('currentRange', range);

        const { currentTime: currTime } = mediaElement.value;

        loadSource()
            .then(() => {
                setTimeout(() => {
                    seek(currTime);
                }, 200);
            });
    }
}

function initializePlayer(time) {
    const urlParams = new URLSearchParams(window.location.search);
    const timeToSeekTo = time || (urlParams.get('time') || window.localStorage.getItem(`${contentCurrentTimeStorageKey.value}_currentTime`) || props.currentSecond);

    if (parseInt(timeToSeekTo) !== parseInt(currentTime.value)) {
        seek(timeToSeekTo);
    }

    attachMediaElementEventHandlers();

    getDefaultVolume();

    if (mediaElement.value) {
        for (let i = 0, L = mediaElement.value.textTracks.length; i < L; i++) {
            const thisTextTrack = mediaElement.value.textTracks[i];

            if (thisTextTrack.label !== 'Shaka Player TextTrack') {
                textTracks.value.push(thisTextTrack);
            }

            if (window.localStorage.getItem('currentTextTrackLanguage') === thisTextTrack.language) {
                currentTextTrackLanguage.value = thisTextTrack.language;
            }

            if (!window.localStorage.getItem('currentTextTrackLanguage')) {
                currentTextTrackLanguage.value = null;
                thisTextTrack.mode = 'hidden';
            }
        }
    }

    // FULLSCREEN EVENT
    document.addEventListener('fullscreenchange', () => {
        isFullscreen.value = document.fullscreenElement != null;
    });

    if (props.useKeyboard) {
        enableKeyboardControls();
    }

    setTimeout(() => {
        hasRetriedSource.value = false;
        mediaElement.value.focus();
    }, 100);

    setInterval(() => {
        window.localStorage.setItem(`${contentCurrentTimeStorageKey.value}_currentTime`, currentTime.value);
    }, 2500);
}

function retryVimeoUrl(error) {
    hasRetriedSource.value = true;

    if (error.data.length < 2 && error.data[1] !== 410) {
        playerError.value = true;
        playerErrorCode.value = error.code;
    } else {
        loading.value = true;
        ContentService.getVimeoUrlByVimeoId($_videoId)
            .then((response) => {
                if (response) {
                    const hlsManifest = response.data.files.find(
                        file => file.quality === 'hls',
                    );

                    source.value = hlsManifest.link;
                    return loadSource();
                }
            })
            .then(() => {
                initializePlayer(currentTime.value);
            });
    }
}

function attachMediaElementEventHandlers() {
    Object.keys(mediaElementEventHandlers).forEach((event) => {
        mediaElement.value.addEventListener(
            event,
            mediaElementEventHandlers[event],
        );
    });
}

function getDefaultVolume() {
    if (window.localStorage.getItem('isMuted') != null) {
        changeVolume({
            volume: Number(0),
        }, false);

        return;
    }

    if (window.localStorage.getItem('playerVolume') != null) {
        changeVolume({
            volume: Number(window.localStorage.getItem('playerVolume')),
        });
    }
}

function playPause() {
    if (Date.now() - lastPlayPauseToggleTime.value < 200) {
        return;
    }

    lastPlayPauseToggleTime.value = Date.now();

    if (chromeCast.value && chromeCast.value.Connected && isChromeCastConnected.value) {
        chromeCast.value.playOrPause();
    } else if (isPlaying.value) {
        mediaElement.value.pause();
        isPlaying.value = false;
    } else {
        mediaElement.value.play();
        isPlaying.value = true;
    }
}

function playPauseViaControlWrap(event) {
    if (userActive.value || !isPlaying.value) {
        isTransitioning.value = true;
    }

    clearTimeout(timeouts.value.controlWrapClick);
    clearTimeout(timeouts.value.isTransitioning);

    if (event.detail === 1) {
        if (userActive.value || !isPlaying.value) {
            timeouts.value.controlWrapClick = setTimeout(() => {
                if (settingsDrawer.value || captionsDrawer.value || !canPlayPause.value) {
                    settingsDrawer.value = false;
                    captionsDrawer.value = false;

                    return;
                }

                setTimeout(() => {
                    playPause();
                }, 10);
            }, 500);
        }

        timeouts.value.isTransitioning = setTimeout(() => {
            isTransitioning.value = false;
        }, 300);
    }
}

function seek(time) {
    mediaElement.value.pause();
    const seekTime = Number(time) > 0 ? Math.round(Number(time)) : 0;

    currentTime.value = seekTime;

    if (isChromeCastConnected.value) {
        chromeCast.value.seek(seekTime);
    }

    mediaElement.value.currentTime = seekTime;
}

const fullscreen = () => {
    isTransitioning.value = false;

    // If we have access to the requestFullscreen API then use that
    if (Screenfull.enabled) {
        Screenfull.toggle(container.value);
    } else {
        /* copied */
        const video = document.getElementById('video-element-id');
        const rfs = video.requestFullscreen || video.webkitEnterFullScreen || video.webkitRequestFullScreen || video.mozRequestFullScreen || video.msRequestFullscreen;
        rfs.call(video);
    }
}

function changeVolume(payload, remember = true) {
    if (remember) {
        localStorage.setItem('playerVolume', payload.volume);
    }

    if (isChromeCastConnected.value) {
        chromeCast.value.volume(payload.volume);
        mediaElement.value.volume = 0;

        return;
    }

    mediaElement.value.volume = payload.volume / 100;
    currentVolume.value = mediaElement.value.volume;
}

const parseTime = time => PlayerUtils.parseTime(time)

function trackMousePosition(event) {
    currentMousePosition.value = PlayerUtils.getMousePosition(event, container.value);

    if (mediaElement.value) {
        Utils.triggerEvent(mediaElement.value, 'useractive');

        clearTimeout(userActiveTimeout.value);
        userActiveTimeout.value = setTimeout(() => {
            Utils.triggerEvent(mediaElement.value, 'userinactive');
        }, 3000);
    }
}

function setQuality(payload) {
    const { currentTime: currTime } = mediaElement.value;
    setDefaultPlaybackQualityWidth(payload.width);

    loadSource(payload)
        .then(() => {
            setTimeout(() => {
                seek(currTime);
            }, 200);
        });
}

function setRate(payload) {
    if (payload.rate > 0.25 && payload.rate <= 2) {
        mediaElement.value.playbackRate = payload.rate;
    }
}

function setDefaultPlaybackQualityWidth(width) {
    window.localStorage.setItem('vuesoraDefaultVideoQuality', width);
}

function toggleSettingsDrawer() {
    if (isChromeCastConnected.value) {
        return false;
    }

    captionsDrawer.value = false;
    settingsDrawer.value = !settingsDrawer.value;

    if (drawersShouldOpenFromBottom && settingsDrawer.value) {
        document.body.classList.add('drawer-open');
    }

    if (drawersShouldOpenFromBottom && !settingsDrawer.value) {
        document.body.classList.remove('drawer-open');
    }
}

function toggleCaptionsDrawer() {
    captionsDrawer.value = !captionsDrawer.value;
    settingsDrawer.value = false;

    if (drawersShouldOpenFromBottom && captionsDrawer.value) {
        document.body.classList.add('drawer-open');
    }

    if (drawersShouldOpenFromBottom && !captionsDrawer.value) {
        document.body.classList.remove('drawer-open');
    }
}

function closeDrawers() {
    settingsDrawer.value = false;
    captionsDrawer.value = false;
    showContextMenu.value = false;

    document.body.classList.remove('drawer-open');
}

function enableCaptions(payload) {
    if (payload) {
        textTracks.value[0].mode = 'showing';
        currentTextTrackLanguage.value = textTracks.value[0].language;
        window.localStorage.setItem('currentTextTrackLanguage', currentTextTrackLanguage.value);

    } else {
        textTracks.value[0].mode = 'hidden';
        currentTextTrackLanguage.value = null;
        window.localStorage.removeItem('currentTextTrackLanguage');
    }
}

function enableChromeCast() {
    chromeCast.value.cast({
        content: source.value,
        poster: props.poster,
        title: props.castTitle,
        subtitles: {
            active: false,
            srclang: 'en',
            src: props.captions,
        },
        time: currentTime.value,
        volume: currentVolume.value,
        muted: false,
        paused: false,
    });
}

function enableAirplay() {
    player.value.webkitShowPlaybackTargetPicker();
}

function keyboardControlEventHandler(event) {
    if (
        !event.ctrlKey
        && keyboardEventHandlers[event.code]
        && (!keyboardEventHandlersShift[event.code] || event.shiftKey)
    ) {
        event.stopPropagation();
        event.preventDefault();

        keyboardEventHandlers[event.code]();
    }
}

function triggerMouseDown(event) {
    if (event.button !== 2) {
        mousedown.value = true;
    }
}

function toggleContextMenu() {
    showContextMenu.value = true;
    setTimeout(() => {
        // 1ms timeout allows the browser to calculate the context menu dimensions properly
        getContextMenuPosition();
    }, 1);
}

function getContextMenuPosition() {
    const playerWidth = player.value.clientWidth ? player.value.clientWidth : 0;
    const playerHeight = player.value.clientHeight ? player.value.clientHeight : 0;
    const menuWidth = contextMenu.value ? contextMenu.value.clientWidth : 0;
    const menuHeight = contextMenu.value ? contextMenu.value.clientHeight : 0;

    let { x } = currentMousePosition.value;
    let { y } = currentMousePosition.value;

    if (x > (playerWidth - menuWidth)) {
        x = currentMousePosition.value.x - menuWidth;
    }

    if (y > (playerHeight - menuHeight)) {
        y = currentMousePosition.value.y - menuHeight;
    }

    contextMenuPosition.value = {
        transform: `translate(${x}px, ${y}px)`,
        'webkit-transform': `translate(${x}px, ${y}px)`,
    };
}

function mouseUpEventHandler(event) {
    if (event.button !== 2) {
        if (mousedown.value) {
            const timeToSeekTo = totalDuration.value * (
                PlayerUtils.getTimeRailMouseEventOffsetPercentage(
                    currentMousePosition.value.x,
                    player.value && player.value.clientWidth ? player.value.clientWidth : 0,
                )
            );
            seek(timeToSeekTo);
        }

        showContextMenu.value = false;
        mousedown.value = false;
    }
}

function openDialog(dialog) {
    const alreadyOpen = dialogs.value[dialog] === true;
    closeAllDialogs();

    if (!alreadyOpen) {
        dialogs.value[dialog] = true;
    }
}

function togglePip() {
    if (document.pictureInPictureEnabled) {
        toggleExperimentalPip();
    } else {
        toggleFakePip();
    }
}

function toggleFakePip() {
    isPipEnabled.value = !isPipEnabled.value;
    /*
    * Safari has a bug that doesn't trigger a repaint when the player
    * is put into PIP. The following hack will manually trigger the repaint
    * allowing the new styles to propagate.
    *
    * Curtis - July 2019
    * */
    videoWrap.value.style.display = 'none';
    setTimeout(() => {
        videoWrap.value.style.display = null;
    }, 50);
}

function toggleExperimentalPip() {
    return new Promise((resolve, reject) => {
        if (isExperimentalPictureInPictureEnabled.value) {
            document.exitPictureInPicture()
                .then(() => {
                    resolve();
                })
                .catch((error) => {
                    reject(error);
                });
        } else {
            mediaElement.value.requestPictureInPicture()
                .then(() => {
                    resolve();
                })
                .catch((error) => {
                    reject(error);
                });
        }
    });
}

function enableKeyboardControls() {
    document.addEventListener('keydown', keyboardControlEventHandler);
    isKeyboardControlsEnabled.value = true;

    document.addEventListener('focusin', (event) => {
        const path = event.path || (event.composedPath && event.composedPath());

        const isVideoPlayerElement = path.filter((el) => {
            if (typeof el.matches !== 'undefined' && el.matches('#lessonVideoWrap')) {
                return el;
            }
        }).length > 0;

        if (!isVideoPlayerElement) {
            document.removeEventListener('keydown', keyboardControlEventHandler);
            isKeyboardControlsEnabled.value = false;
        }
    });

    document.addEventListener('focusout', () => {
        if (!isKeyboardControlsEnabled.value) {
            document.addEventListener('keydown', keyboardControlEventHandler);
            isKeyboardControlsEnabled.value = true;
        }
    });
}

function closeAllDialogs() {
    Object.keys(dialogs.value).forEach((dialog) => {
        dialogs.value[dialog] = false;
    });
}

function enableIntersectionObserver(videoWrap) {
    intersection.value = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const isVisible = entry.intersectionRatio >= 0.5;
            isPipEnabled.value = !isVisible && !isMobileViewport.value && isPlaying.value;
        });
    }, {
        root: null,
        rootMargin: '0px',
        threshold: 0.5,
    });
    intersection.value.observe(videoWrap.parentElement);
}

function handleOverlayClick () {
    mediaElement.value.pause();
};

onMounted(() => {
    const supportsMSE = false;

    currentRange.value = window.localStorage.getItem('currentRange') || 'original';

    /*
    * Mux.js is required to mux TS streams into Mp4 on the fly, Shaka requires the
    * window.muxjs object to exist is order to accomplish this.
    *
    * Curtis, July 2019
    */
    // if (window.muxjs == null && supportsMSE) {
    //     window.muxjs = muxjs;
    // }

    shaka.polyfill.installAll()

    if (shaka.Player.isBrowserSupported() && !PlayerUtils.isIE()) {
        shakaPlayer = new shaka.Player();

        Object.keys(eventHandlers).forEach((event) => {
            shakaPlayer.addEventListener(event, eventHandlers[event]);
        });

        //mediaElement.value = player;
        shakaPlayer.attach(player.value)
            .then(() => {
                mediaElement.value = shakaPlayer.getMediaElement();

                shakaPlayer.configure({
                    abr: {
                        restrictions: {
                            maxHeight: window.screen.height,
                        },
                    },
                    streaming: {
                        bufferingGoal: 25,
                        rebufferingGoal: 10,
                        bufferBehind: 1000,
                        useNativeHlsOnSafari: true,
                    },
                });

                isShakaInitialized.value = true;

                return loadSource();
            })
            .then(() => {
                initializePlayer();
            })
            .catch((error) => {
                if (error.severity === 2) {
                    playerError.value = true;
                    playerErrorCode.value = error.code;
                }
            });

    } else {
        playerError.value = true;
        playerErrorCode.value = 'Browser Not Supported';
    }

    // Close drawers on any document click
    document.addEventListener('click', closeDrawers);

    // Mouse up events
    ['touchend', 'mouseup'].forEach((event) => {
        document.addEventListener(event, mouseUpEventHandler);
    });

    // Add Event Listeners to chapter marker links
    document.addEventListener('click', (event) => {
        if (event.target.matches('[data-jump-to-time]')) {
            seek(event.target.dataset.jumpToTime);
            document.getElementById('content-container').scrollTop=0;
        }
    });

    // Initialize the ChromeCast plugin and it's event handlers
    chromeCast.value = new ChromeCastPlugin();

    chromeCast.value.on('available', () => {
        isChromeCastSupported.value = true;

        // Add all chromecast event handlers
        Object.keys(chromeCastEventHandlers).forEach((event) => {
            chromeCast.value.on(event, chromeCastEventHandlers[event]);
        });

        // Immediately disconnect ChromeCast if the user refreshes/leaves the page
        window.addEventListener('unload', () => {
            chromeCast.value.disconnect();
        });
    });

    // Initialize Apple Airplay and create an event listener for playback change
    if (window.WebKitPlaybackTargetAvailabilityEvent) {
        player.value.addEventListener('webkitplaybacktargetavailabilitychanged', (event) => {
            if (event.availability === 'available') {
                isAirplaySupported.value = true;
            }
        });

        player.value.addEventListener('webkitcurrentplaybacktargetiswirelesschanged', () => {
            isAirplayConnected.value = !isAirplayConnected.value;
        });
    }

    if (props.useIntersectionObserver && intersection.value === null && typeof IntersectionObserver !== 'undefined' && videoWrap.value) {
        enableIntersectionObserver(videoWrap.value);
    }
})

onUpdated(() => {
    const overlay = document.getElementById('modalOverlay');
    if (overlay && !overlay.getAttribute('overlay-click-pause-video')) {
        overlay.addEventListener("click", handleOverlayClick);
        overlay.setAttribute('overlay-click-pause-video', true)
    }
});

const isAbrEnabled = computed({
    get() {
        return false;
    }
});

const playbackQualities = computed({
    get() {
        if (isShakaInitialized.value) {
            const qualities = $_sources.value.map(source => ({
                ...source,
                label: PlayerUtils.getQualityLabelByHeight(source.height),
            }));
            return Utils.dynamicSort(qualities, 'height');
        }
        return [];
    }
})

const currentProgress = computed(() => {
    if (isChromeCastConnected.value) {
        const progress = (chromeCast.value.Player.currentTime / totalDuration.value) * 100;

        return isNaN(progress) ? 0 : progress;
    }

    const progress = (currentTime.value / totalDuration.value) * 100;

    return isNaN(progress) ? 0 : progress;
});

const currentSource = computed({
    get() {
        return mediaElement.value ? mediaElement.value.src : '';
    },
});

const $_sources = computed({
    get() {
        let src;

        if (props.sources.length) {
            src = props.sources;
        } else if (ranges.value[currentRange.value] && ranges.value[currentRange.value].length) {
            src = ranges.value[currentRange.value];
        }

        return src;
    },
});

const contentCurrentTimeStorageKey = computed(() => {
    if (props.sources.length) {
        return props.videoId;
    } else {
        return props.contentId;
    }
});

const $_videoId = computed({
    get() {
        let vidId;

        if (props.sources.length) {
            vidId = props.videoId;
        } else if (props.rangesVideoIds[currentRange.value] && props.rangesVideoIds[currentRange.value].length) {
            vidId = props.rangesVideoIds[currentRange.value];
        }

        return vidId;
    },
});

const bufferedTimeRanges = computed({
    get() {
        if (shakaPlayer != null) {
            // const supportsMSE = typeof MediaSource === 'function';
            // if (supportsMSE) {
            //     return this.$shakaPlayer.getBufferedInfo().total;
            // }

            if (mediaElement.value) {
                return PlayerUtils.parseTimeRangesAsArray(mediaElement.value.buffered);
            }

            return [];
        }

        return [];
    },
});

const canPlayPause = computed(() => {
    if (!isPlaying.value) {
        return true;
    }

    if (isMobile.value) {
        return userActive.value;
    }

    return true;
});

const isCaptionsEnabled = computed(() => {
    return currentTextTrackLanguage.value !== null;
});

const playerStats = computed({
    get() {
        if (shakaPlayer != null) {
            return shakaPlayer.getStats();
        }

        return null;
    },
});

const isMobile = computed(() => PlayerUtils.isMobile().any);

const isMobileViewport = computed({
    get() {
        return window.matchMedia('(min-width: 641px)').matches === false;
    },
});

const isSafari = computed(() => PlayerUtils.isSafari());

const isMobileDrawerOpen = computed(() => {
    if ((settingsDrawer.value || captionsDrawer.value) && drawersShouldOpenFromBottom.value) {
        Intercom.hideWidget();
        Helpscout.hideWidget();
    } else {
        Intercom.showWidget();
        Helpscout.showWidget();
    }

    return (settingsDrawer.value || captionsDrawer.value) && drawersShouldOpenFromBottom.value;
});

const drawersShouldOpenFromBottom = computed({
    get() {
        return isMobileViewport.value || isPipEnabled.value;
    }
});

const currentTimeInSeconds = computed({
    get() {
        return currentTime.value;
    },
});

onBeforeUnmount(() => {
    document.removeEventListener('click', closeDrawers);
    document.removeEventListener('mouseup', mouseUpEventHandler);

    const overlay = document.getElementById('modalOverlay');
    if (overlay && overlay.getAttribute('overlay-click-pause-video')) {
        overlay.removeEventListener("click", handleOverlayClick);
        overlay.removeAttribute('overlay-click-pause-video');
    }

    shakaPlayer.destroy();
})

const {
    eventHandlers,
    mediaElementEventHandlers,
    chromeCastEventHandlers,
    keyboardEventHandlers,
    keyboardEventHandlersShift
} = useEventHandlers({
    loading,
    mediaElement,
    hasRetriedSource,
    playerError,
    playerErrorCode,
    retryVimeoUrl,
    totalDuration,
    currentTime,
    isPlaying,
    hasBeenPlayed,
    userActive,
    closeDrawers,
    currentPlaybackRate,
    isChromeCastConnected,
    isExperimentalPictureInPictureEnabled,
    isPipEnabled,
    chromeCast,
    seek,
    playPause,
    fullscreen,
    changeVolume,
    currentVolume,
    setRate,
    emit,
    contentId: props.contentId,
    progressState: currentProgress
})
</script>

<template>
    <div>
        <div ref="videoWrap" class="video-wrap" :class="{ 'picture-in-picture': isPipEnabled }">
            <div class="widescreen bg-black">
                <div ref="container" class="flex flex-column video-player"
                    :class="{ 'user-active': userActive || !isPlaying }" @contextmenu.stop.prevent="toggleContextMenu"
                    @mousemove="trackMousePosition" @touchmove="trackMousePosition">
                    <!--                    <transition name="grow-fade">-->
                    <!--                        <PlayerStats-->
                    <!--                            v-if="playerStats"-->
                    <!--                            v-show="dialogs.stats"-->
                    <!--                            :player-stats="playerStats"-->
                    <!--                            @close="closeAllDialogs"-->
                    <!--                        />-->
                    <!--                    </transition>-->

                    <transition name="grow-fade">
                        <PlayerShortcuts v-show="dialogs.keyboardShortcuts" @close="closeAllDialogs" />
                    </transition>

                    <transition name="grow-fade">
                        <PlayerError v-if="playerError" :error-code="playerErrorCode" />
                    </transition>

                    <transition name="fade">
                        <span v-show="currentPlaybackRate !== 1" class="rate-indicator title text-white pa-1">
                            {{ currentPlaybackRate }}x
                        </span>
                    </transition>

                    <div v-show="showContextMenu" ref="contextMenu"
                        class="context-menu bg-grey-5 pointer text-white shadow overflow" :style="contextMenuPosition"
                        @click.stop.prevent>
                        <ul class="list-style-none tw-text-xs dense font-bold">
                            <li v-if="!isMobile && useKeyboard" class="pa-1 hover-bg-grey-4"
                                @click="openDialog('keyboardShortcuts')">
                                {{ dialogs.keyboardShortcuts ? 'Hide' : 'Show' }} Keyboard Shortcuts
                            </li>
                            <!--                            <li-->
                            <!--                                class="pa-1 hover-bg-grey-4"-->
                            <!--                                @click="openDialog('stats')"-->
                            <!--                            >-->
                            <!--                                {{ dialogs.stats ? 'Hide' : 'Show' }} Player Stats-->
                            <!--                            </li>-->
                            <li v-if="!isMobile" class="pa-1 hover-bg-grey-4" @click="togglePip">
                                {{ isPipEnabled || isExperimentalPictureInPictureEnabled
                                        ? 'Disable' : 'Enable'
                                }} Picture in Picture
                            </li>
                        </ul>
                    </div>

                    <transition name="grow-fade">
                        <div v-show="loading && !isPlaying" class="player-overlay" @click.stop.prevent>
                            <LoadingAnimation :theme-color="themeColor" />
                        </div>
                    </transition>

                    <transition name="fade">
                        <div v-show="isChromeCastConnected"
                            class="cast-dialog flex flex-center pa-3 text-center text-white">
                            <span style="font-size:72px;">
                                <i class="fab fa-chromecast"></i>
                            </span>
                            <h1 class="subheading">
                                Video is playing on another device
                            </h1>
                        </div>
                    </transition>

                    <video id="video-component-id" ref="player" playsinline preload="metadata" :poster="poster">

                        <track v-if="captions" :src="captions" label="English" kind="subtitles" srclang="en" default>
                    </video>

                    <div ref="controls-wrapper" class="controls-wrap" @dblclick.stop.prevent="fullscreen"
                        @click.stop="playPauseViaControlWrap">
                        <transition name="fast-fade">
                            <div v-show="isTransitioning" class="player-overlay big-play-button pointer">
                                <div class="overlay-play rounded flex-center shadows">
                                    <i class="fas" :class="isPlaying ? 'fa-pause' : 'fa-play'"></i>
                                </div>
                            </div>
                        </transition>

                        <div class="top-controls">
                            <div class="flex flex-row align-h-right">
                                <transition name="grow-fade">
                                    <PlayerButton v-if="isChromeCastSupported && controls.chromecast && !isPipEnabled"
                                        :theme-color="themeColor" title="Chromecast"
                                        :active="chromeCast && chromeCast.Connected"
                                        @click.stop.native="enableChromeCast">
                                        <i class="fab fa-chromecast"></i>
                                    </PlayerButton>
                                </transition>

                                <transition name="grow-fade">
                                    <PlayerButton v-if="isAirplaySupported && controls.airplay && !isPipEnabled"
                                        :theme-color="themeColor" title="Apple Airplay" :active="isAirplayConnected"
                                        @click.stop.native="enableAirplay">
                                        <i class="icon-airplay"></i>
                                    </PlayerButton>
                                </transition>

                                <transition name="grow-fade">
                                    <PlayerButton v-show="isPipEnabled" :theme-color="themeColor" title="Disable PIP"
                                        @click.stop.native="isPipEnabled = false">
                                        <i class="fas fa-times"></i>
                                    </PlayerButton>
                                </transition>
                            </div>
                        </div>

                        <div class="player-controls flex flex-column noselect">
                            <!--  TOP ROW  -->
                            <div class="flex flex-row" style="min-height:50px;" @dblclick.stop.prevent="() => false"
                                @click.stop.prevent="() => false">
                                <PlayerButton v-if="controls.backward" :theme-color="themeColor"
                                    title="Rewind 5 Seconds (Left Arrow)" data-cy="rewind-button"
                                    @click.stop.native="seek(currentTime - 5)">
                                    <i class="fas fa-undo"></i>
                                </PlayerButton>

                                <div class="flex flex-column spacer"></div>

                                <PlayerButton v-if="controls.forward" :theme-color="themeColor"
                                    title="Forward 5 Seconds (Right Arrow)" data-cy="fast-forward-button"
                                    @click.stop.native="seek(currentTime + 5)">
                                    <i class="fas fa-redo"></i>
                                </PlayerButton>
                            </div>

                            <!--  MIDDLE ROW  -->
                            <div v-if="controls.progress" class="flex flex-row" @dblclick.stop.prevent="() => false">
                                <PlayerProgress :theme-color="themeColor" :current-progress="currentProgress"
                                    :current-time="currentTime" :player-width="(player.value && player.value.clientWidth) || 0"
                                    :current-mouse-x="currentMousePosition.x" :total-duration="totalDuration"
                                    :buffered-time-ranges="bufferedTimeRanges" :chapters="chapters"
                                    :mousedown="mousedown" data-cy="progress-rail"
                                    @mousedown.stop.native="triggerMouseDown"
                                    @touchstart.stop.native="triggerMouseDown" />
                            </div>

                            <!--  BOTTOM ROW  -->
                            <div class="flex flex-row" @dblclick.stop.prevent="() => false"
                                @click.stop.prevent="() => false">
                                <PlayerButton v-if="controls.play" :theme-color="themeColor"
                                    :title="isPlaying ? 'Pause (Spacebar)' : 'Play (Spacebar)'"
                                    data-cy="play-pause-button" @click.stop.native="playPause">
                                    <i class="fas" :class="isPlaying ? 'fa-pause' : 'fa-play'"></i>
                                </PlayerButton>

                                <div v-if="controls.time"
                                    class="flex flex-column text-white body align-v-center noselect flex-auto">
                                    {{ parseTime(currentTime) }} / {{ parseTime(totalDuration) }}
                                </div>

                                <div class="flex flex-column spacer"></div>

                                <PlayerVolume v-if="!isMobile && controls.volume" :theme-color="themeColor"
                                    :current-volume="currentVolume" @volumeChange="changeVolume" />

                                <PlayerButton v-show="!isPipEnabled" v-if="textTracks.length > 0 && controls.captions"
                                    :theme-color="themeColor" :active="isCaptionsEnabled"
                                    @click.stop.native="toggleCaptionsDrawer">
                                    <i class="fas fa-closed-captioning"></i>
                                </PlayerButton>

                                <PlayerButton v-show="!isPipEnabled" v-if="controls.settings" :theme-color="themeColor"
                                    title="Settings" :disabled="isChromeCastConnected"
                                    @click.stop.native="toggleSettingsDrawer">
                                    <i class="fas fa-cog"></i>
                                </PlayerButton>

                                <PlayerButton v-show="!isPipEnabled" v-if="controls.fullscreen"
                                    :theme-color="themeColor" title="Fullscreen (F)" :disabled="isChromeCastConnected"
                                    @click.stop.native="fullscreen">
                                    <i class="fas" :class="isFullscreen ? 'fa-compress' : 'fa-expand'"></i>
                                </PlayerButton>
                            </div>
                        </div>
                    </div>

                    <div v-show="isMobileDrawerOpen" class="settings-mobile-overlay" @click="settingsDrawer = false">
                    </div>

                    <transition :name="drawersShouldOpenFromBottom ? 'show-from-bottom' : 'grow-fade'">
                        <PlayerSettings v-if="controls.settings" v-show="settingsDrawer" :drawer="settingsDrawer"
                            :theme-color="themeColor" :current-source="currentSource"
                            :current-playback-rate="currentPlaybackRate" :playback-qualities="playbackQualities"
                            :is-abr-enabled="isAbrEnabled" @setQuality="setQuality" @setRate="setRate" />
                    </transition>

                    <transition :name="drawersShouldOpenFromBottom ? 'show-from-bottom' : 'grow-fade'">
                        <PlayerCaptions v-if="controls.settings" v-show="captionsDrawer" :theme-color="themeColor"
                            :is-captions-enabled="isCaptionsEnabled" :caption-options="textTracks"
                            :current-captions="currentTextTrackLanguage" @captionsSelected="enableCaptions" />
                    </transition>
                </div>
            </div>
        </div>

        <div v-if="isPipEnabled" class="widescreen bg-black"></div>

        <PlayerRanges v-if="showRangeButtons" :theme-color="themeColor" :current-range="currentRange"
            :ranges="Object.keys(ranges)" @setRange="setRange"></PlayerRanges>
    </div>
</template>
