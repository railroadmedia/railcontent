<script>
import { ref } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import InstrumentCard from '../InstrumentCard/InstrumentCard.vue'
import { textColor, bgImg, brandUrl } from '../../constants/brands.js'

const brandNames = ['drumeo', 'pianote', 'guitareo', 'singeo']

export default {
  name: 'BrandSelector',
  components: { ModalRenderer, InstrumentCard },
  props: ['onBrandSelect', 'brand'],
  emits: ['onBrandSelect'],
  setup(_props, context) {
    const isSelectorOpen = ref(false)

    const handleBrandOpen = (val) => {
      if (typeof val === 'boolean') {
        isSelectorOpen.value = val
      }
    }

    const handleSelect = (brand) => {
      context.emit('onBrandSelect', brand)
      handleBrandOpen(false)
    }

    return {
      isSelectorOpen,
      handleBrandOpen,
      handleSelect,
      textColor,
      bgImg,
      brandUrl,
      brandNames
    }
  }
}
</script>

<template>
  <div>
    <ModalRenderer
      v-if="isSelectorOpen"
      @close="() => handleBrandOpen(false)"
      key="ModalRendererKeyToMakeItDestroyByVif"
    >
      <div class="tw-flex tw-flex-col">
        <h2
          class="tw-mb-[36px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
          Select your instrument
        </h2>
        <div class="tw-flex tw-space-x-6">
          <InstrumentCard
            v-for="brandName in brandNames"
            v-bind:key="`${brandName}-card`"
            :backgroundUrl="bgImg[brandName]"
            :active="brand === brandName"
            :brand="brandName"
            @onInstrumentSelect="() => handleSelect(brandName)"
          >
            <img :src="brandUrl[brandName]" class="tw-h-[40px]" />
          </InstrumentCard>
        </div>
      </div>
    </ModalRenderer>
    <button
      v-on:click="() => handleBrandOpen(true)"
      :class="`tw-ml-[36px] tw-flex tw-h-full tw-flex-row tw-items-center tw-px-[12px] hover:tw-bg-[#002039]/80 ${
        isSelectorOpen && 'tw-bg-[#002039]/80'
      }`"
    >
      <img :src="brandUrl[brand]" class="tw-h-[23px]" />
      <i
        :class="`fas fa-chevron-down ${textColor[brand]} tw-h-[6px] tw-pl-[4px] tw-align-middle`"
      ></i>
    </button>
  </div>
</template>
