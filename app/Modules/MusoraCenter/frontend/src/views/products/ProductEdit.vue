<template>
    <v-container>
        <v-row
            
            align="center"
        >
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs :breadcrumbs="breadcrumbs" />
            </v-col>

            <v-col
                class="column"
                cols="12"
            >
                <div
                    v-if="thisProduct != null"
                    class="text-center"
                >
                    <v-avatar
                        size="150px"
                        class="mb-12"
                    >
                        <img :src="thisProduct.attributes.thumbnail_url">
                    </v-avatar>
                </div>
            </v-col>

            <v-col
                cols="12"
                md="6"
                class="mt-4 mb-2 text-center mb-12 px-4 column"
                style="margin:0 auto;"
            >
                <product-details-form
                    v-if="thisProduct != null"
                    :key="thisProduct.id"
                    :this-product="thisProduct"
                    @formSuccess="handleFormSuccess"
                ></product-details-form>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import Utils from '../../api/utils';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import api from '../../api/ecommerce/products';
import ProductDetailsForm from './forms/ProductDetailsForm.vue';
import Middleware from '../../middleware/product';

export default {
    name: 'ProductEdit',
    components: {
        'product-details-form': ProductDetailsForm,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.productEdit(vm); });
    },
    props: {

    },
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Products',
                    disabled: false,
                    to: { name: 'products' },
                },
                {
                    text: this.$route.params.id,
                    disabled: true,
                },
            ],
            productId: Number(this.$route.params.id),
        };
    },
    computed: {
        ...mapState({
            state: state => state.products,
        }),

        thisProduct() {
            return this.state.currentProduct;
        },
    },
    methods: {
        ...mapActions('products', [
            'getProducts',
            'setCurrentProduct',
            'setProducts',
        ]),

        toCapitalCase: string => Utils.toCapitalCase(string),

        handleFormSuccess(payload) {
            this.setCurrentProduct(payload);

            this.$nextTick(() => {
                this.$forceUpdate();
            });
        },
    },
};
</script>
