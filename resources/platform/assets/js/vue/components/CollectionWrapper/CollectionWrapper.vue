<template>
  <div>
      <CollectionFilterWrapper
        :filterable-values="filterableValues"
        :tab-options="tabOptions"
        :collection-title="collectionTitle"
        :pre-loaded-content="preLoadedContent"
      />

      <transition appear name="fade">
        <CollectionResults />
      </transition>
  </div>
</template>

<script setup>
  import { onMounted } from "vue";
  import CollectionFilterWrapper from '../Filter/CollectionFilterWrapper.vue';
  import CollectionResults from '../Catalogue/CollectionResults.vue';
  import { useCollectionStore } from "../../../stores/collection";

  const props = defineProps({
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
          default: [],
      },
      collectionTitle: {
          type: String,
          default: '',
      },
  });

  const collectionStore = useCollectionStore();

  const request_params = () => {
      return {
          required_fields: props.requiredFields,
          statuses: props.statuses,
          required_user_states: props.requiredUserStates,
          included_types: props.includedTypes,
          include_future_scheduled_content_only: props.includeFutureScheduledContentOnly,
          included_fields: props.included_fields || [],
          limit: props.limit,
      };
  }

  onMounted(()=>{
      collectionStore.setDefaults({
          brand: props.brand,
          data: props.preLoadedContent?.data || [],
          filter: {
              activeTab: props.tabOptions ? props.tabOptions[0].value : 'default',
              params: {...request_params()},
              term: '',
          },
          tabData: {
              allCoaches: {
                  endpoint: '/railcontent/content?only_subscribed=',
                  searchTerm: '',
                  sort: 'slug',
              },
              subscribedCoaches: {
                  endpoint: '/railcontent/content?only_subscribed=true',
                  searchTerm: '',
                  sort: 'slug',
              },
          },
          totalPages: props.preLoadedContent ? Math.ceil(props.preLoadedContent.meta.totalResults / props.limit) : 0,
      })

      collectionStore.getParams();
  })
</script>
