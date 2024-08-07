<template>
    <!-- Playlist Mini Catalog -->
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <div class="tw-w-[294px] tw-h-[24px] tw-rounded-full tw-bg-ui-skeleton"></div>
                </div>
                <div class="tw-flex tw-items-center">
                    <div class="tw-w-[44px] tw-h-[17px] tw-rounded-full tw-bg-ui-skeleton"></div>
                </div>
            </div>
            <!-- Cards -->
            <div class="tw-w-full tw-gap-[6px] tw-relative tw-grid tw-auto-rows-min tw-grid-flow-row tw-auto-cols-min lg:tw-auto-cols-auto tw-grid-cols-6 lg:tw-grid-cols-5 2xl:tw-grid-cols-6 xl:tw-gap-[12px] 2xl:tw-gap-[16px] tw-min-w-max lg:tw-min-w-full tw-pt-4 tw--mt-4 tw-overflow-x-auto lg:tw-overflow-x-visible">
                <playlist-card-skeleton  v-for="n in 12" :key="n"></playlist-card-skeleton>
            </div>
        </div>
    </section>    
</template>
<script setup>
    import PlaylistCardSkeleton from "@collections/Cards/Grid/PlaylistCard/PlaylistCardSkeleton.vue";
</script>