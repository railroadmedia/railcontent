<template>
    <div ref="container" 
        class="tw-mx-auto tw-w-full 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-flex tw-overflow-x-scroll tw-scrolling-touch tw-no-scrollbar tw-gap-[4px] md:tw-gap-[10px] tw-px-4 md:tw-px-[30px]"
        @mousemove.prevent="move"
        @mousedown="startDragging"
        @mouseup="stopDragging"
        @mouseleave="stopDraggin"
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
    import { ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";

    //Pinia
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);   

    //Props
    const props = defineProps({
        pills: Array, 
    })

    //Refs
    const mouseDown = ref(false);
    const startX = ref(null);
    const scrollLeft = ref(null);
    const container = ref(null);

    //Methods
    const startDragging = (e) => {
        mouseDown.value = true;
        startX.value = e.pageX - container.value.offsetLeft;
        scrollLeft.value = container.value.scrollLeft;
    }

    const stopDragging = (e) => {
        mouseDown.value = false;
    }

    const move = (e) => {
        if(!mouseDown.value) { return; }
        const x = e.pageX - container.value.offsetLeft;
        const scroll = x - startX.value;
        container.value.scrollLeft = scrollLeft.value - scroll;
    }

    //Lifecycle Hooks
    onBeforeMount( ()=> {
        //console.log('component mounted: PillNav')
    })

    //Methods
</script>