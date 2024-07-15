<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" :class-override="breadcrumbClassOverride" />

        <PageHeader
            :page-type="headerPageType"
            title="Pack"
            :hero-img="headerHeroImg"
            :dark-mode-logo="headerDarkModeLogo"
            :light-mode-logo="headerLightModeLogo"
            :progress="headerProgress"
            :info-data="headerInfoData"
            :ctas="headerCtas"
            :description="headerDescription"
        />

        <div class="tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57] tw-pb-[30px]">
            <div class="tw-my-[30px]">
                <h1 class="tw-text-[30px] tw-font-bold dark:tw-text-white tw-capitalize">{{ packTitle }}</h1>
            </div>

            <div class="flex-wrap tw-flex md:tw-grid md:tw-grid-cols-3 lg:tw-grid-cols-4 2xl:tw-grid-cols-5 md:tw-gap-3 ">
                <CatalogueCard
                    v-for="item in childContent.data"
                    :key="'pack grid' + item.id"
                    :item="item"
                    :content-type="item.type"
                    :show-my-list-action="true"
                    wrapperClassOverride="tw-w-full"
                    @addToList="addToList"
                />
            </div>
        </div>

        <CompletionBonus :xp-bonus="xpBonus" />
    </div>
</template>
<script setup>
import { computed } from "vue";
import useUserCatalogueEvents from "../../Hooks/useUserCatalogueEvents";
import PageHeader from "../PageHeader/PageHeader";
import Breadcrumb from "../Breadcrumb/Breadcrumb";
import ContentInfo from "../ContentInfo/ContentInfo";
import CompletionBonus from "../CompletionBonus/CompletionBonus";
import CatalogueCard from "../Catalogue/CatalogueCard";

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    breadcrumbClassOverride: {
        type: String,
        default: "",
    },
    childContent: {
        type: Object,
        default: () => ({}),
    },
    headerCtas: {
        type: Array,
        default: () => [],
    },
    headerInfoData: {
        type: Array,
        default: () => [],
    },
    headerPageType: {
        type: String,
        default: "pack",
    },
    headerProgress: {
        type: [Number, String],
        default: 0,
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

const { addToList } = useUserCatalogueEvents({ ...props });

const headerHeroImg = computed(() => {
    return props.pack.data?.find((p) => p.key === 'header_image_url')?.value;
})

const headerDarkModeLogo = computed(() => {
    return props.pack.data?.find((p) => p.key === 'dark_mode_logo_url')?.value;
})

const headerLightModeLogo = computed(() => {
    return props.pack.data?.find((p) => p.key === 'light_mode_logo_url')?.value;
})

const headerDescription = computed(() => {
    return props.pack.data?.find((p) => p.key === 'description')?.value || '';
})

const packTitle = computed(() => {
    return props.pack.fields?.find((p) => p.key === 'title')?.value || '';
})
</script>
