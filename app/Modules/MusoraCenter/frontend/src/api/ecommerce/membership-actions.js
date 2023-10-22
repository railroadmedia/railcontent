import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get the addresses for a specific user
     *
     * @param {String|Number} user_id
     * @param {String|Number} subscription_id
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @param {String|Number} page
     * @param {String|Number} limit
     * @param {Array} brands
     * @returns {Promise} - resolved promise with the response object
     */
    getMembershipActions(user_id, {
        subscription_id = null,
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        page = 1,
        limit = 20,
    }) {
        return axios.get('/ecommerce/membership-action', {
            params: {
                user_id,
                subscription_id,
                order_by_column,
                order_by_direction,
                page,
                limit,
                brands,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
