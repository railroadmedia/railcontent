import axios from 'axios';
import ErrorHandler from './_error-handler';

let endpointPrefix;

if(typeof window != 'undefined'){
    endpointPrefix = window.ENDPOINT_PREFIX || '';
}

export default {

    /**
     * Get the forum search results
     *
     * @param {string} searchJsonResultsEndpointUrl
     * @param {string} term - the search terms
     * @param {string} type - the search type, 'posts' or 'threads' - default null
     * @param {number} page - the results page - default 1
     * @param {number} limit - the results page amount - 10
     * @param {string} sort - the column to sort - default 'score'
     * @returns {Promise} - resolved promise with the response.data object
     */
    getForumSearchResults(searchJsonResultsEndpointUrl, term, type, page, limit, sort) {
        const params = {
            term,
            page: page || 1,
            limit: limit || 8,
            sort: sort || 'score',
        };
        if (type) {
            params.type = type;
        }

        return axios.get(searchJsonResultsEndpointUrl, {
            params,
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Get the data for a list of forum threads
     *
     * @static
     * @returns {Promise} - resolved promise with the response.data object
     */
    getForumThreads() {
        return axios.get(`${endpointPrefix}/members/forums/threads-json`)
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Get the posts data for a specific forum thread
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    getForumThreadPosts() {
        return axios.get(`${endpointPrefix}/members/forums/post-json`)
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    getForumPostById(id) {
        return axios.get(`/forums/post/show/${id}`)
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    getPostLikeUsers({ id, page = 1, limit = 10 }) {
        return axios.get(`${endpointPrefix}/forums/post-likes/${id}`, {
            params: {
                page,
                limit,
            },
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Report a forum post
     *
     * @param {number} id - the post ID to report
     * @param {string} brand - brand of the forum
     * @returns {Promise} resolved promise with the response.data object
     */
    reportForumPost(id, brand) {
        return axios.put(`${endpointPrefix}/forums/post/report/${id}`, {brand})
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Like a forum thread
     *
     * @param {number} id - the comment ID to like
     * @param {string} brand - brand of the forum
     * @returns {Promise} resolved promise with the response.data object
     */
    likeForumPost(id, brand) {
        return axios.put(`${endpointPrefix}/forums/post/like/${id}`, {brand})
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Unlike a forum thread
     *
     * @param {number} id - the comment ID to unlike
     * @param {string} brand - brand of the forum
     * @returns {Promise} resolved promise with the response.data object
     */
    unlikeForumPost(id, brand) {
        return axios.delete(`${endpointPrefix}/forums/post/unlike/${id}`, { data : {brand} } )
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Follow a forum thread
     *
     * @param {number} id - thread id
     * @param {string} brand - brand of the forum
     * @param {boolean} isFollowed
     * @returns {Promise} resolved promise with the response.data object
     */
    followForumsThread(id, brand, isFollowed = false) {
        const url = isFollowed ? '/forums/thread/unfollow/' : '/forums/thread/follow/';
        const method = isFollowed ? 'DELETE' : 'PUT';

        return axios({
            method,
            url: endpointPrefix + url + id,
            data: {brand},
            config: {data: {brand}}
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Pin a forum thread
     *
     * @param {number} id - thread id
     * @param {string} brand - brand of the forum
     * @param {boolean} pinned
     * @returns {Promise} resolved promise with the response.data object
     */
    pinForumsThread(id, brand, pinned) {
        return axios.patch(`${endpointPrefix}/forums/thread/update/${id}`, {
            brand, pinned,
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Lock a forum thread
     *
     * @param {number} id - thread id
     * @param {string} brand - brand of the forum
     * @param {boolean} locked
     * @returns {Promise} resolved promise with the response.data object
     */
    lockForumsThread(id, brand, locked) {
        return axios.patch(`${endpointPrefix}/forums/thread/update/${id}`, {
            brand, locked,
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Delete a Forum thread
     *
     * @param {number} id - thread id
     * @param {string} brand - brand of the forum
     * @returns {Promise} resolved promise with the response object
     */
    deleteForumsPost(id, brand) {
        return axios.delete(`${endpointPrefix}/forums/post/delete/${id}`, {data : {brand}})
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Display an error message and console the error if any request fails
     *
     * @param {object} error - the error object returned by the request
     */
    handleError(error) {
        console.error(error);
        Toasts.push({
            icon: 'doh',
            title: 'This is Embarrassing! That didn\'t work',
            message: 'Refresh the page to try once more, if it happens again please let us know using the chat below.',
        });
    },
};
