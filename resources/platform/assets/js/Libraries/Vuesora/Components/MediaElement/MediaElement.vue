<template>
    <div class="flex flex-column">
        <!-- Media Player: Sprite Sheet -->
        <svg aria-hidden="true" style="display: none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <symbol id="icon-captions" viewBox="0 0 18 14" xmlns="http://www.w3.org/2000/svg">
                <g fill="#fff">
                    <path d="M-.67-4.08h14a2,2,0,0,1,2,2v10a2,2,0,0,1-2,2h-14a2,2,0,0,1-2-2v-10A2,2,0,0,1-.67-4.08Z" transform="translate(2.67 4.08)"/>
                </g>
                <g fill="#000">
                    <path d="M2.88,6.67a2.81,2.81,0,0,1-2.1-1A3.91,3.91,0,0,1,.88.87c.5-.6,2-1.7,4.6.2l-.6.8c-1.4-1-2.6-1.1-3.3-.3a3,3,0,0,0-.1,3.5c.7.9,1.9.8,3.4-.1l.5.9a5.28,5.28,0,0,1-2.5.8Zm7.5,0a2.81,2.81,0,0,1-2.1-1,3.91,3.91,0,0,1,.1-4.8c.5-.6,2-1.7,4.6.2l-.5.8c-1.4-1-2.6-1.1-3.3-.3a3,3,0,0,0-.1,3.5c.7.9,1.9.8,3.4-.1l.5.9a6.07,6.07,0,0,1-2.6.8Z" transform="translate(2.67 4.08)"/>
                </g>
            </symbol>
            <symbol id="icon-chapters" viewBox="0 0 16.6 13" xmlns="http://www.w3.org/2000/svg"><path d="M1.5,0A1.54,1.54,0,0,1,3,1.5,1.54,1.54,0,0,1,1.5,3,1.54,1.54,0,0,1,0,1.5,1.47,1.47,0,0,1,1.5,0ZM6.6,0h8.5a1.47,1.47,0,0,1,1.5,1.5A1.54,1.54,0,0,1,15.1,3H6.6A1.47,1.47,0,0,1,5.1,1.5,1.37,1.37,0,0,1,6.6,0ZM1.5,5A1.54,1.54,0,0,1,3,6.5,1.54,1.54,0,0,1,1.5,8,1.54,1.54,0,0,1,0,6.5,1.47,1.47,0,0,1,1.5,5ZM6.6,5h8.5a1.47,1.47,0,0,1,1.5,1.5A1.54,1.54,0,0,1,15.1,8H6.6A1.47,1.47,0,0,1,5.1,6.5,1.37,1.37,0,0,1,6.6,5ZM1.5,10a1.5,1.5,0,0,1,0,3A1.54,1.54,0,0,1,0,11.5,1.47,1.47,0,0,1,1.5,10Zm5.1,0h8.5a1.47,1.47,0,0,1,1.5,1.5A1.54,1.54,0,0,1,15.1,13H6.6a1.47,1.47,0,0,1-1.5-1.5A1.37,1.37,0,0,1,6.6,10Z"/></symbol>
            <symbol id="icon-fullscreen" viewBox="0 0 17.8 17.8" xmlns="http://www.w3.org/2000/svg"><path d="M0,1A.94.94,0,0,1,1,0H6.4c.6,0,.7.3.3.7l-6,6C.3,7.1,0,7,0,6.4ZM0,16.8a.94.94,0,0,0,1,1H6.4c.6,0,.7-.3.3-.7l-6-6c-.4-.4-.7-.3-.7.3ZM17.8,1a.94.94,0,0,0-1-1H11.4c-.6,0-.7.3-.3.7l6,6c.4.4.7.3.7-.3Zm0,15.8a.94.94,0,0,1-1,1H11.4c-.6,0-.7-.3-.3-.7l6-6c.4-.4.7-.3.7.3Z"/></symbol>
            <symbol id="icon-unfullscreen" viewBox="0 0 17.8 17.8" xmlns="http://www.w3.org/2000/svg"><path d="M11.74,4.64a.94.94,0,0,0,1,1h4.1c.6,0,.7-.3.3-.7L12.44.24c-.4-.4-.7-.3-.7.3Zm-7.1,1a.94.94,0,0,0,1-1V.54c0-.6-.3-.7-.7-.3L.24,4.94c-.4.4-.3.7.3.7Zm1,7.1a.94.94,0,0,0-1-1H.54c-.6,0-.7.3-.3.7l4.7,4.7c.4.4.7.3.7-.3Zm7.1-1a.94.94,0,0,0-1,1v4.1c0,.5.3.7.7.3l4.7-4.7c.4-.4.3-.7-.3-.7Z"/></symbol>
            <symbol id="icon-mute" viewBox="0 0 17.55 17.03" xmlns="http://www.w3.org/2000/svg">
                <g stroke="none">
                    <path d="M6.21,4.36a3,3,0,0,1-1.8.6H1.21a.94.94,0,0,0-1,1v5.7a.94.94,0,0,0,1,1h4.2c.3.2.5.4.8.6l3.5,2.6a.47.47,0,0,0,.8-.4V2.06a.47.47,0,0,0-.8-.4Z"/>
                </g>
                <g fill="none" stroke-linecap="round" stroke-width="1.5px">
                    <path d="M13.11,1.18S17,.38,17,8.88s-3.9,7.8-3.9,7.8"/>
                    <path d="M11.81,5.08s2.6-.4,2.6,3.8-2.6,3.9-2.6,3.9"/>
                </g>
            </symbol>
            <symbol id="icon-unmute" viewBox="0 0 18.2 17" xmlns="http://www.w3.org/2000/svg">
                <g stroke="none">
                    <path d="M6.21,4.36a3,3,0,0,1-1.8.6H1.21a.94.94,0,0,0-1,1v5.7a.94.94,0,0,0,1,1h4.2c.3.2.5.4.8.6l3.5,2.6a.47.47,0,0,0,.8-.4V2.06a.47.47,0,0,0-.8-.4Z"/>
                </g>
                <g fill="none" stroke-linecap="round" stroke-width="2px">
                    <path d="M12,5.55l5.4,5.4M12,11l5.4-5.4"/>
                </g>
            </symbol>
            <symbol id="icon-play" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 8.5c.3.1.4.5.2.8-.1.1-.1.2-.2.2l-11.4 7c-.5.3-.8.1-.8-.5V2c0-.5.4-.8.8-.5l11.4 7z"/></symbol>
            <symbol id="icon-pause" viewBox="0 0 14 16" xmlns="http://www.w3.org/2000/svg"><path d="M1,0H3.2a.94.94,0,0,1,1,1V15a.94.94,0,0,1-1,1H1a.94.94,0,0,1-1-1V1A1,1,0,0,1,1,0Zm9.8,0H13a.94.94,0,0,1,1,1V15a.94.94,0,0,1-1,1H10.8a.94.94,0,0,1-1-1V1A1,1,0,0,1,10.8,0Z"/></symbol>
            <symbol id="icon-replay" viewBox="0 0 17.52 15.97" xmlns="http://www.w3.org/2000/svg"><path d="M16.7,7.27a.81.81,0,0,1-.9.7c-.1,0-.2,0-.2-.1l-4.9-1.8c-.5-.2-.6-.6-.1-.8l6.2-3.6c.5-.3.8-.1.7.5l-.8,5.1Z"/><path d="M8.1,13.77a5.92,5.92,0,0,1-2.9-.7A5.77,5.77,0,0,1,2,7.87a6.21,6.21,0,0,1,6.3-6A6.15,6.15,0,0,1,13.9,6l.1-.1L16.1,7A8.1,8.1,0,0,0,7,.07,8.24,8.24,0,0,0,0,8a8.06,8.06,0,0,0,4.3,7,10.21,10.21,0,0,0,3.8,1,8.24,8.24,0,0,0,6.6-3.3l-1.8-.9a7,7,0,0,1-4.8,2Z"/></symbol>
            <symbol id="icon-overlay-play" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                <g fill="#333" stroke="#fff" stroke-width="5px">
                    <path d="M2.5,40A37.5,37.5,0,1,1,40,77.5,37.51,37.51,0,0,1,2.5,40Z"/>
                </g>
                <g fill="#fff">
                    <path d="M60.3,38a1,1,0,0,1,.6,1.4.9.9,0,0,1-.6.6L30,57.5c-1,.6-1.7.1-1.7-1v-35c0-1.1.8-1.5,1.7-1Z"/>
                </g>
            </symbol>
            <symbol id="icon-loading-spinner" viewBox="0 0 75.8 77.9" xmlns="http://www.w3.org/2000/svg">
                <g fill="#fff">
                    <circle cx="38.8" cy="8.1" r="8.1"/>
                    <g opacity="0.4">
                        <circle cx="70.8" cy="40" r="5"/>
                    </g>
                    <g opacity="0.6">
                        <circle cx="38.8" cy="71.9" r="6"/>
                    </g>
                    <g opacity="0.8">
                        <circle cx="7" cy="40" r="7"/>
                    </g>
                    <g opacity="0.9">
                        <circle cx="15.1" cy="17.3" r="7.5"/>
                    </g>
                    <g opacity="0.3">
                        <circle cx="63.2" cy="17.1" r="4.5"/>
                    </g>
                    <g opacity="0.5">
                        <circle cx="62.7" cy="63.8" r="5.5"/>
                    </g>
                    <g opacity="0.7">
                        <circle cx="15.1" cy="63.8" r="6.5"/>
                    </g>
                </g>
            </symbol>
        </svg>

        <div class="widescreen">
            <div
                :id="themeColor + 'Theme'"
                class="media-element"
            >
                <video
                    v-if="sortedSourcesArray.length"
                    :id="elementId"
                    :poster="poster"
                    :data-cast-title="castTitle"
                    :data-cast-description="castDescription"
                    :data-cast-poster="poster"
                    class="mejs__player"
                    playsinline
                >

                    <source
                        v-for="(source, i) in sortedSourcesArray"
                        :key="i"
                        :src="source.file"
                        :data-quality="sourceQualityLabel(source.height)"
                        type="video/mp4"
                    >
                </video>

                <div
                    v-else
                    id="errorContainer"
                    class="flex flex-row pv-5"
                >
                    <div class="flex flex-column align-center text-center">
                        <img
                            src="https://dmmior4id2ysr.cloudfront.net/icons/emoji-doh.svg"
                            class="error-icon mb-2"
                        >
                        <h1 class="title text-white">
                            Oops, something went wrong!<br>
                            Please refresh or contact support.
                        </h1>
                        <h6 class="tiny text-white">
                            to contact support click the chat widget on the bottom of your screen,<br>
                            or send an email to
                            <a :href="'mailto:support@' + brand + '.com'" class="text-white">support@{{ brand }}.com</a>.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'mediaelement';
import 'mediaelement/build/mejs-controls.svg';
import 'mediaelement/build/mediaelementplayer.min.css';
import 'mediaelement-plugins/src/quality/quality';
import 'mediaelement-plugins/src/quality/quality.css';
import 'mediaelement-plugins/src/speed/speed';
import 'mediaelement-plugins/src/speed/speed.css';
import 'mediaelement-plugins/src/markers/markers';
import 'mediaelement-plugins/src/jump-forward/jump-forward';
//import 'mediaelement-plugins/src/jump-forward/jump-forward.css';
import 'mediaelement-plugins/src/skip-back/skip-back';
//import 'mediaelement-plugins/src/skip-back/skip-back.css';
import 'mediaelement-plugins/src/airplay/airplay';
import 'mediaelement-plugins/src/airplay/airplay.css';
import * as QueryString from 'query-string';
import Utils from '../../assets/js/classes/utils';

export default {
    name: 'VideoMediaElement',
    props: {
        elementId: {
            type: String,
            default: 'mediaElementPlayer',
        },
        sources: {
            type: Array,
            default: [],
        },
        hlsManifestUrl: {
            type: String,
            default: '',
        },
        poster: {
            type: String,
            default: '',
        },
        brand: {
            type: String,
            default: 'drumeo',
        },
        themeColor: {
            type: String,
            default: 'drumeo',
        },
        checkForTimecode: {
            type: Boolean,
            default: false,
        },
        castTitle: {
            type: String,
            default: null,
        },
        castDescription: {
            type: String,
            default: null,
        },
        chapters: {
            type: Array,
            default: [],
        },
        contentId: {
            type: [String, Number],
            default: () => null,
        },
        userId: {
            type: [String, Number],
            default: null,
        },
        progressState: {
            type: String,
            default: null,
        },
        currentSecond: {
            type: [String, Number],
            default: 0,
        },
        videoId: {
            type: [String, Number],
            default: null,
        },
        videoLength: {
            type: [String, Number],
            default: null,
        },
        seekToTime: {
            type: [String, Number],
            default: 0
        }
    },
    data() {
        return {
            mediaElement: Object,
            player: Object,
            events: [
                'loadedmetadata',
                'progress',
                'timeupdate',
                'seeking',
                'seeked',
                'canplay',
                'play',
                'playing',
                'pause',
                'ended',
                'volumechange',
                'captionschange',
            ],
            contextMenu: false,
            currentTimeInSeconds: 0,
        };
    },
    computed: {
        sortedSourcesArray() {
            if (this.sources.length) {
                return this.sources.sort(
                    Utils.dynamicSort('-height'),
                );
            }

            return [];
        },

        urlWithTimecode() {
            return `${location.protocol}//${location.host}${location.pathname}?time=${Math.floor(this.currentTimeInSeconds)}`;
        },

        defaultQuality: {
            get() {
                let defaultQuality = window.localStorage.getItem('defaultQuality');
                const guessedQuality = this.sortedSourcesArray.filter(source => source.width <= window.innerWidth);

                // Pick a default quality based on the closest size to the client width
                if ((defaultQuality === undefined || defaultQuality === null)
                        && (this.sortedSourcesArray.length > 0)) {
                    if (guessedQuality.length) {
                        // If we have some guessed qualities take the first one
                        defaultQuality = this.sourceQualityLabel(
                            guessedQuality[0].height,
                        );
                    } else {
                        // Otherwise take the last item in the qualities array (the smallest quality)
                        defaultQuality = this.sourceQualityLabel(
                            this.sortedSourcesArray[this.sortedSourcesArray.length - 1].height,
                        );
                    }
                } else {
                    const thisHeight = defaultQuality ? Number(defaultQuality.replace('p', '')) : 0;
                    const defaultExists = thisHeight ? this.sortedSourcesArray.filter(source => source.height === thisHeight).length > 0 : false;

                    if (!defaultExists) {
                        if (guessedQuality.length) {
                            // If we have some guessed qualities take the first one
                            defaultQuality = this.sourceQualityLabel(
                                guessedQuality[0].height,
                            );
                        } else {
                            // Otherwise take the last item in the qualities array (the smallest quality)
                            defaultQuality = this.sourceQualityLabel(
                                this.sortedSourcesArray[this.sortedSourcesArray.length - 1]?.height,
                            );
                        }
                    }
                }

                return defaultQuality;
            },
            set(val) {
                window.localStorage.setItem('defaultQuality', val);
            },
        },

        playerPlugins() {
            const pluginsMap = {
                playpause: true,
                skipback: true,
                jumpforward: true,
                current: true,
                duration: true,
                progress: true,
                quality: true,
                speed: true,
                volume: true,
                // 'chromecast': this.castTitle != null,
                airplay: true,
                fullscreen: true,
                markers: this.chapters.length > 0,
            };
            const mapArray = [];

            Object.keys(pluginsMap).forEach((map) => {
                if (pluginsMap[map] === true) {
                    mapArray.push(map);
                }
            });

            return mapArray;
        },

        readyState: {
            cache: false,
            get() {
                return this.mediaElement ? 0 : this.mediaElement.readyState;
            },
        },
    },
    mounted() {
        window[this.elementId] = this.initializeVideoPlayer();

        if (this.elementId === 'lessonPlayer') {
            this.initializeChapterMarkerLinks();
        }

        this.updateSvgUseElements();
    },
    beforeDestroy() {
        const vm = this;

        vm.removeMediaElementEventListeners(vm.mediaElement);
    },

    //watchers
    watch: {
        seekToTime(newTime, oldTime) {
            if(newTime !== oldTime ) this.jumpToTime(newTime);
        }
    },

    methods: {
        //Fix icons to use proper svg paths
        updateSvgUseElements() {
            const useElements = this.$el.querySelectorAll('use');
            useElements.forEach(el => {
                const hrefValue = el.getAttribute('xlink:href');
                if (hrefValue && hrefValue.startsWith('mejs-controls.svg')) {
                    el.setAttribute('xlink:href', hrefValue.replace('mejs-controls.svg', ''));
                }
            });
        },
        playVideo() {
            this.mediaElement.play();
        },

        pauseVideo() {
            this.mediaElement.pause();
        },

        emitEvent(event) {
            if (event.type === 'timeupdate') {
                this.currentTimeInSeconds = this.mediaElement.getCurrentTime();
            }

            this.$emit(event.type, {
                ...event,
                progressState: this.progressState,
                contentId: this.contentId,
                videoId: this.videoId,
                currentSecond: this.currentSecond,
                videoLength: this.videoLength,
                instance: this,
            });
        },

        emitCustomEvent(event) {
            const isQuality = Array.from(event.target.classList).indexOf('mejs__qualities-selector-input') !== -1;

            if (isQuality) {
                this.$emit('qualityChange', event);

                this.defaultQuality = event.target.value;
            }

            event.target.blur();
        },

        addMediaElementEventListeners(mediaElement) {
            const vm = this;

            vm.events.forEach((event) => {
                mediaElement.addEventListener(event, vm.emitEvent);
            });
        },

        removeMediaElementEventListeners(mediaElement) {
            const vm = this;

            vm.events.forEach((event) => {
                mediaElement.removeEventListener(event, vm.emitEvent);
            });
        },

        sourceQualityLabel(height) {
            if (height >= 2160) {
                return '4k';
            }

            return `${String(height)}p`;
        },

        copyTimecodeToClipboard() {
            const timecode = document.getElementById('currentTimeInSeconds');

            timecode.select();
            document.execCommand('copy');

            setTimeout(() => {
                timecode.blur();
            }, 100);

            window.shownotification({
                icon: 'check',
                text: 'Share the love! This URL has been copied, and is ready to share!'
            });
        },

        getCurrentTime() {
            return this.mediaElement.getCurrentTime();
        },

        jumpToTime(timeInSeconds, play = false) {
            // if(this.mediaElement.readyState === 4){
            this.mediaElement.setCurrentTime(timeInSeconds);
            // }

            if (play && !this.isChromeCastConnected) {
                setTimeout(() => {
                    this.mediaElement.play();
                }, 100);
            }
        },

        initializeVideoPlayer() {
            const vm = this;
            const urlParams = QueryString.parse(window.location.search);

            const mediaplayer = new MediaElementPlayer(vm.elementId, {
                defaultVideoWidth: 1280,
                defaultVideoHeight: 720,
                autosizeProgress: false,
                startVolume: 1,
                preload: 'metadata',
                // stretching: 'responsive',
                stretching: 'fill',
                setDimensions: false,
                enableAutosize: false,
                features: vm.playerPlugins,
                jumpForwardInterval: 10,
                skipBackInterval: 10,
                speeds: ['0.5', '0.75', '1.00', '1.25', '1.5'],
                timeAndDurationSeparator: ' / ',
                defaultQuality: vm.defaultQuality,
                qualityText: 'Video Quality',
                markers: vm.chapters,
                markerWidth: 3,
                markerColor: '#ffffff',
                success: (mediaElement, node, player) => {
                    vm.mediaElement = mediaElement;
                    vm.addMediaElementEventListeners(vm.mediaElement);

                    vm.mediaElement.load();
                    vm.mediaElement.addEventListener('loadedmetadata', (event) => {
                        // Below code helps to fix the bug where the speed and
                        // quality selectors remain visible and bug out after clicking
                        // Still a work in progress
                        const interactionInputs = document.querySelectorAll('.mejs__qualities-selector-input, .mejs__speed-selector-input');
                        for (let i = 0; i < interactionInputs.length; i++) {
                            interactionInputs[i].addEventListener('change', this.emitCustomEvent);
                        }

                        player.container.addEventListener('touchstart', () => {
                            player.showControls();

                            if (!player.paused) {
                                player.startControlsTimer(player.options.controlsTimeoutMouseLeave);
                            }
                        });

                        if (this.currentSecond > 0 && urlParams.time == null) {
                            setTimeout(() => {
                                vm.jumpToTime(this.currentSecond, false);
                            }, 200);
                        }

                        if (this.checkForTimecode && urlParams.time != null) {
                            setTimeout(() => {
                                vm.jumpToTime(urlParams.time, false);
                            }, 200);
                        }

                        if (vm.elementId === 'lessonPlayer') {
                            vm.initializeCopyTimecodeCommand(vm);
                        }
                    });
                },
                error: (error) => {
                    console.error(error);
                },
            });

            return mediaplayer;
        },

        initializeCopyTimecodeCommand(vm) {
            // Copy the current timecode if the user hits ctrl + shift + alt +  c;
            const keyMap = {};
            ['keydown', 'keyup'].forEach((eventType) => {
                document.addEventListener(eventType, (e) => {
                    e = e || event;
                    keyMap[e.keyCode] = e.type === 'keydown';

                    if (keyMap[17] && keyMap[16] && keyMap[18] && keyMap[67]) {
                        vm.copyTimecodeToClipboard();
                    }
                });
            });
        },

        initializeChapterMarkerLinks() {
            document.body.addEventListener('click', (event) => {
                if (event.target.dataset.jumpToTime) {
                    this.jumpToTime(
                        event.target.dataset.jumpToTime,
                        true,
                    );
                    //Scroll To Top
                    document.getElementById('content-container').scrollTop = 0
                }
            });
        },
    },
};
</script>

<style lang="scss">
    @import '../../assets/sass/partials/variables';

    @each $key, $value in $brand_colors {
        ##{$key}Theme {
            .mejs__time-current { background:$value; }
            .mejs__speed-selected, .mejs__qualities-selected { color:$value; }
        }
    }
    @each $key, $value in $content_colors {
        ##{$key}Theme {
            .mejs__time-current { background:$value; }
            .mejs__speed-selected, .mejs__qualities-selected { color:$value; }
        }
        ##{$key}sTheme {
            .mejs__time-current { background:$value; }
            .mejs__speed-selected, .mejs__qualities-selected { color:$value; }
        }
    }

    #errorContainer {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;

        @include xSmallOnly {
            .title {
                font-size:14px;
            }
        }

        .error-icon {
            height:50px;
            min-height:50px;
            width:auto;

            @include small {
                height:150px;
                min-height:150px;
            }
        }
    }

    .media-element {

        .mejs__controls {
            height:96px;
        }

        .mejs__time-rail {
            position:absolute;
            bottom:4em;
            left:0;
            right:0;
            width:100%;
            box-sizing:border-box;
            padding:1em 1em 0;
            margin:0;
            height:16px;

            .mejs__time-total {
                width:calc(100% - 2em);
                height:6px;
                margin-top:0;
            }

            .mejs__time-marker {
                height:6px;
                pointer-events:none;
            }

            .mejs__time-current {
                background:#0b76db;
            }

            .mejs__time-buffering, .mejs__time-current, .mejs__time-hovered, .mejs__time-loaded {
                height:6px;
            }

            .mejs__time-handle, .mejs__time-handle-content {
                display:none;
            }
        }

        .mejs__fill-container {
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;

            .mejs__overlay {
                width:100%;
                height:100%;
            }

            .mejs__player {
                width:100%;
                height:100%;
                object-fit:contain;
            }
        }

        .mejs__skip-back-button {
            position:absolute;
            bottom:5em;
            left:1em;
        }

        .mejs__jump-forward-button {
            position:absolute;
            bottom:5em;
            right:1em;
        }

        .mejs__playpause-button {
            position:absolute;
            bottom:0;
            left:1em;
        }

        .mejs__time {
            position:absolute;
            bottom:0;
            left:5em;
        }

        .mejs__fullscreen-button {
            position:absolute;
            bottom:0;
            right:1em;
        }

        .mejs__volume-button {
            position:absolute;
            bottom:0;
            left:14.5em;
        }

        .mejs__chromecast-button,
        .mejs__airplay-button {
            position:absolute;
            bottom:0;
            right:14em;
        }

        .mejs__speed-button {
            position:absolute;
            bottom:0;
            right:5.5em;

            button {
                font-weight:700;
                font-family:'Open Sans', sans-serif;
            }

            .mejs__speed-selector {
                height:125px;

                .mejs__speed-selector-list-item {
                    margin:0;
                    padding:3px;

                    &:hover {
                        background-color: rgba(255, 255, 255, 0.4) !important;
                    }
                }
                .mejs__speed-selector-label {
                    font-weight:700;
                    font-family:'Open Sans', sans-serif;
                    margin-left:5px;

                    &.mejs__speed-selected {
                        color:#0b76db;
                    }
                }
            }
        }

        .mejs__qualities-button {
            position:absolute;
            bottom:0;
            right:10em;

            button {
                font-weight:700;
                font-family:'Open Sans', sans-serif;
            }

            .mejs__qualities-selector {

                .mejs__qualities-selector-list-item {
                    margin:0;
                    padding:3px;

                    &:hover {
                        background-color: rgba(255, 255, 255, 0.4) !important;
                    }
                }
                .mejs__qualities-selector-label {
                    font-weight:700;
                    font-family:'Open Sans', sans-serif;
                    margin-left:5px;

                    &.mejs__qualities-selected {
                        color:#0b76db;
                    }
                }
            }
        }
    }

    #currentTimeInSeconds {
        opacity:0;
        position:absolute;
        top:-9999px;
        left:-9999px;
    }
</style>
