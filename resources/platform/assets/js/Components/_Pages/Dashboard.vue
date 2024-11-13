<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <PageHeader
            :title="headerData?.title"
            :description="headerData?.description"
            :hero-img="headerData?.heroImg"
            :hero-img-classes="headerData?.heroImgClasses ?? '' "
            :content-id="headerData?.contentId"
            :info-data="headerData?.infoData"
            :ctas="headerData?.ctas"
        />

        <div class="tw-flex tw-flex-col">
            <!-- Header -->
            <div class="tw-flex tw-flex-row tw-border-b tw-border-[#e5e8e8] dark:tw-border-[#223F57] tw-mb-5 md:tw-mb-7 tw-mt-8">
                <h1 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-4 md:tw-mb-6 dark:tw-text-white">
                    {{ isCurrentUsersProfile ? 'My' : `${headerData?.title}'s ` }} Dashboard
                </h1>
            </div>

            <!-- User Stats -->
            <section class="tw-flex tw-flex-col tw-mb-5 md:tw-mb-10 tw-text-[#00101D] dark:tw-text-white tw-w-full">
                <!-- Title -->
                <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                    <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-text-2xl lg:tw-text-3xl tw-leading-none lg:tw-leading-none">My Stats</h2>
                </div>

                <!-- Method Progress -->
                <div :class="`tw-flex tw-flex-col lg:tw-flex-row tw-justify-center tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] lg:tw-pr-6 tw-bg-gradient-to-b tw-from-${brand} tw-to-${brand}-700`">
                    <div class="tw-flex tw-items-center tw-justify-center tw-px-8 tw-w-full lg:tw-w-7/12">
                        <img :src="`https://d38h3dn806jqj1.cloudfront.net/logos/${brand}-method.svg`" alt="brand" class="tw-max-w-[200px] lg:tw-max-w-[567px] tw-w-full tw-mb-4 lg:tw-mb-0" />
                    </div>
                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-px-10 sm:tw-px-8 tw-w-full lg:tw-w-5/12">
                        <div class="tw-text-center tw-w-full tw-max-w-[287px]">
                            <h3 class="text-white tw-text-4xl xl:tw-text-[54px] tw-font-bold tw-leading-none tw-mb-2 tw-uppercase">Level {{ nextLearningPathLevel }}</h3>
                            <div class="tw-flex">
                                <!-- progress bar -->
                                <div class="tw-bg-white tw-relative tw-w-full tw-h-[26px] tw-rounded-full tw-border-white tw-border-[3px]">
                                    <div :class="`tw-absolute tw-h-full tw-rounded-full tw-top-0 tw-left-0 tw-bg-${brand}`" :style="`width: ${nextLearningPathProgressPercent}%`"></div>
                                </div>
                                <!-- Progress percentage -->
                                <span class="tw-font-bold tw-ml-2 tw-text-sm tw-text-white">{{ nextLearningPathProgressPercent }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrics -->
                <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                    <UserMetric v-for="(metric, index) in metrics" :metric="metric" :index="index" :key="`user metric ${index}`" />
                </div>
            </section>

            <!-- Challenge Carousel -->
            <MiniCatalogueSection
                v-if="challenges.length"
                title="Challenges"
                :see-all-url="`/${brand}/challenges`"
                seeAllAriaLabel="See All Challenges"
                catalogue-type="challenge"
                :pre-loaded-content="challenges"
            />

            <!-- Challenge Awards -->
            <MiniCatalogueSection
                v-if="awards.length"
                title="My Awards"
                catalogue-type="challengeAward"
                :pre-loaded-content="awards"
            />

            <!-- Completed Lessons -->
            <MiniCatalogueSection
                title="Completed Lessons"
                :see-all-url="`/${brand}/lesson-history/completed`"
                seeAllAriaLabel="See All Completed Lessons"
                :pre-loaded-content="completedContents"
            />

            <!-- Started Lessons -->
            <MiniCatalogueSection
                title="Started Lessons"
                :see-all-url="`/${brand}/lesson-history/in-progress`"
                seeAllAriaLabel="See All Started Lessons"
                :pre-loaded-content="startedContents"
            />

            <!-- About You -->
            <section id="editForm" class="tw-flex tw-flex-row tw-flex-wrap tw-pt-[24px] tw-mb-[30px]" dusk="about-user">
                <div class="tw-flex tw-flex-row tw-w-full tw-items-center tw-mb-8 tw-flex-wrap">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-my-2 dark:tw-text-white">
                        About {{ isCurrentUsersProfile ? 'You' : dashboardUser?.display_name }}
                    </h2>
                    <a v-if="isCurrentUsersProfile" :href="`/${brand}/profile/${brand}/settings/profile?${dashboardUser?.id}`"
                       class="tw-btn-secondary tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-8 tw-ml-auto"
                       dusk="edit-user">
                        Edit
                    </a>
                </div>

                <div class="tw-flex tw-flex-col xl:tw-flex-row tw-mb-3 tw-w-full">
                    <!-- User Details -->
                    <div class="tw-flex tw-flex-col tw-mb-4 lg:tw-max-w-[50%] tw-mr-auto">
                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[12px]">
                            <span class="tw-font-bold">Full Name:&nbsp;</span>
                            <span>{{ dashboardUser?.first_name }}&nbsp;{{ dashboardUser?.last_name }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[12px]">
                            <span class="tw-font-bold">Birthday:&nbsp;</span>
                            <span>{{ dashboardUser?.birthday }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[24px]">
                            <span class="tw-font-bold">Location:&nbsp;</span>
                            <span>{{ dashboardUser?.country }}</span>
                        </div>

                        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-mb-[24px]">
                            <p class="body">
                                <span class="tw-font-bold">Bio:&nbsp;</span>
                                <template v-html="dashboardUser?.biography"></template>
                            </p>
                        </div>
                    </div>
                    <!-- User gear details -->
                    <GearCarousel
                        :gear-info="dashboardUser"
                        :brand="brand"
                        class="tw-flex-grow-0 xl:tw-ml-[36px]"
                    />
                </div>
            </section>
        </div>
    </div>
</template>
<script setup>
import { computed, ref, onBeforeMount } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { usePlatformStore } from "@stores/platform";
import { fetchContentInProgress, fetchCompletedContent, fetchByRailContentIds, fetchUserBadges, fetchChallengeUserActiveChallenges } from 'musora-content-services';

import Breadcrumb from '@collections/Breadcrumb/Breadcrumb';
import PageHeader from '@collections/PageHeader/PageHeader';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection';
import UserMetric from '@collections/UserMetric/UserMetric';
import GearCarousel from '@collections/GearCarousel/GearCarousel';

const props = defineProps({
    headerData: {
        type: Object,
        default: {},
    },
    isCurrentUsersProfile: {
        type: Boolean,
        default: false,
    },
    nextLearningPathLevel: {
        type: Number,
        default: 0,
    },
    nextLearningPathProgressPercent: {
        type: Number,
        default: 0,
    },
    userMetrics: {
        type: Object,
        default: () => {},
    },
    dashboardUser: {
        type: Object,
        default: () => {},
    },
})

const platformStore = usePlatformStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const startedContents = ref([]);
const completedContents = ref([]);
const awards = ref([]);
const challenges = ref([]);

const metrics = computed(() => {
    const keys = Object.keys(props.userMetrics);
    if(keys.length > 0){
        const array = [];
        keys.forEach(key => {
            array.push(props.userMetrics[key]);
        })

        return array;
    }

    return [];
})

const breadcrumbs = [
    {
        title: 'Dashboard'
    }
]

onBeforeMount(() => {
    const fetchData = async () => {
        const [startedIds, completedIds, badges, startedChallenges] = await Promise.all([
            fetchContentInProgress('all', brand.value),
            fetchCompletedContent('all', brand.value),
            fetchUserBadges(brand.value),
            fetchChallengeUserActiveChallenges(brand.value),
        ]);

        const lessons = await fetchByRailContentIds([...startedIds.started, ...completedIds.completed]);
        const started = lessons.filter(lesson => startedIds.started.includes(lesson.id)).slice(0, 20);
        const completed = lessons.filter(lesson => completedIds.completed.includes(lesson.id)).slice(0, 20);
        awards.value = badges;
        challenges.value = startedChallenges;

        startedContents.value = started;
        completedContents.value = completed;

        platformStore.setLoadingState(false);
    }

    fetchData();
})
</script>
