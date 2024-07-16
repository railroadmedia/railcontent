<template>
    <div>
        <div id="cart-sidebar-overlay" @click.stop.prevent="closeCartSidebar" :class="{active: active}">
        </div>
        <section id="cart-sidebar" :class="{active: active}">
            <div class="top relative mb-2">
                <h3 class="mb-0 leading-tight"><strong>Your Cart</strong></h3>
                <a
                    href="#"
                    class="close absolute text-gray-400 absolute top-0 right-0"
                    style="font-size: 16px !important;"
                    @click.stop.prevent="closeCartSidebar"
                    aria-label="close"
                ><i class="fas fa-times fa-2x"></i></a>
            </div>
            <div class="csb-guarantee mb-4">
                <p class="text-xs text-gray-500">
                    <i class="fas fa-circle-check mr-1.5" :class="'text-' + brand"></i>
                    <span>All of our lessons are backed by a 90-day guarantee.</span>
                </p>
            </div>
            <div id="csb-products-container" class="relative overflow-hidden border-b border-t border-gray-300" style="height:345px" v-show="cartItems">
                <div class="csb-products-inner" style="height:345px" ref="simplebar">
                    <div class="csb-products-wrapper max-h-full">
                        <cart-item
                            v-for="item in cartItems"
                            v-if="cartItems"
                            :brand="brand"
                            :key="item.sku"
                            :item="item"
                            :loading="loading"
                            :locked="locked"
                            @removeCartItem="removeCartItem"
                            @updateCartItemQuantity="updateCartItemQuantity"
                        ></cart-item>

                        <cart-item
                            v-for="item in bonusItems"
                            v-if="bonusItems"
                            :brand="brand"
                            :key="item.sku"
                            :item="item"
                            :loading="loading"
                            :is-bonus="true"
                        ></cart-item>
                    </div>
                </div>
            </div>
            <div class="csb-remove-all-items py-3 border-b border-gray-300 text-center" v-show="cartItems" @click.stop.prevent="clearCart">
              <p class="leading-tight cursor-pointer text-gray-500 w-full">
                  <u>Remove all items from cart</u>
              </p>
            </div>
            <div class="summary-container text-sm my-5">
                <div class="summary-row flex justify-between">
                    <p class="summary mx-0">Subtotal</p>
                    <p v-if="subTotalBeforeDiscounts() !== subTotalAfterDiscounts()" class="mx-0 due">
                        <strong>
                        <span v-if="cartTotals">
                            <s style="font-weight: normal; color: #666;">${{ parseTotal(subTotalBeforeDiscounts()) }}</s>
                            <span>&nbsp;&nbsp; ${{ parseTotal(subTotalAfterDiscounts()) }}</span>
                        </span>
                        </strong>
                    </p>
                    <p v-if="subTotalBeforeDiscounts() === subTotalAfterDiscounts()" class="mx-0 due">
                        <strong>
                        <span v-if="cartTotals">${{ parseTotal(subTotalAfterDiscounts()) }}</span>
                        </strong>
                    </p>
                </div>
                <div v-if="sumOfDiscounts() > 0" class="summary-row flex justify-between">
                    <p class="summary mx-0">My Savings</p>
                    <p class="savings text-red-600 mx-0">
                        <span v-if="cartTotals">-${{ parseTotal(sumOfDiscounts()) }}</span>
                    </p>
                </div>
                <div v-if="cartRequiresShippingAddress" class="summary-row flex justify-between">
                    <p class="summary mx-0">Shipping</p>
                    <p class="deferred mx-0"><em>{{shippingCostMessage }}</em></p>
                </div>
                <div class="summary-row flex justify-between">
                    <p class="summary mx-0">Tax</p>
                    <p class="deferred mx-0"><em>Calculated at checkout</em></p>
                </div>
            </div>
            <div class="checkout text-center">
                <a :href="checkoutUrl" :class="brand"><i class="fas fa-lock mr-2"></i>checkout</a>
            </div>
        </section>
    </div>
</template>

<script>
import CartItem from './_CartItem.vue';
import RecommendedProduct from './_RecommendedProduct.vue';
import SimpleBar from 'simplebar';
import 'simplebar/dist/simplebar.min.css';

import EcommerceService from '../../assets/js/Services/ecommerce.js';

export default {
    components: {
        'cart-item': CartItem,
        'recommended-product': RecommendedProduct,
    },
    name: 'CartSidebar',
    props: {
        brand: {
            type: String,
            default: () => 'drumeo',
        },
        cartDataUrl: {
            type: String,
        },
        checkoutUrl: {
            type: String
        }
    },
    data() {
        return {
            active: false,
            locked: false,
            cartItems: null,
            cartData: {
                "meta": {
                    "cart": {
                        "items": [],
                    }
                }
            },
            bonusItems: null,
            cartTotals: null,
            recommendedProducts: null,
            discounts: [],
            simpleBar: null,
            loading: false,
            scrollTop: false,
        };
    },
    beforeMount() {
        //Fetch Cart Data
        axios.get(this.cartDataUrl + '/ecommerce/json/cart')
            .then(response => {
                this.updateCartData(response.data)
            }
        )
    },
    mounted() {
        this.buildInitialCartData();

        this.eventBus.on('openCartSidebar', this.openCartSidebar);

        this.simpleBar = new SimpleBar(this.$refs.simplebar, {autoHide: false});
        this.loading = false;

        this.attachAddToCartListeners();
    },
    computed: {
        cartRequiresShippingAddress() {
            if (this.cartItems) {
                return this.cartItems.filter(item => item.requires_shipping === true).length > 0;
            }

            return false;
        },

        shippingCostMessage() {
            if (this.subTotalAfterDiscounts() > 100) { // todo: temporary
                return 'Free Shipping';
            }

            return 'Calculated at checkout';
        },
    },
    methods: {
        buildInitialCartData() {
            this.updateCartData(this.cartData);

            let urlParams = new URLSearchParams(window.location.search);

            if (urlParams.get('open-cart') === '1') {
                this.loading = true;

                setTimeout(() => {
                    this.openCartSidebar();
                }, 500);
            }
        },
        openCartSidebar() {
            this.active = true;

            // todo - refactor when drumshop & product pages are created with vue, used for removing page scroll bar on mobiles
            document.body.classList.add('cart-sidebar-active');
            document.documentElement.classList.add('cart-sidebar-active');
        },

        closeCartSidebar() {
            this.active = false;

            // todo - refactor when drumshop & product pages are created with vue, used for adding back page scroll bar on mobiles
            document.body.classList.remove('cart-sidebar-active');
            document.documentElement.classList.remove('cart-sidebar-active');
        },

        updateCartData(cartData) {
            this.cartItems = cartData.meta.cart.items.reverse();
            this.recommendedProducts = cartData.meta.cart.recommendedProducts;
            this.cartTotals = cartData.meta.cart.totals;
            this.discounts = cartData.meta.cart.discounts;
            this.bonusItems = cartData.meta.cart.bonuses ? cartData.meta.cart.bonuses : [];
            this.locked = cartData.meta.cart.locked;

            setTimeout(() => {
                this.simpleBar.recalculate();
                if (this.scrollTop) {
                    this.scrollTop = false;
                    this.simpleBar.getScrollElement().scroll({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }, 10);
        },

        attachAddToCartListeners() {
            // todo - when drumshop page will be refactored with vue, remove/replace this logic

            let buttons = document.querySelectorAll('.vue-add-to-cart');

            if (buttons.length) {
                Array.from(buttons).forEach((element) => {

                    element.addEventListener('click', (event) => {

                        event.preventDefault();

                        let isValid = !this.loading && element.hasAttribute('data-product-json');

                        if (isValid && (element.classList.contains('selected-pack') || element.classList.contains('merch'))) {
                            isValid = element.classList.contains('active')
                        }

                        if (isValid) {
                            event.stopPropagation();

                            element.classList.add('loading');

                            this.openCartSidebar();

                            let productsObject = JSON.parse(element.getAttribute('data-product-json'));
                            let promoCode = element.hasAttribute('data-promocode') ? element.getAttribute('data-promocode') : null;
                            let lockedCart = element.hasAttribute('data-locked-cart') ? element.getAttribute('data-locked-cart') : null;

                            this.addToCart(productsObject, promoCode, lockedCart)
                                .then(() => {
                                    element.classList.remove('loading');
                                }).catch(e => e);
                        }
                    });
                });
            }
        },

        addToCart(products, promoCode, lockedCart) {
            if (!this.loading) {
                this.loading = true;

                let payload = {products: products};

                if (promoCode) {
                    payload['promo-code'] = promoCode;
                }

                if (lockedCart) {
                    payload['locked'] = lockedCart;
                }

                this.scrollTop = true;

                return EcommerceService
                    .addCartItems(this.cartDataUrl, payload)
                    .then(this.handleCartUpdate)
                    .catch(this.handleError);
            }
        },

        removeCartItem(cartItem) {
            if (!this.loading) {
                this.loading = true;

                EcommerceService
                    .removeCartItem(this.cartDataUrl, {productSku: cartItem.sku})
                    .then(this.handleCartUpdate)
                    .catch(this.handleError);
            }
        },

        clearCart() {
            if (!this.loading) {
                this.loading = true;

                EcommerceService
                    .clearCart(this.cartDataUrl,)
                    .then(this.handleCartUpdate)
                    .catch(this.handleError);
            }
        },

        updateCartItemQuantity({cartItem, quantity}) {
            if (!this.loading) {
                this.loading = true;

                EcommerceService
                    .updateCartItemQuantity(this.cartDataUrl, {productSku: cartItem.sku, quantity})
                    .then(this.handleCartUpdate)
                    .catch((e) => {
                        this.buildInitialCartData();
                        this.handleError(e);
                    });
            }
        },

        handleCartUpdate(response) {
            response.data ? this.updateCartData(response.data) : '';
            this.eventBus.emit('updateCartData', response.data);

            this.loading = false;

            if (!this.cartItems.length) {
                this.closeCartSidebar();
            } else if (!this.active) {
                this.openCartSidebar();
            }
        },

        addRecommendedProductToCart(cartItem) {
            let product = {};

            product[cartItem.sku] = cartItem.quantity;

            this.addToCart(product);
        },

        parseTotal(total) {
            return (total || 0).toFixed(2);
        },

        sumOfDiscounts() {
            return this.subTotalBeforeDiscounts() - this.subTotalAfterDiscounts();
        },

        subTotalBeforeDiscounts() {
            let subTotalBeforeDiscounts = 0;

            if (this.cartItems) {
                this.cartItems.forEach((item) => {
                    subTotalBeforeDiscounts += item.price_before_discounts;
                });
            }

            if (this.bonusItems) {
                this.bonusItems.forEach((item) => {
                    subTotalBeforeDiscounts += item.price_before_discounts;
                });
            }

            return subTotalBeforeDiscounts;
        },

        subTotalAfterDiscounts() {
            let subTotalAfterDiscounts = 0;

            if (this.cartItems) {
                this.cartItems.forEach((item) => {
                    subTotalAfterDiscounts += item.price_after_discounts;
                });
            }

            if (this.bonusItems) {
                this.bonusItems.forEach((item) => {
                    subTotalAfterDiscounts += item.price_after_discounts;
                });
            }

            return subTotalAfterDiscounts;
        },

        handleError(e) {
            this.loading = false;

            if (e?.response?.data?.meta?.cart?.errors) {
                this.$toasted.error(
                    e.response.data.meta.cart.errors[0],
                    {
                        icon: 'fal fa-meh-rolling-eyes fa-3x toasted-icon',
                    }
                );

                this.handleCartUpdate(e?.response);
            } else {
                this.$toasted.error(
                    'Something went wrong! Please try again or contact support using the chat widget at the bottom of the page.',
                    {
                        icon: 'fal fa-meh-rolling-eyes fa-3x toasted-icon',
                    }
                );
            }
        }
    },
}
</script>

<style lang="scss">
@import '../../assets/sass/partials/_variables.scss';

.toasted-container.custom-toast {
    z-index: 2147483010;

    &.top-left {
        left: 2%;
    }

    .toasted {
        max-width: 400px;

        .toasted-icon {
            margin-right: 20px;
        }

        .toasted-close-icon {
            color: #8B929A;
            font-size: 18px;
        }
    }
}

#cart-sidebar-overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    visibility: hidden;
    z-index: -1;
    opacity: 0;
    -webkit-transition: visibility 0.1s ease-in-out, opacity 0.1s ease-in-out;
    -moz-transition: visibility 0.1s ease-in-out, opacity 0.1s ease-in-out;
    -o-transition: visibility 0.1s ease-in-out, opacity 0.1s ease-in-out;

    &.active {
        z-index: 2147483005;
        opacity: 1;
        visibility: visible;
    }
}

#cart-sidebar {
    position: fixed;
    top: 0;
    right: -100%;
    z-index: 2147483006;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    height: 100vh;
    overflow: auto;
    padding: 20px;
    background: #FCFCFC;
    @include xSmallOnly {
        width: 95%;
    }

    &.active {
        right: 0;
    }

    .checkout a {
        color: #FFF;
        padding: 12px;
        font: 400 17px "Bebas Neue", sans-serif;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 50px;
        outline: none;
        text-align: center;
        user-select: none;
        transition: opacity .3s;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
        display: inline-block;
        width: 100%;

        &:hover {
            opacity: 0.85;
        }

        &.drumeo {
            background: #0B76DB;
        }

        &.pianote {
            background: #FF383F;
        }

        &.guitareo {
            background: #00C9AC;
        }

        &.singeo {
            background: #8300E9;
        }
    }
}
</style>