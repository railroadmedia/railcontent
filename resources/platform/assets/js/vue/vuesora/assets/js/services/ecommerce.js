import axios from 'axios';
import ErrorHandler from './_error-handler';

export default {

    /**
     * Request to check if new account email is exists
     *
     * @param {Object} email
     *
     * @returns {Promise}
     */
    checkEmail(email) {
        return axios.post('/order/check-email-exists', {
            email,
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Request to submit the order form data
     *
     * @param {String} url
     * @param {Object} payload
     *
     * @returns {Promise}
     */
    submitOrder(url, payload) {
        return axios.put(url+'/ecommerce/json/order-form/submit', payload);
    },

    /**
     * Request to add cart items
     *
     * @param {String} url
     * @param {Object} payload
     *
     * @returns {Promise}
     */
    addCartItems(url, payload) {
        return axios.put(url+'/ecommerce/json/add-to-cart', payload);
    },

    /**
     * Updates the cart item quantity
     *
     * @param {String} url
     * @param {String} productSku
     * @param {Number} quantity
     *
     * @returns {Promise}
     */
    updateCartItemQuantity(
        url,
        {
            productSku,
            quantity,
        }
    ) {
        return axios.patch(url+`/ecommerce/json/update-product-quantity/${productSku}/${quantity}`)
    },

    /**
     * Removes a cart item
     *
     * @param {String} url
     * @param {String} productSku
     *
     * @returns {Promise}
     */
    removeCartItem(url, { productSku }) {
        return axios.delete(url+`/ecommerce/json/remove-from-cart/${productSku}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Clears all cart items.
     *
     * @param {String} url
     * 
     * @returns {Promise}
     */
    clearCart(url) {
        return axios.delete(url+`/ecommerce/json/clear-cart`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Updates the session addresses
     *
     * @param {String} billingEmail
     * @param {String} billingCountry
     * @param {String} billingState
     * @param {String} billingZip
     * @param {String} shippingFirstName
     * @param {String} shippingLastName
     * @param {String} shippingAddressLine1
     * @param {String} shippingAddressLine2
     * @param {String} shippingCity
     * @param {String} shippingState
     * @param {String} shippingCountry
     * @param {String} shippingZip
     * @param paymentMethodId
     * @param shippingAddressId
     * @param billingAddressId
     * @returns {Promise}
     */
    updateAddressesInSession({
        billingEmail,
        billingCountry,
        billingState,
        billingZip,
        shippingFirstName,
        shippingLastName,
        shippingAddressLine1,
        shippingAddressLine2,
        shippingCity,
        shippingState,
        shippingCountry,
        shippingZip,
        paymentMethodId,
        shippingAddressId,
        billingAddressId,
    }) {
        return axios.put('/ecommerce/session/address', {
            'shipping_address_line_1': shippingAddressLine1,
            'shipping_address_line_2': shippingAddressLine2,
            'shipping_city': shippingCity,
            'shipping_country': shippingCountry,
            'shipping_first_name': shippingFirstName,
            'shipping_last_name': shippingLastName,
            'shipping_region': shippingState,
            'shipping_zip_or_postal_code': shippingZip,
            'billing_country': billingCountry,
            'billing_region': billingState,
            'billing_zip_or_postal_code': billingZip,
            'billing_email': billingEmail,
            'payment_method_id': paymentMethodId,
            'shipping_address_id': shippingAddressId,
            'billing_address_id': billingAddressId,
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Updates number of payments
     *
     * @param {String|Number} numberOfPayments
     * @returns {Promise}
     */
    updateNumberOfPayments(url, numberOfPayments) {
        return axios.put(url+`/ecommerce/json/update-number-of-payments/${numberOfPayments}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Get the current users payment methods
     *
     * @returns {Promise}
     */
    getPaymentMethods(url, user_id) {
        return axios.get(url+`/ecommerce/user-payment-method/${user_id}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Update a users payment method
     *
     * @param {String} card_token
     * @param {String} gateway
     * @param {String} method_type
     * @param {String} currency
     * @param {String} billing_country
     * @param {String} billing_region
     * @param {String} renew_due_subscription
     * @param {String} update_active_subscriptions
     * @returns {Promise}
     */
    updatePaymentMethod({
        card_token,
        gateway,
        method_type,
        currency = 'USD',
        billing_country,
        billing_region,
        renew_due_subscription,
        update_active_subscriptions,
    }) {
        return axios.put('/update-payment-method', {
            card_token,
            gateway,
            method_type,
            currency,
            billing_country,
            billing_region,
            renew_due_subscription,
            update_active_subscriptions,
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Set the a users payment method as default
     *
     * @param {String|Number} payment_method_id
     * @returns {Promise}
     */
    setPaymentMethodAsDefault(url, payment_method_id) {
        return axios.patch(url+'/ecommerce/payment-method/set-default', {
            id: payment_method_id,
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Updates number of payments
     *
     * @param {String|Number} payment_method_id
     * @returns {Promise}
     */
    deletePaymentMethod(url, payment_method_id) {
        return axios.delete(url+`/ecommerce/payment-method/${payment_method_id}`)
            .then(response => response)
            .catch(ErrorHandler);
    },
};
