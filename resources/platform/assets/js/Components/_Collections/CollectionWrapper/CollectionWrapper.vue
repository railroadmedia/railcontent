<template>
    <div>
        <CollectionFilterWrapper
            :parentUrl="parentUrl" :active-tab="getActiveTab" :hide-controls="hideControls"  :hide-controls-section="hideControlsSection" :hide-sort-icon="hideSortIcon" :hide-filter-icon="hideFilterIcon" :hide-search="hideSearch" :loading="loading" :selected-filters="getSelectedFilters" :selected-progress="filter.progress" :selected-sort="getSelectedSort" :search-term="getSearchTerm" :search-placeholder="searchPlaceholder" :tab-options="tabOptions" :multi-select-columns="filterColumns" :sort-options="getSortOptions" :show-progress-filters="showProgressFilters"
            @on-clear-filter="handleClearFilter" @on-filter-change="handleFilterChange" @on-search-change="handleSearchChange" @on-sort-change="handleSortChange" @on-tab-change="handleTabChange" @on-progress-change="handleProgressChange"
        />

        <transition appear name="fade">
            <!-- Delete contentType prop after May 6th -->
            <CollectionResults :content="data" :selected-filters="getSelectedFilters" :selected-progress="filter.progress" :search-term="getSearchTerm" :current-page="getCurrentPage" :total-pages="getTotalPages" :infinite-scroll="infiniteScroll" @on-load-more="collectionStore.loadMore" :contentType="collectionType">
                <GroupedResultsContainer v-if="showGroupBy" :content="data" :content-type-override="collectionType" />
                <ChallengeCardContainer v-else-if="isChallenge" :content="data" />
                <PackCatalogue v-else-if="isPack" :content="data" />
                <CoachesGridCatalogue v-else-if="isCoach" :content="data" :brand="brand" />
                <ForumThreadsTable v-else-if="isThreads" :threads="data" :searching="searching" :search-term="getSearchTerm" />
                <SongCardContainer
                    v-else-if="isSong"
                    :pre-loaded-content="data"
                    :content-type-override="collectionType"
                    :subscription-calendar-id="subscriptionCalendarId"
                />
                <DownloadsCatalogue v-else-if="isDownloadView" :content="data" />
                <RoutinesCatalogue v-else-if="isRoutine" :content="data"
                                   @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <ListCatalogue v-else-if="isList" :content="data" :force-wide-thumbs="isStudentReview" :show-reset-progress="showResetProgress" />
                <CatalogueCardContainer
                    v-else
                    :pre-loaded-content="data"
                    :content-type-override="collectionType"
                    :will-scroll="false"
                    :subscription-calendar-id="subscriptionCalendarId"
                />
            </CollectionResults>
        </transition>
    </div>
</template>

<script setup>
import { onMounted, computed } from "vue";
import { useCollectionStore } from "@stores/collection";
import { storeToRefs } from "pinia";
import { useUserStore } from "@stores/user";
import CollectionFilterWrapper from '@collections/Filter/CollectionFilterWrapper.vue';
import CollectionResults from '../Catalogue/CollectionResults.vue';
import UserCatalogueEvents from "@vuesora/mixins/UserCatalogueEvents";
import userJourney from "@services/userJourney";

//Views
import ListCatalogue from "@collections/ListCatalogue/ListCatalogue";
import CatalogueCardContainer from "@collections/Catalogue/CatalogueCardContainer";
import SongCardContainer from "@collections/Catalogue/SongCardContainer";
import RoutinesCatalogue from "@collections/Catalogue/RoutineCatalogue";
import CoachesGridCatalogue from "@vuesora/views/catalogues/CoachesGridCatalogue";
import GroupedResultsContainer from "@collections/GroupedResultsContainer/GroupedResultsContainer";
import DownloadsCatalogue from "@vuesora/views/catalogues/DownloadsCatalogue";
import PackCatalogue from "@collections/Packs/PackCatalogue";
import ChallengeCardContainer from '@collections/Catalogue/ChallengeCardContainer';

const props = defineProps({
    collectionType: {
        default: '',
    },
    defaultSort: {
        type: String,
        default: '-published_on',
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
    parentUrl: {
        type: String,
        default: () => "/",
    },
    limit: {
        type: [Number, Boolean],
        default: () => 20,
    },
    showResetProgress: {
        type: Boolean,
        default: () => false,
    },
    subscriptionCalendarId: {
        type: String,
        default: () => '',
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
    showProgressFilters: {
        type: Boolean,
        default: () => true,
    },
    multipleTypes: {
        type: Boolean,
        default: () => false,
    },
});

const collectionStore = useCollectionStore();
const userStore = useUserStore();

const { data, currentPage, filter, loading, totalPages, tabData, filterColumns, searching, tabOptions } = storeToRefs(collectionStore);
const { brand, journeySection } = storeToRefs(userStore);

//Collection type reactives

const isRecommendation = computed(() => {
    return props.collectionType === 'Recommendation';
})

const isArchives = computed(() => {
    return props.collectionType === 'recording';
})

const isBootCamps = computed(() => {
    return props.collectionType === 'boot-camps';
})

const isCoach = computed(() => {
    return props.collectionType === 'coach';
})

const isSong = computed(() => {
    return props.collectionType === 'song' || (isRecommendation.value && getActiveTab.value === 'Songs');
})

const isCourse = computed(() => {
    return props.collectionType === 'course';
})

const isSolos = computed(() => {
    return props.collectionType === 'solos';
});

const isSongTutorial = computed(() => {
    return props.collectionType === 'song-tutorial';
})

const isStudentFocus = computed(() => {
    return props.collectionType === 'student-focus';
})

const isStudentReview = computed(() => {
    return props.collectionType === 'student-review';
})

const isQuickTips = computed(() => {
    return props.collectionType === 'quick-tips';
})

const isRoutine = computed(() => {
    return props.collectionType === 'routine';
})

const isRudiment = computed(() => {
    return props.collectionType === 'rudiment';
})

const isWorkout = computed(() => {
    return props.collectionType === 'workout';
})

const isChallenge = computed(() => {
    return props.collectionType === 'challenge';
});

const isSongPdf = computed(() => {
    return props.collectionType === 'song-pdf';
})

const isPack = computed(() => {
    return props.collectionType === 'pack';
})

const isThreads = computed(() => {
    return props.collectionType === 'threads';
})

const isCoachShow = computed(() => {
    return props.collectionType === 'coach-show';
})

//List view reactive
const isList = computed(() => {
    return !isRecommendation.value && !isWorkout.value && !isChallenge.value && props.collectionType && !isCoachShow.value;
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

const isDownloadView = computed(() => {
    return isSongPdf.value;
})

//Filter state reactive
const hideFilter = computed(() => {
    return isRoutine.value;
})

//prop reactives
const activeTabData = computed(() => {
    return tabData.value[filter.value.activeTab];
})

const getSelectedFilters = computed(() => {
    return filter.value.included_fields;
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
            { value: '-popularity', name: 'Most Popular', icon: 'sort-popularity', },
            { value: 'slug', name: 'Name: A to Z', icon: 'sort-name-asc', },
            { value: '-slug', name: 'Name: Z to A', icon: 'sort-name-desc', },
        ]
        : props.sortOptions

})

const handleClearFilter = () => {
    collectionStore.clearFilter();
}

const handleFilterChange = (param) => {
    collectionStore.applyFilter(param);
}

const handleProgressChange = (value) => {
    collectionStore.setProgress(value);
}

const handleSearchChange = (value) => {
    collectionStore.setSearchTerm(value)
}

const handleSortChange = (item) => {
    collectionStore.sortData(item);
}

const handleTabChange = (tab) => {
    collectionStore.switchTab(tab);
}

onMounted(() => {
    // console.log('collection type',props.collectionType)
    // console.log(props.sortOptions, props.defaultSort)
    // console.log(props.preLoadedContent)


    if (isRecommendation.value && showGroupBy.value) {
        data.value.forEach(item => {
            const trackingPayload = {
                brand: brand.value,
                navigation_section: 'recommended',
                recommended_content: item.lessons.map((item, index) => ({
                    id: item.id,
                    position: index,
                })),
            }

            userJourney.trackRecommendedContentServed(trackingPayload);
        });
    } else if (isRecommendation.value) {
            const trackingPayload = {
                brand: brand.value,
                navigation_section: 'recommended',
                recommended_content: data.value.map((item, index) => ({
                    id: item.id,
                    position: index,
                })),
            }

            userJourney.trackRecommendedContentServed(trackingPayload);
    }
})
</script>
