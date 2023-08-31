<template>
    <div class="md:tw-px-8 tw-pt-8">
        <filter-controls :is-collapsed="isCollapsed" @on-toggle-collapse="handleToggleCollapse" @on-toggle-collapse-mobile="handleToggleCollapseMobile" />
        <filter-options v-if="!isCollapsed"></filter-options>
        <filter-options-modal v-if="!isCollapsedMobile" @onClose="handleToggleCollapseMobile"></filter-options-modal>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';

    const isCollapsed = ref(true);
    const isCollapsedMobile = ref(true);

    const handleToggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    };

    const handleToggleCollapseMobile = () => {
        isCollapsedMobile.value = !isCollapsedMobile.value;
    };
</script>

<style scoped>

</style>
