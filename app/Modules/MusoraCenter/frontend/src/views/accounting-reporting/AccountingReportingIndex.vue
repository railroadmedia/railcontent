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
                        Accounting Reporting
                    </v-toolbar-title>

                    <template v-slot:extension>
                      <v-container class="pa-0">
                        <v-row class="pa-2 pb-0">
                            <v-col  cols="12" md="4" sm="12">
                                <v-autocomplete
                                    v-model="brand"
                                    label="Brand"
                                    color="white"
                                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                                    @keyup.enter="getAccountingReporting()"
                                >
                                </v-autocomplete>
                            </v-col>

                            <v-spacer class=".d-none .d-sm-flex"></v-spacer>

                            <v-col  cols="12" md="4" sm="12">
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
                                            label="Date - Start Of Day  - PST - XXXX-XX-XX 00:00:00"
                                            color="white"
                                            clearable
                                            v-on="on"
                                            @keyup.enter="getAccountingReporting()"
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

                            <v-col cols="12" md="4" sm="12">
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
                                            label="Date - End Of Day  - PST - XXXX-XX-XX 23:59:59"
                                            color="white"
                                            clearable
                                            v-on="on"
                                            @keyup.enter="getAccountingReporting()"
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
                        </v-row>
                        <v-row class="pa-2 pt-0 mt-0">
                            <v-btn light @click="getAccountingReporting()" class="mt-2">Search</v-btn>
                        </v-row>
                      </v-container>
                    </template>
                </v-toolbar>

                <v-data-table
                    :headers="headersProducts"
                    :items="products"
                    :items-per-page="1000"
                    :loading="loading"
                    :hide-default-footer="true"
                    mobile-breakpoint="0"
                    class="elevation-1 pt-2"
                    must-sort
                    sort-desc
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <td>
                                {{ item.attributes.name }}
                            </td>
                            <td>
                                {{ item.attributes.sku }}
                            </td>
                            <td>
                                {{ item.attributes.inventory_control_sku }}
                            </td>
                            <td>
                                {{ item.attributes.tax_paid }}
                            </td>
                            <td>
                                {{ item.attributes.shipping_paid }}
                            </td>
                            <td>
                                {{ item.attributes.finance_paid }}
                            </td>
                            <td>
                                {{ item.attributes.less_refunded }}
                            </td>
                            <td>
                                {{ item.attributes.total_quantity }}
                            </td>
                            <td>
                                {{ item.attributes.refunded_quantity }}
                            </td>
                            <td>
                                {{ item.attributes.free_quantity }}
                            </td>
                            <td>
                                {{ item.attributes.net_recurring_product }}
                            </td>
                            <td>
                                {{ item.attributes.net_product }}
                            </td>
                            <td>
                                {{ item.attributes.net_paid }}
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>

            <v-col
                class="column my-3"
                cols="12"
            >
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Summary Totals
                    </v-toolbar-title>
                </v-toolbar>
                <v-data-table
                    :headers="headersTotals"
                    :items="totals"
                    :loading="loading"
                    mobile-breakpoint="0"
                    class="elevation-1 pt-2"
                    hide-default-footer
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <td>
                                {{ item.attributes.tax_paid }}
                            </td>
                            <td>
                                {{ item.attributes.shipping_paid }}
                            </td>
                            <td>
                                {{ item.attributes.finance_paid }}
                            </td>
                            <td>
                                {{ item.attributes.refunded }}
                            </td>
                            <td>
                                {{ item.attributes.net_recurring_product }}
                            </td>
                            <td>
                                {{ item.attributes.net_product }}
                            </td>
                            <td>
                                {{ item.attributes.net_paid }}
                            </td>
                            <td>
                                {{ item.attributes.net_paid + item.attributes.refunded }}
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
import brandColors from '../../api/mixins';
import Middleware from '../../middleware/auth';
import api from '../../api/ecommerce/accounting-reporting';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';
import { Utils } from '@musora/helper-functions';

export default {
    name: 'AccountingReporting',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'accounting-reporting'); });
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
                    text: 'Accounting Reporting',
                    disabled: true,
                },
            ],
            headersProducts: [
                {
                    text: 'Product Name',
                    align: 'left',
                    value: 'attributes.name',
                },
                {
                    text: 'SKU',
                    align: 'left',
                    value: 'attributes.sku',
                    width: 100,
                },
                {
                    text: 'IC SKU',
                    align: 'left',
                    value: 'attributes.inventory_control_sku',
                    width: 100,
                },
                {
                    text: 'Tax Paid',
                    align: 'left',
                    value: 'attributes.tax_paid',
                    width: 100,
                },
                {
                    text: 'Shipping Paid',
                    align: 'left',
                    value: 'attributes.shipping_paid',
                    width: 100,
                },
                {
                    text: 'Finance Paid',
                    align: 'left',
                    value: 'attributes.finance_paid',
                    width: 100,
                },
                {
                    text: 'Less Refunded',
                    align: 'left',
                    value: 'attributes.less_refunded',
                    width: 100,
                },
                {
                    text: 'Total Quantity',
                    align: 'left',
                    value: 'attributes.total_quantity',
                    width: 60,
                },
                {
                    text: 'Refunded Quantity',
                    align: 'left',
                    value: 'attributes.refunded_quantity',
                    width: 60,
                },
                {
                    text: '(Free Quantity)',
                    align: 'left',
                    value: 'attributes.free_quantity',
                    width: 60,
                },
                {
                    text: 'Net Recurring Revenue',
                    align: 'left',
                    value: 'attributes.net_recurring_product',
                    width: 100,
                },
                {
                    text: 'Net Product Sales',
                    align: 'left',
                    value: 'attributes.net_product',
                    width: 100,
                },
                {
                    text: 'Net Paid Period',
                    align: 'left',
                    value: 'attributes.net_paid',
                    width: 100,
                },
            ],
            headersTotals: [
                {
                    text: 'Tax Paid',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Shipping Paid',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Finance Paid',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Total Refunded',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Net Recurring Revenue (L10)',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Net Product Sales (L10)',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Net Paid Period',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Total Charged (For Devs Only)',
                    align: 'left',
                    sortable: false,
                },
            ],
            endDatePicker: false,
            startDatePicker: false,
            startDate: '',
            endDate: '',
            currentPage: 1,
            totalPages: 0,
            brand: 'drumeo',
            loading: false,
            products: [],
            totals: [],
            dateTimeout: null,
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

                this.updateUrl();
                this.getAccountingReporting();
            },
        },

        page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;
            },
        },

        $_start_date: {
            get() {
                return this.startDate;
            },
            set(value) {
                this.startDate = value;

                this.updateUrl();
                clearTimeout(this.dateTimeout);

                this.dateTimeout = setTimeout(() => {
                    this.getAccountingReporting();
                }, 750);
            },
        },

        $_end_date: {
            get() {
                return this.endDate;
            },
            set(value) {
                this.endDate = value;

                this.updateUrl();
                clearTimeout(this.dateTimeout);

                this.dateTimeout = setTimeout(() => {
                    this.getAccountingReporting();
                }, 750);
            },
        },
    },
    mounted() {
        this.brand = this.$route.query.brand || 'drumeo';

        this.startDate = this.$route.query['start-date'] ||
            this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD');

        this.endDate = this.$route.query['end-date'] ||
            this.moment(this.moment.now()).format('YYYY-MM-DD');

        this.getAccountingReporting();
    },
    methods: {
        getAccountingReporting() {
            this.loading = true;

            this.updateUrl();

            api
                .getAccountingReporting({
                    brand: this.brand,
                    start_date: this.startDate,
                    end_date: this.endDate,
                })
                .then((response) => {

                    if (response) {
                        this.totals = [response.data.data];
                        this.products = response.data.included;
                        this.loading = false;
                    }

                });
        },

        updateUrl() {
            const query = {brand: this.brand};

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