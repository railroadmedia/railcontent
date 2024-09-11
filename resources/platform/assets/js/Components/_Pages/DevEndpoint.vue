<script setup>
import {fetchVimeoData} from 'musora-content-services';
fetchVimeoData(368453).then(a => console.log('did we do it?', a));
const props = defineProps({
  results: { type: String, default: '' },
  json_results: { type: String, default: '' },
});
</script>

<template>
  <h1 class="dark;tw-text-white">hello world</h1>
  <div>
    <h1>Results</h1>
    <p>{{results}}</p>
  </div>
  <div>
    <h1>JSON Results</h1>
    <p>{{json_results}}</p>
  </div>

</template>

<style scoped>
</style>
