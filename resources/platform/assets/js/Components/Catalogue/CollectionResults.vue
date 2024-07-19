<template>
    <div class="tw-mb-[30px]">
        <div v-if="showEmptyState" class="dark:tw-text-white">
            We couldn't find what you're looking for. Please try again!
        </div>
        <div v-else-if="singeoPackState" class="dark:tw-text-white">
            Coming May 6th For Non-Enrolled Members!
        </div>
        <slot v-else></slot>

        <transition name="show-from-bottom">
            <div v-show="loading" id="loadingDialog" class="flex flex-row align-center">
                <div class="loading-spinner corners-10 shadow pa tw-flex tw-justify-center tw-items-center bg-white">
                    <i class="fas fa-spinner fa-spin text-black"></i>
                    <p class="tw-font-bold tw-text-md text-black tw-ml-3">Loading Please Wait...</p>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import {computed, onMounted, onUnmounted, onUpdated} from "vue";
import { storeToRefs } from "pinia";
import { useCollectionStore } from "../../Stores/collection";

const props = defineProps({
    content: {
        type: Array,
        default: [],
    },
    currentPage: {
        type: Number,
        default: 1,
    },
    infiniteScroll: {
        type: Boolean,
        default: true,
    },
    searchTerm: {
        type: String,
        default: '',
    },
    selectedFilters: {
        type: Array,
        default: () => [],
    },
    selectedProgress: {
        type: String,
        default: '',
    },
    totalPages: {
        type: Number,
        default: 1,
    },
    //delete this prop after May 6th
    contentType: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['onLoadMore']);

const collectionStore = useCollectionStore();
const { loading } = storeToRefs(collectionStore);

const infiniteScrollEventHandler = () => {
    let scrollEl = document.querySelector('#content-container');
    const scroll_position = scrollEl.scrollTop + scrollEl.offsetHeight;
    const scroll_buffer = scrollEl.scrollHeight * 0.8;

    if (scroll_position >= scroll_buffer && props.currentPage < props.totalPages) {
        emit('onLoadMore');
    }
}

//delete 79-84 lines after May 6th
import { useUserStore } from "../../Stores/user";
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const singeoPackState = computed(() => {
    return brand.value === 'singeo' && props.contentType === 'pack' && props.content.length === 0 && !loading.value && !(props.searchTerm || Object.keys(props.selectedFilters).length > 0 || props.selectedProgress)
})

const showEmptyState = computed(() => {
    return (props.searchTerm || Object.keys(props.selectedFilters).length > 0 || props.selectedProgress) && !loading.value && props.content.length === 0;
})

onMounted(()=>{
    props.infiniteScroll && infiniteScrollEventHandler();
    props.infiniteScroll && document.querySelector('#content-container').addEventListener("scroll", infiniteScrollEventHandler);
})

onUnmounted(()=>{
    props.infiniteScroll && document.querySelector('#content-container').removeEventListener("scroll", infiniteScrollEventHandler);
})

onUpdated(() => {
    props.infiniteScroll && infiniteScrollEventHandler();
})
</script>
