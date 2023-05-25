import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {
    /**
     * Get a list of access codes
     *
     * @param {Array} brands
     * @param {Number} limit - the limit of access codes per page
     * @param {Number} page - the page to pull
     * @param {String} order_by_column - the database column to order the results by
     * @param {String} order_by_direction - the direction to order results in
     * @param {Number} claimer_id - only pull access codes claimed by this user
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getAccessCodes({
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        limit = 20,
        page = 1,
        order_by_column = 'created_at',
        order_by_direction = 'desc',
        claimer_id,
    }) {
        return axios
            .get('/ecommerce/access-codes', {
                params: {
                    brands,
                    limit,
                    page,
                    order_by_column,
                    order_by_direction,
                    claimer_id
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of access codes matching a search term
     *
     * @param {String} term - the search term
     * @param {Number} limit - the limit of access codes per page
     * @param {Number} page - the page to pull
     * @param {String} order_by_column - the database column to order the results by
     * @param {String} order_by_direction - the direction to order results in
     *
     * @returns {Promise} - resolved promise with the response object
     */
    searchAccessCodes({
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        term,
        limit = 20,
        page = 1,
        order_by_column = 'created_at',
        order_by_direction = 'desc',
    }) {
        return axios.get('/ecommerce/access-codes/search', {
            params: {
                brands,
                term,
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
     * Claim an access code for a user
     *
     * @param user_id
     * @param access_code
     *
     * @returns {Promise} - resolved promise with the response object
     */
    claimAccessCode(user_id, access_code) {
        return axios.post('/ecommerce/access-codes/claim', {
            claim_for_user_id: user_id,
            access_code,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Release an already claimed access code
     *
     * @param access_code_id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    releaseAccessCode(access_code_id) {
        return axios.post('/ecommerce/access-codes/release', {
            access_code_id,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
