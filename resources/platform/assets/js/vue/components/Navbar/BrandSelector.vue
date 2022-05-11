<script>
import { ref } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import SquaredCard from '../SquaredCard/SquaredCard.vue'
import SquaresContainer from "../SquaredCard/SquaresContainer.vue";
import InstrumentCardContent from "../SquaredCard/InstrumentCardContent.vue";
import { textColor, bgImg, brandUrl } from '../../../constants/brands.js'

const brandNames = ['drumeo', 'pianote', 'guitareo', 'singeo']
const instrumentPerBrand = [];

export default {
    name: 'BrandSelector',
    components: { ModalRenderer, SquaredCard, SquaresContainer, InstrumentCardContent },
    props: {
        brand: {
            type: String,
            default: 'drumeo'
        },
        onBrandSelect: {
            type: String
        }
    },
    emits: ['onBrandSelect'],
    setup(_props, context) {
        const isSelectorOpen = ref(false)

        const handleBrandOpen = (val) => {
            if (typeof val === 'boolean') {
                isSelectorOpen.value = val
            }
        }

        const handleSelect = (brand) => {
            //Refresh the Page with new brand
            const host = window.location.host;
            window.location.href = `/${brand}`;
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
        <ModalRenderer v-if="isSelectorOpen" @onClose="() => handleBrandOpen(false)"
            key="ModalRendererKeyToMakeItDestroyByVif">
            <div class="tw-flex tw-flex-col">
                <h2 class="tw-mb-[36px] tw-w-full tw-text-center tw-font-bold tw-text-white">
                    Select your instrument
                </h2>
                <SquaresContainer>
                    <SquaredCard :backgroundUrl="bgImg.drumeo" type="drumeo" :active="brand === 'drums'"
                        @onSelect="() => handleSelect('drumeo')">
                        <InstrumentCardContent instrumentText="DRUMS" :logoUrl="brandUrl.drumeo"
                            logoAltText="Drumeo Logo" />
                    </SquaredCard>
                    <SquaredCard :backgroundUrl="bgImg.pianote" :active="brand === 'pianote'" type="pianote"
                        @onSelect="() => handleSelect('pianote')">
                        <InstrumentCardContent instrumentText="PIANO" :logoUrl="brandUrl.pianote"
                            logoAltText="Pianote Logo" />
                    </SquaredCard>
                    <SquaredCard :backgroundUrl="bgImg.guitareo" :active="brand === 'guitareo'" type="guitareo"
                        @onSelect="() => handleSelect('guitareo')">
                        <InstrumentCardContent instrumentText="GUITAR" :logoUrl="brandUrl.guitareo"
                            logoAltText="Guitareo Logo" />
                    </SquaredCard>
                    <SquaredCard :backgroundUrl="bgImg.singeo" :active="brand === 'singeo'" type="singeo"
                        @onSelect="() => handleSelect('singeo')">
                        <InstrumentCardContent instrumentText="SINGING" :logoUrl="brandUrl.singeo"
                            logoAltText="Singeo Logo" />
                    </SquaredCard>
                </SquaresContainer>
            </div>
        </ModalRenderer>
        <button v-on:click="() => handleBrandOpen(true)"
            :class="`tw-flex tw-h-full tw-flex-row tw-items-center lg:tw-px-[12px] ${isSelectorOpen}`">
            <img :src="brandUrl[brand]" class="tw-w-full tw-max-w-[144px] tw-max-h-8" />
            <i :class="`fas fa-chevron-down ${textColor[brand]} tw-text-xs tw-pl-[4px] tw-align-middle`"></i>
        </button>
    </div>
</template>
