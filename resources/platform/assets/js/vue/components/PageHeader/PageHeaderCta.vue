<template>
    <a v-if="url" :href="url"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-mb-0 tw-min-h-0 hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="[buttonConditionalClasses, disabledClasses]">
        <MusoraIcon v-if="musoraIconName && iconPosition === 'left'" :icon-name="musoraIconName" :class="iconClass" />
        <i v-else-if="faIconClass && iconPosition === 'left'" class="fas" :class="faIconClass"></i>

        <span v-if="text" :class="[textSpanClass]">
            {{ text }}
        </span>

        <MusoraIcon v-if="musoraIconName && iconPosition === 'right'" :icon-name="musoraIconName" :class="iconClass" />
        <i v-else-if="faIconClass && iconPosition === 'right'" class="fas" :class="faIconClass"></i>

        <slot />
    </a>
    <button v-else @click.prevent="emitClick"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-mb-0 tw-p-0 tw-min-h-0 hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]"
        :class="[buttonConditionalClasses, disabledClasses]">
        <MusoraIcon v-if="musoraIconName && iconPosition === 'left'" :icon-name="musoraIconName" :class="iconClass" />
        <i v-else-if="faIconClass && iconPosition === 'left'" class="fas" :class="faIconClass"></i>

        <span v-if="text" :class="[textSpanClass]">
            {{ text }}
        </span>

        <MusoraIcon v-if="musoraIconName && iconPosition === 'right'" :icon-name="musoraIconName" :class="iconClass" />
        <i v-else-if="faIconClass && iconPosition === 'right'" class="fas" :class="faIconClass"></i>

        <slot />
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
    iconPosition: {
        type: String,
        default: 'left',
    },
    url: String,
    contentFunction: String,
    payload: Object,
    onClickCallback: Function,
    showTextMobileHideDesktop: Boolean,
    showAllAlways: Boolean,
    disabled: Boolean,
});

const hasIcon = computed(() => {
    return props.faIconClass || props.musoraIconName;
});

const iconClass = computed(() => {
    return ['tw-w-6 tw-h-6'];
});

const disabledClasses = computed(() => {
    return props.disabled ? 'tw-opacity-50 tw-cursor-not-allowed disabled' : '';
});

const textSpanClass = computed(() => {
    const classes = [];
    if (hasIcon.value) {
        if (!props.showAllAlways) {
            if (props.showTextMobileHideDesktop) {
                classes.push('sm:tw-hidden');
            }
            else {
                classes.push('tw-hidden sm:tw-block');
            }
        }
        classes.push(props.iconPosition === 'left' ? 'ml-1' : 'mr-1');
    }
    return classes
});

const buttonConditionalClasses = computed(() => {
    const classes = [];
    if (props.text && hasIcon.value) {
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
    else if (hasIcon.value) {
        classes.push('tw-p-0 tw-w-[32px] tw-h-[32px] md:tw-w-[40px] md:tw-h-[40px]')
    }
    else if (props.text) {
        classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto md:tw-h-[40px]')
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
    else if (props.onClickCallback) {
        props.onClickCallback();
    }
};
</script>
