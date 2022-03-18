<script>
import { ref } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import SquaredCard from '../SquaredCard/SquaredCard.vue'
import { textColor, bgImg, brandUrl } from '../../constants/brands.js'

const brandNames = ['drumeo', 'pianote', 'guitareo', 'singeo']

export default {
    name: 'BrandSelector',
    components: { ModalRenderer, SquaredCard },
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
            @onClose="() => handleBrandOpen(false)"
            key="ModalRendererKeyToMakeItDestroyByVif"
        >
            <div class="tw-flex tw-flex-col">
                <h2
                    class="tw-mb-[36px] tw-w-full tw-text-center tw-font-bold tw-text-white"
                >
                    Select your instrument
                </h2>
                <div class="tw-flex tw-space-x-6">
                    <SquaredCard
                        v-for="brandName in brandNames"
                        v-bind:key="`${brandName}-card`"
                        :backgroundUrl="bgImg[brandName]"
                        :active="brand === brandName"
                        :type="brandName"
                        @onSelect="() => handleSelect(brandName)"
                    >
                        <img :src="brandUrl[brandName]" class="tw-h-[40px]" />
                    </SquaredCard>
                </div>
            </div>
        </ModalRenderer>
        <button
            v-on:click="() => handleBrandOpen(true)"
            :class="`tw-flex tw-h-full tw-flex-row tw-items-center tw-px-[12px] ${ isSelectorOpen }`"
        >
            <img :src="brandUrl[brand]" class="tw-h-[23px]" />
            <i
                :class="`fas fa-chevron-down ${textColor[brand]} tw-h-[6px] tw-pl-[4px] tw-align-middle`"
            ></i>
        </button>
    </div>
</template>
