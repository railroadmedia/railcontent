<template>
    <div id="filterPillContainer" 
         class="tw-flex tw-overflow-x-scroll tw-scrolling-touch tw-no-scrollbar tw-gap-[4px] md:tw-gap-[10px] tw-px-[30px]"
    >
        <!-- Page Pills -->           
        <a  v-for="(pill, i) in pills" 
            :key="i"
            :href="pill.url"
            class="tw-btn-primary tw-flex tw-items-center tw-justify-center tw-text-center tw-border tw-text-[#000C17] dark:tw-text-white dark:tw-border-[#445F74] tw-px-4 lg:tw-px-6 tw-mb-0 tw-leading-[1px]"
            :class="[ pill.isActive ? 'tw-bg-[#28282D] dark:tw-bg-[#445F74] tw-text-white' : 'hover:tw-bg-[#E7E7E8] hover:dark:tw-bg-[#223F57] hover:dark:tw-text-white tw-bg-white dark:tw-bg-[#000C17] tw-border-[#CBCBCD] dark:tw-text-white' ]"
        >
            {{ pill.name }}
        </a>
    </div>
</template>
<script setup>
    import { computed, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";

    //Pinia
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);   

    //Props
    const props = defineProps({
        pills: Array, 
    })

    //Computed

    //Lifecycle Hooks
    onBeforeMount( ()=> {
        console.log('component mounted: PillNav')
    })
</script>