<template>
    <div>
        <CollectionFilterWrapper
            :active-tab="filter.activeTab" :filterable-values="filterableValues" :hide-filter="!showFilter" :pre-loaded-content="preLoadedContent" :selected-filters="getSelectedFilters" :selected-sort="getSelectedSort" :search-term="getSearchTerm" :tab-options="tabOptionData"
            @on-filter-change="handleFilterChange" @on-search-change="handleSearchChange" @on-sort-change="handleSortChange" @on-tab-change="handleTabChange"
        />

        <transition appear name="fade">
            <CollectionResults :current-page="getCurrentPage" :loading="loading" :total-pages="getTotalPages" @on-load-more="collectionStore.loadMore">
                <CoachesGridCatalogue v-if="isCoach" :content="data" :brand="brand" />
                <ListCatalogue v-else-if="isList" :content="data" :force-wide-thumbs="isStudentReview"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <RoutinesCatalogue v-else-if="isRoutine" :content="data"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <PlayAlongs v-else-if="isPlayAlong" :pre-loaded-content="data" ref="playAlongsVueInstance"
                    :total-results="getTotalResults" />
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
    includedFields: {
        type: Array,
        default: () => [],
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

//List view reactvie
const isList = computed(() => {
    return !isPlayAlong.value && !isRoutine.value;
})

//Filter state reactive
const showFilter = computed(() => {
    return isRudiment.value || isQuickTips.value || isStudentFocus.value || isSolos.value || isPlayAlong.value || isCourse.value || isBootCamps.value || isSongTutorial.value || isArchives.value || isCoach.value;
})

//Tab options reactives
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
    }

    return [
        { key: `all${props.title.replace(' ', '').toLowerCase()}`, value: `All ${props.title}` },
    ]
});

const tabOptionData = computed(() => {
    return props.tabOptions.length > 0 ? props.tabOptions : getTabOptions.value;
})

const getFirstTabOption = computed(() => {
    return tabOptionData.value[0]
})

const getTabData = computed(() => {
    const tabDataMap = {};

    tabOptionData.value.forEach(tab => {
        let endpoint = '/railcontent/content';
        if (isCoach.value) {
            endpoint = `/railcontent/content?only_subscribed=${tab.key === 'allCoaches' ? '' : 'true'}`;
        }
        tabDataMap[tab.key] = {
            endpoint,
            included_fields: props.included_fields || [],
            searchTerm: '',
            sort: isCoach.value ? 'slug' : '-published_on',
            currentPage: 1,
            totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
            totalResults: props.preLoadedContent?.meta.totalResults || 0,
        };
    });

    return tabDataMap;
})

//prop reactives
const activeTabData = computed(() => {
    return tabData.value[filter.value.activeTab];
})

const getSelectedFilters = computed(() => {
    return activeTabData.value && activeTabData.value.included_fields;
})

const getSelectedSort = computed(() => {
    return activeTabData.value && activeTabData.value.sort;
})

const getSearchTerm = computed(() => {
    return activeTabData.value && activeTabData.value.searchTerm;
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

const handleFilterChange = (category, item) => {
    collectionStore.applyFilter(`${category},${item.value}`);
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
    console.log(props.collectionType)
    console.log(props.title)

    collectionStore.setDefaults({
        data: props.preLoadedContent?.data || [],
        filter: {
            activeTab: getFirstTabOption.value.key,
            params: { ...request_params.value },
            [isCoach.value ? 'term' : 'title']: '',
        },
        tabData: getTabData.value,
    })
})
</script>
