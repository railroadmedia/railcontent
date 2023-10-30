import axios from 'axios/index';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get the payment methods for a specific user
     *
     * @param {String|Number} id - the id of the user
     * @param {Boolean} deleted - whether or not to view deleted items
     * @returns {Promise} - resolved promise with the response object
     */
    getUserPaymentMethods(id, deleted = false) {
        return axios.get(`/ecommerce/user-payment-method/${id}`, {
            params: {
                view_deleted: deleted,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get the payment methods for a specific customer
     *
     * @param {String|Number} id - the id of the user
     * @param {Boolean} deleted - whether or not to view deleted items
     * @returns {Promise} - resolved promise with the response object
     */
    getCustomerPaymentMethods(id, deleted = false) {
        return axios.get(`/ecommerce/customer-payment-method/${id}`, {
            params: {
                view_deleted: deleted,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a payment method for a specific user
     *
     * @param {String|Number} user_id
     * @param {String} method_type
     * @param {String} gateway - the brand to apply this payment method to
     * @param {String} card_token - the card token returned by stripe
     * @param {String|Number} address_id
     * @returns {Promise} - resolved promise with the response object
     */
    setUserPaymentMethod(user_id, {
        gateway = 'drumeo',
        method_type = 'credit_card',
        card_token,
        address_id,
    }) {
        return axios.put('/ecommerce/payment-method', {
            user_id,
            card_token,
            method_type,
            gateway,
            address_id,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a payment method by it's ID
     *
     * @param {String|Number} id
     * @returns {Promise} - resolved promise with the response object
     */
    deletePaymentMethod(id) {
        return axios.delete(`/ecommerce/payment-method/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get the addresses for a specific user
     *
     * @param {String|Number} order_id - Use if you are pulling payments for an order
     * @param {String|Number} subscription_id - Use if you are pulling payments for a subscription
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @param {String|Number} page
     * @param {String|Number} limit
     * @returns {Promise} - resolved promise with the response object
     */
    getPayments({
        order_id,
        subscription_id,
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        page = 1,
        limit = 100,
    }) {
        return axios.get('/ecommerce/payment', {
            params: {
                order_id,
                subscription_id,
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
     * Refund a specific payment by ID
     *
     * @param {String|Number} payment_id
     * @param {String} gateway_name
     * @param {Number} refund_amount
     * @param {String} note
     * @returns {Promise} - resolved promise with the response object
     */
    refundPayment({
        payment_id,
        gateway_name,
        refund_amount,
        note,
    }) {
        return axios.put('/ecommerce/refund', {
            data: {
                attributes: {
                    gateway_name,
                    refund_amount,
                    note,
                },
                relationships: {
                    payment: {
                        data: {
                            type: 'payment',
                            id: payment_id,
                        },
                    },
                },
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Send the invoice for a payment by ID
     *
     * @param {String|Number} payment_id
     */
    sendPaymentInvoice({
        payment_id,
    }) {
        return axios.put(`/ecommerce/send-invoice/${payment_id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
