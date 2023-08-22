<template>
    <div class="tw-mb-6 tw-text-black dark:tw-text-white tw-uppercase tw-text-sm">
        <a v-if="firstLevelTitle"
           class="tw-text-black dark:tw-text-white tw-text-sm"
           :href="firstLevelUrl" >{{ firstLevelTitle }}</a>

        <template v-if="secondLevelTitle">
            / <a class="tw-text-black dark:tw-text-white tw-text-sm"
               :href="secondLevelUrl">{{ secondLevelTitle }}</a>
        </template>

        / <b>{{ lastLevelTitle }}</b>
    </div>


</template>

<script setup>
    const props = defineProps({
        brand: String,
        firstLevelUrl: String,
        firstLevelTitle: String,
        secondLevelUrl: String,
        secondLevelTitle: String,
        lastLevelTitle: String,
    });
</script>
