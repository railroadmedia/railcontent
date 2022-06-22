<template>
    <div class="tw-flex tw-flex-col">
        <div class="tw-flex tw-flex-row pv-3 tw-items-center tw-flex-wrap">
            <div class="tw-flex tw-flex-col">
                <h1 class="heading">
                    Notifications
                </h1>
            </div>

            <div class="tw-flex tw-flex-col">
                <a :href="settingsUrl" class="tw-btn-secondary" :class="bgColor[brand]">
                    <CogIcon class="tw-h-[22px] tw-w-[22px] tw-mr-[12px]" />
                    My Settings
                </a>
            </div>

            <div class="tw-flex tw-flex-col">
                <button class="tw-btn-primary tw-h-[50px] tw-text-white" :class="bgColor[brand]" :disabled="!hasUnread"
                    @click.stop="markAllAsRead">
                    <EyeIcon class="tw-h-[22px] tw-w-[22px] tw-mr-[12px]" />
                    Mark All As Read

                </button>
            </div>
        </div>

        <div v-if="notifications.length === 0" class="tw-flex tw-flex-row pa-3">
            <p class="tiny text-grey-3 tw-italic">
                You do not appear to have any notifications at this time.
            </p>
        </div>

        <notifications-table-row v-for="(item, i) in notificationsArray" :key="item.id" v-bind="item"
            notification-type="comment-reply" @notificationRead="markAsRead"></notifications-table-row>

        <div v-if="totalPages > 1" class="tw-flex tw-flex-row bg-light pagination-row align-h-right">
            <pagination :current-page="currentPage" :total-pages="totalPages" @pageChange="handlePageChange">
            </pagination>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref, computed } from 'vue';
import * as QueryString from 'query-string';
import NotificationsTableRow from './_NotificationsTableRow.vue';
import Pagination from '../../components/Pagination.vue';
import UserService from '../../assets/js/services/user';
import { EyeIcon, CogIcon } from '@heroicons/vue/outline';
import { bgColor } from '../../../../constants/brands';

const props = defineProps({
    brand: {
        type: String,
        default: () => 'drumeo',
    },
    notifications: {
        type: Array,
        default: () => [],
    },
    settingsUrl: {
        type: String,
        default: () => '/members/account/settings/notifications',
    },
    notificationsEndpoint: {
        type: String,
        default: () => '',
    },
    notificationCount: {
        type: [Number, String],
        default: () => '1',
    },
    hasUnreadNotifications: {
        type: Boolean,
        default: () => false,
    }
});

const notificationsArray = ref(props.notifications || []);
const markingAllAsRead = ref(false);
const hasUnread = ref(false);

onMounted(() => {
    hasUnread.value = props.hasUnreadNotifications;
});

const totalPages = computed(() => {
    return Math.ceil(props.notificationCount / 20);
});

const currentPage = computed(() => {
    const urlParams = QueryString.parse(location.search);

    if (urlParams.page != null) {
        return Number(urlParams.page);
    }

    return 1;
});

function markAllAsRead() {
    if (!markingAllAsRead.value) {
        markingAllAsRead.value = true;

        // Send request to server
        UserService.markAllNotificationsAsRead(props.brand)
            .then((resolved) => {
                if (resolved) {
                    notificationsArray.value = notificationsArray.value.map((notification) => {
                        return { ...notification, isRead: true }
                    });
                    hasUnread.value = false;
                }
                markingAllAsRead.value = false;
            });
    }
};

function markAsRead(payload) {
    const index = notificationsArray.value.map(notification => notification.id).indexOf(payload.id);

    if (payload.isRead) {
        if (payload.canCancel) {
            UserService.markNotificationAsUnRead(payload.id)
                .then(resolved => {
                    hasUnread.value = true;
                });
        }
    } else {
        UserService.markNotificationAsRead(payload.id)
            .then(response => {
                if (response.meta && response.meta.unreadCount) {
                    hasUnread.value = response.meta.unreadCount > 0;
                }
            });
    }

    if (payload.canCancel) {
        notificationsArray.value[index].isRead = !notificationsArray.value[index].isRead;
    }
};

function handlePageChange(payload) {
    const urlParams = QueryString.parse(location.search);

    urlParams.page = payload.page;

    window.location.href = `${location.protocol}//${location.host
        }${location.pathname}?${QueryString.stringify(urlParams)}`;
}
</script>
