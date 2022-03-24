<script>
const goToHref = (href) => {
  if (href) {
    window.location.href = href
  }
}

export default {
  name: 'OptionElement',
  setup(props, context) {
    return {
      onButtonClick: context.attrs['onOptionClick']
        ? () => context.emit('optionClick')
        : () => goToHref(props.href)
    }
  },
  props: ['href', 'optionClick'],
  emits: ['onOptionClick']
}
</script>

<template>
  <button
    class="tw-h-full tw-w-full tw-h-[36px] tw-text-left tw-text-sm tw-text-black tw-px-[16px] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-flex tw-items-center"
    v-on:click="onButtonClick"
  >
    <slot />
  </button>
</template>
