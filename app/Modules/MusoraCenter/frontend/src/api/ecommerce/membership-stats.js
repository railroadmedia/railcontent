import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {
    getMembershipStatsCancelToken: null,

    /**
     * Get membership stats
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} interval_type
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getMembershipStats({
        start_date,
        end_date,
        interval_type,
        brand,
    }) {
        if (this.getMembershipStatsCancelToken) {
            this.getMembershipStatsCancelToken.cancel();
        }

        this.getMembershipStatsCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/membership-stats', {
                cancelToken: this.getMembershipStatsCancelToken.token,
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
