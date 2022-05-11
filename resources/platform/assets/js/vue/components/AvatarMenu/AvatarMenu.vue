<script>
export default {
  name: 'AvatarMenu',
  emits: ['onCloseMenu']
}
</script>

<template>
  <div
    class="tw-absolute tw-top-[60px] tw-flex tw-w-[263px] tw-flex-col tw-items-start tw-justify-center tw-rounded-[6px] tw-border tw-border-[#445f74]/10 tw-pt-[24px] tw-pb-2 tw-text-left tw-bg-white tw-right-0 dark:tw-bg-[#081825] tw-shadow-[0px_10px_15px_-3px_rgba(0,0,0,0.1)]"
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
