<template>
    <div class="flex flex-column tw-w-full">
        <div v-for="(assignment, index) in assignments" :key="assignment.id" class="flex flex-row" dusk="assignments">
            <div class="flex flex-column grow tw-w-full">
                <ContentAssignment
                    :lesson-thumbnail="lessonThumbnail"
                    :lesson-title="lessonTitle"
                    :lesson-id="lessonId"
                    :theme-color="brand"
                    :brand="brand"
                    :timecode="assignment.data.find((t) => t.key === 'timecode') ? assignment.data.find((t) => t.key === 'timecode').value : 0"
                    :id="assignment.id"
                    :title="assignment.title"
                    :soundslice-slug="assignment.soundslice_slug"
                    :completed="assignment.completed"
                    :user-id="userId"
                    :position="index"
                    :force-open="forceIndex === index"
                    :disable-prev="assignments[index - 1] && !assignments[index - 1].soundslice_slug"
                    :disable-next="assignments[index + 1] && !assignments[index + 1].soundslice_slug"
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
        brand: {
            type: String,
            default: 'drumeo',
        },
        testData: {
            type: Array,
            default: () => [],
        },
        userId: {
            type: Number,
            default: null,
        }
    },
    data() {
        return {
            forceIndex: null,
        };
    },
    mounted() {
        console.log('lessonData: ', this.lessonData);
        console.log('test', this.testData)
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
