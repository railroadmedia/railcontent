<template>
  <MiniCatalogueSection v-if="activeRecommendedContent?.length" title="For You" seeAllAriaLabel="See All Content"
    :seeAllUrl="recommendedContentUrl" :preLoadedContent="activeRecommendedContent" trackingSection="recommended">
    <template v-if="tabsData.length > 0" #tabs="{ resetPagination }">
      <div class="tw-pb-[15px]">
        <FilterTabs :active-tab="activeTab.value" :tab-options="tabsData"
          @onTabClick="(tab) => handleTabClick(tab, resetPagination)" />
      </div>
    </template>
  </MiniCatalogueSection>
</template>

<script setup>
import { ref, computed } from 'vue';
import FilterTabs from '@collections/Filter/FilterTabs.vue';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';

const props = defineProps({
  recommendedContent: { type: Object, default: () => ({}) },
  recommendedContentUrl: { type: String, default: '', required: true },
});

const activeTab = ref({ key: 'all', value: 'All' });

const tabsData = computed(() => {
  return [
    { value: 'All', key: 'all' },
    ...props.recommendedContent.tabs,
  ];
});

const activeRecommendedContent = computed(() => {
  return props.recommendedContent?.data[activeTab.value.key] || [];
});

const handleTabClick = (tab, resetPagination) => {
  resetPagination();
  activeTab.value = tab;
}
</script>