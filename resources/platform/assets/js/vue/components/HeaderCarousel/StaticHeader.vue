<script setup>
import Slide from './Slide.vue'
const props = defineProps({
    topsubtitle: {
        type: String,
        default: "",
    },
    title: {
        type: String,
        default: "",
    },
    titleclasses: {
        type: String,
        default: ""
    },
    ctatext: {
        type: String,
        default: "",
    },
    description: {
        type: String,
        default: "",
    },
    ctaurl: {
        type: String,
        default: "",
    },
    img: {
        type: String,
        default: "",
    },
    showslide: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div
        class="tw-block tw-border-[0.5px] tw-border-[#344858] tw-w-full tw-h-[276px] tw-border-box tw-rounded-[10px] tw-relative">
        <Slide :showSlide="true" 
                :topSubtitle="topsubtitle" 
                :title="title" 
                :titleClasses="titleclasses"
                :ctaText="ctatext" 
                :description="description" 
                :ctaUrl="ctaurl" 
                :img="img" 
        />
    </div>
</template>