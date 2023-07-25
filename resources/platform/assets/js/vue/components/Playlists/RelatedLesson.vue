<script setup>
import { computed } from "vue";
import { PlusIcon } from "@heroicons/vue/outline";

const props = defineProps({
    relatedLesson: {
        type: Object,
        default: {}
    }
});

//-----------Computed Props-----------//

//Title
const relatedLessonTitle = computed(() => {
    const title = props.relatedLesson.fields.find(data => data.key === 'title');
    return title?.value;
})


//Description
const relatedLessonDescription = computed(() => {
    const description = props.relatedLesson.fields.find(data => data.key === 'description');
    return description?.value;
})

//Song Artist
const artist = computed(() => {
    const artist = props.relatedLesson.fields.find(data => data.key === 'artist');
    return artist?.value;
})

//Thumbnail
const relatedLessonThumbnail = computed(() => {
    const thumbnail = props.relatedLesson.data.find(data => data.key === 'original_thumbnail_url');
    return thumbnail ? thumbnail.value : props.relatedLesson.thumbnail_url;
})

const relatedLessonUrl = computed(() => {
    return props.relatedLesson?.web_url_path;
})

//-----------Methods-----------//

//Add Related Lesson
const handleAddRelatedLesson = () => {
    window.openplaylistmodal({
        modalType: 'addItem', brand: props.brand, content: {
            content_id: props.relatedLesson.id,
            brand: props.brand,
            name: relatedLessonTitle.value,
            description: relatedLessonDescription.value,
            thumbnail_url: relatedLessonThumbnail.value,
        }
    });
};
</script>
<template>
    <div class="tw-flex tw-flex-col tw-pt-[24px]">
        <h3 class="tw-text-[18px] tw-text-black tw-font-bold dark:tw-text-white tw-pb-[12px]">Related Lesson</h3>
        <div
            class="tw-flex dark:tw-bg-[#00101D] dark:tw-border-[#223F57] tw-border-[#E0E0E1] tw-border-[1px] tw-rounded-[8px] tw-p-[10px]">
            <a :href="relatedLessonUrl" class="tw-h-[70px]">
                <img :src="`https://musora.com/cdn-cgi/image/width=330/${relatedLessonThumbnail}`"
                    class="tw-h-[70px] tw-rounded" />
            </a>
            <a :href="relatedLessonUrl" class="tw-flex tw-flex-col tw-px-[16px]">
                <div class="tw-text-[12px] tw-text-black dark:tw-text-[#9EC0DC]">
                    <template v-if="props.relatedLesson.route">
                        <span v-for="(route, i) in props.relatedLesson.route" :key="i">
                            {{ route }}<span v-if="i != (props.relatedLesson.route.length - 1)" class="tw-px-1">•</span>
                        </span>
                    </template>
                </div>
                <div class="tw-text-[16px] tw-text-black dark:tw-text-white tw-font-bold">
                    {{ relatedLessonTitle }}
                </div>
                <div class="tw-text-[14px] tw-text-black dark:tw-text-[#9EC0DC]">
                    <template v-if="props.relatedLesson.type !== 'assignment' || props.relatedLesson.type !== 'song'">
                        <span v-for="(instructor, i) in props.relatedLesson.instructors" :key="i">
                            {{ instructor }}<span v-if="i != (props.relatedLesson.instructors.length - 1)">,</span>
                        </span>
                    </template>
                    <template v-if="props.relatedLesson.type === 'song'">
                        <span>{{ artist }}</span>
                    </template>
                </div>
            </a>
            <div class="tw-flex tw-grow tw-justify-end tw-items-center">
                <button @click.prevent="handleAddRelatedLesson" class="tw-mx-[10px] dark:tw-text-white">
                    <PlusIcon class="tw-w-[30px] tw-h-[30px]" />
                </button>
            </div>
        </div>
    </div>
</template>
