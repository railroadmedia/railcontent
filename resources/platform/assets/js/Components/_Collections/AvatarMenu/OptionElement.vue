<script setup>
const props = defineProps(['href','isLink']);
const emit = defineEmits(['onOptionClick']);

const goToHref = (href) => {
  if (href) {
    window.location.href = href
  }
};

const onButtonClick = () => {
  if (props.href) {
    goToHref(props.href);
  } else {
    emit('onOptionClick');
  }
};
</script>

<template>
  <div class="tw-w-full">
    <a v-if="href" 
       class="tw-relative tw-h-full tw-w-full tw-h-[36px] tw-mb-[5px] tw-text-left tw-text-sm tw-text-[#00101D] tw-px-[16px] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-flex tw-items-center"
       :href="href"
    >
      <slot />
    </a>
    <button v-else
      class="tw-relative tw-h-full tw-w-full tw-h-[36px] tw-mb-[5px] tw-text-left tw-text-sm tw-text-[#00101D] tw-px-[16px] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-flex tw-items-center"
      @click="onButtonClick"
    >
      <slot />
    </button>
  </div>
</template>
