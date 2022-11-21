<template>
    <a
        :href="checkoutUrl"
        v-if="cartItems.length"
        class="join outline-button cart-button"
        @click.stop.prevent="handleClick"
    >
        <i class="fas fa-cart-plus"></i>
        <span class="cart-number" v-if="cartItems && cartItems.length">{{ cartItems.length }}</span>
    </a>
</template>

<script>
export default {
    name: 'NavCartButton',
    props: {
        // cartData: {
        //     item: String,
        // },
        cartDataUrl: {
            type: String,
        },
        checkoutUrl: {
            type: String,
        }
    },
    data() {
        return {
            //Initial Cart Data
            cartData: {
                "meta": {
                    "cart": {
                        "items": [],
                    }
                }
            },
            cartItems: [],
        }
    },
    beforeMount() {
        //Fetch Cart Data
        axios.get(this.cartDataUrl)
            .then(response => {
                this.cartData = response.data;
            }
        )
    },
    mounted() {
        this.updateCartData(this.cartData);

        this.eventBus.on('updateCartData', this.updateCartData);        
    },
    methods: {
        updateCartData(cartData) {
            this.cartItems = cartData.meta.cart.items;
        },

        handleClick() {
            this.eventBus.emit('openCartSidebar', {});
        },
    },
}
</script>