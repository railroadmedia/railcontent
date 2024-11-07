<template>
  <div class="tw-w-full tw-rounded-full tw-h-[5px] tw-bg-[#F4F4F5] dark:tw-bg-[#223F57]">
    <div class="tw-bg-blue-500 tw-rounded-full tw-h-[5px]"
      :style="{ width: progress + '%', background: gradientBarColor }"></div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const gradientBarColor = computed(() => {
  return {
    drumeo: 'linear-gradient(90deg, #112E4A 0%, #0B76DB 100%);',
    singeo: 'linear-gradient(90deg, #320E4F 0%, #8300E9 100%);',
    pianote: 'linear-gradient(90deg, #55171D 0%, #F61A30 100%);',
    guitareo: 'linear-gradient(90deg, #0C443C 0%, #00C9AC 100%)',

  }[brand.value];
});

const props = defineProps({
  progress: {
    type: Number,
    required: true,
    default: 0
  }
});
</script>