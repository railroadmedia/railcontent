<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
      <!-- Breadcrumbs -->
      <Breadcrumb :breadcrumbs="[{ title: 'songs', url: `/${brand}/songs` }, { title: song?.title }]"/>
  
      <div id="lessonInfo"
           class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] 2xl:tw-grid-rows-[370px_auto_auto] tw-w-full tw-mx-auto tw-mt-3 tw-flex-col tw-gap-4"
      >
        <!-- Song Player Section -->
        <div class="tw-col-span-3 tw-w-full 2xl:tw-col-span-2 tw-row-span-1">
          <SongPlayerSection
            :is-loading="isLoading"
            :content-id="contentId"
            :resources="song?.resource"
            :thumbnail-url="thumbnailUrl"
            :song-title="song?.title"
            :song-artist="song?.artist_name"
            :song-album="song?.album"
            :song-meta="songMeta"
            :related-lessons="relatedLessons"
            :assignments="assignments"
            :has-instrumentless="song?.instrumentless"
            :lesson-progress="lessonProgress"
            :is-liked="isLiked"
            :is-added="isAdded"
            :like-count="likeCount"
            :report-logo="reportLogo"
          />
        </div>
        <!-- Related Lessons -->
        <div class="tw-w-full tw-col-span-3 tw-flex tw-flex-col 2xl:tw-mt-0 2xl:tw-col-span-1 2xl:tw-row-span-3">
          <!-- Refactor as a collection component -->
          <div class="tw-mb-2">
            <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
              Related Songs
            </h6>
          </div>
  
          <section class="tw-flex tw-flex-col tw-flex-wrap">
            <div v-for="(item, i) in relatedLessons.data" :key="i"
                 class="tw-snap-center tw-flex-col tw-group tw-w-full dark:tw-border-[#223F57] tw-inline-flex">
              <CatalogueListElement :item="item" :content-type="item.type" :show-my-list-action="true" />
            </div>
          </section>
        </div>
  
        <!-- Comments Section -->
        <div class="tw-col-span-3 2xl:tw-col-span-2 2xl:tw-row-span-2">
          <Comments
            :is-loading="isLoading"
            :brand="brand"
            :theme-color="brand"
            :content-id="contentId"
            :user-id="userId"
            :user-name="userDisplayName"
            :user-avatar="userProfilePictureUrl"
            :user-xp="userXP"
            :user-access-level="userAccessLevel"
            :is-admin="isAdmin"
          />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onBeforeMount, computed } from 'vue';
  import { fetchSongById } from '../../services/songService';
  import { storeToRefs } from 'pinia';
  import { useUserStore } from '../../stores/user';
  import Breadcrumb from '../components/Breadcrumb/Breadcrumb.vue';
  import SongPlayerSection from '../components/_Collections/SongPlayerSection.vue';
  import Comments from '../vuesora/views/comments/Comments.vue';
  import CatalogueListElement from '../components/Catalogue/CatalogueListElement.vue';
  
  // Pinia Data
  const userStore = useUserStore();
  const { user, brand, userId, userDisplayName, userAccessLevel, userProfilePictureUrl, userXP, isAdmin } = storeToRefs(userStore);
  
  // Refs
  const isLoading = ref(false);
  const song = ref(null);
  
  // Props
  const props = defineProps({
    thumbnailUrl: String,
    songMeta: String,
    contentId: Number,
    isLiked: Boolean,
    isAdded: Boolean,
    lessonProgress: [Number, String],
    likeCount: [Number, String],
    assignments: Array,
    relatedLessons: Object,
    reportLogo: String,
  });
  
  onBeforeMount(async () => {
    const documentId = props.contentId;
    const fields = [
      '_id',
      'title',
      'thumbnail',
      'genre',
      '"artist_name":artist->name',
      'album',
      'instrumentless',
      'soundslice',
      'resource',
    ];
    try {
      isLoading.value = true;
      const fetchedSong = await fetchSongById(documentId, fields);
      if (fetchedSong) {
        song.value = fetchedSong;
        console.log(song.value)
      } else {
        console.error('No song found');
      }
    } catch (error) {
      console.error('Error fetching song:', error);
    } finally {
      isLoading.value = false;
    }
  });
  </script>
  