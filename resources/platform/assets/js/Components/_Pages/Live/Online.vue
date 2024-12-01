<template>
    <div class="tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="tw-pt-[30px]"></div>
        <LiveEmbed
            :api-key="apiKey"
            :chat-channel-name="chatChannelName"
            :embed-url="embedUrl"
            :is-administrator="isAdministrator"
            :lesson-content="lessonContent"
            :lesson-resources="lessonResources"
            :questions-channel-name="questionsChannelName"
            :token="token"
            :youtube-id="youtubeId"
            :user-data="userData"
            :user-id="userId"
            :parent-title="parentTitle"
            :course-url="courseUrl"
        />

        <div class="tw-flex tw-mt-3 tw-flex-col">
            <div v-if="assignments.length" id="lessonInfo" class="tw-flex tw-flex-row tw-items-center">
                <div class="tw-flex tw-flex-col tw-grow tw-shadow">
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-col tw-grow">
                            <ContentAssignment
                                v-for="(assignment, i) in assignments"
                                :key="i"
                                :theme-color="brand"
                                :brand="brand"
                                :timecode="assignment.data.find(a => a.key === 'timecode')?.value"
                                :id="assignment.id"
                                :xp="assignment.xp"
                                :title="assignment.fields.find(a => a.key === 'title')?.value"
                                :soundslice-slug="assignment.fields.find(a => a.key === 'soundslice_slug')?.value"
                                :completed="assignment.completed"
                                :user-id="userId"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-pt-[30px] tw-w-full tw-mb-8">
                <div class="tw-flex tw-flex-row mb-3">
                    <h1 class="heading dark:tw-text-white tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Live Schedule</h1>
                </div>

                <!-- Content Schedule -->
                <div v-if="!isLoading" class="tw-flex tw-flex-row">
                    <ContentSchedule
                        v-if="schedule.length"
                        :preloaded-content="schedule"
                        :subscription-calendar-id="subscriptionCalendarId"
                        :theme-color="brand"
                        :timezone="timezone"
                    />
                    <span class="dark:tw-text-white" v-else>No scheduled releases</span>
                </div>
                <div v-else class="tw-flex-col tw-w-full">
                    <SkeletonListCatalogueItem v-for="i in 8" :key="i" />
                </div>

            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref, onBeforeMount } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import LiveEmbed from '@collections/LiveEmbed/LiveEmbed';
import ContentAssignment from '@vuesora/Components/ContentAssignment/ContentAssignment';
import ContentSchedule from '@vuesora/views/schedule/Schedule';
import { fetchUpcomingEvents } from 'musora-content-services';
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';

//Props
const props = defineProps({
    apiKey: {
        type: String,
        default: '',
    },
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    chatChannelName: {
        type: String,
        default: '',
    },
    embedUrl: {
        type: String,
        default: '',
    },
    courseUrl: {
        type: String,
        default: '',
    },
    isAdministrator: {
        type: Boolean,
        default: false,
    },
    lessonContent: {
        type: Object,
        default: () => {},
    },
    lessonResources: {
        type: Array,
        default: [],
    },
    parentTitle:{
        type: String,
        default: '',
    },
    questionsChannelName: {
        type: String,
        default: '',
    },
    token: {
        type: String,
        default: '',
    },
    youtubeId: {
        type: String,
        default: '',
    },
    userData: {
        type: Object,
        default: () => {},
    },
})

//Pinia
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

//Refs
const schedule = ref([]);
const isLoading = ref(false);

//Computed
const userId = computed(() => {
    return props.userData.id.toString();
})

const assignments = computed(() => {
    return props.lessonContent.assignments || [];
})

//Lifecycles
onBeforeMount(async () => {
    isLoading.value = true;
    try {
        // Fetch upcoming events (assuming this function fetches future scheduled releases)
        const upcomingEvents = await fetchUpcomingEvents(brand.value, {
            page: 1,
            limit: 20,
        });

        schedule.value = upcomingEvents;
        console.log('schedule.value', schedule.value)
    } catch (error) {
        console.error('Error fetching schedule data:', error);
    } finally {
        isLoading.value = false;
    }
});
</script>
