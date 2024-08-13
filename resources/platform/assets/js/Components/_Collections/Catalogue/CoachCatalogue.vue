<template>
    <div
        class="tw-grid tw-gap-3 tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 xl:tw-grid-cols-5 2xl:tw-grid-cols-7 3xl:tw-grid-cols-8 tw-mb-4"
    >
        <CoachCard
            v-for="(item, i) in content"
            :key="i"
            :item="item"
            :content-type="item.type"
        />
    </div>
</template>

<script setup>
import CoachCard from "./CoachCard";

const props = defineProps({
    content: {
        type: Array,
        default: () => [],
    },
})
</script>
