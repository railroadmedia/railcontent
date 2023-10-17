<template>
  <div>
      <CollectionFilterWrapper
            :filterable-values="filterableValues"
            :tab-options="tabOptions.length > 0 ? tabOptions : getTabOptions"
            :pre-loaded-content="preLoadedContent"
      />

      <transition appear name="fade">
          <CollectionResults>
              <CoachesGridCatalogue
                    v-if="isCoach"
                    :content="collectionStore.data"
                    :brand="collectionStore.brand"
              />
              <ListCatalogue
                    v-else-if="isList"
                    :content="collectionStore.data"
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
      includedTypes: {
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
          included_types: props.includedTypes,
          include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
          included_fields: props.included_fields || [],
          limit: props.limit,
      };
  })

  const isCoach = computed(() => {
      return props.collectionType === 'coach';
  })

  const isCourse = computed(()=> {
      return props.collectionType === 'course';
  })

  const isList = computed(()=> {
      return isCourse.value;
  })

  const getTabOptions = computed(() => {
    if(isCourse.value){
        return [
            {
                key: 'courses',
                value: 'Courses',
            },
            {
                key: 'instructors',
                value: 'Instructors',
            },
            {
                key: 'genres',
                value: 'Genres',
            },
        ];
    }
  })

  const tabData = computed(()=>{
    const tabDataMap = {}

    if(props.tabOptions.length > 0){
        props.tabOptions.forEach(tab => {
            let endpoint = '/railcontent/content';
            if (isCoach.value){
                endpoint = `/railcontent/content?only_subscribed=${tab.key === 'allCoaches' ? '' : 'true'}`;
            }
            tabDataMap[tab.key] = {
                endpoint,
                searchTerm: '',
                sort: isCoach.value ? 'slug' : '-published_on',
            }
        });
    } else {
        getTabOptions.value && getTabOptions.value.forEach(tab => {
            tabDataMap[tab.key] = {
                endpoint: '/railcontent/content',
                searchTerm: '',
                sort: isCoach.value ? 'slug' : '-published_on',
            }
        });
    }

    return tabDataMap;
  })

  onMounted(()=>{
      collectionStore.setDefaults({
          brand: props.brand,
          data: props.preLoadedContent?.data || [],
          filter: {
              activeTab: props.tabOptions.length > 0 ? props.tabOptions[0].key : getTabOptions.value[0].key,
              params: {...request_params.value},
              [isCoach.value ? 'term' : 'title']: '',
          },
          tabData: tabData.value,
          totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
      })
  })
</script>
