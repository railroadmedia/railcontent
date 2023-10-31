<template>
    <v-container>
        <v-row

                align="center"
        >
            <v-col
                    class="column"
                    cols="12"
            >
                <v-custom-breadcrumbs
                        :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>

            <v-col
                    class="column"
                    cols="12"
            >
                <v-expansion-panels>
                    <v-expansion-panel>
                        <v-expansion-panel-header><b>Guide & Important Information About This Tool</b>
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>

                            <hr class="mb-5">

                            <h2><b>Overview</b></h2>
                            <p class="pt-2">
                                This tool was created to provide core engagement statistics for our content.
                                It's designed to answer questions such as:
                            </p>
                            <ul>
                                <li>
                                    What was our most successful content in a given time period?
                                </li>
                                <li>
                                    What types of content have the most engagement?
                                </li>
                                <li>
                                    Which content has the most social interaction in a given time period?
                                </li>
                                <li>
                                    Was content launch A more successful than content launch B?
                                </li>
                                <li>
                                    Which content has the highest start to complete ratio?
                                </li>
                                <li>
                                    Did more users engage with our content for brand X in week A than week B?
                                </li>
                            </ul>

                            <hr class="mb-5 mt-5">

                            <h2><b>Notes & Caveats</b></h2>
                            <ul class="pt-2">
                                <li>
                                    <b>This data is calculated to within 1 week granularity. You can compare numbers
                                        down to a weekly basis, you cannot compare numbers down to a daily basis.</b>
                                </li>
                                <li>
                                    You can click any of the table headers to sort by that column
                                </li>
                                <li>
                                    Admin users are excluded from all statistics, including comments
                                </li>
                                <li>
                                    Data is calculated back to 2016-01-01
                                </li>
                                <li>
                                    Content with zero's for all stats is not included in any reporting.
                                </li>
                                <li>
                                    If you leave the content type, brand, and publish on date filters empty: you
                                    are seeing numbers for all content, across all brands, that was ever published.
                                </li>
                                <li class="pt-5">
                                    For 'parent' content such as courses and packs, the following stats include all data
                                    from
                                    their children: starts, comments, likes. For example when looking at a course row,
                                    the data can be described like this:

                                    <ul class="pt-2 pb-5">
                                        <li>Total Completes - total number of users who completed the entire course</li>
                                        <li>Total Starts - total number of users who started any lesson in the course</li>
                                        <li>Total Comments - total number of comments and replies on all the courses lessons</li>
                                        <li>Total Likes - total number of content likes on all courses lessons</li>
                                        <li>Total Added To List - total number of users who added the course itself to
                                            their list, does not include users who added any of the courses lessons to their list</li>
                                    </ul>
                                </li>
                            </ul>

                            <hr class="mb-5 mt-5">
                            <h2 class="mb-5"><b>How To User The Filters</b></h2>

                            <p class="pt-3"><b>Stats Start Date/Stats End Date</b></p>
                            <p>
                                This controls the period of time which the statistics are calculated.
                                If you set this to 2020-01-02 and 2020-01-31, you will see the starts, completes,
                                comments, etc for that month only for all the given content. Most of the time
                                you will want these dates to align with the published on date filters.
                            </p>

                            <p class="pt-3"><b>Content Type</b></p>
                            <p>
                                Only show content of this type.
                            </p>

                            <p class="pt-3"><b>Brand</b></p>
                            <p>
                                Only show content from this brand.
                            </p>

                            <p class="pt-3"><b>Publish Start Date/Publish End Date</b></p>
                            <p>
                                Only show content that was published between these dates. When using this filter you
                                must consider your stats start and end date. For example if you set the publish date
                                filter to: '2020-01-02 and 2020-01-31', but you set the stats date filter to:
                                '2019-12-01 and 2019-12-31', you will not see any results.
                            </p>

                            <p class="pt-3"><b>Filter Stats relative to published on date</b></p>
                            <p>
                                This is for returning stats relative to the contents publish on date. Content published
                                further in the past will naturally have higher stats
                                than newer published content. To account for this, you can pull numbers relative to the publish on
                                date of the content. For example if you wanted to figure out which content release
                                had the most engagement out of all content released in the last 6 months,
                                you could set this to 4 weeks. You would
                                then be seeing the stats for each content only within the 4 weeks after its release date.
                                This is how you can pull statically relevant numbers when comparing 1 content vs another.
                            </p>

                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-col>

            <v-col
                id="stats-toolbar"
                class="column mt-6 pb-0"
                cols="12"
            >
                <v-card outlined :color="brandColor" dark class="flat-bottom">
                    <v-card-title class="pa-0">
                        <v-col>Content Statistics</v-col>
                        <v-spacer class=".d-none .d-sm-flex"></v-spacer>
                        <v-col class="text-right">
                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        text
                                        icon
                                        download
                                        :href="csvDownloadUrl"
                                        v-on="on"
                                    >
                                        <v-icon>cloud_download</v-icon>
                                    </v-btn>
                                </template>

                                <span>Export Stats as CSV</span>
                            </v-tooltip>
                        </v-col>
                    </v-card-title>
                    <v-row class="px-4">
                        <v-col cols="2">
                            <v-menu
                                    ref="startDatePicker"
                                    v-model="startDatePicker"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            slot="activator"
                                            v-model="$_start_date"
                                            label="Stats Start Date"
                                            color="white"
                                            clearable
                                            v-on="on"
                                    ></v-text-field>
                                </template>

                                <v-date-picker
                                        v-model="$_start_date"
                                        no-title
                                        scrollable
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="startDatePicker = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="startDatePicker = false"
                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-col
                            class="justify-center"
                            style="flex-basis:60px;max-width:60px;"
                        >
                            <v-icon
                                    class="mx-4"
                                    style="height:100%;"
                            >
                                arrow_right_alt
                            </v-icon>
                        </v-col>

                        <v-col cols="2">
                            <v-menu
                                    ref="endDatePicker"
                                    v-model="endDatePicker"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            slot="activator"
                                            v-model="$_end_date"
                                            label="Stats End Date"
                                            color="white"
                                            clearable
                                            v-on="on"
                                    ></v-text-field>
                                </template>

                                <v-date-picker
                                        v-model="$_end_date"
                                        no-title
                                        scrollable
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="endDatePicker = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="endDatePicker = false"
                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-spacer class=".d-none .d-sm-flex"></v-spacer>

                        <v-col cols="2">
                            <v-menu
                                    ref="publishedStartDatePicker"
                                    v-model="publishedStartDatePicker"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            slot="activator"
                                            v-model="$_published_start_date"
                                            label="Publish Start Date"
                                            color="white"
                                            clearable
                                            v-on="on"
                                    ></v-text-field>
                                </template>

                                <v-date-picker
                                        v-model="$_published_start_date"
                                        no-title
                                        scrollable
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="publishedStartDatePicker = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="publishedStartDatePicker = false"
                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-col
                                class="justify-center"
                                style="flex-basis:60px;max-width:60px;"
                        >
                            <v-icon
                                    class="mx-4"
                                    style="height:100%;"
                            >
                                arrow_right_alt
                            </v-icon>
                        </v-col>

                        <v-col cols="2">
                            <v-menu
                                    ref="publishedEndDatePicker"
                                    v-model="publishedEndDatePicker"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                            slot="activator"
                                            v-model="$_published_end_date"
                                            label="Publish End Date"
                                            color="white"
                                            clearable
                                            v-on="on"
                                    ></v-text-field>
                                </template>

                                <v-date-picker
                                        v-model="$_published_end_date"
                                        no-title
                                        scrollable
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="publishedEndDatePicker = false"
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-btn
                                            text
                                            :color="brandColor"
                                            @click="publishedEndDatePicker = false"
                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-menu>
                        </v-col>
                    </v-row>

                    <v-row class="px-4">
                        <v-col cols="2">
                            <v-autocomplete
                                    v-model="$_type"
                                    label="Content Type"
                                    color="white"
                                    :items="contentTypes"
                                    clearable
                                    multiple
                            >
                            </v-autocomplete>
                        </v-col>

                        <v-spacer class=".d-none .d-sm-flex" style="max-width:60px;"></v-spacer>

                        <v-col cols="2">
                            <v-autocomplete
                                    v-model="$_brand"
                                    label="Content Brand"
                                    color="white"
                                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                                    clearable
                            >
                            </v-autocomplete>
                        </v-col>

                        <v-spacer class=".d-none .d-sm-flex"></v-spacer>

                        <v-col>
                            <div class="text-right" style="padding-top:22px;">
                                Filter Stats relative to published on date
                            </div>
                        </v-col>
                        <v-col cols="2">
                            <v-text-field
                                    v-model="$_stats_epoch"
                                    label="Stats Age in weeks"
                                    color="white"
                                    clearable
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row class="px-4">
                        <v-col cols="2">
                            <v-select
                                v-model="$_field"
                                label="Content Field"
                                color="white"
                                :items="['difficulty', 'instructor', 'style', 'tag', 'topic']"
                                clearable
                            >
                            </v-select>
                        </v-col>

                        <v-spacer class=".d-none .d-sm-flex" style="max-width:60px;"></v-spacer>

                        <v-col cols="2">
                            <v-autocomplete
                                v-model="value"
                                label="Content Field Value"
                                color="white"
                                :items="selectedFilterValues"
                                :disabled="!field"
                                clearable
                            >
                            </v-autocomplete>
                        </v-col>

                        <v-col>
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        text
                                        icon
                                        large
                                        v-on="on"
                                        class="mt-2"
                                        :disabled="!field || !value"
                                        @click="addFieldFilter"
                                    >
                                        <v-icon>loupe</v-icon>
                                    </v-btn>
                                </template>

                                <span>Add content field filter</span>
                            </v-tooltip>
                        </v-col>

                        <v-col cols="6" class="mt-2">
                            <div style="display: inline" v-if="fieldsFilters.length > 0">
                                Active Field Filters
                            </div>
                            <v-chip
                                class="ma-2"
                                close
                                color="white"
                                label
                                outlined
                                v-for="item in fieldsFilters"
                                :key="item.field + item.value"
                                @click:close="removeFieldFilter(item)"
                            >
                                {{ item.field }}: {{ item.value }}
                            </v-chip>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>

            <v-col
                    class="column pt-0"
                    cols="12"
            >
                <v-data-table
                        :headers="headers"
                        :items="stats"
                        :loading="loading"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :options.sync="options"
                        :footer-props.sync="footerProps"
                        class="elevation-1 pt-2 hide-items-per-page"
                        must-sort
                        id="stats-table"
                >
                    <template v-slot:item="{ item }">
                        <tr style="cursor:pointer;">
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.content_id }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.content_brand }}
                            </linkable-td>
                            <linkable-td
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.content_title }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.content_type }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.content_published_on }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.total_completes }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.total_starts }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.total_comments }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.total_likes }}
                            </linkable-td>
                            <linkable-td
                                class="text-center"
                                target="_blank"
                                :to="getPath(item)"
                            >
                                {{ item.total_added_to_list }}
                            </linkable-td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import {mapActions, mapState} from 'vuex';
    import {Content as ContentHelpers} from '@musora/helper-functions';
    import api from '../../api/content';
    import axios from 'axios';
    import brandColors from '../../api/mixins.js';
    import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
    import LinkableTD from '../../components/LinkableTD';
    import Middleware from '../../middleware/auth';

    export default {
        name: 'ContentStatistics',
        components: {
            'v-custom-breadcrumbs': CustomBreadcrumbs,
            'linkable-td': LinkableTD,
        },
        mixins: [brandColors],
        beforeRouteEnter(to, from, next) {
            next((vm) => {
                Middleware.admin(vm, 'users');
            });
        },
        data() {
            return {
                breadcrumbs: [
                    {
                        text: 'Home',
                        disabled: false,
                        to: {name: 'home'},
                    },
                    {
                        text: 'Content Statistics',
                        disabled: true,
                    },
                ],
                loading: false,
                stats: [],
                headers: [
                    {
                        text: 'Content ID',
                        align: 'center',
                        value: 'content_id',
                        width: 120,
                    },
                    {
                        text: 'Content Brand',
                        align: 'center',
                        value: 'content_brand',
                        width: 130,
                    },
                    {
                        text: 'Content Title',
                        align: 'left',
                        value: 'content_title',
                    },
                    {
                        text: 'Content Type',
                        align: 'center',
                        value: 'content_type',
                        width: 170,
                    },
                    {
                        text: 'Content Published On',
                        align: 'center',
                        value: 'content_published_on',
                        width: 170,
                    },
                    {
                        text: 'Total Completes',
                        align: 'center',
                        value: 'total_completes',
                        width: 160,
                    },
                    {
                        text: 'Total Starts',
                        align: 'center',
                        value: 'total_starts',
                        width: 140,
                    },
                    {
                        text: 'Total Comments',
                        align: 'center',
                        value: 'total_comments',
                        width: 160,
                    },
                    {
                        text: 'Total Likes',
                        align: 'center',
                        value: 'total_likes',
                        width: 140,
                    },
                    {
                        text: 'Total Added To List',
                        align: 'center',
                        value: 'total_added_to_list',
                        width: 160,
                    },
                ],
                endDatePicker: false,
                startDatePicker: false,
                publishedEndDatePicker: false,
                publishedStartDatePicker: false,
                startDate: this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD'),
                endDate: this.moment(this.moment.now()).format('YYYY-MM-DD'),
                contentTypes: [
                  '25-days-of-christmas',
                  'behind-the-scenes',
                  'boot-camps',
                  'camp-drumeo-ah',
                  'challenges',
                  'chord-and-scale',
                  'course',
                  'course-part',
                  'coach-stream',
                  'diy-drum-experiments',
                  'edge-pack',
                  'entertainment',
                  'exploring-beats',
                  'gear-guides',
                  'ha-oemurd-pmac',
                  'the-history-of-electronic-drums',
                  'backstage-secrets',
                  'spotlight',
                  'in-rhythm',
                  'learning-path',
                  'learning-path-course',
                  'learning-path-lesson',
                  'learning-path-level',
                  'live',
                  'namm-2019',
                  'on-the-road',
                  'pack',
                  'pack-bundle',
                  'pack-bundle-lesson',
                  'paiste-cymbals',
                  'performances',
                  'play-along',
                  'play-along-part',
                  'podcasts',
                  'question-and-answer',
                  'quick-tips',
                  'recording',
                  'rhythmic-adventures-of-captain-carson',
                  'rhythms-from-another-planet',
                  'rudiment',
                  'semester-pack',
                  'semester-pack-lesson',
                  'solos',
                  'song',
                  'song-part',
                  'sonor-drums',
                  'student-collaborations',
                  'student-focus',
                  'student-review',
                  'study-the-greats',
                  'tama-drums',
                  'unit',
                  'unit-part',
                ],
                type: [],
                publishedStartDate: null,
                publishedEndDate: null,
                sortBy: 'content_id',
                sortDesc: false,
                options: {
                    itemsPerPage: 100,
                    page: 1
                },
                footerProps: {
                    disableItemsPerPage: true,
                },
                brand: 'drumeo',
                statsEpoch: null,
                fetchCancelToken: null,
                fetchTimeout: null,
                field: null,
                value: null,
                fieldsFilters: [],
                fieldsFiltersValues: [],
                selectedFilterValues: [],
            };
        },
        computed: {
            ...mapState({
                auth: state => state.auth,
            }),

            $_brand: {
                get() {
                    return this.brand;
                },
                set(value) {
                    this.brand = value;

                    this.fetch();
                },
            },

            $_start_date: {
                get() {
                    return this.startDate;
                },
                set(value) {
                    this.startDate = value;

                    this.fetch();
                },
            },

            $_end_date: {
                get() {
                    return this.endDate;
                },
                set(value) {
                    this.endDate = value;

                    this.fetch();
                },
            },

            $_type: {
                get() {
                    return this.type;
                },
                set(value) {
                    this.type = value;

                    this.fetch();
                },
            },

            $_published_start_date: {
                get() {
                    return this.publishedStartDate;
                },
                set(value) {
                    this.publishedStartDate = value;

                    this.fetch();
                },
            },

            $_published_end_date: {
                get() {
                    return this.publishedEndDate;
                },
                set(value) {
                    this.publishedEndDate = value;

                    this.fetch();
                },
            },

            $_stats_epoch: {
                get() {
                    return this.statsEpoch;
                },
                set(value) {
                    this.statsEpoch = value;

                    this.fetch();
                },
            },

            $_field: {
                get() {
                    return this.field;
                },
                set(value) {
                    this.field = value;

                    this.selectedFilterValues = this.fieldsFiltersValues[this.field];
                },
            },

            csvDownloadUrl() {
                return axios.getUri({
                    url: '/railcontent/content-statistics',
                    params: {
                        small_date_time: this.$_start_date,
                        big_date_time: this.$_end_date,
                        content_types: this.type.length ? this.type : null,
                        brand: this.brand ? this.brand : null,
                        published_on_small_date_time: this.$_published_start_date,
                        published_on_big_date_time: this.$_published_end_date,
                        sort_by: this.sortBy,
                        sort_dir: this.sortDesc ? 'desc' : 'asc',
                        stats_epoch: this.statsEpoch,
                        csv: true
                    },
                });
            },
        },
        methods: {
            fetch() {
                clearTimeout(this.fetchTimeout);

                this.fetchTimeout = setTimeout(() => {
                    this.getStats();
                }, 600);
            },

            getFieldsType(type) {
                return this.fieldsFilters.filter(filter => filter.field == type).map(item => item.value);
            },

            getStats() {
                this.loading = true;

                if (this.fetchCancelToken) {
                    this.fetchCancelToken.cancel();
                }

                this.fetchCancelToken = api.getCancelToken();

                let difficultyFields = this.getFieldsType('difficulty');
                let instructorFields = this.getFieldsType('instructor');
                let styleFields = this.getFieldsType('style');
                let tagFields = this.getFieldsType('tag');
                let topicFields = this.getFieldsType('topic');

                api
                    .getContentStatistics({
                        small_date_time: this.$_start_date,
                        big_date_time: this.$_end_date,
                        content_types: this.type.length ? this.type : null,
                        brand: this.brand ? this.brand : null,
                        published_on_small_date_time: this.$_published_start_date,
                        published_on_big_date_time: this.$_published_end_date,
                        sort_by: this.sortBy,
                        sort_dir: this.sortDesc ? 'desc' : 'asc',
                        stats_epoch: this.statsEpoch,
                        cancel_token: this.fetchCancelToken.token,
                        difficulty_fields: difficultyFields.length ? difficultyFields : null,
                        instructor_fields: instructorFields.length ? instructorFields : null,
                        style_fields: styleFields.length ? styleFields : null,
                        tag_fields: tagFields.length ? tagFields : null,
                        topic_fields: topicFields.length ? topicFields : null,
                    })
                    .then((response) => {

                        if (response) {
                            this.stats = response;
                            this.options.page = 1;
                        }

                        this.loading = false;
                    });
            },

            getPath(item) {
                return {
                    name: 'content.edit',
                    params: {brand: item.content_brand, type: item.content_type, id: item.content_id}
                };
            },

            addFieldFilter() {
                this.fieldsFilters.push({field: this.field, value: this.value});
                this.field = null;
                this.value = null;
                this.fetch();
            },

            removeFieldFilter(item) {
                this.fieldsFilters = this.fieldsFilters.filter((filter) => !(filter.field == item.field && filter.value == item.value));
                this.fetch();
            },

            getFieldFiltersValues() {
                api
                    .getFieldFiltersValues()
                    .then((response) => {
                        this.fieldsFiltersValues = response;
                    });
            }
        },
        mounted() {
            this.getStats();
            this.getFieldFiltersValues();
        }
    }
</script>

<style>
    #stats-table.hide-items-per-page .v-data-footer__select {
        display: none;
    }
    #stats-toolbar .flat-bottom {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
</style>