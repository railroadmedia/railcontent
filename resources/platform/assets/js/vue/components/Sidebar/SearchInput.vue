<script setup>
import InputLabel from "../InputLabel/InputLabel.vue";
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
const props = defineProps({
  isSidebarCollapsed: {
      type: Boolean,
  },
});

const emit = defineEmits(['onCollapse'])

const handleChange = () => {
    console.log('handle change called')
};

const handleFocus = () => {
    emit('onCollapse', false);
};
</script>

<template>
  <div
    class="tw-m-4 tw-relative dark:tw-bg-[#000C17] tw-bg-[#E6E7E9] tw-rounded-[5px] tw-hidden lg:tw-block tw-overflow-hidden"
  >
    <!-- Search Icon -->
    <div class="tw-absolute tw-h-[37px] tw-w-[32px] dark:tw-bg-[#000C17] tw-bg-[#E6E7E9] tw-z-20 tw-left-0 tw-top-0" @click="handleFocus">
      <MusoraIcon
        icon-name="search"
        class="tw-absolute tw-top-3 tw-left-3 dark:tw-text-[#9EC0DC] tw-z-0"
      />
    </div>

    <InputLabel
      :showClearButton="true"
      placeholder="Search"
      @onChange="handleChange"
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
      @onFocus="handleFocus"
    />
  </div>
</template>