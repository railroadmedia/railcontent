<template>
    <div>
        <CollectionFilterWrapper
            :showBackButton="showBackButton" :parentUrl="parentUrl" :active-tab="filter.activeTab" :filterable-values="filterableValues" :hide-filter="hideFilter" :loading="loading" :pre-loaded-content="preLoadedContent" :selected-filters="getSelectedFilters" :selected-sort="getSelectedSort" :search-term="getSearchTerm" :tab-options="tabOptionData"
            @on-clear-filter="handleClearFilter" @on-filter-change="handleFilterChange" @on-search-change="handleSearchChange" @on-sort-change="handleSortChange" @on-tab-change="handleTabChange"
        />

        <transition appear name="fade">
            <CollectionResults :current-page="getCurrentPage" :loading="loading" :total-pages="getTotalPages" @on-load-more="collectionStore.loadMore">
                <template v-if="showGroupBy">
                    <GroupedResultsContainer v-for="(data, i) in preLoadedContent.data" :key="i" :pre-loaded-content="preLoadedContent.data.slice(0,5)" />
                </template>
                <CoachesGridCatalogue v-else-if="isCoach" :content="data" :brand="brand" />
                <ListCatalogue v-else-if="isList" :content="data" :force-wide-thumbs="isStudentReview"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <RoutinesCatalogue v-else-if="isRoutine" :content="data"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <PlayAlongs v-else-if="isPlayAlong" :pre-loaded-content="data" ref="playAlongsVueInstance"
                    :total-results="getTotalResults" />
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
import { useCollectionStore } from "../../../stores/collection";
import CoachesGridCatalogue from "../../vuesora/views/catalogues/CoachesGridCatalogue";
import CollectionFilterWrapper from '../Filter/CollectionFilterWrapper.vue';
import CollectionResults from '../Catalogue/CollectionResults.vue';
import ListCatalogue from "../../vuesora/views/catalogues/ListCatalogue";
import UserCatalogueEvents from "../../vuesora/mixins/UserCatalogueEvents";
import RoutinesCatalogue from "../../vuesora/views/catalogues/RoutinesCatalogue";
import PlayAlongs from "../../vuesora/views/play-alongs/PlayAlongs";
import {storeToRefs} from "pinia";
import { useUserStore } from "../../../stores/user";
import CatalogueCardContainer from "../Catalogue/CatalogueCardContainer";
import GroupedResultsContainer from "../GroupedResultsContainer/GroupedResultsContainer";

const props = defineProps({
    collectionType: {
        default: '',
    },
    filterableValues: {
        type: Array,
        default: () => [],
    },
    includeFutureScheduledContentOnly: {
        type: Boolean,
        default: () => false,
    },
    showBackButton: {
        type: Boolean,
        default: () => false,
    }, 
    parentUrl: {
        type: String,
        default: () => "/",
    },
    limit: {
        type: String,
        default: () => "10",
    },
    preLoadedContent: {
        type: Object,
        default: () => ({}),
    },
    requiredFields: {
        type: Array,
        default: () => [],
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
});

const collectionStore = useCollectionStore();
const userStore = useUserStore();

const { data, currentPage, filter, loading, totalPages, tabData } = storeToRefs(collectionStore);
const { brand } = storeToRefs(userStore);

const request_params = computed(() => {
    return {
        required_fields: props.requiredFields,
        included_fields: props.includedFields,
        statuses: props.statuses,
        required_user_states: props.requiredUserStates,
        included_types: includedTypes.value,
        include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
        limit: props.limit,
    };
})

const includedTypes = computed(() => {
    let types = [];

    if (isCoach.value) {
        types.push('instructor');
    } else {
        types.push(props.collectionType);

        if (isQuickTips.value) {
            types.push('boot-camps');
        }
    }

    return types;
})

//Collection type reactives
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
    return props.collectionType === 'song';
})

const isCourse = computed(() => {
    return props.collectionType === 'course';
})

const isPlayAlong = computed(() => {
    return props.collectionType === 'play-along';
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

//List view reactive
const isList = computed(() => {
    return !isPlayAlong.value && !isRoutine.value && !isWorkout.value && !isChallenge.value;
})

const showGroupBy = computed(() => {
    return tabData.value[filter.value.activeTab]?.groupByView;
})

//Filter state reactive
const hideFilter = computed(() => {
    return isRoutine.value || isStudentReview.value;
})

//Tab options reactive
const getTabOptions = computed(() => {
    if (isCourse.value) {
        return [
            { key: 'courses', value: 'Courses' },
            { key: 'instructors', value: 'Instructors' },
            { key: 'genres', value: 'Genres' },
        ];
    } else if (isQuickTips.value || isStudentFocus.value) {
        return [
            { key: 'lessons', value: 'Lessons' },
            { key: 'instructors', value: 'Instructors' },
            { key: 'genres', value: 'Genres' },
        ];
    } else if (isRudiment.value) {
        return [
            { key: 'all', value: 'All' },
            { key: 'drags', value: 'Drags' },
            { key: 'flams', value: 'Flams' },
            { key: 'paradiddles', value: 'Paradiddles' },
            { key: 'rolls', value: 'Rolls' },
        ];
    } else if (isWorkout.value) {
        return [
            { key: 'all', value: 'All', },
            { key: 'duration,300,<', value: '5 Minutes', },
            { key: 'duration,600,<', value: '10 Minutes', },
            { key: 'duration,900,>', value: '15+ Minutes', },
            { key: 'group_by,instructor', value: 'Instructors', groupByView: true, },
        ];
    }

    return [
        { key: `all${props.title.replace(' ', '').toLowerCase()}`, value: `All ${props.title}` },
    ]
});

const tabOptionData = computed(() => {
    return props.tabOptions.length > 0 ? props.tabOptions : getTabOptions.value;
})

const getFirstTabOption = computed(() => {
    return tabOptionData.value[0];
})

const getFirstTabData = computed(() => {
    return {
        [getFirstTabOption.value.key]: {
            currentPage: 1,
            totalPages: Object.keys(props.preLoadedContent).length > 0 ? Math.ceil(props.preLoadedContent?.meta?.totalResults / props.limit) : 0,
            totalResults: Object.keys(props.preLoadedContent).length > 0 ? props.preLoadedContent?.meta?.totalResults : 0,
        }
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

const getTotalResults = computed(() => {
    return activeTabData.value && activeTabData.value.totalResults;
})

const handleClearFilter = () => {
    collectionStore.clearFilter();
}

const handleFilterChange = (param) => {
    collectionStore.applyFilter(param);
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
    // console.log(props.collectionType)
    // console.log(props.title)
    console.log(props.preLoadedContent)
    collectionStore.setDefaults({
        isCoach: isCoach.value,
        data: props.preLoadedContent?.data || [],
        filter: {
            activeTab: getFirstTabOption.value.key,
            params: { ...request_params.value },
            [isCoach.value ? 'term' : 'title']: '',
        },
        tabData: getFirstTabData.value,
    })

    collectionStore.getURLParams();
})
</script>
