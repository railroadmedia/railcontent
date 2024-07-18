<template>
    <div
        class="tw-w-[33px] tw-h-8 tw-px-[7px] tw-py-4 tw-ml-1 tw-bg-[#223F57] tw-rounded-[30px] tw-flex-col tw-justify-center tw-items-center tw-gap-2.5 tw-inline-flex tw-self-center">
        <div class="tw-text-white tw-text-base tw-font-bold tw-font-['Open Sans'] tw-uppercase">{{ playlistCount }}
        </div>
    </div>
</template>

<script setup>
  const props = defineProps({
    playlistCount: Number
  });
</script>