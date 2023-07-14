<template>
    <div class="flex items-start sm:items-center sm:px-2 mb-2 sm:mb-4">
        <div class="flex flex-col rounded-full overflow-hidden flex-grow-0 flex-shrink-0 w-16 sm:w-32 lg:w-32 border-4 border-gray-300 bg-gray-300">
            <div
                class="relative"
                style="padding-bottom:100%"
            >
                <img
                    class="absolute w-full h-full object-center object-cover"
                    :src="'https://www.musora.com/musora-cdn/image/width=290,quality=95/' + item.thumbnail_url"
                >
            </div>
        </div>
        <div class="flex flex-col mb-2 pl-2 sm:pl-4">
            <div class="flex flex-wrap items-start">
                <div class="flex flex-col w-full sm:w-9/12">
                    <h3 class="title font-black">
                        {{ item.name }}
                    </h3>
                    <h4 class="body text-grey-4">
                        {{ item.description }}
                    </h4>

                    <div
                        v-if="item.requires_shipping && !isCartLocked"
                        class="inline-flex justify-start items-center mr-auto mt-2"
                    >
                        <div class="flex items-center mr-2">
                            <h4 class="leading-none font-black text-sm">
                                Quantity:
                            </h4>
                        </div>

                        <div class="flex flex-col flex-auto mr-2">
                            <input
                                v-model="$_itemQuantity"
                                type="number"
                                min="1"
                                max="99"
                                class="no-label text-center text-sm p-1 rounded-full"
                                style="border: 1px solid #d1d1d1;background:none;"
                            >
                        </div>

                        <div
                            v-if="loading"
                            class="flex flex-col flex-auto body "
                        >
                            <i
                                class="fas fa-spin fa-spinner inline-flex justify-center"
                                :class="themeTextClass"
                            ></i>
                        </div>
                    </div>

                    <div
                        v-if="!isCartLocked"
                        class="flex"
                    >
                        <div class="inline-flex flex-col mr-auto">
                            <a
                                class="text-error text-xs mt-1 pointer"
                                title="Remove Item"
                                @click.stop.prevent="removeCartItem"
                            >
                                Remove
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-right w-full sm:w-3/12">
                    <div class="flex flex-col">
                        <h3
                            v-if="isDiscounted"
                            class="text-xs font-normal font-strike text-grey-3 mr-1"
                        >
                            ${{ Number(item.price_before_discounts).toFixed(2) }}
                        </h3>

                        <h2
                            v-if="totalPriceAfterDiscounts > 0"
                            class="title font-black"
                            :class="themeTextClass"
                        >
                            ${{ totalPriceAfterDiscounts }}
                        </h2>

                        <h2
                            v-if="totalPriceAfterDiscounts <= 0"
                            class="title font-black"
                            :class="themeTextClass"
                        >
                            FREE
                        </h2>
                    </div>

                    <h3
                        v-if="item.subscription_interval_type && totalPriceAfterDiscounts > 0"
                        class="text-xs"
                    >
                        <span v-if="item.subscription_renewal_price != totalPriceAfterDiscounts">
                            then ${{ Number(item.subscription_renewal_price).toFixed(2)}}
                        </span>

                        {{ intervalString }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import EcommerceService from '../../assets/js/services/ecommerce.js';
import ThemeClasses from '../../mixins/ThemeClasses';
import Toasts from '../../assets/js/classes/toasts';
import CartEvents from './_events';
import ErrorHandler from '../../assets/js/services/_error-handler';


export default {
    name: 'OrderFormCartItem',
    mixins: [ThemeClasses, CartEvents],
    props: {
        item: {
            type: Object,
        },

        cartDataUrl: {
            type: String,
        },

        isCartLocked: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            loading: false,
            updateQuantityTimeout: null,
            itemQuantity: this.item.quantity,
        };
    },
    computed: {
        $_itemQuantity: {
            get() {
                return this.itemQuantity;
            },
            set(val) {
                // This timeout prevents multiple requests from being sent
                clearTimeout(this.updateQuantityTimeout);

                this.updateQuantityTimeout = setTimeout(() => {
                    this.updateCartItemQuantity(val);
                    this.itemQuantity = val;
                }, 500);
            },
        },

        totalPriceAfterDiscounts() {
            return Number(this.item.price_after_discounts).toFixed(2);
        },

        isDiscounted() {
            return this.item.price_after_discounts !== this.item.price_before_discounts;
        },

        intervalString() {
            if(this.item.subscription_interval_count === 1){
                return `per ${ this.item.subscription_interval_type }`;
            }

            return `per ${ this.item.subscription_interval_count } ${ this.item.subscription_interval_type }s`
        },
    },
    mounted() {
        // console.log(this.itemQuantity)
    },
    methods: {
        updateCartItemQuantity(quantity) {
            this.loading = true;
            EcommerceService.updateCartItemQuantity(
                this.cartDataUrl,
                {
                    productSku: this.item.sku,
                    quantity,
                }
            )
                .then((response) => {
                    this.handleResponse(response)
                })
                .catch(() => {
                    console.log('ERROR')
                    this.showErrorToast();
                    this.loading = false;
                });
        },

        removeCartItem() {
            this.loading = true;

            EcommerceService.removeCartItem(
                this.cartDataUrl,
                {
                    productSku: this.item.sku,
                }
            ).then(this.handleResponse);
        },

        handleResponse(response) {
            if (response) {
                this.emitUpdateCartItem(response.data);
            } else {
                this.showErrorToast();
            }

            this.loading = false;
        },

        showErrorToast() {
                Toasts.push({
                    icon: 'disappointed',
                    title: 'Something went wrong!',
                    themeColor: this.themeColor,
                    message: 'Please contact support using the chat widget at the bottom of the page.',
                });

                this.itemQuantity = this.item.quantity;
        },
    },
};
</script>
