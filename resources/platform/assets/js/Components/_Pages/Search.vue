<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-py-12">
        <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-flex tw-items-center tw-mb-3">
            <a href="javascript:history.back()" class="tw-no-underline tw-inline-flex tw-items-center tw-text-[#00101D] dark:tw-text-white">
                <i class="fas fa-arrow-circle-left tw-text-2xl tw-mr-2"></i>
            </a>
            Search Results
        </h1>

        <div class="tw-flex tw-flex-row bb-grey-1-1 dark:tw-border-[#223457] ">
            <ContentCatalogue
                search-endpoint="/railcontent/search"
                :brand="brand"
                catalogue-type="list"
                limit="20"
                :included-types="includedTypes"
                :force-wide-thumbs="true"
                :theme-color="brand"
                :use-theme-color="true"
                :pre-loaded-content="preLoadedContent"
                :user-id="userId.toString()"
                :search-bar="true"
                sort-override="-score"
                :use-url-params="true"
                :paginate="true"
                :total-results="totalResults"
                :show-loading-animation="true"
            />
        </div>
    </div>
</template>
<script setup>
import { useUserStore } from "../../Stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import ContentCatalogue from "../../Libraries/Vuesora/views/catalogues/ContentCatalogue";

const props = defineProps({
    includedTypes: {
        type: Array,
        default: () => [],
    },
    preLoadedContent: {
        type: Object,
        default: () => {},
    },
    totalResults: {
        type: [String, Number],
        default: () => 0,
    },
})

const userStore = useUserStore();
const { brand, userId } = storeToRefs(userStore);
</script>

