<template>
    <v-col class="pa-0 pl-6">
        <v-data-table
            class="nested-table user-payments-table"
            :headers="paymentHeaders"
            :items="payments.data"
            :items-per-page="10"
        >
            <template
                v-slot:item="{ item }"
            >
                <tr>
                    <td class="text-center">
                        {{ Number(item.attributes.total_due || 0).toFixed(2) }}
                    </td>
                    <td
                        class="text-center"
                        :class="item.attributes.total_paid < item.attributes.total_due
                            ? 'error--text' : 'success--text'"
                    >
                        {{ Number(item.attributes.total_paid || 0).toFixed(2) }}
                    </td>
                    <td
                        class="text-center"
                        :class="{'warning--text': item.attributes.total_refunded > 0}"
                    >
                        {{ Number(item.attributes.total_refunded || 0).toFixed(2) }}
                    </td>
                    <td class="text-center">
                        {{ item.attributes.attempt_number }}
                    </td>
                    <td class="text-center">
                        {{ moment(item.attributes.created_at).format('MMM D, Y HH:mm A') }}
                    </td>
                    <td class="text-left">
                        {{ item.attributes.message }}
                    </td>
                    <td
                        class="text-left"
                        v-html="getPaymentMethodData(item)">
                    </td>
                    <td
                        class="text-left"
                        v-html="getExternalInfo(item)">
                        {{ item.attributes.external_provider }} - {{ item.attributes.external_id }}
                    </td>
                    <td class="text-center">
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="error"
                                    class="mx-1 white--text"
                                    :disabled="item.attributes.total_refunded === item.attributes.total_paid"
                                    v-on="on"
                                    @click="openRefundForm(item.id)"
                                >
                                    <v-icon>
                                        money_off
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Issue Refund</span>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="info"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    target="_blank"
                                    :href="viewInvoiceUrl(item.id)"
                                >
                                    <v-icon>
                                        receipt
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>View Invoice</span>
                        </v-tooltip>
                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    fab
                                    x-small
                                    raised
                                    color="success"
                                    class="mx-1 white--text"
                                    v-on="on"
                                    @click="resendInvoice(item.id)"
                                >
                                    <v-icon>
                                        send
                                    </v-icon>
                                </v-btn>
                            </template>

                            <span>Resend Invoice</span>
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
                        Refund Payment
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
                        <h4 class="subtitle-1">
                            Original Payment:
                            <strong>
                                {{ currencySymbol($_refund_currency) }}
                                {{ refundingPayment.attributes.total_paid }}
                            </strong>
                        </h4>

                        <p v-if="refundingPayment.attributes.external_provider != 'stripe' && refundingPayment.attributes.external_provider != 'paypal'">
                            <strong>** This is not a stripe or paypal payment and therefore will not be actually refunded. You can still however mark this payment as refunded if it was manually refunded elsewhere like the Google IAP Console.</strong>
                        </p>

                        <v-divider class="mt-4 mb-6"></v-divider>

                        <v-text-field
                            v-model="$_refund_currency"
                            label="Currency"
                            :color="brandColor"
                            hint="This value is read only"
                            class="mb-6"
                            persistent-hint
                            readonly
                        ></v-text-field>

                        <v-text-field
                            v-model.lazy="refundAmount"
                            label="Refund Amount"
                            :color="brandColor"
                            :rules="validationRules.refund_amount"
                            :prefix="currencySymbol($_refund_currency)"
                        ></v-text-field>

                        <v-textarea
                            v-model="refund_note"
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
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-col>
</template>
<script>
    import api from '../../../api/ecommerce/payments';
    import brandColors from '../../../api/mixins.js';
    import JsonApiMethods from '../../../mixins/json-api-methods';

    const defaultPayment = {
    id: 0,
    attributes: {},
    relationships: {
        order: { data: {} },
        subscription: { data: {} },
    },
};

export default {
    name: 'UserPayments',
    mixins: [brandColors, JsonApiMethods],
    props: {
        itemId: {
            type: String | Number,
            default: () => 0,
        },
        payments: {
            type: Object,
            default: () => ({
                data: [],
                included: [],
                meta: {},
            }),
        },
        paymentType: {
            type: String,
            default: () => 'order',
        },
    },
    data() {
        return {
            dialog: false,
            valid: false,
            paymentHeaders: [
                {
                    text: 'Due',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Paid',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Refunded',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Attempt #',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Paid On',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Message',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Charged Payment Method',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'External Info',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                },
            ],
            refundingPayment: JSON.parse(JSON.stringify(defaultPayment)),
            refund_note: '',
            validationRules: {
                refund_amount: [
                    v => !!v || 'Refund Amount is required.',
                ],
            },
            refundAmount: 0,
        };
    },
    computed: {
        $_payment_id: {
            cache: false,
            get() {
                return this.refundingPayment.id;
            },
            set(value) {
                this.refundingPayment.id = value;
            },
        },

        $_refund_currency: {
            cache: false,
            get() {
                return this.refundingPayment.attributes.currency;
            },
            set(val) {
                this.$set(this.refundingPayment.attributes, 'currency', val);
            },
        },

        $_refund_amount: {
            cache: false,
            get() {
                return this.refundAmount;
            },
            set(value) {
                this.refundAmount = value;
            },
        },

        $_refund_note: {
            get() {
                return this.refundingPayment.attributes.note;
            },
            set(val) {
                this.$set(this.refundingPayment.attributes, 'note', val);
            },
        },

        $_gateway() {
            return this.refundingPayment.attributes.gateway_name;
        },
    },
    methods: {
        getPaymentMethodData(payment) {
            if (payment.relationships === undefined) {
                return `${payment.attributes.type.replace(/_/g, ' ')}`;
            }

            const paymentMethodId = payment.relationships.paymentMethod.data.id;

            const paymentMethod = this.payments.included.filter(
                included => included.type === 'paymentMethod' && included.id === paymentMethodId
            )[0];

            const methodId = paymentMethod.relationships.method.data.id;
            const methodType = paymentMethod.relationships.method.data.type;

            const method = this.payments.included.filter(
                included => included.type === methodType && included.id === methodId
            )[0];

            if (method.type === 'paypalBillingAgreement') {

                return `PayPal Agreement ID: <br>${method.attributes.external_id}`;

            } else if (method.type === 'creditCard') {

                return `${method.attributes.company_name}:
                    ${(String(method.attributes.last_four_digits)).padStart(4, '0')} -
                    ${this.moment(method.attributes.expiration_date).format('MM/DD')}
                    <br>Stripe Card ID: ${method.attributes.external_id}`;

            }
        },
        getExternalInfo(payment) {
            if (payment.attributes.external_provider === 'stripe') {
                return `Stripe Charge ID: <br> ${payment.attributes.external_id}`;
            } else if(payment.attributes.external_provider === 'paypal') {
                return `PayPal Transaction ID: <br> ${payment.attributes.external_id}`;
            } else if(payment.attributes.external_provider === 'google') {
                return `Google Play Android: <br> ${payment.attributes.external_id}`;
            } else if(payment.attributes.external_provider === 'apple') {
                return `Apple IOS: <br> ${payment.attributes.external_id}`;
            }

            return '';
        },
        openRefundForm(payment_id) {
            const thisPayment = this.payments.data.filter(payment => payment.id === payment_id)[0];

            this.refundingPayment = JSON.parse(JSON.stringify(thisPayment));
            this.refundAmount = this.refundingPayment.attributes.total_paid;
            this.dialog = true;
        },

        submitForm() {
            if (this.$_refund_amount > this.refundingPayment.attributes.total_paid) {
                return this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: 'Refund was not submit, please make sure the refund amount is less than or '
                            + 'equal to the original payment',
                    duration: 10000,
                });
            }

            if (this.$refs.form.validate()) {
                this.$root.$emit('pageLoading');

                api.refundPayment({
                    payment_id: this.$_payment_id,
                    gateway_name: this.$_gateway,
                    refund_amount: this.refundAmount,
                    note: this.refund_note,
                })
                    .then((response) => {
                        this.$root.$emit('pageLoaded');

                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'Payment successfuly refunded!',
                                color: 'success',
                            });

                            api.getPayments({
                                order_id: this.paymentType === 'order' ? this.itemId : null,
                                subscription_id: this.paymentType === 'subscription' ? this.itemId : null,
                            })
                                .then((resolved) => {
                                    if (resolved) {
                                        this.$emit('reloadData', resolved.data);
                                    }
                                });

                            this.cancelForm();
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops, something went wrong. Payment not refunded!',
                                color: 'error',
                            });
                        }
                    });
            }
        },

        cancelForm() {
            this.dialog = false;
            this.refund_note = null;
            this.refundAmount = 0;
            this.refundingPayment = JSON.parse(JSON.stringify(defaultPayment));

            this.$refs.form.resetValidation();
            this.$nextTick(() => { this.$forceUpdate(); });
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

        viewInvoiceUrl(payment_id) {
            return '/invoice/' + payment_id;
        },

        resendInvoice(payment_id) {
            if(confirm("Are you sure you want to email this invoice to the customer?")) {
                api
                    .sendPaymentInvoice({payment_id})
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'Payment invoice successfuly sent!',
                                color: 'success',
                            });
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops, something went wrong. Payment invoice was not sent!',
                                color: 'error',
                            });
                        }
                    });
            }
        },
    },
};
</script>
