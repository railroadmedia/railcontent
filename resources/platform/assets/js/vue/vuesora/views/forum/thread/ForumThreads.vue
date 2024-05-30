<template>
    <div
        class="tw-mx-auto tw-mt-4 tw-w-full tw-px-4 md:tw-px-8 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl"
    >
        <Breadcrumb :breadcrumbs="breadcrumbs"></Breadcrumb>
        <PageHeader
            :pageType="headerData.type"
            :iconName="headerData.iconName"
            :title="headerData.title"
            :description="headerData.description"
            :ctas="headerData.ctas"
        ></PageHeader>
        <div class="tw-mt-[30px] tw-w-full">
            <CollectionWrapper
                collectionType="threads"
                :preLoadedContent="threads"
                :tabOptions="tabOptions"
                :endpoint="endpointUrl"
                :searchEndpointUrl="searchEndpointUrl"
                :sortOptions="sortOptions"
                defaultSort="-last_post_published_on"
                :hideFilterIcon="true"
            ></CollectionWrapper>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import Breadcrumb from "../../../../components/Breadcrumb/Breadcrumb.vue";
import PageHeader from "../../../../components/PageHeader/PageHeader.vue";
import CollectionWrapper from "../../../../components/CollectionWrapper/CollectionWrapper.vue";

const props = defineProps({
    discussionTitle: String,
    discussionDescription: String,
    discussionIconName: {
        type: String,
        default: () => "fa-comments",
    },
    showCreateThreadFormUrl: String,
    isAdmin: Boolean,
    showCategoriesUrl: String,
    threads: Array,
    endpointUrl: String,
    searchEndpointUrl: String,
    showUpdateCategoryFormUrl: String,
});

const breadcrumbs = computed(() => {
    return [
        {
            title: 'Forums',
            url: props.showCategoriesUrl,
        },
        {
            title: props.discussionTitle,
        }
    ]
})

const tabOptions = computed(() => {
    return [
        { key: 'all', value: 'All Threads' },
        { key: 'followed,1', value: 'Followed' }
    ]
})

const sortOptions = computed(() => {
    return [
        { value: '-last_post_published_on', name: 'Most recent', icon: 'sort-down' },
        { value: 'last_post_published_on', name: 'Oldest', icon: 'sort-up' },
        { value: 'mine', name: 'My threads', icon: 'my-threads' }
    ]
})

const headerCtas = computed(() => {
    const ctas = [
        {
            type: "PageHeaderCta",
            props: {
                text: "Create Thread",
                faIconClass: "fa-pencil",
                url: props.showCreateThreadFormUrl,
                showAllAlways: true,
            }
        }
    ]
    if (props.isAdmin) {
        ctas.push({
            type: "PageHeaderCta",
            props: {
                text: "Edit Forum",
                faIconClass: "fa-pencil",
                url: props.showUpdateCategoryFormUrl,
                showAllAlways: true
            }
        });
    }
    return ctas;
});

const headerData = computed(() => {
    return {
        type: "forums",
        title: props.discussionTitle,
        description: props.discussionDescription,
        iconName: props.discussionIconName,
        ctas: headerCtas.value,
    };
});
</script>
