<template>
    <div class="tw-w-full tw-relative">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <Breadcrumb :breadcrumbs="[{ title: `${brand} Schedule` }]" />
            <PageHeader 
                pageType="schedule" 
                :title="`${brand} Schedule`" 
                iconName="calendar"
                :description="description" 
                :ctas="ctaConfig" 
            />
        </div>
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <div class="tw-flex tw-flex-col tw-py-[30px]">
                <div id="scheduleHeader"
                    class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                    <a :href="`/${brand}/content-updates`" class="tw-flex tw-mb-3 tw-mr-auto tw-text-[#00101D] dark:tw-text-white hover:tw-border-b">
                        <h1
                            class="heading tw-capitalize tw-mr-2 tw-text-xl md:tw-text-2xl">
                            Scheduled Releases
                        </h1>
                        <ChevronRightIcon class="tw-w-8" />
                    </a>
                    <div class="tw-flex tw-flex-col">
                        <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white"
                            data-open-modal="scheduleAddToCalendarModal">
                            <i class="fas fa-calendar-plus tw-mr-2"></i>
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
import { computed, ref, onBeforeMount } from 'vue';
import { storeToRefs } from "pinia";
import { useUserStore } from "@stores/user";
import ContentSchedule from '@vuesora/views/schedule/Schedule';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import { fetchUpcomingEvents } from 'musora-content-services';
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';
import { ChevronRightIcon } from "@heroicons/vue/solid";

//Pinia
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

//Props
const props = defineProps({
    timezones: {
        type: Array,
        default: () => [],
    },
    selectedTimezone: {
        type: String,
        default: () => '',
    },
    // scheduleData: {
    //     type: Array,
    //     default: () => [],
    // },
    subscriptionCalendarId: {
        type: String,
        default: () => '',
    },
});

//Refs
const schedule = ref([]);
const isLoading = ref(false);

//Computed
const description = computed(() => {
    return `Practice sessions, Q&A, celebrations, and more are available during <span class="tw-capitalize">${brand.value}</span> live lessons. Subscribe to an event or the whole calendar, so you don't miss out!`
})

const ctaConfig = computed(() => {
    return [
        {
            type: 'TimezoneSelectCta',
            props: {
                'timezones': props.timezones,
                'fullTimezoneString': props.selectedTimezone
            }
        },
    ];
});

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

<style scoped media="print">
#nav,
#subNav {
    display: none;
}

#pageHeader {
    display: none;
}

#scheduleHeader {
    display: none;
    border: none;
}

#printSchedule {
    display: none;
}

footer {
    display: none !important;
}

.shadow {
    box-shadow: none !important;
    border: 1px solid #e5e8e8;
}

.content-table-row.scheduled .month-col {
    flex: 0 0 100%;
    max-width: 100%;
}

.content-table-row.scheduled .icon-col {
    display: none;
}

.content-table-row.scheduled .title-column p {
    color: #000 !important;
}

.content-table-row.scheduled .title-column .hide-md-up {
    display: none;
}

.header-gradient-overlay {
    background: linear-gradient(180deg, rgba(0, 16, 29, 0.01) 68.57%, #00101D 100%);
}

.header-gradient-overlay.drumeo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(9, 92, 170, 0.7) 100%);
}

.header-gradient-overlay.pianote {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(213, 8, 29, 0.7) 100%);
}

.header-gradient-overlay.guitareo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(0, 150, 128, 0.7) 100%);
}

.header-gradient-overlay.singeo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(102, 0, 182, 0.7) 100%);
}
</style>
