// useCounter.js
import { ref, computed, nextTick } from "vue";

export default function ({
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
    isPipEnabled
}) {
    const eventHandlers = {
        loading: () => {
            loading.value = true;
        },
        onstatechange: (event) => {
            if (event.state === 'load') {
                loading.value = false;
            }

            if (event.state === 'src-equals') {
                nextTick(() => {
                    mediaElement.load();
                });
            }
        },
        error: (error) => {
            if (error.severity === 2) {
                if (error.code === 1001 && !hasRetriedSource.value) {
                    retryVimeoUrl(error);
                } else {
                    playerError.value = true;
                    playerErrorCode.value = error.code;
                }
            }
        },
        buffering: (event) => {
            loading.value = event.buffering;
        },
    };
    const mediaElementEventHandlers = {
        canplaythrough: (event) => {
            totalDuration.value = mediaElement.duration;
            currentTime.value = mediaElement.currentTime;

            setTimeout(() => {
                loading.value = false;
                // cant find a way to test or refactor emits
                //this.$emit('canplaythrough', event);
            }, 500);
        },

        loadedmetadata: (event) => {
            setTimeout(() => {
                loading.value = false;
                // cant find a way to test or refactor emits
                // this.$emit('loadedmetadata', event);
            }, 500);
        },

        durationchange: (event) => {
            totalDuration.value = mediaElement.duration;
            // cant find a way to test or refactor emits
            // this.$emit('durationchange', event);
        },

        waiting: (event) => {
            isPlaying.value = false;
            loading.value = true;

            // this.$emit('waiting', event);
        },

        pause: (event) => {
            isPlaying.value = false;
            loading.value = false;

            // cant find a way to test or refactor emits
            /*
            this.$emit('pause', {
                ...event,
                contentId: this.contentId,
            });
            */
        },

        play: (event) => {
            isPlaying.value = true;
            loading.value = false;
            hasBeenPlayed.value = true;
            // cant find a way to test or refactor emits
            /*
            this.$emit('play', {
                ...event,
                contentId: this.contentId,
                progressState: this.progressState,
            });
            */
        },

        playing: (event) => {
            setTimeout(() => {
                isPlaying.value = true;
                loading.value = false;
            }, 100);
            // cant find a way to test or refactor emits
            // this.$emit('playing', event);
        },

        timeupdate: (event) => {
            totalDuration.value = mediaElement.duration;
            currentTime.value = mediaElement.currentTime;
            // cant find a way to test or refactor emits
            // this.$emit('timeupdate', event);
        },

        useractive: () => {
            setTimeout(() => {
                userActive.value = true;
            }, 200);
        },

        userinactive: () => {
            userActive.value = false;
            closeDrawers();
        },

        ratechange: () => {
            if (mediaElement.playbackRate !== 0) {
                currentPlaybackRate.value = mediaElement.playbackRate;
            }
        },

        seeking: () => {
            loading.value = true;
        },

        seeked: () => {
            loading.value = false;

            if (hasBeenPlayed && !isChromeCastConnected) {
                mediaElement.play();
            }
        },

        enterpictureinpicture: () => {
            isExperimentalPictureInPictureEnabled.value = true;
        },

        leavepictureinpicture: () => {
            isExperimentalPictureInPictureEnabled.value = false;
        },

        ended: () => {
            isPipEnabled.value = false;
        },
    };
    return {
        eventHandlers,
        mediaElementEventHandlers,
    }
}