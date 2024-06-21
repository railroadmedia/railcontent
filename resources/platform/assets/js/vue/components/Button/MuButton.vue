<template>
    <component
        :is="isLink ? 'a' : 'button'"
        :href="isLink ? href : null"
        :type="isLink ? null : type"
        :disabled="disabled"
        :class="[ `tw-btn-${size}`, btnClasses, props.class ]"
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
        btnType: {
            type: String,
            default: 'primary', // default style is primary
            validator: (value) => ['primary', 'secondary'].includes(value)
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
        'tw-opacity-50': props.disabled,
        'tw-cursor-pointer': !props.disabled && !props.processing,
        'tw-btn-primary': props.btnType === 'primary',
        'tw-btn-secondary': props.btnType === 'secondary',
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
    /* DEFAULT BUTTON STYLES */
    .tw-btn-primary, .tw-btn-secondary {
        line-height: 0;
    }
    .tw-btn-primary {
        background-color: black; 
        color: white;
    }
    body.tw-dark .tw-btn-primary {
        background-color: white;
        color: #00101D;
    }
    body.tw-dark .tw-btn-primary:hover {
        background-color: #223F57;
        color: white;
    }
    .tw-btn-secondary {
        color: black; 
    }
    body.tw-dark .tw-btn-secondary {
        color: white;
    }
    body.tw-dark .tw-btn-secondary:hover {
        color: black;
        border-color: white;
        background-color: white;
    }
</style>
  
  