<template>
    <v-container>
        <v-row
            class="align-top"
        >
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>

            <v-col
                cols="12"
                md="6"
                class="mt-4 mb-2 text-center mb-12 px-4 column"
            >
                <v-fade-transition>
                    <v-card
                        v-if="currentDiscount.id"
                        class="edit-form mb-12"
                    >
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                            :loading="true"
                        >
                            <v-toolbar-title>Discount Details</v-toolbar-title>
                        </v-toolbar>

                        <v-col
                            cols="12"
                            class="pa-4 column"
                        >
                            <discount-details
                                :discount="currentDiscount"
                                @formSuccess="getCurrentDiscount"
                                @cancelForm="getCurrentDiscount"
                            />
                        </v-col>
                    </v-card>
                </v-fade-transition>
            </v-col>

            <v-col
                cols="12"
                md="6"
                class="mt-4 mb-2 mb-12 px-4 column"
            >
                <v-fade-transition>
                    <v-card
                        v-if="currentDiscount.id"
                        class="edit-form mb-12"
                    >
                        <v-toolbar
                            flat
                            dark
                            :color="brandColor"
                        >
                            <v-toolbar-title>Discount Criteria</v-toolbar-title>
                            <v-spacer></v-spacer>

                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        icon
                                        text
                                        class="mx-0"
                                        v-on="on"
                                        @click="openCriteriaForm(0)"
                                    >
                                        <v-icon>add</v-icon>
                                    </v-btn>
                                </template>

                                <span>Add New Criteria</span>
                            </v-tooltip>
                        </v-toolbar>

                        <v-data-table
                            :headers="headers"
                            :items="getRelatedDataByType('discountCriterias', includedDiscountData)"
                            hide-default-footer
                            class="elevation-1"
                            :items-per-page="20"
                        >
                            <template v-slot:item="{ item }">
                                <tr style="cursor:pointer;">
                                    <td>{{ item.attributes.name }}</td>
                                    <td class="text-center">
                                        {{ item.attributes.min }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.attributes.max }}
                                    </td>
                                    <td class="text-center pa-0">
                                        <v-btn
                                            icon
                                            text
                                            @click="openCriteriaForm(item.id)"
                                        >
                                            <v-icon :color="brandColor">
                                                edit
                                            </v-icon>
                                        </v-btn>

                                        <v-btn
                                            icon
                                            text
                                            @click="deleteDiscountCriteria(item.id)"
                                        >
                                            <v-icon color="error">
                                                delete
                                            </v-icon>
                                        </v-btn>
                                    </td>
                                </tr>
                            </template>
                        </v-data-table>
                    </v-card>
                </v-fade-transition>
            </v-col>

            <v-row>
                <v-dialog
                    v-model="dialog"
                    max-width="500px"
                >
                    <v-fade-transition>
                        <v-card>
                            <v-toolbar
                                flat
                                dark
                                :color="brandColor"
                            >
                                <v-toolbar-title>Edit Discount Criteria</v-toolbar-title>
                            </v-toolbar>

                            <v-col
                                cols="12"
                                class="pa-4 column"
                            >
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                >
                                    <div class="text-right">
                                        <v-text-field
                                            v-model="$_name"
                                            label="Name"
                                            :color="brandColor"
                                            :rules="validationRules.name"
                                        ></v-text-field>

                                        <v-select
                                            v-model="$_type"
                                            label="Type"
                                            :color="brandColor"
                                            :items="typeOptions"
                                            :readonly="currentCriteria.id !== 0"
                                            :disabled="currentCriteria.id !== 0"
                                        ></v-select>

                                        <!-- IF TYPE IS SET TO A VALUE THAT REQUIRES A MIN/MAX NUMBER -->
                                        <div
                                            v-if="$_type === 'product quantity requirement' ||
                                                $_type === 'order total requirement' ||
                                                $_type === 'shipping total requirement' ||
                                                $_type === 'product own requirement'"
                                        >
                                            <v-text-field
                                                v-model="$_min"
                                                label="Min"
                                                :color="brandColor"
                                                type="number"
                                                :rules="validationRules.min"
                                            ></v-text-field>

                                            <v-text-field
                                                v-model="$_max"
                                                label="Max"
                                                :color="brandColor"
                                                type="number"
                                                :rules="validationRules.max"
                                            ></v-text-field>
                                        </div>

                                        <!-- IF TYPE IS SET TO A VALUE THAT REQUIRES A MIN/MAX DATE -->
                                        <div v-if="$_type === 'date requirement'">
                                            <v-menu
                                                ref="start_date_picker"
                                                v-model="start_date_picker"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                lazy
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                min-width="290px"
                                            >
                                                <v-text-field
                                                    slot="activator"
                                                    v-model="$_min"
                                                    label="Start Date"
                                                    :color="brandColor"
                                                    :rules="validationRules.min"
                                                    readonly
                                                ></v-text-field>

                                                <v-date-picker
                                                    v-model="$_min"
                                                    no-title
                                                    scrollable
                                                >
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        flat
                                                        :color="brandColor"
                                                        @click="start_date_picker = false"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        flat
                                                        :color="brandColor"
                                                        @click="start_date_picker = false"
                                                    >
                                                        OK
                                                    </v-btn>
                                                </v-date-picker>
                                            </v-menu>

                                            <v-menu
                                                ref="end_date_picker"
                                                v-model="end_date_picker"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                lazy
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                min-width="290px"
                                            >
                                                <v-text-field
                                                    slot="activator"
                                                    v-model="$_max"
                                                    label="End Date"
                                                    :color="brandColor"
                                                    :rules="validationRules.max"
                                                    readonly
                                                ></v-text-field>

                                                <v-date-picker
                                                    v-model="$_max"
                                                    no-title
                                                    scrollable
                                                >
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        flat
                                                        :color="brandColor"
                                                        @click="end_date_picker = false"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        flat
                                                        :color="brandColor"
                                                        @click="end_date_picker = false"
                                                    >
                                                        OK
                                                    </v-btn>
                                                </v-date-picker>
                                            </v-menu>
                                        </div>

                                        <!-- IF TYPE IS SET TO A VALUE THAT REQUIRES A COUNTRY -->
                                        <div v-if="$_type === 'shipping country requirement'">
                                            <v-select
                                                v-model="$_min"
                                                label="Country"
                                                :color="brandColor"
                                                :items="countries"
                                                item-value="name"
                                                item-text="name"
                                                :rules="validationRules.min"
                                                required
                                            ></v-select>
                                        </div>

                                        <!-- IF TYPE IS SET TO A VALUE THAT REQUIRES A PROMO CODE -->
                                        <div v-if="$_type === 'promo code requirement'">
                                            <v-text-field
                                                v-model="$_min"
                                                label="Promo Code"
                                                :color="brandColor"
                                                :rules="validationRules.min"
                                            ></v-text-field>
                                        </div>

                                        <v-combobox
                                            v-if="$_type === 'product quantity requirement' ||
                                                $_type === 'product own requirement'"
                                            ref="productInput"
                                            v-model="$_products"
                                            label="Product ID"
                                            :color="brandColor"
                                            :items="products.products"
                                            multiple
                                            item-text="attributes.name"
                                            item-value="id"
                                        >
                                            <template v-slot:selection="data">
                                                <v-chip
                                                    :key="JSON.stringify(data.item)"
                                                    v-bind="data.attrs"
                                                    :input-value="data.selected"
                                                    :disabled="data.disabled"
                                                >
                                                    <span class="pr-2">
                                                        {{ getProductDataById(data.item.id).attributes.name }}
                                                    </span>

                                                    <v-icon
                                                        small
                                                        @click="data.parent.selectItem(data.item)"
                                                    >
                                                        close
                                                    </v-icon>
                                                </v-chip>
                                            </template>

                                            <template v-slot:item="{ item }">
                                                <v-list-item-content>
                                                    <v-list-item-title>{{ item.attributes.name }}:</v-list-item-title>
                                                    <v-list-item-subtitle>{{ item.attributes.sku }}</v-list-item-subtitle>
                                                </v-list-item-content>
                                            </template>
                                        </v-combobox>

                                        <div
                                            v-if="$_type === 'product quantity requirement' ||
                                                $_type === 'product own requirement'"
                                        >
                                            <v-select
                                                v-model="$_products_relation_type"
                                                label="Product Relation Type"
                                                :color="brandColor"
                                                :items="['any of products', 'all of products']"
                                                required
                                            ></v-select>
                                        </div>

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
                                </v-form>
                            </v-col>
                        </v-card>
                    </v-fade-transition>
                </v-dialog>
            </v-row>
        </v-row>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import Utils from '@musora/helper-functions/modules/utils';
import brandColors from '../../api/mixins';
import DiscountDetails from './forms/DiscountDetails.vue';
import Middleware from '../../middleware/discount';
import api from '../../api/ecommerce/discounts';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import LastVisistedUsers from '../../components/LastVisistedUsers';
import JsonApiMethods from '../../mixins/json-api-methods';

const defaultCriteria = { id: 0, attributes: {}, relationships: { product: { data: {} } } };

export default {
    components: {
        'discount-details': DiscountDetails,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors, JsonApiMethods],
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.discountEdit(vm); });
    },
    data() {
        return {
            valid: false,
            dialog: false,
            discountId: Number(this.$route.params.id),
            headers: [
                {
                    text: 'Name',
                    align: 'left',
                    sortable: false,
                    value: 'type',
                },
                {
                    text: 'Min',
                    align: 'center',
                    sortable: false,
                    value: 'min',
                    width: 120,
                },
                {
                    text: 'Max',
                    align: 'center',
                    sortable: false,
                    value: 'max',
                    width: 120,
                },
                {
                    text: 'Actions',
                    align: 'center',
                    sortable: false,
                    value: 'edit',
                    width: 120,
                },
            ],
            validationRules: {
                name: [
                    v => !!v || 'Name is required.',
                ],
                type: [
                    v => !!v || 'Type is required.',
                ],
                min: [
                    v => !!v || 'Min is required.',
                ],
                max: [
                    v => !!v || 'Max is required.',
                ],
            },
            typeOptions: [
                'product quantity requirement',
                'date requirement',
                'order total requirement',
                'shipping total requirement',
                'shipping country requirement',
                'promo code requirement',
                'product own requirement',
            ],
            currentCriteria: Utils.createObjectCopy(defaultCriteria),
            start_date_picker: false,
            end_date_picker: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.discounts,
            products: state => state.products,
        }),

        breadcrumbs() {
            return [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Discounts',
                    disabled: false,
                    to: { name: 'discounts' },
                },
                {
                    text: this.currentDiscount.id,
                    disabled: true,
                },
            ];
        },

        countries() {
            return window.countryList;
        },

        currentDiscount() {
            return this.state.currentDiscount || { attributes: {}, id: 0 };
        },

        includedDiscountData() {
            return this.state.includedData || [];
        },

        $_name: {
            get() {
                return this.currentCriteria.attributes.name;
            },
            set(val) {
                this.$set(this.currentCriteria.attributes, 'name', val);
            },
        },

        $_type: {
            get() {
                return this.currentCriteria.attributes.type;
            },
            set(val) {
                this.$set(this.currentCriteria.attributes, 'type', val);
                this.$_min = null;
                this.$_max = null;
            },
        },

        $_min: {
            get() {
                return this.currentCriteria.attributes.min;
            },
            set(val) {
                this.$set(this.currentCriteria.attributes, 'min', val);

                if (['shipping country requirement', 'promo code requirement'].indexOf(this.$_type) !== -1) {
                    this.$_max = val;
                }
            },
        },

        $_max: {
            get() {
                return this.currentCriteria.attributes.max;
            },
            set(val) {
                this.$set(this.currentCriteria.attributes, 'max', val);
            },
        },

        $_products: {
            cache: false,
            get() {
                if (this.currentCriteria.relationships.products) {
                    return this.currentCriteria.relationships.products.data;
                }

                return [];
            },
            set(value) {
                this.currentCriteria.relationships.products = {
                    data: value.map(item => ({ id: item.id, type: 'product' })),
                };
            },
        },

        $_products_relation_type: {
            get() {
                return this.currentCriteria.attributes.products_relation_type;
            },
            set(val) {
                this.$set(this.currentCriteria.attributes, 'products_relation_type', val);
            },
        },
    },
    methods: {
        ...mapActions('discounts', [
            'getDiscounts',
            'setDiscounts',
            'setCurrentDiscount',
            'setIncludedData',
        ]),

        getCurrentDiscount() {
            this.$root.$emit('pageLoading');

            api.getDiscountById(this.currentDiscount.id)
                .then((response) => {
                    if (response) {
                        this.setCurrentDiscount(response.data.data);
                        this.setIncludedData(response.data.included);
                    }

                    this.$root.$emit('pageLoaded');
                });
        },

        gotToDiscounts() {
            this.$router.push({ name: 'discounts' });
        },

        openCriteriaForm(id) {
            const criteria = this.getRelatedDataByType('discountCriterias', this.includedDiscountData)
                .find(criteria => criteria.id === id);

            this.currentCriteria = criteria
                ? Utils.createObjectCopy(criteria) : Utils.createObjectCopy(defaultCriteria);
            this.dialog = true;

            this.$nextTick(() => {
                this.$refs.form.resetValidation();
            });
        },

        createDiscountCriteria() {
            api.createDiscountCriteria(this.currentDiscount.id, {
                name: this.$_name,
                type: this.$_type,
                min: this.$_min,
                max: this.$_max,
                products: this.$_products,
                products_relation_type: this.$_products_relation_type,
            })
                .then(this.handleCriteriaResponse);
        },

        updateDiscountCriteria() {
            api.updateDiscountCriteria(this.currentCriteria.id, {
                name: this.$_name,
                type: this.$_type,
                min: this.$_min,
                max: this.$_max,
                products: this.$_products,
                products_relation_type: this.$_products_relation_type,
            })
                .then(this.handleCriteriaResponse);
        },

        handleCriteriaResponse(response) {
            const action = this.currentCriteria.id === response.data.data.id ? 'updated' : 'created';

            if (response) {
                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: `Criteria successfully ${action}!`,
                });

                this.cancelForm();
                this.getCurrentDiscount();
            } else {
                this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: 'Oops, something went wrong! Criteria likely not created.',
                });
            }
        },

        submitForm() {
            if (this.currentCriteria.id === 0) {
                this.createDiscountCriteria();
            } else {
                this.updateDiscountCriteria();
            }
        },

        cancelForm(resetValidation = true) {
            if (resetValidation) {
                this.$refs.form.resetValidation();
            }
            this.dialog = false;
            this.currentCriteria = Utils.createObjectCopy(defaultCriteria);
        },

        deleteDiscountCriteria(discount_criteria_id) {
            const confirmation = confirm('Are you sure you want to delete this criteria?');

            if (confirmation) {
                api.deleteDiscountCriteria(discount_criteria_id)
                    .then((response) => {
                        if (response) {
                            this.$root.$emit('displayMessage', {
                                text: 'Criteria successfully deleted!',
                                color: 'success',
                            });

                            this.cancelForm(false);
                            this.getCurrentDiscount();
                        } else {
                            this.$root.$emit('displayMessage', {
                                text: 'Oops something went wrong! Criteria likely not deleted.',
                                color: 'error',
                            });
                        }
                    });
            }
        },

        getProductDataById(id) {
            return this.products.products.find(product => product.id === id);
        },
    },
};
</script>
<style>
</style>
