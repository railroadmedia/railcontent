<template>
  <PageHeaderLayout>

    <template #top-left>

      <template v-if="isLoading">
        <div class="tw-animate-pulse tw-flex tw-items-center">
          <!-- Icon or Image -->
          <div v-if="iconName" class="tw-bg-ui-skeleton tw-h-[35px] tw-w-[35px] tw-rounded-full tw-mr-2"></div>
          <!-- Title and Info -->
          <div class="tw-flex tw-flex-col tw-self-stretch tw-mr-1 tw-w-full">
            <div class="tw-h-full tw-flex tw-flex-col tw-items-start">
              <div class="tw-flex">
                <div class="tw-bg-ui-skeleton tw-h-[35px] tw-w-[270px] tw-rounded-full tw-flex tw-justify-center tw-items-center"></div>
              </div>
              <div v-if="infoData" class="tw-flex">
                <div class="tw-flex tw-items-center sm:tw-mt-1">
                  <div class="tw-bg-ui-skeleton tw-h-[24px] tw-w-[124px] tw-rounded-full tw-flex tw-justify-center tw-items-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <PageHeaderHero
        v-else
        :pageType="pageType"
        :iconName="iconName"
        :title="title"
        :subTitle="subTitle"
        :heroImg="heroImg"
        :heroImgClasses="heroImgClasses"
        :additionalImgSrc="logo"
        :infoData="isSongsPage || isPlaylistsPage ? null : infoData"
      >
        <template #header-description v-if="description">
          <div class="tw-flex tw-flex-col tw-h-full">
            <div class="tw-flex tw-grow tw-items-center">
              <span v-html="description" />
            </div>
          </div>
        </template>
        <template #right-of-text-hero v-if="isPlaylistsPage">
          <PlaylistCountBadge :playlistCount="infoData[0]" />
        </template>
      </PageHeaderHero>
    </template>
    <template #top-right>
      <div v-if="!isSongsPage" :class="primaryCta ? 'tw-hidden sm:tw-flex' : 'tw-flex'">
        <PageHeaderCtasBox v-if="ctas && ctas.length" :ctas="ctas" />
      </div>
    </template>
    <template #bottom-full>
      <div class="tw-flex tw-items-center"
        :class="primaryCta || isPackBundlePage || isCoursePage ? 'tw-mt-4 sm:tw-mt-0' : ''">
        <div :class="primaryCta ? 'sm:tw-hidden tw-w-full' : 'tw-hidden'">
          <PageHeaderCta v-bind="primaryCtaProps" />
        </div>
        <div class="tw-justify-between tw-items-center" :class="{
          'tw-flex tw-w-full': isSongsPage,
          'tw-flex sm:tw-hidden': isPackBundlePage || isCoursePage || isSongTutorialPage,
          'tw-hidden': !isSongsPage && !isCoursePage && !isPackBundlePage && !isSongTutorialPage
        }">
          <a v-if="isSongsPage" :href="songsPageLink.url"
            class="tw-text-[#002039] dark:tw-text-[#9EC0DC] tw-text-sm sm:tw-text-base tw-font-bold tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
            <span class="tw-uppercase">{{ songsPageLink.text }}</span>
            <i class="fa-solid fa-chevron-right tw-ml-1"></i>
          </a>
          <PageHeaderCtasBox v-if="ctas && ctas.length" :class="progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end'"
            :ctas="secondaryCtas" />
        </div>
      </div>
      <PageHeaderProgressBar v-if="progress" :progress="progress" class="tw-mt-4">
        <template #progress-text v-if="isLearningPathPage || isLearningPathLevelPage || isLearningPathCoursePage">
          <span>{{ `${progressLabelText} - ` }}</span>
        </template>
      </PageHeaderProgressBar>
    </template>

  </PageHeaderLayout>
</template>

<script setup>
import { computed, onUpdated, onMounted, ref } from 'vue';

import PageHeaderLayout from './PageHeaderLayout.vue';
import PageHeaderHero from './PageHeaderHero.vue';
import PageHeaderCta from './PageHeaderCta.vue';
import PageHeaderProgressBar from './ProgressBar/PageHeaderProgressBar.vue';
import PageHeaderRowInfo from './PageHeaderRowInfo.vue';
import PageHeaderCtasBox from './PageHeaderCtasBox.vue';
import PlaylistCountBadge from '@collections/Playlists/PlaylistCountBadge.vue';

const props = defineProps({
  pageType: String,
  contentId: [String, Number],
  iconName: String,
  title: String,
  subTitle: String,
  heroImg: String,
  heroImgClasses: String,
  additionalImgSrc: String,
  darkModeLogo: String,
  lightModeLogo: String,
  progressLabelText: String,
  isLoading: Boolean, 
  progress: {
    type: [Number, String],
    default: null,
  },
  infoData: {
    type: [Object, String],
    default: [],
  },
  ctas: Array,
  description: String,
});

const primaryCta = computed(() => props.ctas?.find(cta => cta.props?.isPrimary));
const primaryCtaProps = computed(() => primaryCta.value?.props || {});

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.props?.isPrimary !== true) || []);
const hasSecondaryCtas = computed(() => secondaryCtas.value.length > 0);
const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const isSettingsPage = computed(() => props.pageType === 'settings');
const isNotificationsPage = computed(() => props.pageType === 'notifications');

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

const isPlaylistsPage = computed(() => props.pageType === 'playlists');

const songsPageLink = computed(() => props.pageType === 'songs' ? props.infoData : null);
const isSongTutorialPage = computed(() => props.pageType === 'song-tutorial');

// const ctasBesideHero = computed(() => isLivePage.value || isSchedulePage.value || isLearningPathPage.value || isLearningPathLevelPage.value || isLearningPathCoursePage.value || isStudentFocusCatalougePage.value || isForumsPage.value || isForumThreadPage.value || isNotificationsPage.value || isCoursePage.value || isPackOverviewPage.value || isPackBundlePage.value || isCoachPage.value || isDashboardPage.value);

const ctasAndInfoInsideHero = false;

// const progressBarData = computed(() => {
//   return {
//     progress: props.progress,
//     labelText: props.progressLabelText,
//     alwaysShow: isLearningPathPage.value || isLearningPathLevelPage.value || isLearningPathCoursePage.value
//   };
// });

// onMounted( () => {
//   console.log('CTAs', props.ctas)
// })

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
