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
    class="OptionElement tw-h-full tw-w-full tw-py-[8px] tw-text-left tw-text-[14px] tw-font-[600] tw-text-black dark:tw-text-white"
    v-on:click="onButtonClick"
  >
    <slot />
  </button>
</template>
