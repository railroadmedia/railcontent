<template>
  <PageHeader>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :heroImg="heroImg" :additionalImgSrc="additionalImgSrc"
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
          <PageHeaderDropdown icon="fa fa-download">
            <template v-slot:content>
              <ul class="tw-w-max">
                <li v-for="resource in downloadableResources" :key="resource.resource_id"
                  class="pa-1 tw-hover:bg-[#f2f2f2] tw-border-b tw-border-[#d1d1d1]">
                  <a :href="resource.resource_url"
                    class="tw-block tw-uppercase tw-font-bebas-neue tw-no-underline tw-text-[#00101D]" target="_blank" download>
                    <i :class="['fas', getIconClass(resource.resource_url), 'tw-mr-1']" style="width:20px;"></i>
                    {{ resource.resource_name }}
                  </a>
                </li>
              </ul>
            </template>
          </PageHeaderDropdown>
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
import { computed, defineProps, ref } from 'vue';

import PageHeader from '../PageHeader/PageHeader.vue';
import PageHeaderHero from '../PageHeader/PageHeaderHero.vue';
import PageHeaderCta from '../PageHeader/PageHeaderCta.vue';
import PageHeaderProgressBar from '../PageHeader/PageHeaderProgressBar.vue';
import PageHeaderPrimaryCta from '../PageHeader/PageHeaderPrimaryCta.vue';
import PageHeaderDropdown from '../PageHeader/PageHeaderDropdown.vue';
import { useResetProgress } from '../../hooks/useResetProgress';

const props = defineProps({
  contentId: String,
  iconName: String,
  title: String,
  heroImg: String,
  additionalImgSrc: String,
  primaryCtaIcon: String,
  primaryCtaText: String,
  primaryCtaUrl: String,
  progress: {
    type: Number || String,
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

const emit = defineEmits(['progressReset']);

const { resetProgress } = useResetProgress();

const resetWithConfirmation = () => {
  resetProgress(props.contentId, resetIcon, true);
};

const areResourcesDownloadable = computed(() => {
  console.log('areResourcesDownloadable', props.downloadableResources);
  return props.downloadableResources && Object.keys(props.downloadableResources)?.length > 0;
});

const getIconClass = (filename) => {
  const extension = filename.split('.').pop();

  switch (extension) {
    case 'png':
      return 'fa-file-text';
    case 'pdf':
      return 'fa-file-pdf';
    case 'zip':
      return 'fa-file-archive';
    case 'mp3':
    case 'wav':
      return 'fa-file-audio';
    case 'mp4':
      return 'fa-file-video';
    default:
      return 'fa-cloud-download';
  }
};

const formattedInfoData = computed(() => {
  if (props.infoData) {
    const { lessons, xp } = props.infoData;
    return `${lessons} Lessons | ${xp} XP`;
  }
  return '';
});

</script>
  