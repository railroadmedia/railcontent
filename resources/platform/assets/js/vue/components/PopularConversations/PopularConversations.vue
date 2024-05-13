<template>
    <div class="tw-flex tw-flex-col tw-w-full">
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
            <div class="tw-flex tw-items-center">
                <a :href="`${brand}/forums`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Popular Conversations</h2>
                </a>
            </div>
            <div class="tw-flex tw-items-center">
                <a :href="`${brand}/forums`" aria-label="See All Lessons In Progress" class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-mt-1"> 
                    Forums 
                </a>
            </div>
        </div>
    </div>
</template>
<script setup>
    //Imports
    import { useUserStore } from "../../stores/user";
    import {storeToRefs} from "pinia/dist/pinia";

    //Pinia Stores
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    //Props
    const props = defineProps({

    });

</script>
