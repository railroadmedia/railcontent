<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <template v-if="!isLoading">
            <!-- Breadcrumbs -->
            <Breadcrumb :breadcrumbs="[{ title: 'songs', url: `/${brand}/songs` },{ title: data.title }]"/>

            <div id="lessonInfo"
                class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] 2xl:tw-grid-rows-[370px_auto_auto] tw-w-full tw-mx-auto tw-mt-3 tw-flex-col tw-gap-4"
            >
                <!-- Song Player Section -->
                <div class="tw-col-span-3 tw-w-full 2xl:tw-col-span-2 tw-row-span-1">
                    <SongPlayerSection
                        :contentId="contentId"
                        :resources="data.resources"
                        :thumbnailUrl="data.thumbnail_url"
                        :songTitle= "data.title"
                        :songArtist= "data.artist"
                        :songAlbum= "data.album"
                        :songMeta= "data.style"
                        :relatedLessons= "relatedLessons"
                        :assignments= "data.soundslice"
                        :hasInstrumentless="data.instrumentless"
                        :lessonProgress= "data.lesson_progress"
                        :isLiked= "isLiked"
                        :isAdded= "isAdded"
                        :likeCount= "likeCount"
                        :report-logo="reportLogo"
                        :no-access="noAccess"
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
                        <div v-for="(item, i) in data.relatedLessons" :key="i"
                            class="tw-snap-center tw-flex tw-flex-col tw-group tw-w-full dark:tw-border-[#223F57] tw-inline">
                            <CatalogueListElement :item="item" :content-type="item.type" :show-my-list-action="true" />
                        </div>
                    </section>
                </div>

                <!-- Comments Section -->
                <div v-if="!noAccess" class="tw-col-span-3 2xl:tw-col-span-2 2xl:tw-row-span-2">
                    <Comments
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
        </template>
        <!-- Show Skeleton Loader -->
        <song-skeleton v-else></song-skeleton>
    </div>
</template>
<script setup>
    import { ref, onBeforeMount } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';
    import { usePlatformStore } from '@stores/platform';
    import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
    import SongPlayerSection from '@collections/SongPlayerSection/SongPlayerSection.vue';
    import Comments from '@vuesora/views/comments/Comments.vue'
    import CatalogueListElement from '@collections/Catalogue/CatalogueListElement';
    import SongSkeleton from '@pages/Song/SongSkeleton';
    import { useSongPageData } from '@hooks/pages/useSongPageData';

    // Pinia Data
    const userStore = useUserStore();
    const plaformStore = usePlatformStore();
    const { user, brand, userId, userDisplayName, userAccessLevel, userProfilePictureUrl, userXP, isAdmin, token } = storeToRefs(userStore);
    const { isLoading } = storeToRefs(plaformStore)

    // Refs 
    const data = ref(null);

    // Props
    const props = defineProps({
        contentId: Number,
        isLiked: Boolean,
        noAccess: Boolean,
        isAdded: Boolean,
        likeCount: [Number, String],
        reportLogo: String,
    });

    onBeforeMount( async () => {
        const { data: songData, error: songError, isLoading: songLoading } = await useSongPageData(props.contentId, brand.value, userId.value, token.value);
        data.value = songData.value;
        plaformStore.setLoadingState(songLoading.value);
        console.log(songLoading.value)
    });
</script>