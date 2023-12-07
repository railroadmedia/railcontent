<template>
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-justify-between tw-mb-5">
        <div class="tw-flex tw-grow tw-relative tw-items-center tw-mb-3 lg:tw-mb-0">
            <!-- Filter Tabs -->
            <filter-tabs v-if="tabOptions.length > 0" :active-tab="activeTab" :tab-options="tabOptions" @onTabClick="handleTabClick" />
            <div v-if="!hideFilter" class="tw-flex tw-grow tw-justify-end md:tw-hidden">
                <button @click="handleOpenDropdown"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <musora-icon :icon-name="sortIcon()" class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white" />
                </button>
                <button v-else @click="() => emit('onToggleCollapse')"
                    class="tw-flex tw-self-end tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[40px] tw-h-[40px]">
                    <AdjustmentsIcon class="tw-w-[18px] tw-h-[18px] tw-text-black dark:tw-text-white tw-rotate-90" />
                </button>
                <slot></slot>
            </div>
        </div>
        <div v-if="!hideFilter" class="tw-flex tw-grow tw-justify-end tw-items-start">
            <div class="tw-flex tw-grow tw-items-center tw-relative">
                <filter-search :search-term="searchTerm" @on-submit="handleSubmit"></filter-search>
                <template v-if="!hideFilterIcon">
                    <button v-if="!isCollapsed" @click="() => emit('onToggleCollapse')"
                        class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[50px] tw-h-[50px] tw-border-[2px] tw-border-black tw-bg-[#000C17] dark:tw-bg-white dark:tw-border-white tw-rounded-full">
                        <XIcon class="tw-w-[18px] tw-h-[18px] tw-text-white dark:tw-text-[#000C17]" />
                    </button>
                    <button v-else @click="() => emit('onToggleCollapse')"
                        class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-border-[2px] tw-border-[#CBCBCD] hover:tw-border-[#000C17] dark:tw-border-white tw-rounded-full hover:tw-bg-[#000C17] hover:dark:tw-bg-white tw-text-[#000C17] dark:tw-text-white hover:tw-text-white hover:dark:tw-text-[#000C17] ">
                        <AdjustmentsIcon class="tw-w-[22px] tw-h-[22px] tw-rotate-90" />
                    </button>
                </template>
                <button @click="handleOpenDropdown"
                    class="tw-hidden md:tw-flex tw-items-center tw-justify-center tw-ml-[12px] tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-border-[2px] tw-border-[#CBCBCD] tw-bg-white dark:tw-bg-[#000C17] dark:tw-border-white tw-rounded-full">
                    <musora-icon :icon-name="sortIcon()" class="tw-w-[22px] tw-h-[22px] tw-text-black dark:tw-text-white" />
                </button>
                <FilterSortDropdown v-if="showDropdown" :sortOptions="sortOptions" :selected-sort="()=>selectedSort" @onClose="handleCloseDropdown"
                    @onSort="value => $emit('onSort', value)" />
            </div>
        </div>
    </div>
</template>

<script setup>
    import {onMounted, ref} from 'vue';
    import { AdjustmentsIcon, XIcon } from '@heroicons/vue/outline';
    import FilterTabs from './FilterTabs.vue';
    import FilterSearch from './FilterSearch.vue';
    import FilterSortDropdown from './FilterSortDropdown.vue';
    import MusoraIcon from "../MusoraIcons/MusoraIcon";

    const props = defineProps({
        activeTab: {
            type: String,
            default: '',
        },
        hideFilter: {
            type: Boolean,
            default: false,
        },
        searchTerm: {
            type: String,
            default: '',
        },
        selectedSort: {
            type: String,
            default: '',
        },
        isCollapsed: {
            type: Boolean,
            default: true,
        },
        tabOptions: {
          type: Array,
          default: [],
        },
        sortOptionData: {
            type: Array,
            default: [],
        },
        hideFilterIcon: {
            type: Boolean,
            default: false,
        },
    });

    const emit = defineEmits(['onToggleCollapse', 'onFilterTabClick', 'onSearchSubmit']);
    const showDropdown = ref(false);
    const sortOptions = ref(null);

    // the following refs will be replaced by pinia state
    const inputText = ref('');
    const selectedSort = ref('');

    const handleTabClick = (value) => {
        emit('onFilterTabClick', value)
    };

    const handleSubmit = (value) => {
        emit('onSearchSubmit', value);
    };

    const handleCloseDropdown = () => {
        showDropdown.value = false;
    };

    const handleOpenDropdown = () => {
        showDropdown.value = true;
    };

    const sortIcon = () => {
        return sortOptions.value && sortOptions.value.find(option => option.value === props.selectedSort).icon;
    };

    onMounted(()=>{
        if (props.sortOptionData.length === 0){
            sortOptions.value = [
                { value: '-published_on', name: 'Newest First', icon: 'sort-down', },
                { value: 'published_on', name: 'Oldest First', icon: 'sort-up', },
                { value: '-popularity', name: 'Most Popular', icon: 'sort-popularity', },
                { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
                { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
            ];
        }
        else {
            sortOptions.value = props.sortOptionData;
        }

        selectedSort.value = sortOptions.value[0].key;
    })
</script>

<style scoped></style>
