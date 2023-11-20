<template>
    <v-col
        class="my-2 py-2"
        style="border-bottom:thin solid #ffffffb3;"
    >
        <div
            id="card-element"
            ref="cardElement"
        >
            <!-- A Stripe Element will be inserted here. -->
        </div>
    </v-col>
</template>

<script>
export default {
    name: 'VCustomStripeCardForm',

    props: {
        gateway: {
            type: String,
        },
    },

    data() {
        return {
            stripeInstance: null,
            stripeCard: null,
        };
    },

    mounted() {
        if (this.gateway) {
            this.initializeStripeInstance(this.gateway);
        }
    },

    beforeDestroy() {
        this.stripeInstance = null;
        this.stripeCard = null;
    },

    methods: {
        initializeStripeInstance(gateway) {
            const stripeKey = process.env[`VUE_APP_${gateway.toUpperCase()}_STRIPE_KEY`];

            if (gateway) {
                this.stripeInstance = this.Stripe(stripeKey);

                this.stripeCard = this.stripeInstance.elements().create('card', {
                    hidePostalCode: true,
                    style: {
                        base: {
                            color: this.$vuetify.theme.dark ? '#fff' : '#000',
                            fontFamily: 'Roboto, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: this.$vuetify.theme.dark ? '#ffffffb3' : '#000',
                            },
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a',
                        },
                    },
                });

                setTimeout(() => {
                    this.stripeCard.mount(this.$refs.cardElement);
                }, 200);
            } else {
                this.stripeInstance = null;
                this.stripeCard = null;
            }
        },
    },
};
</script>
