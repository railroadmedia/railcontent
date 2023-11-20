<template>
    <v-card class="mb-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Payment Methods</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="dialog = true"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Add New Method</span>
            </v-tooltip>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="userPaymentMethods"
            :items-per-page="5"
            class="elevation-1"
        >
            <template
                v-slot:item="{ item }"
            >
                <tr :class="{'deleted-table-row': !!item.attributes.deleted_at}">
                    <td class="text-center">
                        <v-custom-brand-icon :brand="getPaymentMethodBrand(item)"></v-custom-brand-icon>
                    </td>

                    <td class="text-center">
                        {{ getPaymentMethodType(item) }}
                    </td>

                    <td class="text-left">
                        {{ getPaymentMethodData(item) }}
                    </td>

                    <td class="text-center">
                        {{ getPaymentMethodBillingCountry(item) }}
                    </td>

                    <td class="text-center">
                        {{ getPaymentMethodBillingRegion(item) }}
                    </td>

                    <td class="text-center">
                        {{ moment(item.attributes.created_at).format('MMM D, Y') }}
                    </td>

                    <td>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white--text"
                                    :disabled="!!item.attributes.deleted_at"
                                    v-on="on"
                                    @click="deletePaymentMethod(item.id)"
                                >
                                    <v-icon>
                                        delete
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Delete Payment Method</span>
                        </v-tooltip>
                    </td>
                </tr>
            </template>
        </v-data-table>

        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>
                        Add New Payment Method
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form
                        ref="form"
                        v-model="valid"
                    >
                        <v-select
                            v-model="$_method_type"
                            label="Payment Method Type"
                            :color="brandColor"
                            :rules="validationRules.method_type"
                            hint="You can only create credit card payments"
                            :items="['credit_card']"
                            class="mb-2"
                            persistent-hint
                        ></v-select>

                        <v-select
                            v-model="$_gateway"
                            label="Gateway"
                            :color="brandColor"
                            :rules="validationRules.gateway"
                            hint="This is the brand you wish to apply the payment method to."
                            :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                            persistent-hint
                        ></v-select>

                        <v-custom-stripe-card-form
                            v-if="this.$_gateway"
                            :key="$_gateway + '_stripe'"
                            ref="stripeCardForm"
                            :gateway="$_gateway"
                        ></v-custom-stripe-card-form>

                        <v-select
                            v-model="$_billing_address_id"
                            label="Billing Address"
                            :color="brandColor"
                            :items="userAddresses"
                            item-value="id"
                            :rules="validationRules.billing_address_id"
                            :persistent-hint="userAddresses.length === 0"
                            hint="You must first create a billing address and they will show up here."
                        >
                            <template
                                slot="selection"
                                slot-scope="data"
                            >
                                <div class="input-group__selections__comma">
                                    {{ data.item.attributes.street_line_1 || 'N/A' }} -
                                    {{ data.item.attributes.country || 'N/A' }}
                                </div>
                            </template>

                            <template
                                slot="item"
                                slot-scope="data"
                            >
                                <template>
                                    <v-list-item-content v-if="userAddresses.length">
                                        <span>
                                            {{ data.item.attributes.street_line_1 || 'N/A' }} -
                                            {{ data.item.attributes.country || 'N/A' }}
                                        </span>
                                    </v-list-item-content>
                                </template>
                            </template>
                        </v-select>

                        <div class="text-right">
                            <v-btn
                                text
                                @click.stop="cancelForm"
                            >
                                Cancel
                            </v-btn>

                            <v-btn
                                :color="brandColor"
                                class="white--text"
                                @click.stop="submitForm"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import api from '../../../api/ecommerce/payments';
import brandColors from '../../../api/mixins.js';
import CustomStripeCardForm from '../../../components/CustomStripeCardForm';
import JsonApiMethods from '../../../mixins/json-api-methods';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

const defaultPaymentMethod = {
    payment_type: 'credit-card',
    credit_card_number: null,
    expiration_month: null,
    expiration_year: null,
    cvv: null,
    country: null,
    region: null,
    billing_address_id: null,
};

export default {
    name: 'UserPaymentMethods',
    components: {
        'v-custom-stripe-card-form': CustomStripeCardForm,
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userId: {
            type: Number | String,
            default: () => 0,
        },
        userEmail: {
            type: String,
            default: () => '',
        },
        userPaymentMethods: {
            type: Array,
            default: () => [],
        },
        userAddresses: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            dialog: false,
            valid: false,
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Type',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Info',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Billing Country',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Billing Region',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Created',
                    align: 'center',
                    sortable: false,
                    width: 150,
                },
                {
                    text: 'Delete',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
            ],
            newPaymentMethod: {},
            stripeInstance: null,
            stripeCard: null,
            validationRules: {
                method_type: [
                    v => !!v || 'Method type is required',
                ],
                gateway: [
                    v => !!v || 'Gateway is required.',
                ],
                credit_card_number: [
                    v => !!v || 'Credit Card Number is required.',
                ],
                expiration_month: [
                    v => !!v || 'Expiration Month is required.',
                ],
                expiration_year: [
                    v => !!v || 'Expiration Year is required.',
                ],
                cvv: [
                    v => !!v || 'CVV/CVC is required.',
                ],
                billing_address_id: [
                    v => !!v || 'Billing Address is required.',
                ],
            },
        };
    },
    computed: {
        ...mapState({
            state: state => state.users,
        }),

        $_method_type: {
            get() {
                return this.newPaymentMethod.method_type;
            },
            set(val) {
                this.$set(this.newPaymentMethod, 'method_type', val);
            },
        },

        $_gateway: {
            get() {
                return this.newPaymentMethod.gateway;
            },
            set(val) {
                this.$set(this.newPaymentMethod, 'gateway', val);
            },
        },

        $_billing_address_id: {
            get() {
                return this.newPaymentMethod.billing_address_id;
            },
            set(val) {
                this.$set(this.newPaymentMethod, 'billing_address_id', val);
            },
        },
    },
    methods: {

        openEditForm(id) {
            this.dialog = true;

            if (id !== 0) {
                this.newPaymentMethod = JSON.parse(JSON.stringify(this.findSubscriptionById(id)));
            } else {
                this.newPaymentMethod = JSON.parse(JSON.stringify(defaultPaymentMethod));
            }
        },

        async submitForm() {
            const { stripeInstance } = this.$refs.stripeCardForm;
            const { stripeCard } = this.$refs.stripeCardForm;

            const { token, error } = await stripeInstance.createToken(stripeCard);

            if (error) {
                return this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: error.message,
                });
            }

            if (this.$refs.form.validate()) {
                this.$root.$emit('pageLoading');

                api.setUserPaymentMethod(this.userId, {
                    gateway: this.$_gateway,
                    card_token: token.id,
                    address_id: this.$_billing_address_id,
                })
                    .then((resolved) => {
                        if (resolved) {
                            this.$root.$emit('displayMessage', {
                                text: 'Payment Method successfully created!',
                                color: 'success',
                            });

                            this.dialog = false;
                            this.$refs.form.reset();
                            this.$parent.getUserPaymentMethods();
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops something went wrong, Payment Method not created.',
                                color: 'error',
                            });
                        }

                        this.$root.$emit('pageLoaded');
                    });
            }
        },

        deletePaymentMethod(id) {
            const confirmation = confirm('Are you sure you wish to delete this payment method?');

            if (confirmation) {
                api.deletePaymentMethod(id)
                    .then((response) => {
                        if (response) {
                            this.$parent.getUserPaymentMethods();
                        }
                    });
            }
        },

        getPaymentMethodType(item) {
            const method = this.getRelatedAttributesByTypeAndId(item.relationships.method.data);

            if (method.type === 'creditCard') {
                return 'Credit Card';
            }

            if (method.type === 'paypalBillingAgreement') {
                return 'Paypal';
            }

            return 'N/A';
        },

        getPaymentMethodData(item) {
            const method = this.getRelatedAttributesByTypeAndId(item.relationships.method.data);

            if (method.type === 'creditCard') {
                return `${method.attributes.company_name} - ${method.attributes.last_four_digits}`;
            }

            if (method.type === 'paypalBillingAgreement') {
                return `Paypal - ${method.attributes.external_id}`;
            }

            return 'N/A';
        },

        getCreditCardData(item) {
            const method = this.getRelatedAttributesByTypeAndId(item.relationships.method.data);

            return method.attributes.company_name;
        },

        getPaypalAgreementId(item) {
            const method = this.getRelatedAttributesByTypeAndId(item.relationships.method.data);

            return method.attributes.external_id;
        },

        getPaymentMethodBrand(item) {
            const method = this.getRelatedAttributesByTypeAndId(item.relationships.method.data);

            return method.attributes.payment_gateway_name;
        },

        getPaymentMethodBillingCountry(item) {
            if (item.relationships.billingAddress) {
                const address = this.getRelatedAttributesByTypeAndId(item.relationships.billingAddress.data);

                return address.attributes.country;
            }

            return 'N/A';
        },

        getPaymentMethodBillingRegion(item) {
            if (item.relationships.billingAddress) {
                const address = this.getRelatedAttributesByTypeAndId(item.relationships.billingAddress.data);

                return address.attributes.region;
            }

            return 'N/A';
        },

        cancelForm() {
            this.dialog = false;
            this.$refs.form.reset();
        },

        findSubscriptionById(id) {
            return this.userPaymentMethods.filter(subscription => subscription.id === id)[0];
        },
    },
};
</script>
