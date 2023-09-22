<script setup>
import useUserCatalogueEvents from '../../hooks/useUserCatalogueEvents';

const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    dropdownOptions: {
        type: Object,
    },
    item: {
        type: Object,
    },
    isOpen: {
        type: Boolean,
        default: false
    },
})

const { progressReset } = useUserCatalogueEvents(props);
</script>

<template>
    <div v-if="isOpen"
         class="tw-w-[162px] tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-py-2 tw-top-8">
        <ul class="tw-text-xs tw-w-full">
            <!-- List Items -->
            <li v-for="(item, i) in dropdownOptions" :key="i" class="tw-w-full">
                <button
                    class="tw-flex tw-items-center tw-w-full tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                    @click="(event)=>{
                        $emit(item.action, event);
                        $emit('closeDropdown');
                    }"
                >
                    <svg v-if="item.name === 'Add to Playlist'" xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 -tw-ml-1 tw-mr-1" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    <i v-else-if="item.name === 'Reset Progress'" class="fas fa-undo flex-center reset tw-mr-2" title="Reset Progress" aria-hidden="true"></i>
                        {{ item.name }}
                </button>
            </li>
        </ul>
    </div>
</template>
