<script setup>
import useInputValidator from "./useInputValidator";
import { minLength } from "./validators";
const props = defineProps({
  initialValue: {
    type: String,
    default: "",
  },
  labelValue: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    default: "",
  },
  id: {
    type: String,
    default: "text-input",
  },
  classOverride: {
    type: String,
    default: "",
  },
});
const emit = defineEmits(["onChange", "onFocus"]);

const { input, errors } = useInputValidator(
  props.initialValue,
  [minLength(3)],
  (value) => emit("onChange", value)
);

const onEnter = () => {
  emit("onEnter");
  console.log("enter key pressed");
};

</script>

<template>
  <div class="tw-flex tw-flex-col tw-relative">
    <div class="tw-absolute"></div>
    <label
      v-if="labelValue"
      :for="id"
      class="tw-px-[13px] tw-pb-[5px] tw-text-white"
      >{{ labelValue }}</label
    >
    <input
      :placeholder="placeholder"
      :id="id"
      :class="`tw-h-[42px] tw-rounded-[63px] tw-border-[#D1D5DB] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none ${
        classOverride ? classOverride : ''
      }`"
      v-model="input"
      v-on:keyup.enter="onEnter"
      @focus="() => emit('onFocus')"
      autocomplete="off"
    />
  </div>
</template>
