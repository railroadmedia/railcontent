<template>
    <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body tw-cursor-pointer tw-flex tw-flex-col">
        <PageHeaderCta text="Change Your Timezone" faIconClass="fa-globe" showAllAlways>
            <select name="timezone" id="timezoneSelector" v-model="selectedTimezone"
                class="tw-w-full tw-p-2 tw-rounded tw-cursor-pointer">
                <option v-for="timezone in timezones" :key="timezone" :value="timezone" class="tw-text-[#00101D]">
                    {{ timezone }}
                </option>
            </select>
        </PageHeaderCta>
    </label>
</template>

<script setup>
import { ref, watch } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';

const props = defineProps({
    timezones: Array,
    fullTimezoneString: String
});

const selectedTimezone = ref('');

watch(() => props.fullTimezoneString, (newVal) => {
    selectedTimezone.value = props.timezones.find(timezone => timezone.startsWith(newVal)) || '';
}, { immediate: true });

</script>