<template>
    <v-row
        class="align-top"
    >
        <content-info
            :this-post="thisPost"
            :is-child="isChild"
            :content-type="contentType"
        ></content-info>

        <v-col
            cols="12"
            sm="6"
            class="mt-4 mb-2 text-center mb-2 px-4 column"
        >
            <content-fields
                :content-type="contentType"
                :this-post="thisPost"
                :is-child="isChild"
                :content-model="contentModel"
            ></content-fields>

            <content-children
                v-if="thisPost && postHasChildren && this.contentType !== 'instructor'"
                :content-type="contentType"
                :this-post="thisPost"
                :is-child="isChild"
                :content-model="contentModel"
                @openChildEditForm="openChildEditForm"
            ></content-children>

            <content-chapters
                v-if="thisPost && hasChapters && contentType !== 'routine'"
                :content-model="contentModel"
                :this-post="thisPost"
                :is-child="isChild"
            ></content-chapters>

            <content-assignments
                v-if="thisPost && !postHasChildren && this.contentType !== 'assignment' && contentType !== 'routine'"
                :content-model="contentModel"
                :this-post="thisPost"
                :is-child="isChild"
                @openChildEditForm="openChildEditForm"
            ></content-assignments>

            <content-subcategory
                v-if="contentHasSubcategory"
                :this-post="thisPost"
                :is-child="isChild"
                :content-type="contentType"
            ></content-subcategory>

            <content-statistics
                v-if="showStatistics()"
                :this-post="thisPost"
            ></content-statistics>

            <v-custom-treeview :item="thisPost.original"></v-custom-treeview>
        </v-col>

        <v-col
            cols="12"
            sm="6"
            class="mt-4 mb-2 text-center mb-2 px-4 column"
        >
            <content-videos
                v-if="postHasVideos && (contentModel.youtube_video_id || contentModel.vimeo_video_id)"
                :this-post="thisPost"
                :is-child="isChild"
                :content-model="contentModel"
            ></content-videos>

            <scheduling-permissions
                :this-post="thisPost"
                :is-child="isChild"
                :content-model="contentModel"
            ></scheduling-permissions>

            <media-fields
                :this-post="thisPost"
                :is-child="isChild"
                :content-type="contentType"
                :content-model="contentModel"
            ></media-fields>

            <downloadable-resources
                v-if="hasResources && contentType !== 'routine'"
                :this-post="thisPost"
                :is-child="isChild"
                :content-model="contentModel"
            ></downloadable-resources>

            <subtitling
                v-if="contentType !== 'routine'"
                :this-post="thisPost"
                :is-child="isChild"
                :content-type="contentType"
                :content-model="contentModel"
            ></subtitling>

<!--            <staff-picks-->
<!--                v-if="contentModel.staff_pick_rating"-->
<!--                :this-post="thisPost"-->
<!--                :is-child="isChild"-->
<!--                :content-model="contentModel"-->
<!--            ></staff-picks>-->
        </v-col>
    </v-row>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import CustomFileInput from '../../../components/CustomFileInput';
import CustomKeyedFileInput from '../../../components/CustomKeyedFileInput';
import CustomDateTimeInput from '../../../components/CustomDateTimeInput';
import api from '../../../api/content';
import ContentFields from './_ContentFields';
import DownloadableResources from './_DownloadableResources';
import StaffPicks from './_StaffPicks';
import MediaFields from './_MediaFields';
import SchedulingPermissions from './_SchedulingPermissions';
import ContentAssignments from './_ContentAssignments';
import ContentChildren from './_ContentChildren';
import ContentInfo from './_ContentInfo';
import ContentVideos from './_ContentVideos';
import ContentChapters from './_ContentChapters';
import ContentStatistics from './_ContentStatistics';
import ContentStore from '../../../mixins/content-store';
import ContentSubcategory from './_ContentSubcategory';
import CustomTreeview from '../../../components/CustomTreeview';
import Subtitling from './_Subtitling';

const dataDefault = {
    position: 1,
    value: null,
    id: null,
};

export default {
    name: 'ContentForms',
    components: {
        'v-custom-file-input': CustomFileInput,
        'v-custom-datetime-input': CustomDateTimeInput,
        'v-custom-keyed-file-input': CustomKeyedFileInput,
        'content-fields': ContentFields,
        'downloadable-resources': DownloadableResources,
        'staff-picks': StaffPicks,
        'media-fields': MediaFields,
        'scheduling-permissions': SchedulingPermissions,
        'content-assignments': ContentAssignments,
        'content-children': ContentChildren,
        'content-info': ContentInfo,
        'content-videos': ContentVideos,
        'content-chapters': ContentChapters,
        'content-subcategory': ContentSubcategory,
        'content-statistics': ContentStatistics,
        'v-custom-treeview': CustomTreeview,
        'subtitling': Subtitling,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: 'home',
                },
                {
                    text: 'Content',
                    disabled: false,
                    to: 'content',
                },
                {
                    text: 'Course',
                    disabled: true,
                },
            ],
            dayMenu: false,
            timeMenu: false,
            difficultyOptions: Utils.range(10, 1),
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_title() {
            return this.thisPost.title.value;
        },

        postHasChildren() {
            const childrenTypes = ContentHelpers.getTypesWithChildrenByBrand(this.state.brand);

            childrenTypes.push('instructor');

            return childrenTypes.indexOf(this.contentType) !== -1;
        },

        postHasVideos() {
            let childrenTypes = ContentHelpers.getTypesWithChildrenByBrand(this.state.brand);

            // Remove Learning Paths from this list
            if (this.state.brand === 'drumeo') {
                childrenTypes = childrenTypes.filter(type => type !== 'learning-path');
                childrenTypes = childrenTypes.filter(type => type !== 'learning-path-level');
            }

            childrenTypes.push('instructor');

            return childrenTypes.indexOf(this.contentType) === -1 && this.contentType !== 'song';
        },

        hasChapters() {
            return this.contentModel != null && (this.contentModel.chapter_timecode != null && this.contentModel.chapter_description != null);
        },

        hasResources() {
            return this.contentModel.resource_name != null && this.contentModel.resource_url != null;
        },

        contentHasSubcategory() {
            const subcategories = {
                pianote: ContentHelpers.studentFocus(),
                drumeo: ContentHelpers.shows(),
            }[this.state.brand];

            return subcategories ? subcategories.indexOf(this.contentType) !== -1 : false;
        },
    },
    methods: {
        ...mapActions('content', [
            'getBrand',
            'getInstructors',
        ]),

        toCapitalCase: string => Utils.toCapitalCase(string),

        createObjectCopy: object => Utils.createObjectCopy(object),

        range: (length, start = 0) => Utils.range(length, start),

        getContentTypeIcon: type => ContentHelpers.getContentTypeIcon(type),

        appendNewResource() {
            this.thisPost.resource_name.push(dataDefault);
            this.thisPost.resource_url.push(dataDefault);
        },

        getParsedContentType() {
            return Utils.toCapitalCase(this.contentType ? this.contentType.replace(/-/g, ' ') : '');
        },

        showStatistics() {
            const contentStatsTypes = ContentHelpers.statisticsContentTypes();

            return contentStatsTypes.indexOf(this.contentType) !== -1;
        },
    },
};
</script>
