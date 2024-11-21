<template>
    <div ref="videoWrap" class="video-wrap" :class="{ 'picture-in-picture': isPipEnabled }">
        <div class="widescreen">
            <div ref="youtubeIframe" class="iframe"></div>
        </div>

        <PlayerRanges v-if="ranges" :theme-color="themeColor" :current-range="currentRange" :ranges="ranges"
            @setRange="setRange"></PlayerRanges>
    </div>
</template>

<script>
import PlayerRanges from '../VideoPlayer/_PlayerRanges.vue';
import userJourney from '@services/userJourney';

export default {
    name: 'YoutubePlayer',
    components: {
        PlayerRanges,
    },

    props: {
        videoId: {
            type: [String, Number],
            default: () => null,
        },

        currentSecond: {
            type: [Number, String],
            default: () => 0,
        },

        totalDuration: {
            type: [Number, String],
            default: () => 0,
        },

        progressState: {
            type: String,
            default: () => 'unstarted',
        },

        themeColor: {
            type: String,
            default: () => 'singeo',
        },

        contentId: {
            type: [String, Number],
            default: () => null,
        },

        useIntersectionObserver: {
            type: Boolean,
            default: () => false,
        },
        ranges: {
            type: Array,
            default: () => ([]),
        },
        rangesVideoIds: {
            type: Object,
            default: () => ({}),
        },
        brand: {
            type: String,
            default: () => 'singeo',
        },
        endSecond: {
            type: [Number, String],
            default: null
        },
        startSecond: {
            type: [Number, String],
            default: 0
        },
        seekToTime: {
            type: [String, Number],
            default: 0
        }
    },

    data() {
        return {
            player: null,
            syncInterval: null,
            currentTime: 0,
            isPipEnabled: false,
            currentRange: 'original',
            hasBeenPlayed: false,
            heartbeatTimer: 0,
            ninetyFivePercentTracked: false,
        };
    },

    computed: {
        isMobileViewport: {
            cache: false,
            get() {
                return window.matchMedia('(min-width: 641px)').matches === false;
            },
        },

        currentTimeInSeconds: {
            cache: false,
            get() {
                return this.currentTime;
            },
        },
        contentCurrentTimeStorageKey: {
            get() {
                if (this.videoId) {
                    return this.videoId;
                } else {
                    return this.contentId;
                }
            },
        },
        trackingPayload: {
            cache: false,
            get() {
                return {
                    brand: this.brand,
                    content_id: this.contentId,
                    position_seconds: Math.floor(this.currentTimeInSeconds),
                    video_player: "youtube",
                    video_length_seconds: Math.floor(this.totalDuration)
                };
            },

        },
    },

    watch: {
        seekToTime: function (newVal, oldVal) { // watch it
            this.player.seekTo(newVal);
            pauseVideo(); //Pause when seeking? 
        }
    },

    mounted() {
        const youtubeIframeApi = document.getElementById('youtubeIframeApi');

        if (youtubeIframeApi == null) {
            this.appendIframeApi();
            window.onYouTubeIframeAPIReady = () => {
                this.initPlayer();
            };
        } else {
            this.initPlayer();
        }

        if (this.useIntersectionObserver) {
            this.enableIntersectionObserver();
        }

        // Add Event Listeners to chapter marker links
        document.addEventListener('click', (event) => {
            const element = event.target;
            if (element.matches('[data-jump-to-time]')) {
                this.player.seekTo(element.dataset.jumpToTime)
                document.getElementById('content-container').scrollTop = 0;
            }
        });
    },

    beforeDestroy() {
        clearInterval(this.syncInterval);
    },

    methods: {
        pauseVideo() {
            this.player.pauseVideo();
        },

        setRange({ range }) {
            if (this.rangesVideoIds[range]) {
                this.currentRange = range;
                this.player.loadVideoById(this.rangesVideoIds[range], this.player.getCurrentTime());
                window.localStorage.setItem('currentRange', range);
            }
        },

        appendIframeApi() {
            const scriptTag = document.createElement('script');
            const firstScriptTag = document.querySelector('script');

            scriptTag.setAttribute('id', 'youtubeIframeApi');
            scriptTag.setAttribute('src', 'https://www.youtube.com/iframe_api');

            firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag);
        },

        getTimeToSeekTo() {
            const urlParams = new URLSearchParams(window.location.search);
            let seconds = urlParams.get('time');
            if (seconds) {
                return seconds;
            }
            seconds = window.localStorage.getItem(`${this.contentCurrentTimeStorageKey}_currentTime`);
            if (seconds) {
                window.localStorage.removeItem(`${this.contentCurrentTimeStorageKey}_currentTime`);
                return seconds;
            }

            return window.sessionStorage.getItem(`${this.contentCurrentTimeStorageKey}_currentTime`) || this.currentSecond;
        },

        setHasBeenPlayed() {
            this.hasBeenPlayed = true;
        },

        initPlayer() {
            const { youtubeIframe } = this.$refs;

            const timeToSeekTo = this.getTimeToSeekTo();
            const vm = this;
            var videoId = this.videoId;

            if (window.localStorage.getItem('currentRange') &&
                this.rangesVideoIds[window.localStorage.getItem('currentRange')]) {
                videoId = this.rangesVideoIds[window.localStorage.getItem('currentRange')];
                this.currentRange = window.localStorage.getItem('currentRange');
            }

            this.player = new YT.Player(youtubeIframe, {
                videoId: videoId,
                playerVars: {
                    modestbranding: 1,
                    rel: 0,
                    enablejsapi: 1,
                    playsinline: 1,
                    ...(this.startSecond !== 0) || (this.endSecond !== this.totalDuration) ? {
                        start: vm.startSecond,
                        end: vm.endSecond,
                    } : {},
                },
                events: {
                    onReady() {
                        if (timeToSeekTo > 0) {
                            vm.player.seekTo(timeToSeekTo);

                            let intervalTries = 0;

                            const pauseOnSeekInterval = setInterval(() => {
                                intervalTries += 1;

                                if (vm.player.getPlayerState() === 1) {
                                    vm.player.pauseVideo();
                                    window.clearInterval(pauseOnSeekInterval);
                                }

                                if (intervalTries > 100) {
                                    window.clearInterval(pauseOnSeekInterval);
                                }
                            }, 50);
                        }
                    },
                    onStateChange(event) {
                        if (event.data === 1) {
                            if (!vm.hasBeenPlayed) {
                                userJourney.trackVideo({ payload: vm.trackingPayload, type: 'started' });
                            } else {
                                vm.currentTime = Math.floor(vm.player.getCurrentTime());
                                userJourney.trackVideo({ payload: vm.trackingPayload, type: 'resumed' });
                            }

                            if (((vm.startSecond !== 0) || (vm.endSecond !== vm.totalDuration)) && !vm.hasBeenPlayed) {
                                vm.player.playVideoAt(vm.startSecond);
                            }
                            vm.$emit('play', {
                                ...event,
                                contentId: vm.contentId,
                                progressState: vm.progressState,
                                isYoutube: true,
                            });

                            if (!vm.syncInterval) {
                                userJourney.trackVideo({ payload: vm.trackingPayload, type: 'playing' });

                                vm.syncInterval = setInterval(() => {
                                    vm.currentTime = Math.floor(vm.player.getCurrentTime());
                                    const videoDuration = Math.floor(vm.totalDuration);

                                    // Calculate when the video reaches 95% played
                                    if (vm.currentTime >= Math.floor(0.95 * videoDuration) && !vm.ninetyFivePercentTracked) {
                                        userJourney.trackVideo({ payload: vm.trackingPayload, type: 'completed' });
                                        vm.$emit('onVideoEnd');
                                        vm.ninetyFivePercentTracked = true; // Ensure this is only tracked once
                                    }

                                    if (vm.heartbeatTimer > 0 && vm.heartbeatTimer % 3 === 0) {
                                        window.sessionStorage.setItem(`${vm.contentCurrentTimeStorageKey}_currentTime`, vm.currentTime);
                                    }

                                    if (vm.heartbeatTimer > 0 && vm.heartbeatTimer % 15 === 0) {
                                        userJourney.trackVideo({ payload: vm.trackingPayload, type: 'playing' });
                                    }

                                    vm.heartbeatTimer += 1;
                                }, 1000);
                            }

                            if (!vm.hasBeenPlayed) {
                                vm.setHasBeenPlayed();
                            }
                        }

                        if (event.data === 2) {
                            if (Math.floor(vm.currentTime) !== Math.floor(vm.totalDuration)) {
                                userJourney.trackVideo({ payload: vm.trackingPayload, type: 'paused' });
                            }

                            clearInterval(vm.syncInterval);

                            vm.syncInterval = null;

                            vm.heartbeatTimer = 0;

                            vm.$emit('pause', {
                                ...event,
                                contentId: vm.contentId,
                            });
                        }

                        if (event.data === 0) {
                            clearInterval(vm.syncInterval);
                            vm.syncInterval = null;
                            vm.heartbeatTimer = 0;

                            if (vm.hasBeenPlayed) {
                                const isRepeatOn = localStorage.getItem("playbackRepeatOn") ? JSON.parse(localStorage.getItem("playbackRepeatOn")) : false;
                                const isInPlaybackMode = window.location.href.includes('playlist-item');
                                if (isRepeatOn && isInPlaybackMode) {
                                    vm.player.seekTo(0);
                                    vm.player.playVideo();
                                } else {
                                    vm.$emit('onVideoEnd');
                                }
                            }
                        }
                    },
                },
            });


        },

        enableIntersectionObserver() {
            this.intersection = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    const isVisible = entry.intersectionRatio >= 0.5;
                    this.isPipEnabled = !isVisible && !this.isMobileViewport && this.isPlaying;
                });
            }, {
                root: null,
                rootMargin: '0px',
                threshold: 0.5,
            });
            this.intersection.observe(this.$refs.videoWrap.parentElement);
        },
    },
};
</script>
