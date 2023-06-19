<template>
    <div class="flex flex-column tw-w-full">
        <div v-for="(assignment, index) in assignments" :key="assignment.id" class="flex flex-row" dusk="assignments">
            <div class="flex flex-column grow tw-w-full">
                <ContentAssignment
                    :lesson-thumbnail="lessonThumbnail"
                    :lesson-title="lessonTitle"
                    :lesson-id="lessonId"
                    :theme-color="assignment.themeColor"
                    :brand="assignment.themeColor"
                    :timecode="assignment.timecode"
                    :id="assignment.id"
                    :title="assignment.title"
                    :soundslice-slug="assignment.soundsliceSlug"
                    :completed="assignment.completed"
                    :user-id="assignment.userId"
                    :position="index"
                    :force-open="forceIndex === index"
                    :disable-prev="assignments[index - 1] && !assignments[index - 1].soundsliceSlug"
                    :disable-next="assignments[index + 1] && !assignments[index + 1].soundsliceSlug"
                    v-on:force-prev="forceIndex = forceIndex - 1"
                    v-on:force-next="forceIndex = forceIndex + 1"
                    v-on:force-current="forceIndex = index"
                >
                </ContentAssignment>
            </div>
        </div>
        <slot name="completion-bonus"></slot>
    </div>
</template>

<script>
import ContentAssignment from '../ContentAssignment/ContentAssignment';

export default {
    name: 'AssignmentsContainer',
    components: {
        ContentAssignment,
    },
    props: {
        assignments: {
            type: Array,
            default: () => [],
        },
        lessonData: {
            type: Object,
        },
    },
    data() {
        return {
            forceIndex: null,
        };
    },
    mounted() {
        console.log('lessonData: ', this.lessonData)
    },
    computed: {
        //Thumbnail
        lessonThumbnail() {
            const thumbnail = this.lessonData['data'].find(data => data.key === 'thumbnail_url');
            return thumbnail.value;
        },
        lessonTitle() {
            const title = this.lessonData['fields'].find(data => data.key === 'title');
            return title.value;
        },
        lessonId() {
            return this.lessonData['id'];
        },
    }

};
</script>
