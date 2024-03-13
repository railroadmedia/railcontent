<template>
    <a v-if="url" :href="url"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-mb-0 tw-min-h-0 hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="buttonConditionalClasses">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span v-if="text" :class="textSpanClass">
            {{ text }}
        </span>
    </a>
    <button v-else @click.prevent="emitClick"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-mb-0 tw-p-0 tw-min-h-0 hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="buttonConditionalClasses">
        <MusoraIcon v-if="musoraIconName" :icon-name="musoraIconName" class="tw-w-6 tw-h-6" />
        <i v-else-if="faIconClass" class="fas" :class="[faIconClass]"></i>
        <span v-if="text" :class="textSpanClass">
            {{ text }}
        </span>
    </button>
</template>

<script setup>
import { defineProps, defineEmits, computed } from 'vue';
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';
import ContentService from '../../vuesora/assets/js/services/content';

const props = defineProps({
    text: String,
    faIconClass: String,
    musoraIconName: String,
    url: String,
    contentFunction: String,
    payload: Object,
    showTextMobileHideDesktop: Boolean,
    showAllAlways: Boolean,
});

const hasIcon = () => {
    return props.faIconClass || props.musoraIconName;
};

const textSpanClass = computed(() => {
    const classes = [];
    if (hasIcon) {
        if (!props.showAllAlways) {
            if (props.showTextMobileHideDesktop) {
                classes.push('sm:tw-hidden');
            }
            else {
                classes.push('tw-hidden sm:tw-block');
            }
        }
        classes.push('ml-1');
    }
    return classes
});

const buttonConditionalClasses = computed(() => {
    const classes = [];
    if (props.text && hasIcon) {
        if (!props.showAllAlways) {
            if (props.showTextMobileHideDesktop) {
                classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto sm:tw-p-0 sm:tw-w-[32px] sm:tw-h-[32px] md:tw-w-[40px] md:tw-h-[40px]');
            }
            else {
                classes.push('tw-p-0 tw-w-[32px] tw-h-[32px] sm:tw-px-6 sm:tw-py-1 sm:tw-w-auto sm:tw-h-auto md:tw-h-[40px]');
            }
        }
        else {
            classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto md:tw-h-[40px]');
        }
    }
    else if (hasIcon) {
        classes.push('tw-p-0 tw-w-[32px] tw-h-[32px] md:tw-w-[40px] md:tw-h-[40px]')
    }
    else if (props.text) {
        classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto')
    }
    return classes
});

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
