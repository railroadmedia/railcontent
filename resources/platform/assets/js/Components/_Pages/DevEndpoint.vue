<script setup>
import {fetchAll, postChallengesEnroll, fetchUserChallengeProgress, fetchChallengeMetadata, postChallengesSetStartDate, fetchUserAward} from 'musora-content-services';
//fetchUserChallengeProgress(402199).then(a => console.log('did we do it?', a));
fetchAll('drumeo', 'challenge').then(a => console.log('did we do it?', a));
//fetchUserChallengeProgress(402199, '20241012').then(a => console.log('unlock', a));
// postChallengesUnlock(402199).then(a => {
//     console.log('a', a);
//      printResult(fetchUserChallengeProgress, 402199, 'post'); }
// );

//printResult(postChallengesLeave, 402199, 'enroll');

function printResult(handler, params = {}, msg = 'printie printe') {
    handler(params).then(a => console.log(msg, a));
}

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
