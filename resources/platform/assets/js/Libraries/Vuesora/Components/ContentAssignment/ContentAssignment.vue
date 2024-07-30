<template>
    <div class="flex flex-column assignment-component bb-grey-1-1 dark:tw-border-[#223F57]">
        <div class="flex flex-row align-v-center tw-flex-wrap md:tw-flex-nowrap pv-3">
            <div class="flex flex-column tw-w-full">
                <div class="flex flex-row align-v-center">
                    <div class="flex flex-column arrow-column hide-xs-only">
                        <button class="btn collapse-square" @click="openAssignment">
                            <span
                                class="tw-border-2 tw-border-solid tw-border-[#000C17] tw-text-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[50px] tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center">
                                <i class="fas" :class="accordionButtonIconClasses"></i>
                            </span>
                        </button>
                    </div>
                    <div class="flex flex-column">
                        <div class="flex flex-row align-v-center">
                            <div class="flex flex-column pointer" @click="openAssignment">
                                <h3 class="title noselect tw-text-[#00101D] dark:tw-text-white md:tw-mr-4">
                                    {{ title }}
                                </h3>
                            </div>
                            <div v-if="timecode != 0" class="flex flex-column flex-auto">
                                <a class="flex flex-column flex-auto tw-text-xs font-bold font-underline hide-xs-only ph-2"
                                    :class="brandTextColor" :data-jump-to-time="timecode">
                                    {{ formattedTimecode }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <button v-if="soundsliceSlug" title="Add To Playlist"
                        class="dark:tw-text-white tw-text-[#00101D] md:tw-hidden"
                        @click.stop.prevent="addToPlaylist({ content_id: id, brand: this.brand, type: 'General', name: lessonTitle, description: '', thumbnail_url: lessonThumbnail })">
                        <musora-icon icon-name="plus" class="tw-h-8 tw-w-8 font-bold" />
                    </button>
                </div>
            </div>
            <div class="flex flex-column tw-ml-auto complete-column tw-items-start">
                <div
                    class="flex-row md:tw-justify-end tw-flex-wrap md:tw-flex-nowrap tw-w-full"
                    :class="soundsliceSlug ? 'tw-grid tw-grid-cols-2 tw-gap-2 sm:tw-gap-0 sm:tw-flex' : 'tw-flex'"
                >
                    <button id="open-exercise-button" v-if="soundsliceSlug"
                        class="tw-btn-secondary dark:tw-text-white tw-text-[#00101D] tw-mb-2 md:tw-mb-0 md:tw-mr-2 tw-w-full md:tw-w-[250px]"
                        @click="openExercise">
                        <i class="fas fa-play mr-1"></i> Practice
                    </button>

                    <button class="tw-w-full md:tw-w-[250px] md:tw-mr-2 tw-mb-2 md:tw-mb-0"
                        :class="isComplete ? `tw-btn-primary tw-bg-[#00101D] dark:tw-bg-white tw-text-white dark:tw-text-[#00101D]` : `tw-btn-secondary tw-text-[#00101D] dark:tw-text-white`"
                        :disabled="isRequesting" @click.stop="markAsComplete">
                        <i class="fas fa-check mr-1"></i>
                        {{ isComplete ? 'Completed' : 'Complete' }}
                    </button>

                    <!-- New Add To Playlist Button -->
                    <button v-if="soundsliceSlug" title="Add To Playlist"
                        class="dark:tw-text-white tw-text-[#00101D] tw-hidden md:tw-block"
                        @click.stop.prevent="addToPlaylist({ content_id: id, brand: this.brand, type: 'General', name: lessonTitle, description: '', thumbnail_url: lessonThumbnail })">
                        <musora-icon icon-name="plus" class="tw-h-10 tw-w-10 font-bold" />
                    </button>
                </div>
            </div>
        </div>
        <transition name="slide-down-fade">
            <div v-if="accordionActive && thisAssignment != null" v-show="!accordionLoading" class="flex flex-column">
                <div v-show="$_description.length > 0" class="flex flex-row tw-pb-6">
                    <div class="body tw-text-[#00101D] dark:tw-text-white tw-text-[13px] sm:tw-text-base" v-html="$_description">
                    </div>
                </div>
                <div v-show="$_totalPages > 0" class="flex flex-row tw-pb-6">
                    <div ref="carouselWrap" class="flex flex-column grow">
                        <div class="flex flex-column">
                            <div ref="carouselContainer"
                                class="flex flex-row carousel tw-bg-white overflow tw-mb-3 tw-p-3 tw-rounded">
                                <div class="flex flex-row">
                                    <div v-for="(page, i) in $_sheet_music_pages" :key="'page' + (i + 1)"
                                        class="flex flex-column xs-12 grow page" :style="pageScrollPosition">
                                        <img class="sheet-music-image" :src="page">
                                    </div>
                                </div>

                                <div v-if="currentPage > 1"
                                    class="side-button prev flex-center tw-rounded-md dark:hover:tw-bg-gray-300/40"
                                    @click="scrollToPage(currentPage - 1)">
                                    <i class="fas fa-chevron-left"></i>
                                </div>

                                <div v-if="currentPage < $_totalPages"
                                    class="side-button next flex-center tw-rounded-md dark:hover:tw-bg-gray-300/40"
                                    @click="scrollToPage(currentPage + 1)">
                                    <i class="fas fa-chevron-right"></i>
                                </div>

                                <div v-if="$_totalPages > 1" class="page-buttons">
                                    <div v-for="(page, i) in pages" :key="'pageButton' + (i + 1)"
                                        class="page-button mh-1 rounded bg-black" :class="currentPageClass(i + 1)"
                                        @click="scrollToPage(i + 1)"></div>
                                </div>
                            </div>
                            <div v-if="timecode != 0" class="flex flex-row hide-sm-up">
                                <a class="tiny font-bold font-underline" :class="brandTextColor"
                                    :data-jump-to-time="timecode">
                                    {{ formattedTimecode }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-column pa-2 sm-3 hide-xs-only" :class="imageTypeSpacerClass"></div>
                    <!--Spacer-->
                </div>
            </div>
        </transition>

        <transition name="show-from-bottom">
            <div v-if="open" id="practiceOverlay" class="bg-white">
                <SoundSlice :user-id="userId" :theme-color="themeColor" :additional-params="additionalParams"
                    :soundslice-slug="soundsliceSlug" :content-id="lessonId" :loading="loading"
                    @onLoad="loading = false" @onPlay="handlePlay" @onPause="handlePause">
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls :title="title" :disable-next="disableNext" :disable-prev="disablePrev"
                            @onGoToPrevious="goToPrevious" @onGoToNext="goToNext" @onClose="closeExercise" />
                    </template>
                </SoundSlice>
            </div>
        </transition>
    </div>
</template>

<script>
import { Duration } from 'luxon';
import ContentService from '../../assets/js/Services/content';
import Utils from '../../assets/js/classes/utils';
import ProgressTracker from '../../assets/js/classes/progress-tracker';
import Intercom from "../../assets/js/Services/intercom"
import Helpscout from "../../assets/js/Services/helpscout"
import { bgColor, textColor } from "@constants/brands";
import SoundSlice from '@collections/SoundSlice/SoundSlice.vue'
import SoundSliceControls from '@collections/SoundSlice/SoundSliceControls.vue';

export default {
    name: 'ContentAssignment',
    components: {
        SoundSlice,
        SoundSliceControls,
    },
    props: {
        lessonThumbnail: {
            type: String,
            default: () => '',
        },
        lessonTitle: {
            type: String,
            default: () => '',
        },
        lessonId: {
            type: [Number, String],
            default: () => 0,
        },
        brand: {
            type: String,
            default: () => 'drumeo',
        },
        themeColor: {
            type: String,
            default: () => 'drumeo',
        },
        position: {
            type: [String, Number],
            default: () => null,
        },
        title: {
            type: String,
            default: () => '',
        },
        id: {
            type: [Number, String],
            default: () => 0,
        },
        description: {
            type: String,
            default: () => '',
        },
        additionalParams: {
            type: String,
            default: '',
        },
        pages: {
            type: Array,
            default: () => [],
        },
        soundsliceSlug: {
            type: String,
            default: () => '',
        },
        nextSoundsliceSlug: {
            type: String,
            default: () => '',
        },
        prevSoundsliceSlug: {
            type: String,
            default: () => '',
        },
        timecode: {
            type: [Number, String],
            default: () => 0,
        },
        xp: {
            type: [Number, String],
            default: () => 0,
        },
        completed: {
            type: Boolean,
            default: false,
        },
        forceOpen: {
            type: Boolean,
            default: false,
        },
        disablePrev: {
            type: Boolean,
            default: true,
        },
        disableNext: {
            type: Boolean,
            default: true,
        },
        userId: {
            type: [Number, String],
            default: () => 0,
        },
    },
    watch: {
        forceOpen: function (newVal, __oldVal) {
            if (newVal) {
                this.openExercise();
            }
        }
    },
    data() {
        return {
            progressTracker: null,
            progressTrackerEventListener: null,
            currentPage: 1,
            totalPages: this.pages.length || 0,
            open: false,
            loading: true,
            isPlaying: false,
            hasBeenPlayed: false,
            accordionActive: false,
            accordionLoading: false,
            thisAssignment: {
                id: 0,
                sheet_music_image_url: [],
                soundslice_slug: '',
                description: '',
            },
            isRequesting: false,
            isComplete: this.completed,
            ssEventTimeout: null,
        };
    },
    computed: {
        brandTextColor() {
            return textColor[this.brand];
        },

        brandBgColor() {
            return bgColor[this.brand];
        },

        pageScrollPosition() {
            return `transform:translateX(-${100 * (this.currentPage - 1)}%)`;
        },

        accordionButtonClasses() {
            return {
                inverted: this.accordionActive,
                'text-grey-3 dark:tw-text-[#7E9AB1] dark:tw-border-[#7E9AB1]': this.accordionActive,
                'dark:tw-bg-[#7E9AB1] dark:tw-text-[#000C17] text-white': !this.accordionActive,
            };
        },

        accordionButtonIconClasses() {
            return {
                'fa-chevron-down': !this.accordionActive && !this.accordionLoading,
                'fa-chevron-up': this.accordionActive && !this.accordionLoading,
                'fa-spinner': this.accordionActive && this.accordionLoading,
                'fa-spin': this.accordionActive && this.accordionLoading,
            };
        },

        $_totalPages() {
            return this.$_sheet_music_pages ? this.$_sheet_music_pages.length : 0;
        },

        $_sheet_music_pages() {
            if (Array.isArray(this.thisAssignment.sheet_music_image_url)) {
                return this.thisAssignment.sheet_music_image_url;
            }

            return this.thisAssignment.sheet_music_image_url ? [this.thisAssignment.sheet_music_image_url] : [];
        },

        $_soundslice_slug() {
            return this.thisAssignment.soundslice_slug || '';
        },

        $_description() {
            return this.thisAssignment.description || '';
        },

        formattedTimecode() {
            const duration = Duration.fromMillis((this.timecode * 1000));

            if (this.timecode < 3600) {
                return duration.toFormat('m:ss');
            }

            return duration.toFormat('h:mm:ss');
        },

        imageTypeSpacerClass() {
            return {
                'sm-9': this.thisAssignment.sheet_music_image_type === 'quarter-width',
                'sm-6': this.thisAssignment.sheet_music_image_type === 'half-width',
                'sm-3': this.thisAssignment.sheet_music_image_type === 'full-width' || this.thisAssignment.sheet_music_image_type == null,
            };
        },

        carouselWidth: {
            cache: false,
            get() {
                const { carouselWrap } = this.$refs;

                if (carouselWrap) {
                    return carouselWrap.clientWidth;
                }

                return 1100;
            },
        },
    },
    mounted() {
        if (this.position < 3) {
            this.openAssignment();
        }

        window.addEventListener('requesting-completion', this.setIsRequesting);
        window.addEventListener('lesson-complete', this.syncCompleteState);
    },
    beforeDestroy() {
        window.addEventListener('requesting-completion', this.setIsRequesting);
        window.removeEventListener('lesson-complete', this.syncCompleteState);
    },
    methods: {
        addToPlaylist(data) {
            window.openplaylistmodal({ modalType: 'addItem', brand: this.brand, content: data });
        },

        scrollToPage(page) {
            this.currentPage = page;
        },

        currentPageClass(page) {
            return page !== this.currentPage ? 'inverted' : '';
        },

        openAssignment() {
            if (this.thisAssignment.id === 0) {
                this.accordionLoading = true;

                ContentService.getContentById(this.id)
                    .then((response) => {
                        if (response) {
                            this.thisAssignment = Utils.flattenContent(response.data.data)[0];

                            this.accordionActive = !this.accordionActive;

                            setTimeout(() => {
                                this.accordionLoading = false;
                            }, 250);
                        }
                    });
            } else {
                this.accordionActive = !this.accordionActive;
            }

            Helpscout.hideWidget();
            Intercom.hideWidget();
        },

        openExercise() {
            this.$emit('force-current');
            this.open = true;
            document.body.classList.add('no-scroll', 'dim-sidebar');

            this.progressTracker = new ProgressTracker();

            Helpscout.hideWidget();
            Intercom.hideWidget();
        },

        goToPrevious() {
            this.$emit('force-prev');
            this.closeExercise();
        },

        goToNext() {
            this.$emit('force-next');
            this.closeExercise();
        },

        closeExercise() {
            this.loading = true;
            this.open = false;
            document.body.classList.remove('no-scroll', 'dim-sidebar');

            this.progressTracker.sendAsync({
                mediaId: this.id,
                mediaType: 'assignment',
                mediaCategory: 'soundslice',
            });

            this.progressTracker = null;

            window.removeEventListener('unload', () => this.sendProgressTracking);

            Helpscout.showWidget();
            Intercom.showWidget();
        },

        markAsComplete(event) {
            const element = event.target;
            const vm = this;

            Utils.triggerEvent(window, 'vue-requesting-completion');

            if (this.isComplete) {
                window.showconfirmationmodal({
                    title: 'Hold your horses… This will reset all of your progress, are you sure about this?',
                    subtitle: 'This cannot be undone.',
                    callbacks: {
                        submit: () => {
                            this.isComplete = !this.isComplete;

                            window.recalculateProgress(false, false, this.themeColor);

                            ContentService.resetContentProgress(vm.id)
                                .then((resolved) => {
                                    if (resolved) {
                                        element.classList.add('remove-request-complete');

                                        window.shownotification({
                                            icon: 'check',
                                            text: 'Ready to start again? Your progress has been reset.'
                                        });

                                        this.$emit('assignmentComplete', {
                                            complete: false,
                                        });

                                        Utils.triggerEvent(window, 'vue-request-complete');
                                    }
                                    this.isRequesting = false;
                                });
                        },
                        cancel: () => {
                            console.log('Reset progress cancelled');
                        }
                    }
                });
            } else {
                this.isComplete = !this.isComplete;

                window.recalculateProgress(true, false, this.themeColor);

                ContentService.markContentAsComplete(vm.id)
                    .then((resolved) => {
                        if (resolved) {
                            element.classList.add('add-request-complete');

                            this.$emit('assignmentComplete', {
                                complete: true,
                            });

                            Utils.triggerEvent(window, 'vue-request-complete');
                        }

                        this.isRequesting = false;
                    });
            }
        },

        setIsRequesting() {
            this.isRequesting = !this.isRequesting;
            this.isRequesting = !this.isRequesting;
        },

        syncCompleteState(complete) {
            this.isComplete = complete.detail.complete;
            this.isRequesting = false;
        },

        sendProgressTracking() {
            this.progressTracker.send({
                mediaId: this.id,
                mediaType: 'assignment',
                mediaCategory: 'soundslice',
            });
        },

        handlePlay() {
            if (!this.hasBeenPlayed) {
                this.hasBeenPlayed = true;
                ContentService.markContentAsStarted(this.id);
            }

            this.progressTracker.start();

            if (!this.progressTrackerEventListener) {
                this.progressTrackerEventListener = true;

                window.addEventListener('unload', this.sendProgressTracking);
            }
        },

        handlePause() {
            this.progressTracker.stop();
        },
    },
};
</script>

<style lang="scss">
@import '../../assets/sass/partials/variables';

.flex.arrow-column {
    display: flex;
    flex: 0 0 60px;
    padding-right: 10px;
}

.complete-column {
    margin-top: calc(#{$gutterWidth} / 2);

    @include medium {
        margin-top: 0;
    }
}

.assignment-title {
    @include small {
        flex: 0 0 auto;
    }
}

#practiceOverlay {
    position: fixed;
    top: 58px;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1050;

    .loading-exercise {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}

.embed-column {
    height: 100%;
}

#ssEmbed {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.carousel {
    position: relative;

    .page {
        transform: translateX(0);
        will-change: transform;
        transition: transform .4s ease-in-out;

        img {
            width: 100%;
        }
    }

    .side-button {
        position: absolute;
        top: 0;
        height: 100%;
        background-color: transparent;
        will-change: background-color;
        transition: background-color .2s ease-in-out;
        cursor: pointer;
        width: $gutterWidth;

        i {
            font-size: 20px;
        }

        &:hover {
            background-color: #f2f2f2;
        }

        &.prev {
            left: 0;
        }

        &.next {
            right: 0;
        }
    }

    .page-buttons {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;

        .page-button {
            height: 12px;
            width: 12px;
            display: inline-block;
            border-width: 2px;
            cursor: pointer;
        }
    }
}
</style>
