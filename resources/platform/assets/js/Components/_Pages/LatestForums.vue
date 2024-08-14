<template>
    <div class="tw-mx-auto tw-w-full tw-max-w-[1703px] tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs"></Breadcrumb>
        <PageHeader
            :pageType="headerData.type"
            :iconName="headerData.iconName"
            :title="headerData.title"
            :description="headerData.description"
            :ctas="headerData.ctas"
        ></PageHeader>

        <div
            class="tw-mx-auto tw-w-full tw-max-w-[1703px] tw-px-4 tw-pb-14 tw-pt-8 dark:tw-text-white md:tw-px-8"
        >
            <div class="tw-my-3 tw-flex tw-flex-col">
                <div class="tw-flex tw-flex-row">
                    <ForumThreadsTable
                        :onlyFollowed="false"
                        :showTabs="false"
                        :threads="threads"
                        :threadCount="threadCount"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import Breadcrumb from "@collections/Breadcrumb/Breadcrumb.vue";
import PageHeader from "@collections/PageHeader/PageHeader.vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia";

const props = defineProps({
    threads: {
        type: Array,
        default: () => [],
    },
    threadCount: {
        type: Number,
        default: () => 0,
    },
    showCategoriesUrl: {
        type: String,
        default: null,
    },
    showCreateThreadFormUrl: {
        type: String,
        default: null,
    },
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = computed(() => {
    return [
        { title: "Forums", url: props.showCategoriesUrl },
        { title: "All Latest Threads" },
    ];
});

const headerCtas = computed(() => {
    return [
        {
            type: "PageHeaderPrimaryCta",
            props: {
                text: "Create Thread",
                url: props.showCreateThreadFormUrl,
                faIconClass: "fa-pencil",
            },
        },
    ];
});

const headerData = computed(() => {
    return {
        type: "unreleased",
        title: `All Latest Threads`,
        description: "Checkout all the latest threads from all our forums.",
        iconName: "clock-filled",
        ctas: headerCtas.value,
    };
});
</script>