<template>
    <div class="tw-relative tw-inline-block tw-text-left">
        <div>
            <button @click="toggleDropdown" type="button"
                class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0"
                :class="[text ? 'tw-px-6' : 'tw-w-[40px] tw-h-[40px] tw-p-0']" :aria-expanded="showDropdown.toString()"
                aria-haspopup="true">
                <template v-if="$slots.button">
                    <slot name="button"></slot>
                </template>
                <template v-else>
                    <span v-if="text">{{ text }}</span>
                </template>
                <i :class="[icon, text ? 'mr-1' : '']" aria-hidden="true"></i>
            </button>
        </div>

        <div class="tw-absolute tw-right-0 tw-z-10 tw-bg-white tw-shadow tw-text-xs tw-text-[#00101D] tw-rounded"
            :class="{ 'tw-opacity-0': !showDropdown, 'tw-opacity-100 tw-transition-opacity tw-duration-200 tw-ease-in-out': showDropdown }"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">

            <slot name="content"></slot>
        </div>
    </div>
</template>

  
<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
    text: String,
    icon: String
});

const showDropdown = ref(false);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};
</script>

  