<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Header -->
        <PageHeader pageType="notifications" title="Notifications" iconName="fa-bell" :ctas="headerCtas" />
        
        <div class="tw-w-full dark:tw-text-white tw-pt-8 tw-pb-14 tw-flex tw-flex-col">
            <div v-if="notifications.length === 0" class="tw-flex tw-flex-row">
                <p class="tw-text-sm text-grey-3 dark:tw-text-[#9EC0DC] tw-italic">
                    You do not appear to have any notifications at this time.
                </p>
            </div>
            <notifications-table-row v-for="item in notificationsArray" :key="item.id" v-bind="item"
                @notificationRead="markAsRead"></notifications-table-row>

            <div v-if="totalPages > 1" class="tw-flex tw-flex-row bg-light pagination-row align-h-right">
                <pagination :current-page="currentPage" :total-pages="totalPages" @pageChange="handlePageChange">
                </pagination>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref, computed } from 'vue';
import { EyeIcon, CogIcon } from '@heroicons/vue/outline';
import * as QueryString from 'query-string';
import NotificationsTableRow from './_NotificationsTableRow.vue';
import PageHeader from '../../../components/PageHeader/PageHeader.vue';
import Pagination from '../../components/Pagination.vue';
import UserService from '../../assets/js/services/user';
import MusoraIcon from '../../../components/MusoraIcons/MusoraIcon.vue';
import Breadcrumb from '../../../components/ContentInfo/Breadcrumb.vue';

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

const headerCtas = computed(() => {
    return [
        {
            type: 'PageHeaderCta',
            props: {
                text: 'Mark All As Read',
                faIconClass: 'fa-eye',
                onClickCallback: markAllAsRead,
                disabled: !hasUnread.value,
            },
        },
        {
            type: 'PageHeaderCta',
            props: {
                text: 'Notification Settings',
                faIconClass: 'fa-cog',
                url: props.settingsUrl,
            },
        },
    ];
});

const markAllAsRead = () => {
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

function markAsRead (payload) {
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

function handlePageChange (payload) {
    const urlParams = QueryString.parse(location.search);

    urlParams.page = payload.page;

    window.location.href = `${location.protocol}//${location.host
        }${location.pathname}?${QueryString.stringify(urlParams)}`;
}
</script>
