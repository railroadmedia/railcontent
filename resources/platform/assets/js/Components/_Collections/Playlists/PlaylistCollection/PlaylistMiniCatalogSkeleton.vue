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
            <div class="tw-overflow-hidden">
                <div class="tw-w-full tw-relative tw-flex tw-flex-nowrap tw-pt-4 tw-overflow-x-auto lg:tw-overflow-x-visible">
                    <playlist-card-skeleton  v-for="n in 6" :key="n"></playlist-card-skeleton>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
    import PlaylistCardSkeleton from "@collections/Cards/Grid/PlaylistCard/PlaylistCardSkeleton.vue";
</script>
