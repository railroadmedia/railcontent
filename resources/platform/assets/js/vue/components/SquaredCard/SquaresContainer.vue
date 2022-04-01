<script>
export default {
  name: "SquaresContainer"
};
</script>

<template>
  <div
    class="
      tw-mb-[40px] tw-flex tw-flex-col
      md:tw-flex-row md:tw-flex-wrap
      xl:tw-flex-nowrap
      tw-w-full tw-px-2
      md:tw-w-[580px]
      xl:tw-w-full
      tw-justify-center
    "
  >
    <slot />
  </div>
</template>
