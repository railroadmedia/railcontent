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


      <!-- Continue section -->
      <div v-if="continueSection.length" class="tw-mt-[30px]">
          <MiniCatalogueSection
              title="Continue"
              seeAllAriaLabel="See All Lessons in Progress"
              :seeAllUrl="`/${brand}/lesson-history/in-progress?sort=-published_on&included_fields%5B%5D=type%2CSong&tabs%5B%5D=inProgress&included_user_states%5B%5D=started`"
              :preLoadedContent="startedLessons"
              :isMiniView="true"
              :show-dropdown="true"
              trackingSection="continue"
          />
      </div>

      <div class="tw-mt-[30px]">
        <PlayAlongs
          v-if="catalogueMeta.name === 'Play Alongs' && brand === 'drumeo'"
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
          :title="catalogueMeta.shortname || catalogueMeta.name"
          :hide-filter-icon="lessonType === 'routine'"
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
  import { fetchContentInProgress, fetchByRailContentIds } from 'musora-content-services';
  import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';

  const props = defineProps({
    hasStartedLessons: Boolean,
    lessonType: String,
    catalogueMeta: Object,
    startedLessons: Array,
    breadcrumbs: Array,
    sessionToken: String,
    askQuestionRecipient: String,
    emailLogoLink: String,
    showInProgress: Boolean,
    catalogueType: String,
  });

  const collectionStore = useCollectionStore();
  const platformStore = usePlatformStore();
  const userStore = useUserStore();
  const { isLoading } = storeToRefs(platformStore);
  const { brand } = storeToRefs(userStore);

  const onLoadData = ref([]);
  const continueSection = ref([]);

  const recommendedProps = computed(() => {
    const recommended = {};
    if (props.lessonType === 'Recommendation') {
      recommended.endpoint = '/railcontent/recommended';
      recommended.noResultsMessage = 'Start your learning journey to help us select the appropriate videos for you.';
    }
    return recommended;
  });

  const headerData = computed(() => {
    return getHeaderData(props.catalogueMeta, brand.value, props.askQuestionRecipient, props.emailLogoLink, props.lessonType);
  });

  const recommendationLinks = {
    drumeo: 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083',
    pianote: 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612',
    guitareo: 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772',
    singeo: 'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436',
  };

  const tabData = computed(() => {
      return getTabData(props.catalogueType, props.catalogueMeta.shortname || props.catalogueMeta.name);
  })

  onBeforeMount(async() => {
    console.log(props.lessonType)

    try {
      // Fetch started content (in-progress workouts)
      const startedIds = await fetchContentInProgress(props.lessonType, brand.value, { limit: 20 });
      const lessons = await fetchByRailContentIds(startedIds.started);
      const startedLessons = lessons.filter(lesson => startedIds.started.includes(lesson.id));

      // Set the continue section with started workouts
      continueSection.value = startedLessons;

      // Set default collection store values
      collectionStore.setDefaults({
        tabOptions: tabData.value,
        filter: {
            sort: '-published_on'
        },
        queryType: queryTypeConverter(props.lessonType),
        ...(props.lessonType === 'play-along' && brand.value === 'drumeo' && { noFetchOnLoad: true })
      });
    } catch (error) {
        console.error('Error fetching continue section data:', error);
    }
  })
  </script>
