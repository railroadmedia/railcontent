<template>
    <v-form
        ref="form"
        v-model="valid"
    >
        <v-select
            v-model="$_brand"
            label="Brand"
            :color="brandColor"
            hint="This is the brand you wish to process the order for.
                It will determine which brand's order history this order shows up in."
            :items="['drumeo', 'pianote', 'guitareo', 'singeo']"
            class="mb-4"
            persistent-hint
        ></v-select>

        <v-select
            v-if="paymentPlanOptions.length > 1"
            v-model="$_number_of_payments"
            label="Payment Plan Options"
            :color="brandColor"
            :items="paymentPlanOptions"
            item-text="label"
            item-value="value"
            persistent-hint
        ></v-select>

        <v-checkbox
            v-if="userPaymentMethods.length > 0"
            v-model="useExistingPaymentMethod"
            :color="brandColor"
            label="Use Existing Payment Method"
        ></v-checkbox>

        <v-checkbox
            v-model="dontUsePaymentMethod"
            :color="brandColor"
            label="Dont Use a Payment Method"
            :disabled="useExistingPaymentMethod"
            :rules="dontUsePaymentMethod ? validationRules.dontUsePaymentMethod : []"
            hint="Check this if you want to create a 0 dollar order"
            class="mb-3"
            persistent-hint
        ></v-checkbox>

        <div v-if="useExistingPaymentMethod">
            <v-select
                v-model="$_payment_method_id"
                label="Payment Method"
                :color="brandColor"
                :items="$_user_brand_payment_methods"
                :rules="useExistingPaymentMethod ? validationRules.paymentMethod : []"
                item-value="id"
                required
            >
                <template
                    slot="selection"
                    slot-scope="{ item }"
                >
                    <div class="input-group__selections__comma">
                        {{ getPaymentMethodData(item) }}
                    </div>
                </template>

                <template
                    slot="item"
                    slot-scope="{ item }"
                >
                    <v-list-item-content>
                        <v-list-item-subtitle>
                            {{ getPaymentMethodData(item) }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </template>
            </v-select>
        </div>

        <div v-if="!useExistingPaymentMethod && !dontUsePaymentMethod">
            <v-select
                v-model="$_gateway"
                label="Gateway"
                :color="brandColor"
                :rules="useExistingPaymentMethod ? [] : validationRules.gateway"
                hint="This is the brand you wish to create a payment method for."
                :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                persistent-hint
            ></v-select>

            <v-custom-stripe-card-form
                v-if="$_gateway"
                :key="$_gateway + '_stripe'"
                ref="stripeCardForm"
                :gateway="$_gateway"
            ></v-custom-stripe-card-form>

            <v-select
                v-model="$_country"
                label="Country"
                :color="brandColor"
                :items="countries"
                item-value="name"
                item-text="name"
                :rules="useExistingPaymentMethod ? [] : validationRules.billingCountry"
                required
            ></v-select>

            <v-select
                v-if="$_country === 'Canada'"
                v-model="$_region"
                label="Province"
                :color="brandColor"
                :items="provinces"
                :rules="useExistingPaymentMethod ? [] : ($_country === 'Canada' ? validationRules.billingRegion : [])"
            ></v-select>
        </div>

        <v-row class="mt-12">
            <v-col class="text-left">
                <v-btn
                    text
                    @click="goBack"
                >
                    <v-icon
                        left
                        dark
                    >
                        keyboard_arrow_left
                    </v-icon>
                    Back
                </v-btn>
            </v-col>
            <v-col class="text-right">
                <v-btn
                    :color="brandColor"
                    :disabled="!valid"
                    class="white--text"
                    @click="submitForm"
                >
                    Submit Order
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Utils from '@musora/helper-functions/modules/utils';
import brandColors from '../../../../api/mixins.js';
import JsonApiMethods from '../../../../mixins/json-api-methods';
import CustomStripeCardForm from '../../../../components/CustomStripeCardForm';

export default {
    name: 'PaymentForm',
    components: {
        'v-custom-stripe-card-form': CustomStripeCardForm,
    },
    mixins: [brandColors, JsonApiMethods],
    props: {
        userPaymentMethods: {
            type: Array,
            default: () => [],
        },

        userPaymentMethodsIncludedData: {
            type: Array,
            default: () => [],
        },

        paymentMethodState: {
            type: Object,
            default: () => ({ brand: 'pianote' }),
        },

        paymentPlanOptions: {
            type: Array,
            default: () => [],
        },

        orderTotal: {
            type: Number,
            default: () => 0,
        },

        cartContainsSubscription: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            valid: false,
            useExistingPaymentMethod: false,
            selectedPaymentMethod: null,
            dontUsePaymentMethod: false,
            validationRules: {
                paymentMethod: [
                    v => !!v || 'Payment Method is required',
                ],
                gateway: [
                    v => !!v || 'Gateway is required.',
                ],
                billingCountry: [
                    v => !!v || 'Billing country is required.',
                ],
                billingRegion: [
                    v => !!v || 'Billing region is required.',
                ],
                dontUsePaymentMethod: [
                    () => this.orderTotal === 0 || 'Order total must be 0',
                ],
            },
        };
    },
    computed: {
        countries: () => window.countryList,

        provinces: () => Utils.provinces(),

        $_payment_method_id: {
            get() {
                return this.paymentMethodState.payment_method_id;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'payment_method_id',
                    value,
                });
            },
        },

        $_brand: {
            get() {
                return this.paymentMethodState.brand;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'brand',
                    value,
                });
            },
        },

        $_gateway: {
            get() {
                return this.paymentMethodState.gateway;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'gateway',
                    value,
                });
            },
        },

        $_country: {
            get() {
                return this.paymentMethodState.billing_country;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'billing_country',
                    value,
                });

                if (value !== 'Canada') {
                    this.$_region = undefined;
                }
                this.$nextTick(() => this.$forceUpdate());
            },
        },

        $_region: {
            get() {
                return this.paymentMethodState.billing_region;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'billing_region',
                    value,
                });
            },
        },

        $_number_of_payments: {
            get() {
                return this.paymentMethodState.payment_plan_number_of_payments || 1;
            },
            set(value) {
                this.$emit('paymentStateChange', {
                    key: 'payment_plan_number_of_payments',
                    value,
                });
            },
        },

        $_user_brand_payment_methods: {
            get() {
                let selectedGateway = this.paymentMethodState.brand;

                return this.userPaymentMethods.filter((paymentMethod) => {
                    let method = this.getRelatedAttributesByTypeAndId(
                        paymentMethod.relationships.method.data,
                        this.userPaymentMethodsIncludedData,
                    );

                    return method.attributes.payment_gateway_name == selectedGateway;
                });
            }
        },

    },

    watch: {
        cartContainsSubscription() {
            if (this.dontUsePaymentMethod) {
                this.$refs.form.validate();
            }
        },

        orderTotal() {
            if(this.dontUsePaymentMethod){
                this.$refs.form.validate();
            }
        },
    },

    methods: {
        goBack() {
            this.$emit('goBack');
        },

        async submitForm() {
            if (this.useExistingPaymentMethod || this.dontUsePaymentMethod) {
                return this.$emit('formSubmit', {
                    paymentMethodState: this.paymentMethodState,
                    selectedPaymentMethod: this.selectedPaymentMethod,
                    dontUsePaymentMethod: this.dontUsePaymentMethod,
                });
            }

            const { stripeInstance } = this.$refs.stripeCardForm;
            const { stripeCard } = this.$refs.stripeCardForm;

            const { token, error } = await stripeInstance.createToken(stripeCard);

            if (error) {
                return this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: error.message,
                });
            }

            this.$emit('formSubmit', {
                paymentMethodState: this.paymentMethodState,
                stripeToken: token.id,
            });
        },

        getPaymentMethodData(item) {
            const method = this.getRelatedAttributesByTypeAndId(
                item.relationships.method.data,
                this.userPaymentMethodsIncludedData,
            );

            if (method.type === 'creditCard') {
                return `${method.attributes.company_name}
                    - ${method.attributes.last_four_digits}
                    (${method.attributes.payment_gateway_name})`;
            }

            if (method.type === 'paypalBillingAgreement') {
                return `Paypal - ${method.attributes.external_id} (${method.attributes.payment_gateway_name})`;
            }

            return 'N/A';
        },
    },
};
</script>
