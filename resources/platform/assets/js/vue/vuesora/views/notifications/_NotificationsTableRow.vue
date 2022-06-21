<template>
    <a :href="linkedContent.url"
        class="tw-flex tw-flex-row tw-bg-[#00101D] tw-border-b-[#223F57] tw-border-b-[1px] relative no-decoration tw-justify-between dark:tw-text-white"
        :class="{ 'is-read': isRead }" @click="markAsRead(false)">
        <div class="tw-flex">
            <div class="tw-flex tw-flex-col avatar-col tw-justify-center">
                <div class="tw-rounded-full">
                    <img src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                        :data-ix-src="userAvatar" data-ix-fade alt="User Avatar" class="rounded">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-justify-center ph-1 title-column overflow">

                <p class="tiny tw-text-black dark:tw-text-white item-title">
                    <span class="tw-font-bold">{{ userName }}</span>

                    {{ notificationTypeString }}

                    <span class="tw-font-bold">{{ linkedContent.title }}</span>
                </p>

                <p v-html="subContent" class="tiny dark:tw-text-white tw-text-black tw-mt-1">
                </p>

                <p class="tiny text-grey-3 dark:tw-text-[#9ec0dc] tw-italic tw-mt-1" style="font-size: 8pt;">
                    {{ createdOn }}
                </p>
            </div>

        </div>
        <div class="tw-flex">
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div class="body" title="Delete">
                    <TrashIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div class="body" title="Mark as Read" @click.stop.prevent="markAsRead(true)">
                    <EyeIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div class="body">
                    <ArrowCircleRightIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
        </div>
    </a>
</template>
<script setup>
import { computed } from 'vue'
import { TrashIcon, EyeIcon, ArrowCircleRightIcon } from '@heroicons/vue/solid'
const props = defineProps({
    createdOn: {
        type: String,
        default: () => '',
    },
    subContent: {
        type: String,
        default: () => '',
    },
    id: {
        type: Number,
        default: () => 0,
    },
    isRead: {
        type: Boolean,
        default: () => false,
    },
    userAvatar: {
        type: String,
        default: () => '',
    },
    userName: {
        type: String,
        default: () => '',
    },
    linkedContent: {
        type: Object,
        default: () => ({
            title: '',
            url: '',
        }),
    },
    notificationType: {
        type: String,
        default: () => '',
    },
});

const emit = defineEmits('notificationRead');

const notificationTypeString = computed(() => {
    console.log(props.notificationType)
    switch (props.notificationType) {
        case 'comment-reply':
            return 'replied to your lesson comment on:';
        case 'comment-like':
            if (props.userName == '1') {
                return 'person liked your lesson comment on:';
            }
            return ' liked your lesson comment on:';

        case 'forum-reply':
            return 'replied to your forum post in:';
        case 'forum-like':
            if (props.userName == '1') {
                return 'person liked your forum post in:';
            }
            return ' liked your forum post in:';

        case 'thread-reply':
            return 'posted in a forum thread you follow:';
    }
});

function markAsRead(canCancel = true) {
    emit('notificationRead', {
        id: props.id,
        isRead: props.isRead,
        canCancel,
    });
}

</script>
