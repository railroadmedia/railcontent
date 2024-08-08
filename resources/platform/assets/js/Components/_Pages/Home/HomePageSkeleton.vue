<template>
     <!-- Skeleton Loader -->
     <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 tw-animate-pulse">
        <!-- Banner -->
        <div class="tw-block tw-w-full tw-h-[370px] tw-border-box tw-rounded-[10px] tw-relative tw-mt-[16px] tw-mb-[30px] tw-bg-ui-skeleton"></div>

        <!-- lesson mini catalogs -->
        <mini-catalog-skeleton v-for="n in 3" :key="n"></mini-catalog-skeleton>

        <!-- Playlist Mini Catalog -->
        <playlist-mini-catalog-skeleton></playlist-mini-catalog-skeleton>

        <!-- Upcomming -->
        <div class="tw-w-full tw-h-[130px] tw-rounded-xl tw-bg-ui-skeleton tw-mb-6"></div>

        <!-- lesson mini catalogs -->
        <mini-catalog-skeleton></mini-catalog-skeleton>

        <!-- My Stats -->
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
                <!-- Stats -->
                <div class="tw-flex tw-flex-col lg:tw-flex-row tw-justify-center tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] lg:tw-pr-6 tw-bg-ui-skeleton"></div>
                <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                    <div v-for="n in 4" :key="n" class="tw-inline-flex tw-w-full tw-min-h-[150px] tw-flex-col tw-rounded-full tw-border-[3px] tw-border-ui-skeleton tw-justify-center tw-items-center tw-justify-items-stretch"></div>
                </div>
            </div>
        </section>
    </div>
</template>
<script setup>
    import MiniCatalogSkeleton from '@collections/Catalogue/MiniCatalogSkeleton.vue';
    import PlaylistMiniCatalogSkeleton from '@collections/Playlists/PlaylistCollection/PlaylistMiniCatalogSkeleton.vue';
</script>