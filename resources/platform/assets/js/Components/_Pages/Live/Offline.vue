<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs"/>
        <PageHeader
            :page-type="headerPageType"
            :icon-name="headerIconName"
            :title="headerTitle"
            :ctas="headerCtas"
            :description="`Practice sessions, Q&A, celebrations, and more are available during ${brand} live lessons. Subscribe to an event or the whole calendar, so you don't miss out!`"
        />

        <div class="tw-flex tw-flex-col mv-3">
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl md:tw-text-2xl">
                        Upcoming Live Events
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" data-open-modal="scheduleAddToCalendarModal">
                        <i class="fas fa-calendar-plus mr-1"></i>
                        Subscribe to Calendar
                    </button>
                </div>
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

            <!-- Loading Skeleton -->
            <div v-else class="tw-flex-col tw-w-full">
                <SkeletonListCatalogueItem v-for="i in 8" :key="i" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import ContentSchedule from '@vuesora/views/schedule/Schedule';
import { computed, ref, onBeforeMount } from "vue";
import { fetchUpcomingEvents } from 'musora-content-services';
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';

const props = defineProps({
    headerPageType: {
        type: String,
        default: '',
    },
    headerIconName: {
        type: String,
        default: '',
    },
    headerTitle: {
        type: String,
        default: '',
    },
    headerCtas: {
        type: Array,
        default: () => [],
    },
    subscriptionCalendarId: {
        type: String,
        default: '',
    },
    timezone: {
        type: String,
        default: '',
    },
});

//Pinia
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = [
    {
        title: 'Live',
    }
];

// Refs
const schedule = ref([]);
const isLoading = ref(false);

// Lifecycles
onBeforeMount(async () => {
    isLoading.value = true;
    try {
        const upcomingEvents = await fetchUpcomingEvents(brand.value, {
            page: 1,
            limit: 20,
        });

        schedule.value = Array.isArray(upcomingEvents) ? upcomingEvents : [];
    } catch (error) {
        console.error('Error fetching schedule data:', error);
    } finally {
        isLoading.value = false;
    }
});
</script>
