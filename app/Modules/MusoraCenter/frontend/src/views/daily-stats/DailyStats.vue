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
                    style="height: auto"
                    extension-height="auto"
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4" style="width: 100%;">
                        Daily Statistics
                    </v-toolbar-title>

                    <template v-slot:extension style="height: auto;" >
                      <v-container class="pa-0">
                        <v-row class="pa-2 mt-2 pb-0">
                            <v-col class="" cols="12" md="3" sm="12">
                                <v-autocomplete
                                    v-model="brand"
                                    label="Brand"
                                    color="white"
                                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                                    clearable
                                    @keyup.enter="getDailyStats()"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-spacer class=".d-none .d-sm-flex"></v-spacer>

                            <v-col class="" cols="12" md="4" sm="12">
                                <v-menu
                                    ref="startDatePicker"
                                    v-model="startDatePicker"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            color="white"
                                            v-model="startDate"
                                            label="Date - Start Of Day  - PST - XXXX-XX-XX 00:00:00"
                                            clearable
                                            v-on="on"
                                            @keyup.enter="getDailyStats()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                        v-model="startDate"
                                        no-title
                                        scrollable
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>

                            <v-col cols="12"
                                md="4" sm="12"
                                class="justify-center d-none d-md-flex"
                                style="flex-basis:60px;max-width:60px;"
                            >
                                <v-icon>
                                    arrow_right_alt
                                </v-icon>
                            </v-col>

                            <v-col class="" cols="12" md="4" sm="12">
                                <v-menu
                                    ref="endDatePicker"
                                    v-model="endDatePicker"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            color="white"
                                            v-model="endDate"
                                            label="Date - End Of Day  - PST - XXXX-XX-XX 23:59:59"
                                            clearable
                                            v-on="on"
                                            @keyup.enter="getDailyStats()"
                                        ></v-text-field>
                                    </template>

                                    <v-date-picker
                                        v-model="endDate"
                                        no-title
                                        scrollable
                                    ></v-date-picker>
                                </v-menu>
                            </v-col>
                        </v-row>
                        <v-row class="pa-2 pt-0">
                          <v-col cols="12" md="12" sm="12">
                            <v-btn light @click="getDailyStats()" class="mb-3 mr-5">Search</v-btn>
                            <v-btn
                                slot="activator"
                                text
                                class="mx-0"
                                style="border: 1px solid #2fbfff;"
                                @click="grandTotalsDialog = true"
                            >
                              View Grand Totals
                            </v-btn>
                          </v-col>
                        </v-row>
                      </v-container>
                    </template>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="dailyStats"
                    no-results-text="No Results Found"
                    :loading="loading"
                    class="elevation-1"
                    :items-per-page="20"
                    :page.sync="$_page"
                    mobile-breakpoint="0"
                >
                    <template
                        v-slot:item="{ item }"
                    >
                        <tr
                            style="cursor:pointer;"
                            @click="openDailyStats(item.id)"
                        >
                            <td class="text-center">
                                {{ moment(item.attributes.day).format('MMM DD, YYYY') }}
                            </td>
                            <td class="text-center">
                                {{ item.attributes.total_number_of_orders_placed }}
                            </td>
                            <td class="text-center">
                                {{ formatPrice(
                                    item.attributes.total_sales
                                        - item.attributes.total_sales_from_renewals
                                ) }}
                            </td>
                            <td class="text-center">
                                {{ formatPrice(item.attributes.total_sales_from_renewals) }}
                            </td>
                            <td class="text-center">
                                {{ formatPrice(item.attributes.total_refunded) }}
                            </td>
                            <td class="text-center">
                                {{ item.attributes.total_number_of_successful_subscription_renewal_payments }}
                            </td>
                            <td class="text-center">
                                {{ item.attributes.total_number_of_failed_subscription_renewal_payments }}
                            </td>
                        </tr>
                    </template>

                    <template v-slot:body.append>
                        <tr class="font-weight-bold">
                            <td class="text-center">
                                Totals:
                            </td>
                            <td class="text-center">
                                {{
                                    getSumOfTotals(
                                        dailyStats.map(stat => stat.attributes.total_number_of_orders_placed)
                                    )
                                }}
                            </td>
                            <td class="text-center">
                                {{
                                    formatPrice(
                                        getSumOfTotals(
                                            dailyStats.map(stat => stat.attributes.total_sales)
                                        )
                                            - getSumOfTotals(
                                                dailyStats.map(stat => stat.attributes.total_sales_from_renewals)
                                            )
                                    )
                                }}
                            </td>
                            <td class="text-center">
                                {{
                                    formatPrice( getSumOfTotals(
                                        dailyStats.map(stat => stat.attributes.total_sales_from_renewals)
                                    ))
                                }}
                            </td>
                            <td class="text-center">
                                {{
                                    formatPrice( getSumOfTotals(
                                        dailyStats.map(stat => stat.attributes.total_refunded)
                                    ))
                                }}
                            </td>
                            <td class="text-center">
                                {{
                                    getSumOfTotals(
                                        dailyStats.map(stat => stat.attributes.total_number_of_successful_subscription_renewal_payments)
                                    )
                                }}
                            </td>
                            <td class="text-center">
                                {{
                                    getSumOfTotals(
                                        dailyStats.map(stat => stat.attributes.total_number_of_failed_subscription_renewal_payments)
                                    )
                                }}
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>

            <v-dialog
                v-model="dialog"
                max-width="750"
            >
                <v-card v-if="selectedDay">
                    <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                    >
                        <v-toolbar-title class="mr-4">
                            {{ moment(selectedDay.attributes.day).format('MMM DD, YYYY') }}
                        </v-toolbar-title>
                    </v-toolbar>

                    <v-col class="pa-4">
                        <v-row>
                            <v-col class="text-center">
                                <p class="headline mb-0">
                                    Total Revenue:
                                </p>
                                <p class="title mb-4">
                                    {{ formatPrice(selectedDay.attributes.total_sales) }}
                                </p>
                            </v-col>
                        </v-row>

                        <v-data-iterator
                            :items="selectedDailyStatsRelationships"
                            :items-per-page="100"
                            row
                            hide-default-footer
                            wrap
                        >
                            <template
                                v-slot:default="props"
                            >
                                <v-row>
                                    <v-col
                                        v-for="item in props.items"
                                        :key="item.id"
                                        cols="12"
                                        sm="6"
                                        md="4"
                                        class="pa-1"
                                    >
                                        <v-card>
                                            <v-card-title style="min-height:90px;">
                                                <span class="subtitle-2">
                                                    {{ getRelatedAttributesByTypeAndId(
                                                        item,
                                                        dailyStatsIncludedData,
                                                    ).attributes.sku }}
                                                </span>
                                            </v-card-title>
                                            <v-divider></v-divider>
                                            <v-list dense>
                                                <v-list-item>
                                                    <v-list-item-content>Orders:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ getRelatedAttributesByTypeAndId(
                                                            item,
                                                            dailyStatsIncludedData,
                                                        ).attributes.total_quantity_sold }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Order Revenue:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ formatPrice(getRelatedAttributesByTypeAndId(
                                                            item,
                                                            dailyStatsIncludedData,
                                                        ).attributes.total_sales) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Renewals:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ getRelatedAttributesByTypeAndId(
                                                            item,
                                                            dailyStatsIncludedData,
                                                        ).attributes.total_renewals }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Renewal Revenue:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ formatPrice(getRelatedAttributesByTypeAndId(
                                                            item,
                                                            dailyStatsIncludedData,
                                                        ).attributes.total_renewal_sales) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Max 1st Renewal Value:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ formatPrice(getRelatedAttributesByTypeAndId(
                                                            item,
                                                            dailyStatsIncludedData,
                                                        ).attributes.total_expected_renewal_value) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </v-list>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </template>
                        </v-data-iterator>

                        <v-row>
                            <v-col class="text-right">
                                <v-btn
                                    text
                                    @click="dialog = false"
                                >
                                    Close
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="grandTotalsDialog"
                max-width="750"
            >
                <v-card>
                    <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                    >
                        <v-toolbar-title class="mr-4">
                            Grand Totals
                        </v-toolbar-title>
                    </v-toolbar>

                    <v-col class="pa-4">
                        <v-col class="text-center">
                            <p class="headline mb-0">
                                Total Revenue:
                            </p>
                            <p class="title mb-4">
                                {{ formatPrice(grandTotalSales) }}
                            </p>
                        </v-col>

                        <v-data-iterator
                            :items="Object.keys(totalProductData)"
                            :items-per-page="100"
                            row
                            hide-default-footer
                            wrap
                        >
                            <template
                                v-slot:default="props"
                            >
                                <v-row>
                                    <v-col
                                        v-for="item in props.items"
                                        :key="item.id"
                                        cols="12"
                                        sm="6"
                                        md="4"
                                        class="pa-1"
                                    >
                                        <v-card>
                                            <v-card-title style="min-height:74px;">
                                                <span class="subtitle-2">
                                                    {{ totalProductData[item][0].attributes.sku }}
                                                </span>
                                            </v-card-title>
                                            <v-divider></v-divider>
                                            <v-list dense>
                                                <v-list-item>
                                                    <v-list-item-content>Orders:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ getSumOfTotals(
                                                            totalProductData[item].map(item => item.attributes.total_quantity_sold)
                                                        ) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Order Revenue:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ formatPrice(getSumOfTotals(
                                                            totalProductData[item].map(item => item.attributes.total_sales)
                                                        )) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Renewals:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ getSumOfTotals(
                                                            totalProductData[item].map(item => item.attributes.total_renewals)
                                                        ) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-content>Renewal Revenue:</v-list-item-content>
                                                    <v-list-item-content class="align-end">
                                                        {{ formatPrice(getSumOfTotals(
                                                            totalProductData[item].map(item => item.attributes.total_renewal_sales)
                                                        )) }}
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </v-list>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </template>
                        </v-data-iterator>

                        <v-col class="text-right">
                            <v-btn
                                text
                                class="mt-4"
                                @click="grandTotalsDialog = false"
                            >
                                Close
                            </v-btn>
                        </v-col>
                    </v-col>
                </v-card>
            </v-dialog>
        </v-row>
    </v-container>
</template>

<script>
import { mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import api from '../../api/ecommerce/daily-stats';
import JsonApiMethods from '../../mixins/json-api-methods';
import Middleware from '../../middleware/auth';

export default {
    name: 'DailyStats',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'daily-stats'); });
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
                    text: 'Daily Stats',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Date',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Orders',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Order Revenue',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Renewal Revenue',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Refunds',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Renewals',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Failed Renewals',
                    align: 'center',
                    sortable: false,
                },
            ],
            dialog: false,
            grandTotalsDialog: false,
            loading: false,
            dailyStats: [],
            dailyStatsIncludedData: [],
            selectedDay: null,
            endDatePicker: null,
            startDatePicker: null,
            endDate: '',
            startDate: '',
            brand: 'pianote',
            dateTimeout: null,
            currentPage: 1,
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

        selectedDailyStatsRelationships() {
            if (this.selectedDay) {
                return this.selectedDay.relationships.productStatistic.data;
            }

            return [];
        },

        grandTotalSales() {
            const productSales = this.dailyStatsIncludedData.map(data => data.attributes.total_sales);
            const renewalSales = this.dailyStatsIncludedData.map(data => data.attributes.total_renewal_sales);

            return this.getSumOfTotals([...productSales, ...renewalSales]);
        },

        totalProductData() {
            const data = {};

            this.dailyStatsIncludedData.forEach((stat) => {
                if (data[stat.attributes.sku] == null) {
                    data[stat.attributes.sku] = [stat];
                } else {
                    data[stat.attributes.sku].push(stat);
                }
            });

            return data;
        },
    },
    mounted() {
        this.currentPage = this.$route.query.page ? Number(this.$route.query.page) : 1;

        this.brand = this.$route.query.brand || 'pianote';

        this.startDate = this.$route.query['start-date'] ||
            this.moment(this.moment.now()).subtract(14, 'days').format('YYYY-MM-DD');

        this.endDate = this.$route.query['end-date'] ||
            this.moment(this.moment.now()).add(1, 'days').format('YYYY-MM-DD');

        this.getDailyStats();
    },
    methods: {
        getDailyStats() {
            this.loading = true;

            this.updateUrl();

            api.getDailyStats({
                brand: this.brand,
                start_date: this.startDate,
                end_date: this.endDate,
            })
                .then((response) => {
                    if (response) {

                        const paged = this.$route.query.page;

                        this.dailyStats = response.data.data;
                        this.dailyStatsIncludedData = response.data.included;
                        this.loading = false;
                        this.$_page = 1;

                        this.$nextTick(() => {
                            if (paged) {
                                this.$_page = Number(paged);
                            }
                        });
                    }
                });
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        getSumOfTotals(totalsArray) {
            return totalsArray.reduce((a, b) => a + b, 0);
        },

        openDailyStats(id) {
            this.dialog = true;

            this.selectedDay = this.dailyStats.find(stats => stats.id === id);
        },

        updateUrl() {
            const query = {};

            if (this.currentPage != 1) {
                query.page = this.currentPage;
            }

            if (this.brand) {
                query.brand = this.brand;
            }

            if (this.startDate) {
                query['start-date'] = this.startDate;
            }

            if (this.endDate) {
                query['end-date'] = this.endDate;
            }

            const urlParams = new URLSearchParams(query);

            let queryString = urlParams.toString().length ? `?${urlParams.toString()}` : '';

            window.history.pushState(
                {},
                null,
                `${window.location.origin}${window.location.pathname}#${this.$route.path}${queryString}`,
            );
        }
    },
};
</script>
