<template>
    <div class="lg:tw-flex tw-flex-wrap lg:tw-gap-14 tw-text-[#000C17] dark:tw-text-white">
        <filter-multi-selection-item v-for="column in multiSelectColumns" :column="column" @click-column-item="param => emit('onFilterClickHandle', param)" :selected-filters="selectedFilters">
        </filter-multi-selection-item>
        <filter-single-selection-item v-for="column in singleSelectColumns" :column="column" @single-select="singleSelect" :selected-value="selectedOption[column.category] ? selectedOption[column.category].value : ''">
        </filter-single-selection-item>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import FilterMultiSelectionItem from './FilterMultiSelectionItem';
    import FilterSingleSelectionItem from './FilterSingleSelectionItem';

    const props = defineProps({
        multiSelectColumns: {
            type: Array,
            default: [],
        },
        selectedFilters:{
            type: Object,
            default: () => ({}),
        },
        singleSelectColumns: {
            type: Array,
            default: [],
        },
    });

    const emit = defineEmits(['onFilterClickHandle']);

    const selectedOption = ref({});

    const clickColumnItem = (category, item) => {
         let newSelection = {...props.selectedFilters};

         if (newSelection[category]){
            const isChecked = newSelection[category].find((f)=> f === item.value);

            if (isChecked) {
                newSelection[category] = newSelection[category].filter((f) => f !== item.value);

                if(newSelection[category].length === 0) {
                    delete newSelection[category];
                }
            }
            else {
                newSelection[category].push(item.value);
            }

         }
         else {
             newSelection[category] = [item.value];
         }

         emit('onFilterClickHandle', newSelection);
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
