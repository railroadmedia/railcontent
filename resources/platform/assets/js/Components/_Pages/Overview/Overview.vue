<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbsData" :isLoading="isLoading" />

        <PageHeader
            :title="header?.title"
            :description="header?.description"
            :content-id="header?.contentId"
            :page-type="header?.type"
            :progress="header?.progress"
            :info-data="header?.infoData"
            :is-loading="isLoading"
            :hero-img="header?.thumbnail"
            :dropdowns="headerDropdown"
            :progress-label-text="headerData?.progressLabelText"
            :icon-name="headerIconName"
            :ctas="headerCtas"
            :lesson-data="{ challenge: data?.lesson, next_lesson: data?.next_lesson }"
            :dark-mode-logo="header?.darkModeLogo"
            :light-mode-logo="header?.lightModeLogo"
        />

        <div v-if="nextLesson?.length" class="tw-w-full dark:tw-bg-[#002039] tw-bg-[#E7EFF6] tw-mt-2 tw-rounded-md">
            <div class="tw-w-full tw-p-4 tw-pb-0">
                <div class="tw-flex tw-flex-col">
                    <div class="flex flex-row tw-justify-between align-v-center tw-text-[#00101D] dark:tw-text-white tw-text-base sm:tw-text-xl tw-font-bold tw-leading-none tw-font-bebas-neue">
                        Your Next Lesson...
                        <i class="fa-solid fa-arrow-right sm:tw-hidden"></i>
                    </div>
                    <div class="flex flex-row remove-borders">
                        <transition appear name="fade">
                            <ListCatalogue
                                :content="nextLesson"
                                :display-items-as-overview="true"
                                :lock-unowned="true"
                                :data-user-id="userId"
                                :is-admin="isAdmin"
                                :is-next-lesson="true"
                                :is-loading="isLoading"
                            />
                        </transition>
                    </div>
                </div>
            </div>
        </div>

        <template v-if="!isLoading">
            <div class="tw-flex tw-flex-col tw-my-[30px]">
                <div class="tw-flex tw-w-full tw-flex-row">
                    <transition appear name="fade">
                        <!--
                            Don't change :content="OvervewChildData",
                            unless you know what you're doing
                        -->
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

        <SkeletonListCatalogueItem v-else v-for="n in 6" :key="n" :content-type="contentType" :overview="showOverview" />
    </div>
</template>
<script setup>
import { computed, ref, onBeforeMount } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { usePlatformStore } from '@stores/platform';
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import ListCatalogue from '@collections/ListCatalogue/ListCatalogue'
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';
import { useOverviewPageData } from '@hooks/pages/useOverviewPageData';
import { dropdowns } from '@pages/Overview/dropdowns';

const props = defineProps({
    contentType: {
        type: String,
        required: true,
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
    // TODO: Remove this prop, need to migrate CTAs and progressLabelText
    headerData: {
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
    parentType: {
        type: String,
        default: '',
    },
})

//Pinia
const userStore = useUserStore();
const platformStore = usePlatformStore();
const { userId, isAdmin, brand } = storeToRefs(userStore);
const { isLoading } = storeToRefs(platformStore);

//Refs
const data = ref(null);
const nextLesson = ref(null);
const challengeOverviewContent = ref([]);
const header = ref(null);
const error = ref(null);
const isUnlocked = ref(false); //challenge dropdown

//Computed
const showOverview = computed(() => {
    return props.contentType === 'learning-path-level' || props.contentType === 'learning-path-course'  || props.contentType === 'unit';
})
const OverviewChildData = computed( () => {
    if(props.contentType === 'learning-path-level') return data.value.levels;
    if(props.contentType === 'unit') return data.value.units;
    return data.value.children;
})

const headerDropdown = computed(() => {
    if(isChallenge.value && !isUnlocked.value && isChallengeEnrolled.value && isChallengeSolo.value){
        return dropdowns['challenges']['unlock'](header.value?.title);
    } else if(isChallenge.value && isUnlocked.value && isChallengeSolo.value){
        return dropdowns['challenges']['unlocked'](header.value?.title, data.value.lesson?.registration_url)
    }
})

const isChallenge = computed(() => {
    return props.parentType === 'challenge';
})

const isChallengeEnrolled = computed(() => {
    return data.value?.user_data?.is_active;
})

const isChallengeSolo = computed(() => {
    return data.value?.lesson?.is_solo;
})

const breadcrumbsData = computed(() => {
    if (props.contentType === 'course-part') {
        return [{ title: 'Courses', url: `/${brand.value}/courses` }, { title: header.value?.title }];
    } else if (props.contentType === 'challenge-part') {
        return [{ title: 'Challenges', url: `/${brand.value}/challenge` }, { title: header.value?.title }];
    }
    const middleBreadcrumbs = data.value?.breadcrumbs_data ? data.value?.breadcrumbs_data : [];
    return [...middleBreadcrumbs, { title: header.value?.title }];
})

const generateChallengeCtas = (data) => {
    if(isChallengeEnrolled.value){
        //when next lesson is the first lesson
        if(data.next_lesson?.is_first_lesson){
            let type;

            if(data.next_lesson?.is_locked){
                type = 'LockedChallengeCta';
            } else {
                type = 'PageHeaderPrimaryCta';
            }

            return [
                {
                    type,
                    props: {
                        text: 'Start Challenge',
                        url: data.children[0].web_url_path,
                        isPrimary: true,
                    }
                }
            ]
        } else {
            // if next lesson is locked
            if(data.next_lesson?.is_locked){
                if (data.previous_lesson?.title) {
                    return [
                        {
                            type: 'PageHeaderPrimaryCta',
                            props: {
                                text: `Replay ${data.previous_lesson.title}`,
                                isPrimary: true,
                            },
                            lessonData: data.previous_lesson.web_url_path,
                        }
                    ]
                } else {
                    return [];
                }
            }
            // if next lesson is unlocked
            else {
                let obj;
                if(!data.previous_lesson?.completed){
                    obj = {
                        url: data.previous_lesson?.web_url_path,
                        text: 'Continue'
                    }
                } else {
                    obj = {
                        url: data.next_lesson?.web_url_path,
                        text: 'Next Lesson',
                        faIconClass: 'fas fa-play',
                    }
                }

                return [
                    {
                        type: 'PageHeaderPrimaryCta',
                        props: {
                            ...obj,
                            isPrimary: true,
                        }
                    }
                ]
            }
        }
    } else {
        return [
            {
                type: 'PageHeaderPrimaryCta',
                props: {
                    text: 'Enroll now',
                    faIconClass: 'fa-regular fa-graduation-cap',
                    url: data.lesson.registration_url,
                    isPrimary: true,
                }
            }
        ];
    }
}

const headerCtas = computed(() => {
    if(isChallenge.value){
        return data.value && generateChallengeCtas(data.value);
    } else {
        return header.value?.ctas;
    }
})

const headerIconName = computed(() => {
    if(props.parentType === 'learning-path'){
        return 'method';
    }

    return null;
})

onBeforeMount( async () => {
    const { data: OverviewData, error: OverviewError, isLoading: OverviewLoading } = await useOverviewPageData(props.contentType, props.parentType);

    //Header Data
    header.value = OverviewData.value.header;

    nextLesson.value = OverviewData.value.next_lesson;

    isUnlocked.value = OverviewData.value?.is_unlocked;

    data.value = OverviewData.value;

    platformStore.setLoadingState(OverviewLoading.value);
})
</script>
