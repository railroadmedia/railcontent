import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {

    /**
     * Get a list of all products
     *
     * @param {array} brands - array of strings representing the brands to pull
     * @param {number} limit - the limit of users per page
     * @param {number} page - the page to pull
     * @param {string} order_by_column - the database column to order the results by
     * @param {string} order_by_direction - the direction to order results in
     * @returns {Promise} - resolved promise with the response object
     */
    getProducts({
        brands = ['drumeo', 'pianote', 'guitareo', 'recordeo', 'singeo', 'musora'],
        limit = 1000,
        page = 1,
        order_by_column = 'created_at',
        order_by_direction = 'asc',
    }) {
        return axios.get('/ecommerce/products', {
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
     * Get a list of all products
     *
     * @param {string} id
     * @returns {Promise} - resolved promise with the response object
     */
    getProductById(id) {
        return axios.get(`/ecommerce/product/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Either create or edit a product by ID
     *
     * @param {string} method - patch if editing
     * @param {string} id
     * @param {string} name
     * @param {string} brand
     * @param {string} sku
     * @param {string} fulfillment_sku
     * @param {string} inventory_control_sku
     * @param {number} price
     * @param {string} type
     * @param {string} category
     * @param {string} sales_page_url
     * @param {boolean} active
     * @param {boolean} is_physical
     * @param {number} weight
     * @param {number} stock
     * @param {number} min_stock_level
     * @param {string} thumbnail_url
     * @param {string} description
     * @param {string} subscription_interval_type
     * @param {number} subscription_interval_count
     * @param {array} digital_access_permission_names
     * @param {number} public_stock_count
     * @param {number} digital_access_time_interval_length
     * @param {string} digital_access_time_type
     * @param {string} digital_access_time_interval_type
     * @param {string} digital_access_type
     * @param {string} digital_membership_access_expiration_date
     * @returns {Promise} - resolved promise with the response object
     */
    setProduct(id, method, {
        name,
        brand,
        sku,
        fulfillment_sku,
        inventory_control_sku,
        price,
        type,
        category,
        sales_page_url,
        active,
        is_physical,
        weight = 0,
        stock = 0,
        min_stock_level = 0,
        thumbnail_url,
        description,
        subscription_interval_type,
        subscription_interval_count = 1,
        digital_access_permission_names= [],
        public_stock_count,
        digital_access_time_interval_length ,
        digital_access_time_type,
        digital_access_time_interval_type,
        digital_access_type,
        digital_membership_access_expiration_date
    }) {
        return axios({
            method,
            url: method === 'put' ? 'ecommerce/product' : `ecommerce/product/${id}`,
            data: {
                data: {
                    type: 'product',
                    attributes: {
                        name,
                        brand,
                        sku,
                        fulfillment_sku,
                        inventory_control_sku,
                        price,
                        type,
                        category,
                        sales_page_url,
                        active,
                        is_physical,
                        weight,
                        stock,
                        min_stock_level,
                        thumbnail_url,
                        description,
                        subscription_interval_type,
                        subscription_interval_count,
                        digital_access_permission_names,
                        public_stock_count,
                        digital_access_time_interval_length,
                        digital_access_time_type,
                        digital_access_time_interval_type,
                        digital_access_type,
                        digital_membership_access_expiration_date
                    },
                },
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
