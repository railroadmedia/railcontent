import axios from 'axios/index';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Delete weight range
     *
     * @param {number} id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    deleteWeightRange(id) {
        return axios
            .delete(`/shipping-cost/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Update weight range
     *
     * @static
     *
     * @param {number} id
     * @param {number} min
     * @param {number} max
     * @param {number} price
     *
     * @returns {Promise} - resolved promise with the response object
     */
    updateWeightRange({
        id, min, max, price, shipping_option_id, 
    }) {
        return axios
            .patch(`/shipping-cost/${id}`, {
                min,
                max,
                price,
                shipping_option_id,
            })
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    /**
     * Add a new weight range
     *
     * @param {number} min
     * @param {number} max
     * @param {number} price
     * @param {number} shipping_option_id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    addNewWeightRange({
        min, max, price, shipping_option_id,
    }) {
        return axios
            .put('/shipping-cost', {
                min,
                max,
                price,
                shipping_option_id,
            })
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of all shipping options
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getShippingOptions() {
        return axios
            .get('/shipping-options')
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Add a new shipping option
     *
     * @param {string} country
     * @param {number} priority
     * @param {boolean} active
     *
     * @returns {Promise} - resolved promise with the response object
     */
    addNewShippingOption({ country, priority, active }) {
        return axios
            .put('/shipping-option', { country, priority, active })
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    /**
     * Update shipping option
     *
     * @static
     *
     * @param {number} id
     * @param {string} country
     * @param {number} priority
     * @param {boolean} active
     *
     * @returns {Promise} - resolved promise with the response object
     */
    updateShippingOption({
        id,
        country,
        priority,
        active,
    }) {
        return axios
            .patch(`/shipping-option/${id}`, { country, priority, active })
            .then(response => response.data)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete shipping option
     *
     * @param {number} id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    deleteShippingOption(id) {
        return axios
            .delete(`/shipping-option/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },


    /**
     * Get a list of all shipping fulfillments
     *
     * @param {String} order_by_column - The db column to order the results by
     * @param {String} order_by_direction
     * @param {String} start_date
     * @param {String} end_date
     * @param {number} order_id
     * @param {number} page
     * @param {Number} csv - Number representing a boolean (0 or 1)
     * @returns {Promise} - resolved promise with the response object
     */
    getShippingFulfillments({
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        start_date,
        end_date,
        order_id,
        page = 1,
        csv = 0,
    }) {
        return axios.get('/ecommerce/fulfillment', {
            params: {
                order_by_column,
                order_by_direction,
                small_date_time: start_date,
                big_date_time: end_date,
                csv,
                page,
                order_id
            },
        })
            .then(resolved => resolved)
            .catch(ErrorHandler.push);
    },

    /**
     * Fulfill an order item by ID
     *
     * @param {String|Number} tracking_number - The db column to order the results by
     * @param {String} shipping_company
     * @param {String} fulfilled_on
     * @param {String|Number} order_item_id
     * @param {String|Number} order_id
     * @returns {Promise} - resolved promise with the response object
     */
    fulfillOrderItem({
        tracking_number,
        shipping_company,
        fulfilled_on,
        order_item_id,
        order_id,
    }) {
        return axios.patch('/ecommerce/fulfillment', {
            tracking_number,
            shipping_company,
            fulfilled_on,
            order_item_id,
            order_id,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Fulfill an order item by ID
     *
     * @param {FormData} form_data - The FormData object with a 'csv_file' key
     * @returns {Promise} - resolved promise with the response object
     */
    fulfillOrdersViaCSV(form_data) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                processData: false,
                contentType: false,
            },
        };

        return axios.post(
            '/ecommerce/fulfillment/mark-fulfilled-csv-upload-shipstation',
            form_data,
            config,
        )
            .then(response => response)
            .catch(error => error.response.data);
    },

    /**
     * Delete a Fulfillment by ID
     *
     * @param {String|Number} id
     * @returns {Promise} - resolved promise with the response object
     */
    deleteFulfillment(id) {
        return axios.delete(`/ecommerce/fulfillment/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a Fulfillment order item
     *
     * @param {String|Number} order_id
     * @param {String|Number} order_item_id
     * @returns {Promise} - resolved promise with the response object
     */
    deleteFulfillmentOrderItem(order_id, order_item_id) {
        return axios.delete(`/ecommerce/fulfillment/${order_id}/${order_item_id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
