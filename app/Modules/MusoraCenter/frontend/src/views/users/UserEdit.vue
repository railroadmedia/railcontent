<template>
    <v-container :key="userId">
        <v-row align="center">
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
        </v-row>

        <v-row
                class="align-top"
        >

            <v-col
                v-if="thisUser.id"
                cols="12"
                md="4"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER DETAILS FORM -->
                <user-details-form
                    :this-user="thisUser"
                    @formSuccess="getUserById(thisUser.id)"
                ></user-details-form>
            </v-col>

            <v-col
                v-if="thisUser.id"
                cols="12"
                md="8"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER NOTES -->
                <v-card class="mb-4">
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

                <!-- USER PERMISSIONS -->
                <user-products
                    :user-id="userId"
                    :user-products="userProducts"
                    :included-data="userProductsIncludedData"
                    @userProductEdit="loadUserData"
                ></user-products>
            </v-col>
        </v-row>

        <v-row class="align-top">
            <v-col
                v-if="thisUser.id"
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
                    :this-user="thisUser"
                    :user-orders="userOrders"
                    :included-data="userOrdersIncludedData"
                    :user-addresses="userAddresses"
                    :user-payment-methods="userPaymentMethods"
                    :user-payment-methods-included-data="userPaymentMethodsIncludedData"
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

                <!-- USER MEMBERSHIP ACTIONS -->
                <user-membership-actions
                    :user-id="userId"
                    :user-membership-actions="userMembershipActions"
                    :included-data="userMembershipActionsIncludedData"
                ></user-membership-actions>

                <!-- USER ADDRESSES -->
                <user-addresses
                    :user-id="userId"
                    :user-addresses="userAddresses"
                ></user-addresses>

                <user-access-codes
                    :user-id="userId"
                ></user-access-codes>
            </v-col>
        </v-row>

        <v-row class="align-top">
            <v-col
                v-if="thisUser.id"
                cols="12"
                md="6"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER FIELDS FORM -->
                <user-fields-form
                    :this-user="thisUser"
                    @formSuccess="getUserById(thisUser.id)"
                ></user-fields-form>
            </v-col>

            <v-col
                v-if="thisUser.id"
                cols="12"
                md="6"
                class="mb-4 text-center px-4 column"
            >

                <!-- USER SPECIAL PERMISSIONS FORM -->
                <user-special-permissions-form
                    :this-user="thisUser"
                ></user-special-permissions-form>

                <!-- USER SPECIAL PERMISSIONS FORM -->
                <user-permissions-form
                    v-if="canEditUsersPermissions"
                    :user-roles="$_user_roles"
                    @updateUserRoles="updateUserRoles"
                ></user-permissions-form>

                <!-- USER MENTOR FORM -->
                <user-mentor-form></user-mentor-form>

            </v-col>
        </v-row>

        <v-row class="align-top">
            <v-col
                v-if="thisUser.id"
                cols="12"
                class="mb-4 text-center px-4 column"
            >
                <!-- USER PASSWORD FORM -->
                <user-password-form :this-user="thisUser"></user-password-form>

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
import membershipActionsApi from '../../api/ecommerce/membership-actions';
import paymentsApi from '../../api/ecommerce/payments';
import ordersApi from '../../api/ecommerce/orders';
import subscriptionsApi from '../../api/ecommerce/subscriptions';
import userProductsApi from '../../api/ecommerce/user-products';
import brandColors from '../../api/mixins.js';
import Middleware from '../../middleware/user';
import UserAccessCodes from './forms/UserAccessCodes';
import UserDetailsForm from './forms/UserDetails';
import UserFieldsForm from './forms/UserFields';
import UserSpecialPermissionsForm from './forms/UserSpecialPermissions';
import UserPermissionsForm from './forms/UserPermissions';
import UserMentorForm from './forms/UserMentor';
import UserPasswordForm from './forms/UserPassword';
import UserSubscriptions from './forms/UserSubscriptions';
import UserPaymentMethods from './forms/UserPaymentMethods';
import UserAddresses from './forms/UserAddresses';
import UserOrders from './forms/UserOrders';
import UserProducts from './forms/UserProducts';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import CustomTreeview from '../../components/CustomTreeview';
import UserMembershipActions from "./forms/UserMembershipActions";
import axios from "axios";

export default {
    components: {
        'user-membership-actions': UserMembershipActions,
        'user-access-codes': UserAccessCodes,
        'user-details-form': UserDetailsForm,
        'user-fields-form': UserFieldsForm,
        'user-special-permissions-form': UserSpecialPermissionsForm,
        'user-permissions-form': UserPermissionsForm,
        'user-mentor-form': UserMentorForm,
        'user-password-form': UserPasswordForm,
        'user-subscriptions': UserSubscriptions,
        'user-payment-methods': UserPaymentMethods,
        'user-addresses': UserAddresses,
        'user-orders': UserOrders,
        'user-products': UserProducts,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
        'v-custom-treeview': CustomTreeview,
        'last-visited-users': LastVisistedUsers,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.userEdit(vm, to.params.id); });
    },
    beforeRouteUpdate(to, from, next) {
        this.$nextTick(() => {
            Middleware.userEdit(this, to.params.id);
            next();
        });
    },
    beforeRouteLeave(to, from, next) {
        cartApi.clearCart();
        this.state.currentUser = null;

        next();
    },
    data() {
        return {
            userId: this.$route.params.id,
            userSubscriptions: [],
            userSubscriptionsIncludedData: [],
            userOrders: [],
            userOrdersIncludedData: [],
            userPaymentMethods: [],
            userPaymentMethodsIncludedData: [],
            userAddresses: [],
            userMembershipActions: [],
            userMembershipActionsIncludedData: [],
            userPermissions: [],
            userProducts: [],
            userProductsIncludedData: [],
            userRoles: [],
            userNotes: '',
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
            products: state => state.products,
            loggedInUser: state => state.auth.currentUser,
        }),

        thisUser() {
            return this.state.currentUser || { attributes: {}, id: 0 };
        },

        canEditUsersPermissions() {
            if (this.loggedInUser && this.loggedInUser.permissions) {
                return (this.loggedInUser.permissions.indexOf('it') !== -1)
                    || (this.loggedInUser.permissions.indexOf('super_administrator') !== -1)
                    || (this.loggedInUser.permission_level === 'super_administrator');
            }

            return false;
        },

        breadcrumbs() {
            return [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Users',
                    disabled: false,
                    to: { name: 'users' },
                },
                {
                    text: this.thisUser.id,
                    disabled: true,
                },
            ];
        },

        $_notes: {
            get() {
                return this.userNotes || this.thisUser.attributes.support_note;
            },
            set(value) {
                this.userNotes = value;
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

        $_user_roles: {
            cache: false,
            get() {
                return this.userRoles.map(({role}) => role);
            }
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

        resetUserAvatar() {
            const confirmation = confirm('Are you sure you wish to reset this users Avatar?');

            if (confirmation) {
                this.$_profile_picture_url = 'https://dmmior4id2ysr.cloudfront.net/assets/images/avatar.jpg';

                api.setUserAttributes(this.userId, {
                    profile_picture_url: this.$_profile_picture_url,
                });
            }
        },

        getUserSubscriptions() {
            subscriptionsApi.getUserSubscriptions({
                user_id: this.userId,
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
                user_id: this.userId,
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
            paymentsApi.getUserPaymentMethods(this.userId)
                .then((response) => {
                    if (response) {
                        this.userPaymentMethods = response.data.data;
                        this.userPaymentMethodsIncludedData = response.data.included;
                    }
                });
        },

        getUserAddresses() {
            addressesApi.getUserAddresses(this.userId, {
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userAddresses = response.data.data;
                    }
                });
        },

        getMembershipActions() {
            membershipActionsApi.getMembershipActions(this.userId, {
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userMembershipActions = response.data.data;
                        this.userMembershipActionsIncludedData = response.data.included;
                    }
                });
        },

        getUserProducts() {
            userProductsApi.getUserProducts(this.userId, {
                limit: 100,
            })
                .then((response) => {
                    if (response) {
                        this.userProducts = response.data.data;
                        this.userProductsIncludedData = response.data.included;
                    }
                });
        },

        getUserRoles() {
            api.getUserRoles(this.userId)
                .then((response) => {
                    if (response) {
                        this.userRoles = response.data.results;
                    }
                });
        },

        loadUserData() {
            this.getUserSubscriptions();

            this.getUserOrderHistory();

            this.getUserPaymentMethods();

            this.getUserAddresses();

            this.getMembershipActions();

            this.getUserProducts();

            this.getUserRoles();
        },

        updateUserRoles({ roles }) {
            let currentRolesMap = {};
            let newRolesMap = {};
            let addRoles = [];
            let removeRolesIds = [];

            this.userRoles.forEach(({ role, id }) => {
                currentRolesMap[role] = id;
            });

            roles.forEach((role) => {
                newRolesMap[role] = true;

                if (!currentRolesMap[role]) {
                    addRoles.push(role);
                }
            });

            this.$_user_roles.forEach((role) => {
                if (!newRolesMap[role]) {
                    removeRolesIds.push(currentRolesMap[role]);
                }
            });

            if (addRoles.length || removeRolesIds.length) {
                api.updateUserRoles(this.userId, addRoles, removeRolesIds)
                    .then(this.getUserRoles);
            }
        },

        submitUserNote() {
            api.setUserAttributes(this.userId, {
                support_note: this.userNotes,
            })
                .then((resolved) => {
                    if (resolved) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Notes successfully edited!'
                        });

                        api.getUserById(this.userId)
                            .then((response) => {
                                this.getCurrentUser(response.data.data);
                            });
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Oops, something went wrong! Notes likely not edited.'
                        });
                    }
                });
        },
    },
    mounted() {
        this.userNotes = this.thisUser.attributes.support_note;
        this.loadUserData();
    },
};
</script>
