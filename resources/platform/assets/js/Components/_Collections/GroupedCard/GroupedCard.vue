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
        <a :href="item.url"
            class="tw-text-[#00101D] dark:tw-text-white tw-uppercase tw-font-bebas-neue xl:tw-text-lg hover:tw-underline"
            style="text-underline-offset: 6px;">
            See All
        </a>
    </div>
    <div class="tw-mb-5">
        <transition appear name="fade">
            <SongCardContainer v-if="contentTypeOverride === 'song'" :preLoadedContent="item.lessons" :isGroupedView="true" :add-margin-bottom="false" />
            <CatalogueCardContainer v-else :pre-loaded-content="item.lessons" :content-type-override="contentTypeOverride" :group-by-cards="true" :is-single-row="true" :no-results-message="noResultsMessage" />
        </transition>
    </div>
</template>
<script setup>
import { computed } from "vue";
import { storeToRefs } from "pinia";
import { useCollectionStore } from "@stores/collection";
import CatalogueCardContainer from "@collections/Catalogue/CatalogueCardContainer";
import SkeletonLoader from '@collections/SkeletonLoader/SkeletonLoader.vue';
import SongCardContainer from "@collections/Catalogue/SongCardContainer.vue";
import { contentTypes } from "../../../utils";

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

const pluralizeWord = (word,  count , plural) => {
    if(count > 1) {
        return plural || word + 's';
    } else {
        return word;
    }
}

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
</script>
