<template>
    <div class="tw-relative">
        <button class="tw-text-[#00101D] dark:tw-text-white" @click="toggleDropdown">
            <DotsHorizontalIcon class="tw-w-6" />
        </button>

        <ul
            v-if="openDropdown"
            class="tw-absolute tw-top-[100%] tw-right-0 tw-drop-shadow-lg tw-rounded tw-text-black dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-z-50"
            v-click-outside="closeDropdown"
        >
            <li v-for="option in options">
                <button
                    class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                    @click="$emit(option.action)"
                >
                    <musora-icon v-if="option.icon" :icon-name="option.icon" :class="`${option.class} tw-mr-2`" /> {{ option.name }}
                </button>
            </li>
        </ul>
    </div>


</template>


<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { DotsHorizontalIcon } from '@heroicons/vue/outline';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

const props = defineProps({
    options: {
        type: Array,
        default: () => [],
    },
});

const openDropdown = ref(false);

const closeDropdown = () => {
    openDropdown.value = false;
};

const toggleDropdown = () => {
    openDropdown.value = !openDropdown.value;
};

onMounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer && contentContainer.addEventListener('scroll', closeDropdown);
});

onUnmounted(() => {
    const contentContainer = document.getElementById('content-container');
    contentContainer && contentContainer.removeEventListener('scroll', closeDropdown);
});


</script>
