import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get the addresses for a specific user
     *
     * @param {String|Number} user_id
     * @param {String|Number} customer_id
     * @param {String} order_by_column
     * @param {String} order_by_direction
     * @param {String|Number} page
     * @param {String|Number} limit
     * @param {Array} brands
     * @returns {Promise} - resolved promise with the response object
     */
    getUserAddresses(user_id, {
        customer_id,
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        page = 1,
        limit = 20,
    }) {
        return axios.get('/ecommerce/address', {
            params: {
                user_id,
                customer_id,
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

    /**
     * Set a specific users address to be used as a shipping or billing address
     *
     * @param {String|Number} address_id
     * @param {String|Number} user_id
     * @param {String|Number} customer_id
     * @param {String} type
     * @param {String} brand
     * @param {String} first_name
     * @param {String} last_name
     * @param {String|Number} street_line_1
     * @param {String|Number} street_line_2
     * @param {String|Number} zip
     * @param {String} city
     * @param {String} region
     * @param {String} country
     * @returns {Promise} - resolved promise with the response object
     */
    setUserAddress(address_id = 0, {
        user_id,
        customer_id,
        type,
        brand,
        first_name,
        last_name,
        street_line_1,
        street_line_2,
        zip,
        city,
        region,
        country,
    }) {
        let relationships = {};

        if (user_id !== null) {
            relationships.user = {
                data: {
                    type: 'user',
                    id: user_id,
                },
            };
        }

        if (customer_id !== null) {
            relationships.customer = {
                data: {
                    type: 'customer',
                    id: customer_id,
                },
            };
        }

        return axios({
            method: address_id === 0 ? 'PUT' : 'PATCH',
            url: address_id === 0 ? '/ecommerce/address' : `/ecommerce/address/${address_id}`,
            data: {
                data: {
                    attributes: {
                        type,
                        brand,
                        first_name,
                        last_name,
                        street_line_1,
                        street_line_2,
                        zip,
                        city,
                        region,
                        country,
                    },
                    relationships,
                },
            },
        })
            .then(response => ({ response }))
            .catch(error => ({ error: { ...error.response.data } }));
    },
};
