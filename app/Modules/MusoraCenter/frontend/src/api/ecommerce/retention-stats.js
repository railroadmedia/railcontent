import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {
    // membershipStatsCancelToken is shared between all retention backend requests
    membershipStatsCancelToken: null,

    /**
     * Get membership stats
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} interval_type
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getRetentionStats({
        start_date,
        end_date,
        interval_type,
        brand,
    }) {
        if (this.membershipStatsCancelToken) {
            this.membershipStatsCancelToken.cancel();
        }

        this.membershipStatsCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/retention-stats', {
                cancelToken: this.membershipStatsCancelToken.token,
                params: {
                    small_date_time: start_date,
                    big_date_time: end_date,
                    interval_type,
                    brand
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get average membership end
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} interval_type
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getAverageMembershipEnd({
        start_date,
        end_date,
        interval_type,
        brand,
    }) {
        if (this.membershipStatsCancelToken) {
            this.membershipStatsCancelToken.cancel();
        }

        this.membershipStatsCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/retention-stats/average-membership-end', {
                cancelToken: this.membershipStatsCancelToken.token,
                params: {
                    small_date_time: start_date,
                    big_date_time: end_date,
                    interval_type,
                    brand
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get membership end stats
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} interval_type
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getMembershipEndStats({
        start_date,
        end_date,
        interval_type,
        brand,
    }) {
        if (this.membershipStatsCancelToken) {
            this.membershipStatsCancelToken.cancel();
        }

        this.membershipStatsCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/retention-stats/membership-end-stats', {
                cancelToken: this.membershipStatsCancelToken.token,
                params: {
                    small_date_time: start_date,
                    big_date_time: end_date,
                    interval_type,
                    brand
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
