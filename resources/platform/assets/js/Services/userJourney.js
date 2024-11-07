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
    },

    trackVideo({ payload, type }) {
        const { token } = useUserStore();
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        const types = {
            started: '/musora-api/v5/journeys/video-started',
            completed: '/musora-api/v5/journeys/video-completed',
            seekStarted: '/musora-api/v5/journeys/video-seek-started',
            seekCompleted: '/musora-api/v5/journeys/video-seek-completed',
            resumed: '/musora-api/v5/journeys/video-resumed',
            playing: '/musora-api/v5/journeys/video-playing',
            paused: '/musora-api/v5/journeys/video-paused',
        };

        return axios({
            method: 'POST',
            url: types[type],
            data: {
                ...payload,
                content_id: parseInt(payload.content_id, 10),
            },
            headers
        });
    },

    trackLikes({ is_liked, content_id }) {
        const { token, brand } = useUserStore();
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: is_liked ? '/musora-api/v5/journeys/content-liked' : '/musora-api/v5/journeys/content-unliked',
            data: {
                content_id,
                brand,
            },
            headers
        });
    },

    trackRecommendedContentServed(payload) {
        const { token } = useUserStore();
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/musora-api/v5/journeys/recommended-content-served',
            data: payload,
            headers
        });
    }
};
