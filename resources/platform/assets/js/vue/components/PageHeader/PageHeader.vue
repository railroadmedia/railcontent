<template>
  <PageHeaderLayout>
    <template #top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg"
        :heroImgClasses="heroImgClasses" :additionalImgSrc="logo" :infoData="ctasAndInfoInsideHero ? infoData : null"
        :hasCtas="ctasAndInfoInsideHero && hasSecondaryCtas">
        <template #header-info v-if="description">
          <div class="tw-flex tw-flex-col tw-h-full">
            <div class="tw-flex tw-grow tw-items-center">
              <span v-html="description" />
            </div>
            <div v-if="ctasBesideHero || isCoachPage"
              class="tw-flex tw-flex-col ctas-container sm:tw-hidden tw-flex-shrink-0">
              <CtaResolver :ctas="secondaryCtas" />
            </div>
          </div>
        </template>
        <template #ctas>
          <div v-if="ctasAndInfoInsideHero" class="tw-hidden sm:tw-flex tw-justify-between tw-items-end tw-w-full">
            <PageHeaderPrimaryCta :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
            <PageHeaderCtasBox :progressBarData="progressBarData" :secondaryCtas="secondaryCtas" />
          </div>
        </template>
      </PageHeaderHero>
    </template>
    <template #top-right v-if="ctasBesideHero">
      <div class="tw-flex">
        <ProgressText v-if="progress && isLearningPathPage" class="sm:tw-hidden" :progress="progressBarData.progress"
          :alwaysShow="progressBarData.alwaysShow">
          <template #progress-text v-if="progressBarData.labelText">{{ progressBarData.labelText }} -&nbsp;</template>
        </ProgressText>
        <PageHeaderCtasBox :class="{
        'tw-hidden sm:tw-flex': ctasBesideHero && !isNotificationsPage,
        'tw-flex': isNotificationsPage
      }" :progressBarData="progressBarData" :secondaryCtas="secondaryCtas" />
      </div>
    </template>
    <template #bottom-full>
      <div :class="ctasAndInfoInsideHero ? 'sm:tw-hidden' : ''">
        <PageHeaderPrimaryCta class="tw-mt-3" :faIconClass="primaryCtaIcon" :url="primaryCtaUrl"
          :text="primaryCtaText" />
      </div>
      <div class="tw-mt-3 tw-justify-between tw-items-center tw-w-full" :class="{
        'tw-flex': isSongsPage || isLearningPathLevelPage || isLearningPathCoursePage,
        'tw-flex sm:tw-hidden': isPackBundlePage || isForumThreadPage || isCoursePage,
        'tw-hidden': !isSongsPage && !isLearningPathLevelPage && !isLearningPathCoursePage && !isCoursePage && !isPackBundlePage && !isForumThreadPage
      }">
        <PageHeaderRowInfo v-if="isSongsPage || isLearningPathLevelPage || isLearningPathCoursePage" class="tw-self-end"
          :infoData="infoData" />
        <PageHeaderCtasBox
          :class="progress && !isLearningPathLevelPage && !isLearningPathCoursePage ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end'"
          :progressBarData="progressBarData" :secondaryCtas="secondaryCtas" />
      </div>
      <PageHeaderProgressBar v-if="progress" :progress="progress" />
    </template>
  </PageHeaderLayout>
</template>

<script setup>
import { computed, defineProps, onUpdated, ref } from 'vue';

import PageHeaderLayout from './PageHeaderLayout.vue';
import PageHeaderHero from './PageHeaderHero.vue';
import PageHeaderPrimaryCta from './PageHeaderPrimaryCta.vue';
import PageHeaderProgressBar from './ProgressBar/PageHeaderProgressBar.vue';
import PageHeaderRowInfo from './PageHeaderRowInfo.vue';
import PageHeaderCtasBox from './PageHeaderCtasBox.vue';
import CtaResolver from './Ctas/CtaResolver.vue'
import ProgressText from './ProgressBar/ProgressText.vue'

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

const primaryCtaProps = computed(() => props.ctas?.find(cta => cta.type === 'primary')?.props || {});
const primaryCtaIcon = computed(() => primaryCtaProps.value.icon);
const primaryCtaText = computed(() => primaryCtaProps.value.text);
const primaryCtaUrl = computed(() => primaryCtaProps.value.url);

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.type !== 'primary') || []);
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

const ctasBesideHero = computed(() => isLivePage.value || isSchedulePage.value || isLearningPathPage.value || isStudentFocusCatalougePage.value || isForumsPage.value || isForumThreadPage.value || isNotificationsPage.value);

const ctasAndInfoInsideHero = computed(() => isCoursePage.value || isPackOverviewPage.value || isPackBundlePage.value || isCoachPage.value || isDashboardPage.value);

const progressBarData = computed(() => {
  return {
    progress: props.progress,
    labelText: props.progressLabelText,
    alwaysShow: isLearningPathPage.value || isLearningPathLevelPage.value || isLearningPathCoursePage.value
  };
});

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