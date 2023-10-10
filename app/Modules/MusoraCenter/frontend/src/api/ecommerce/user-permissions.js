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
     * @param {String|Number} user_permission_id
     * @param {Number} days
     * @param {Number} months
     * @param {String} status
     * @param {String} start_date
     * @param {String|Number} user_id
     * @param {String|Number} lifetime
     * @param {String|Number} permission_id
     * @returns {Promise} - resolved promise with the response object
     */
    setUserPermission(user_permission_id, {
        user_id,
        permission_id,
        start_date,
        lifetime,
        days,
        months,
        status,
    }) {
        const url = user_permission_id ? `/ecommerce/user-access-permission/${user_permission_id}` : '/ecommerce/user-access-permission';
        const method = user_permission_id ? 'PATCH' : 'PUT';

        return axios({
            url,
            method,
            data: {
                user_id,
                permission_id,
                start_date,
                lifetime,
                days,
                months,
                status
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
