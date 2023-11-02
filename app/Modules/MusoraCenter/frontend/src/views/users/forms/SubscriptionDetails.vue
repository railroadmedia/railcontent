<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>
                {{ editingSubscription.id ? 'Edit' : 'Add New' }} Subscription
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
                    v-model="$_type"
                    label="Type*"
                    :color="brandColor"
                    :items="['subscription', 'payment plan']"
                ></v-select>

                <v-select
                    v-model="$_brand"
                    label="Brand"
                    :color="brandColor"
                    :items="['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo']"
                ></v-select>

                <v-checkbox
                    v-model="$_is_active"
                    label="Active"
                    :color="brandColor"
                ></v-checkbox>

                <v-combobox
                    v-if="$_type === 'subscription'"
                    ref="productInput"
                    v-model="$_product_id"
                    label="Product"
                    :color="brandColor"
                    :items="products.products"
                    item-text="attributes.name"
                    item-value="id"
                >
                    <template
                        slot="item"
                        slot-scope="data"
                    >
                        <v-list-item-content>
                            <v-list-item-title>{{ data.item.attributes.name }}:</v-list-item-title>
                            <v-list-item-subtitle>{{ data.item.attributes.sku }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </template>
                </v-combobox>

                <v-select
                    v-model="$_interval_type"
                    label="Payment Interval"
                    :color="brandColor"
                    :rules="validationRules.interval_type"
                    :items="['year', 'month']"
                ></v-select>

                <v-text-field
                    v-model="$_interval_count"
                    label="Interval Renewal"
                    :color="brandColor"
                    :rules="validationRules.interval_count"
                    type="number"
                    hint="This affects how many intervals need to pass before the user is billed.
                                If the interval is set to 'Monthly' and this number is set to 6,
                                user will be billed every 6 months."
                ></v-text-field>

                <v-select
                    v-model="$_currency"
                    label="Currency"
                    :color="brandColor"
                    :rules="validationRules.currency"
                    :items="currencies"
                ></v-select>

                <v-text-field
                    v-model="$_total_price"
                    label="Price Per Payment"
                    :color="brandColor"
                    :rules="validationRules.total_price"
                    :prefix="currencySymbol($_currency)"
                    hint="You have to manually add taxes if necessary"
                ></v-text-field>

                <v-select
                    v-model="$_payment_method_id"
                    label="Payment Method"
                    :color="brandColor"
                    :rules="validationRules.payment_method_id"
                    :items="userPaymentMethods"
                    item-value="id"
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
                            <v-list-item-title>{{ getPaymentMethodData(item) }}</v-list-item-title>
                        </v-list-item-content>
                    </template>
                </v-select>

                <v-text-field
                    v-model="$_total_cycles_due"
                    label="Total Cycles Due"
                    :color="brandColor"
                    type="number"
                    hint="Leave this blank to make it infinite"
                ></v-text-field>

                <v-text-field
                    v-model="$_total_cycles_paid"
                    label="Total Cycles Paid"
                    :color="brandColor"
                    type="number"
                ></v-text-field>

                <v-menu
                    ref="start_date_picker"
                    v-model="start_date_picker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="$_start_date"
                            label="Start Date"
                            :color="brandColor"
                            :rules="validationRules.start_date"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>

                    <v-date-picker
                        v-model="$_start_date"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="start_date_picker = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="start_date_picker = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <v-menu
                    ref="paid_until_picker"
                    v-model="paid_until_picker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="$_paid_until"
                            label="Paid Until"
                            :color="brandColor"
                            :rules="validationRules.paid_until"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>

                    <v-date-picker
                        v-model="$_paid_until"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="paid_until_picker = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="paid_until_picker = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <v-text-field
                        v-model="$_renewal_attempt"
                        label="Current Renewal Attempt"
                        :color="brandColor"
                        type="number"
                        hint="There are a total of 4 renewal attempts. If this number is below 5 it will automatically try to re-bill."
                ></v-text-field>

                <v-menu
                    ref="canceled_on_picker"
                    v-model="canceled_on_picker"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="$_canceled_on"
                            label="Canceled On"
                            :color="brandColor"
                            clearable
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>

                    <v-date-picker
                        v-model="$_canceled_on"
                        no-title
                        scrollable
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="canceled_on_picker = false"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            :color="brandColor"
                            @click="canceled_on_picker = false"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>

                <v-textarea
                    v-model="$_note"
                    label="Notes"
                    :color="brandColor"
                    multi-line
                    outline
                    no-resize
                    class="mt-4"
                ></v-textarea>

                <div class="text-right">
                    <v-btn
                        text
                        class="mr-1"
                        @click="cancelForm"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        :disabled="!valid"
                        @click.stop="submitForm"
                    >
                        Save
                    </v-btn>
                </div>

<!--                <v-divider-->
<!--                    v-if="editingSubscription.id !== 0"-->
<!--                    class="my-4"-->
<!--                ></v-divider>-->

<!--                <div-->
<!--                    v-if="editingSubscription.id !== 0"-->
<!--                    class="text-center"-->
<!--                >-->
<!--                    <v-btn-->
<!--                        small-->
<!--                        text-->
<!--                        color="success"-->
<!--                        @click="renewSubscription"-->
<!--                    >-->
<!--                        Renew This Subscription-->
<!--                    </v-btn>-->

<!--                    <v-btn-->
<!--                        small-->
<!--                        text-->
<!--                        color="error"-->
<!--                        @click="cancelSubscription"-->
<!--                    >-->
<!--                        Cancel This Subscription-->
<!--                    </v-btn>-->
<!--                </div>-->
            </v-form>
        </v-col>
    </v-card>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import JsonApiMethods from '../../../mixins/json-api-methods';
import api from '../../../api/ecommerce/subscriptions';
import Utils from '../../../api/utils';

export default {
    name: 'SubscriptionDetails',
    mixins: [brandColors, JsonApiMethods],
    props: {
        subscription: {
            type: Object,
            default: () => ({
                id: 0,
                attributes: {},
                relationships: {
                    order: { data: {} },
                    paymentMethod: { data: {} },
                    product: { data: {} },
                    user: { data: {} },
                },
            }),
        },

        userPaymentMethods: {
            type: Array,
            default: () => [],
        },

        userPaymentMethodsIncludedData: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            valid: false,
            start_date_picker: false,
            paid_until_picker: false,
            canceled_on_picker: false,
            editingSubscription: this.subscription,
            validationRules: {
                type: [
                    v => !!v || 'Type is required',
                ],
                brand: [
                    v => !!v || 'Brand is required',
                ],
                interval_type: [
                    v => !!v || 'Interval Type is required',
                ],
                interval_count: [
                    v => !!v || 'Interval Count is required',
                ],
                currency: [
                    v => !!v || 'Currency is required',
                ],
                total_price: [
                    v => !!v || 'Price is required',
                    v => /^[0-9]+(\.[0-9]{1,2})?$/.test(v) || 'Must be a valid price',
                ],
                payment_method_id: [
                    v => !!v || 'Payment Method is required',
                ],
                start_date: [
                    v => !!v || 'Start Date is required',
                ],
                paid_until: [
                    v => !!v || 'Paid Until is required',
                ],
            },
            currencies: Utils.currencies(),
        };
    },
    computed: {
        ...mapState({
            products: state => state.products,
        }),

        $_brand: {
            get() {
                return this.editingSubscription.attributes.brand;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'brand', val);
            },
        },

        $_type: {
            get() {
                return this.editingSubscription.attributes.type;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'type', val);
            },
        },

        $_is_active: {
            get() {
                return this.editingSubscription.attributes.is_active;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'is_active', val);
            },
        },

        $_product_id: {
            get() {
                if (this.$_type === 'subscription' && this.editingSubscription.relationships.product) {
                    return this.editingSubscription.relationships.product.data.id;
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.relationships, 'product', { data: { type: 'product', id: val.id } });
            },
        },

        $_interval_type: {
            get() {
                return this.editingSubscription.attributes.interval_type;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'interval_type', val);
            },
        },

        $_interval_count: {
            get() {
                return this.editingSubscription.attributes.interval_count;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'interval_count', val);
            },
        },

        $_currency: {
            get() {
                return this.editingSubscription.attributes.currency;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'currency', val);
            },
        },

        $_total_price: {
            get() {
                return this.editingSubscription.attributes.total_price;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_price', val);
            },
        },

        $_payment_method_id: {
            get() {
                if (this.editingSubscription.relationships.paymentMethod) {
                    return this.editingSubscription.relationships.paymentMethod.data.id;
                }

                return null;
            },
            set(val) {
                this.$set(
                    this.editingSubscription.relationships,
                    'paymentMethod',
                    { data: { type: 'paymentMethod', id: val } },
                );
            },
        },

        $_total_cycles_due: {
            get() {
                return this.editingSubscription.attributes.total_cycles_due;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_cycles_due', val);
            },
        },

        $_renewal_attempt: {
            get() {
                return this.editingSubscription.attributes.renewal_attempt;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'renewal_attempt', val);
            },
        },

        $_total_cycles_paid: {
            get() {
                return this.editingSubscription.attributes.total_cycles_paid;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'total_cycles_paid', val);
            },
        },

        $_start_date: {
            get() {
                if (this.editingSubscription.attributes.start_date) {
                    return this.moment(this.editingSubscription.attributes.start_date).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'start_date', val);
            },
        },

        $_paid_until: {
            get() {
                if (this.editingSubscription.attributes.paid_until) {
                    return this.moment(this.editingSubscription.attributes.paid_until).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'paid_until', val);
            },
        },

        $_canceled_on: {
            get() {
                if (this.editingSubscription.attributes.canceled_on) {
                    return this.moment(this.editingSubscription.attributes.canceled_on).format('Y-MM-DD');
                }

                return null;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'canceled_on', val);
            },
        },

        $_note: {
            get() {
                return this.editingSubscription.attributes.note;
            },
            set(val) {
                this.$set(this.editingSubscription.attributes, 'note', val);
            },
        },
    },
    methods: {
        cancelForm() {
            this.$refs.form.resetValidation();

            this.$emit('cancelForm');
        },

        submitForm() {
            setTimeout(() => {
                if (this.$refs.form.validate()) {
                    this.$root.$emit('pageLoading');

                    api.setUserSubscription(this.editingSubscription.id, {
                        user_id: this.userId,
                        brand: this.$_brand,
                        type: this.$_type,
                        product_id: this.$_product_id,
                        interval_type: this.$_interval_type,
                        interval_count: this.$_interval_count,
                        total_cycles_due: this.$_total_cycles_due,
                        total_cycles_paid: this.$_total_cycles_paid,
                        is_active: this.$_is_active,
                        note: this.$_note,
                        payment_method_id: this.$_payment_method_id,
                        currency: this.$_currency,
                        total_price: this.$_total_price,
                        start_date: this.$_start_date,
                        paid_until: this.$_paid_until,
                        renewal_attempt: this.$_renewal_attempt,
                        canceled_on: this.$_canceled_on,
                    })
                        .then((response) => {
                            if (response) {
                                this.$emit('formSuccess', this.editingSubscription.id ? 'edited' : 'created');

                                this.$root.$emit('displayMessage', {
                                    color: 'success',
                                    text: `Subscription successfully
                                        ${this.editingSubscription.id ? 'edited' : 'created'}`,
                                });
                            } else {
                                this.$emit('formError', this.editingSubscription.id ? 'edited' : 'created');

                                this.$root.$emit('displayMessage', {
                                    color: 'error',
                                    text: `Oops, something went wrong. Subscription likely not
                                        ${this.editingSubscription.id ? 'edited' : 'created'}`,
                                });
                            }

                            this.$root.$emit('pageLoaded');
                        });
                }
            }, 100);
        },

        cancelSubscription() {
            const confirmation = confirm('Are you sure you want to cancel this user\'s subscription?');

            if (confirmation) {
                api.setUserSubscription(this.editingSubscription.id, {
                    brand: this.editingSubscription.brand,
                    user_id: this.userId,
                    is_active: false,
                    canceled_on: this.moment(Date.now()).format('Y-MM-DD'),
                })
                    .then((response) => {
                        if (response) {
                            this.$emit('formSuccess', 'canceled');
                        } else {
                            this.$emit('formError', 'canceled');
                        }
                    });
            }
        },

        renewSubscription() {
            const confirmation = confirm('Are you sure you want to renew this user\'s subscription? '
                + 'This will charge the payment method attached to this subscription.');

            if (confirmation) {
                api.renewUserSubscription(this.editingSubscription.id)
                    .then((response) => {
                        if (response) {
                            this.$emit('formSuccess', 'renewed');
                        } else {
                            this.$emit('formError', 'renewed');
                        }
                    });
            }
        },

        currencySymbol(currency) {
            const currencyMap = {
                CAD: '$',
                USD: '$',
                GBP: '£',
                EUR: '€',
            };

            return currencyMap[currency];
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
