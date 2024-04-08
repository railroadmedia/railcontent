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
                        Retention Stats
                    </v-toolbar-title>

                    <v-btn small
                       href="https://github.com/railroadmedia/docusora/blob/main/docs/statistics/guides/musora-center/retention-reporting-tool-guide.md" target="_blank">
                        View Guide
                    </v-btn>

                    <v-spacer></v-spacer>

                    <v-toolbar-items class="align-center">
                        <v-radio-group
                            v-model="$_stats_type"
                            row
                            style="padding-top:25px;"
                        >
                            <v-radio
                                label="Retention stats"
                                value="retention"
                                color="white"
                            ></v-radio>
                            <v-radio
                                label="Average membership end"
                                value="average"
                                color="white"
                            ></v-radio>
                            <v-radio
                                label="Membership end stats"
                                value="end"
                                color="white"
                            ></v-radio>
                        </v-radio-group>
                    </v-toolbar-items>

                    <template v-slot:extension>
                        <v-row class="pa-2 mt-2">
                            <v-col>
                                <v-select
                                    v-model="brand"
                                    label="Brand"
                                    color="white"
                                    clearable
                                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                                    @keyup.enter="getStats()"
                                >
                                </v-select>
                            </v-col>

                            <v-col>
                                <v-autocomplete
                                    v-model="intervalType"
                                    label="Retention interval type"
                                    color="white"
                                    clearable
                                    :items="intervalTypes"
                                    item-text="label"
                                    item-value="key"
                                    @keyup.enter="getStats()"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-spacer class=".d-none .d-sm-flex"></v-spacer>

<!--                            <v-col>-->
<!--                                <v-menu-->
<!--                                    ref="startDatePicker"-->
<!--                                    v-model="startDatePicker"-->
<!--                                    :close-on-content-click="false"-->
<!--                                    :nudge-right="40"-->
<!--                                    transition="scale-transition"-->
<!--                                    offset-y-->
<!--                                    min-width="290px"-->
<!--                                >-->
<!--                                    <template v-slot:activator="{ on }">-->
<!--                                        <v-text-field-->
<!--                                            slot="activator"-->
<!--                                            v-model="startDate"-->
<!--                                            label="Start Date"-->
<!--                                            color="white"-->
<!--                                            single-line-->
<!--                                            clearable-->
<!--                                            v-on="on"-->
<!--                                            @keyup.enter="getStats()"-->
<!--                                        ></v-text-field>-->
<!--                                    </template>-->

<!--                                    <v-date-picker-->
<!--                                        v-model="startDate"-->
<!--                                        no-title-->
<!--                                        scrollable-->
<!--                                    >-->
<!--                                        <v-spacer></v-spacer>-->
<!--                                        <v-btn-->
<!--                                            text-->
<!--                                            :color="brandColor"-->
<!--                                            @click="startDatePicker = false"-->
<!--                                        >-->
<!--                                            Cancel-->
<!--                                        </v-btn>-->
<!--                                        <v-btn-->
<!--                                            text-->
<!--                                            :color="brandColor"-->
<!--                                            @click="startDatePicker = false"-->
<!--                                        >-->
<!--                                            OK-->
<!--                                        </v-btn>-->
<!--                                    </v-date-picker>-->
<!--                                </v-menu>-->
<!--                            </v-col>-->

<!--                            <v-col-->
<!--                                class="justify-center"-->
<!--                                style="flex-basis:60px;max-width:60px;"-->
<!--                            >-->
<!--                                <v-icon-->
<!--                                    class="mx-4"-->
<!--                                    style="height:100%;"-->
<!--                                >-->
<!--                                    arrow_right_alt-->
<!--                                </v-icon>-->
<!--                            </v-col>-->

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
                                            @keyup.enter="getStats()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                        v-model="endDate"
                                        no-title
                                        scrollable
                                        type="month"
                                        :max="moment().subtract('2', 'month').format('YYYY-MM-DD')"
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
                            <v-btn light @click="getStats()" class="mt-2">Search</v-btn>
                        </v-row>
                    </template>
                </v-toolbar>

                <v-data-table
                    :headers="$_headersStats"
                    :items="stats"
                    :loading="loading"
                    :items-per-page="100"
                    sort-by="attributes.stats_date"
                    class="elevation-1 pt-2 hide-items-per-page"
                    must-sort
                    sort-desc
                    id="stats-table"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <td>
                                {{ item.attributes.brand }}
                            </td>
                            <td>
                                {{ item.attributes.subscription_type }}
                            </td>
                            <td v-if="statsType == 'retention'">
                                {{ item.attributes.total_users_who_upgraded_or_repurchased }}
                            </td>
                            <td v-if="statsType == 'retention'">
                                {{ item.attributes.total_users_who_renewed }}
                            </td>
                            <td v-if="statsType == 'retention'">
                                {{ item.attributes.total_users_who_canceled_or_expired }}
                            </td>
                            <td v-if="statsType == 'retention'">
                                <strong>{{ item.attributes.retention_rate }}%</strong>
                            </td>
                            <td v-if="statsType == 'average'">
                                {{ item.attributes.average_membership_end }}
                            </td>
                            <td v-if="statsType == 'end'">
                                {{ item.attributes.cycles_paid }}
                            </td>
                            <td v-if="statsType == 'end'">
                                {{ item.attributes.count }}
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import { mapState } from 'vuex';
import api from '../../api/ecommerce/retention-stats';
import brandColors from '../../api/mixins';
import Middleware from '../../middleware/auth';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';
import moment from 'moment';

export default {
    name: 'RetentionStats',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'retention-stats'); });
    },
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Retention Stats',
                    disabled: true,
                },
            ],
            endDatePicker: false,
            startDatePicker: false,
            startDate: '',
            endDate: '',
            loading: false,
            stats: [],
            intervalTypes: [
                {
                    key: 'one_month',
                    label: 'One Month'
                },
                {
                    key: 'six_months',
                    label: 'Six Months'
                },
                {
                    key: 'one_year',
                    label: 'One Year'
                }
            ],
            intervalType: null,
            dateTimeout: null,
            brand: '',
            statsType: 'retention',
        };
    },
    computed: {
        ...mapState({
            auth: state => state.auth,
        }),

        $_headersStats() {
            switch(this.statsType) {
                case 'retention':

                    // total_users_in_pool
                    // total_users_who_upgraded_or_repurchased
                    // total_users_who_renewed
                    // total_users_who_canceled_or_expired
                    // retention_rate
                    // interval_start_date
                    // interval_start_end
                    return [
                        {
                            text: 'Brand',
                            align: 'left',
                            value: 'attributes.brand',
                            width: 160,
                        },
                        {
                            text: 'Subscription Type',
                            align: 'left',
                            value: 'attributes.subscription_type',
                            width: 160,
                        },
                        {
                            text: 'Total Who Upgraded Or Repurchased',
                            align: 'left',
                            value: 'attributes.total_users_who_upgraded_or_repurchased',
                            width: 160,
                        },
                        {
                            text: 'Total Who Renewed',
                            align: 'left',
                            value: 'attributes.total_users_who_renewed',
                            width: 160,
                        },
                        {
                            text: 'Total Who Canceled Or Expired',
                            align: 'left',
                            value: 'attributes.total_users_who_canceled_or_expired',
                            width: 160,
                        },
                        {
                            text: 'Retention Rate',
                            align: 'left',
                            value: 'attributes.retention_rate',
                            width: 160,
                        },
                    ];
                case 'average':
                    return [
                        {
                            text: 'Brand',
                            align: 'left',
                            value: 'attributes.brand',
                            width: 160,
                        },
                        {
                            text: 'Subscription Type',
                            align: 'left',
                            value: 'attributes.subscription_type',
                            width: 160,
                        },
                        {
                            text: 'Average Membership End',
                            align: 'left',
                            value: 'attributes.average_membership_end',
                            width: 160,
                        },
                        {
                            text: 'Interval Start Date',
                            align: 'left',
                            value: 'attributes.interval_start_date',
                            width: 160,
                        },
                        {
                            text: 'Interval End Date',
                            align: 'left',
                            value: 'attributes.interval_end_date',
                            width: 160,
                        },
                    ];
                default:
                    return [
                        {
                            text: 'Brand',
                            align: 'left',
                            value: 'attributes.brand',
                            width: 160,
                        },
                        {
                            text: 'Subscription Type',
                            align: 'left',
                            value: 'attributes.subscription_type',
                            width: 160,
                        },
                        {
                            text: 'Cycles Paid',
                            align: 'left',
                            value: 'attributes.cycles_paid',
                            width: 160,
                        },
                        {
                            text: 'Count',
                            align: 'left',
                            value: 'attributes.count',
                            width: 160,
                        },
                        {
                            text: 'Interval Start Date',
                            align: 'left',
                            value: 'attributes.interval_start_date',
                            width: 160,
                        },
                        {
                            text: 'Interval End Date',
                            align: 'left',
                            value: 'attributes.interval_end_date',
                            width: 160,
                        },
                    ];
            }
        },

        $_stats_type: {
            get() {
                return this.statsType;
            },
            set(value) {
                this.statsType = value;
                this.stats = [];

                this.dateTimeout = setTimeout(() => {
                    this.getStats();
                }, 750);
            },
        }
    },
    mounted() {
        this.initFromQuery();
        this.getStats();
    },
    methods: {
        getStats() {
            this.updateUrl();

            switch(this.statsType) {
                case 'retention':
                    this.getRetentionStats();
                break;

                case 'average':
                    this.getAverageMembershipEnd();
                break;

                default:
                    this.getMembershipEndStats();
            }
        },

        getRetentionStats() {
            this.loading = true;

            api
                .getRetentionStats({
                    start_date: moment(this.endDate).startOf('month').format('Y-MM-DD'),
                    end_date: moment(this.endDate).endOf('month').format('Y-MM-DD'),
                    interval_type: this.intervalType,
                    brand: this.brand ? this.brand : null
                })
                .then((response) => {
                    if (response) {
                        this.stats = response.data.data;
                        this.loading = false;
                    }
                });
        },

        getAverageMembershipEnd() {
            this.loading = true;

            api
                .getAverageMembershipEnd({
                    start_date: this.startDate,
                    end_date: this.endDate,
                    interval_type: this.intervalType,
                    brand: this.brand ? this.brand : null
                })
                .then((response) => {
                    if (response) {
                        this.stats = response.data.data;
                        this.loading = false;
                    }
                });
        },

        getMembershipEndStats() {
            this.loading = true;

            api
                .getMembershipEndStats({
                    start_date: this.startDate,
                    end_date: this.endDate,
                    interval_type: this.intervalType,
                    brand: this.brand ? this.brand : null
                })
                .then((response) => {
                    if (response) {
                        this.stats = response.data.data;
                        this.loading = false;
                    }
                });
        },

        initFromQuery() {
            // this.startDate = this.$route.query['start-date'] ||
            // this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD');

            this.endDate = this.$route.query['end-date'] ||
                moment().subtract(2, 'month').format('YYYY-MM');

            this.intervalType = this.$route.query['interval-type'] || null;

            this.brand = this.$route.query.brand || null;

            this.statsType = this.$route.query['stats-type'] || 'retention';
        },

        updateUrl() {
            const query = {
                'stats-type': this.statsType
            };

            if (this.brand) {
                query.brand = this.brand;
            }

            if (this.intervalType) {
                query['interval-type'] = this.intervalType;
            }

            // if (this.startDate) {
            //     query['start-date'] = this.startDate;
            // }

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
</style>
