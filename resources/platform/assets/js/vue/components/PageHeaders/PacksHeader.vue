<template>
  <PageHeader>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :heroImg="heroImg" :additionalImgSrc="logo"
        :primaryCtaIcon="primaryCtaIcon" :primaryCtaText="primaryCtaText" :primaryCtaUrl="primaryCtaUrl">
        <template v-slot:header-info v-if="infoData">
          <p class="text-base	font-bold	tw-text-[#002039] dark:tw-text-[#E7EFF6]">
            {{ formattedInfoData }}
          </p>
        </template>
      </PageHeaderHero>
      <div class="sm:tw-hidden">
        <PageHeaderPrimaryCta class="tw-mt-3" :icon="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
      </div>
    </template>
    <template v-slot:top-right>
      <div class="tw-flex tw-justify-between sm:tw-justify-end tw-items-center tw-w-full">
        <span v-if="progress"
          class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl sm:tw-text-xl md:tw-text-2xl lg:tw-text-3xl tw-font-bold">Your
          Progress - {{ progress }}%</span>
        <div class="">
          <PageHeaderCta v-if="backToAllLessonsUrl" text="Back to all lessons" icon="fas fa-chevron-double-left"
            :href="backToAllLessonsUrl" />
          <PageHeaderCta v-if="areResourcesDownloadable" icon="fas fa-download" event="downloadResources"
            @downloadResources="downloadResources" />
          <PageHeaderCta v-if="enableResetProgress && progressMoreThanZero" :icon="resetIcon" event="resetProgressEvent"
            @resetProgressEvent="resetWithConfirmation" />
        </div>
      </div>
    </template>
    <template v-slot:bottom-full v-if="progress">
      <PageHeaderProgressBar :progress="progress" />
    </template>
  </PageHeader>
</template>

<script setup>
import {computed, defineProps, onMounted, onUpdated, ref} from 'vue';

import PageHeader from '../PageHeader/PageHeader.vue';
import PageHeaderHero from '../PageHeader/PageHeaderHero.vue';
import PageHeaderCta from '../PageHeader/PageHeaderCta.vue';
import PageHeaderProgressBar from '../PageHeader/PageHeaderProgressBar.vue';
import PageHeaderPrimaryCta from '../PageHeader/PageHeaderPrimaryCta.vue';
import { useResetProgress } from '../../hooks/useResetProgress';

const props = defineProps({
  contentId: String,
  iconName: String,
  title: String,
  heroImg: String,
  additionalImgSrc: String,
  darkModeLogo: String,
  lightModeLogo: String,
  primaryCtaIcon: String,
  primaryCtaText: String,
  primaryCtaUrl: String,
  progress: {
    type: [Number, String],
    default: null,
  },
  backToAllLessonsUrl: String,
  enableResetProgress: {
    type: Boolean,
    default: false,
  },
  infoData: Object,
  downloadableResources: Array,
});

const progressMoreThanZero = computed(() => {
  return props.progress > 0;
});

const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');
const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const emit = defineEmits(['progressReset']);

const { resetProgress } = useResetProgress();

const resetWithConfirmation = () => {
  resetProgress(props.contentId, resetIcon, true);
};

const areResourcesDownloadable = computed(() => {
  return props.downloadableResources?.length > 0;
});

const downloadResources = () => {
  console.log('downloadResources', props.downloadableResources);
  // TODO: show downloadable resources modal
};

const formattedInfoData = computed(() => {
  if (props.infoData) {
    const { lessons, xp } = props.infoData;
    return `${lessons} Lessons | ${xp} XP`;
  }
  return '';
});

const logo = computed(() => {
    return isDarkMode.value ? props.darkModeLogo : props.lightModeLogo;
})

onUpdated(() => {
    isDarkMode.value = JSON.parse(localStorage.getItem("darkMode"));
})

</script>
