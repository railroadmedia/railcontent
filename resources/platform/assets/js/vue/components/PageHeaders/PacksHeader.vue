<template>
  <PageHeader>
    <template v-slot:top-left>
      <PageHeaderHero :iconName="iconName" :title="title" :heroImg="heroImg" :additionalImgSrc="additionalImgSrc"
        :primaryCtaText="primaryCtaText" :primaryCtaUrl="primaryCtaUrl">
      </PageHeaderHero>
    </template>
    <template v-slot:top-right>
      <PageHeaderCta v-if="backToAllLessonsUrl" text="Back to all lessons" icon="fas fa-chevron-double-left"
        :href="backToAllLessonsUrl" />

      <PageHeaderCta icon="fas fa-redo-alt fa-flip-horizontal" event="resetProgressEvent"
        @resetProgressEvent="resetProgressEventHandler" />

    </template>
    <template v-slot:bottom-full v-if="progress">
      <PageHeaderProgressBar :progress="progress" />
    </template>
  </PageHeader>
</template>
  
<script setup>
import { defineProps } from 'vue';

import PageHeader from '../PageHeader/PageHeader.vue';
import PageHeaderHero from '../PageHeader/PageHeaderHero.vue';
import PageHeaderCta from '../PageHeader/PageHeaderCta.vue';
import PageHeaderProgressBar from '../PageHeader/PageHeaderProgressBar.vue';
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';

const props = defineProps({
  contentId: String,
  iconName: String,
  title: String,
  heroImg: String,
  additionalImgSrc: String,
  primaryCtaText: String,
  primaryCtaUrl: String,
  progress: {
    type: Number || String,
    default: null,
  },
  backToAllLessonsUrl: String,
  resetProgress: {
    type: Boolean,
    default: false,
  }
});

const emit = defineEmits(['progressReset']);

const { emitResetProgress } = useUserCatalogueEvents(props, { emit });

const resetProgressEventHandler = () => {
  console.log('resetProgressEventHandler');
  emitResetProgress({ content_id: props.contentId })
};
</script>
  