<template>
    <a v-if="url" :href="url"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0 tw-p-0 tw-min-h-0 tw-w-[32px] tw-h-[32px] hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="[text ? 'sm:tw-px-6 sm:tw-w-auto sm:tw-h-auto' : 'md:tw-w-[40px] md:tw-h-[40px]']">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span v-if="text" :class="{ 'tw-hidden sm:tw-block': hasIcon, 'ml-1': hasIcon }">{{ text }}</span>
    </a>
    <button v-else @click.prevent="emitClick"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0 tw-p-0 tw-min-h-0 tw-w-[32px] tw-h-[32px] hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="[text ? 'sm:tw-px-6 sm:tw-py-1 sm:tw-w-auto sm:tw-h-auto' : 'md:tw-w-[40px] md:tw-h-[40px]']">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span v-if="text" :class="{ 'tw-hidden sm:tw-block': hasIcon, 'ml-1': hasIcon }">{{ text }}</span>
    </button>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';
import ContentService from '../../vuesora/assets/js/services/content';

const props = defineProps({
    text: String,
    faIconClass: String,
    musoraIconName: String,
    url: String,
    contentFunction: String,
    payload: Object,
});

const hasIcon = () => {
    return props.faIconClass || props.musoraIconName;
};

const emit = defineEmits(['click']);

const emitClick = async () => {
    emit('click');
    if (props.contentFunction) {
        if (props.payload) {
            await ContentService[props.contentFunction](props.payload);
        } else {
            await ContentService[props.contentFunction]();
        }
        window.location.reload();
    }
};
</script>
