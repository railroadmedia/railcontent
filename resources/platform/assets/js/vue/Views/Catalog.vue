<template>
    <div class="tw-w-full tw-relative">
        <!-- BREADCRUMBS -->
        <Breadcrumb
            :first-level-url="firstLevelUrl" 
            :first-level-title="firstLevelTitle"
            :last-level-title="lastLevelTitle"
        />

    </div>
</template>
<script setup>
    //Imports

    //Props
    const props = defineProps({
        slug: { type: String, default: '' },
    });
</script>