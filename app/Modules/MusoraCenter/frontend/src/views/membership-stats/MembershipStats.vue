<template>
    <v-container>
        <v-row align="center">
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
                <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Membership Stats
                    </v-toolbar-title>

                    <v-btn small
                           href="https://github.com/railroadmedia/docusora/blob/master/docs/statistics/guides/musora-center/membership-reporting-tool-guide.md"
                           target="_blank">
                        View Guide
                    </v-btn>

                    <v-spacer class=".d-none .d-sm-flex"></v-spacer>
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

                    <template v-slot:extension>
                        <v-row class="pa-2 mt-2">
                            <v-col>
                                <v-select
                                        v-model="brand"
                                        label="Brand"
                                        color="white"
                                        clearable
                                        :items="['musora', 'drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                                        @keyup.enter="getMembershipStats()"
                                >
                                </v-select>
                            </v-col>

                            <v-col>
                                <v-autocomplete
                                        v-model="intervalType"
                                        label="Membership interval type"
                                        color="white"
                                        clearable
                                        :items="intervalTypes"
                                        item-text="label"
                                        item-value="key"
                                        @keyup.enter="getMembershipStats()"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-spacer class=".d-none .d-sm-flex"></v-spacer>

                            <v-col>
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
                                                v-model="startDate"
                                                label="Start Date"
                                                color="white"
                                                single-line
                                                clearable
                                                v-on="on"
                                                @keyup.enter="getMembershipStats()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                            v-model="startDate"
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

                            <v-col>
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
                                                v-model="endDate"
                                                label="End Date"
                                                color="white"
                                                single-line
                                                clearable
                                                v-on="on"
                                                @keyup.enter="getMembershipStats()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                            v-model="endDate"
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
                            <v-btn light @click="getMembershipStats()" class="mt-2">Search</v-btn>
                        </v-row>
                    </template>
                </v-toolbar>

                <v-data-table
                        :headers="totalHeaders"
                        :items="$_total_row"
                        :loading="loading"
                        hide-default-footer
                        :footer-props.sync="footerProps"
                        :page.sync="$_page"
                        sort-by="attributes.stats_date"
                        class="elevation-1 pt-2 hide-items-per-page"
                        must-sort
                        sort-desc
                        id="total-stats-table"
                        style="margin-top: 15px;"
                >
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Totals For Period</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                    </template>

                    <template v-slot:item="{ item }">
                        <tr>
                            <td>
                                {{ item.interval_type }}
                            </td>
                            <td>
                                {{ item.new }}
                            </td>
<!--                            <td>-->
<!--                                {{ item.expired }}-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                {{ item.canceled }}-->
<!--                            </td>-->

                            <td>
                                {{ item.active_state }}
                            </td>
<!--                            <td>-->
<!--                                {{ item.suspended_state }}-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                {{ item.canceled_state }}-->
<!--                            </td>-->

                        </tr>
                    </template>
                </v-data-table>

                <v-data-table
                        :headers="headersStats"
                        :items="stats"
                        :loading="loading"
                        :options.sync="options"
                        :footer-props.sync="footerProps"
                        :page.sync="$_page"
                        sort-by="attributes.stats_date"
                        class="elevation-1 pt-2 hide-items-per-page"
                        must-sort
                        sort-desc
                        id="stats-table"
                        style="margin-top: 15px;"
                >
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Data For Period</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                    </template>

                    <template v-slot:item="{ item }">
                        <tr>
                            <td>
                                {{ item.attributes.brand }}
                            </td>
                            <td>
                                {{ item.attributes.interval_type }}
                            </td>
                            <td>
                                {{ item.attributes.stats_date }}
                            </td>

                            <td>
                                {{ item.attributes.new }}
                            </td>
<!--                            <td>-->
<!--                                {{ item.attributes.expired }}-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                {{ item.attributes.canceled }}-->
<!--                            </td>-->

                            <td>
                                {{ item.attributes.active_state }}
                            </td>
<!--                            <td>-->
<!--                                {{ item.attributes.suspended_state }}-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                {{ item.attributes.canceled_state }}-->
<!--                            </td>-->

                        </tr>
                    </template>
                </v-data-table>

            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import {mapState} from 'vuex';
    import brandColors from '../../api/mixins';
    import Middleware from '../../middleware/auth';
    import api from '../../api/ecommerce/membership-stats';
    import axios from 'axios';
    import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
    import JsonApiMethods from '../../mixins/json-api-methods';

    export default {
        name: 'MembershipStats',
        components: {
            'v-custom-breadcrumbs': CustomBreadcrumbs,
        },
        mixins: [brandColors, JsonApiMethods],
        beforeRouteEnter(to, from, next) {
            next((vm) => {
                Middleware.admin(vm, 'membership-stats');
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
                        text: 'Membership Stats',
                        disabled: true,
                    },
                ],
                headersStats: [
                    {
                        text: 'Brand',
                        align: 'left',
                        value: 'attributes.brand',
                        width: 160,
                    },
                    {
                        text: 'Interval Type',
                        align: 'left',
                        value: 'attributes.interval_type',
                        width: 160,
                    },
                    {
                        text: 'Stats Date',
                        align: 'left',
                        value: 'attributes.stats_date',
                        width: 160,
                    },
                    {
                        text: 'New In Day',
                        align: 'left',
                        value: 'attributes.new',
                        width: 160,
                    },
                    // {
                    //     text: 'Expired In Day',
                    //     align: 'left',
                    //     value: 'attributes.expired',
                    //     width: 160,
                    // },
                    // {
                    //     text: 'Canceled In Day',
                    //     align: 'left',
                    //     value: 'attributes.canceled',
                    //     width: 160,
                    // },
                    {
                        text: 'Total Active State',
                        align: 'left',
                        value: 'attributes.active_state',
                        width: 160,
                    },
                    // {
                    //     text: 'Total Suspended State',
                    //     align: 'left',
                    //     value: 'attributes.suspended_state',
                    //     width: 160,
                    // },
                    // {
                    //     text: 'Total Canceled State',
                    //     align: 'left',
                    //     value: 'attributes.canceled_state',
                    //     width: 160,
                    // },
                ],
                totalHeaders: [
                    {
                        text: 'Interval Type',
                        align: 'left',
                        value: 'attributes.interval_type',
                        width: 100,
                    },
                    {
                        text: 'New',
                        align: 'left',
                        value: 'attributes.brand',
                        width: 100,
                    },
                    // {
                    //     text: 'Expired',
                    //     align: 'left',
                    //     value: 'attributes.interval_type',
                    //     width: 100,
                    // },
                    // {
                    //     text: 'Canceled',
                    //     align: 'left',
                    //     value: 'attributes.stats_date',
                    //     width: 100,
                    // },
                    {
                        text: 'Most Recent Total Active State',
                        align: 'left',
                        value: 'attributes.new',
                        width: 160,
                    },
                    // {
                    //     text: 'Most Recent Total Suspended State',
                    //     align: 'left',
                    //     value: 'attributes.expired',
                    //     width: 160,
                    // },
                    // {
                    //     text: 'Most Recent Total Canceled State',
                    //     align: 'left',
                    //     value: 'attributes.canceled',
                    //     width: 160,
                    // },
                ],
                endDatePicker: false,
                startDatePicker: false,
                startDate: '',
                endDate: '',
                loading: false,
                stats: [],
                intervalTypes: [
                    {
                        key: 'one month',
                        label: 'One Month'
                    },
                    {
                        key: 'six months',
                        label: 'Six Months'
                    },
                    {
                        key: 'one year',
                        label: 'One Year'
                    },
                    {
                        key: 'lifetime',
                        label: 'Lifetime'
                    },
                    {
                        key: 'all',
                        label: 'Sum of the membership types'
                    }
                ],
                intervalType: null,
                options: {
                    itemsPerPage: 100
                },
                totalTableOptions: {
                    "disable-pagination": true,
                },
                footerProps: {
                    disableItemsPerPage: true,
                },
                dateTimeout: null,
                currentPage: 1,
                brand: ''
            };
        },
        computed: {
            ...mapState({
                auth: state => state.auth,
            }),

            $_page: {
                get() {
                    return this.currentPage;
                },
                set(val) {
                    this.currentPage = val;

                    this.updateUrl();
                },
            },

            $_total_row: {
                get() {
                    let dataObject = {};

                    let self = this;

                    this.stats.reverse().forEach(function (stat, statIndex) {
                        if (!dataObject[stat.attributes.interval_type]) {
                            dataObject[stat.attributes.interval_type] = {
                                interval_type: stat.attributes.interval_type,
                                new: 0,
                                expired: 0,
                                canceled: 0,
                                active_state: 0,
                                suspended_state: 0,
                                canceled_state: 0,
                            };
                        }

                        dataObject[stat.attributes.interval_type].interval_type = stat.attributes.interval_type;
                        dataObject[stat.attributes.interval_type].new += stat.attributes.new;
                        dataObject[stat.attributes.interval_type].expired += stat.attributes.expired;
                        dataObject[stat.attributes.interval_type].canceled += stat.attributes.canceled;
                        dataObject[stat.attributes.interval_type].active_state = stat.attributes.active_state;
                        dataObject[stat.attributes.interval_type].suspended_state = stat.attributes.suspended_state;
                        dataObject[stat.attributes.interval_type].canceled_state = stat.attributes.canceled_state;
                    });

                    Object.values(dataObject);

                    return Object.values(dataObject);
                },
                set(val) {
                },
            },

            csvDownloadUrl() {
                return axios.getUri({
                    url: '/ecommerce/membership-stats',
                    params: {
                        start_date: this.startDate,
                        end_date: this.endDate,
                        interval_type: this.intervalType,
                        brand: this.brand ? this.brand : null,
                        csv: true
                    },
                });
            },
        },
        mounted() {
            this.currentPage = this.$route.query.page ? Number(this.$route.query.page) : 1;
            this.startDate = this.$route.query['start-date'] ||
                this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD');

            this.endDate = this.$route.query['end-date'] ||
                this.moment(this.moment.now()).add(1, 'days').format('YYYY-MM-DD');

            this.intervalType = this.$route.query['interval-type'] || null;

            this.brand = this.$route.query.brand || null;

            this.getMembershipStats();
        },
        methods: {
            getMembershipStats() {
                this.loading = true;

                this.updateUrl();

                api
                    .getMembershipStats({
                        start_date: this.startDate,
                        end_date: this.endDate,
                        interval_type: this.intervalType,
                        brand: this.brand ? this.brand : null
                    })
                    .then((response) => {
                        if (response) {
                            this.stats = response.data.data;
                            this.loading = false;
                            this.$nextTick(() => {
                                const paged = this.$route.query.page;

                                if (paged) {
                                    this.currentPage = Number(paged);
                                }
                            });
                        }
                    });
            },

            updateUrl() {
                const query = {};

                if (this.brand) {
                    query.brand = this.brand;
                }

                if (this.currentPage != 1) {
                    query.page = this.currentPage;
                }

                if (this.intervalType) {
                    query['interval-type'] = this.intervalType;
                }

                if (this.startDate) {
                    query['start-date'] = this.startDate;
                }

                if (this.endDate) {
                    query['end-date'] = this.endDate;
                }

                const urlParams = new URLSearchParams(query);

                window.history.pushState(
                    {},
                    null,
                    `${window.location.origin}${window.location.pathname}#${this.$route.path}?${urlParams.toString()}`,
                );
            }
        },
    };
</script>
<style>
    #stats-table.hide-items-per-page .v-data-footer__select {
        display: none;
    }
</style>
