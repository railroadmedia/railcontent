<template>
    <InfoModal
        :selfContained="true"
        :title="`This lesson will be unlocked on ${unlockedDate}`"
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
    challenge: {
        type: Object,
        required: true,
    },
});

const unlockedDate = computed(() => {
    const date = new Date(props.challenge.unlock_date);
    return `${Months[date.getMonth()]} ${date.getDate()}`;
})

const Months = {
    0: 'January',
    1: 'February',
    2: 'March',
    3: 'April',
    4: 'May',
    5: 'June',
    6: 'July',
    7: 'August',
    8: 'September',
    9: 'October',
    10: 'November',
    11: 'December',
};
</script>
