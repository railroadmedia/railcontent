<template>
    <div class="tw-flex tw-flex-wrap tw-items-start tw-my-2">
        <!-- Likes Button -->
        <div class="tw-flex tw-mr-2 tw-mb-2">
            <button class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full"
                :class="hasLiked ? 'tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white' : 'tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40'"
                :title="hasLiked ? 'Unlike' : 'Like'" @click="likeContent">
                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                    <musora-icon :icon-name="hasLiked ? 'thumb-like-filled' : 'thumb-like'"
                        class="tw-w-6 tw-h-6 tw-mr-1" />
                    {{ totalLikes }}
                </div>
            </button>
        </div>

        <!-- Share Button -->
        <div class="tw-flex tw-mr-2">
            <button
                class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                title="Share" data-open-modal="shareVideoModal">
                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                    <musora-icon icon-name="share" class="tw-w-6 tw-h-6 tw-mr-1" />
                    Share
                </div>
            </button>
        </div>

        <!-- Resources -->
        <div v-if="resources?.length > 0" class="tw-flex tw-mr-2 relative">
            <button
                class="open-resources tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                title="Download Resources" @click="resourceDropdown = !resourceDropdown">
                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                    <musora-icon icon-name="file" class="tw-w-6 tw-h-6 tw-mr-1" />
                    Resources
                </div>
            </button>

            <transition name="grow-fade">
                <ul v-show="resourceDropdown"
                    class="tw-absolute tw-top-10 tw-right-2 tw-overflow-hidden tw-rounded tw-bg-white dark:tw-bg-[#081825] tw-z-50 tw-drop-shadow-lg">
                    <li v-for="resource in resources" :key="resource.resource_name">
                        <a class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                            target="_blank" :key="resource.resource_name" :href="resource.resource_url"
                            :aria-label="`Download ${resource.resource_name}`">
                            <i class="fas tw-mr-1" :class="getResourceIcon(resource.resource_url)"></i>
                            {{ resource.resource_name }}
                        </a>
                    </li>
                </ul>
            </transition>
        </div>

        <!-- Add to list button -->
        <div class="tw-flex tw-mr-2 relative">
            <button
                class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                title="Add to Playlist" @click="addToList">
                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                    <musora-icon icon-name="plus" class="tw-w-6 tw-h-6 tw-mr-1 tw-transition-all" />
                    Add
                </div>
            </button>
        </div>

        <!-- More Button -->
        <div class="tw-flex tw-flex-col tw-relative">
            <button
                class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-1 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
                title="More" @click="toggleMore">
                <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                    <musora-icon icon-name="ellipsis" class="tw-w-6 tw-h-6 tw-transition-all" />
                </div>
            </button>

            <!-- Dropdown -->
            <ul v-if="showMore"
                class="tw-absolute tw-top-10 tw-right-0 tw-drop-shadow-lg tw-rounded tw-text-black dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-z-50"
                v-click-outside="clickOutSideDropdown">
                <!-- Report -->
                <li class="tw-group tw-relative">
                    <button
                        class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                        @click="toggleReportModal">
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

    <div id="shareVideoModal" class="modal">
        <div class="flex flex-column bg-white corners-10 shadow pa-3">
            <h1 class="heading mb-2">
                Share Video Link
            </h1>
            <div class="form-group mb-2">
                <input id="shareableUrlInput" class="no-label mb-2" type="text" :value="shareUrl">
                <button id="copyUrlButton" class="btn" @click="copyTimecodeToClipboard">
                    <span class="text-white bg-grey-3 tw-shadow-none">
                        Copy
                    </span>
                </button>
            </div>

            <p class="tiny font-italic tw-text-[#3F3F46] dark:tw-text-white">
                This link is only accessible by {{ toCapitalCase(brand) }} Members.
            </p>
        </div>
    </div>

    <ReportModal v-if="showReportModal" :brand="brand" :logo="reportLogo" :user-name="reportUserName"
        :user-email="reportUserEmail" @onCloseModal="toggleReportModal" />

</template>

<script>
import Utils from '../../assets/js/helper-functions/utils.js';
import ThemeClasses from '../../mixins/ThemeClasses';
import ContentService from '../../assets/js/Services/content';
import ReportModal from "@collections/Modal/ReportModal";
import { FlagIcon } from "@heroicons/vue/outline";

export default {
    name: 'ContentLessonActionButtons',
    mixins: [ThemeClasses],
    components: {
        ReportModal,
        FlagIcon,
    },
    props: {
        reportLogo: {
            type: String,
            default: () => '',
        },
        reportUserEmail: {
            type: String,
            default: () => '',
        },
        reportUserName: {
            type: String,
            default: () => '',
        },
        brand: {
            type: String,
            default: () => 'drumeo',
        },

        thumbnailUrl: {
            type: String,
            default: ''
        },

        title: {
            type: String,
            default: () => '',
        },

        isLiked: {
            type: Boolean,
            default: () => false,
        },

        isAdded: {
            type: Boolean,
            default: () => false,
        },

        likeCount: {
            type: Number,
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

        contentType: {
            type: String,
            default: () => 'not-song',
        },

        resources: {
            type: Array,
            default: () => [],
        },

        description: {
            type: String,
            default: '',
        }
    },

    data() {
        return {
            resourceDropdown: false,
            showMore: false,
            hasLiked: this.isLiked,
            totalLikes: this.likeCount,
            hasAdded: this.isAdded,
            useTimecode: true,
            showReportModal: false,
        };
    },

    computed: {
        currentTime() {
            const { mediaElementVueInstance } = this.$root.$refs;

            if (mediaElementVueInstance) {
                return mediaElementVueInstance.currentTimeInSeconds;
            }

            return 0;
        },

        shareUrl() {
            return `${location.protocol}//${location.host}${location.pathname}`;
        },
    },
    mounted() {
        document.addEventListener('click', (event) => {
            if (!event.target.matches('.open-resources')) {
                this.resourceDropdown = false;
            }
        });
    },
    methods: {
        toggleMore() {
            this.showMore = !this.showMore;
        },
        toggleReportModal() {
            this.showReportModal = !this.showReportModal;
        },
        clickOutSideDropdown() {
            this.showMore = false;
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

        toCapitalCase: string => Utils.toCapitalCase(string),

        addToList() {
            //this.hasAdded = !this.hasAdded;
            window.openplaylistmodal({
                modalType: 'addItem', content: {
                    content_id: this.contentId,
                    type: this.contentType,
                    name: this.title,
                    thumbnail_url: this.thumbnailUrl,
                    description: this.description,
                }
            });
        },

        getResourceIcon(resource) {
            const urlParts = resource.split('.');
            const fileExtension = urlParts[urlParts.length - 1];
            const iconMap = {
                pdf: 'fa-file-pdf',
                mp3: 'fa-file-music',
                zip: 'fa-file-archive',
            };

            return iconMap[fileExtension] || 'fa-file-download';
        },

        copyTimecodeToClipboard() {
            const timecode = document.getElementById('shareableUrlInput');

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
            document.execCommand('copy');
            timecode.blur();
            window.closeAllModals();
            window.shownotification({
                icon: 'check',
                text: 'Share the love! This URL has been copied, and is ready to share!'
            });
        },
    },
};
</script>