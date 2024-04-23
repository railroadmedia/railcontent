<template>
    <a :href="linkedContent.url"
        class="tw-flex tw-flex-col md:tw-flex-row dark:tw-bg-transparent tw-border-b-[#223F57] tw-border-b-[1px] relative no-decoration tw-justify-between dark:tw-text-white tw-py-[24px]"
        :class="isRead ? 'tw-bg-[#e4e4e7] dark:tw-bg-[#102230]' : ''">
        <div class="tw-flex">
            <div class="tw-flex tw-flex-col md:tw-justify-center">
                <div class="tw-rounded-full tw-w-[82px] tw-h-[82px] tw-mr-[12px]">
                    <!-- User Avatar -->
                    <img :src="userAvatar"
                         alt="User Avatar"
                         loading="lazy"
                         class="tw-rounded-full tw-transition-opacity tw-duration-500"
                         :class="linkedContent.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                         @load="linkedContent.imageLoaded = true"
                    >
                </div>

            </div>

            <div class="tw-flex tw-flex-col tw-justify-center overflow">

                <p class="tw-text-[16px] tw-text-[#00101D] dark:tw-text-white">
                    <span class="tw-font-bold">{{ userName }}</span>

                    {{ notificationTypeString }}

                    <span class="tw-font-bold">{{ linkedContent.title }}</span>
                </p>

                <p v-html="subContent" class="tw-text-[16px] dark:tw-text-white tw-text-[#00101D] tw-mt-[3px]">
                </p>

                <p class="tw-text-[14px] tw-text-[#00101D] dark:tw-text-[#9ec0dc] tw-italic tw-mt-[4px]">
                    {{ createdOn }}
                </p>
            </div>

        </div>
        <div class="tw-flex tw-mt-2 md:tw-mt-0 tw-justify-end tw-items-center tw-w-full md:tw-w-auto">
            <div tabindex="0" class="tw-inline-flex tw-justify-center tw-items-center tw-w-[51px] tw-h-[58px] tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-cursor-pointer" title="Delete" @click.stop.prevent="deleteNotification(id)">
                <TrashIcon class="tw-w-[23px] tw-h-[23px] tw-text-[#3F3F46] dark:tw-text-[#9ec0dc]" />
            </div>
            <div tabindex="0" class="tw-inline-flex tw-justify-center tw-items-center tw-w-[51px] tw-h-[58px] tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-cursor-pointer" :title="isRead ? 'Mark as Unread' : 'Mark as Read'" @click="toggleReadNotification">
                <EyeIcon v-if="!isRead" class="tw-w-[23px] tw-h-[23px] tw-text-[#3F3F46] dark:tw-text-[#9ec0dc]" />
                <EyeOffIcon v-if="isRead" class="tw-w-[23px] tw-h-[23px] dark:tw-text-[#9ec0dc]" />
            </div>
            <div tabindex="0" class="tw-inline-flex tw-justify-center tw-items-center tw-w-[51px] tw-h-[58px] tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-cursor-pointer" title="See notification">
                <ArrowCircleRightIcon class="tw-w-[23px] tw-h-[23px] tw-text-[#3F3F46] dark:tw-text-[#9ec0dc]" />
            </div>
        </div>
    </a>
</template>
<script setup>
import axios from 'axios';
import { borderColor } from '../../../../constants/brands';
import { computed } from 'vue';
import { TrashIcon, EyeIcon, EyeOffIcon, ArrowCircleRightIcon } from '@heroicons/vue/solid';

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

function toggleReadNotification(e) {
    e.preventDefault();

    emit('notificationRead', {
        id: props.id,
        isRead: props.isRead,
        canCancel: true,
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
</script>
