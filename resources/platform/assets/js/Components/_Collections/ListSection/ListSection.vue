<template>
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-grow tw-w-full">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-w-full tw-justify-between">
                <a @click="handleSeeAllClick" :href="myListUrl"
                    class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-[20px] tw-leading-[30px] lg:tw-leading-[36px] lg:tw-text-[24px]">My Playlists</h2>
                    <ChevronRightIcon class="tw-w-5" />
                </a>
                <div class="tw-flex tw-items-center">
                    <slot name="icon"></slot>
                    <div v-if="showPagination" class="tw-hidden lg:tw-flex">
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57] tw-mr-[10px]" :disabled="isFirstPage" @click="prevPage"><ChevronLeftIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57]" :disabled="isLastPage" @click="nextPage"><ChevronRightIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                    </div>
                </div>
            </div>
            <PlaylistCollectionCatalog :mini-catalog="true"
                :playlist-count="usersList.length" :playlists="data" trackingSection="playlists" :mini-view-page="page" :mini-view-card-num="cardNum" />

        </div>
    </section>
</template>

<script setup>
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useUserStore } from '@stores/user';
import userJourney from '@services/userJourney';
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import useCarouselEvents from "@hooks/useCarouselEvents";

import PlaylistCollectionCatalog from '@collections/Playlists/PlaylistCollection/PlaylistCollectionCatalog.vue';

const props = defineProps({
    myListUrl: {
        type: String,
        default: ''
    },
    contentEndpoint: {
        type: String,
        default: '/railcontent/content'
    },
    usersList: {
        type: Array,
        default: []
    }
});

const userStore = useUserStore();

const data = ref([]);
const page = ref(1);
const cardNum = ref(5);

const handleSeeAllClick = (event) => {
  if (props.myListUrl) {
    event.preventDefault();

    userJourney.trackHomeSeeAll({
      token: userStore.token,
      payload: {
        brand: userStore.brand,
        section: 'playlists',
      }
    }).finally(() => {
      window.location.href = props.myListUrl;
    });
  }
};

const watchResize = () => {
    if(window.innerWidth > 1536){
        cardNum.value = 6;
    } else if(window.innerWidth > 1024){
        cardNum.value = 5;
    } else {
        cardNum.value = 12;
    }


    getPageData();
}

onMounted(() => {
    watchResize();
    window.addEventListener('resize', watchResize);
})

onUnmounted(() => {
    window.removeEventListener('resize', watchResize);
})

watch(
    () => props.usersList,
    (newList) => {
        setOriginal(newList);
    },
)

const { getPageData, setOriginal, nextPage, prevPage, showPagination, isFirstPage, isLastPage } = useCarouselEvents(props.usersList, data, page, cardNum);
</script>
