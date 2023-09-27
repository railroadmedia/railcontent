import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get a list of all user permissions
     *
     * @param {String|Number} user_id
     * @param {Number} limit
     * @param {Number} page
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @returns {Promise} - resolved promise with the response object
     */
    getUserAccessPermissions(user_id, {
        limit = 20,
        page = 1,
        order_by_column = 'created_at',
        order_by_direction = 'asc',
    }) {
        return axios.get('/ecommerce/user-access-permissions', {
            params: {
                user_id,
                limit,
                page,
                order_by_column,
                order_by_direction,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Add a product to a users account
     *
     * @param {String|Number} user_product_id
     * @param {Number} quantity
     * @param {String} expiration_date
     * @param {String} start_date
     * @param {String|Number} user_id
     * @param {String|Number} product_id
     * @returns {Promise} - resolved promise with the response object
     */
    setUserPermission(user_product_id, {
        quantity = 1,
        expiration_date,
        start_date,
        user_id,
        product_id,
    }) {
        const url = user_product_id ? `/ecommerce/user-permission/${user_product_id}` : '/ecommerce/user-permission';
        const method = user_product_id ? 'PATCH' : 'PUT';

        return axios({
            url,
            method,
            data: {
                data: {
                    type: 'userPermission',
                    attributes: {
                        quantity,
                        start_date,
                        expiration_date,
                    },
                    relationships: {
                        user: user_id ? {
                            data: {
                                type: 'user',
                                id: user_id,
                            },
                        } : undefined,
                        product: product_id ? {
                            data: {
                                type: 'product',
                                id: product_id,
                            },
                        } : undefined,
                    },
                },
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
