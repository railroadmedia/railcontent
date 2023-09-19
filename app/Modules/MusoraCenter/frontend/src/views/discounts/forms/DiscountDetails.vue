<template>
    <v-form
        ref="form"
        v-model="formValidated"
    >
        <v-text-field
            v-model="$_name"
            label="Name"
            :color="brandColor"
            :rules="validation.name"
        ></v-text-field>

        <v-select
            v-model="$_type"
            label="Type"
            :color="brandColor"
            :items="typeOptions"
            :rules="validation.type"
        ></v-select>

        <v-text-field
            v-model="$_amount"
            label="Amount"
            type="number"
            :color="brandColor"
            :rules="validation.amount"
        ></v-text-field>

        <v-text-field
            v-model="$_product_category"
            label="Product Category"
            :color="brandColor"
        ></v-text-field>

        <v-checkbox
            v-model="$_isActive"
            label="Active"
            :color="brandColor"
        ></v-checkbox>

        <v-checkbox
            v-model="$_isVisible"
            label="Visible"
            :color="brandColor"
        ></v-checkbox>

        <!--        <v-combobox-->
        <!--                label="Product ID"-->
        <!--                v-model="$_product_id"-->
        <!--                :items="products.products"-->
        <!--                :rules="validation.product_id"-->
        <!--                :color="brandColor"-->
        <!--                item-text="attributes.name"-->
        <!--                hint="Search for products by name - hit enter to select"-->
        <!--                persistent-hint>-->
        <!--        </v-combobox>-->

        <v-combobox
            ref="productInput"
            v-model="$_product_id"
            label="Product ID"
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
                    <v-list-item-sub-title>{{ data.item.attributes.sku }}</v-list-item-sub-title>
                </v-list-item-content>
            </template>
        </v-combobox>

        <v-textarea
            v-model="$_description"
            label="Description"
            :color="brandColor"
            :rules="validation.description"
        ></v-textarea>

        <div class="text-right">
            <v-btn
                text
                class="mr-1"
                @click.stop="cancelForm"
            >
                Cancel
            </v-btn>
            <v-btn
                dark
                :color="brandColor"
                :disabled="!formValidated"
                @click="saveDiscount"
            >
                Save
            </v-btn>
        </div>
    </v-form>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import brandColors from '../../../api/mixins.js';
import api from '../../../api/ecommerce/discounts';

export default {
    name: 'DiscountDetails',
    mixins: [brandColors],

    data() {
        return {
            formValidated: false,
            typeOptions: [
                'product amount off',
                'product percent off',
                'subscription free trial days',
                'subscription recurring price amount off',
                'order total amount off',
                'order total percent off',
                'order total shipping amount off',
                'order total shipping percent off',
                'order total shipping overwrite',
            ],
            validation: {
                name: [
                    v => !!v || 'Name is Required',
                ],
                description: [
                    v => !!v || 'Description is Required',
                ],
                type: [
                    v => !!v || 'Type is Required',
                ],
                product_id: [
                    v => !!v || 'Product ID is Required',
                ],
                amount: [
                    v => !!v || 'Amount is Required',
                ],
            },
        };
    },

    computed: {
        ...mapState({
            discounts: state => state.discounts,
            products: state => state.products,
        }),

        currentDiscount() {
            return this.discounts.currentDiscount || { attributes: {}, id: 0 };
        },

        $_name: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.name || null;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'name', value: val });
            },
        },

        $_type: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.type || null;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'type', value: val });
            },
        },

        $_amount: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.amount || null;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'amount', value: val });
            },
        },

        $_product_category: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.product_category || null;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'product_category', value: val });
            },
        },

        $_isActive: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.active || false;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'active', value: val });
            },
        },

        $_isVisible: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.visible || false;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'visible', value: val });
            },
        },

        $_product_id: {
            cache: false,
            get() {
                return this.currentDiscount.relationships.product
                    ? this.currentDiscount.relationships.product.data.id : null;
            },
            set(val) {
                if (!val) {
                    return;
                }

                this.setCurrentDiscountRelationshipId({ type: 'product', id: val.id });
            },
        },

        $_description: {
            cache: false,
            get() {
                return this.currentDiscount.attributes.description || null;
            },
            set(val) {
                this.setCurrentDiscountAttribute({ key: 'description', value: val });
            },
        },
    },

    methods: {
        ...mapActions('products', [
            'getProducts',
        ]),

        ...mapActions('discounts', [
            'setCurrentDiscount',
            'setCurrentDiscountAttribute',
            'setCurrentDiscountRelationshipId',
        ]),

        saveDiscount() {
            api.setDiscount(this.currentDiscount.id, {
                name: this.$_name,
                description: this.$_description,
                type: this.$_type,
                product_category: this.$_product_category,
                amount: this.$_amount,
                active: this.$_isActive,
                visible: this.$_isVisible,
                product_id: this.$_product_id,
            })
                .then((response) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Discount successfully saved!',
                        });

                        this.$emit('formSuccess', response.data.data);
                    } else {
                        this.$root.$emit('displayMessage', {
                            color: 'error',
                            text: 'Something went wrong. Discount has not been saved.',
                        });
                    }
                });
        },

        cancelForm() {
            if (this.currentDiscount.id === 0) {
                this.$refs.form.reset();
            }

            this.$emit('cancelForm');
        },
    },

    mounted() {
        if (!this.products.products.length) {
            this.getProducts();
        }
    },
};
</script>
<style>
</style>
