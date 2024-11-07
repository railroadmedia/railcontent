<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
      <Breadcrumb :breadcrumbs="breadcrumbs" />
      <PageHeader
        :page-type="headerData.type"
        :icon-name="headerData.iconName"
        :title="headerData.title"
        :description="headerData.description"
        :hero-img="headerData.heroImg"
        :progress="headerData.progress"
        :content-id="headerData.contentId"
        :info-data="headerData.infoData"
        :ctas="headerData.ctas && headerData.ctas.length ? headerData.ctas : null"
      />

      <div v-if="showInProgress" class="tw-mt-[30px]">
          <MiniCatalogueSection
              title="Continue"
              seeAllAriaLabel="See All Lessons in Progress"
              :seeAllUrl="`/${brand}/lesson-history/in-progress`"
              :preLoadedContent="startedLessons"
              :isMiniView="true"
          />
      </div>

      <div class="tw-mt-[30px]">
        <PlayAlongs
          v-if="catalogueMeta.name === 'Play Alongs' && brand === 'drumeo'"
          ref="playAlongsVueInstance"
          content-endpoint="/railcontent/content"
          :theme-color="brand"
          :brand="brand"
          :pre-loaded-content="listLessons"
          :session-token="sessionToken"
          @play="handlePlayAlongsPlay"
          @pause="handlePlayAlongsPause"
        />
        <CollectionWrapper
          v-else
          v-bind="recommendedProps"
          :brand="brand"
          :collection-type="lessonType"
          :filterable-values="catalogueMeta.allowableFilters"
          :include-future-scheduled-content-only="includeFutureScheduledContentOnly"
          :included-types="includedTypes"
          :pre-loaded-content="listLessons"
          :statuses="statuses"
          :title="catalogueMeta.shortname || catalogueMeta.name"
          :tabs="catalogueMeta.tabs || []"
          :multiple-types="isAllContent"
          :is-all-content="isAllContent"
          :hide-filter-icon="lessonType === 'routine'"
          :hide-controls="lessonType === 'Recommendation'"
        />
      </div>
    </div>
  </template>

  <script setup>
  import { computed } from 'vue';
  import { getHeaderData } from './headerData';

  import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
  import PageHeader from '@collections/PageHeader/PageHeader.vue';
  import CatalogueCardContainer from '@collections/Catalogue/CatalogueCardContainer.vue';
  import PlayAlongs from '@vuesora/views/play-alongs/PlayAlongs.vue';
  import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper.vue';
  import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';

  const props = defineProps({
    hasStartedLessons: Boolean,
    lessonType: String,
    brand: String,
    catalogueMeta: Object,
    startedLessons: Array,
    breadcrumbs: Array,
    listLessons: Object,
    sessionToken: String,
    askQuestionRecipient: String,
    emailLogoLink: String,
    includeFutureScheduledContentOnly: Boolean,
    statuses: Array,
    isAllContent: Boolean,
    includedTypes: Array,
    showInProgress: Boolean,
  });

  const recommendedProps = computed(() => {
    const recommended = {};
    if (props.lessonType === 'Recommendation') {
      recommended.endpoint = '/railcontent/recommended';
      recommended.noResultsMessage = 'Start your learning journey to help us select the appropriate videos for you.';
    }
    return recommended;
  });

  const headerData = computed(() => {
    return getHeaderData(props.catalogueMeta, props.brand, props.askQuestionRecipient, props.emailLogoLink, props.lessonType);
  });

  const recommendationLinks = {
    drumeo: 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083',
    pianote: 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612',
    guitareo: 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772',
    singeo: 'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436',
  };
  </script>
