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
        <div class="tw-flex tw-flex-row tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457] ph-1">
            <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white tw-items-center tw-w-full pv-2">
                <h3 class="tw-font-bebas-neue tw-text-base tw-uppercase tw-font-normal tw-text-center">Completion Bonus</h3>
                <span class="heading tw-text-center tw-text-[30px]">
            <i class="fas fa-trophy tw-text-2xl"></i>
             {{ lessonData.xp_bonus || 0 }} XP
        </span>
            </div>
        </div>
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
            default: "",
        },
        userId: {
            type: [String, Number],
            default: null,
        }
    },
    data() {
        return {
            forceIndex: null,
        };
    },
    mounted() {

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
