<script setup>
import { XIcon, ExclamationCircleIcon } from "@heroicons/vue/solid";
import { ref, onUpdated, onBeforeMount } from 'vue';
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
    type: String,
    default: '',
  },
  infoMessage: {
    type: String,
    default: '',
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
  error: {
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

const emit = defineEmits(["onChange", "onFocus", "onEnter"]);

const onClear = (e) => {
  e.preventDefault();
  emit("onChange", '');
  // hmm, weird
  //emit("onEnter", '');
  maskedValue.value = '';
};

const onEnter = (e) => {
  e.preventDefault();
  emit("onEnter");
};

const getBaseInputStyles = () => `
    ${props.removeDefaultInputStyles ? '' : 'tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-black dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[15px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none active:tw-outline-none tw-ring-transparent'}
  `

onUpdated(() => {
  emit('onChange', maskedValue.value);
})

onBeforeMount(() => {
  maskedValue.value = props.initialValue ? props.initialValue : '';
})
</script>

<template>
  <div :class="`input-wrapper tw-flex tw-w-full tw-flex-col tw-relative ${id + '-wrapper'} ${wrapperOverride ? wrapperOverride : ''
    }`">
    <label v-if="labelValue" :for="id"
      :class="`tw-text-sm tw-px-[15px] tw-pb-[5px] ${id + '-label'} ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{
    labelValue
  }}</label>
    <div class="tw-flex tw-relative">
      <input v-model="maskedValue" v-on:keypress.enter.prevent="onEnter" :data-maska="maskaConfig.dataMaska"
        :data-maska-tokens="maskaConfig.maskaTokens" :placeholder="placeholder" :id="id" :class="[getBaseInputStyles(),
  `${inputOverride ? inputOverride : ''}`,
  { '!tw-border-[#DC2626] dark:!tw-border-[#DC2626] tw-border-[1px] tw-bg-[#FECACA] focus:tw-outline-none focus:tw-ring-[#FECACA]': error || inputErrors.length },
  { 'tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20': disabled },
  ]" :name="inputName" :type="inputType" :disabled="disabled" autocomplete="off"
        @focus="() => emit('onFocus')" />
      <div v-if="showClearButton"
        :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${maskedValue.length ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <button class="tw-h-[16px] tw-w-[16px] tw-mx-[20px] tw-z-10" @click="onClear" type="reset">
          <XIcon class="tw-h-full tw-w-full dark:tw-text-white" />
        </button>
      </div>
      <div v-if="showCustomButton"
        :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${maskedValue.length ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <slot name="custom-btn"></slot>
      </div>
    </div>
    <div v-if="inputErrors.length" class="tw-w-full tw-flex tw-text-[12px] tw-leading-[18px] tw-text-[#DC2626] tw-text-center tw-mt-[5px] tw-justify-center">
      <ExclamationCircleIcon class="tw-mr-[5px] tw-w-[16px] tw-h-[16px]" />{{ inputErrors }}
    </div>
    <div v-if="infoMessage && infoMessage.length && !inputErrors.length" class="tw-w-full tw-text-[12px] tw-leading-[18px] tw-text-[#9EC0DC] tw-mt-[5px] tw-ml-[13px]">
      {{ infoMessage }}
    </div>
  </div>
</template>
