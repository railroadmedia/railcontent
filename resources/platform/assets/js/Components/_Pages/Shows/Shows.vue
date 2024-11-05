<template>
    <div>
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <breadcrumb :breadcrumbs="breadcrumbs"></breadcrumb>
            <page-header page-type="shows" title="Shows" icon-name="shows"
                :description="headerDescription"></page-header>
        </div>
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 mv-2">
            <div class="flex flex-row flex-wrap nmh-1">
                <!-- Skeleton Loading -->
                <div v-if="isLoading" v-for="i in 25" class="tw-animate-pulse xs-6 sm-3 lg-2 pa-1" :key="i">
                    <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] corners-10 tw-aspect-square"></div>
                </div>
                <!-- Show cards -->
                <a v-else v-for="(show, index) in shows" :key="index" :href="`${baseUrl}${show.type}`"
                    class="flex flex-column xs-6 sm-3 lg-2 pa-1">
                    <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                        <img :src="show.thumbnailUrl" class="corners-10 tw-transition-opacity tw-opacity-0"
                            :alt="`${show.type} Show Card`" loading="lazy" @load="removeOpacity">
                        <span class="box-hover heading corners-10">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, ref } from 'vue';
import { useUserStore } from "@stores/user";
import { fetchShowsData } from 'musora-content-services';
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia/dist/pinia";

const userStore = useUserStore();
const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const shows = ref([]);

const baseUrl = computed(() => {
    return `${window.location.origin}/${userStore.brand}/`;
});

const removeOpacity = (event) => {
    event.target.classList.remove('tw-opacity-0');
};

const headerDescription = (() => {
  if (userStore.brand === 'drumeo') {
    return "Whether you're looking for drumming inspiration, entertainment, or education, Drumeo Shows has something for everyone.";
  }
  return '';
})();

const breadcrumbs = [
  {
    title: 'Shows',
  },
];

onBeforeMount(async() => {
    const data = await fetchShowsData('drumeo');
    shows.value = data;
    console.log(data)

    platformStore.setLoadingState(false);
})
</script>
