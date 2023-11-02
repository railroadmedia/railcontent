import axios from 'axios/index';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get the order history for a specific user
     *
     * @param {String|Number} user_id - the id of the user
     * @param {String|Number} customer_id
     * @param {Array} brands
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @param {String|Number} page
     * @param {String|Number} limit
     * @param {String} start_date
     * @param {String} end_date
     * @returns {Promise} - resolved promise with the response object
     */
    getUserOrderHistory({
        user_id,
        customer_id,
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        page = 1,
        limit = 20,
        start_date,
        end_date,
    }) {
        return axios.get('/ecommerce/orders', {
            params: {
                user_id,
                customer_id,
                brands,
                order_by_column,
                order_by_direction,
                page,
                limit,
                'start-date': start_date,
                'end-date': end_date,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Add products to the current cart
     *
     * @param {array} products
     *
     * @returns {Promise} - resolved promise with the response object
     */
    addProductToCart({
        products,
    }) {
        return axios.put('/add-to-cart', {
            products,
        });
    },

    /**
     * Get a specific order by ID
     *
     * @param {String|Number} order_id - the id of the order to pull
     * @returns {Promise} - resolved promise with the response object
     */
    getOrderById(order_id) {
        return axios.get(`/ecommerce/order/${order_id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Update order field values
     *
     * @param {String|Number} order_id
     * @param {Number} total_due
     * @param {Number} taxes_due
     * @param {Number} shipping_due
     * @param {Number} total_paid
     * @param {String} note
     * @returns {Promise} - resolved promise with the response object
     */
    updateOrder(order_id, {
        total_due,
        taxes_due,
        shipping_due,
        total_paid,
        note,
    }) {
        return axios
            .patch(`/ecommerce/order/${order_id}`, {
                data: {
                    attributes: {
                        total_due,
                        taxes_due,
                        shipping_due,
                        total_paid,
                        note,
                    },
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Create an order for a user
     *
     * @param {String} user_id
     * @param {String} brand - the brand to process the order for
     * @param {String} gateway - the brand stripe account to use
     * @param {String|Number} shipping_address_id
     * @param {String|Number} payment_method_id
     * @param {String} payment_method_type - must be 'credit_card'
     * @param {String} card_token
     * @param {String} billing_region - optional if no payment_method_id
     * @param {String} billing_country - optional if no payment_method_id
     * @param {String} shipping_first_name - optional if no shipping_address_id
     * @param {String} shipping_last_name - optional if no shipping_address_id
     * @param {String} shipping_address_line_1 - optional if no shipping_address_id
     * @param {String} shipping_address_line_2 - optional if no shipping_address_id
     * @param {String} shipping_city - optional if no shipping_address_id
     * @param {String} shipping_region - optional if no shipping_address_id
     * @param {String} shipping_zip_or_postal_code - optional if no shipping_address_id
     * @param {String} shipping_country - optional if no shipping_address_id
     * @param {String} currency
     * @param {String|Number} product_taxes_due_override
     * @param {String|Number} shipping_due_override
     * @param {Array} order_items_due_overrides - Array of objects with sku and amount properties
     * @param note
     * @param number_of_payments
     * @returns {Promise} - resolved promise with the response object
     */
    createOrder({
        customer_id,
        user_id,
        brand,
        gateway,
        shipping_address_id,
        payment_method_id,
        payment_method_type,
        card_token,
        billing_region,
        billing_country,
        billing_email,
        shipping_first_name,
        shipping_last_name,
        shipping_address_line_1,
        shipping_address_line_2,
        shipping_city,
        shipping_region,
        shipping_zip_or_postal_code,
        shipping_country,
        currency = 'USD',
        product_taxes_due_override,
        shipping_taxes_due_override,
        shipping_due_override,
        order_items_due_overrides,
        note,
        payment_plan_number_of_payments,
    }) {
        return axios.put('/ecommerce/json/order-form/submit', {
            customer_id,
            user_id,
            brand,
            gateway,
            shipping_address_id,
            payment_method_id,
            payment_method_type,
            card_token,
            billing_region,
            billing_country,
            billing_email,
            shipping_first_name,
            shipping_last_name,
            shipping_address_line_1,
            shipping_address_line_2,
            shipping_city,
            shipping_region,
            shipping_zip_or_postal_code,
            shipping_country,
            currency,
            product_taxes_due_override,
            shipping_taxes_due_override,
            shipping_due_override,
            order_items_due_overrides,
            note,
            payment_plan_number_of_payments,
        })
            .then(response => response)
            .catch((error) => {
                ErrorHandler.push(error);
                return error.response;
            });
    },
};
