<script setup>
import {fetchByRailContentId} from 'musora-content-services';

fetchByRailContentId(368453).then(a => console.log('did we do it?', a));
</script>

<template>
    <h1 class="dark;tw-text-white">hello world</h1>
</template>

<style scoped>

</style>
