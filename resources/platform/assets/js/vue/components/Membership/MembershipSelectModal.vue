<script setup>
import { XIcon } from "@heroicons/vue/solid";
import ModalRenderer from '../Modal/ModalRenderer.vue';
import MembershipSelect from "./MembershipSelect.vue";

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    upgradeCost: {
        type: String,
        default: null,
    },
    currentTier: {
        type: String,
        default: 'plus'
    },
    isLifetimeMember: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['onCloseModal']);

</script>
<template>
    <ModalRenderer>
        <section
            class="tw-relative tw-flex tw-justify-center tw-items-start tw-h-full tw-w-full tw-overflow-auto tw-max-h-[100vh] tw-p-2 tw-dark">
            <button @click="emit('onCloseModal')"
                class="tw-z-30 tw-text-white tw-absolute lg:tw-top-[32px] tw-top-[12px] tw-right-[12px]  md:tw-right-[32px] md:tw-top-[32px]">
                <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
            </button>
            <div
                class="tw-table sm:tw-block tw-my-auto tw-text-center tw-text-white tw-mx-2 lg:tw-w-[755px] tw-px-2 sm:tw-px-6 tw-py-10 sm:tw-py-14 tw-bg-[#081825] tw-border-[#445F74] tw-rounded-[10px] tw-border-[1px] tw-relative md:tw-static">
                <MembershipSelect :brand="brand" :upgradeCost="upgradeCost" :currentTier="currentTier" :isLifetimeMember="isLifetimeMember" />
            </div>
        </section>
    </ModalRenderer>
</template>
