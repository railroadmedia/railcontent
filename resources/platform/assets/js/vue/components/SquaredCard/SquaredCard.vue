<script>
import { borderColor } from "../../../constants/brands";
export default {
  name: "SquaredCard",
  props: [
    "type",
    "active",
    "backgroundUrl",
    "onSelect",
    "bgColor",
    "defaultBorderColor",
  ],
  emits: ["onSelect"],
  setup(props) {
    const getBorderColor = (type) => {
      if (["drumeo", "guitareo", "singeo", "pianote", "red", "blue", "green", "yellow"].includes(type)) {
        return borderColor[type];
      } else {
        return "tw-border-[#7E9AB1]";
      }
    };
    return { borderColor, getBorderColor };
  },
};
</script>

<template>
  <button
    class="SquaredCard tw-rounded-lg md:tw-mx-2 tw-my-2 xl:tw-my-0 tw-w-full tw-h-[128px] md:tw-w-[250px] md:tw-h-[250px]"
    :style="{
      background: backgroundUrl ? `url(${backgroundUrl})` : bgColor,
      backgroundSize: 'cover',
      backgroundPosition: 'center',
    }"
    v-on:click="$emit('onSelect')"
  >
    <div
      :class="`SquaredCard__overlay SquaredCard__overlay--${type} ${
        active
          ? `${getBorderColor(type)} SquaredCard__overlay--active`
          : `${
              defaultBorderColor ? defaultBorderColor : 'tw-border-transparent'
            }`
      } ${
        borderColor[type] ? `hover:${borderColor[type]}` : ''
      } tw-border-box tw-column tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-rounded-lg tw-border-[3px] tw-bg-cover`"
    >
      <slot />
    </div>
  </button>
</template>

<style type="text/css">
@import "./squared-card.css";
</style>
