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
  if (props.type === "button") {
    e.preventDefault();
    emit("onButtonClick", e);
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
      tw-border-[#445F74] tw-relative
      login-submit-btn
    "
    :class="disabled ? '' : 'button-active'"
    dusk="submit-button"
    @click="handleClick"
  >
    <span class="tw-font-bebas-neue tw-uppercase">
      {{ label ? label : '' }}
      <slot></slot>
    </span>
  </button>
</template>

<style type="text/css">
.login-submit-btn:hover, .login-submit-btn.button-active {
  border: none;
  color: white !important;
}

.login-submit-btn:hover::before, .login-submit-btn.button-active::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 25px;
  border: 2px solid transparent;
  background: linear-gradient(
      90.69deg,
      #00c9ac 1.54%,
      #0b76db 30.83%,
      #9a00ee 72.12%,
      #f61a30 95.24%
    )
    border-box;
  -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
  mask-composite: exclude;
}
</style>