<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <PageHeader
            :page-type="headerPageType"
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
        <div class="tw-my-4">
            <ListCatalogue
                :content="data?.children"
                :user-id="userId"
                :is-admin="isAdmin"
                :show-numbers="true"
            />
            <CompletionBonus :xp-bonus="xpBonus" />
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import PageHeader from "@collections/PageHeader/PageHeader";
import Breadcrumb from "@collections/Breadcrumb/Breadcrumb.vue";
import CompletionBonus from "@collections/CompletionBonus/CompletionBonus";
import ListCatalogue from '@collections/ListCatalogue/ListCatalogue';
import { usePackPageData } from '@hooks/pages/usePackPageData';

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

//User
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
//Platform
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

//Refs
const data = ref(null);
const header = ref(null)

onMounted( async () => {
    //console.log(props.headerCtas)
    //console.log(props.headerPageType)
    const { data: PackData, error: PackError, isLoading: PackLoading } = await usePackPageData('pack-overview');
        data.value = PackData.value;
        //console.log('data', PackData.value)
        //Header Data
        header.value = PackData?.value?.header;
        platformStore.setLoadingState(PackLoading.value);
})
</script>
