<script setup>
import { onMounted, ref } from 'vue';
    import BreadCrumb from './Breadcrumb.vue';
    import ContentCatalogue from "../../vuesora/views/catalogues/ContentCatalogue";

    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo',
        },
        userId: {
            type: String,
            default: 0,
        },
        breadcrumbs: {
            type: [Array, Object],
            default: {},
        },
        lessonList: {
            type: Array,
            default: () => []
        },
        lockUnowned: {
            type: Boolean,
            default: false,
        },
        contentDescription: {
            type: String,
            default: '',
        },
        contentChapters: {
            type: Array,
            default: () => []
        },
        instructors: {
            type: Array,
            default: () => []
        },
        lessonData: {
            type: Array,
            default: () => []
        },
    });

    const chapterList = ref([]);

    onMounted(() => {
        let chapters = [...props.contentChapters];

        chapters.forEach((c) => {
            let date = new Date(null);
            date.setSeconds(c.chapter_timecode);
            c.chapter_time = date.toISOString().substr(11, 8);
        });

        chapterList.value = chapters;
    });
</script>

<template>
    <div id="instructorInfo" class="tw-container tw-mx-auto fluid tw-bg-white dark:tw-bg-[#081825] tw-rounded-[10px]">
        <div class="tw-max-w-screen-2xl tw-px-4 md:tw-px-8 tw-mx-auto tw-py-4">
            <!-- BREADCRUMBS -->
            <BreadCrumb
                v-if="breadcrumbs && Object.keys(breadcrumbs).length"
                :brand="brand"
                :firstLevelUrl="breadcrumbs.firstLevelUrl"
                :firstLevelTitle="breadcrumbs.firstLevelTitle"
                :secondLevelUrl="breadcrumbs.secondLevelUrl"
                :secondLevelTitle="breadcrumbs.secondLevelTitle"
                :lastLevelTitle="breadcrumbs.lastLevelTitle"
            />

            <!-- COURSE LESSONS -->
            <template v-if="lessonList && lessonList.length">
                <div class="tw-flex tw-flex-row">
                    <h6 class="body tw-font-bold tw-uppercase tw-text-[#191b1c] dark:tw-text-white tw-mb-1">Course Lessons</h6>
                </div>
                <div class="tw-flex tw-flex-row dark-mode tw-mb-3">
                    <ContentCatalogue
                        catalogue-type="list"
                        :theme-color="brand"
                        :use-theme-color="true"
                        :pre-loaded-content="lessonList"
                        :lock-unowned="lockUnowned"
                        :user-id="userId"
                    >
                    </ContentCatalogue>
                </div>
            </template>

            <!-- CONTENT DESCRIPTION -->
            <div v-if="contentDescription" class="tw-flex tw-flex-row tw-mb-3">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-text-[#191b1c] dark:tw-text-white">
                    <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">About the Lesson</h6>
                    <div v-html="contentDescription"></div>
                </div>
            </div>

            <!-- CHAPTER MARKERS -->
            <div v-if="chapterList && chapterList.length" class="tw-flex tw-flex-row tw-mb-3">
                <div class="tw-flex tw-flex-col tw-flexgrow tw-text-[#191b1c] dark:tw-text-white">
                    <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">Chapter Markers</h6>
                    <template v-for="chapter in chapterList">
                        <p class="body tw-text-[#191b1c] dark:tw-text-white" v-if="chapter['chapter_timecode']">
                            <a class="tw-font-bold font-underline"
                               :data-jump-to-time="chapter.chapter_timecode">{{ chapter.chapter_time }}</a> - {{ chapter.chapter_description }}
                        </p>
                    </template>
                </div>
            </div>

            <!-- INSTRUCTORS -->
            <div v-if="instructors && instructors.length"  class="tw-flex tw-flex-row mb-3" v-for="instructor in instructors">
                <div class="tw-flex tw-flex-col tw-flexgrow tw-text-[#191b1c] dark:tw-text-white">
                    <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">About {{ instructor.name }}</h6>
                    <div v-html="instructor.data.find((i) => i.key === 'biography').value"></div>
                </div>
            </div>
        </div>
    </div>
</template>
