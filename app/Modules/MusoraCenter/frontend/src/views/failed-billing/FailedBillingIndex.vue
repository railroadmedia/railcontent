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

            <v-col class="column" cols="12">

                <last-visited-users></last-visited-users>
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
                        Failed Billing
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-toolbar-items class="align-center">
                        <v-radio-group
                            v-model="failedBillingType"
                            row
                            style="padding-top:25px;"
                        >
                            <v-radio
                                label="Subscriptions"
                                value="subscription"
                                color="white"
                            ></v-radio>
                            <v-radio
                                label="Payment Plans"
                                value="payment plan"
                                color="white"
                            ></v-radio>
                        </v-radio-group>

                        <v-btn
                            text
                            download
                            :href="csvDownloadUrl"
                        >
                            Export CSV
                        </v-btn>
                    </v-toolbar-items>

                    <template v-slot:extension>
                        <v-row class="pa-2 mt-2">
                            <v-col>
                                <v-text-field
                                    v-model="searchTerm"
                                    append-icon="search"
                                    label="Search"
                                    color="white"
                                    single-line
                                    hide-details
                                ></v-text-field>
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
                                            @keyup.enter="getFailedBilling()"
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
                                            @keyup.enter="getFailedBilling()"
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
                            <v-btn light @click="getFailedBilling()" class="mt-2">Filter</v-btn>
                        </v-row>
                    </template>
                </v-toolbar>

                <v-data-table
                    :headers="headers"
                    :items="failedBillingData"
                    :items-per-page="15"
                    :loading="loading"
                    :search="searchTerm"
                    :expanded.sync="expanded"
                    :page.sync="$_page"
                    class="elevation-1"
                    must-sort
                    sort-desc
                    sort-by="attributes.created_at"
                >
                    <template v-slot:item="{ item }">
                        <tr
                            :class="selectedItemId === item.id ? 'selected-highlighted-item' : ''"
                            @click="showPayments(item)"
                        >
                            <td class="text-center">
                                <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                            </td>

                            <td>
                                {{ getFailedBillingUser(item) }}
                            </td>

                            <td class="text-center">
                                {{ formatPrice(item.attributes.total_price) }}
                            </td>

                            <td class="text-center">
                                {{ moment(item.attributes.paid_until).format('MMM D, Y') }}
                            </td>

                            <td class="text-center">
                                {{ item.attributes.total_cycles_paid }}
                                <strong >&nbsp;/&nbsp;</strong>
                                {{ item.attributes.total_cycles_due || '∞' }}
                            </td>

                            <td
                                class="text-center"
                                v-html="getFailedBillingStatus(item)"
                            >
                            </td>

                            <td>
                                {{ item.attributes.note }}
                            </td>

                            <td>
                                {{ moment(item.attributes.created_at).format('MMM D, Y') }}
                            </td>

                            <td class="text-center">
                                {{ item.attributes.renewal_attempt }}
                            </td>

                            <td class="text-center">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            fab
                                            x-small
                                            raised
                                            :color="brandColor"
                                            class="mx-1 white--text"
                                            :to="getRouterLinkToUserEdit(item)"
                                            v-on="on"
                                        >
                                            <v-icon>
                                                person
                                            </v-icon>
                                        </v-btn>
                                    </template>

                                    <span>Go to User</span>
                                </v-tooltip>
                            </td>
                        </tr>
                    </template>

                    <template v-slot:expanded-item="{ headers, item }">
                        <td :colspan="headers.length" class="pa-0">
                            <user-payments
                                :payments="displayedPayments"
                                :item_id="item.id"
                                payment-type="subscription"
                                @reloadData="reloadPaymentData"
                            ></user-payments>
                        </td>
                    </template>
                </v-data-table>

                <v-dialog
                    v-model="dialog"
                    max-width="500px"
                >
                    <subscription-details
                        v-if="editingSubscription != null"
                        :subscription="editingSubscription"
                        :user-payment-methods="userPaymentMethods"
                        :user-payment-methods-included-data="userPaymentMethodsIncludedData"
                        @cancelForm="dialog = false"
                        @formSuccess="handleFormSuccess"
                    ></subscription-details>
                </v-dialog>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import { mapState } from 'vuex';
import axios from 'axios';
import brandColors from '../../api/mixins';
import Middleware from '../../middleware/auth';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';
import api from '../../api/ecommerce/subscriptions';
import SubscriptionDetails from '../users/forms/SubscriptionDetails.vue';
import UserPayments from '../users/forms/UserPayments.vue';
import paymentsApi from '../../api/ecommerce/payments';
import CustomBrandIcon from '../../components/CustomBrandIcon.vue';
import { Utils } from '@musora/helper-functions'

export default {
    name: 'FailedBilling',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'user-payments': UserPayments,
        'subscription-details': SubscriptionDetails,
        'v-custom-brand-icon': CustomBrandIcon,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'failed-billing'); });
    },
    data() {
        return {
            loading: false,
            dialog: false,
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Failed Billing',
                    disabled: true,
                },
            ],
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: true,
                    value: 'attributes.brand',
                    width: 100,
                },
                {
                    text: 'User',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Price',
                    align: 'center',
                    sortable: true,
                    value: 'attributes.total_price',
                    width: 100,
                },
                {
                    text: 'Paid Until',
                    align: 'center',
                    value: 'attributes.paid_until',
                    sortable: true,
                    width: 120,
                },
                {
                    text: 'Paid/Due',
                    align: 'center',
                    value: 'attributes.total_cycles_paid',
                    sortable: true,
                    width: 100,
                },
                {
                    text: 'Status',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Note',
                    align: 'left',
                    sortable: false,
                    width: 175,
                },
                {
                    text: 'Failed On',
                    align: 'left',
                    value: 'attributes.created_at',
                    sortable: true,
                    width: 120,
                },
                {
                    text: 'Renew Attempts',
                    align: 'center',
                    value: 'attributes.renewal_attempt',
                    sortable: true,
                    width: 140,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    width: 200,
                },
            ],
            searchTerm: '',
            failedBillingType: 'subscription',
            endDatePicker: false,
            startDatePicker: false,
            startDate: '',
            endDate: '',
            editingSubscription: null,
            failedBillingData: [],
            failedBillingIncludedData: [],
            currentPage: 1,
            totalPages: 0,
            expanded: [],
            userPaymentMethods: null,
            userPaymentMethodsIncludedData: null,
            displayedPayments: null,
            selectedItemId: null,
            dateTimeout: null,
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

        csvDownloadUrl() {
            return axios.getUri({
                url: '/ecommerce/failed-billing',
                params: {
                    type: this.failedBillingType,
                    page: this.page,
                    brands: ['pianote', 'guitareo', 'singeo'],
                    limit: 1000,
                    big_date_time: this.endDate,
                    small_date_time: this.startDate,
                    csv: true,
                },
            });
        },
    },
    watch: {
        dialog() {
            if (this.dialog === false) {
                this.editingSubscription = null;
                this.userPaymentMethods = null;
                this.userPaymentMethodsIncludedData = null;
            }
        },
    },
    mounted() {
        this.currentPage = this.$route.query.page ? Number(this.$route.query.page) : 1;
        this.startDate = this.$route.query['start-date'] ||
            this.moment(this.moment.now()).subtract(1, 'week').format('YYYY-MM-DD');

        this.endDate = this.$route.query['end-date'] ||
            this.moment(this.moment.now()).add(1, 'days').format('YYYY-MM-DD');

        this.failedBillingType = this.$route.query.type || 'subscription';

        this.updateUrl();

        this.getFailedBilling();
    },
    methods: {
        openEditForm(item) {
            this.editingSubscription = Utils.createObjectCopy(item);

            this.$root.$emit('pageLoading');

            this.getUserPaymentMethods(item.relationships.user.data.id)
                .then(() => {
                    this.$nextTick(() => {
                        this.$root.$emit('pageLoaded');
                        this.dialog = true;

                        this.$forceUpdate();
                    });
                });
        },

        getFailedBilling() {
            this.loading = true;
            this.updateUrl();

            api.getFailedBilling({
                type: this.failedBillingType,
                page: 1,
                brands: ['drumeo', 'pianote', 'guitareo', 'singeo'],
                limit: 1000,
                end_date: this.endDate,
                start_date: this.startDate,
            })
                .then((response) => {
                    const paged = this.$route.query.page;

                    if (response) {
                        this.failedBillingData = response.data.data;
                        this.failedBillingIncludedData = response.data.included;
                        this.totalPages = response.data.meta.pagination.total_pages;
                    }

                    if (paged) {
                        this.$_page = Number(paged);
                    }

                    this.loading = false;
                });
        },

        getUserPaymentMethods(user_id) {
            return new Promise((resolve) => {
                paymentsApi.getUserPaymentMethods(user_id)
                    .then((response) => {
                        if (response) {
                            this.userPaymentMethods = response.data.data;
                            this.userPaymentMethodsIncludedData = response.data.included;
                        }

                        resolve();
                    });
            });
        },

        getFailedBillingUser(item) {
            if (item.relationships.user) {
                const user = this.getRelatedAttributesByTypeAndId(
                    item.relationships.user.data,
                    this.failedBillingIncludedData,
                );

                return user.attributes.email;
            }

            return 'N/A';
        },

        getFailedBillingProduct(item) {
            if (item.attributes.type === 'payment plan') {
                let orderItems;
                const order = this.getRelatedAttributesByTypeAndId(
                    item.relationships.order.data,
                    this.failedBillingIncludedData,
                );

                if (order.relationships.orderItem.data.length) {
                    orderItems = order.relationships.orderItem.data.map(
                        relatedOrderItem => this.getRelatedAttributesByTypeAndId(
                            relatedOrderItem,
                            this.failedBillingIncludedData,
                        ),
                    );

                    const products = orderItems.map(
                        orderItem => this.getRelatedAttributesByTypeAndId(
                            orderItem.relationships.product.data,
                            this.failedBillingIncludedData,
                        ),
                    );

                    if (products.length) {
                        return products.map(product => product.attributes.sku);
                    }

                    return [];
                }

                return [];
            }

            if (item.relationships.product) {
                const product = this.getRelatedAttributesByTypeAndId(
                    item.relationships.product.data,
                    this.failedBillingIncludedData,
                );

                return product ? [product.attributes.sku] : [];
            }

            return [];
        },

        getFailedBillingStatus(item) {
            if (item.attributes.state === 'canceled') {
                return '<span class="error--text">Canceled</span>';
            }

            if (item.attributes.state === 'suspended') {
                return '<span class="warning--text">Suspended</span>';
            }

            if (item.attributes.state === 'stopped') {
                return '<span class="error--text">Stopped</span>';
            }

            return '<span class="success--text">Active</span>';
        },

        renewSubscription(subscription_id) {
            const confirmation = confirm('Are you sure you want to renew this user\'s subscription? '
                + 'This will charge the payment method attached to this subscription.');

            if (confirmation) {
                this.$root.$emit('pageLoading');

                api.renewUserSubscription(subscription_id)
                    .then(({ response, error }) => {
                        if (
                            response
                            && response.data
                            && response.data.data
                            && (
                                response.data.data.type == 'subscription'
                                || response.data.data.type == 'payment plan'
                            )
                        ) {
                            this.$root.$emit('displayMessage', {
                                color: 'success',
                                text: 'Subscription successfully renewed!',
                            });
                        } else {
                            let message = 'Oops something went wrong! Subscription was not renewed.';

                            if (error && error.errors && error.errors.detail) {
                                message = 'Error renewing subscription: ' + error.errors.detail;
                            }

                            this.$root.$emit('displayMessage', {
                                text: message,
                                color: 'error',
                                timeout: 7000,
                            });
                        }

                        this.$root.$emit('pageLoaded');
                    });
            }
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        showPayments(item) {
            this.loading = true;
            this.selectedItemId = item.id;

            paymentsApi.getPayments({
                subscription_id: item.id,
            })
                .then((response) => {
                    this.loading = false;

                    if (response) {
                        this.expanded = [item];
                        this.displayedPayments = response.data;
                    }
                });
        },

        reloadPaymentData(payload) {
            this.displayedPayments = payload;
        },

        handleFormSuccess() {
            this.dialog = false;
            this.displayedPayments = null;
            this.selectedItemId = null;
            this.expanded = [];

            this.getFailedBilling();
        },

        updateUrl() {
            const query = {type: this.failedBillingType};

            if (this.$_page != 1) {
                query.page = this.$_page;
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
        },

        getRouterLinkToUserEdit(item) {
            let link = { name: '404' };

            if (
                item.relationships
                && item.relationships.user
                && item.relationships.user.data
                && item.relationships.user.data.id
            ) {
                link = { name: 'users.edit', params: { id: item.relationships.user.data.id }};
            } else {
                console.log('Invalid relationship to user, for subscription: %s', JSON.stringify(item));
            }

            return link;
        }
    },
};
</script>
