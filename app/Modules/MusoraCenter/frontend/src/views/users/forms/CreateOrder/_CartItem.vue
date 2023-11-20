<template>
    <v-list-item class="mb-6">
        <v-list-item-avatar>
            <v-img
                max-height="250"
                max-width="250"
                :src="item.thumbnail_url"
            ></v-img>
        </v-list-item-avatar>

        <v-list-item-action>
            <v-text-field
                type="number"
                solo
                flat
                single-line
                class="mb-0 pa-0"
                outlined
                style="width:60px;"
                :value="item.quantity"
                hide-details
                :color="brandColor"
                @input="updateCartItemQuantity($event, item.sku)"
            ></v-text-field>
        </v-list-item-action>

        <v-list-item-content class="pl-5">
            <v-list-item-title>
                {{ item.name }}
                <small class="ml-2 warning--text">{{ isDiscounted ? '(Discounted)' : '' }}</small>
                <small class="ml-2 red--text">{{ this.item.is_membership_change ? '(Membership Change)' : '' }}</small>
            </v-list-item-title>
            <v-list-item-subtitle class="pb-3">{{ item.sku }}</v-list-item-subtitle>
            <v-list-item-subtitle>
                <v-text-field
                    v-model="$_total_price"
                    type="number"
                    single-line
                    class="mb-0 border-black"
                    hide-details
                    style="width:200px;"
                    outlined
                    prepend-icon="attach_money"
                    :append-icon="$_total_price == item.price_after_discounts ? '' : 'undo'"
                    :color="$_total_price == item.price_after_discounts ? brandColor : 'warning'"
                    @click:append="$_total_price = item.price_after_discounts"
                ></v-text-field>
            </v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-action>
            <v-btn
                icon
                text
                color="error"
                @click="deleteItemFromCart(item.sku)"
            >
                <v-icon>delete</v-icon>
            </v-btn>
        </v-list-item-action>
    </v-list-item>
</template>

<script>
import brandColors from '../../../../api/mixins.js';
import JsonApiMethods from '../../../../mixins/json-api-methods';

export default {
    name: 'CartItem',
    mixins: [brandColors, JsonApiMethods],
    props: {
        item: {
            type: Object,
        },

        priceOverride: {
            type: Number | String,
            default: () => 0,
        },
    },
    data() {
        return {
            inputTimeout: null,
        };
    },
    computed: {
        $_total_price: {
            get() {
                return this.priceOverride || this.item.price_after_discounts;
            },
            set(value) {
                clearTimeout(this.inputTimeout);

                this.inputTimeout = setTimeout(() => {
                    this.$emit('updatePriceOverride', {sku: this.item.sku, amount: value});
                }, 750);
            },
        },

        isDiscounted() {
            return !this.item.is_membership_change && this.item.price_after_discounts !== this.item.price_before_discounts;
        },
    },
    methods: {
        updateCartItemQuantity(quantity, sku) {
            this.$emit('updateItemQuantity', {quantity, sku});
        },

        deleteItemFromCart(sku) {
            this.$emit('deleteItem', sku);
        },
    },
};
</script>
