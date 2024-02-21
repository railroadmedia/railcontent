<template>
    <a v-if="url" :href="url"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0 tw-p-0 tw-w-[40px] tw-h-[40px]"
        :class="{ 'sm:tw-px-6 sm:tw-w-auto sm:tw-h-auto': text }">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span :class="{ 'tw-hidden sm:tw-block': hasIcon, faIconClass, 'sm:ml-1': hasIcon }">{{ text }}</span>
    </a>
    <button v-else @click.prevent="emitClick"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0 tw-p-0 tw-w-[40px] tw-h-[40px]"
        :class="{ 'sm:tw-px-6 sm:tw-w-auto sm:tw-h-auto': text }">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span :class="{ 'tw-hidden sm:tw-block': hasIcon, faIconClass, 'sm:ml-1': hasIcon }">{{ text }}</span>
    </button>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    musoraIconName: String,
    url: String
});

const hasIcon = () => {
    return props.faIconClass || props.musoraIconName;
};

const emit = defineEmits(['click']);

const emitClick = () => {
    emit('click');
};
</script>
