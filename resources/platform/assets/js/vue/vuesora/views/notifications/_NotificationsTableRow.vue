<template>
    <a :href="linkedContent.url"
        class="tw-flex tw-flex-row dark:tw-bg-[#00101D] tw-border-b-[#223F57] tw-border-b-[1px] relative no-decoration tw-justify-between dark:tw-text-white tw-py-[24px]"
        :class="isRead ? 'tw-bg-[#e5e7eb] dark:tw-bg-[#00101D]' : ''" @click="markAsRead(false)">
        <div class="tw-flex">
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div class="tw-rounded-full tw-w-[82px] tw-h-[82px] tw-border-[2px] tw-mr-[12px]" :class="borderColor[brand]">
                    <img src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                        :data-ix-src="userAvatar" data-ix-fade alt="User Avatar" class="rounded">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-justify-center overflow">

                <p class="tw-text-[16px] tw-text-black dark:tw-text-white">
                    <span class="tw-font-bold">{{ userName }}</span>

                    {{ notificationTypeString }}

                    <span class="tw-font-bold">{{ linkedContent.title }}</span>
                </p>

                <p v-html="subContent" class="tw-text-[16px] dark:tw-text-white tw-text-black tw-mt-[3px]">
                </p>

                <p class="tw-text-[14px] tw-text-black dark:tw-text-[#9ec0dc] tw-italic tw-mt-[4px]">
                    {{ createdOn }}
                </p>
            </div>

        </div>
        <div class="tw-flex">
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div title="Delete" @click.stop.prevent="deleteNotification(id)">
                    <TrashIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div  title="Mark as Read" @click.stop.prevent="markAsRead(true)">
                    <EyeIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
            <div class="tw-flex tw-flex-col tw-justify-center">
                <div title="Jump to Post">
                    <ArrowCircleRightIcon class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc] tw-ml-[35px]" />
                </div>
            </div>
        </div>
    </a>
</template>
<script setup>
import axios from 'axios';
import { borderColor } from '../../../../constants/brands';
import { computed, onMounted } from 'vue'
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
    brand: {
        type: String,
        default: 'drumeo'
    }
});

const emit = defineEmits('notificationRead');

const notificationTypeString = computed(() => {
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

function deleteNotification(id) {
    axios.delete(window.ENDPOINT_PREFIX+'/railnotifications/notification/'+id)
        .then(() => {
            location.reload();
        })
        .catch((e) => {
            console.error(e);
        });
}

onMounted(() => {
    console.log(Object.entries(props))
})

</script>
