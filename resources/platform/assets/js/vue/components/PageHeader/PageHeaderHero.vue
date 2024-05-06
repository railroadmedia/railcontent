<template>
  <div class="tw-flex tw-items-center">
    <template v-if="iconName">
      <i v-if="isFontAswesome" class="fas tw-hidden sm:tw-block tw-text-3xl dark:tw-text-white tw-mr-2"
        :class="iconName"></i>
      <musora-icon v-else :icon-name="iconName"
        class="tw-hidden sm:tw-block tw-w-[35px] tw-h-[35px] dark:tw-text-white tw-mr-2" />
    </template>
    <template v-else-if="heroImg">
      <div class="tw-flex-none tw-w-[80px] sm:tw-w-[150px] sm:tw-max-w-[150px] tw-flex tw-flex-col tw-mr-5">
        <div :class="heroImgClasses ?? 'square'">
          <img class="rounded inset-border" :src="heroImg">
        </div>
      </div>
    </template>

    <div class="tw-flex tw-flex-col tw-self-stretch tw-mr-1 tw-w-full">
      <div class="tw-h-full tw-flex tw-flex-col tw-items-start" :class="[!hasCtas ? 'tw-justify-center' : !additionalImgSrc ? 'tw-justify-end' : ''
    ]">
        <div class="tw-flex">
          <template v-if="additionalImgSrc">
            <img :src="additionalImgSrc" class="tw-max-w-[200px] tw-h-[60px] sm:tw-max-w-[460px] md:tw-h-[86px]">
          </template>
          <template v-else>
            <span v-if="title" class="tw-text-[24px] sm:tw-text-[32px] tw-font-bold dark:tw-text-white tw-line-clamp-3 tw-overflow-hidden"
              :class="{ 'tw-capitalize': !heroImgClasses }">
              {{ title }}
            </span>
          </template>
          <div class="tw-ml-[5px]">
            <!-- Modal for Desktop -->
            <div class="sm:tw-hidden tw-self-start" v-if="$slots['header-description']">
              <musora-icon @click="openModal" icon-name="info"
                class="tw-self-start tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
              <ModalRenderer v-if="isModalOpen">
                <button @click="closeModal"
                  class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
                  <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
                </button>
                <div
                  class="dark:tw-text-white tw-text-center tw-p-6 sm:tw-p-[30px] tw-max-w-[600px] tw-mx-4 sm:tw-mx-0 tw-h-full">
                  <slot name="header-description"></slot>
                </div>
              </ModalRenderer>
            </div>

            <!-- Tooltip for Mobile -->
            <div class="tw-hidden sm:tw-block tw-self-start" v-if="$slots['header-description']">
              <Tooltip position="right">
                <template #trigger>
                  <musora-icon icon-name="info"
                    class="tw-w-[27px] tw-h-[27px] tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                </template>
                <template #content>
                  <div class="tw-max-w-[343px] tw-text-[14px]">
                    <slot name="header-description"></slot>
                  </div>
                </template>
              </Tooltip>
            </div>
          </div>
          <slot name="right-of-text-hero"></slot>
        </div>
        <PageHeaderRowInfo v-if="infoData" class="sm:tw-mt-1" :class="{ 'tw-mb-2': $slots['ctas'] }"
          :infoData="infoData" />
      </div>
      <div class="tw-flex">
        <slot name="ctas"></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { XIcon } from "@heroicons/vue/solid";
import ModalRenderer from "../Modal/ModalRenderer";
import Tooltip from "../Tooltip/Tooltip";
import PageHeaderRowInfo from "./PageHeaderRowInfo";

const props = defineProps({
  iconName: String,
  heroImg: String,
  heroImgClasses: String,
  title: String,
  infoData: Array,
  additionalImgSrc: String,
  secondaryCtaText: String,
  hasCtas: Boolean,
})

const isModalOpen = ref(false);
const closeModal = () => {
  isModalOpen.value = false;
};
const openModal = () => {
  isModalOpen.value = true;
};

const isFontAswesome = props.iconName && props.iconName.startsWith('fa-');

</script>
<style lang="scss" scoped>
.header-avatar {
  flex: 0 0 150px;
  max-width: 150px;
}
</style>
