<script setup>
import InfoModal from "../Modal/InfoModal.vue";
import InputLabel from "../InputLabel/InputLabel.vue";
import MusoraIcon from "../MusoraIcons/MusoraIcon.vue";
import { XIcon, SearchIcon } from "@heroicons/vue/solid";
import { ref } from 'vue'

const props = defineProps({
  brand: {
    type: String,
    default: 'drumeo'
  }
});

const emit = defineEmits(['onClose', 'onOnEnter']);
//refs
const searchForm = ref(null);
const searchInput = ref(null);

const onSearch = () => {
  // handle search
};

const handleSearch = () => {
  searchForm.value.submit()
};

</script>

<template>
  <InfoModal @onClose="() => emit('onClose')" :self-contained="true" modal-id="search-modal" title="Search" class-override="tw-max-w-[450px]">
      <form
        method="GET"
        ref="searchForm"
        :action="`/${brand}/search`"
        class="tw-relative tw-h-[62px] tw-flex tw-items-center tw-w-full"
      >
        <MusoraIcon icon-name="search" class="tw-absolute tw-top-6 tw-left-6 dark:tw-text-white tw-z-10" />
        <InputLabel
          :showClearButton="true"
          ref="searchInput"
          placeholder="Search"
          inputName="term"
          id="modal-search"
          wrapperOverride="tw-flex-grow"
          :inputOverride="`
            tw-outline-offset-0
            tw-relative
            tw-w-full
            tw-h-[37px]
            tw-text-xs
            tw-transition-color
            dark:tw-text-white
            placeholder:dark:tw-text-white
            tw-bg-transparent
            tw-shadow-none
            tw-pl-[48px]
            tw-pr-[36px]
            tw-mr-2
            focus:tw-ring-0`"
            @keyup.enter="handleSearch"
        />
        <div class="">
          <button
            type="submit"
            :class="`tw-rounded-full tw-w-[36px] tw-h-[36px] tw-flex tw-items-center tw-justify-center tw-text-white dark:tw-bg-black tw-border tw-border-[#D4D4D8] dark:tw-border-[#445F74]`"
          >
            <SearchIcon class="tw-w-[24px] tw-h-[24px]" />
          </button>
        </div>
      </form>
  </InfoModal>
</template>
