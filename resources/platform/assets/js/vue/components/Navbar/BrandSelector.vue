<script setup>
import { ref, onUpdated } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import SquaredCard from '../SquaredCard/SquaredCard.vue'
import SquaresContainer from "../SquaredCard/SquaresContainer.vue";
import InstrumentCardContent from "../SquaredCard/InstrumentCardContent.vue";
import { textColor, bgImgCard, brandUrl } from '../../../constants/brands.js';
import { XIcon } from "@heroicons/vue/solid";
import LoadingSpinner from '../LoadingSpinner/LoadingSpinner.vue';
import { trapFocus } from '../../../utils.js';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    onBrandSelect: {
        type: String
    }
});

const emit = defineEmits(['onBrandSelect']);

const isSelectorOpen = ref(false);
const isLoading = ref(false);

const handleBrandOpen = (val) => {
    if (typeof val === 'boolean') {
        isSelectorOpen.value = val
    }
}

const handleSelect = (brand) => {
    isLoading.value = true;
    //Refresh the Page with new brand
    const host = window.location.host;
    window.location.href = `/${brand}`;
}

const handleClose = () => {
    isSelectorOpen.value = false;
}

onUpdated(() => {
    if (isSelectorOpen.value) {
      const modalRoot = document.getElementById('modal-container');
      trapFocus(modalRoot);
    } else {
      const pageRoot = document.getElementById('app');
      trapFocus(pageRoot);
    }
});
</script>

<template>
    <div>
        <ModalRenderer v-if="isSelectorOpen" @onClose="() => handleBrandOpen(false)"
            key="ModalRendererKeyToMakeItDestroyByVif">
            <div v-if="isLoading"
                class="tw-absolute tw-z-[500] tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center tw-bg-black/50">
                <LoadingSpinner classOverride="tw-w-[48px] tw-h-[48px]" />
            </div>
            <div v-if="!isLoading" class="tw-flex tw-w-full tw-h-full tw-justify-center tw-items-center">
                <button @click="handleClose" aria-label="Close brand selector modal"
                    class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
                    <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
                </button>
                <div
                    class="tw-flex tw-flex-col tw-overflow-auto tw-py-12 tw-px-10 tw-h-screen md:tw-items-center md:tw-justify-center tw-relative">
                    <h2
                        class="tw-mb-[36px] tw-w-full tw-text-2xl md:tw-text-3xl tw-text-center tw-font-extrabold tw-text-white">
                        What instrument would you like to learn?
                    </h2>
                    <SquaresContainer>
                        <SquaredCard :backgroundUrl="bgImgCard.drumeo" type="drumeo" :active="brand === 'drumeo'"
                            @onSelect="() => handleSelect('drumeo')">
                            <InstrumentCardContent instrumentText="DRUMS" :logoUrl="brandUrl.drumeo"
                                logoAltText="Drumeo Logo" />
                        </SquaredCard>
                        <SquaredCard :backgroundUrl="bgImgCard.pianote" :active="brand === 'pianote'" type="pianote"
                            @onSelect="() => handleSelect('pianote')">
                            <InstrumentCardContent instrumentText="PIANO" :logoUrl="brandUrl.pianote"
                                logoAltText="Pianote Logo" />
                        </SquaredCard>
                        <SquaredCard :backgroundUrl="bgImgCard.guitareo" :active="brand === 'guitareo'" type="guitareo"
                            @onSelect="() => handleSelect('guitareo')">
                            <InstrumentCardContent instrumentText="GUITAR" :logoUrl="brandUrl.guitareo"
                                logoAltText="Guitareo Logo" />
                        </SquaredCard>
                        <SquaredCard :backgroundUrl="bgImgCard.singeo" :active="brand === 'singeo'" type="singeo"
                            @onSelect="() => handleSelect('singeo')">
                            <InstrumentCardContent instrumentText="SINGING" :logoUrl="brandUrl.singeo"
                                logoAltText="Singeo Logo" />
                        </SquaredCard>
                    </SquaresContainer>
                </div>
            </div>
        </ModalRenderer>
        <button v-on:click="() => handleBrandOpen(true)"
            :class="`tw-group tw-flex tw-h-[58px] tw-flex-row tw-items-center lg:tw-px-[12px] tw-transition-all hover:dark:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] ${isSelectorOpen}`">
            <img :src="brandUrl[brand]" class="tw-w-full tw-min-w-[92px] tw-max-w-[102px] tw-max-h-8" />
            <i
                :class="`fas fa-chevron-down ${textColor[brand]} tw-text-xs tw-pl-[4px] tw-transition-all group-hover:tw-mt-1 tw-align-middle`"></i>
        </button>
    </div>
</template>
