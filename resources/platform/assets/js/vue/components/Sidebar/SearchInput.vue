<script setup>
  import { ref, nextTick } from 'vue';
  import InputLabel from "../InputLabel/InputLabel.vue";
  import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

  const props = defineProps({
    isSidebarCollapsed: {
      type: Boolean,
    },
    brand: {
      type: String,
      default: 'Drumeo',
    }
  });

  const emit = defineEmits(['onCollapse'])

  const formRef = ref(null);
  const searchValue = ref('');

  const handleFocus = () => {
      emit('onCollapse', false);
  };

  const handleChange = (val) => {
    searchValue.value = val;
  };

  const handleSubmitSearch = () => {
    nextTick(() => formRef.value.submit())
  };

  const handleIconClick = () => {
    if (searchValue.value.length) {
      handleSubmitSearch();
    } else {
      handleFocus();
    }
  };
</script>

<template>
  <form 
    method="GET"
    ref="formRef"
    :action="`/${brand}/search`"
    class="tw-m-4 tw-relative dark:tw-bg-[#000C17] tw-bg-[#E6E7E9] tw-rounded-[5px] tw-hidden lg:tw-block tw-overflow-hidden"
  >
    <!-- Search Icon -->
    <div class="tw-cursor-pointer tw-absolute tw-h-[37px] tw-w-[32px] dark:tw-bg-[#000C17] tw-bg-[#E6E7E9] tw-z-20 tw-left-0 tw-top-0" @click="handleIconClick">
      <MusoraIcon
        icon-name="search"
        class="tw-absolute tw-top-3 tw-left-3 dark:tw-text-[#9EC0DC] tw-z-0"
      />
    </div>

    <InputLabel
      :showClearButton="true"
      placeholder="Search"
      inputName="term"
      id="sidebar-search"
      @onChange="handleChange"
      @onEnter="handleSubmitSearch"
      :inputOverride="`
        tw-outline-offset-0
        tw-relative
        tw-z-10
        tw-w-full
        tw-h-[37px]
        tw-border-none
        tw-text-xs
        tw-rounded-[5px]
        tw-transition-color
        dark:tw-text-white
        tw-bg-transparent
        focus:tw-outline-[#445f74] focus:tw-outline-1 focus:tw-ring-transparent dark:focus:tw-outline-[#9EC0DC]
        tw-shadow-none
        tw-pr-[36px]
        ${isSidebarCollapsed
          ? 'placeholder:tw-text-transparent tw-pl-6 tw-cursor-pointer'
          : 'dark:placeholder:tw-text-[#9EC0DC] tw-pl-8'}
        `
      "
      clearButtonOverride="dark:tw-text-white"
      @onFocus="handleFocus"
    />
  </form>
</template>