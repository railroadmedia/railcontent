<template>
    <div v-if="formattedInfoData"
        class="tw-flex tw-items-center tw-text-sm sm:tw-text-base tw-font-semibold tw-text-[#002039] dark:tw-text-[#9EC0DC]">
        <div class="tw-flex tw-items-center tw-uppercase" v-for="(item, index) in formattedInfoData" :key="item">
            <span>{{ item }}</span>
            <span v-if="index !== formattedInfoData.length - 1"
                class="tw-inline-block tw-h-[4px] tw-w-[4px] tw-mx-2 tw-rounded-full tw-bg-[#002039] dark:tw-bg-[#9EC0DC]"></span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    infoData: {
        type: Array,
        default: () => ([]),
    }
});

const formattedInfoData = computed(() => {
    return props.infoData.map(item => {
        const regex = /(\d+)/g;
        let formattedItem = item.replace(regex, (match) => {
            return parseInt(match).toLocaleString();
        });
        return formattedItem;
    });
});
</script>