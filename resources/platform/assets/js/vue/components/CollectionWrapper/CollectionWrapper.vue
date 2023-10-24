<template>
    <div>
        <CollectionFilterWrapper
            :active-tab="filter.activeTab" :filterable-values="filterableValues" :hide-filter="!showFilter" :pre-loaded-content="preLoadedContent" :selected-filters="tabData[filter.activeTab] && tabData[filter.activeTab].included_fields" :selected-sort="tabData[filter.activeTab] && tabData[filter.activeTab].sort" :search-term="tabData[filter.activeTab] && tabData[filter.activeTab].searchTerm" :tab-options="tabOptionData"
            @on-filter-change="handleFilterChange" @on-search-change="handleSearchChange" @on-sort-change="handleSortChange" @on-tab-change="handleTabChange"
        />

        <transition appear name="fade">
            <CollectionResults :current-page="filter.currentPage" :loading="loading" :total-pages="totalPages" @on-load-more="collectionStore.loadMore">
                <CoachesGridCatalogue v-if="isCoach" :content="data" :brand="brand" />
                <ListCatalogue v-else-if="isList" :content="data" :force-wide-thumbs="isStudentReview"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <RoutinesCatalogue v-else-if="isRoutine" :content="data"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <PlayAlongs v-else-if="isPlayAlong" :pre-loaded-content="data" ref="playAlongsVueInstance"
                    :total-results="totalResults" />
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

const isList = computed(() => {
    return !isPlayAlong.value && !isRoutine.value;
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

const showFilter = computed(() => {
    return isRudiment.value || isQuickTips.value || isStudentFocus.value || isSolos.value || isPlayAlong.value || isCourse.value || isBootCamps.value || isSongTutorial.value || isArchives.value || isCoach.value;
})

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
        };
    });

    return tabDataMap;
})

const handleFilterChange = (category, item) => {
    collectionStore.applyFilter(`${category},${item.value}`);
}

const handleSearchChange = (value) => {
    console.log('in wrapper', value)
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
        totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
        totalResults: props.preLoadedContent?.meta.totalResults || 0,
    })
})
</script>
