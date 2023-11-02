import axios from 'axios/index';
import ErrorHandler from '../error-handler';

export default {
    /**
     * Get the subscriptions for a specific user
     *
     * @param {String|Number} user_id - the id of the user
     * @param {String|Number} customer_id
     * @param {Array} brands
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @param {String|Number} page
     * @param {String|Number} limit
     * @returns {Promise} - resolved promise with the response object
     */
    getUserSubscriptions({
        user_id,
        customer_id,
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        page = 1,
        limit = 20,
    }) {
        return axios.get('/ecommerce/subscriptions', {
            params: {
                user_id,
                customer_id,
                brands,
                order_by_column,
                order_by_direction,
                page,
                limit,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },


    /**
     * Edit a specific subscription by ID
     *
     * @param {number} subscription_id
     * @param {number} user_id
     * @param {string} brand
     * @param {string} type
     * @param {boolean} is_active
     * @param {string} start_date
     * @param {string} paid_until
     * @param {string} canceled_on
     * @param {string} note
     * @param {number} total_price_per_payment
     * @param {string} currency
     * @param {string} interval_type
     * @param {number} interval_count
     * @param total_cycles_due
     * @param {number} total_cycles_paid
     * @param {number} payment_method_id
     * @param {number} product_id
     * @param order_id
     * @returns {Promise} - resolved promise with the response object
     */
    setUserSubscription(subscription_id, {
        user_id,
        brand,
        type,
        is_active,
        stopped,
        start_date,
        paid_until,
        renewal_attempt,
        canceled_on,
        note,
        total_price,
        currency,
        interval_type,
        interval_count,
        total_cycles_due = null,
        total_cycles_paid,
        payment_method_id,
        product_id,
        order_id,
    }) {
        return axios({
            method: subscription_id === 0 ? 'PUT' : 'PATCH',
            url: subscription_id === 0 ? '/ecommerce/subscription' : `/ecommerce/subscription/${subscription_id}`,
            data: {
                data: {
                    type: 'subscription',
                    attributes: {
                        user_id,
                        brand,
                        type,
                        is_active,
                        stopped,
                        start_date,
                        paid_until,
                        renewal_attempt,
                        canceled_on,
                        note,
                        total_price,
                        currency,
                        interval_type,
                        interval_count,
                        total_cycles_due,
                        total_cycles_paid,
                        payment_method_id,
                        product_id,
                        order_id,
                    },
                    relationships: {
                        user: user_id ? {
                            data: {
                                type: 'user',
                                id: user_id,
                            },
                        } : undefined,
                        order: order_id ? {
                            data: {
                                type: 'order',
                                id: order_id,
                            },
                        } : undefined,
                        product: product_id ? {
                            data: {
                                type: 'product',
                                id: product_id,
                            },
                        } : undefined,
                        paymentMethod: payment_method_id ? {
                            data: {
                                type: 'payment_method',
                                id: payment_method_id,
                            },
                        } : undefined,
                    },
                },
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Renew a users subscription by ID
     *
     * @param {number} subscription_id
     * @returns {Promise} - resolved promise with the response object
     */
    renewUserSubscription(subscription_id) {
        return axios.post(`/ecommerce/subscription-renew/${subscription_id}`)
            .then(response => ({ response }))
            .catch(error => ({ error: { ...error.response.data } }));
    },

    /**
     * Get all subscriptions that failed billing
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getFailedBilling({
        type,
        page = 1,
        limit = 20,
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        brands,
        end_date,
        start_date,
        csv,
    }) {
        return axios.get('/ecommerce/failed-billing', {
            params: {
                type,
                page,
                limit,
                order_by_column,
                order_by_direction,
                brands,
                big_date_time: end_date,
                small_date_time: start_date,
                csv,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
