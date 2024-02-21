<template>
  <PageHeaderLayout>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg" :additionalImgSrc="logo"
        :primaryCtaIcon="primaryCtaIcon" :primaryCtaText="primaryCtaText" :primaryCtaUrl="primaryCtaUrl">
        <template #header-info v-if="description">
          <!-- Tooltip/Modal content -->
        </template>
        <template #ctas>
          <div v-if="ctasInsideHero" class="tw-hidden sm:tw-flex tw-justify-between tw-items-center tw-w-full">
            <PageHeaderPrimaryCta :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
            <div class="tw-flex tw-items-center tw-flex-grow"
              :class="[progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end']">
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
          </div>
        </template>
      </PageHeaderHero>
    </template>
    <template v-slot:bottom-full>
      <div :class="ctasInsideHero ? 'sm:tw-hidden' : ''">
        <PageHeaderPrimaryCta class="tw-my-3" :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
      </div>
      <div :class="ctasInsideHero ? 'sm:tw-hidden' : ''" class="tw-flex tw-justify-between tw-items-center tw-w-full">
        <div v-if="isSongs"
          class="tw-flex tw-items-center tw-text-base tw-font-bold tw-text-[#002039] dark:tw-text-[#9EC0DC]">
          <div class="tw-flex tw-items-center" v-for="(item, index) in formattedInfoData" :key="item">
            <span>{{ item }}</span>
            <span v-if="index !== formattedInfoData.length - 1"
              class="tw-inline-block tw-h-[7px] tw-w-[7px] tw-mx-2 tw-rounded-full tw-bg-[#002039] dark:tw-bg-[#9EC0DC]"></span>
          </div>
        </div>
        <div class="tw-flex tw-items-center tw-flex-grow"
          :class="[progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end']">
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
  description: String,
});

const primaryCtaProps = computed(() => props.ctas?.find(cta => cta.type === 'primary')?.props || {});
const primaryCtaIcon = computed(() => primaryCtaProps.value.icon);
const primaryCtaText = computed(() => primaryCtaProps.value.text);
const primaryCtaUrl = computed(() => primaryCtaProps.value.url);

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.type !== 'primary') || []);

const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const isSongs = computed(() => props.pageType === 'songs');

const ctasInsideHero = computed(() => !isSongs.value);

const formattedInfoData = computed(() => {
  if (props.pageType && props.infoData) {
    switch (props.pageType) {
      case 'songs':
        if (props.infoData.artistsNumber !== undefined && props.infoData.songsNumber !== undefined) {
          return [`${props.infoData.artistsNumber} Artists`, `${props.infoData.songsNumber} Songs`];
        }
        break;
      case 'pack':
      case 'pack-bundle':
        if (props.infoData.lessons !== undefined && props.infoData.xp !== undefined) {
          return [`${props.infoData.lessons} Lessons`, `${props.infoData.xp} XP`];
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
