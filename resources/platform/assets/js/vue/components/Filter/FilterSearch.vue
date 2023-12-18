<template>
    <form
        class="tw-relative dark:tw-bg-black tw-bg-white tw-rounded-[63px] tw-w-full tw-h-[45px] md:tw-mb-0"
    >
        <!-- Search Icon -->
        <div class="tw-flex tw-justify-center tw-items-center tw-cursor-pointer tw-absolute tw-h-full tw-rounded-[5px] tw-w-[25px] tw-mr-[20px] tw-bg-transparent tw-z-20 tw-right-0 tw-top-0" @click="handleIconClick">
            <SearchIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
        </div>

        <InputLabel
            :showClearButton="true"
            :initial-value="searchTerm"
            placeholder="Search"
            inputName="term"
            id="workouts-search"
            :removeDefaultInputStyles="true"
            @onChange="handleChange"
            @onEnter="handleSubmitSearch"
            :inputOverride="`
            tw-relative
            tw-outline-offset-0
            tw-relative
            tw-z-10
            tw-w-full
            tw-h-[45px]
            tw-border-[#CBCBCD]
            dark:tw-border-[#445F74]
            tw-text-xs
            tw-rounded-[63px]
            tw-transition-color
            dark:tw-text-white
            tw-bg-transparent
            focus:tw-outline-[#445f74] focus:tw-outline-1 focus:tw-ring-transparent dark:focus:tw-outline-[#223F57]
            tw-shadow-none
            tw-pr-[36px]
            ${isSidebarCollapsed
              ? 'placeholder:tw-text-transparent tw-pl-6 tw-cursor-pointer'
              : 'dark:placeholder:tw-text-[#9EC0DC] tw-pl-8'}
            `
          "
            clearButtonOverride="dark:tw-text-white tw-mr-[35px]"
            @onFocus="handleFocus"
        />
    </form>
</template>

<script setup>
  import InputLabel from "../InputLabel/InputLabel.vue";
  import { SearchIcon } from '@heroicons/vue/outline'
  import {ref} from "vue";

  const props = defineProps({
    isSidebarCollapsed: {
      type: Boolean,
    },
    brand: {
      type: String,
      default: 'Drumeo',
    },
    searchTerm: {
      type: String,
      default: '',
    },
  });

  const emit = defineEmits(['onSubmit', 'onTextChange']);

  const searchText = ref('');

  const handleFocus = () => {
      //emit('onCollapse', false);
  };

  const handleChange = (val) => {
      searchText.value = val;
  };

  const handleSubmitSearch = () => {
      emit('onSubmit', searchText.value);
  };

  const handleIconClick = () => {
      handleSubmitSearch();
  };
</script>
