<template>
    <InfoModal
        :selfContained="true"
        :title="title"
        class-override="tw-max-w-[593px] tw-w-full dark:tw-text-white"
        @onClose="() => $emit('closeModal')"
    >
        <p v-if="isFromLesson">Come back tomorrow to maintain your streak!</p>
        <div class="tw-flex tw-justify-end tw-mt-5">
            <MuButton @click="$emit('closeModal')">Okay!</MuButton>
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
    isFromLesson: {
        type: Boolean,
        default: true,
    }
});

const title = computed(() => {
    if(props.isFromLesson){
        return `This lesson will be unlocked on ${props.date}`;
    } else {
        return `This challenge starts on ${props.date}`;
    }
})
</script>
