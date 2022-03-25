<script setup>
import { defineProps, ref } from "vue";
import SingleCoach from "./SingleCoach.vue";
const resultsRef = ref();
const props = defineProps({
  coaches: {
    type: Object,
    default: [{}, {}, {}, {}, {}, {}, {}],
  },
});
</script>

<template>
  <div class="tw-w-[800px] tw-overflow-hidden">
    <div class="tw-gap-2 tw-flex" :style="{ marginLeft: -(toLeft) }" :ref="resultsRef">
      <SingleCoach v-for="n in 7" :key="n" />
    </div>
  </div>
</template>