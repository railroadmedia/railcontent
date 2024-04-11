<template>
  <PageHeaderLayout>
    <template #top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg"
        :heroImgClasses="heroImgClasses" :additionalImgSrc="logo" :infoData="isSongsPage ? null : infoData">
        <template #header-description v-if="description">
          <div class="tw-flex tw-flex-col tw-h-full">
            <div class="tw-flex tw-grow tw-items-center">
              <span v-html="description" />
            </div>
          </div>
        </template>
      </PageHeaderHero>
    </template>
    <template #top-right v-if="!isSongsPage">
      <div :class="primaryCta ? 'tw-hidden sm:tw-flex' : 'tw-flex'">
        <PageHeaderCtasBox :ctas="ctas" />
      </div>
    </template>
    <template #bottom-full>
      <div class="tw-flex tw-items-center"
        :class="primaryCta || isPackBundlePage || isCoursePage ? 'tw-mt-4 sm:tw-mt-0' : ''">
        <div :class="primaryCta ? 'sm:tw-hidden tw-w-full' : ''">
          <PageHeaderPrimaryCta :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
        </div>
        <div class="tw-justify-between tw-items-center" :class="{
        'tw-flex tw-w-full': isSongsPage,
        'tw-flex sm:tw-hidden': isPackBundlePage || isCoursePage,
        'tw-hidden': !isSongsPage && !isCoursePage && !isPackBundlePage
      }">
          <PageHeaderRowInfo v-if="isSongsPage" class="tw-self-end" :infoData="infoData" />
          <div v-if="isSongsPage">See all artists >></div>
          <PageHeaderCtasBox :class="progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end'"
            :ctas="secondaryCtas" />
        </div>
      </div>
      <PageHeaderProgressBar v-if="progress" :progress="progress" class="tw-mt-4" />
    </template>
  </PageHeaderLayout>
</template>

<script setup>
import { computed, onUpdated, ref } from 'vue';

import PageHeaderLayout from './PageHeaderLayout.vue';
import PageHeaderHero from './PageHeaderHero.vue';
import PageHeaderPrimaryCta from './PageHeaderPrimaryCta.vue';
import PageHeaderProgressBar from './ProgressBar/PageHeaderProgressBar.vue';
import PageHeaderRowInfo from './PageHeaderRowInfo.vue';
import PageHeaderCtasBox from './PageHeaderCtasBox.vue';

const props = defineProps({
  pageType: String,
  contentId: String,
  iconName: String,
  title: String,
  subTitle: String,
  heroImg: String,
  heroImgClasses: String,
  additionalImgSrc: String,
  darkModeLogo: String,
  lightModeLogo: String,
  progressLabelText: String,
  progress: {
    type: [Number, String],
    default: null,
  },
  infoData: Object,
  ctas: Array,
  description: String,
});

console.log(props)

const primaryCta = computed(() => props.ctas?.find(cta => cta.type === 'PageHeaderPrimaryCta'));
const primaryCtaProps = computed(() => primaryCta.value?.props || {});
const primaryCtaIcon = computed(() => primaryCtaProps.value.icon);
const primaryCtaText = computed(() => primaryCtaProps.value.text);
const primaryCtaUrl = computed(() => primaryCtaProps.value.url);

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.type !== 'PageHeaderPrimaryCta') || []);
const hasSecondaryCtas = computed(() => secondaryCtas.value.length > 0);
const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const isDashboardPage = computed(() => props.pageType === 'dashboard')
const isNotificationsPage = computed(() => props.pageType === 'notifications')

const isCoachPage = computed(() => props.pageType === 'instructor')
const isCoursePage = computed(() => props.pageType === 'course')
const isPackOverviewPage = computed(() => props.pageType === 'pack')
const isPackBundlePage = computed(() => props.pageType === 'pack-bundle')
const isSongsPage = computed(() => props.pageType === 'songs');

const isLivePage = computed(() => props.pageType === 'live');
const isSchedulePage = computed(() => props.pageType === 'schedule');
const isLearningPathPage = computed(() => props.pageType === 'learning-path');

const isLearningPathLevelPage = computed(() => props.pageType === 'learning-path-level');
const isLearningPathCoursePage = computed(() => props.pageType === 'learning-path-course');

const isStudentReviewPage = computed(() => props.pageType === 'student-review');
const isStudentFocusPage = computed(() => props.pageType === 'student-focus');
const isStudentFocusCatalougePage = computed(() => isStudentReviewPage.value || isStudentFocusPage.value);

const isForumsPage = computed(() => props.pageType === 'forums');
const isForumThreadPage = computed(() => props.pageType === 'forum-thread');

// const ctasBesideHero = computed(() => isLivePage.value || isSchedulePage.value || isLearningPathPage.value || isLearningPathLevelPage.value || isLearningPathCoursePage.value || isStudentFocusCatalougePage.value || isForumsPage.value || isForumThreadPage.value || isNotificationsPage.value || isCoursePage.value || isPackOverviewPage.value || isPackBundlePage.value || isCoachPage.value || isDashboardPage.value);

const ctasAndInfoInsideHero = false;

// const progressBarData = computed(() => {
//   return {
//     progress: props.progress,
//     labelText: props.progressLabelText,
//     alwaysShow: isLearningPathPage.value || isLearningPathLevelPage.value || isLearningPathCoursePage.value
//   };
// });

const logo = computed(() => {
  return isDarkMode.value ? props.darkModeLogo : props.lightModeLogo;
})

onUpdated(() => {
  isDarkMode.value = JSON.parse(localStorage.getItem("darkMode"));
})
</script>
<style lang="scss" scoped>
.ctas-container {
  ::v-deep>* {
    margin-top: 0.5rem;
  }
}
</style>