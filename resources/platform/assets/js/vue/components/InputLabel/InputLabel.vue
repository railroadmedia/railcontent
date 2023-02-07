<script setup>
import { XIcon } from "@heroicons/vue/solid";
import { vMaska } from 'maska';
import { reactive, ref, onUpdated } from 'vue';
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
  showCustomButton: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  maskProps: {
    type: Object,
    default: {
      mask: "#-#",
      eager: true
    }
  },
  minLength: {
    type: Number,
    default: 3
  },
  maskaConfig: {
    type: Object,
    default: {
      dataMaska: '',
      maskaTokens: ''
    }
  }
});

const maskedValue = ref('');
const bindedObject = reactive({});

const emit = defineEmits(["onChange", "onFocus"]);

const onClear = (e) => {
  e.preventDefault();
  emit("onChange", '');
  maskedValue.value = '';
};

const onEnter = (e) => {
  e.preventDefault();
  emit("onEnter");
};

const getBaseInputStyles = () => `
    ${props.removeDefaultInputStyles
    ?
    ''
    :
    'tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none'
  }
  `

onUpdated(() => {
  emit('onChange', bindedObject.unmasked);
})
</script>

<template>
  <div :class="`tw-flex tw-w-full tw-flex-col tw-relative ${id + '-wrapper'} ${wrapperOverride ? wrapperOverride : ''
  }`">
    <label v-if="labelValue" :for="id"
      :class="`tw-px-[13px] tw-pb-[5px] ${id + '-label'} ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{
        labelValue
      }}</label>
    <div class="tw-flex tw-relative">
      <input :data-maska="maskaConfig.dataMaska" :data-maska-tokens="maskaConfig.maskaTokens" :placeholder="placeholder" :id="id"
        :class="`${inputOverride ? inputOverride + getBaseInputStyles() + (disabled ? ' tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20' : '') : getBaseInputStyles() + (disabled ? ' tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20' : '')}`"
        v-model="maskedValue" v-maska="bindedObject" v-on:keypress.enter.prevent="onEnter" @focus="() => emit('onFocus')" autocomplete="off"
        :name="inputName" :type="inputType" :disabled="disabled" />
      <div v-if="showClearButton"
        :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${maskedValue.length ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <button class="tw-h-[16px] tw-w-[16px] tw-mx-[12px] tw-z-10" @click="onClear">
          <XIcon class="tw-h-full tw-w-full dark:tw-text-white" />
        </button>
      </div>
      <div v-if="showCustomButton"
        :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${maskedValue.length ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <slot name="custom-btn"></slot>
      </div>
    </div>
  </div>
</template>
