<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <PageHeader
            :page-type="pageType"
            :icon-name="headerIconName"
            :title="headerTitle"
            :description="headerDescription"
            :hero-img="headerHeroImg"
            :progress="headerProgress"
            :progress-label-text="headerProgressLabelText"
            :content-id="headerContendId"
            :info-data="headerInfoData"
            :ctas="headerCtas"
            :dark-mode-logo="headerDarkModeLogo"
            :light-mode-logo="headerLightModeLogo"
        />

        <div v-if="hasNextLesson" class="tw-w-full dark:tw-bg-[#002039] tw-bg-[#E7EFF6] tw-mt-2 tw-rounded-md">
            <div class="tw-w-full tw-p-4">
                <div class="tw-flex tw-flex-col">
                    <div class="flex flex-row align-v-center">
                        <p class="tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-xl tw-font-bold tw-mt-2 tw-ml-3 tw-leading-none">
                            Your Next Lesson...
                        </p>
                    </div>
                    <div class="flex flex-row remove-borders">
                        <transition appear name="fade">
                            <ContentCatalogue
                                :brand="brand"
                                catalogue-type="list"
                                :theme-color="brand"
                                :pre-loaded-content="nextLesson"
                                :display-items-as-overview="true"
                                :lock-unowned="true"
                                :data-user-id="userId"
                                :is-admin="isAdmin"
                            />
                        </transition>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-flex tw-flex-col tw-my-[30px]">
            <div class="tw-flex tw-w-full tw-flex-row">
                <transition appear name="fade">
                    <ContentCatalogue
                        :brand="brand"
                        catalogue-type="list"
                        :theme-color="brand"
                        :user-id="userId"
                        :use-theme-color="true"
                        :pre-loaded-content="childContent"
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
    </div>
</template>
<script setup>
import { computed, onMounted } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";
import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import PageHeader from '../components/PageHeader/PageHeader';
import ContentCatalogue from "../vuesora/views/catalogues/ContentCatalogue";
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';

const props = defineProps({
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
    isAdmin: {
        type: Boolean,
        default: false,
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
    userId: {
        type: String,
        default: '',
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

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const headerIconName = computed(() => {
    return props.headerData.iconName;
})

const headerTitle = computed(() => {
    return props.headerData.title;
})

const headerDescription = computed(() => {
    return props.headerData.description;
})

const headerHeroImg = computed(() => {
    return props.headerData.heroImg;
})

const headerProgress = computed(() => {
    return props.headerData.progress;
})

const headerProgressLabelText = computed(() => {
    return props.headerData.progressLabelText;
})

const headerContendId = computed(() => {
    return props.headerData.contentId;
})

const headerInfoData = computed(() => {
    return props.headerData.infoData;
})

const headerCtas = computed(() => {
    return props.headerData.ctas;
})

const headerDarkModeLogo = computed(() => {
    return props.headerData.darkModeLogo;
})

const headerLightModeLogo = computed(() => {
    return props.headerData.lightModeLogo;
})
</script>
