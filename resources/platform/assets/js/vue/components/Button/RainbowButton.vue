<script setup>
const props = defineProps({
  label: {
    type: String,
  },
  type: {
    type: String,
    default: "button",
  },
});
const emit = defineEmits(["onButtonClick"]);
const handleClick = (e) => {
  if (props.type === "button") {
    e.preventDefault();
    emit("onButtonClick");
  }
};
</script>


<template>
  <button
    :type="type"
    class="
      tw-text-xl
      tw-rounded-[25px]
      tw-mb-[20px]
      tw-h-[50px]
      tw-border-[2px]
      tw-text-[#445F74]
      hover:tw-text-white
      tw-border-[#445F74] tw-relative
      login-submit-btn
    "
    dusk="submit-button"
    @click="handleClick"
  >
    <span class="tw-font-bebas-neue tw-uppercase">
      {{ label }}
    </span>
  </button>
</template>