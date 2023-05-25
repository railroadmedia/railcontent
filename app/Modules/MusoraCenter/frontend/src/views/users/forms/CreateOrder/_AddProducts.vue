<template>
    <v-col>
        <v-form ref="form">
            <p class="mb-2 font-italic caption">
                Format: sku1=quantity1,sku2=quantity2 <br>
                Ex: new-drummers-start-here=1,wallflower-tumbler=1,mouth-mug=1
            </p>
            <v-row>
                <v-col>
                    <v-text-field
                        v-model="bulkProductSkusToAddString"
                        style="width:400px;"
                        type="string"
                        single-line
                        class="mb-5"
                        hide-details
                        placeholder="Bulk add SKUs & quantities (comma seperated):"
                        :color="brandColor"
                    ></v-text-field>
                </v-col>
                <v-col>
                    <div class="text-right">
                        <v-btn
                            :color="brandColor"
                            class="white--text"
                            :disabled="bulkProductSkusToAddString === ''"
                            @click="bulkAddProductSkusToCart"
                        >
                            Add
                            <v-icon
                                right
                                dark
                            >
                                add
                            </v-icon>
                        </v-btn>
                    </div>
                </v-col>
            </v-row>

            <v-combobox
                ref="productInput"
                v-model="selectedProduct"
                label="Product"
                :color="brandColor"
                :items="products"
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

            <v-text-field
                v-model="quantity"
                type="number"
                label="Quantity"
                :color="brandColor"
            ></v-text-field>

            <div class="text-right">
                <v-btn
                    :color="brandColor"
                    class="white--text"
                    :disabled="selectedProduct == null"
                    @click="addProductToCart"
                >
                    Add Product
                    <v-icon
                        right
                        dark
                    >
                        add
                    </v-icon>
                </v-btn>
            </div>

            <!--<v-select-->
            <!--label="Billing Address"-->
            <!--:color="brandColor"-->
            <!--:items="userAddresses"-->
            <!--item-value="id"-->
            <!--:persistent-hint="userAddresses.length === 0"-->
            <!--hint="You must first create a billing address and they will show up here."-->
            <!--v-model="billing_address_id">-->

            <!--<template slot="selection" slot-scope="data">-->
            <!--<div class="input-group__selections__comma">-->
            <!--{{ data.item.street_line_1 }} - -->
            <!--{{ data.item.country }}-->
            <!--</div>-->
            <!--</template>-->

            <!--<template slot="item" slot-scope="data">-->
            <!--<template>-->
            <!--<v-list-item-content v-if="userAddresses.length">-->
            <!--<span>-->
            <!--{{ data.item.street_line_1 }} - -->
            <!--{{ data.item.country }}-->
            <!--</span>-->
            <!--</v-list-item-content>-->
            <!--</template>-->
            <!--</template>-->
            <!--</v-select>-->
        </v-form>
    </v-col>
</template>
<script>
import brandColors from '../../../../api/mixins.js';

export default {
    name: 'AddProducts',
    mixins: [brandColors],
    props: {
        products: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            selectedProduct: null,
            quantity: 1,
            bulkProductSkusToAddString: '',
        };
    },
    methods: {
        addProductToCart() {
            this.$emit('productAdded', {
                sku: this.selectedProduct.attributes.sku,
                quantity: this.quantity,
            });

            this.quantity = 1;
            this.selectedProduct = null;
            this.$refs.productInput.blur();
        },
        bulkAddProductSkusToCart() {
            this.$emit('bulkAddProductSkusToCart', {
                bulkProductSkusToAddString: this.bulkProductSkusToAddString,
            });

            this.bulkProductSkusToAddString = '';
        },
    },
};
</script>
