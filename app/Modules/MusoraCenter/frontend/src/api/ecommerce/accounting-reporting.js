import axios from 'axios';
import ErrorHandler from '../error-handler';

export default {
    getAccountingReportingCancelToken: null,

    /**
     * Get accounting reporting data per product and totals
     *
     * @param {String} start_date
     * @param {String} end_date
     * @param {String} brand
     * @returns {Promise} - resolved promise with the response object
     */
    getAccountingReporting({
        start_date,
        end_date,
        brand,
    }) {
        if (this.getAccountingReportingCancelToken) {
            this.getAccountingReportingCancelToken.cancel();
        }

        this.getAccountingReportingCancelToken = axios.CancelToken.source();

        return axios
            .get('/ecommerce/product-totals', {
                cancelToken: this.getAccountingReportingCancelToken.token,
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

