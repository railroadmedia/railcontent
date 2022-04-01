<script>
const goToHref = (href) => {
  if (href) {
    window.location.href = href
  }
}

export default {
  name: 'MenuHeader',
  setup(props, context) {
    return {
      onButtonClick: context.attrs['onOptionClick']
        ? () => context.emit('optionClick')
        : () => goToHref(props.href)
    }
  },
  props: ['href', 'optionClick', 'userPhoto', 'name'],
  emits: ['onOptionClick']
}
</script>

<template>
  <div
    class="tw-flex tw-h-full tw-w-full tw-px-[16px] tw-pb-[12px] tw-leading-[18px] tw-text-black dark:tw-text-white"
    v-on:click="onButtonClick"
  >
    <div v-on:click="onButtonClick">
      <img :src="userPhoto" class="tw-h-[53px] tw-w-[53px] tw-rounded-full" />
    </div>
    <div class="tw-flex tw-grow tw-flex-col tw-justify-between tw-pl-[10px]">
      <div class="tw-text-[14px] tw-font-bold">{{ name }}</div>
      <a href="/members/profile" class="tw-text-[12px] tw-text-black dark:tw-text-white">
        View Profile
      </a>
    </div>
  </div>
</template>
