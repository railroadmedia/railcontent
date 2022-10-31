<script setup>
import { ref, onBeforeMount } from 'vue';
import ContentLessonActionButtons from '../../vuesora/components/VideoResources/ContentLessonActionButtons.vue';
const props = defineProps({
    brand: {
        type: String
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
    partentTitle: {
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
        type: Array,
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
        type: [Number, String]
    },
    lockUnowned: {
        type: Boolean,
        default: false
    },
    assignments: {
        type: Array,
    },
    userName: {
        type: String,
    },
    userAvatar: {
        type: String,
    },
    userXp: {
        type: [Number, String],
    },
    userAccessLevel: {
        type: [Number, String]
    },
    isAdmin: {
        type: Boolean,
    }
});

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

                            <div class="flex flex-row flex-wrap play-complete-buttons">
                                <button
                                    :class="`tw-btn-primary tw-bg-${brand} hover:tw-bg-${brand}-600 tw-mr-3 tw-mb-3 song-play-button`">
                                    <i class="fas fa-play tw-mr-2 tw-text-base song-play-button"></i>
                                    Play
                                </button>

                                <button
                                    :class="`btn tw-mb-3 completeButton collapse-250 ${lessonProgress === 100 ? 'is-complete' : ''}`"
                                    data-tooltip="Mark Lesson as Complete" :data-content-id="contentId">

                                    <span :class="`incompleted bg-${themeColor} inverted text-${themeColor}`">
                                        <i class="fas fa-check"></i>
                                        <span class="ml-1 tw-text-lg">Mark as Complete</span>
                                    </span>

                                    <span :class="`completed bg-${themeColor} text-white`">
                                        <i class="fas fa-check"></i>
                                        <span class="ml-1 tw-text-lg">Completed</span>
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
                        :user-id="userId" />
                </div>


                <div v-if="assignments.length" style="height: 0px; overflow: hidden;">
                    <div class="flex flex-row pv-3">
                        <h1 class="heading dark:tw-text-white">Assignments</h1>
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-column">
                            <div v-for="(assignment, index) in assignments" :key="assignment.id" class="flex flex-row">
                                <div class="flex flex-column grow">
                                    <ContentAssignment :theme-color="assignment.themeColor"
                                        :brand="assignment.themeColor" :timecode="assignment.timecode"
                                        :id="assignment.id" :xp="assignment.xp" :title="assignment.title"
                                        :soundslice-slug="assignment.soundsliceSlug" :completed="assignment.completed"
                                        :position="index" :user-id="assignment.userId">
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
                    :user-id="userId" />
            </div>

        </div>
    </div>
</template>