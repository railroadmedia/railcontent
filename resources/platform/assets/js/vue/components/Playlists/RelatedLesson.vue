<script setup>
import {computed} from "vue";

const props = defineProps({
    relatedLesson: {
        type: Object,
        default: {}
    }
});

//-----------Computed Props-----------//

//Title
const relatedLessonTitle = computed( () => {
    const title = props.relatedLesson.fields.find(data => data.key === 'title');
    return title.value;
})
//Song Artist
const artist = computed( () => {
    const artist = props.relatedLesson.fields.find(data => data.key === 'artist');
    return artist.value;
})

//Thumbnail
const relatedLessonThumbnail = computed( () => {
    const thumbnail = props.relatedLesson.data.find(data => data.key === 'original_thumbnail_url');
    return thumbnail ? thumbnail.value : props.relatedLesson.thumbnail_url;
})
</script>
<template>
    <div class="tw-flex tw-flex-col tw-py-[32px]">
        <h3 class="tw-text-[18px] tw-font-bold dark:tw-text-white tw-pb-[12px]">Related Lesson</h3>
        <div class="tw-flex">
        <div class="tw-h-[70px]">
            <img  :src="`https://musora.com/cdn-cgi/image/width=330/${relatedLessonThumbnail}`" class="tw-h-[70px] tw-rounded" />
        </div>
        <div class="tw-flex tw-flex-col tw-px-[16px]">
            <div class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                <template v-if="props.relatedLesson.route">
                        <span  v-for="(route, i) in props.relatedLesson.route"
                               :key="i">
                                {{ route }}<span v-if="i != (props.relatedLesson.route.length - 1)" class="tw-px-1">•</span>
                        </span>
                </template>
            </div>
            <div class="tw-text-[16px] tw-text-white tw-font-bold">
                {{ relatedLessonTitle }}
            </div>
            <div class="tw-text-[12px] dark:tw-text-[#9EC0DC]">
                <template v-if="props.relatedLesson.type !== 'assignment' || props.relatedLesson.type !== 'song'">
                        <span v-for="(instructor, i) in props.relatedLesson.instructors"
                              :key="i">
                               {{ instructor }}<span v-if="i != (props.relatedLesson.instructors.length - 1)">,</span>
                        </span>
                </template>
                <template v-if="props.relatedLesson.type === 'song'">
                    <span>{{ artist }}</span>
                </template>
            </div>
        </div>
    </div>
    </div>
</template>
