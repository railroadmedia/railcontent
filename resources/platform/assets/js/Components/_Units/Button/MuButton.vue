<template>
    <component
        :is="isLink ? 'a' : 'button'"
        :href="isLink ? href : null"
        :type="isLink ? null : type"
        :disabled="disabled"
        :class="[ `tw-mu-button tw-btn-${size} tw-font-bebas-neue tw-flex tw-justify-center tw-items-center`, btnClasses, props.class ]"
        @click="handleClick"
    >
        <template v-if="processing">
            <svg class="tw-animate-spin tw--ml-1 tw-mr-2 tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ processingText }}
        </template>
        <slot v-else></slot>
    </component>
</template>
<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        processing: {
            type: Boolean,
            default: false
        },
        processingText: {
            type: String,
            default: 'Processing...'
        },
        disabled: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: 'button'
        },
        isLink: {
            type: Boolean,
            default: false
        },
        href: {
            type: String,
            default: '#'
        },
        variant: {
            type: String,
            default: 'primary', // default style is primary
            validator: (value) => ['primary', 'secondary', 'custom'].includes(value)
        },
        size: {
            type: String,
            default: 'medium', // default size is primary
            validator: (value) => ['small', 'medium', 'large'].includes(value)
        },
        class: {
            type: String,
            default: ''
        },
    });

    //Emits
    const emit = defineEmits(['click']);

    //Computed
    const btnClasses = computed(() => ({
        'tw-cursor-not-allowed': props.disabled || props.processing,
        'tw-cursor-pointer': !props.disabled && !props.processing,
        'tw-bg-ui-button-1 tw-text-ui-button-3 hover:tw-bg-primary-6 hover:tw-text-primary-1 disabled:tw-bg-primary-7 disabled:tw-text-primary-5': props.variant === 'primary',
        'tw-bg-ui-button-2 tw-text-text-primary tw-border-primary-1 tw-border hover:tw-bg-primary-1 hover:tw-text-primary-9 hover:tw-border-primary-1 disabled:tw-border-primary-5 disabled:tw-bg-primary-9 disabled:tw-text-primary-5': props.variant === 'secondary',
    }));

    //Methods
    const handleClick = (event) => {
        if (props.processing || props.disabled) {
            event.preventDefault();
        } else {
            emit('click', event);
        }
    };
</script>
<style scoped>
    .tw-mu-button {
        line-height: 0;
        height: 40px;
        padding: 0 35px;
        border-radius: 25px;
    }

    @media only screen and (max-width: 768px) {
        .tw-mu-button {
            height: 35px;
            font-size: 14px;
        }
    }
</style>

