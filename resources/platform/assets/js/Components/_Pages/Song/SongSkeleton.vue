<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <!-- Breadcrumbs -->
        <Breadcrumb :is-loading="true"/>

        <div id="lessonInfo"
             class="tw-grid tw-grid-cols-3 2xl:tw-grid-cols-[auto_auto_420px] 2xl:tw-grid-rows-[370px_auto_auto] tw-w-full tw-mx-auto tw-mt-3 tw-flex-col tw-gap-4"
        >
            <!-- Song Player Section -->
            <div class="tw-col-span-3 tw-w-full 2xl:tw-col-span-2 tw-row-span-1">
                <SongPlayerSection :is-loading="true" />
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
                    <div v-for="i in 7" :key="i"
                         class="tw-snap-center tw-flex tw-flex-col tw-group tw-w-full dark:tw-border-[#223F57]">
                        <SongCardSkeleton :is-loading="true" />
                    </div>
                </section>
            </div>

            <!-- Comments Section -->
            <CommentSkeleton />

        </div>
    </div>
</template>
<script setup>
    import SongPlayerSection from '@collections/SongPlayerSection/SongPlayerSection.vue';
    import SongCardSkeleton from '@collections/Cards/List/SongCard/SongCardSkeleton';
    import CommentSkeleton from '@collections/SkeletonLoader/CommentSkeleton.vue'

    const props = defineProps({
        isLoading: Boolean,
    })
</script>
