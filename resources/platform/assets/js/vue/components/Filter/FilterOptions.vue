<template>
    <div class="lg:tw-flex tw-flex-wrap lg:tw-gap-14 tw-text-[#000C17] dark:tw-text-white">
        <filter-multi-selection-item v-for="column in columns" :column="column" @click-column-item="clickColumnItem" :filters="filters">
        </filter-multi-selection-item>
        <filter-single-selection-item v-for="column in singleColumns" :column="column" @single-select="singleSelect" :selected-value="selectedOption[column.category] ? selectedOption[column.category].value : ''">
        </filter-single-selection-item>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import FilterMultiSelectionItem from './FilterMultiSelectionItem';
    import FilterSingleSelectionItem from './FilterSingleSelectionItem';

    //Mock data
     const columns = [
         {
             category: 'Skill level',
                items: [
                    {
                        name: 'Level 1',
                        value: 'level_1',
                    },
                    {
                        name: 'Level 2',
                        value: 'level_2',
                    },
                    {
                        name: 'Level 3',
                        value: 'level_3',
                    },
                    {
                        name: 'Level 4',
                        value: 'level_4',
                    },
                    {
                        name: 'Level 5',
                        value: 'level_5',
                    },
                ],
         },
         {
             category: 'Genre',
             items: [
                 {
                     name: 'item 1',
                     value: 'item_1',
                 },
                 {
                     name: 'item 2',
                     value: 'item_2',
                 },
                 {
                     name: 'item 3',
                     value: 'item_3',
                 },
                 {
                     name: 'item 4',
                     value: 'item_4',
                 },
                 {
                     name: 'item 5',
                     value: 'item_5',
                 },
             ],
         },
         {
             category: 'Genre1',
             items: [
                 {
                     name: 'item1 1',
                     value: 'item1_1',
                 },
                 {
                     name: 'item1 2',
                     value: 'item1_2',
                 },
                 {
                     name: 'item1 3',
                     value: 'item1_3',
                 },
                 {
                     name: 'item1 4',
                     value: 'item1_4',
                 },
                 {
                     name: 'item1 5',
                     value: 'item1_5',
                 },
             ],
         },
         {
             category: 'Genre2',
             items: [
                 {
                     name: 'item2 1',
                     value: 'item2_1',
                 },
                 {
                     name: 'item2 2',
                     value: 'item2_2',
                 },
                 {
                     name: 'item2 3',
                     value: 'item2_3',
                 },
                 {
                     name: 'item2 4',
                     value: 'item2_4',
                 },
                 {
                     name: 'item2 5',
                     value: 'item2_5',
                 },
             ],
         },
         {
             category: 'Genre3',
             items: [
                 {
                     name: 'item3 1',
                     value: 'item3_1',
                 },
                 {
                     name: 'item3 2',
                     value: 'item3_2',
                 },
                 {
                     name: 'item3 3',
                     value: 'item3_3',
                 },
                 {
                     name: 'item3 4',
                     value: 'item3_4',
                 },
                 {
                     name: 'item3 5',
                     value: 'item3_5',
                 },
             ],
         },
         {
             category: 'Genre4',
             items: [
                 {
                     name: 'item4 1',
                     value: 'item4_1',
                 },
                 {
                     name: 'item4 2',
                     value: 'item4_2',
                 },
                 {
                     name: 'item4 3',
                     value: 'item4_3',
                 },
                 {
                     name: 'item4 4',
                     value: 'item4_4',
                 },
                 {
                     name: 'item4 5',
                     value: 'item4_5',
                 },
             ],
         },
     ];

     const singleColumns = [
         {
             category: 'Progress',
             items: [
                 {
                     name: 'In Progress',
                     value: 'in_progress',
                 },
                 {
                     name: 'Complete',
                     value: 'complete',
                 },
             ],
         },
     ];

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
</script>

<style scoped>

</style>
