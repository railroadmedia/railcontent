<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        
        <PageHeader
            :title="header?.title"
            :description="header?.description"
            :content-id="header?.contentId"
            :page-type="header?.type"
            :progress="header?.progress"
            :info-data="header?.infoData"
            :is-loading="isLoading"
            :progress-label-text="headerData?.progressLabelText"
            :icon-name="headerData?.iconName"
            :ctas="headerData?.ctas"
        />

        <template v-if="!isLoading">
            
            <!-- BACK-END NOT IMPLEMENTED -->
            <!-- <div v-if="hasNextLesson" class="tw-w-full dark:tw-bg-[#002039] tw-bg-[#E7EFF6] tw-mt-2 tw-rounded-md">
                <div class="tw-w-full tw-p-4 tw-pb-0">
                    <div class="tw-flex tw-flex-col">
                        <div class="flex flex-row tw-justify-between align-v-center tw-text-[#00101D] dark:tw-text-white tw-text-base sm:tw-text-xl tw-font-bold tw-leading-none tw-font-bebas-neue">
                            Your Next Lesson...
                            <i class="fa-solid fa-arrow-right sm:tw-hidden"></i>
                        </div>
                        <div class="flex flex-row remove-borders">
                            <transition appear name="fade">
                                <ListCatalogue
                                    :content="nextLesson.data"
                                    :display-items-as-overview="true"
                                    :lock-unowned="true"
                                    :data-user-id="userId"
                                    :is-admin="isAdmin"
                                    :is-next-lesson="true"
                                />
                            </transition>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="tw-flex tw-flex-col tw-my-[30px]">
                <div class="tw-flex tw-w-full tw-flex-row">
                    <transition appear name="fade">
                        <ListCatalogue
                            :content="OverviewChildData"
                            :content-type-override="contentType"
                            :is-admin="isAdmin"
                            :display-items-as-overview="childContentDisplayItemsAsOverview"
                            :lock-unowned="!isAdmin"
                            :show-numbers="childContentShowNumbers"
                            :force-wide-thumbs="childContentForceWideThumbs"
                            :branch-path-index="childContentBranchPathIndex"
                            :branch-path-content="childContentBranchPathContent"
                        />
                    </transition>
                </div>

                <!-- XP Bonus -->
                <div v-if="showCompletionBonus" class="tw-flex tw-flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] ph-1">
                    <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white tw-items-center tw-w-full pv-2">
                        <h3 class="tw-font-bebas-neue tw-text-base tw-uppercase tw-font-normal tw-text-center">Completion Bonus</h3>
                        <span class="heading tw-text-center tw-text-[30px]">
                            <i class="fas fa-trophy tw-text-2xl"></i>
                            {{ xpBonus }} XP
                        </span>
                    </div>
                </div>

                <!-- Pianote Foundations -->
                <a v-if="showPianoteFoundations" href="/pianote/method/foundations-2019/215952"
                   class="flex flex-row no-decoration hover-bg-grey-7 dark:hover:tw-bg-[#002039] tw-relative text-grey-3 hover-text-black content-overview pv-2">
                    <div class="flex flex-column">
                        <p class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-mt-[5px]">Pianote Foundations</p>
                    </div>
                    <div class="tw-text-[#00101D] dark:tw-text-white tw-text-2xl tw-font-bold tw-flex tw-flex-col tw-justify-center tw-text-center hide-sm-down tw-mr-2">
                        10 Levels
                    </div>
                    <div class="flex flex-column icon-col align-v-center hide-xs-only">
                        <div class="body">
                            <i class="fas flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] rounded fa-play-circle"></i>
                        </div>
                    </div>
                </a>
            </div>

            <CollectionWrapper
                v-if="songsPdfs.length > 0"
                collection-type="song-pdf"
                :pre-loaded-content="songsPdfs"
                title="Songs"
            />
        </template>

        <SkeletonListCatalogueItem v-else v-for="n in 6" :key="n" :content-type="contentType" :overview="showOverview" :show-numbers="showNumbers" />
    </div>
</template>
<script setup>
import {computed, ref, onBeforeMount} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { usePlatformStore } from '@stores/platform';
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import ListCatalogue from '@collections/ListCatalogue/ListCatalogue'
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';
import { useOverviewPageData } from '@hooks/pages/useOverviewPageData';

const props = defineProps({
    contentType: {
        type: String,
        required: true,
    },
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    childContent: {
        type: Object,
        default: () => {},
    },
    childContentBranchPathIndex: {
        type: Number,
        default: () => 0,
    },
    childContentBranchPathContent: {
        type: Object,
        default: () => {},
    },
    childContentDisplayItemsAsOverview: {
        type: Boolean,
        default: () => false,
    },
    childContentForceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    childContentShowNumbers: {
        type: Boolean,
        default: () => false,
    },
    headerData: {
        type: Object,
        default: () => {},
    },
    nextLesson: {
        type: Object,
        default: () => {},
    },
    pageType: {
        type: String,
        default: '',
    },
    showCompletionBonus: {
        type: Boolean,
        default: false,
    },
    showPianoteFoundations: {
        type: Boolean,
        default: false,
    },
    songsPdfs: {
        type: Array,
        default: () => [],
    },
    xpBonus: {
        type: Number,
        default: 0,
    },
    hasNextLesson: {
        type: Boolean,
        default: false,
    },
})

//Pinia
const userStore = useUserStore();
const platformStore = usePlatformStore();
const { userId, isAdmin, brand } = storeToRefs(userStore);
const { isLoading } = storeToRefs(platformStore);

//Refs
const data = ref(null);
const header = ref(null);
const error = ref(null);

//Computed
const showOverview = computed(() => {
    return props.contentType === 'learning-path-level' || props.contentType === 'learning-path-course'  || props.contentType === 'unit';
})
const showNumbers = computed(() => {
    return props.contentType === 'learning-path-lesson' || props.contentType === 'unit-part';
})
const OverviewChildData = computed( () => {
    if(props.contentType === 'learning-path-level') return data.value.levels;
    if(props.contentType === 'unit') return data.value.units; 
    return data.value.children; 
})

onBeforeMount( async () => {
    // console.log('content type is', props.contentType)
    // console.log('headerData', props.headerData.ctas)
    // console.log('sanity content is: ', props.contentType);
    const { data: OverviewData, error: OverviewError, isLoading: OverviewLoading } = await useOverviewPageData(props.contentType);
        data.value = OverviewData.value;

        //Header Data
        header.value = OverviewData.value.header;

        //console.log('my data', data.value)    
        platformStore.setLoadingState(OverviewLoading.value);

})
</script>
