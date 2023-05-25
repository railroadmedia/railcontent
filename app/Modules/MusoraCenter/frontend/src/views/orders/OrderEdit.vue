<template>
    <v-container>
        <v-slide-y-transition mode="out-in">
            <v-row
                class="align-top"
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
                    cols="12"
                    class="mt-4 mb-2 text-center column"
                    style="margin:0 auto;"
                >
                    <v-row v-if="currentOrder">
                        <v-col
                            cols="12"
                            md="6"
                            class="text-left px-4 column"
                        >
                            <v-card class="edit-form">
                                <v-toolbar
                                    flat
                                    dark
                                    :color="brandColor"
                                >
                                    <v-toolbar-title>Order Details</v-toolbar-title>
                                </v-toolbar>

                                <v-col class="pa-4">
                                    <h1 class="title mb-2">
                                        <strong>User:</strong>
                                    </h1>
                                    <v-list
                                        two-line
                                        dense
                                        class="mb-6"
                                    >
                                        <v-list-item
                                            :to="{name: currentUser.type === 'user' 
                                                      ? 'users.edit' : 'customers.edit',
                                                  params:{id: currentUser.id}}"
                                        >
                                            <v-list-item-avatar>
                                                <img
                                                    :src="currentUser.attributes.profile_picture_url ||
                                                        'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.jpg'"
                                                >
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-title v-html="currentUser.attributes.email"></v-list-item-title>
                                                <v-list-item-subtitle v-html="currentUser.id"></v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>

                                    <h1 class="title mb-2">
                                        <strong>Products:</strong>
                                    </h1>
                                    <v-list
                                        two-line
                                        dense
                                        class="mb-6"
                                    >
                                        <v-list-item
                                            v-for="(product, i) in products"
                                            :key="product.id"
                                            :to="{name: 'products.edit', params:{id: product.id}}"
                                        >
                                            <v-list-item-avatar>
                                                <img :src="product.attributes.thumbnail_url">
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-title v-html="product.attributes.name"></v-list-item-title>
                                                <v-list-item-subtitle v-html="product.attributes.sku"></v-list-item-subtitle>
                                            </v-list-item-content>

                                            <v-list-item-action>
                                                {{
                                                    getRelatedAttributesByTypeAndId(
                                                        currentOrder.relationships.orderItem.data[i],
                                                        currentOrderIncludedData,
                                                    ).attributes.quantity
                                                }}
                                            </v-list-item-action>
                                        </v-list-item>
                                    </v-list>

                                    <h1
                                        v-if="billingAddress != null"
                                        class="title mb-2"
                                    >
                                        <strong>Billing Address:</strong>
                                    </h1>
                                    <v-list
                                        v-if="billingAddress != null"
                                        three-line
                                        dense
                                        :class="shippingAddress == null ? '' : 'mb-4'"
                                    >
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title v-if="billingAddress.attributes.street_line_1">
                                                    {{ billingAddress.attributes.street_line_1 }}
                                                </v-list-item-title>
                                                <v-list-item-subtitle v-if="billingAddress.attributes.street_line_2">
                                                    {{ billingAddress.attributes.street_line_2 }}
                                                </v-list-item-subtitle>
                                                <v-list-item-subtitle>
                                                    {{ billingAddress.attributes.city }}
                                                    {{ billingAddress.attributes.region }}
                                                    {{ billingAddress.attributes.country }}
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>

                                    <h1
                                        v-if="shippingAddress != null"
                                        class="title mb-2"
                                    >
                                        <strong>Shipping Address:</strong>
                                    </h1>
                                    <v-list
                                        v-if="shippingAddress != null"
                                        three-line
                                        dense
                                    >
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title v-if="shippingAddress.attributes.street_line_1">
                                                    {{ shippingAddress.attributes.street_line_1 }}
                                                </v-list-item-title>
                                                <v-list-item-subtitle v-if="shippingAddress.attributes.street_line_2">
                                                    {{ shippingAddress.attributes.street_line_2 }}
                                                </v-list-item-subtitle>
                                                <v-list-item-subtitle>
                                                    {{ shippingAddress.attributes.city }},
                                                    {{ shippingAddress.attributes.region }},
                                                    {{ shippingAddress.attributes.country }}
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-col>
                            </v-card>
                        </v-col>

                        <v-col
                            cols="12"
                            md="6"
                            class="px-4 column"
                        >
                            <order-totals
                                :current-order="currentOrder"
                                @updateOrder="handleOrderUpdate"
                                @formSuccess="getOrder"
                            />
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card>
                                <v-toolbar
                                    flat
                                    dark
                                    :color="brandColor"
                                >
                                    <v-toolbar-title>Payments & Refunds</v-toolbar-title>
                                </v-toolbar>

                                <user-payments
                                    :payments="payments"
                                    :item_id="orderId"
                                    payment-type="order"
                                    @reloadData="getOrder"
                                ></user-payments>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-slide-y-transition>
    </v-container>
</template>
<script>
import brandColors from '../../api/mixins.js';
import OrderTotals from './forms/OrderTotals';
import api from '../../api/ecommerce/orders';
import userApi from '../../api/users';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import Middleware from '../../middleware/order';
import JsonApiMethods from '../../mixins/json-api-methods';
import UserPayments from '../users/forms/UserPayments';

export default {
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'user-payments': UserPayments,
        'order-totals': OrderTotals,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.orderEdit(vm); });
    },
    data() {
        return {
            currentOrder: {
                id: 0,
                attributes: {},
                relationships: {},
            },
            currentUser: {
                id: 0,
                attributes: {},
            },
            currentOrderIncludedData: [],
        };
    },
    computed: {
        orderId() {
            return this.$route.params.id;
        },

        breadcrumbs() {
            return [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Orders',
                    disabled: false,
                    to: { name: 'orders' },
                },
                {
                    text: this.$route.params.id,
                    disabled: true,
                },
            ];
        },

        products() {
            return this.getRelatedDataByType('product', this.currentOrderIncludedData);
        },

        user: {
            cache: false,
            get() {
                if (this.currentOrder.relationships.user == null) {
                    return { id: 0, attributes: {} };
                }

                return this.getRelatedAttributesByTypeAndId(
                    this.currentOrder.relationships.user.data,
                    this.currentOrderIncludedData,
                );
            },
        },

        payments() {
            return { data: this.getRelatedDataByType('payment', this.currentOrderIncludedData) };
        },

        billingAddress() {
            return this.getRelatedDataByType('address', this.currentOrderIncludedData)
                .find(address => address.attributes.type === 'billing') || null;
        },

        shippingAddress() {
            return this.getRelatedDataByType('address', this.currentOrderIncludedData)
                .find(address => address.attributes.type === 'shipping') || null;
        },
    },
    methods: {
        getOrder() {
            this.$root.$emit('pageLoading');

            api.getOrderById(this.orderId)
                .then((response) => {
                    this.$root.$emit('pageLoaded');

                    if (response) {
                        this.currentOrder = response.data.data;
                        this.currentOrderIncludedData = response.data.included;

                        if (response.data.data.relationships.user) {
                            this.getUser(response.data.data.relationships.user.data.id);
                        }

                        if (response.data.data.relationships.customer) {
                            this.getCustomer(response.data.data.relationships.customer.data.id);
                        }

                        this.$nextTick(() => this.$forceUpdate());
                    }
                });
        },

        getUser(user_id) {
            userApi.getUserById(user_id)
                .then((response) => {
                    if (response) {
                        this.currentUser = response.data.data;
                    }
                });
        },

        getCustomer(customer_id) {
            userApi.getCustomerById(customer_id)
                .then((response) => {
                    if (response) {
                        this.currentUser = response.data.data;
                    }
                });
        },

        handleOrderUpdate({ key, value }) {
            this.$set(this.currentOrder.attributes, key, value);
        },

        reloadPaymentData(payload) {
            this.displayedPayments = payload;
        },
    },
};
</script>
<style>
</style>
