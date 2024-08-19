<template>
    <div class="flex flex-column chapter-thumb pa-1">
        <a
            :href="`/drumeo/${isDigital ? 'drummers-toolbox-digital' : 'drummers-toolbox'}/${chapter['chapter']}`"
            class="square tw-rounded-[3px] tw-bg-center"
            :style="`background-image:url('${chapter['thumbnail']}')`"
        >
            <div class="tw-absolute tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-full tw-h-full">
                <h5 class="body dense tw-text-white tw-uppercase">
                    Chapter {{ chapter['chapter'] }}
                </h5>
                <h4 class="subheading tw-text-white tw-uppercase">
                    {{ chapter['title'] }}
                </h4>
            </div>
            <span class="card-gradient"></span>
        </a>
    </div>
</template>
<script setup>
const props = defineProps({
    chapter:{
        type: Object,
        default: {}
    },
    isDigital: {
        type: Boolean,
        default: true
    },
})
</script>
