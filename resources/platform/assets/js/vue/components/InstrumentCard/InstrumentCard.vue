<script>
import { borderColor } from '../../constants/brands'
export default {
  name: 'InstrumentCard',
  setup() {
    return { borderColor }
  },
  props: ['brand', 'active', 'backgroundUrl', 'onInstrumentSelect'],
  emits: ['onInstrumentSelect']
}
</script>

<template>
  <button
    class="InstrumentCard tw-rounded-lg"
    :style="{
      background: `url(${backgroundUrl})`,
      backgroundSize: 'cover',
      backgroundPosition: 'center'
    }"
    v-on:click="$emit('onInstrumentSelect')"
  >
    <div
      :class="`InstrumentCard__overlay InstrumentCard__overlay--${brand} ${
        active ? `${borderColor[brand]}` : 'tw-border-transparent'
      } hover:${
        borderColor[brand]
      } tw-border-box tw-column tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-rounded-lg tw-border-[3px] tw-bg-cover`"
    >
      <slot />
    </div>
  </button>
</template>

<style type="text/css">
@import './instrument-card.css';
</style>
