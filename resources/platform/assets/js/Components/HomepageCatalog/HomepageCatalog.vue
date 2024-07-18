<template>
    <div class="">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- Section Header -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <a :href="seeAllUrl" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">{{ title }}</h2>
                    </a>
                </div>
                <div class="tw-flex tw-items-center">
                    <a :href="seeAllUrl" :aria-label="seeAllLabel" class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-mt-1"> 
                        See All
                    </a>
                </div>
            </div>
        </div>
        <collection-wrapper
            :collection-type="collectionType"
            :hide-controls-section="true"
            :pre-loaded-content="preLoadedContent"
        ></collection-wrapper>
    </div>
</template>
<script setup>
    import { useUserStore } from "../../Stores/user";
    import {storeToRefs} from "pinia/dist/pinia";

    //Pinia Stores
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    const props = defineProps({
        collectionType: { type: String, default: '' },
        preLoadedContent: { type: Object, default: () => ({}) },
        seeAllLabel: { type: String, default: '' },
        seeAllUrl: { type: String, default: '' },
        title: { type: String, default: '' },
    });
</script>
