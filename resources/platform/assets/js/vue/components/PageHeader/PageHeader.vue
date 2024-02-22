<template>
  <PageHeaderLayout>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :subTitle="subTitle" :heroImg="heroImg" :additionalImgSrc="logo"
        :infoData="ctasAndInfoInsideHero ? infoData : null">
        <template #header-info v-if="description">
          <!-- Tooltip/Modal content -->
        </template>
        <template #ctas>
          <div v-if="ctasAndInfoInsideHero" class="tw-hidden sm:tw-flex tw-justify-between tw-items-end tw-w-full">
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
              </div>
            </div>
          </div>
        </template>
      </PageHeaderHero>
    </template>
    <template v-slot:bottom-full>
      <div :class="ctasAndInfoInsideHero ? 'sm:tw-hidden' : ''">
        <PageHeaderPrimaryCta class="tw-my-3" :faIconClass="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
      </div>
      <div :class="ctasAndInfoInsideHero ? 'sm:tw-hidden' : ''"
        class="tw-flex tw-justify-between tw-items-center tw-w-full">
        <PageHeaderRowInfo v-if="!ctasAndInfoInsideHero" :infoData="infoData" />
        <div class="tw-flex tw-items-center tw-flex-grow"
          :class="[progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end']">
          <span v-if="progress"
            class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl sm:tw-text-xl md:tw-text-2xl lg:tw-text-3xl tw-font-bold">Your
            Progress - {{ progress }}%
          </span>
          <div>
            <component v-for="(cta, index) in secondaryCtas" :key="index" :is="resolveComponent(cta.type)"
              v-bind="cta.props" />
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
import PageHeaderRowInfo from './PageHeaderRowInfo.vue';

import SongRequest from '../Songs/SongRequest.vue';
import ResetProgressCta from './Ctas/ResetProgressCta.vue';
import DownloadResourcesCta from './Ctas/DownloadResourcesCta.vue';
import PageHeaderCta from './PageHeaderCta.vue';


const componentMap = {
  ResetProgressCta,
  DownloadResourcesCta,
  PageHeaderCta,
  SongRequest
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

console.log(props.infoData);

const primaryCtaProps = computed(() => props.ctas?.find(cta => cta.type === 'primary')?.props || {});
const primaryCtaIcon = computed(() => primaryCtaProps.value.icon);
const primaryCtaText = computed(() => primaryCtaProps.value.text);
const primaryCtaUrl = computed(() => primaryCtaProps.value.url);

const secondaryCtas = computed(() => props.ctas?.filter(cta => cta.type !== 'primary') || []);

const isDarkMode = ref(JSON.parse(localStorage.getItem("darkMode")));

const isSongs = computed(() => props.pageType === 'songs');

const ctasAndInfoInsideHero = computed(() => !isSongs.value);

const logo = computed(() => {
  return isDarkMode.value ? props.darkModeLogo : props.lightModeLogo;
})

onUpdated(() => {
  isDarkMode.value = JSON.parse(localStorage.getItem("darkMode"));
})

</script>
