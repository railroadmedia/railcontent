<template>
    <div class="lessons-pack-card flex flex-row ph-1 pt-3">
        <div class="flex flex-column align-v-center large-thumbnail">
            <div class="thumb-wrap corners-10">
                <a :href="packUrl">
                    <div class="thumb-img bg-center corners-10 square bg-grey-2 dark:tw-bg-[#081825]">
                        <img
                            :src="thumbnail"
                            :alt="`${title} Thumbnail`"
                            class="tw-transition-opacity tw-opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />

                        <div v-if="logo" class="logo-image pa-1 corners-bottom-3">
                            <img
                                :src="logo"
                                :alt="`${title} Logo`"
                            />
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex flex-column align-h-center mt-1">
                <a
                    :href="nextUrl"
                    class="tw-btn-primary tw-bg-guitareo hover:tw-bg-guitareo-600"
                >
                    <template v-if="progress === 'started'">
                        <i class="fas fa-play tw-mr-[10px]"></i>
                        Next Lesson
                    </template>
                    <template v-else-if="progress === 'completed'">
                        <i class="fas fa-check-circle tw-mr-[10px]"></i>
                        Completed
                    </template>
                    <template v-else>
                        <i class="fas fa-play tw-mr-[10px]"></i>
                        First Lesson
                    </template>
                </a>

                <a
                    :href="packUrl"
                    class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white"
                >
                    <i class="fas fa-arrow-circle-right mr-1"></i> See Lessons
                </a>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    pack: {
        type: Object,
        default: {},
    },
    userId: {
        type: Number,
        default: 0,
    },
})

const packUrl = computed(() => {
    return props.pack.url;
})

const thumbnail = computed(() => {
    return props.pack.data?.find((p) => p.key === 'thumbnail_url')?.value;
})

const title = computed(() => {
    return props.pack.fields?.find((p) => p.key === 'title')?.value;
})

const logo = computed(() => {
    return props.pack.data?.find((p) => p.key === 'logo_image_url')?.value;
})

const nextUrl = computed(() => {
    return props.pack.next_lesson_url;
})

const progress = computed(() => {
    if(Array.isArray(props.pack.user_progress[props.userId]) && props.pack.user_progress[props.userId]?.length === 0) {
        return 'start';
    } else {
        return props.pack.user_progress[props.userId]?.state;
    }
})
</script>
