<template>
    <div ref="videoWrap" class="video-wrap" :class="{'picture-in-picture': isPipEnabled}">
        <div class="widescreen">
            <div ref="youtubeIframe" class="iframe"></div>
        </div>

        <PlayerRanges v-if="ranges" :theme-color="themeColor" :current-range="currentRange" :ranges="ranges"
            @setRange="setRange"></PlayerRanges>
    </div>
</template>

<script>
import PlayerRanges from '../VideoPlayer/_PlayerRanges.vue';

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
            type: Number,
            default: () => 0,
        },

        totalDuration: {
            type: Number,
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
                console.log(this.currentTime, this.endSecond)
                return this.currentTime;
            },
        },
        contentCurrentTimeStorageKey:{
            get(){
                if (this.videoId) {
                    return this.videoId;
                } else {
                    return this.contentId;
                }
            },
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

                        vm.syncInterval = setInterval(() => {
                            vm.currentTime = Math.round(vm.player.getCurrentTime());
                        }, 1000);
                    },
                    onStateChange(event) {
                        if (event.data === 1) {
                            vm.$emit('play', {
                                ...event,
                                contentId: vm.contentId,
                                progressState: vm.progressState,
                                isYoutube: true,
                            });
                        }

                        if (event.data === 2) {
                            vm.$emit('pause', {
                                ...event,
                                contentId: vm.contentId,
                            });
                        }

                        if (event.data === 0) {
                            const isRepeatOn = localStorage.getItem("playbackRepeatOn") ? JSON.parse(localStorage.getItem("playbackRepeatOn")) : false;
                            const isInPlaybackMode = window.location.href.includes('playlist-item');
                            if (isRepeatOn && isInPlaybackMode) {
                                vm.player.seekTo(0);
                                vm.player.playVideo();
                            } else {
                                vm.$emit('onVideoEnd', {
                                    ...event,
                                    contentId: vm.contentId,
                                });
                            }
                        }

                    },
                },
            });

            setInterval(() => {
                window.sessionStorage.setItem(`${this.contentCurrentTimeStorageKey}_currentTime`, this.player.getCurrentTime());
            }, 2500);

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
