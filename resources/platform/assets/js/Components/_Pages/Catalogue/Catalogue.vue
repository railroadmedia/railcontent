<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
      <Breadcrumb :breadcrumbs="breadcrumbData" />
      <PageHeader
        :is-loading="isLoading"
        :page-type="headerData?.type"
        :icon-name="headerData?.iconName"
        :title="headerData?.title"
        :description="headerData?.description"
        :hero-img="headerData?.heroImg"
        :progress="headerData?.progress"
        :content-id="headerData?.contentId"
        :info-data="headerData?.infoData"
        :ctas="headerData?.ctas && headerData?.ctas.length ? headerData?.ctas : null"
      />

      <!-- Continue section -->
      <div v-if="!isLoading && continueSection.length" class="tw-mt-[30px]">
          <MiniCatalogueSection
              title="Continue"
              seeAllAriaLabel="See All Lessons in Progress"
              :seeAllUrl="`/${brand}/lesson-history/in-progress?sort=-published_on&included_fields%5B%5D=type%2CSong&tabs%5B%5D=inProgress&included_user_states%5B%5D=started`"
              :preLoadedContent="continueSection"
              :isMiniView="true"
              :show-dropdown="true"
              trackingSection="continue"
          />
      </div>

      <div class="tw-mt-[30px]">
        <PlayAlongs
          v-if="metaData?.name === 'Play Alongs' && brand === 'drumeo'"
          ref="playAlongsVueInstance"
          content-endpoint="/railcontent/content"
          :theme-color="brand"
          :brand="brand"
          :session-token="sessionToken"
        />
        <CollectionWrapper
          v-else
          v-bind="recommendedProps"
          :collection-type="lessonType"
          :title="metaData?.shortname || metaData?.name"
          :hide-filter-icon="true"
          :hide-controls="lessonType === 'Recommendation'"
          :tab-options="tabData"
        />
      </div>
    </div>
  </template>

  <script setup>
  import { computed, onBeforeMount, ref } from 'vue';
  import { getHeaderData } from './headerData';
  import { getTabData } from './tabData';
  import { usePlatformStore } from "@stores/platform";
  import { storeToRefs } from "pinia/dist/pinia";
  import { useCollectionStore } from "@stores/collection";
  import { useUserStore } from "@stores/user";
  import { queryTypeConverter} from "@pages/Catalogue/queryTypeConverter";

  import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
  import PageHeader from '@collections/PageHeader/PageHeader.vue';
  import PlayAlongs from '@vuesora/views/play-alongs/PlayAlongs.vue';
  import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper.vue';
  import { fetchMetadata, fetchContentInProgress, fetchByRailContentIds } from 'musora-content-services';
  import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';

  const props = defineProps({
    askQuestionRecipient: String,
    breadcrumbs: Array,
    catalogueType: String,
    emailLogoLink: String,
    isNewReleases: Boolean,
    lessonType: String,
    sessionToken: String,
    showInProgress: Boolean,
  });

  const collectionStore = useCollectionStore();
  const platformStore = usePlatformStore();
  const userStore = useUserStore();
  const { isLoading } = storeToRefs(platformStore);
  const { brand } = storeToRefs(userStore);

  const onLoadData = ref([]);
  const continueSection = ref([]);
  const metaData = ref(null);
  const headerData = ref(null);
  const contentType = ref('');
  const breadcrumbData = ref(null);

  const recommendedProps = computed(() => {
    const recommended = {};
    if (contentType.value === 'Recommendation') {
      recommended.endpoint = '/railcontent/recommended';
      recommended.noResultsMessage = 'Start your learning journey to help us select the appropriate videos for you.';
    }
    return recommended;
  });

  const recommendationLinks = {
    drumeo: 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083',
    pianote: 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612',
    guitareo: 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772',
    singeo: 'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436',
  };

  const tabData = computed(() => {
      return getTabData(props.catalogueType, metaData.value?.shortname || metaData.value?.name);
  })

  onBeforeMount(async() => {
    //Account for 'New Releases' Catalog
    if(props.isNewReleases) {
      contentType.value = 'new-release';
      breadcrumbData.value = [
        { title: "New Releases" }
      ]
    } else {
      contentType.value = props.lessonType;
      breadcrumbData.value = props.breadcrumbs;
    }

    try {
      // Fetch started content (in-progress workouts)
      fetchMetadata(brand.value, queryTypeConverter(props.lessonType)).then( result => {
        metaData.value = result;
      }).catch( error => {
        console.log('error fetching catalog metaData', error)
      });

      const startedIds = await fetchContentInProgress(contentType.value, brand.value, { limit: 20 });
      const lessons = await fetchByRailContentIds(startedIds.started);

      headerData.value = getHeaderData(metaData.value, brand.value, props.askQuestionRecipient, props.emailLogoLink, contentType.value)

      // Set the continue section with started workouts
      continueSection.value = lessons;

      // Set default collection store values
      collectionStore.setDefaults({
        tabOptions: tabData.value,
        queryType: queryTypeConverter(props.lessonType),
        ...(props.lessonType === 'play-along' && brand.value === 'drumeo' && { noFetchOnLoad: true }),
        ...(props.lessonType === 'Recommendation' ? { fetchType: 'recommendation' } : props.isNewReleases && { fetchType: 'new-release' }),
      });
    } catch (error) {
        console.error('Error fetching continue section data:', error);
    }
  })
  </script>
