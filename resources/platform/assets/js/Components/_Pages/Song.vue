<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <!-- Breadcrumbs -->
        <Breadcrumb :breadcrumbs="[{ title: 'songs', url: `/${brand}/songs` },{ title: songTitle }]"/>

        <div id="lessonInfo"
             class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] 2xl:tw-grid-rows-[370px_auto_auto] tw-w-full tw-mx-auto tw-mt-3 tw-flex-col tw-gap-4"
        >
            <!-- Song Player Section -->
            <div class="tw-col-span-3 tw-w-full 2xl:tw-col-span-2 tw-row-span-1">
                <SongPlayerSection
                    :is-loading="isLoading"
                    :contentId="contentId"
                    :resources="resources"
                    :thumbnailUrl="thumbnailUrl"
                    :songTitle= "songTitle"
                    :songArtist= "songArtist"
                    :songAlbum= "songAlbum"
                    :songMeta= "songMeta"
                    :relatedLessons= "relatedLessons"
                    :isLiked= "isLiked"
                    :isAdded= "isAdded"
                    :assignments= "assignments"
                    :hasInstrumentless= "hasInstrumentless"
                    :lessonProgress= "lessonProgress"
                    :likeCount= "likeCount"
                    :report-logo="reportLogo"
                />
            </div>
            <!-- Related Lessons -->
            <div class="tw-w-full tw-col-span-3 tw-flex tw-flex-col 2xl:tw-mt-0 2xl:tw-col-span-1 2xl:tw-row-span-3">
                <!-- Refactor as a colleciton component -->
                <div class="tw-mb-2">
                    <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                        Related Songs
                    </h6>
                </div>

                <section class="tw-flex tw-flex-col tw-flex-wrap">
                    <div v-for="(item, i) in relatedLessons.data" :key="i"
                         class="tw-snap-center tw-flex tw-flex-col tw-group tw-w-full dark:tw-border-[#223F57] tw-inline">
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
    import { ref, onBeforeMount} from 'vue';
    import { fetchSongById } from '../../Services/songService';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';
    import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
    import SongPlayerSection from '../_Collections/SongPlayerSection.vue'
    import Comments from '@vuesora/views/comments/Comments.vue'
    import CatalogueListElement from '@collections/Catalogue/CatalogueListElement';

    //Pinia Data
    const userStore = useUserStore();
    const { user, brand, userId, userDisplayName, userAccessLevel, userProfilePictureUrl, userXP, isAdmin } = storeToRefs(userStore);

    //Refs
    const isLoading = ref(false);
    const song = ref(null);

    //Props
    const props = defineProps({
        thumbnailUrl: String,
        songTitle: String,
        songArtist: String,
        songAlbum: String,
        songMeta: String,
        contentId: Number,
        isLiked: Boolean,
        hasInstrumentless: Boolean,
        isAdded: Boolean,
        lessonProgress: [Number, String],
        likeCount: [Number, String],
        assignments: Array,
        resources: Array,
        relatedLessons: Object,
        reportLogo: String,
    });

    onBeforeMount( ()=> {
        //FETCH SONG BY ID

        // const documentId = props.contentId;
        // const fields = [
        //     '_id',
        //     'title',
        //     'thumbnail_url',
        //     'style',
        //     'artist',
        //     'album',
        //     'lesson-progress',
        //     'like_count',
        //     'is_liked_by_current_user',
        //     'is_added_to_primary_playlist',
        //     'instrumentless',
        //     '"soundslice_slug": assignments[0]{soundsliceSlug}',
        //     'resources[]{resource_url, resource_name}',
        // ];
        // try {
        //     isLoading.value = true;
        //     song.value = fetchSongById(documentId, fields);
        // } catch (error) {
        //     console.error('Error fetching song:', error);
        // } finally {
        //     isLoading.value = false;
        // }
    })
</script>