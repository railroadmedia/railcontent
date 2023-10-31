import axios from 'axios/index';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get a list of all discounts
     *
     * @param {Array} brands
     * @param {String} order_by_column - the database column to order the results by
     * @param {String} order_by_direction - the direction to order results in
     * @param {String|Number} limit - the limit of discounts per page
     * @param {String|Number} page - the page to pull
     * @returns {Promise} - resolved promise with the response object
     */
    getDiscounts({
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        order_by_column = 'name',
        order_by_direction = 'desc',
        page = 1,
        limit = 20,
    }) {
        return axios.get('/ecommerce/discounts', {
            params: {
                brands,
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
     * Get a specific discount by ID
     *
     * @param {String|Number} id - the id of the discount to pull
     * @returns {Promise} - resolved promise with the response object
     */
    getDiscountById(id) {
        return axios.get(`/ecommerce/discount/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Create a discount or Update a discount by ID
     *
     * @param {String|Number} id - the id of the discount to pull
     * @param {String} name
     * @param {String} description
     * @param {String} type
     * @param {String} product_category
     * @param {Number} amount
     * @param {Boolean} active
     * @param {Boolean} visible
     * @param {String|Number} product_id
     * @returns {Promise} - resolved promise with the response object
     */
    setDiscount(id, {
        name,
        description,
        type,
        product_category,
        amount,
        active,
        visible,
        product_id,
    }) {
        return axios({
            method: id === 0 ? 'PUT' : 'PATCH',
            url: id === 0 ? '/ecommerce/discount' : `/ecommerce/discount/${id}`,
            data: {
                data: {
                    attributes: {
                        name,
                        description,
                        type,
                        product_category,
                        amount,
                        active,
                        visible,
                    },
                    relationships: product_id ? {
                        product: {
                            data: {
                                type: 'product',
                                id: product_id,
                            },
                        },
                    } : null,
                },
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Create a new discount criteria
     *
     * @param {String|Number} discount_id
     * @param {String} name
     * @param {String} type
     * @param {Number} min
     * @param {Number} max
     * @param {String} products_relation_type
     * @param {Array} products
     * @returns {Promise} - resolved promise with the response object
     */
    createDiscountCriteria(discount_id, {
        name,
        type,
        min,
        max,
        products_relation_type,
        products,
    }) {
        return axios.put(`/ecommerce/discount-criteria/${discount_id}`, {
            data: {
                type: 'discountCriteria',
                attributes: {
                    name,
                    type,
                    min,
                    max,
                    products_relation_type,
                },
                relationships: products.length ? {
                    products: {
                        data: products,
                    },
                } : undefined,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Update a discount criteria by id
     *
     * @param {String|Number} discount_criteria_id
     * @param {String} name
     * @param {String} type
     * @param {Number} min
     * @param {Number} max
     * @param {String} products_relation_type
     * @param {Array} products
     * @returns {Promise} - resolved promise with the response object
     */
    updateDiscountCriteria(discount_criteria_id, {
        name,
        type,
        min,
        max,
        products_relation_type,
        products,
    }) {
        return axios.patch(`/ecommerce/discount-criteria/${discount_criteria_id}`, {
            data: {
                type: 'discountCriteria',
                attributes: {
                    name,
                    type,
                    min,
                    max,
                    products_relation_type,
                },
                relationships: products.length ? {
                    products: {
                        data: products,
                    },
                } : undefined,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a discount criteria by id
     *
     * @param {string} discount_criteria_id
     * @returns {Promise} - resolved promise with the response object
     */
    deleteDiscountCriteria(discount_criteria_id) {
        return axios.delete(`/ecommerce/discount-criteria/${discount_criteria_id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
