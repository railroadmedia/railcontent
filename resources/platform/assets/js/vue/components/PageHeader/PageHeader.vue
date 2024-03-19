<template>
  <PageHeaderLayout>
    <template #top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg"
        :additionalImgSrc="logo" :infoData="ctasAndInfoInsideHero ? infoData : null" :hasCtas="hasSecondaryCtas">
        <template #header-info v-if="description">
          <div class="tw-flex tw-flex-col tw-h-full">
            <div class="tw-flex tw-grow tw-items-center">
              <span v-html="description" />
            </div>
            <div v-if="ctasBesideHero" class="tw-flex tw-flex-col ctas-container tw-flex-shrink-0"
              :class="isStudentFocusCatalougePage ? 'lg:tw-hidden' : 'sm:tw-hidden'">
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
        'tw-hidden sm:tw-flex': isLearningPathPage || isLivePage || isSchedulePage || isStudentFocusCatalougePage || isForumsPage || isForumThreadPage,
      }" :progressBarData="progressBarData" :secondaryCtas="secondaryCtas" />
      </div>
    </template>
    <template #bottom-full>
      <div :class="ctasAndInfoInsideHero ? 'sm:tw-hidden' : ''">
        <PageHeaderPrimaryCta class="tw-my-3" :faIconClass="primaryCtaIcon" :url="primaryCtaUrl"
          :text="primaryCtaText" />
      </div>
      <div class="tw-justify-between tw-items-center tw-w-full" :class="{
        'tw-flex': isSongsPage || isLearningPathLevelPage || isLearningPathCoursePage,
        'tw-flex sm:tw-hidden': isPackBundlePage || isForumThreadPage || isCoursePage,
        'tw-hidden': !isSongsPage && !isCoursePage && !isPackBundlePage && !isLearningPathLevelPage && !isLearningPathCoursePage && !isForumThreadPage
      }">
        <PageHeaderRowInfo v-if="isSongsPage || isLearningPathLevelPage || isLearningPathCoursePage" class="tw-self-end"
          :infoData="infoData" />
        <PageHeaderCtasBox :progressBarData="progressBarData" :secondaryCtas="secondaryCtas" />
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

const isCoursePage = computed(() => props.pageType === 'course')
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

const ctasBesideHero = computed(() => isLivePage.value || isSchedulePage.value || isLearningPathPage.value || isStudentFocusCatalougePage.value || isForumsPage.value || isForumThreadPage.value);

const ctasAndInfoInsideHero = computed(() => isCoursePage.value || isPackBundlePage.value);

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