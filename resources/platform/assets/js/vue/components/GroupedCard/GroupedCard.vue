<template>
    <!--  Instructor Thumbnail Loader -->
    <SkeletonLoader v-if="collectionStoreLoading" type="card-group-header" />
    <!--  Instructor Thumbnail  -->
    <div v-else class="tw-flex tw-justify-between tw-items-center tw-mb-4 tw-mx-4 lg:tw-mx-0">
        <a :href="item.web_url_path + '?included_types[]=Workout'"
            class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white hover:tw-underline"
            style="text-underline-offset: 6px;">
            <img class="tw-rounded-full tw-w-20 tw-h-20 tw-border-2 tw-border-white tw-border-solid tw-mr-[10px]"
                :src="`https://www.musora.com/musora-cdn/image/width=200/${thumb}`" :alt="`${name} Image`" />
            <div>
                <h3 class="tw-font-bold tw-text-lg md:tw-text-xl">{{ name }}</h3>
                <div class="tw-font-semibold">{{ item.all_lessons_count }} Workouts</div>
            </div>
        </a>
        <a :href="item.web_url_path + '?included_types[]=Workout'"
            class="tw-text-[#00101D] dark:tw-text-white tw-uppercase tw-font-bebas-neue xl:tw-text-lg hover:tw-underline"
            style="text-underline-offset: 6px;">
            See All
        </a>
    </div>

    <div class="tw-mb-[14px] lg:tw-mb-[6px]">
        <transition appear name="fade">
            <CatalogueCardContainer :pre-loaded-content="item.lessons" :content-type-override="contentTypeOverride" :group-by-cards="true" />
        </transition>
    </div>
</template>
<script setup>
import { computed } from "vue";
import { storeToRefs } from "pinia";
import { useCollectionStore } from "../../../stores/collection";
import CatalogueCardContainer from "../Catalogue/CatalogueCardContainer";
import SkeletonLoader from '../SkeletonLoader/SkeletonLoader.vue';

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
    contentTypeOverride: {
        type: String,
        default: () => '',
    }
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
</script>
