<script setup>
import Slide from './Slide.vue'
const props = defineProps({
    topSubtitle: {
        type: String,
        default: "",
    },
    title: {
        type: String,
        default: "",
    },
    titleClasses: {
        type: String,
        default: ""
    },
    ctaText: {
        type: String,
        default: "",
    },
    description: {
        type: String,
        default: "",
    },
    ctaUrl: {
        type: String,
        default: "",
    },
    img: {
        type: String,
        default: "",
    },
    showSlide: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div
        class="tw-block tw-border-[0.5px] tw-border-[#344858] tw-w-full tw-h-[276px] tw-border-box tw-rounded-[10px] tw-relative">
        <Slide :showSlide="true" 
                :topSubtitle="topSubtitle" 
                :title="title" 
                :titleClasses="titleClasses"
                :ctaText="ctaText" 
                :description="description" 
                :ctaUrl="ctaUrl" 
                :img="img" 
        />
    </div>
</template>