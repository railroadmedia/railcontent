<template>
    <form
        class="tw-relative dark:tw-bg-black tw-bg-white tw-rounded-[63px] tw-w-full xl:tw-max-w-[500px] tw-h-[45px] md:tw-mb-0"
    >
        <!-- Search Icon -->
        <div class="tw-flex tw-justify-center tw-items-center tw-cursor-pointer tw-absolute tw-h-full tw-rounded-[5px] tw-w-[25px] tw-mr-[20px] tw-bg-transparent tw-z-20 tw-right-1 tw-top-0" @click="handleIconClick">
            <SearchIcon class="tw-w-[18px] tw-h-[18px] tw-text-[#000C17] dark:tw-text-white" />
        </div>

        <InputLabel
            :showClearButton="true"
            :initial-value="searchTerm"
            :placeholder="searchPlaceholder"
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
            tw-text-sm
            tw-rounded-[63px]
            tw-transition-color
            dark:tw-text-white
            tw-bg-transparent
            focus:tw-outline-[#445f74] focus:tw-outline-1 focus:tw-ring-transparent dark:focus:tw-outline-[#223F57]
            tw-shadow-none
            tw-pr-[36px]
            ${isSidebarCollapsed
              ? 'placeholder:tw-text-transparent tw-pl-6 tw-cursor-pointer'
              : 'placeholder:tw-text-[#000C17] dark:placeholder:tw-text-white tw-pl-8'}
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
  import { ref, computed } from "vue";

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
    placeholder: {
      type: String,
      default: '',
    },
    tabOptions: {
      type: Array,
      default: [],
      },
    activeTab: {
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

  const searchPlaceholder = computed(() => {
      if(props.tabOptions.length > 1) {
          return `Search ${props.activeTab}`;
      }
      else if(props.placeholder) {
          return props.placeholder;
      }
      else {
          return 'Search';
      }
  })
</script>
