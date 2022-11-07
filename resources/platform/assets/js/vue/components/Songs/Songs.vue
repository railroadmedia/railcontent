<script setup>
import { ref, onBeforeMount } from 'vue';
import ContentLessonActionButtons from '../../vuesora/components/VideoResources/ContentLessonActionButtons.vue';
const props = defineProps({
    brand: {
        type: String
    },
    resources: {
        type: Array,
    },
    themeColor: {
        type: String
    },
    backUrl: {
        type: String,
    },
    thumbnailUrl: {
        type: String,
    },
    songTitle: {
        type: String,
    },
    songArtist: {
        type: String,
    },
    songAlbum: {
        type: String,
    },
    songMeta: {
        type: String,
    },
    parentTitle: {
        type: String,
        default: null,
    },
    lessonProgress: {
        type: [Number, String]
    },
    instructors: {
        type: Array,
    },
    relatedLessons: {
        type: Object,
    },
    isLiked: {
        type: Boolean,
    },
    isAdded: {
        type: Boolean,
    },
    likeCount: {
        type: [Number, String]
    },
    contentId: {
        type: Number
    },
    lockUnowned: {
        type: Boolean,
        default: false
    },
    assignments: {
        type: Array,
    },
    userId: {
        type: Number,
    },
    userName: {
        type: String,
    },
    userAvatar: {
        type: String,
    },
    userXP: {
        type: [Number, String],
    },
    userAccessLevel: {
        type: [Number, String]
    },
    isAdmin: {
        type: Boolean,
    }
});
onBeforeMount(() => {
    console.log(props);
})

</script>

<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div id="lessonInfo" class="tw-flex xl:tw-flex-row tw-flex-col align-v-top ">
            <div class="tw-flex tw-flex-col tw-pr-0 xl:tw-pr-8 tw-grow tw-w-full">
                <a href="{{ backUrl ? backUrl : null }}"
                    class="tw-no-underline tw-transition tw-inline-flex tw-text-[#00101D] dark:tw-text-white tw-items-center tw-w-fit">
                    <i class="fas fa-arrow-circle-left tw-text-4xl tw-mr-2" aria-hidden="true"></i>
                    <span class="tw-font-bebas-neue tw-uppercase tw-text-xl">Back</span>
                </a>
                <div class="tw-flex tw-flex-col sm:tw-flex-row tw-py-4 song-content-container">
                    <div class="tw-flex tw-flex-col song-play-button song-album-cover sm:tw-mr-6 tw-mb-6 sm:tw-mb-0">
                        <div
                            class="tw-aspect-square sm:tw-max-w-[338px] tw-min-w-[175px] 2xl:tw-w-screen corners-10 flex-center flex-column shadow-md tw-bg-[#d1d1d1] dark:tw-bg-[#081825">
                            <img :src="thumbnailUrl" alt="Album Art" class="corners-10 tw-transition-opacity tw-w-full"
                                loading="lazy">
                            <div class="thumb-title flex-center text-center ph-1 rounded ba-white-2 hover-border-drumeo"
                                style="width: 80px; height: 80px; position: absolute;">
                                <div class="square heading rounded pointer text-white hover-text-drumeo shadow-md"
                                    style="width: 80px; height: 80px;">
                                    <i class="fas fa-play absolute-center" style="margin-left: 2px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-flex flex-column tw-w-full song-details">
                        <div>
                            <h1 class="text-black font-bold item-title heading dark:tw-text-white">{{ songTitle }}</h1>
                            <p class="text-grey-3 tw-text-lg dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] mt-1 mb-3">
                                {{ songArtist }} -
                                {{ songAlbum }} -
                                {{ songMeta }}
                            </p>

                            <div class="tw-flex tw-flex-col 3xl:tw-flex-row">
                                <button
                                    :class="`tw-btn-primary tw-bg-${brand} hover:tw-bg-${brand}-600 tw-mb-3 3xl:tw-mr-3 song-play-button`">
                                    <i class="fas fa-waveform tw-mr-2 tw-text-base song-play-button"></i>
                                    PLAY DRUMLESS TRACK
                                </button>

                                <button
                                    :class="`tw-btn-primary tw-bg-${brand} hover:tw-bg-${brand}-600 tw-mb-3 3xl:tw-mr-3 song-play-button`">
                                    <i class="fas fa-play tw-mr-2 tw-text-base song-play-button"></i>
                                    PLAY FULL TRACK
                                </button>

                                <button
                                    :class="`tw-btn-secondary tw-text-[#00101D] tw-box-border tw-leading-none tw-h-[50px] dark:tw-text-white hover:tw-bg-black/10 dark:hover:tw-bg-white/10 completeButton ${lessonProgress === 100 ? 'is-complete' : ''}`"
                                    data-tooltip="Mark Lesson as Complete" :data-content-id="contentId"
                                    @click="markAsComplete"
                                    >
                                    <span :class="`incompleted`">
                                        <i class="fas fa-check tw-mr-2 tw-text-base"></i>
                                        Mark as Complete
                                    </span>

                                    <span :class="`completed`">
                                        <i class="fas fa-check tw-mr-2 tw-text-base"></i>
                                        Completed
                                    </span>
                                </button>
                            </div>

                            <div class="flex-row content-lesson-action-buttons">
                                <ContentLessonActionButtons :theme-color="themeColor" :title="songTitle"
                                    :instructors="instructors" :parent-title="parentTitle" :is-liked="isLiked"
                                    :like-count="likeCount" :is-added="isAdded" :content-id="contentId"
                                    :user-id="userId" :resources="resources" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-column mb-3 hide-sm-up">
                    <div class="flex flex-row mb-2">
                        <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                            Related Lessons
                        </h6>
                    </div>

                    <content-catalogue catalogue-type="grid" :theme-color="themeColor" :use-theme-color="true"
                        :lock-unowned="lockUnowned" :pre-loaded-content="relatedLessons" :display-inline="true"
                        :user-id="String(userId)" />
                </div>


                <div v-if="assignments.length">
                    <div class="flex flex-row pv-3">
                        <h1 class="heading dark:tw-text-white">Assignments</h1>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-column">
                            <div v-for="(assignment, index) in assignments" :key="assignment.id" class="flex flex-row">
                                <div class="flex flex-column grow">
                                    <ContentAssignment :theme-color="assignment.themeColor"
                                        :brand="assignment.themeColor" :timecode="assignment.timecode"
                                        :id="assignment.id" :xp="assignment.xp" :title="'Original: ' + assignment.title"
                                        soundslice-slug="rqN4c" :completed="assignment.completed"
                                        :position="index" :user-id="assignment.userId">
                                    </ContentAssignment>
                                    <ContentAssignment :theme-color="assignment.themeColor"
                                        :brand="assignment.themeColor" :timecode="assignment.timecode"
                                        :id="assignment.id" :xp="assignment.xp" :title="'Original+Settings: ' + assignment.title"
                                        soundslice-slug="rqN4c" :completed="assignment.completed"
                                        :position="index" :user-id="assignment.userId" additional-param-config="&layout=3&show_chords=0&scroll_type=1&recording_idx=2">
                                    </ContentAssignment>
                                    <ContentAssignment :theme-color="assignment.themeColor"
                                        :brand="assignment.themeColor" :timecode="assignment.timecode"
                                        :id="assignment.id" :xp="assignment.xp" :title="'Removed+Settings: ' + assignment.title"
                                        soundslice-slug="rqN4c" :completed="assignment.completed"
                                        :position="index" :user-id="assignment.userId" additional-param-config="&layout=3&show_chords=0&scroll_type=1&recording_idx=1">
                                    </ContentAssignment>
                                </div>
                            </div>
                            <slot name="completionBonus"></slot>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row song-comments-container">
                    <comments :brand="brand" :theme-color="themeColor" :content-id="contentId" :user-id="userId"
                        :user-name="userName" :user-avatar="userAvatar"
                        :user-xp="userXP" :user-access-level="userAccessLevel"
                        :is-admin="isAdmin"></comments>
                </div>
            </div>

            <div class="mb-3 hide-xs-only xl:tw-max-w-[420px]">
                <div class="flex flex-row mb-2">
                    <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                        Related Lessons
                    </h6>
                </div>

                <content-catalogue catalogue-type="grid" :theme-color="themeColor" :use-theme-color="true"
                    :lock-unowned="lockUnowned" :pre-loaded-content="relatedLessons" :display-inline="true"
                    :user-id="String(userId)" />
            </div>

        </div>
    </div>
</template>