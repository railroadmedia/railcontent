<template>
    <div class="tw-pt-8">
        <filter-tabs :tab-options="tabOptions" @onTabClick="onTabClick" />
    </div>
</template>

<script setup>
    import FilterTabs from './FilterTabs.vue';

    const tabOptions = [{ key: 'songs', name: 'Songs' }, { key: 'artist', name: 'Artist' }, { key: 'genre', name: 'Genre' }];
    const onTabClick = () => {
        //change state
        console.log('tab clicked');
    };


</script>

<style scoped>

</style>
