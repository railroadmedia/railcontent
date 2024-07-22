// Journeys Services

// Add to existing imports
import axios from 'axios';
import { useUserStore } from "../Stores/user";

export default {
    //-------------JOURNEYS--------------//

    /**
     * Track Filter Group
     *
     * @param {string} token
     * @param {object} payload
     */
    trackFilterGroup({ token, payload }) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/filter-group-applied',
            data: payload,
            headers
        });
    },

    /**
     * Track Sort
     *
     * @param {string} token
     * @param {object} payload
     */
    trackSort({ token, payload }) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/sorting-applied',
            data: payload,
            headers
        });
    },

    /**
     * Track Filter
     *
     * @param {string} token
     * @param {object} payload
     */
    trackFilter({ token, payload }) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/filter-applied',
            data: payload,
            headers
        });
    },

    trackHomeContentClick({ payload }) {
        const { token } = useUserStore();
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/homepage-content-clicked',
            data: payload,
            headers
        });
    },

    trackHomeSeeAll({ payload }) {
        const { token } = useUserStore();
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/homepage-section-see-all-clicked',
            data: payload,
            headers
        });
    }
};
