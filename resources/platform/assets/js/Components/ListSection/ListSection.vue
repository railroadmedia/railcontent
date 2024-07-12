<template>
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-grow tw-w-full">
            <!-- Section Title -->
            <div class="tw-px-4 lg:tw-px-0 tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <a @click="handleSeeAllClick" :href="myListUrl"
                    class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Playlists</h2>
                </a>
                <a @click="handleSeeAllClick" :href="myListUrl" aria-label="See All Playlists"
                    class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    See All
                </a>
            </div>
            <PlaylistCollectionCatalog :mini-catalog="true"
                :playlist-count="usersList.length" :playlists="usersList" trackingSection="playlists" />

        </div>
    </section>
</template>

<script setup>
import PlaylistCollectionCatalog from '../Playlists/PlaylistCollection/PlaylistCollectionCatalog.vue';
import { useUserStore } from '../../Stores/user';
import userJourney from '../../Services/userJourney';

const userStore = useUserStore();

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
</script>
../../Services/userJourney