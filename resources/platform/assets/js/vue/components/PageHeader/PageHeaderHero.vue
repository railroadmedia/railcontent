<template>
  <div class="tw-flex tw-items-center">
    <template v-if="iconName">
      <musora-icon :icon-name="iconName" class="tw-w-[35px] tw-h-[35px] dark:tw-text-white" />
    </template>
    <template v-else-if="heroImg">
      <div class="header-avatar flex flex-column">
        <div class="square">
          <img class="rounded inset-border" :src="heroImg">
        </div>
      </div>
    </template>

    <div class="tw-flex tw-flex-col pl-2 tw-justify-between" :class="{ 'tw-h-[150px]': additionalImgSrc }">
      <template v-if="!additionalImgSrc">
        <div v-if="title" class="tw-text-[32px] tw-font-bold dark:tw-text-white tw-capitalize">{{ title }}</div>
        <!-- TODO: Style subTitle and description -->
        <div v-if="subTitle">{{ subTitle }}</div>
        <div v-if="description">{{ description }}</div>
      </template>

      <template v-if="additionalImgSrc">
        <img :src="additionalImgSrc" class="tw-max-w-[174px] tw-max-h-[90px]">
      </template>
      <div class="tw-hidden sm:tw-block">
        <PageHeaderPrimaryCta :icon="primaryCtaIcon" :url="primaryCtaUrl" :text="primaryCtaText" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import PageHeaderPrimaryCta from './PageHeaderPrimaryCta.vue';

const props = defineProps({
  iconName: String,
  heroImg: String,
  title: String,
  subTitle: String,
  description: String,
  additionalImgSrc: String,
  primaryCtaIcon: String,
  primaryCtaUrl: String,
  primaryCtaText: String,
  secondaryCtaText: String,
})


</script>
<style lang="scss" scoped>
.header-avatar {
  flex: 0 0 150px;
  max-width: 150px;
}
</style>