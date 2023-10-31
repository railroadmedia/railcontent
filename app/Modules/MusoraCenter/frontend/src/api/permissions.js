import axios from 'axios';
import ErrorHandler from './error-handler';

export default {

    /**
     * Get a list of all permissions
     *
     * @static
     * @param {string} brand
     * @param {number} limit - the limit of permissions per page
     * @param {number} page - the page to pull
     * @param {string} sort - the database column to order the results by
     * @returns {Promise} - resolved promise with the response object
     */
    getPermissions({
        limit = 20,
        page = 1,
        sort = 'name',
    }) {
        return axios.get('/railcontent/permission', {
            params: {
                limit,
                page,
                sort,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a permission, either putting a new one or patching an existing one
     *
     * @static
     * @param {number} id - will submit a patch if exists
     * @param {string} brand
     * @param {string} name - then name of the permission
     * @returns {Promise} - resolved promise with the response object
     */
    setPermission({
        id,
        name,
        brand,
    }) {
        return axios({
            method: id === 0 ? 'put' : 'patch',
            url: id === 0 ? '/railcontent/permission' : `/railcontent/permission/${id}`,
            data: {
                id,
                name,
                brand,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a permission by ID
     *
     * @static
     * @param {string} id
     * @returns {Promise} - resolved promise with the response object
     */
    deletePermission(id) {
        return axios.delete(`/railcontent/permission/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
