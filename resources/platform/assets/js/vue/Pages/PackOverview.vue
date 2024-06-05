<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
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
        <div class="tw-my-4">
            <ContentCatalogue
                :brand="brand"
                catalogue-type="list"
                :theme-color="brand"
                :use-theme-color="true"
                :pre-loaded-content="childContent"
                :show-numbers="true"
                :user-id="userId"
                :is-admin="isAdmin"
            />

            <CompletionBonus :xp-bonus="xpBonus" />
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import { useUserStore } from "../../stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import PageHeader from "../components/PageHeader/PageHeader";
import Breadcrumb from "../components/Breadcrumb/Breadcrumb";
import CompletionBonus from "../components/CompletionBonus/CompletionBonus";
import ContentCatalogue from "../components/Catalogue/ContentCatalogue";
import CatalogueCardContainer from '../components/Catalogue/CatalogueCardContainer';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    childContent: {
        type: Object,
        default: () => ({}),
    },
    headerPageType: {
        type: String,
        default: "pack",
    },
    headerProgress: {
        type: [Number, String],
        default: 0,
    },
    headerInfoData: {
        type: Object,
        default: () => ({}),
    },
    headerCtas: {
        type: Array,
        default: () => [],
    },
    isAdmin: {
        type: Boolean,
        default: () => false,
    },
    pack: {
        type: Object,
        default: () => ({}),
    },
    userId: {
        type: String,
        default: () => "",
    },
    xpBonus: {
        type: Number,
        default: 0,
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const headerHeroImg = computed(() => {
    return props.pack.data.find((p) => p.key === 'header_image_url')?.value;
})

const headerDarkModeLogo = computed(() => {
    return props.pack.data.find((p) => p.key === 'dark_mode_logo_url')?.value;
})

const headerLightModeLogo = computed(() => {
    return props.pack.data.find((p) => p.key === 'light_mode_logo_url')?.value;
})

const headerDescription = computed(() => {
    return props.pack.data.find((p) => p.key === 'description')?.value || '';
})
</script>
