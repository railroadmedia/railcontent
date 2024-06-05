<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white">
        <Breadcrumb
            :breadcrumbs="breadcrumbs"
        />
        <PageHeader
            title="Lesson Packs"
            icon-name="electric-guitar"
        />

        <!-- Guitar Quest Banner -->
        <div class="tw-mt-4">
            <div class="tw-relative tw-rounded-[10px] tw-overflow-hidden md:tw-h-[276px] tw-w-full">
                <a :href="guitarQuestUrl" class="tw-w-full tw-h-full">
                    <!-- Desktop Image -->
                    <img src="https://www.musora.com/musora-cdn/image/width=1600,q_auto:best/https://d122ay5chh2hr5.cloudfront.net/shop/card-thumbs/guitar-quest-background.jpg"
                         alt="Guitar Quest Lesson Promotional Image"
                         class="tw-w-full tw-hidden md:tw-block tw-transition-opacity tw-opacity-0 tw-h-full tw-object-cover"
                         loading="lazy"
                         onload="this.classList.remove('tw-opacity-0')"
                    >
                    <!-- Mobile Image -->
                    <img src="https://www.musora.com/musora-cdn/image/width=600,q_auto:best/https://d122ay5chh2hr5.cloudfront.net/shop/card-thumbs/guitar-quest-background-mobile.jpg"
                         alt="Guitar Quest Lesson Promotional Image"
                         class="gq-small-thumb tw-transition-opacity tw-opacity-0"
                         loading="lazy"
                         onload="this.classList.remove('tw-opacity-0')"
                    >
                    <div class="bg-guitareoGuitarQuest tw-text-white tw-font-normal dense tw-uppercase title tw-px-3 tw-py-2 tw-leading-none tw-absolute tw-top-0 tw-left-0"
                         style="border-radius:10px 0 10px 0">
                        Beginner Guitarist? Start Here!
                    </div>
                </a>
                <div class="gq-cta">
                    <div class="tw-h-full">
                        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full">
                            <div class="tw-mb-[10px]" style="max-width: 190px">
                                <img :src="guitarQuestLogo"
                                     alt="Guitar Quest Logo"
                                     class="tw-transition-opacity tw-opacity-0"
                                     loading="lazy"
                                     onload="this.classList.remove('tw-opacity-0')"
                                >
                            </div>
                            <h1 class="display tw-font-bison-bold tw-text-white tw-text-center tw-uppercase tw-font-normal tw-text-2xl lg:tw-text-3xl xl:tw-text-4xl" style="line-height: 0.9em;">Your guitar journey<br>starts here.</h1>
                            <a
                                :href="guitarQuestNextLessonUrl"
                                class="btn tw-text-white bg-guitareoGuitarQuest tw-text-lg tw-max-w-[250px] go-to-button tw-mt-[10px]"
                            >
                                <template v-if="guitarQuestProgress === 'started'">
                                    Continue Next Lesson &raquo;
                                </template>
                                <template v-else-if="guitarQuestProgress === 'completed'">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Completed
                                </template>
                                <template v-else>
                                    Start First Lesson &raquo;
                                </template>
                            </a>
                            <a
                                :href="guitarQuestUrl"
                                class="tw-mt-[10px] tw-text-white dense tw-uppercase tw-text-sm no-decoration tw-hidden sm:tw-inline tw-opacity-80"
                            >
                                See All Lessons &raquo;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Packs -->
        <div class="tw-flex tw-flex-wrap">
            <GuitareoPack
                v-for="pack in packs"
                :key="pack.id"
                :pack="pack"
                :user-id="userId"
            />
        </div>

        <div class="tw-px-[10px]">
            <!-- COURSES SECTION-->

            <div class="tw-mb-[30px]">
                <MiniCatalogueSection
                    title="Courses"
                    seeAllAriaLabel="See All Courses"
                    seeAllUrl="/guitareo/courses"
                    :preLoadedContent="courses.data"
                    :lock-unowned="true"
                />
            </div>

            <!-- QUICK TIPS SECTION-->
            <div class="tw-mb-[30px]">
                <MiniCatalogueSection
                    title="Quick Tips"
                    seeAllAriaLabel="See All Quick Tips"
                    seeAllUrl="/guitareo/quick-tips"
                    :preLoadedContent="quickTips.data"
                    :lock-unowned="true"
                />
            </div>

            <!-- TOPICS SECTION-->
            <div class="tw-mb-[30px]">
                <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                    <h2 class="tw-text-[#00101D] dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl">Topics</h2>
                </div>

                <div class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-x-4 tw-gap-y-2">
                    <a v-for="topic in topics" :href="topic['url']"
                       class="tw-flex tw-w-full tw-flex-col tw-items-center tw-justify-center tw-min-h-[103px] tw-p-4 font-no-underline tw-border-2 tw-border-solid tw-border-gray-200 hover:tw-bg-gray-100 dark:hover:tw-bg-[#445F74]/20 dark:tw-border-[#7E9AB1] dark:tw-bg-[#445F74]/10 tw-rounded-lg tw-transition-all"
                    >
                        <h3 class="tw-text-2xl font-bold tw-text-[#00101D] dark:tw-text-white tw-text-center">{{ topic['topic'] }}</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, onMounted } from "vue";
import { useUserStore } from "../../stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import PageHeader from '../components/PageHeader/PageHeader';
import GuitareoPack from '../components/GuitareoPack/GuitareoPack';
import ContentCatalogue from '../vuesora/views/catalogues/ContentCatalogue';
import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';

const userStore = useUserStore();
const { userId } = storeToRefs(userStore);

const props = defineProps({
    courses: {
        type: Object,
        default: {},
    },
    guitarQuestPack: {
        type: Object,
        default: {},
    },
    packs: {
        type: Array,
        default: [],
    },
    quickTips: {
        type: Object,
        default: {},
    },
    topics: {
        type: Array,
        default: [],
    },
})

const breadcrumbs = [
    {
        title: "Lesson Packs",
    },
];

const guitarQuestUrl = computed(() => {
    return props.guitarQuestPack.url;
})

const guitarQuestLogo = computed(() => {
    return props.guitarQuestPack.data.find((g) => g.key === 'logo_image_url')?.value;
})

const guitarQuestNextLessonUrl = computed(() => {
    return props.guitarQuestPack.next_lesson_url;
})

const guitarQuestProgress = computed(() => {
    if(Array.isArray(props.guitarQuestPack.user_progress[userId.value]) && props.guitarQuestPack.user_progress[userId.value]?.length === 0) {
        return 'start';
    } else {
        return props.guitarQuestPack.user_progress[userId.value]?.state;
    }
})

onMounted(() => {
    console.log(props.courses)
})
</script>
