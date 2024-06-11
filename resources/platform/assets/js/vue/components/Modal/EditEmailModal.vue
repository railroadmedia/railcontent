<template>
    <InfoModal
        classOverride="tw-bg-white dark:tw-bg-[#081825] tw-border tw-border-[#445F74] dark:tw-border-[#445F74] tw-max-w-[654px]"
        modalId="loginModal" 
        :selfContained="true" 
        @onClose="handleClose"
    >
        <div class="tw-px-[25px] tw-bg-white dark:tw-bg-[#081825]">
            <h2 class="tw-text-2xl tw-mb-4 tw-text-[#00101D] dark:tw-text-white">Edit Login Email</h2>
            <form 
                accept-charset="UTF-8" 
                method="POST" 
                @submit.prevent="submitUserForm"
            >
                <div class="tw-flex tw-flex-col tw-mb-4">
                    <MuInput 
                        type="email"
                        id="loginEmail" 
                        name="email" 
                        label="Login Email"
                        :disabled="formProcessing"
                        required
                        title="Email cannot be empty"
                        placeholder="Enter Email" 
                        v-model="formData.email"
                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                        customErrorMessage="Please enter a valid email address"
                    />
                </div>
                <div class="tw-flex tw-w-full tw-justify-end tw-mb-[20px] ">
                    <MuButton
                        class="tw-mx-1 dark:tw-bg-white tw-bg-black dark:tw-text-[#00101D] tw-text-white"
                        type="submit"
                        :disabled="!formData.email.length"
                        :processing="formProcessing"
                        @click="handleClick"
                    >
                        Save
                    </MuButton>
                    <MuButton
                        @click="handleClose"
                        style-type="secondary"
                        class="tw-mx-1 tw-btn-secondary tw-text-[#00101D] dark:tw-text-[#9EC0DC]"
                    >
                        Cancel
                    </MuButton>
                </div>
            </form>
        </div>
    </InfoModal>
</template>
<script setup>
import { computed, ref, watch } from 'vue';
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
  success: Boolean,
  required: Boolean,
  minlength: Number,
  maxlength: Number,
  pattern: String,
  title: String,
  customErrorMessage: String,
});

const emit = defineEmits(["update:modelValue", "onFocus", "onEnter"]);

const errorMessage = ref('');
const getBaseInputStyles = computed(() => props.removeDefaultInputStyles ? '' : 'tw-w-full tw-h-[50px] dark:tw-bg-[#00101D] tw-text-[#00101D] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-ring-0 focus:tw-outline-none');

const borderStyles = computed(() => {
  if (errorMessage.value || props.error) {
    return 'tw-bg-transparent tw-border-pianote dark:tw-border-pianote';
  } else if (props.success) {
    return 'tw-border-guitareo dark:tw-border-guitareo';
  } else {
    return 'tw-border-[#D1D5DB] dark:tw-border-[#445F74] dark:focus:tw-border-drumeo focus:tw-border-drumeo';
  }
});

const updateValue = (value) => {
  emit("update:modelValue", value);
};

const validateInput = (value) => {
  if (props.pattern) {
    try {
      const regex = new RegExp(props.pattern);
      if (!regex.test(value)) {
        errorMessage.value = props.customErrorMessage || 'Invalid input';
        return;
      }
    } catch (e) {
      console.error(`Invalid regular expression: ${props.pattern}`);
    }
  } else if (props.error) {
    errorMessage.value = props.customErrorMessage;
  } else {
    errorMessage.value = '';
  }
};

const handleInput = (event) => {
  const value = event.target.value;
  validateInput(value);
  updateValue(value);
};

const clearValue = (e) => {
  e.preventDefault();
  emit("update:modelValue", '');
  errorMessage.value = '';
};

const onEnter = (e) => {
  e.preventDefault();
  emit("onEnter");
};

// Watch modelValue and validate on change
watch(() => props.modelValue, (newValue) => {
  validateInput(newValue);
});

// Watch error prop to update errorMessage
watch(() => props.error, (newError) => {
  if (newError) {
    errorMessage.value = props.customErrorMessage;
  } else {
    errorMessage.value = '';
  }
});
</script>
