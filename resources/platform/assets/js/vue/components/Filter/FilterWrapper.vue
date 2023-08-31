<template>
    <div class="md:tw-px-8 tw-pt-8">
        <filter-controls :is-collapsed="isCollapsed" @on-toggle-collapse="handleToggleCollapse" />
        <filter-options v-if="!isCollapsed"></filter-options>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import FilterOptions from './FilterOptions.vue';
    import FilterControls from './FilterControls.vue';

    const isCollapsed = ref(true);

    const handleToggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    };
</script>

<style scoped>

</style>
