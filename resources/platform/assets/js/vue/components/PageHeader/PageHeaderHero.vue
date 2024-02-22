<template>
  <div class="tw-flex tw-items-center">
    <template v-if="iconName">
      <musora-icon :icon-name="iconName" class="tw-w-[35px] tw-h-[35px] dark:tw-text-white" />
    </template>
    <template v-else-if="heroImg">
      <div class="tw-flex-none tw-w-[80px] sm:tw-w-[150px] sm:tw-max-w-[150px] flex flex-column">
        <div class="square">
          <img class="rounded inset-border" :src="heroImg">
        </div>
      </div>
    </template>

    <div class="tw-flex tw-flex-col pl-2 tw-self-stretch tw-mr-1 tw-w-full">
      <div class="tw-h-full tw-flex flex-column" :class="{ 'tw-flex-col tw-justify-center': !additionalImgSrc }">
        <template v-if="additionalImgSrc">
          <img :src="additionalImgSrc" class="tw-max-w-[200px] tw-h-[60px] sm:tw-max-w-[460px] sm:tw-h-[86px]">
        </template>
        <template v-else>
          <span v-if="title" class="tw-text-[32px] tw-font-bold dark:tw-text-white tw-capitalize tw-mb-1">
            {{ title }}
          </span>
        </template>
        <PageHeaderRowInfo v-if="infoData" :class="{ 'mb-1': $slots['ctas'] }" :infoData="infoData" />
        <!-- Modal for Desktop -->
        <div class="sm:tw-hidden tw-self-start" v-if="$slots['header-info']">
          <musora-icon @click="openModal" icon-name="info"
            class="tw-self-start tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
          <ModalRenderer v-if="isModalOpen">
            <button @click="closeModal"
              class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
              <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
            </button>
            <div
              class="tw-rounded-lg dark:tw-border dark:tw-border-[#223F57] dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-text-center tw-p-6 sm:tw-p-[30px] tw-max-w-[600px] tw-mx-4 sm:tw-mx-0">
              <slot name="header-info"></slot>
              <button @click="closeModal"
                class="tw-mt-3 tw-btn-primary tw-border-[#000C17] dark:tw-border-white tw-text-[#000C17] dark:tw-text-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">Close</button>
            </div>
          </ModalRenderer>
        </div>

        <!-- Tooltip for Mobile -->
        <div class="tw-hidden sm:tw-block tw-self-start" v-if="$slots['header-info']">
          <Tooltip position="right">
            <template #trigger>
              <musora-icon icon-name="info"
                class="tw-w-[27px] tw-h-[27px] tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
            </template>
            <template #content>
              <slot name="header-info"></slot>
            </template>
          </Tooltip>
        </div>
      </div>
      <div class="tw-flex">
        <slot name="ctas"></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { XIcon } from "@heroicons/vue/solid";
import ModalRenderer from "../Modal/ModalRenderer";
import Tooltip from "../Tooltip/Tooltip";
import PageHeaderRowInfo from "./PageHeaderRowInfo";

const props = defineProps({
  iconName: String,
  heroImg: String,
  title: String,
  infoData: Array,
  additionalImgSrc: String,
  secondaryCtaText: String,
})

const isModalOpen = ref(false);
const closeModal = () => {
  isModalOpen.value = false;
};
const openModal = () => {
  isModalOpen.value = true;
};


</script>
<style lang="scss" scoped>
.header-avatar {
  flex: 0 0 150px;
  max-width: 150px;
}
</style>
