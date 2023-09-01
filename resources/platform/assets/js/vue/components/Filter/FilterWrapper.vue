<template>
    <div class="md:tw-px-8 tw-pt-8">
        <filter-controls :is-collapsed="isCollapsed" @on-toggle-collapse="handleToggleCollapse" @on-toggle-collapse-mobile="handleToggleCollapseMobile" />
        <filter-options v-if="!isCollapsed && isMobile"></filter-options>
        <filter-options-modal v-if="!isCollapsed && !isMobile" :is-collapsed-mobile="isCollapsed" @onClose="handleToggleCollapse"></filter-options-modal>
    </div>
</template>

<script setup>
import {onMounted, onUnmounted, ref} from 'vue';
    import FilterOptions from './FilterOptions.vue';
    import FilterOptionsModal from './FilterOptionsModal.vue';
    import FilterControls from './FilterControls.vue';

    const isMobile = ref(true);
    const isCollapsed = ref(true);

    const handleToggleCollapse = () => {
        isCollapsed.value = !isCollapsed.value;
    };

    const getScreenSize = () => {
        if (window.innerWidth > 767){
            isMobile.value = true;
        }
        else {
            isMobile.value = false;
        }
    }

    onMounted(()=>{
        getScreenSize();
        window.addEventListener('resize', getScreenSize);
    })
</script>

<style scoped>

</style>
