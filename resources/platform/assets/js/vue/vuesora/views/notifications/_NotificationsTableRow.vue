<template>
    <a
        :href="linkedContent.url"
        class="content-table-row tw-flex tw-flex-row bt-grey-1-1 pa-1 relative no-decoration"
        :class="{'is-read': isRead}"
        @click="markAsRead(false)"
    >
        <div class="tw-flex tw-flex-col avatar-col tw-justify-center">
            <div
                class="thumb-img square tw-rounded tw-bg-center"
            >
                <img
                    src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                    :data-ix-src="userAvatar"
                    data-ix-fade
                    alt="User Avatar"
                    class="rounded"
                >
            </div>
        </div>

        <div class="tw-flex tw-flex-col tw-justify-center ph-1 title-column overflow">

            <p class="tiny tw-text-black item-title">
                <span class="tw-font-bold">{{ userName }}</span>

                {{ notificationTypeString }}

                <span class="tw-font-bold">{{ linkedContent.title }}</span>
            </p>

            <p
                v-html="subContent"
                class="tiny tw-text-black tw-mt-1"
            >
            </p>

            <p
                class="tiny text-grey-3 tw-italic tw-mt-1"
                style="font-size: 8pt;"
            >
                {{ createdOn }}
            </p>
        </div>

        <div class="tw-flex tw-flex-col icon-col align-v-center">
            <div
                class="body"
                title="Mark as Read"
                @click.stop.prevent="markAsRead(true)"
            >
                <i class="far fa-eye tw-flex-center text-grey-2 tw-rounded read-icon"></i>
            </div>
        </div>

        <div class="tw-flex tw-flex-col icon-col align-v-center">
            <div class="body">
                <i class="fas fa-arrow-circle-right tw-flex-center text-grey-2 tw-rounded"></i>
            </div>
        </div>
    </a>
</template>
<script>
export default {
    name: 'NotificatonsTableRow',
    props: {
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
    },
    computed: {
        notificationTypeString() {
            switch (this.notificationType) {
            case 'comment-reply':
                return 'replied to your lesson comment on:';
            case 'comment-like':
                if (this.userName == '1') {
                    return 'person liked your lesson comment on:';
                } 
                return ' liked your lesson comment on:';
                        
            case 'forum-reply':
                return 'replied to your forum post in:';
            case 'forum-like':
                if (this.userName == '1') {
                    return 'person liked your forum post in:';
                } 
                return ' liked your forum post in:';
                        
            case 'thread-reply':
                return 'posted in a forum thread you follow:';
            }
        },
    },
    methods: {
        markAsRead(canCancel = true) {
            this.$emit('notificationRead', {
                id: this.id,
                isRead: this.isRead,
                canCancel,
            });
        },
    },
};
</script>
