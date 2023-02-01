<script setup>
import { ref } from 'vue';
import Toggle from '../Toggle/Toggle.vue'
import Table from '../Table/Table.vue'
import { PlusCircleIcon } from '@heroicons/vue/outline';
const props = defineProps({

});


const toggleValue = ref(false);

const handleOnToggle = (val) => {
    console.log(val);
    toggleValue.value = val;
};

const handleActionClick = (payload) => {
    console.log(payload);
};

</script>

<template>
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-white tw-text-center">
        <h2 class="tw-text-[24px] tw-font-bold tw-w-full tw-text-center">Add Item to Playlist</h2>
        <h4 class="tw-text-[16px] tw-text-left tw-w-full">Additional Playlist Items</h4>
        <div class="tw-flex tw-w-full">
            <fieldset class="tw-flex tw-flex-row tw-items-center tw-w-full">
                <p class="tw-text-left tw-text-[14px] tw-pr-[16px]">Your selected videos contain 7 additional assignment items. Would you like to also import them into your playlist?</p>
                <Toggle @onToggle="handleOnToggle" :value="toggleValue" />
            </fieldset>
        </div>
        <Table @onActionClick="handleActionClick" classOverride="tw-mt-[24px]">
            <template v-slot:actionContent>
                <PlusCircleIcon class="tw-w-[23px] tw-h-[23px] tw-text-[#7E9AB1]"  />
            </template>
        </Table>
    </div>
</template>