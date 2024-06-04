<template>
    <div :class="`tw-flex tw-w-full tw-flex-col tw-relative ${id + '-wrapper'} ${wrapperOverride ? wrapperOverride : ''}`">
      <label v-if="label" :for="id"
        :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${id + '-label'} ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">
        {{ label }}
      </label>
      <div class="tw-flex tw-relative">
        <input :value="modelValue"
               @input="updateValue($event.target.value)"
               @keypress.enter.prevent="onEnter"
               :placeholder="placeholder" 
               :id="id"
               :class="[getBaseInputStyles, `${inputOverride ? inputOverride : ''}`,
                        {'!tw-border-red-500 dark:!tw-border-red-500' : error},
                        {'tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20' : disabled}]"
               :name="name"
               :type="type"
               :disabled="disabled"
               autocomplete="off"
               @focus="() => emit('onFocus')"
        />
        <div v-if="showClearButton"
             :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${value ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
          <button class="tw-h-[16px] tw-w-[16px] tw-mx-[20px] tw-z-10" @click="clearValue">
            <XIcon class="tw-h-full tw-w-full dark:tw-text-white" />
          </button>
        </div>
        <div v-if="showCustomButton" :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${value ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
          <slot name="custom-btn"></slot>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits, computed } from 'vue';
  import { XIcon } from "@heroicons/vue/solid";
  
  const props = defineProps({
        modelValue: String,
        label: String,
        placeholder: String,
        name: String,
        type: String,
        id: String,
        inputOverride: String,
        removeDefaultInputStyles: Boolean,
        clearButtonOverride: String,
        wrapperOverride: String,
        labelOverride: String,
        inputErrors: Array,
        showClearButton: Boolean,
        showCustomButton: Boolean,
        disabled: Boolean,
        error: Boolean,
    });
  
  const emit = defineEmits(["update:modelValue", "onFocus", "onEnter"]);
  
  const getBaseInputStyles = computed(() => `${props.removeDefaultInputStyles ? '' : 'tw-w-full tw-h-[50px] tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none' }`);
  
  const updateValue = (value) => {
      emit("update:modelValue", value);
  };
  
  const clearValue = (e) => {
      e.preventDefault();
      emit("update:modelValue", '');
  };
  
  const onEnter = (e) => {
      e.preventDefault();
      emit("onEnter");
  };
  </script>
  