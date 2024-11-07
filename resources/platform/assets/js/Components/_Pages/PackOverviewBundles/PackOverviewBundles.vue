<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" :class-override="breadcrumbClassOverride" />

        <PageHeader
            :page-type="header?.type"
            :title="header?.title"
            :hero-img="header?.image"
            :dark-mode-logo="header?.darkLogo"
            :light-mode-logo="header?.lightLogo"
            :progress="header?.progress"
            :info-data="header?.infoData"
            :ctas="header?.ctas"
            :description="header?.description"
            :is-loading="isLoading"
        />

        <template v-if="!isLoading">
            <div class="tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57] tw-pb-[30px]">
                <div class="tw-my-[30px]">
                    <h1 class="tw-text-[30px] tw-font-bold dark:tw-text-white tw-capitalize">{{ data.title }}</h1>
                </div>

                <div class="flex-wrap tw-flex md:tw-grid md:tw-grid-cols-3 lg:tw-grid-cols-4 2xl:tw-grid-cols-5 md:tw-gap-3 ">
                    <CatalogueCard
                        v-for="item in data.children"
                        :key="'pack grid' + item.id"
                        :item="item"
                        :content-type="data.type"
                        :show-my-list-action="true"
                        wrapperClassOverride="tw-w-full"
                        @addToList="addToList"
                    />
                </div>
            </div>
            <!-- TODO: Completion Bonus XP does not exist in data -->
            <CompletionBonus :xp-bonus="xpBonus" /> 
        </template>

        <div v-else class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 lg:tw-grid-cols-4 2xl:tw-grid-cols-5 tw-gap-3 tw-my-[30px]">
            <SkeletonCard v-for="i in 3" :key="i" />
        </div>
    </div>
</template>
<script setup>
import {ref, onMounted} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import useUserCatalogueEvents from "@hooks/useUserCatalogueEvents";
import PageHeader from "@collections/PageHeader/PageHeader";
import Breadcrumb from "@collections/Breadcrumb/Breadcrumb.vue";
import CompletionBonus from "@collections/CompletionBonus/CompletionBonus";
import CatalogueCard from "@collections/Catalogue/CatalogueCard";
import SkeletonCard from '@collections/SkeletonLoader/SkeletonCard.vue';
import { usePackPageData } from '@hooks/pages/usePackPageData';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    breadcrumbClassOverride: {
        type: String,
        default: "",
    },
    pack: {
        type: Object,
        default: () => ({}),
    },
    xpBonus: {
        type: Number,
        default: 0,
    },
});

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const { addToList } = useUserCatalogueEvents({ ...props });

//Refs
const data = ref(null);
const header = ref(null)

onMounted( async () => {
    const { data: PackData, error: PackError, isLoading: PackLoading } = await usePackPageData('pack-bundle');
        //console.log('packData', PackData.value )
        data.value = PackData.value;
        //Header Data
        header.value = PackData?.value?.header;
        //console.log( 'header', header.value )
        platformStore.setLoadingState(PackLoading.value);
})
</script>
