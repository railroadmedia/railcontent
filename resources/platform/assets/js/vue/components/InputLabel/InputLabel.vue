<script setup>
import useInputValidator from "./useInputValidator";
import { minLength } from "./validators";
import { XIcon } from "@heroicons/vue/solid";
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
  inputName: {
    type: String,
    default: "text-input"
  },
  inputType: {
    type: String,
    default: "text"
  },
  id: {
    type: String,
    default: "text-input",
  },
  inputOverride: {
    type: String,
    default: "",
  },
  removeDefaultInputStyles: {
    type: Boolean,
    default: false,
  },
  clearButtonOverride: {
    type: String,
    default: "",
  },
  wrapperOverride: {
    type: String,
    default: "",
  },
  labelOverride: {
    type: String,
    default: "",
  },
  inputErrors: {
    type: Array,
    default: [],
  },
  showClearButton: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  }
});
const emit = defineEmits(["onChange", "onFocus"]);

const { input, errors } = useInputValidator(
  props.initialValue,
  [minLength(3)],
  (value) => emit("onChange", value)
);

const onClear = (e) => {
  e.preventDefault();
  emit("onChange", '');
  input.value = '';
};

const onEnter = (e) => {
  e.preventDefault();
  emit("onEnter");
};
</script>

<template>
  <div
    :class="`tw-flex tw-flex-col tw-relative ${id+'-wrapper'} ${
      wrapperOverride ? wrapperOverride : ''
    }`"
  >
    <label
      v-if="labelValue"
      :for="id"
      :class="`tw-px-[13px] tw-pb-[5px] ${id+'-label'} ${labelOverride ? labelOverride : 'dark:tw-text-white'}`"
      >{{ labelValue }}</label
    >
    <div class="tw-flex tw-relative">
      <input
        :placeholder="placeholder"
        :id="id"
        :class="`${ removeDefaultInputStyles ? '' : 'tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none' }
                 ${ inputOverride ? inputOverride + (disabled ? ' tw-bg-[#D3D3D3]' : '') : 'tw-text-[#00101D] tw-border-[#D1D5DB]' + (disabled ? ' tw-bg-[#D3D3D3]' : '') }`"
        v-model="input"
        v-on:keypress.enter.prevent="onEnter"
        @focus="() => emit('onFocus')"
        autocomplete="off"
        :name="inputName"
        :type="inputType"
        :disabled="disabled"
      />
      <div v-if="showClearButton" :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${input ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <button class="tw-h-[16px] tw-w-[16px] tw-mx-[12px] tw-z-10" @click="onClear">
          <XIcon class="tw-h-full tw-w-full" />
        </button>
      </div>
    </div>
  </div>
</template>
