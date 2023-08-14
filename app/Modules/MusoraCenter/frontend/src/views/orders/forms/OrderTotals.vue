<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Order Totals</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        @click="readOnly = !readOnly"
                    >
                        <v-icon>{{ readOnly ? 'lock' : 'lock_open' }}</v-icon>
                    </v-btn>
                </template>

                <span>{{ readOnly ? 'Unlock' : 'Lock' }} Totals</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form ref="form">
                <v-text-field
                    v-model="$_total_paid"
                    label="Total Paid"
                    type="number"
                    :color="brandColor"
                    :readonly="readOnly"
                    :disabled="readOnly"
                    class="pa-2"
                ></v-text-field>

                <v-text-field
                    v-model="$_taxes_due"
                    label="Tax Due"
                    type="number"
                    :color="brandColor"
                    :readonly="readOnly"
                    :disabled="readOnly"
                    class="pa-2"
                ></v-text-field>

                <v-text-field
                    v-model="$_shipping_due"
                    label="Shipping Due"
                    type="number"
                    :color="brandColor"
                    :readonly="readOnly"
                    :disabled="readOnly"
                    class="pa-2"
                ></v-text-field>

                <v-text-field
                    v-model="$_total_due"
                    label="Total Due"
                    type="number"
                    :color="brandColor"
                    :readonly="readOnly"
                    :disabled="readOnly"
                    class="pa-2"
                ></v-text-field>

                <v-textarea
                    v-model="$_note"
                    label="Notes"
                    :color="brandColor"
                    multi-line
                    outline
                    no-resize
                    :readonly="readOnly"
                    :disabled="readOnly"
                    class="mt-4"
                ></v-textarea>

                <div class="text-right">
                    <v-btn
                        class="white--text"
                        :color="brandColor"
                        :disabled="readOnly"
                        @click="saveOrder"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import moment from 'moment';
import brandColors from '../../../api/mixins.js';
import api from '../../../api/ecommerce/orders';

export default {
    name: 'OrderTotals',
    mixins: [brandColors],
    props: {
        currentOrder: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            readOnly: true,
        };
    },
    computed: {
        $_total_due: {
            get() {
                return this.currentOrder.attributes.total_due;
            },
            set(value) {
                this.$emit('updateOrder', { key: 'total_due', value });
            },
        },

        $_taxes_due: {
            get() {
                return this.currentOrder.attributes.taxes_due;
            },
            set(value) {
                this.$emit('updateOrder', { key: 'taxes_due', value });
            },
        },

        $_shipping_due: {
            get() {
                return this.currentOrder.attributes.shipping_due;
            },
            set(value) {
                this.$emit('updateOrder', { key: 'shipping_due', value });
            },
        },

        $_total_paid: {
            get() {
                return this.currentOrder.attributes.total_paid;
            },
            set(value) {
                this.$emit('updateOrder', { key: 'total_paid', value });
            },
        },

        $_note: {
            get() {
                return this.currentOrder.attributes.note;
            },
            set(value) {
                this.$emit('updateOrder', { key: 'note', value });
            },
        },
    },
    methods: {
        resetForm() {
            this.$emit('resetForm');
        },

        saveOrder() {
            api.updateOrder(this.currentOrder.id, {
                total_due: this.$_total_due,
                taxes_due: this.$_taxes_due,
                shipping_due: this.$_shipping_due,
                total_paid: this.$_total_paid,
                note: this.$_note,
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Order Data updated!',
                            color: 'success',
                        });

                        this.$emit('formSuccess', response.data);
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops, something went wrong! Order likely not edited.',
                            color: 'error',
                        });
                    }

                    this.readOnly = true;
                });
        },
    },
};
</script>
<style>
</style>
