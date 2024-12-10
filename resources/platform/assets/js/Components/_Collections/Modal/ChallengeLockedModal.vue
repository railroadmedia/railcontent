<template>
    <InfoModal
        :selfContained="true"
        :title="`This lesson will be unlocked on ${date}`"
        class-override="tw-max-w-[593px] tw-w-full dark:tw-text-white"
        @onClose="() => $emit('closeModal')"
    >
        <p>Come back tomorrow to maintain your streak!</p>
        <div class="tw-flex tw-justify-end tw-mt-5">
            <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white" @click="$emit('closeModal')">Okay!</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import InfoModal from '@collections/Modal/InfoModal.vue';
import MuButton from '@units/Button/MuButton';
import {computed} from "vue";

const props = defineProps({
    date: {
        type: String,
        default: '',
    },
});
</script>
