<template>
    <!--  Instructor Thumbnail Loader -->
    <SkeletonLoader v-if="collectionStoreLoading" type="card-group-header" />
    <!--  Instructor Thumbnail  -->
    <div v-else class="tw-flex tw-justify-between tw-items-center tw-mb-4">
        <a :href="item.url"
            class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white hover:tw-underline"
            style="text-underline-offset: 6px;">
            <img v-if="thumb" class="tw-rounded-full tw-w-20 tw-h-20 tw-border-2 tw-border-white tw-border-solid tw-mr-[10px]"
                :src="`https://www.musora.com/musora-cdn/image/width=200,quality=95/${thumb}`" :alt="`${name} Image`" />
            <div>
                <h3 class="tw-font-bold tw-text-lg md:tw-text-xl lg:tw-text-2xl">{{ name }}</h3>
                <div class="tw-font-semibold">
                    <span v-if="contentType">{{ item.all_lessons_count }} {{ contentType }}</span>
                    <span v-if="showTotalPlays"> - {{ item.total_plays }} Plays</span>
                </div>
            </div>
        </a>
        <div v-if="showPagination" class="tw-hidden lg:tw-flex">
            <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57] tw-mr-[10px]" :disabled="isFirstPage" @click="prevPage"><ChevronLeftIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
            <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57]" :disabled="isLastPage" @click="nextPage"><ChevronRightIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
        </div>
    </div>
    <div class="tw-mb-5">
        <transition appear name="fade">
            <SongCardContainer v-if="isSong" :preLoadedContent="data" :isGroupedView="true" :add-margin-bottom="false" />
            <CatalogueCardContainer v-else :pre-loaded-content="data" :content-type-override="contentTypeOverride" :group-by-cards="true" :is-single-row="true" :no-results-message="noResultsMessage" />
        </transition>
    </div>
</template>
<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";
import { storeToRefs } from "pinia";
import { useCollectionStore } from "@stores/collection";
import useCarouselEvents from "@hooks/useCarouselEvents";
import CatalogueCardContainer from "@collections/Catalogue/CatalogueCardContainer";
import SkeletonLoader from '@collections/SkeletonLoader/SkeletonLoader.vue';
import SongCardContainer from "@collections/Catalogue/SongCardContainer.vue";
import { contentTypes } from "../../../utils";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
    contentTypeOverride: {
        type: String,
        default: () => '',
    },
    contentTypeTitleSingular: {
        type: String,
        default: () => '',
    },
    contentTypeTitlePlural: {
        type: String,
        default: () => '',
    },
    showTotalPlays: {
        type: Boolean,
        default: () => false,
    },
    noResultsMessage: {
        type: String,
        default: '',
    },
})

const collectionStore = useCollectionStore();
const { loading: collectionStoreLoading } = storeToRefs(collectionStore);

const data = ref([]);
const page = ref(1);
const cardNum = ref(5);

const parsedData = computed(() => {
    return props.item;
})

const name = computed(() => {
    return props.item.fields.find(field => field.key === 'name')?.value || '';
})

const thumb = computed(() => {
    return props.item.data.find(data => data.key === 'head_shot_picture_url')?.value || '';
})

const showSkeletonLoader = computed(() => {
    return collectionStoreLoading.value;
})

const isWorkout = computed(() => {
    return props.contentTypeOverride === 'workout';
})

const isChallenge = computed(() => {
    return props.contentTypeOverride === 'challenge';
})

const isSong = computed(() => {
    return props.contentTypeOverride === 'song';
})

const contentType = computed(() => {
    const type = contentTypes[props.contentTypeOverride];
    if(type){
        return props.item.all_lessons_count > 1 ? type.plural : type.singular;
    }

    //this can be removed when recommendation page needs to display content type
    if(props.contentTypeOverride !== 'Recommendation'){
        return props.item.all_lessons_count > 1 ? 'lessons' : 'lesson';
    }

})

const watchResize = () => {
    if(props.contentTypeOverride === 'song'){
        if(window.innerWidth > 1536){
            cardNum.value = 7;
        } else if(window.innerWidth > 1024){
            cardNum.value = 5;
        } else {
            cardNum.value = 20;
        }
    } else {
        if(window.innerWidth > 1536){
            cardNum.value = 5;
        } else if(window.innerWidth > 1024){
            cardNum.value = 4;
        } else {
            cardNum.value = 20;
        }
    }

    getPageData();
}

onMounted(() => {
    watchResize()
    window.addEventListener('resize', watchResize);
})

onUnmounted(() => {
    window.removeEventListener('resize', watchResize);
})

watch(
    () => props.item.lessons,
    (newList) => {
        setOriginal(newList);
    },
)

const { getPageData, resetProgress, setOriginal, nextPage, prevPage, showPagination, isLastPage, isFirstPage } = useCarouselEvents(props.item.lessons, data, page, cardNum);
</script>
