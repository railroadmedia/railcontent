<template>
  <PageHeaderLayout>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg" :additionalImgSrc="logo"
        :primaryCtaIcon="primaryCtaIcon" :primaryCtaText="primaryCtaText" :primaryCtaUrl="primaryCtaUrl">
        <template v-slot:header-info v-if="!isSongs && infoData && formattedInfoData">
          <p class="text-base	font-bold	tw-text-[#002039] dark:tw-text-[#E7EFF6]">
            {{ formattedInfoData }}
          </p>
        </template>
      </PageHeaderHero>
      <p v-if="isSongs"
        class="tw-mt-[20px] tw-text-base tw-font-bold tw-text-[#002039] dark:tw-text-[#E7EFF6] tw-uppercase">
        {{ formattedInfoData }}
      </p>
      <div class="sm:tw-hidden">
        <PageHeaderPrimaryCta class="tw-mt-3" :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
      </div>
    </template>
    <template v-slot:top-right>
      <div class="tw-flex tw-justify-between sm:tw-justify-end tw-items-center tw-w-full">
        <span v-if="progress"
          class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl sm:tw-text-xl md:tw-text-2xl lg:tw-text-3xl tw-font-bold">Your
          Progress - {{ progress }}%
        </span>
        <div>
          <component v-for="(cta, index) in secondaryCtas" :key="index" :is="resolveComponent(cta.type)"
            v-bind="cta.props" />
          <SongRequest v-if="isSongs" />
        </div>
      </div>
    </template>
    <template v-slot:bottom-full v-if="progress">
      <PageHeaderProgressBar :progress="progress" />
    </template>
  </PageHeaderLayout>
</template>

<script setup>
import { computed, defineProps, onUpdated, ref } from 'vue';

import PageHeaderLayout from './PageHeaderLayout.vue';
import PageHeaderHero from './PageHeaderHero.vue';
import PageHeaderPrimaryCta from './PageHeaderPrimaryCta.vue';
import PageHeaderProgressBar from './PageHeaderProgressBar.vue';

import SongRequest from '../Songs/SongRequest.vue';
import ResetProgressCta from './Ctas/ResetProgressCta.vue';
import DownloadResourcesCta from './Ctas/DownloadResourcesCta.vue';
import PageHeaderCta from './PageHeaderCta.vue';

const componentMap = {
  ResetProgressCta,
  DownloadResourcesCta,
  PageHeaderCta
};

const resolveComponent = (type) => componentMap[type];


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
  progress: {
    type: [Number, String],
    default: null,
  },
  infoData: Object,
  ctas: Array,
});

const primaryCtaProps = computed(() => props.ctas?.find(cta => cta.type === 'primary')?.props || {});
const primaryCtaIcon = computed(() => primaryCtaProps.value.icon);
const primaryCtaText = computed(() => primaryCtaProps.value.text);
const primaryCtaUrl = computed(() => primaryCtaProps.value.url);

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.type !== 'primary') || []);

const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const isSongs = computed(() => props.pageType === 'songs');

const formattedInfoData = computed(() => {
  if (props.pageType && props.infoData) {
    switch (props.pageType) {
      case 'songs':
        if (props.infoData.artistsNumber !== undefined && props.infoData.songsNumber !== undefined) {
          return `${props.infoData.artistsNumber} Artists | ${props.infoData.songsNumber} Songs`;
        }
        break;
      case 'pack':
      case 'pack-bundle':
        if (props.infoData.lessons !== undefined && props.infoData.xp !== undefined) {
          return `${props.infoData.lessons} Lessons | ${props.infoData.xp} XP`;
        }
        break;
      default:
        return null;
    }
  }
  return null;
});


const logo = computed(() => {
  return isDarkMode.value ? props.darkModeLogo : props.lightModeLogo;
})

onUpdated(() => {
  isDarkMode.value = JSON.parse(localStorage.getItem("darkMode"));
})

</script>
