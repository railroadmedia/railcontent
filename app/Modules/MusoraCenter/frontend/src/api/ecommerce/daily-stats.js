import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {
    getDailyStatsCancelToken: null,

    /**
     * Get a list for all users
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getDailyStats({
        start_date,
        end_date,
        brand,
    }) {
        if (this.getDailyStatsCancelToken) {
            this.getDailyStatsCancelToken.cancel();
        }

        this.getDailyStatsCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/daily-statistics', {
                cancelToken: this.getDailyStatsCancelToken.token,
                params: {
                    small_date_time: start_date,
                    big_date_time: end_date,
                    brand,
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
};
