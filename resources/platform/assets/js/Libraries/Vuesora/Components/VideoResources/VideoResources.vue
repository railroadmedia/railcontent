<template>
    <div>
        <div class="tw-flex tw-items-start tw-justify-between tw-mb-4 tw-flex-wrap">

            <div class="tw-text-[#00101D] dark:tw-text-white lg:tw-flex-1">
                <h1 class="heading tw-pt-2 tw-pr-4 xl:tw-pr-0 tw-text-xl md:tw-text-2xl">
                    {{ title }}
                </h1>
                <div class="tw-w-full tw-text-[16px] tw-leading-[24px] tw-flex tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-pt-[5px] tw-pb-2 tw-items-center">
                    <div class="tw-uppercase">{{ artistName }}</div>
                    <DotSeparator />
                    <DifficultyLabel class="tw-text-[16px] tw-leading-[24px]" :difficultyValue="difficulty" textCase="capitalize" />
                    <DotSeparator />
                    <div>{{ singularContentType }}</div>
                </div>
            </div>
            <!-- Video CTAs -->
            <div id="cta-container" class="tw-flex tw-items-start tw-pt-3 tw-overflow-auto sm:tw-overflow-visible tw-no-scrollbar lg:tw-ml-4 tw-pb-40 -tw-mb-36 lg:-tw-mb-40 tw-relative" @scroll="ctaContainerScroll">

                <div v-if="showLeftArrow" class="left-arrow tw-pl-2 tw-pr-6 tw-sticky tw-h-[34px] tw-top-1 tw-left-0 sm:tw-hidden tw-flex tw-items-center tw-z-50 -tw-mr-[42px]" @click="handleLeftArrow"><i class="fas fa-chevron-left dark:tw-text-white tw-text-[#18181B]"></i></div>
                <div v-if="showRightArrow" class="right-arrow tw-pl-6 tw-pr-2 tw-sticky tw-h-[34px] tw-top-1 tw-left-[calc(100%-36px)] sm:tw-hidden tw-flex tw-items-center tw-z-50 -tw-mr-[42px]" @click="handleRightArrow"><i class="fas fa-chevron-right dark:tw-text-white tw-text-[#18181B] "></i></div>

                <!-- Workouts Practice -->
                <div v-if="showPracticeButton" class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-h-[34px] tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white hover:tw-bg-[#00000026] hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white"
                        title="Open Workout Practice Tool"
                        @click="openPracticeSoundslice"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <svg class="tw-mr-1 tw-w-5 tw-h-5" width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M7.14135 8.1582C6.89929 8.1582 6.70306 8.35445 6.70306 8.59649V14.4656C6.44005 14.3541 6.13877 14.2942 5.8265 14.2942C5.38895 14.2942 4.973 14.4117 4.65364 14.6246C4.33734 14.8354 4.07336 15.1748 4.07336 15.609C4.07336 16.0432 4.33734 16.3827 4.65364 16.5934C4.973 16.8064 5.38895 16.9239 5.8265 16.9239C6.26405 16.9239 6.67999 16.8064 6.99936 16.5934C7.31565 16.3827 7.57963 16.0432 7.57963 15.609V10.7879H11.9625V14.4656C11.6995 14.3541 11.3982 14.2942 11.0859 14.2942C10.6484 14.2942 10.2324 14.4117 9.91304 14.6246C9.59674 14.8354 9.33276 15.1748 9.33276 15.609C9.33276 16.0432 9.59674 16.3827 9.91304 16.5934C10.2324 16.8064 10.6484 16.9239 11.0859 16.9239C11.5234 16.9239 11.9394 16.8064 12.2588 16.5934C12.575 16.3827 12.839 16.0432 12.839 15.609V8.59649C12.839 8.35445 12.6428 8.1582 12.4007 8.1582H7.14135ZM11.9625 9.91134V9.03477H7.57963V9.91134H11.9625ZM6.51312 15.3539C6.6727 15.4603 6.70306 15.5592 6.70306 15.609C6.70306 15.6589 6.6727 15.7578 6.51312 15.8641C6.3566 15.9685 6.11512 16.0473 5.8265 16.0473C5.53787 16.0473 5.29639 15.9685 5.13987 15.8641C4.98029 15.7578 4.94993 15.6589 4.94993 15.609C4.94993 15.5592 4.98029 15.4603 5.13987 15.3539C5.29639 15.2495 5.53787 15.1707 5.8265 15.1707C6.11512 15.1707 6.3566 15.2495 6.51312 15.3539ZM11.7725 15.3539C11.9321 15.4603 11.9625 15.5592 11.9625 15.609C11.9625 15.6589 11.9321 15.7578 11.7725 15.8641C11.616 15.9685 11.3745 16.0473 11.0859 16.0473C10.7973 16.0473 10.5558 15.9685 10.3993 15.8641C10.2397 15.7578 10.2093 15.6589 10.2093 15.609C10.2093 15.5592 10.2397 15.4603 10.3993 15.3539C10.5558 15.2495 10.7973 15.1707 11.0859 15.1707C11.3745 15.1707 11.616 15.2495 11.7725 15.3539Z"
                                      fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M1.5 3.47547C1.5 2.55704 2.24454 1.8125 3.16297 1.8125H9.90213C10.0232 1.8125 10.1393 1.86059 10.2249 1.9462L16.7571 8.47837C16.8427 8.56397 16.8908 8.68008 16.8908 8.80115V20.3662C16.8908 21.2847 16.1462 22.0292 15.2278 22.0292H3.16297C2.24454 22.0292 1.5 21.2847 1.5 20.3662V3.47547ZM3.16297 0.3125C1.41611 0.3125 0 1.72861 0 3.47547V20.3662C0 22.1131 1.41611 23.5292 3.16297 23.5292H15.2278C16.9747 23.5292 18.3908 22.1131 18.3908 20.3662V8.80115C18.3908 8.28226 18.1847 7.78462 17.8177 7.41771L11.2856 0.885541C10.9187 0.518629 10.421 0.3125 9.90213 0.3125H3.16297Z"
                                      fill="currentColor" />
                            </svg>
                            Practice
                        </div>
                    </button>
                </div>

                <!-- Info Button -->
                <div v-if="showInfoButton" class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full"
                        :class="openInfo ? 'tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white' : 'tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40'"
                        id="toggleInstructorInfo"
                        title="More Info"
                        @click="toggleInfo"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon icon-name="info" class="tw-w-6 tw-h-6 tw-mr-1" />
                            Info
                        </div>
                    </button>
                </div>

                <!-- Like Button -->
                <div class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full"
                        :class="hasLiked ? 'tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white' : 'tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40'"
                        :title="hasLiked ? 'Unlike' : 'Like'"
                        @click="likeContent"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon :icon-name="hasLiked ? 'thumb-like-filled' : 'thumb-like'" class="tw-w-6 tw-h-6 tw-mr-1" />
                            {{ totalLikes }}
                        </div>
                    </button>
                </div>

                <!-- Share Button -->
                <div v-if="showShareButton" class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                        title="Share"
                        @click="handleOpenModal"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon icon-name="share" class="tw-w-6 tw-h-6 tw-mr-1" />
                            Share
                        </div>
                    </button>
                </div>

                <!-- Add Button -->
                <div v-if="showAddToList" class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                        title="Add to Playlist"
                        @click="addToList"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon icon-name="plus" class="tw-w-6 tw-h-6 tw-mr-1 tw-transition-all" />
                            Add
                        </div>
                    </button>
                </div>

                <!-- Completed Button -->
                <div v-if="showCompleteButton" class="flex flex-column resource-button tw-pr-2">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                        @click="handleCompleteLesson"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon :icon-name="completed ? 'circle-check-filled' : 'circle-check'" class="tw-w-6 tw-h-6 tw-mr-1 tw-transition-all" :class="completed ? 'tw-text-[#16A34A]' : ''" />
                            <span>
                                {{ completed ? "Completed" : "Complete" }}
                            </span>
                        </div>
                    </button>
                </div>

                <!-- Resources Button -->
                <div v-if="resources.length > 0 && showResourceButton()" class="flex flex-column resource-button tw-pr-2 tw-relative">
                    <button
                        class="open-resources tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-3 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                        title="Download Resources"
                        @click="toggleResourceDropdown"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon icon-name="file" class="tw-w-6 tw-h-6 tw-mr-1" />
                            Resources
                        </div>
                    </button>

                    <transition name="grow-fade">
                        <ul v-show="resourceDropdown" class="tw-absolute tw-top-10 tw-right-2 tw-overflow-hidden tw-rounded tw-bg-white dark:tw-bg-[#081825] tw-z-50 tw-drop-shadow-lg">
                            <li v-for="resource in resources" :key="resource.resource_name">
                                <a
                                    class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                                    target="_blank"
                                    :key="resource.resource_name"
                                    :href="resource.resource_url"
                                    :aria-label="`Download ${resource.resource_name}`"
                                >
                                    <i class="fas tw-mr-1" :class="getResourceIcon(resource.resource_url)"></i>
                                    {{ resource.resource_name }}
                                </a>
                            </li>
                        </ul>
                    </transition>
                </div>

                <!-- More Button -->
                <div class="flex flex-column resource-button tw-relative">
                    <button
                        class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-1 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                        title="More"
                        @click="toggleMore"
                    >
                        <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                            <musora-icon icon-name="ellipsis" class="tw-w-6 tw-h-6 tw-transition-all" />
                        </div>
                    </button>

                    <!-- Dropdown -->
                    <ul
                        v-if="showMore"
                        class="tw-absolute tw-top-10 tw-right-0 tw-drop-shadow-lg tw-rounded tw-text-black dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-z-50"
                        v-click-outside="clickOutSideDropdown"
                    >
                        <!-- Resources -->
                        <li v-if="resources.length > 0 && !showResourceButton()" class="tw-group tw-relative">
                            <button
                                class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                            >
                                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                                    <musora-icon icon-name="file" class="tw-w-6 tw-h-6 tw-transition-all tw-mr-1" />
                                    Resources
                                </div>
                            </button>

                            <!-- Resource Dropdown -->
                            <ul class="tw-hidden group-hover:tw-block tw-absolute tw-top-0 tw-right-full tw-overflow-hidden tw-rounded tw-bg-white dark:tw-bg-[#081825] tw-z-50">
                                <li v-for="resource in resources">
                                    <a
                                        class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                                        target="_blank"
                                        :key="resource.resource_name"
                                        :href="resource.resource_url"
                                        :aria-label="`Download ${resource.resource_name}`"
                                    >
                                        <i class="fas tw-mr-1" :class="getResourceIcon(resource.resource_url)"></i>
                                        {{ resource.resource_name }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Report -->
                        <li class="tw-group tw-relative">
                            <button
                                class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm" @click="toggleReportModal"
                            >
                                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none tw-whitespace-nowrap">
                                    <div class="tw-h-6 tw-w-6 tw-flex tw-items-center tw-justify-center tw-mr-1">
                                        <FlagIcon class="tw-w-5 tw-h-5" />
                                    </div>
                                    Report An Issue
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <ReportModal
                v-if="showReportModal"
                :brand="brand"
                :logo="reportLogo"
                :user-name="reportUserName"
                :user-email="reportUserEmail"
                @onCloseModal="toggleReportModal"
            />

            <ModalRenderer v-if="showShareModal" @onClose="handleOpenModal"
                           key="ModalRendererOnVideoResource">
                <div class="tw-relative tw-w-full 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-h-full tw-flex tw-justify-center tw-items-center">
                    <button @click="handleOpenModal" aria-label="Close share modal"
                            class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
                        <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
                    </button>
                    <div class="tw-flex tw-flex-col tw-bg-white tw-rounded-[9px] shadow tw-w-full tw-mx-[45px] pa-3 tw-max-w-[768px]">
                        <h1 class="heading mb-2">Share Video Link</h1>
                        <div class="form-group mb-2">
                            <input id="shareableUrlInput" class="no-label mb-2" type="text" :value="shareUrl" />

                            <button id="copyUrlButton" class="btn" @click="copyTimecodeToClipboard">
                                <span class="text-white bg-grey-3"> Copy </span>
                            </button>
                        </div>

                        <div class="form-group mb-2">
                            <div class="flex flex-row form-group align-v-center">
                <span class="toggle-input mr-1">
                  <input id="includeTimecode" v-model="useTimecode" type="checkbox" readonly />

                  <span class="toggle">
                    <span class="handle"></span>
                  </span>
                </span>

                                <label for="includeTimecode" class="toggle-label pointer dense uppercase font-bold tiny">
                                    Start at Current Time
                                </label>
                            </div>
                        </div>

                        <p class="tiny font-italic tw-text-[#3F3F46]">
                            This link is only accessible by {{ toCapitalCase(brand) }} Members.
                        </p>
                    </div>
                </div>
            </ModalRenderer>
        </div>

        <CoachesInLesson v-if="instructors.length > 0" :instructors="instructors" :brand="brand"></CoachesInLesson>
    </div>
</template>

<script>
// TODO: REFACTOR THE MODAL OF THIS COMPONENT!
import Utils from '../../assets/js/helper-functions/utils.js';
import ThemeClasses from "../../mixins/ThemeClasses";
import ContentService from "../../assets/js/Services/content";
import CoachesInLesson from "./CoachesInLesson.vue";
import ModalRenderer from "../../../../Components/Modal/ModalRenderer.vue";
import ReportModal from "../../../../Components/Modal/ReportModal";
import { XIcon } from "@heroicons/vue/solid";
import { FlagIcon } from "@heroicons/vue/outline";
import DifficultyLabel from "../../../../Components/DifficultyLabel/DifficultyLabel.vue";
import DotSeparator from "./DotSeparator.vue";
import { contentTypes } from '../../../../utils';

export default {
    name: "VideoResources",
    components: {
        ReportModal,
        CoachesInLesson,
        ModalRenderer,
        XIcon,
        FlagIcon,
        DifficultyLabel,
        DotSeparator,
    },
    mixins: [ThemeClasses],
    props: {
        brand: {
            type: String,
            default: () => "drumeo",
        },

        difficulty: {
            type: [String, Number],
            default: () => "",
        },

        title: {
            type: String,
            default: () => "",
        },

        description: {
            type: String,
            default: () => "",
        },

        lessonType: {
            type: String,
            default: () => "",
        },

        thumbnailUrl: {
            type: String,
            default: () => "",
        },

        parentTitle: {
            type: String,
            default: () => null,
        },

        instructors: {
            type: Array,
            default: () => [],
        },

        isLiked: {
            type: Boolean,
            default: () => false,
        },

        isAdded: {
            type: Boolean,
            default: () => false,
        },

        showAddToList: {
            type: Boolean,
            default: () => true,
        },

        showPracticeButton: {
            type: Boolean,
            default: () => false,
        },

        showShareButton: {
            type: Boolean,
            default: () => true,
        },

        showCompleteButton: {
            type: Boolean,
            default: () => false,
        },

        showInfoButton: {
            type: Boolean,
            default: () => false,
        },

        likeCount: {
            type: [Number, String],
            default: () => 0,
        },

        userId: {
            type: [String, Number],
            default: () => null,
        },

        contentId: {
            type: [String, Number],
            default: () => null,
        },

        resources: {
            type: Array,
            default: () => [],
        },

        relatedLesson: {
            type: Object,
            default: {},
        },

        lesson: {
            type: Object,
            default: {},
        },

        reportLogo: {
            type: String,
            default: '',
        },

        reportUserName: {
            type: String,
            default: '',
        },

        reportUserEmail: {
            type: String,
            default: '',
        },
        artist: {
            type: String,
            default: null,
        },
    },

    data() {
        return {
            resourceDropdown: false,
            hasLiked: this.isLiked,
            totalLikes: this.likeCount,
            hasAdded: this.isAdded,
            useTimecode: true,
            showShareModal: false,
            showReportModal: false,
            completed: this.lesson.completed,
            openInfo: false,
            showMore: false,
            showLeftArrow: false,
            showRightArrow: false,
        };
    },

    computed: {
        shareUrl() {
            if (this.useTimecode) {
                return `${location.protocol}//${location.host}${location.pathname
                }?time=${Math.floor(this.getCurrentTime())}`;
            }

            return `${location.protocol}//${location.host}${location.pathname}`;
        },
        singularContentType() {
            return contentTypes[this.lessonType]?.singular || this.lessonType;
        },
        artistName() {
            if (this.artist) {
                return this.artist;
            }
            return this.instructors.length > 0 ? this.instructors[0].name : this.brand.toUpperCase();
        }
    },
    mounted() {
        document.addEventListener("click", (event) => {
            if (!event.target.matches(".open-resources")) {
                this.resourceDropdown = false;
            }
        });

        this.showRightArrowByDefault();
        window.addEventListener('resize', this.showRightArrowByDefault);
    },
    unmounted() {
        window.removeEventListener('resize', this.showRightArrowByDefault);
    },
    methods: {
        openPracticeSoundslice() {
            this.$emit('openPracticeSoundslice');
        },

        getCurrentTime() {
            if (this.$root.$refs?.mediaElementVueInstance) {
                return this.$root.$refs.mediaElementVueInstance.currentTime;
            }

            return 0;
        },
        handleOpenModal() {
            this.showShareModal = !this.showShareModal;
        },
        likeContent() {
            this.hasLiked = !this.hasLiked;

            if (this.hasLiked) {
                this.totalLikes += 1;
            } else {
                this.totalLikes -= 1;
            }

            ContentService.likeContentById({
                is_liked: this.hasLiked,
                content_id: this.contentId,
                user_id: this.userId,
            });
        },

        toCapitalCase: (string) => Utils.toCapitalCase(string),

        addToList() {
            const data = {
                content_id: this.contentId,
                name: this.title,
                thumbnail_url: this.thumbnailUrl,
                description: this.description,
                type: this.lessonType
            }
            window.openplaylistmodal({ modalType: 'addItem', content: data });
        },

        handleCompleteLesson() {
            //Send Request
            if (this.completed) {
                ContentService.resetContentProgress(this.contentId)
                    .then((resolved) => {
                        if (resolved) {
                            window.shownotification({
                                icon: 'check',
                                text: `Your progress has been reset.`
                            })
                        }
                    }).catch(() => {
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                });
            } else {
                ContentService.markContentAsComplete(this.contentId).then(() => {
                    if (this.completed) {
                        window.shownotification({
                            icon: 'check',
                            text: `You've completed this lesson!`
                        })
                    }
                }).catch(() => {
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                })

            }

            this.completed = !this.completed;
        },

        getResourceIcon(resource) {
            const urlParts = resource.split(".");
            const fileExtension = urlParts[urlParts.length - 1];
            const iconMap = {
                pdf: "fa-file-pdf",
                mp3: "fa-file-music",
                zip: "fa-file-archive",
            };

            return iconMap[fileExtension] || "fa-file-download";
        },

        copyTimecodeToClipboard() {
            const timecode = document.getElementById("shareableUrlInput");

            if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
                const editable = timecode.contentEditable;
                const { readOnly } = timecode;
                const range = document.createRange();
                const selection = window.getSelection();

                timecode.contentEditable = true;
                timecode.readOnly = false;
                range.selectNodeContents(timecode);
                selection.removeAllRanges();
                selection.addRange(range);
                timecode.setSelectionRange(0, 999999);
                timecode.contentEditable = editable;
                timecode.readOnly = readOnly;
            } else {
                timecode.select();
            }
            document.execCommand("copy");
            timecode.blur();
            this.handleOpenModal();

            window.shownotification({
                icon: 'check',
                text: 'Share the love! This URL has been copied, and is ready to share!'
            });
        },
        toggleInfo() {
            this.openInfo = !this.openInfo;

            const instructorInfo = document.getElementById('instructorInfo');
            instructorInfo.classList.toggle('active');

            if (this.openInfo) {
                instructorInfo.style.maxHeight = `${instructorInfo.scrollHeight}px`;
                instructorInfo.classList.add('tw-mb-4');
            } else {
                instructorInfo.style.maxHeight = '0';
                instructorInfo.classList.remove('tw-mb-4');
            }
        },
        toggleMore() {
            this.showMore = !this.showMore;
        },
        toggleResourceDropdown(){
            this.resourceDropdown = !this.resourceDropdown;
        },
        toggleReportModal(){
            this.showReportModal = !this.showReportModal;
        },
        clickOutSideDropdown(){
            this.showMore = false;
        },
        showResourceButton(){
            if(!this.showInfoButton || !this.showCompleteButton){
                return true;
            }

            return false
        },
        ctaContainerScroll(e){
            const { scrollLeft, clientWidth, scrollWidth } = e.target;
            if(scrollLeft < 25){
                this.showLeftArrow = false;
            } else {
                this.showLeftArrow = true;
            }

            if(scrollLeft + clientWidth > scrollWidth - 15){
                this.showRightArrow = false;
            } else {
                this.showRightArrow = true;
            }
        },
        handleLeftArrow(){
            const ctaContainer = document.getElementById('cta-container');
            ctaContainer.scrollLeft = 0;
            this.showLeftArrow = false;
        },
        handleRightArrow(){
            const ctaContainer = document.getElementById('cta-container');
            ctaContainer.scrollLeft = ctaContainer.scrollWidth - ctaContainer.clientWidth;
            this.showRightArrow = false;
        },
        showRightArrowByDefault(){
            const ctaContainer = document.getElementById('cta-container');

            if(ctaContainer) {
                if(ctaContainer.scrollWidth > ctaContainer.clientWidth + 15){
                    this.showRightArrow = true;
                } else {
                    this.showRightArrow = false;
                }
            }
        }
    },
};
</script>

<style scoped>
body.tw-dark .left-arrow {
    background: linear-gradient(90deg, rgba(0,12,23,1) 50%, rgba(255,255,255,0) 100%);
}

body .left-arrow {
    background: linear-gradient(90deg, rgba(249,249,249,1) 50%, rgba(255,255,255,0) 100%);
}

body.tw-dark .right-arrow {
    background: linear-gradient(270deg, rgba(0,12,23,1) 50%, rgba(255,255,255,0) 100%);
}

body .right-arrow {
    background: linear-gradient(270deg, rgba(249,249,249,1) 60%, rgba(255,255,255,0) 100%);
}
</style>