<template>
    <div class="flex flex-column">
        <template v-if="!isLoading && !collectionStoreLoading">
            <CatalogueListItem
                v-for="(item, i) in content"
                :key="'list' + item.id"
                :index="item.week || i + 1"
                :item="item"
                :is-coach="isCoach"
                :content-type="item.type"
                :overview="displayItemsAsOverview"
                :display-user-interactions="displayUserInteractions"
                :content-type-override="contentTypeOverride"
                :show-numbers="showNumbers"
                :no-link="lockUnowned && item.is_owned === false"
                :lock-unowned="lockUnowned"
                :is_search="is_search"
                :force-wide-thumbs="forceWideThumbs"
                :show-reset-progress="showResetProgress"
                :destroy-on-list-removal="destroyOnListRemoval"
                :compact-layout="compactLayout"
                :is-next-lesson="isNextLesson"
            />

            <div id="branch-paths" v-if="branchPathContent.data" >
                <!-- Method Paths -->
                <CatalogueListItem
                    v-for="(branchItem, j) in branchPathContent.data"
                    :key="'branch' + branchItem.id"
                    :index="branchItem.week || j + 1"
                    :item="branchItem"
                    :is-branch-path="true"
                    content-type="learning-path-branch"
                    :overview="displayItemsAsOverview"
                    :display-user-interactions="displayUserInteractions"
                    :content-type-override="contentTypeOverride"
                    :show-numbers="showNumbers"
                    :no-link="lockUnowned && branchItem.is_owned === false"
                    :lock-unowned="lockUnowned"
                    :is_search="is_search"
                    :force-wide-thumbs="forceWideThumbs"
                    :reset-progress="showResetProgress"
                    :destroy-on-list-removal="destroyOnListRemoval"
                    :compact-layout="compactLayout"
                    :is-next-lesson="isNextLesson"
                />
            </div>
        </template>
        <SkeletonListCatalogueItem v-else v-for="i in 8" :key="i" />
    </div>
</template>
<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import { useCollectionStore } from "@stores/collection";

import CatalogueListItem from "./ListCatalogueItem";
import SkeletonListCatalogueItem from '@collections/SkeletonLoader/SkeletonListCatalogueItem';

const props = defineProps({
    content: {
        type: Array,
        default: () => [],
    },
    isCoach: {
        type: Boolean,
        default: () => false,
    },
    cardType: {
        type: String,
        default: () => 'list',
    },
    displayItemsAsOverview: {
        type: Boolean,
        default: () => false,
    },
    displayUserInteractions: {
        type: Boolean,
        default: () => true,
    },
    contentTypeOverride: {
        type: String,
        default: () => '',
    },
    forceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    showNumbers: {
        type: Boolean,
        default: false,
    },
    lockUnowned: {
        type: Boolean,
        default: () => false,
    },
    isSearch: {
        type: Boolean,
        default: () => false,
    },
    showResetProgress: {
        type: Boolean,
        default: () => false,
    },
    destroyOnListRemoval: {
        type: Boolean,
        default: () => false,
    },
    compactLayout: {
        type: Boolean,
        default: () => false,
    },
    subscriptionCalendarId: {
        type: String,
        default: '',
    },
    is_search: {
        type: Boolean,
        default: () => false,
    },
    //Branch Paths
    branchPathIndex: {
        type: Number,
        default: () => 0,
    },
    branchPathContent: {
        type: Object,
        default: () => ({}),
    },
    isNextLesson: {
        type: Boolean,
        default: () => false,
    },
})

const platformStore = usePlatformStore();
const collectionStore = useCollectionStore();

const { loading: collectionStoreLoading } = storeToRefs(collectionStore);
const { isLoading } = storeToRefs(platformStore);
</script>
