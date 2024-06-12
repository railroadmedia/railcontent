<template>
  <div :class="`tw-flex tw-w-full tw-flex-col tw-relative ${wrapperOverride || ''}`">
    <label v-if="label" :for="id"
      :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride || 'dark:tw-text-[#9EC0DC]'}`">
      {{ label }}<sup v-if="required">*</sup>
    </label>
    <div class="tw-flex tw-relative">
      <input :value="modelValue"
             @input="handleInput"
             @keypress.enter.prevent="onEnter"
             :placeholder="placeholder" 
             :id="id"
             :class="[getBaseInputStyles, borderStyles, inputOverride || '', {'tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20': disabled}]"
             :name="name"
             :type="type"
             :disabled="disabled"
             :required="required"
             :minlength="minlength"
             :maxlength="maxlength"
             :pattern="pattern"   
             :title="title"
             autocomplete="off"
             @focus="() => emit('onFocus')"
      />
      <div v-if="showClearButton"
           :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${modelValue ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <button class="tw-h-[16px] tw-w-[16px] tw-mx-[20px] tw-z-10" @click="clearValue">
          <XIcon class="tw-h-full tw-w-full dark:tw-text-white" />
        </button>
      </div>
      <div v-if="showCustomButton" :class="`tw-absolute tw-right-0 tw-h-full tw-flex tw-items-center tw-justify-center ${modelValue ? 'tw-flex' : 'tw-hidden'} ${clearButtonOverride}`">
        <slot name="custom-btn"></slot>
      </div>
    </div>
  </div>
</template>
<script setup>
  import { computed } from 'vue';
  import { XIcon } from "@heroicons/vue/solid";

  //Props
  const props = defineProps({
    clearButtonOverride: String,
    disabled: Boolean,
    id: String,
    inputOverride: String,
    label: String,
    labelOverride: String,
    maxlength: Number,
    minlength: Number,
    modelValue: String,
    name: String,
    pattern: String,
    placeholder: String,
    removeDefaultInputStyles: Boolean,
    required: Boolean,
    showClearButton: Boolean,
    showCustomButton: Boolean,
    title: String,
    type: String,
    wrapperOverride: String,
  });

  //Emits
  const emit = defineEmits(["update:modelValue", "onFocus", "onEnter"]);

  //Computed
  const getBaseInputStyles = computed(() => props.removeDefaultInputStyles ? '' : 'tw-w-full tw-h-[50px] dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-ring-0 focus:tw-outline-none');
  
  const borderStyles = computed(() => {
    return 'tw-border-[#D1D5DB] dark:tw-border-[#445F74] dark:focus:tw-border-drumeo focus:tw-border-drumeo';
  });

  //Methods
  const updateValue = (value) => {
    emit("update:modelValue", value);
  };

  const handleInput = (event) => {
    const value = event.target.value;
    updateValue(value);
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
