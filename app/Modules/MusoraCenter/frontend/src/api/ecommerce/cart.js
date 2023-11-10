import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get the current session cart
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getCart(userId) {
        return axios.get(`/ecommerce/json/cart?userid=${userId}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get the addresses for a specific user
     *
     * @param {String} sku
     * @param {Number|String} quantity
     * @param {Boolean} locked
     * @returns {Promise} - resolved promise with the response object
     */
    addProductToCart({
        sku,
        quantity = 1,
        locked = false,
        userId = null,
    }) {
        const products = {};
        products[sku] = quantity;

        return axios.put(`/ecommerce/json/add-to-cart?userid=${userId}`, {
            products,
            locked,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get the addresses for a specific user
     *
     * @param {Array} skusAndQuantitiesArrayOfObjects
     * @returns {Promise} - resolved promise with the response object
     */
    addProductsToCart(skusAndQuantitiesArrayOfObjects) {
        const skuQuantityQueryStringParams = [];

        skusAndQuantitiesArrayOfObjects.forEach((element) => {
            skuQuantityQueryStringParams.push(`products[${element.sku}]=${element.quantity}`);
        });

        return axios.get(`/ecommerce/add-to-cart?${skuQuantityQueryStringParams.join('&')}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Update a products quantity in the cart
     *
     * @param {String} sku
     * @param {Number|String} quantity
     * @returns {Promise} - resolved promise with the response object
     */
    updateProductQuantity({
        sku,
        quantity,
    }) {
        return axios.patch(`/ecommerce/json/update-product-quantity/${sku}/${quantity}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete an item from the cart based on it's SKU
     *
     * @param {String} sku
     * @returns {Promise} - resolved promise with the response object
     */
    deleteItemFromCart(sku, userId) {
        return axios.delete(`/ecommerce/json/remove-from-cart/${sku}?userId=${userId}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Clear the current cart
     *
     * @returns {Promise} - resolved promise with the response object
     */
    clearCart() {
        return axios.delete('/ecommerce/json/clear-cart')
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Updates the session addresses
     *
     * @param {String|Number} product_taxes_due_override
     * @param {String|Number} shipping_taxes_due_override
     * @param {String|Number} shipping_due_override
     * @param {Array} order_items_due_overrides - Array of objects containing an SKU and Amount
     * @returns {Promise}
     */
    updateTotalOverridesInSession({
        product_taxes_due_override,
        shipping_taxes_due_override,
        shipping_due_override,
        order_items_due_overrides,
    }) {
        return axios.patch('/ecommerce/json/update-total-overrides', {
            product_taxes_due_override,
            shipping_taxes_due_override,
            shipping_due_override,
            order_items_due_overrides,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Updates the session addresses
     *
     * @param {String|Number} shipping_address_id
     * @param {String|Number} billing_address_id
     * @param {String} billing_country
     * @param {String} billing_region
     * @param {String} shipping_first_name
     * @param {String} shipping_last_name
     * @param {String} shipping_address_line_1
     * @param {String} shipping_address_line_2
     * @param {String} shipping_city
     * @param {String} shipping_country
     * @param {String} shipping_region
     * @param {String} shipping_zip_or_postal_code
     * @param {String} brand
     * @returns {Promise}
     */
    updateAddressesInSession({
        shipping_address_id,
        billing_address_id,
        billing_country,
        billing_region,
        shipping_first_name,
        shipping_last_name,
        shipping_address_line_1,
        shipping_address_line_2,
        shipping_city,
        shipping_country,
        shipping_region,
        shipping_zip_or_postal_code,
        brand,
        userId,
    }) {
        return axios.put(`/ecommerce/session/address?${userId}`, {
            'shipping_address_id': shipping_address_id,
            'billing_address_id': billing_address_id,
            'billing_country': billing_country,
            'billing_region': billing_region,
            'shipping_first_name': shipping_first_name,
            'shipping_last_name': shipping_last_name,
            'shipping_address_line_1': shipping_address_line_1,
            'shipping_address_line_2': shipping_address_line_2,
            'shipping_city': shipping_city,
            'shipping_country': shipping_country,
            'shipping_region': shipping_region,
            'shipping_zip_or_postal_code': shipping_zip_or_postal_code,
            'brand': brand,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
