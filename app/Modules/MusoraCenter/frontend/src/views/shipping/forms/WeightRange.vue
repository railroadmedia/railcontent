<template>
    <v-form
        ref="weightRange"
        v-model="validations.weightRange"
    >
        <v-text-field
            v-model="min"
            label="Min"
            :color="brandColor"
            :rules="minRules"
            validate-on-blur
        ></v-text-field>

        <v-text-field
            v-model="max"
            label="Max"
            :color="brandColor"
            :rules="maxRules"
            validate-on-blur
        ></v-text-field>

        <v-text-field
            v-model="price"
            label="Price"
            :color="brandColor"
            :rules="priceRules"
            validate-on-blur
        ></v-text-field>

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
                :disabled="!validations.weightRange"
                @click="saveWeightRange"
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
        shippingOptionId: {
            type: Number,
            default: 0,
        },
        weightRange: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            validations: {
                weightRange: false,
            },
            min: '',
            minRules: [
                v => v.toString() != '' || 'Min is Required',
            ],
            max: '',
            maxRules: [
                v => v.toString() != '' || 'Max is Required',
            ],
            price: '',
            priceRules: [
                v => v.toString() != '' || 'Price is Required',
            ],
            saveEvent: '',
            message: '',
        };
    },
    watch: {
        weightRange(newVal, oldVal) {
            this.resetForm();
        },
    },
    mounted() {
        if (this.weightRange && this.weightRange.id) {
            this.resetForm();
        }
    },
    methods: {
        resetFormFields() {
            this.min = (this.weightRange && this.weightRange.min) || '';
            this.max = (this.weightRange && this.weightRange.max) || '';
            this.price = (this.weightRange && this.weightRange.price) || '';
        },

        resetForm() {
            this.$refs.weightRange.reset();

            this.$nextTick(this.resetFormFields);
        },

        cancelForm() {
            this.resetForm();

            this.$root.$emit('weightRangeFormCanceled', {});
        },

        saveWeightRange() {
            if (this.validations.weightRange = this.$refs.weightRange.validate()) {
                if (this.weightRange && this.weightRange.id) {
                    this.saveEvent = 'weightRangeUpdated';
                    this.message = 'Weight Range updated!';

                    api
                        .updateWeightRange({
                            id: this.weightRange.id,
                            min: this.min,
                            max: this.max,
                            price: this.price,
                            shipping_option_id: this.weightRange.shipping_option_id,
                        })
                        .then(this.handleWeightRangeSaveResponse);
                } else {
                    this.saveEvent = 'weightRangeCreated';
                    this.message = 'Weight Range created!';

                    api
                        .addNewWeightRange({
                            min: this.min,
                            max: this.max,
                            price: this.price,
                            shipping_option_id: this.shippingOptionId,
                        })
                        .then(this.handleWeightRangeSaveResponse);
                }
            }
        },

        handleWeightRangeSaveResponse(response) {
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
                    text: 'An error occured while saving the shipping option weight range, please try again!',
                    color: 'error',
                });

                console.log('WeightRange::handleWeightRangeSaveResponse response: %s', JSON.stringify(response));
            }

            this.saveEvent = '';
            this.message = '';
        },
    },
};
</script>
<style>
</style>
