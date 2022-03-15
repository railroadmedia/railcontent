<script>
export default {
  name: 'AvatarMenu',
  emits: ['onCloseMenu']
}
</script>

<template>
  <div
    class="AvatarMenu tw-absolute tw-top-[58px] tw-flex tw-w-[263px] tw-flex-col tw-items-start tw-justify-center tw-rounded-[6px] tw-border tw-border-[#445f74]/10 tw-pt-[24px] tw-pb-[20px] tw-text-left dark:tw-bg-[#081825]"
    :style="{
      left: 'calc(100vw - 262px - 12px)'
    }"
  >
    <div
      class="tw-h-full tw-w-full"
      v-on:mouseleave="
        () => {
          $emit('onCloseMenu')
        }
      "
      v-click-outside="
        () => {
          $emit('onCloseMenu')
        }
      "
    >
      <slot />
    </div>
  </div>
</template>

<style type="text/css">
@import './avatar-menu.css';
</style>
