<template>
    <div class="lg:tw-flex tw-flex-wrap lg:tw-gap-14 tw-text-[#000C17] dark:tw-text-white">
        <filter-multi-selection-item v-for="column in multiSelectColumns" :column="column" @click-column-item="clickColumnItem" :filters="filters">
        </filter-multi-selection-item>
        <filter-single-selection-item v-for="column in singleSelectColumns" :column="column" @single-select="singleSelect" :selected-value="selectedOption[column.category] ? selectedOption[column.category].value : ''">
        </filter-single-selection-item>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import FilterMultiSelectionItem from './FilterMultiSelectionItem';
import FilterSingleSelectionItem from './FilterSingleSelectionItem';

const props = defineProps({
    multiSelectColumns: {
        type: Array,
        default: [],
    },
    singleSelectColumns: {
        type: Array,
        default: [],
    },
});

 const filters = ref({});
 const selectedOption = ref({});

 const clickColumnItem = (category, item) => {
     if (filters.value[category]){
        const isChecked = filters.value[category].find((f)=> f.value === item.value);

        if (isChecked) {
            filters.value[category] = filters.value[category].filter((f) => f.value !== item.value);

            if(filters.value[category].length === 0) {
                delete filters.value[category];
            }
        }

        else {
            filters.value[category].push(item);
        }
     }

     else {
         filters.value[category] = [item];
     }
 };

 const singleSelect = (category, item) => {
     selectedOption.value[category] = item;
 }

onMounted(()=>{
    if(Object.keys(selectedOption.value).length === 0 && props.singleSelectColumns.length > 0) {
        selectedOption.value = {
            [props.singleSelectColumns[0].category]: props.singleSelectColumns[0].items[0],
        }
    }
})
</script>

<style scoped>

</style>
