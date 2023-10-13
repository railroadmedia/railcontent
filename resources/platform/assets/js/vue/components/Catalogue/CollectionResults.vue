<template>
    <div>
        <coaches-grid-catalogue
            :content="collectionStore.data"
            :brand="collectionStore.brand"
        />

        <transition name="show-from-bottom">
            <div
                v-show="collectionStore.loading "
                id="loadingDialog"
                class="flex flex-row align-center"
            >
                <div
                    class="loading-spinner corners-10 shadow pa flex-center"
                    :class="`bg-${collectionStore.brand}`"
                >
                    <i class="fas fa-spinner fa-spin text-white"></i>
                    <p class="tw-text-xs text-white">Loading Please Wait...</p>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
    import { onMounted, onUnmounted } from "vue";
    import CoachesGridCatalogue from "../../vuesora/views/catalogues/CoachesGridCatalogue";
    import { useCollectionStore } from "../../../stores/collection";

    const collectionStore = useCollectionStore();

    const infiniteScrollEventHandler = () => {
        let scrollEl = document.querySelector('#content-container');
        const scroll_position = scrollEl.scrollTop + scrollEl.offsetHeight;
        const scroll_buffer = scrollEl.scrollHeight * 0.9;

        if (scroll_position >= scroll_buffer && collectionStore.filter.currentPage < collectionStore.totalPages) {
            collectionStore.loadMore();
        }
    }

    onMounted(()=>{
        document.querySelector('#content-container').addEventListener("scroll", infiniteScrollEventHandler);
    })

    onUnmounted(()=>{
        document.querySelector('#content-container').removeEventListener("scroll", infiniteScrollEventHandler);
    })
</script>
