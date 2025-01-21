<template>
    <div>
        <CollectionFilterWrapper
            :parentUrl="parentUrl" :active-tab="getActiveTab" :hide-controls="hideControls"  :hide-controls-section="hideControlsSection" :hide-sort-icon="hideSortIcon" :hide-filter-icon="hideFilterIcon" :loading="loading" :selected-filters="getSelectedFilters" :selected-progress="filter.progress" :selected-sort="getSelectedSort" :search-term="getSearchTerm" :search-placeholder="searchPlaceholder" :tab-options="tabOptionData" :multi-select-columns="filterColumns" :sort-options="getSortOptions" :show-progress-filters="showProgressFilters"
            @on-clear-filter="handleClearFilter" @on-filter-change="handleFilterChange" @on-search-change="handleSearchChange" @on-sort-change="handleSortChange" @on-tab-change="handleTabChange" @on-progress-change="handleProgressChange"
        />

        <transition appear name="fade">
            <!-- Delete contentType prop after May 6th -->
            <CollectionResults :content="data" :selected-filters="getSelectedFilters" :selected-progress="filter.progress" :search-term="getSearchTerm" :current-page="getCurrentPage" :total-pages="getTotalPages" :infinite-scroll="infiniteScroll" @on-load-more="sanityCollectionStore.loadMore" :contentType="collectionType">
                <GroupedResultsContainer v-if="showGroupBy" :content="data" :content-type-override="collectionType" />
                <SongCardContainer
                    v-else-if="isSong"
                    :pre-loaded-content="data"
                    :content-type-override="collectionType"
                    :subscription-calendar-id="subscriptionCalendarId"
                />
                <ListCatalogue v-else-if="isList" :content="data" :force-wide-thumbs="isStudentReview" :show-reset-progress="showResetProgress"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <CatalogueCardContainer
                    v-else
                    :pre-loaded-content="data"
                    :content-type-override="collectionType"
                    :will-scroll="false"
                    :subscription-calendar-id="subscriptionCalendarId"
                    :is-admin="isAdmin"
                />
            </CollectionResults>
        </transition>
    </div>
</template>

<script setup>
import {onMounted, computed, onBeforeMount} from "vue";
import { useSanityCollectionStore } from "../../../stores/sanityCollection";
import {storeToRefs} from "pinia";
import { useUserStore } from "../../../stores/user";
import CollectionFilterWrapper from '../Filter/CollectionFilterWrapper.vue';
import CollectionResults from '../Catalogue/CollectionResults.vue';
import UserCatalogueEvents from "../../vuesora/mixins/UserCatalogueEvents";

//Views
import ListCatalogue from "../../vuesora/views/catalogues/ListCatalogue";
import CatalogueCardContainer from "../Catalogue/CatalogueCardContainer";
import SongCardContainer from "../Catalogue/SongCardContainer";
import RoutinesCatalogue from "../../vuesora/views/catalogues/RoutinesCatalogue";
import CoachesGridCatalogue from "../../vuesora/views/catalogues/CoachesGridCatalogue";
import GroupedResultsContainer from "../GroupedResultsContainer/GroupedResultsContainer";
import DownloadsCatalogue from "../../vuesora/views/catalogues/DownloadsCatalogue";
import PackCatalogue from "../Packs/PackCatalogue";

const props = defineProps({
    collectionType: {
        default: '',
    },
    defaultSort: {
        type: String,
        default: '-published_on',
    },
    endpoint: {
        type: String,
        default: () => '',
    },
    searchEndpointUrl: {
        type: String,
        default: () => '',
    },
    filterableValues: {
        type: Array,
        default: () => [],
    },
    hideControls: {
        type: Boolean,
        default: false,
    },
    hideControlsSection: {
        type: Boolean,
        default: false,
    },
    hideSortIcon: {
        type: Boolean,
        default: () => false,
    },
    hideFilterIcon: {
        type: Boolean,
        default: () => false,
    },
    hideSearch: {
        type: Boolean,
        default: () => false,
    },
    includeFutureScheduledContentOnly: {
        type: Boolean,
        default: () => false,
    },
    parentUrl: {
        type: String,
        default: () => "/",
    },
    limit: {
        type: [Number, Boolean],
        default: () => 10,
    },
    requiredFields: {
        type: Array,
        default: () => [],
    },
    showResetProgress: {
        type: Boolean,
        default: () => false,
    },
    subscriptionCalendarId: {
        type: String,
        default: () => '',
    },
    requiredUserStates: {
        type: Array,
        default: () => [],
    },
    statuses: {
        type: Array,
        default: () => ["published"],
    },
    tabOptions: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: () => '',
    },
    tabs: {
        type: Array,
        default: () => [],
    },
    infiniteScroll: {
        type: Boolean,
        default: () => true,
    },
    sortOptions: {
        type: Array,
        default: () => [
            { value: '-published_on', name: 'Newest First', icon: 'sort-down', },
            { value: 'published_on', name: 'Oldest First', icon: 'sort-up', },
            { value: '-popularity', name: 'Most Popular', icon: 'sort-popularity', },
            { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
            { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
        ]
    },
    searchPlaceholder: {
        type: String,
        default: '',
    },
    withoutEnrollment: {
        type: Boolean,
        default: () => false,
    },
    includedTypes: {
        default: '',
    },
    isAllContent: {
        type: Boolean,
        default: () => false,
    },
    isAdmin: {
        type: Boolean,
        default: () => false,
    },
    showProgressFilters: {
        type: Boolean,
        default: () => true,
    },
    multipleTypes: {
        type: Boolean,
        default: () => false,
    },
    noResultsMessage: {
        type: String,
        default: '',
    },
});

const sanityCollectionStore = useSanityCollectionStore();
const userStore = useUserStore();

const { data, currentPage, filter, loading, totalPages, tabData, filterColumns, searching } = storeToRefs(sanityCollectionStore);
const { brand } = storeToRefs(userStore);

const request_params = computed(() => {
    return {
        required_fields: props.requiredFields,
        included_fields: props.includedFields,
        required_user_states: props.requiredUserStates,
        included_types: includedTypes.value,
        include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
        limit: props.limit,
        ...({ without_enrollment: props.withoutEnrollment }),
        is_all: props.isAllContent,

    };
})

const includedTypes = computed(() => {
    let types = [];

    if(props.multipleTypes){
        types = props.includedTypes;
    } else {
        props.collectionType && types.push(props.collectionType) && types.push(props.includedTypes);
    }

    return types;
})

//Collection type reactives
const isSong = computed(() => {
    return props.collectionType === 'song' || (isRecommendation.value && getActiveTab.value === 'Songs');
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

//Filter state reactive
const hideFilter = computed(() => {
    return isRoutine.value;
})

const getTabOptions = computed(() => {
    if (props.tabs?.length) {
        return props.tabs.map(({ name, value, is_required_field, is_group_by }) => {
            return {
                key: (is_group_by) ? ['group_by,' + value[0]] : value,
                value: name,
                groupByView: (is_group_by) ? true : false,
            }
        })
    }
    return [
        { key: `all${props.title.replace(' ', '').toLowerCase()}`, value: `All ${props.title}` },
    ]
});

const tabOptionData = computed(() => {
    return props.tabOptions.length > 0 ? props.tabOptions : getTabOptions.value;
})

const getTabData = computed(() => {
    return  {
        currentPage: 1,
    }
})

//prop reactives
const activeTabData = computed(() => {
    return tabData.value[filter.value.activeTab];
})

const getSelectedFilters = computed(() => {
    return filter.value.includedFields;
})

const getSelectedSort = computed(() => {
    return filter.value.sort;
})

const getSearchTerm = computed(() => {
    return filter.value.searchTerm;
})

const getCurrentPage = computed(() => {
    return activeTabData.value && activeTabData.value.currentPage;
})

const getTotalPages = computed(() => {
    return activeTabData.value && activeTabData.value.totalPages;
})

const getActiveTab = computed(() => {
    return Array.isArray(filter.value.activeTab) ? JSON.stringify(filter.value.activeTab) : filter.value.activeTab;
})

const getSortOptions = computed(() => {
    return showGroupBy.value ?
        [
            { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
            { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
        ]
        : props.sortOptions

})

const handleClearFilter = () => {
    sanityCollectionStore.clearFilter();
}
const handleFilterChange = (param) => {
    sanityCollectionStore.applyFilter(param);
}
const handleProgressChange = (value) => {
    sanityCollectionStore.setProgress(value);
}
const handleSearchChange = (value) => {
    sanityCollectionStore.setSearchTerm(value)
}
const handleSortChange = (item) => {
    sanityCollectionStore.sortData(item);
}
const handleTabChange = (tab) => {
    sanityCollectionStore.switchTab(tab);
}

onBeforeMount(() => {
    sanityCollectionStore.setDefaults({
        filter: {
            params: { ...request_params.value },
            ['title']: '',
            sort: props.defaultSort,
        },
        tabData: getTabData.value,
        tabOptions: tabOptionData.value,
        endpoint: props.endpoint,
        searchEndpointUrl: props.searchEndpointUrl,
        sortOptions: props.sortOptions,
        defaultSort: props.defaultSort,
    })
    sanityCollectionStore.getURLParams();
    sanityCollectionStore.getData();
})

onMounted(() => {
    // console.log('collection type',props.collectionType)
    // console.log(props.sortOptions, props.defaultSort)
    // console.log(props.preLoadedContent)
})
</script>
