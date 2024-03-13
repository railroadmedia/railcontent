<template>
    <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body tw-cursor-pointer">
        <button class="tw-btn-secondary tw-text-white tw-w-full sm:tw-w-fit tw-px-6">
            <i class="fas fa-globe tw-mr-[10px]"></i>
            Change Your Timezone
        </button>
        <select name="timezone" id="timezoneSelector" v-model="selectedTimezone" class="tw-w-full tw-p-2 tw-rounded tw-cursor-pointer">
            <option v-for="timezone in timezones" :key="timezone" :value="timezone" class="tw-text-[#00101D]">
                {{ timezone }}
            </option>
        </select>
    </label>
</template>

<script setup>
import { ref, watch } from 'vue';
import PageHeaderDropdown from '../PageHeaderDropdown.vue';

const props = defineProps({
    timezones: Array,
    fullTimezoneString: String
});

const selectedTimezone = ref('');

watch(() => props.fullTimezoneString, (newVal) => {
    selectedTimezone.value = props.timezones.find(timezone => timezone.startsWith(newVal)) || '';
}, { immediate: true });

</script>