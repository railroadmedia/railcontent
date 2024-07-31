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
            class="tw-pb-14 tw-mt-[14px] dark:tw-text-white"
        >
            <ForumThreadsTable
                :onlyFollowed="true"
                :pinnedThreads="pinnedThreads"
                :threads="threads"
                :forums="forums"
                :threadCount="threadCount"
                :latestThreadsUrl="latestThreadsUrl"
                :searchJsonResultsEndpointUrl="
                    searchJsonResultsEndpointUrl
                "
            />
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
    userAccessLevel: {
        type: String,
        default: null,
    },
    createCategoryFormUrl: {
        type: String,
        default: null,
    },
    communityGuidelinesUrl: {
        type: String,
        default: null,
    },
    threads: {
        type: Array,
        default: () => [],
    },
    pinnedThreads: {
        type: Array,
        default: () => [],
    },
    threadCount: {
        type: Number,
        default: () => 0,
    },
    forums: {
        type: Array,
        default: () => [],
    },
    latestThreadsUrl: {
        type: String,
        default: null,
    },
    searchJsonResultsEndpointUrl: {
        type: String,
        default: null,
    },
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

// get user access level user.access_level
const userAccessLevel = computed(() => props.userAccessLevel);

const breadcrumbs = computed(() => {
    return [{ title: "Forums" }];
});

const headerDescription = computed(() => {
    if (brand.value === "drumeo") {
        return "Connect with drummers from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } else if (brand.value === "pianote") {
        return "Connect with piano players from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } else if (brand.value === "guitareo") {
        return "Connect with guitarists from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    } else if (brand.value === "singeo") {
        return "Connect with singers from around the world! Our forums help you build social connections and find other students that share your goals and passions.";
    }
    return "";
});

const headerCtas = computed(() => {
    const ctas = [];
    if (userAccessLevel.value === "team") {
        ctas.push({
            type: "PageHeaderCta",
            props: {
                text: "Create a Forum",
                faIconClass: "fas fa-pencil",
                url: props.createCategoryFormUrl,
                showAllAlways: true,
            },
        });
    }

    ctas.push({
        type: "PageHeaderCta",
        props: {
            text: "Musora Community Guidelines",
            faIconClass: "fas fa-clipboard-list",
            url: props.communityGuidelinesUrl,
            showAllAlways: true,
        },
    });
    return ctas;
});

const headerData = computed(() => {
    return {
        type: "forums",
        title: `${brand.value} Forums`,
        description: headerDescription.value,
        iconName: "messages",
        ctas: headerCtas.value,
    };
});
</script>
