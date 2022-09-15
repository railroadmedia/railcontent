<script setup>
import ModalRenderer from "../Modal/ModalRenderer.vue";
import InputLabel from "../InputLabel/InputLabel.vue";
import MusoraIcon from "../MusoraIcons/MusoraIcon.vue";
import { XIcon, SearchIcon } from "@heroicons/vue/solid";
import { bgColor } from "../../../constants/brands"
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
  <ModalRenderer @onClose="() => emit('onClose')">
    <div class="
        lg:tw-hidden
        tw-w-[338px] tw-h-[180px]
        md:tw-w-[612px] md:tw-h-[180px]
        tw-flex
        tw-flex-col
        tw-bg-white
        dark:tw-bg-[#002039]
        tw-rounded-[6px]
        tw-border-[#445F74]
        tw-overflow-hidden
        dark:tw-text-[#9EC0DC]
        tw-border-[1px] tw-border-[#445f74]
      " style="
        box-shadow: 0px 20px 25px -5px rgba(0, 0, 0, 0.1),
          0px 10px 10px -5px rgba(0, 0, 0, 0.04);
      ">
      <form 
        method="GET"
        ref="searchForm"
        :action="`/${brand}/search`" 
        class="tw-relative tw-h-[62px] tw-flex tw-items-center tw-w-full"
      >
        <MusoraIcon icon-name="search" class="tw-absolute tw-top-6 tw-left-6 dark:tw-text-[#9EC0DC] tw-z-0" />
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
            tw-border-none
            tw-text-xs
            tw-transition-color
            dark:tw-placeholder-[#9EC0DC]
            dark:tw-text-white
            tw-bg-transparent
            tw-shadow-none
            tw-pl-[48px]
            tw-pr-[36px]
            focus:tw-ring-0`" 
            @keyup.enter="handleSearch"
        />
        <div class="tw-mr-[24px]">
          <button 
            type="submit"
            :class="`tw-rounded-full tw-w-[36px] tw-h-[36px] tw-flex tw-items-center tw-justify-center tw-text-white ${bgColor[brand]}`"
          >
            <SearchIcon class="tw-w-[24px] tw-h-[24px]" />
          </button>
        </div>
      </form>
      <div class="tw-border-t-[1px] tw-border-[#445f74]/40 tw-w-full tw-flex-grow"></div>
    </div>
  </ModalRenderer>
</template>