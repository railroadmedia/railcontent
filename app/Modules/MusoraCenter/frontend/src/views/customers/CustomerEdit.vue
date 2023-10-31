<template>
    <v-container :key="userId">
        <v-row
            class="align-top"
        >
            <v-col
                class="column mb-5"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>

                <v-col class="column" cols="12">

                    <last-visited-users></last-visited-users>
                </v-col>

                <div class="px-2">
                    <h2>Customer: {{ thisCustomer.attributes.email }}</h2>
                    <p class="ma-0">
                        <strong>ID:</strong> {{ thisCustomer.id }}
                    </p>
                </div>
            </v-col>
        </v-row>

        <!-- NOTES -->
        <v-row class="align-top">
            <v-col
                cols="12"
                class="mb-4 text-center px-4 column"
            >
                <v-card>
                    <v-toolbar
                        flat
                        dark
                        :color="brandColor"
                    >
                        <v-toolbar-title>Notes</v-toolbar-title>
                    </v-toolbar>

                    <v-col
                        cols="12"
                        class="pa-0"
                    >
                        <v-textarea
                            v-model="$_notes"
                            label="Insert Note Here..."
                            auto-grow
                            solo
                            flat
                            :color="brandColor"
                            multi-line
                            hide-details
                        ></v-textarea>

                        <div class="text-right mt-2 pa-2">
                            <v-btn
                                :color="brandColor"
                                class="white--text"
                                @click.stop="submitUserNote"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-col>
                </v-card>
            </v-col>
        </v-row>

        <v-row class="align-top">
            <v-col
                cols="12"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER SUBSCRIPTIONS -->
                <user-subscriptions
                    :user-id="userId"
                    :user-payment-methods="userPaymentMethods"
                    :user-payment-methods-included-data="userPaymentMethodsIncludedData"
                    :user-subscriptions="userSubscriptions"
                    :included-data="userSubscriptionsIncludedData"
                ></user-subscriptions>

                <!-- USER ORDERS -->
                <user-orders
                    :user-id="userId"
                    :this-user="thisCustomer"
                    :user-orders="userOrders"
                    :included-data="userOrdersIncludedData"
                    :user-addresses="userAddresses"
                    :user-payment-methods="userPaymentMethods"
                    :user-payment-methods-included-data="userPaymentMethodsIncludedData"
                    :is-customer="true"
                    @orderCreated="loadUserData"
                    @paymentRefunded="loadUserData"
                ></user-orders>

                <!-- USER PAYMENT METHODS -->
                <user-payment-methods
                    :user-id="userId"
                    :user-email="thisUser.email"
                    :user-payment-methods="userPaymentMethods"
                    :included-data="userPaymentMethodsIncludedData"
                    :user-addresses="userAddresses.filter(address =>
                        address.attributes.type === 'billing')"
                ></user-payment-methods>

                <!-- USER ADDRESSES -->
                <user-addresses
                    :customer-id="userId"
                    :user-addresses="userAddresses"
                ></user-addresses>
            </v-col>
        </v-row>

        <v-row class="align-top">
            <v-col
                cols="12"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER TREEVIEW -->
                <v-custom-treeview
                    :item="thisUser"
                    object-name="User"
                ></v-custom-treeview>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import api from '../../api/users';
import cartApi from '../../api/ecommerce/cart';
import addressesApi from '../../api/ecommerce/addresses';
import paymentsApi from '../../api/ecommerce/payments';
import ordersApi from '../../api/ecommerce/orders';
import subscriptionsApi from '../../api/ecommerce/subscriptions';
import brandColors from '../../api/mixins';
import Middleware from '../../middleware/auth';
import UserSubscriptions from '../users/forms/UserSubscriptions.vue';
import UserPaymentMethods from '../users/forms/UserPaymentMethods.vue';
import UserAddresses from '../users/forms/UserAddresses.vue';
import UserOrders from '../users/forms/UserOrders.vue';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import CustomTreeview from '../../components/CustomTreeview.vue';

export default {
    name: 'CustomerEdit',
    components: {
        'user-subscriptions': UserSubscriptions,
        'user-payment-methods': UserPaymentMethods,
        'user-addresses': UserAddresses,
        'user-orders': UserOrders,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'v-custom-treeview': CustomTreeview,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.admin(vm, 'customers'); });
    },
    beforeRouteLeave(to, from, next) {
        cartApi.clearCart();
        this.state.currentUser = null;

        next();
    },
    data() {
        return {
            userId: this.$route.params.id,
            thisCustomer: { id: 0, attributes: {} },
            userSubscriptions: [],
            userSubscriptionsIncludedData: [],
            userOrders: [],
            userOrdersIncludedData: [],
            userPaymentMethods: [],
            userPaymentMethodsIncludedData: [],
            userAddresses: [],
            userPermissions: [],
            userProducts: [],
            userProductsIncludedData: [],
            customerNotes: '',
        };
    },
    computed: {
        ...mapState({
            auth: state => state.auth,
            state: state => state.users,
            products: state => state.products,
        }),

        thisUser() {
            return this.state.currentUser || { attributes: {}, id: this.userId };
        },

        breadcrumbs() {
            return [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Customers',
                    disabled: false,
                    to: { name: 'customers' },
                },
                {
                    text: this.thisUser.id,
                    disabled: true,
                },
            ];
        },

        $_notes: {
            get() {
                return this.customerNotes || this.thisCustomer.attributes.note;
            },
            set(value) {
                this.customerNotes = value;
            },
        },

        $_profile_picture_url: {
            get() {
                return this.thisUser.attributes.profile_picture_url;
            },
            set(value) {
                this.editUserField({
                    id: this.thisUser.id,
                    key: 'profile_picture_url',
                    value,
                });
            },
        },
    },
    methods: {
        ...mapActions('users', [
            'getUserById',
            'getCurrentUser',
            'editUserField',
            'setUsers',
            'editUserRole',
            'getProducts',
        ]),

        getCustomer() {
            return new Promise((resolve) => {
                api.getCustomerById(this.userId)
                    .then((response) => {
                        if (response) {
                            this.thisCustomer = response.data.data;

                            resolve();
                        } else {
                            this.$router.push({ name: '404' });
                        }
                    });
            });
        },

        getUserSubscriptions() {
            subscriptionsApi.getUserSubscriptions({
                customer_id: this.userId,
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userSubscriptions = response.data.data;
                        this.userSubscriptionsIncludedData = response.data.included;
                    }
                });
        },

        getUserOrderHistory() {
            ordersApi.getUserOrderHistory({
                customer_id: this.userId,
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userOrders = response.data.data;
                        this.userOrdersIncludedData = response.data.included;
                    }
                });
        },

        getUserPaymentMethods() {
            paymentsApi.getCustomerPaymentMethods(this.userId)
                .then((response) => {
                    if (response) {
                        this.userPaymentMethods = response.data.data;
                        this.userPaymentMethodsIncludedData = response.data.included;
                    }
                });
        },

        getUserAddresses() {
            addressesApi.getUserAddresses(undefined, {
                customer_id: this.userId,
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userAddresses = response.data.data;
                    }
                });
        },

        loadUserData() {
            this.getCustomer()
                .then(() => {
                    this.getUserSubscriptions();

                    this.getUserOrderHistory();

                    this.getUserPaymentMethods();

                    this.getUserAddresses();
                });
        },

        submitUserNote() {
            api.setCustomerNote(
                this.userId,
                this.customerNotes,
            )
                .then((resolved) => {
                    if (resolved) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Notes successfully edited!',
                        });

                        this.loadUserData();
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops, something went wrong! Notes likely not edited.',
                        });
                    }
                });
        },
    },
    mounted() {
        this.customerNotes = this.thisCustomer.attributes.note;
        this.loadUserData();
    },
};
</script>
