<template>
    <a v-if="url" :href="url" :class="[buttonStyle, buttonConditionalClasses, disabledClasses, inDropdownClasses]"
        :title="text">
        <MusoraIcon v-if="musoraIconName && iconPositionOverride === 'left'" :icon-name="musoraIconName"
            :class="iconClass" />
        <i v-else-if="faIconClass && iconPositionOverride === 'left'" class="fas" :class="[faIconClass, iconClass]"></i>

        <span v-if="text" :class="[textSpanClass]">
            {{ text }}
        </span>

        <MusoraIcon v-if="musoraIconName && iconPositionOverride === 'right'" :icon-name="musoraIconName"
            :class="iconClass" />
        <i v-else-if="faIconClass && iconPositionOverride === 'right'" class="fas" :class="[faIconClass, iconClass]"></i>

        <slot />
    </a>
    <button v-else @click.prevent="emitClick"
        :class="[buttonStyle, buttonConditionalClasses, disabledClasses, inDropdownClasses]" :title="text">
        <MusoraIcon v-if="musoraIconName && iconPositionOverride === 'left'" :icon-name="musoraIconName"
            :class="iconClass" />
        <i v-else-if="faIconClass && iconPositionOverride === 'left'" class="fas" :class="[faIconClass, iconClass]"></i>

        <span v-if="text" :class="[textSpanClass]">
            {{ text }}
        </span>

        <MusoraIcon v-if="musoraIconName && iconPositionOverride === 'right'" :icon-name="musoraIconName"
            :class="iconClass" />
        <i v-else-if="faIconClass && iconPositionOverride === 'right'" class="fas" :class="[faIconClass, iconClass]"></i>

        <slot />
    </button>
</template>

<script setup>
import { computed, onMounted } from 'vue';
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
    inDropdown: {
        type: Boolean,
        default: false,
    },
    isPrimary: {
        type: Boolean,
        default: false,
    }
});

console.log(props);

const buttonStyle = computed(() => {
    return props.isPrimary ?
        'tw-btn-primary tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-[#000C17] tw-text-center tw-m-0 md:tw-px-10 lg:tw-px-[30px] md:tw-inline-block tw-px-6 hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white'
        : 'tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-mb-0 tw-p-0 tw-min-h-0 hover:tw-border-[#000C17] hover:tw-bg-[#000C17] hover:dark:tw-bg-white hover:tw-text-white hover:dark:tw-text-[#000C17]';
});

// const textLowercase = computed(() => {
//     return props.text ? props.text.toLowerCase() : '';
// });

const hasIcon = computed(() => {
    return props.faIconClass || props.musoraIconName;
});

const iconClass = computed(() => {
    return props.inDropdown ? 'tw-w-6' : 'tw-w-6';
});

const iconPositionOverride = computed(() => {
    return props.inDropdown ? 'left' : props.iconPosition;
});

const disabledClasses = computed(() => {
    return props.disabled ? 'tw-opacity-50 tw-cursor-not-allowed disabled' : '';
});

const textSpanClass = computed(() => {
    const classes = [];
    if (hasIcon.value) {
        if (!props.isPrimary) {
            if (!props.showAllAlways && !props.inDropdown) {
                if (props.showTextMobileHideDesktop) {
                    classes.push('sm:tw-hidden');
                }
                else {
                    classes.push('tw-hidden sm:tw-block');
                }
            }
        }
        classes.push(iconPositionOverride.value === 'left' ? 'ml-1' : 'mr-1');
    }
    return classes
});

const buttonConditionalClasses = computed(() => {
    const classes = [];
    if (props.text && hasIcon.value) {
        if (!props.showAllAlways && !props.inDropdown) {
            if (props.showTextMobileHideDesktop) {
                classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto sm:tw-p-0 sm:tw-w-[32px] sm:tw-h-[32px] md:tw-w-[40px] md:tw-h-[40px]');
            }
            else {
                classes.push('tw-p-0 tw-w-[32px] tw-h-[32px] sm:tw-px-6 sm:tw-py-1 sm:tw-w-auto sm:tw-h-auto md:tw-h-[40px]');
            }
        }
        else {
            if (!props.inDropdown) {
                classes.push('tw-px-6 tw-py-1')
            }
            classes.push('tw-w-auto tw-h-auto md:tw-h-[40px]');

        }
    }
    else if (hasIcon.value) {
        classes.push('tw-p-0 tw-w-[32px] tw-h-[32px] tw-w-[40px] md:tw-h-[40px]')
    }
    else if (props.text) {
        classes.push('tw-px-6 tw-py-1 tw-w-auto tw-h-auto md:tw-h-[40px]')
    }
    if (props.isPrimary) {
        classes.push('tw-w-full sm:tw-w-auto');
    }
    return classes
});

// set rounded to none and hover border to none if in dropdown. set bg on hover to alternate with text while considering dark mode
const inDropdownClasses = computed(() => {
    return props.inDropdown ? 'tw-text-sm tw-leading-normal tw-font-normal font-family-open-sans tw-capitalize tw-px-4 tw-py-3 tw-justify-start tw-w-full tw-rounded-none tw-border-none tw-bg-[#000C17] tw-text-white dark:tw-text-[#000C17] hover:tw-bg-white hover:tw-text-[#000C17] hover:dark:tw-text-[#000C17]' : '';
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

<style scoped>
.font-family-open-sans {
    font-family: 'Open Sans', sans-serif;
}
</style>

