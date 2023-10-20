<template>
    <div>
        <CollectionFilterWrapper v-if="showFilter" :filterable-values="filterableValues" :tab-options="tabOptionData"
            :pre-loaded-content="preLoadedContent" />

        <transition appear name="fade">
            <CollectionResults>
                <CoachesGridCatalogue v-if="isCoach" :content="collectionStore.data" :brand="collectionStore.brand" />
                <ListCatalogue v-else-if="isList" :content="collectionStore.data"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <RoutinesCatalogue v-else-if="isRoutine" :content="collectionStore.data"
                    @addToList="UserCatalogueEvents.methods.addToListEventHandler" />
                <PlayAlongs v-else-if="isPlayAlong" :pre-loaded-content="collectionStore.data" ref="playAlongsVueInstance"
                    :total-results="collectionStore.totalResults" />
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

const props = defineProps({
    brand: {
        type: String,
        default: '',
    },
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
});

const collectionStore = useCollectionStore();

const request_params = computed(() => {
    return {
        required_fields: props.requiredFields,
        statuses: props.statuses,
        required_user_states: props.requiredUserStates,
        included_types: includedTypes.value,
        include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
        included_fields: props.included_fields || [],
        limit: props.limit,
    };
})

const includedTypes = computed(() => {
    let types = [props.collectionType];

    if (isQuickTips.value) {
        types.push('boot-camps');
    }

    return types;
})

const isList = computed(() => {
    return isCourse.value || isQuickTips.value || isStudentFocus.value || isQAndA.value || isRudiment.value;
})

const isCoach = computed(() => {
    return props.collectionType === 'coach';
})

const isCourse = computed(() => {
    return props.collectionType === 'course';
})

const isStudentFocus = computed(() => {
    return props.collectionType === 'student-focus';
})

const isPlayAlong = computed(() => {
    return props.collectionType === 'play-along';
})

const isQAndA = computed(() => {
    return props.collectionType === 'question-and-answer';
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
    return !isRoutine.value;
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
    } else if (isQAndA.value) {
        return [
            { key: 'allLessons', value: 'All Lessons' },
        ];
    } else if (isRoutine.value) {
        return [
            { key: 'routines', value: 'Routines' },
        ];
    } else if (isRudiment.value) {
        return [
            { key: 'all', value: 'All' },
            { key: 'drags', value: 'Drags' },
            { key: 'flams', value: 'Flams' },
            { key: 'paradiddles', value: 'Paradiddles' },
            { key: 'rolls', value: 'Rolls' },
        ];
    } else if (isPlayAlong.value) {
        return [
            { key: 'allPlayAlongs', value: 'All Play-Alongs' },
        ];
    }
    return [
        { key: 'lessons', value: 'Lessons' },
    ]
});


const tabOptionData = computed(() => {
    return props.tabOptions.length > 0 ? props.tabOptions : getTabOptions.value;
})

const getFirstTabOption = computed(() => {
    return tabOptionData.value[0]
})

const tabData = computed(() => {
    const tabDataMap = {};

    tabOptionData.value.forEach(tab => {
        let endpoint = '/railcontent/content';
        if (isCoach.value) {
            endpoint = `/railcontent/content?only_subscribed=${tab.key === 'allCoaches' ? '' : 'true'}`;
        }
        tabDataMap[tab.key] = {
            endpoint,
            searchTerm: '',
            sort: isCoach.value ? 'slug' : '-published_on',
        };
    });

    return tabDataMap;
})

onMounted(() => {
    collectionStore.setDefaults({
        brand: props.brand,
        data: props.preLoadedContent?.data || [],
        filter: {
            activeTab: getFirstTabOption.value.key,
            params: { ...request_params.value },
            [isCoach.value ? 'term' : 'title']: '',
        },
        tabData: tabData.value,
        totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
        totalResults: props.preLoadedContent?.meta.totalResults || 0,
    })
})
</script>
