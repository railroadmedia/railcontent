<template>
    <div class="tw-relative tw-inline-block tw-text-left" ref="dropdownRef">
        <div>
            <button @click="toggleDropdown" type="button"
                class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0"
                :class="[text ? 'tw-px-6' : 'tw-w-[40px] tw-h-[40px] tw-p-0']" :aria-expanded="showDropdown.toString()"
                aria-haspopup="true">
                <template v-if="$slots.button">
                    <slot name="button"></slot>
                </template>
                <template v-else>
                    <i v-if="iconPosition === 'left'" :class="[faIconClass, text ? 'mr-1' : '']" aria-hidden="true"></i>
                    <span v-if="text">{{ text }}</span>
                    <i v-if="iconPosition === 'right'" :class="[faIconClass, text ? 'ml-1' : '']"
                        aria-hidden="true"></i>
                </template>
            </button>
        </div>

        <div class="tw-absolute tw-right-0 tw-bg-white dark:tw-bg-[#081825] tw-shadow tw-text-xs tw-text-[#00101D] tw-rounded"
            :class="{ 'tw-opacity-0': !showDropdown, 'tw-opacity-100 tw-transition-opacity tw-duration-200 tw-ease-in-out': showDropdown }"
            v-show="showDropdown"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    text: String,
    faIconClass: String,
    iconPosition: {
        type: String,
        default: 'left',
    },
    inDropdown: {
        type: Boolean,
        default: false,
    },
});

const showDropdown = ref(false);
const dropdownRef = ref(null);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const handleClickOutside = (event) => {
    if (!dropdownRef.value.contains(event.target)) {
        showDropdown.value = false;
    }
};

onMounted(() => {
    window.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    window.removeEventListener('click', handleClickOutside);
});
</script>
