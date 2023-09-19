<template>
    <v-form
        ref="shipping"
        v-model="validations.shipping"
    >
        <v-text-field
            v-model="country"
            label="Country"
            :color="brandColor"
            :rules="countryRules"
            validate-on-blur
        ></v-text-field>

        <v-text-field
            v-model="priority"
            label="Priority"
            :color="brandColor"
            :rules="priorityRules"
            validate-on-blur
        ></v-text-field>

        <v-checkbox
            v-model="active"
            label="Active"
            :color="brandColor"
        ></v-checkbox>

        <div class="text-right">
            <v-btn
                text
                @click.stop="cancelForm"
            >
                Cancel
            </v-btn>
            <v-btn
                dark
                :color="brandColor"
                :disabled="!validations.shipping"
                @click="saveShippingOption"
            >
                Save
            </v-btn>
        </div>
    </v-form>
</template>
<script>
import brandColors from '../../../api/mixins.js';
import api from '../../../api/ecommerce/shipping';

export default {
    mixins: [brandColors],
    props: {
        shippingOption: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            validations: {
                shipping: false,
            },
            country: '',
            countryRules: [
                v => !!v || 'Country is Required',
            ],
            priority: 0,
            priorityRules: [
                v => v.toString() != '' || 'Priority is Required',
                v => /^(0+|[1-9]\d*)$/.test(v) || 'Priority must be valid',
            ],
            active: false,
            saveEvent: '',
            message: '',
        };
    },
    watch: {
        shippingOption(newVal, oldVal) {
            this.resetForm();
        },
    },
    mounted() {
        if (this.shippingOption && this.shippingOption.id) {
            this.resetForm();
        }
    },
    methods: {
        resetFormFields() {
            this.country = (this.shippingOption && this.shippingOption.country) || '';
            this.priority = (this.shippingOption && this.shippingOption.priority) || 0;
            this.active = (this.shippingOption && this.shippingOption.active) || false;
        },

        resetForm() {
            this.$refs.shipping.reset();

            this.$nextTick(this.resetFormFields);
        },

        cancelForm() {
            this.resetForm();

            this.$root.$emit('shippingOptionFormCanceled', {});
        },

        saveShippingOption() {
            if (this.validations.shipping = this.$refs.shipping.validate()) {
                if (this.shippingOption && this.shippingOption.id) {
                    this.saveEvent = 'shippingOptionUpdated';
                    this.message = 'Shipping Option updated!';

                    api
                        .updateShippingOption({
                            id: this.shippingOption.id,
                            country: this.country,
                            priority: this.priority,
                            active: this.active,
                        })
                        .then(this.handleShippingOptionSaveResponse);
                } else {
                    this.saveEvent = 'shippingOptionCreated';
                    this.message = 'Shipping Option created!';

                    api
                        .addNewShippingOption({
                            country: this.country,
                            priority: this.priority,
                            active: this.active,
                        })
                        .then(this.handleShippingOptionSaveResponse);
                }
            }
        },

        handleShippingOptionSaveResponse(response) {
            if (
                response.data
                    && response.data.length
                    && response.data[0].hasOwnProperty('id')
            ) {
                this.resetForm();

                this.$root.$emit(this.saveEvent, response.data[0]);

                this.$root.$emit('displayMessage', {
                    text: this.message,
                    color: 'success',
                });
            } else {
                this.$root.$emit('displayMessage', {
                    text: 'An error occured while saving the shipping option data, please try again!',
                    color: 'error',
                });

                console.log('forms/ShippingOption::handleShippingOptionSaveResponse response: %s', JSON.stringify(response));
            }

            this.saveEvent = '';
            this.message = '';
        },
    },
};
</script>
<style>
</style>
