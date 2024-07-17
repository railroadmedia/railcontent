<script setup>
const props = defineProps({
  label: {
    type: String,
  },
  type: {
    type: String,
    default: "button",
  },
  disabled: {
    type: Boolean,
    default: true,
  },
});
const emit = defineEmits(["onButtonClick"]);
const handleClick = (e) => {
  if (props.disabled) {
    e.preventDefault();
  } else if (props.type === "button" && !props.disabled) {
    e.preventDefault();
    emit("onButtonClick", e);
  }
};
</script>

<template>
  <button
    :type="type"
    class="tw-mb-[20px] tw-mx-4"
    :class="disabled ? 'tw-btn-secondary tw-text-[#445F74]' : 'tw-btn-primary tw-bg-white tw-text-[#00101D]'"
    dusk="submit-button"
    @click="handleClick"
  >
    {{ label ? label : '' }}
    <slot></slot>
  </button>
</template>
