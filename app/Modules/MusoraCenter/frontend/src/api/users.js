import axios from "axios";
import moment from "moment";
import ErrorHandler from "./error-handler";

export default {
    /**
     * Get a list for all users
     *
     * @param {number} limit - the limit of users per page
     * @param {number} page - the page to pull
     * @param {string} order_by_column - the database column to order the results by
     * @param {string} order_by_direction - the direction to order results in
     * @param {string} search_term
     * @returns {Promise} - resolved promise with the response object
     */
    getUsers({ limit = 20, page = 1, sort = "email", search_term = "" }) {
        return axios
            .get("/user-management-system/user/index", {
                params: {
                    limit,
                    page,
                    sort,
                    search_term,
                },
            })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a specific user by ID
     *
     * @param {number} id - the id of the user to pull
     * @returns {Promise} - resolved promise with the response object
     */
    getUserById(id) {
        return axios
            .get(`/user-management-system/user/show/${id}`)
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Add a new user with attributes
     *
     * @param {object} attributes
     * @returns {Promise} - resolved promise with the response object
     */
    addNewUser(attributes = {}) {
        return axios
            .put("/usora/json-api/user/store", {
                data: {
                    attributes,
                },
            })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set a specific users details
     *
     * @param {number|string} id
     * @param {object} attributes
     * @returns {Promise} - resolved promise with the response object
     */
    setUserAttributes(id, attributes = {}) {
        return axios
            .patch(`/musora-center/api/users/${id}`, {
                data: {
                    attributes,
                },
            })
            .then((response) => ({ response }))
            .catch((error) => ({ error: { ...error.response.data } }));
    },

    /**
     * Get the order history for a specific user
     *
     * @param {number} subscription_id - the id of the subscription to renew
     * @param {string} brand
     * @returns {Promise} - resolved promise with the response object
     */
    renewSubscription(subscription_id) {
        return axios
            .post(`/subscription-renew/${subscription_id}`)
            .then((response) => response)
            .catch((error) => {
                ErrorHandler.push(error);
                return error.response;
            });
    },

    /**
     * Get the permissions for a specific user
     *
     * @param {number} user_id
     * @param {boolean} only_active - Flag to pull only active permissions
     * @returns {Promise} - resolved promise with the response object
     */
    getUserPermissions({ user_id, only_active = false }) {
        return axios
            .get("/railcontent/user-permission", {
                params: {
                    user_id,
                    only_active,
                },
            })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Set the permissions for a specific user
     *
     * @param {number} id - The ID of the relationship between the user and permission
     * @param {number} user_id
     * @param {number} permission_id - the ID of the permission
     * @param {string} start_date
     * @param {string} expiration_date
     * @returns {Promise} - resolved promise with the response object
     */
    setUserPermissions({
        id,
        user_id,
        permission_id,
        start_date = moment(moment.now()).format("Y-M-D"),
        expiration_date,
    }) {
        return axios({
            method: id ? "patch" : "put",
            url: id
                ? `/railcontent/user-permission/${id}`
                : "/railcontent/user-permission",
            data: {
                id,
                user_id,
                permission_id,
                start_date,
                expiration_date,
            },
        })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of all customers
     *
     * @param {number} limit - the limit of users per page
     * @param {number} page - the page to pull
     * @param {string} order_by_column - the database column to order the results by
     * @param {string} order_by_direction - the direction to order results in
     * @param {string} search_term
     * @returns {Promise} - resolved promise with the response object
     */
    getCustomers({
        page = 1,
        limit = 20,
        order_by_column = "email",
        order_by_direction = "asc",
        term = "",
        brands = ["drumeo", "pianote", "guitareo"],
    }) {
        return axios
            .get("/ecommerce/customers", {
                params: {
                    page,
                    limit,
                    order_by_column,
                    order_by_direction,
                    term,
                    brands,
                },
            })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a customer by id
     *
     * @param {number} id
     * @returns {Promise} - resolved promise with the response object
     */
    getCustomerById(id) {
        return axios
            .get(`/ecommerce/customer/${id}`)
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    setCustomerNote(id, note) {
        return axios
            .patch(`/ecommerce/customer/${id}`, {
                data: {
                    type: "customer",
                    attributes: {
                        note,
                    },
                },
            })
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get user roles by user id
     *
     * @param {number} userId
     * @returns {Promise} - resolved promise with the response object
     */
    getUserRoles(userId) {
        return axios
            .get(`/permissions/user-role/${userId}`)
            .then((response) => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Sends requests to add and/or remove user roles
     *
     * @param {number} userId
     * @param {array} addRoles
     * @param {array} removeRolesIds
     *
     * @returns {Promise} - resolved promise when requests are finished, no requests response
     */
    updateUserRoles(userId, addRoles, removeRolesIds) {
        let requests = [];

        if (addRoles.length) {
            requests.push(
                axios.put("/permissions/user-roles", {
                    user_id: userId,
                    roles: addRoles,
                })
            );
        }

        if (removeRolesIds.length) {
            requests.push(
                axios.delete("/permissions/user-roles", {
                    data: {
                        roles: removeRolesIds,
                    },
                })
            );
        }

        return Promise.all(requests)
            .then(() => Promise.resolve(true))
            .catch(ErrorHandler.push);
    },

    /**
     * Delete user
     *
     * @param {number} id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    deleteUser(id) {
        return axios
            .delete(`/user-management-system/user/delete/${id}`)
            .then((response) => response)
            .catch(ErrorHandler.push);
    },
};
