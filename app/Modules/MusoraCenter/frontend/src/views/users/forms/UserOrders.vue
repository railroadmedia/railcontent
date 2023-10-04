<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Orders</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        @click="dialog = true"
                        v-on="on"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Create Order</span>
            </v-tooltip>
        </v-toolbar>

        <v-data-table
            :headers="orderHeaders"
            :items="userOrders"
            :loading="loading"
            :expanded.sync="expanded"
            item-key="id"
            :items-per-page="10"
            class="elevation-1"
        >
            <template
                v-slot:item="{ item }"
            >
                <tr
                    style="cursor:pointer;"
                    :class="[displayedPaymentsId === item.id ? 'selected-highlighted-item' : '',
                             {'deleted-table-row': !!item.attributes.deleted_at}]"
                    @click="showPayments(item)"
                >
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.attributes.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-center">
                        {{ item.id }}
                    </td>

                    <td class="text-center">
                        <v-icon :color="item.attributes.total_paid === item.attributes.total_due ? 'green' : 'red'">
                            {{ getPaidStateIcon(item) }}
                        </v-icon>
                    </td>

                    <td class="text-center">
                        {{ formatPrice(item.attributes.total_due) }}
                    </td>

                    <td class="text-center">
                        {{ formatPrice(item.attributes.total_paid) }}
                    </td>

                    <td class="text-left">
                        <ul
                            class="pa-0"
                            style="list-style-type:none;"
                        >
                            <li
                                v-for="product in getOrderProducts(item)"
                                :key="`${item.id}-${product}`"
                            >
                                {{ product }}
                            </li>
                        </ul>
                    </td>

                    <td class="text-center">
                        {{ moment.tz(item.attributes.created_at, 'UTC').tz("America/Los_Angeles").format('MMM D, Y - h:mm A') }}
                    </td>

                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    :to="{name: 'orders.edit', params:{id: item.id}}"
                                    x-small
                                    raised
                                    :color="brandColor"
                                    class="mx-1 white--text"
                                    v-on="on"
                                >
                                    <v-icon>
                                        edit
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Edit Order</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>

            <template v-slot:expanded-item="{ headers, item }">
                <td :colspan="headers.length" class="pa-0">
                    <user-payments
                        :payments="displayedPayments"
                        :item-id="item.id"
                        payment-type="order"
                        @reloadData="reloadPaymentData"
                    ></user-payments>
                </td>
            </template>

            <template v-slot:footer>
                <div class="pa-4 caption">
                    <em>Click on an order to show the payments and issue refunds.</em>
                </div>
            </template>
        </v-data-table>

        <v-dialog
            v-model="dialog"
            hide-overlay
            transition="dialog-bottom-transition"
            fullscreen
        >
            <create-order
                :user-id="userId"
                :customer-id="userId"
                :this-user="thisUser"
                :products="products.products"
                :user-addresses="userAddresses"
                :user-payment-methods="userPaymentMethods"
                :user-payment-methods-included-data="userPaymentMethodsIncludedData"
                :is-customer="isCustomer"
                @formSuccess="handleOrderCreation"
                @cancelOrder="dialog = !dialog"
            ></create-order>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import paymentsApi from '../../../api/ecommerce/payments';
import brandColors from '../../../api/mixins.js';
import UserPayments from './UserPayments';
import JsonApiMethods from '../../../mixins/json-api-methods';
import CreateOrder from './CreateOrder/CreateOrder.vue';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

export default {
    name: 'UserOrders',
    components: {
        'user-payments': UserPayments,
        'create-order': CreateOrder,
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: [Number, String],
            default: () => 0,
        },

        thisUser: {
            type: Object,
            default: () => ({}),
        },

        userOrders: {
            type: Array,
            default: () => [],
        },

        userAddresses: {
            type: Array,
            default: () => [],
        },

        userPaymentMethods: {
            type: Array,
            default: () => [],
        },

        userPaymentMethodsIncludedData: {
            type: Array,
            default: () => [],
        },

        isCustomer: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            expanded: [],
            valid: false,
            menu: false,
            dialog: false,
            loading: false,
            orderHeaders: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'ID',
                    align: 'center',
                    sortable: false,
                    width: 60,
                },
                {
                    text: 'Paid',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Total',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Total Paid',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Product',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Ordered On',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Edit',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
            ],
            displayedPayments: null,
            displayedPaymentsId: null,
            activeOrder: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
            products: state => state.products,
        }),
    },
    methods: {
        handleSuccess() {
            this.showPayments({ expanded: true });
        },

        reloadPaymentData(payload) {
            this.$emit('paymentRefunded');

            this.displayedPayments = payload;
        },

        getProductNames(item) {
            const products = item.items;
            const productKeys = Object.keys(products);
            const productNames = [];

            productKeys.forEach((key) => {
                productNames.push(
                    products[key].product.name,
                );
            });

            return productNames;
        },

        getPaidStateIcon(item) {
            if (item.attributes.total_refunded > 0) {
                return 'money_off';
            }

            if (item.attributes.total_paid === item.attributes.total_due) {
                return 'check';
            }

            return 'close';
        },

        showPayments(item) {
            this.loading = true;

            paymentsApi.getPayments({
                order_id: item.id,
            })
                .then((response) => {
                    this.loading = false;
                    if (response) {
                        this.expanded = [item];
                        this.displayedPayments = response.data;
                        this.displayedPaymentsId = item.id;
                    }
                });
        },

        showOrderDetails(order) {
            this.$router.push({ name: 'orders.details', params: { id: order.id } });
        },

        handleOrderCreation() {
            this.dialog = false;
            this.$emit('orderCreated');
        },

        formatPrice(price) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            }).format(price);
        },

        getOrderProducts(order) {
            let orderItems;

            if (order.relationships.orderItem) {
                orderItems = order.relationships.orderItem.data.map(
                    relatedOrderItem => this.getRelatedAttributesByTypeAndId(
                        relatedOrderItem,
                    ),
                );

                const products = orderItems.map(
                    orderItem => this.getRelatedAttributesByTypeAndId(
                        orderItem.relationships.product.data,
                    ),
                );

                if (products.length) {
                    return products.map(product => product.attributes.sku);
                }

                return [];
            }

            return [];
        },
    },
};
</script>
