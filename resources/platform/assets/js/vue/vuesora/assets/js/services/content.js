import axios from 'axios';
import ErrorHandler from './_error-handler';

let endpointPrefix;

if(typeof window != 'undefined'){
    endpointPrefix = window.ENDPOINT_PREFIX || '';
}

export default {

    /**
     * Search for a list of Content
     *
     * @returns {Promise} - resolved promise with the response object
     */
    search({
        brand = 'drumeo',
        limit = '20',
        statuses = ['published', 'scheduled', 'draft'],
        term,
        included_types,
        included_fields,
        required_fields,
        required_parent_ids,
        required_user_states,
        page = '1',
        include_future = 1,
    }) {
        return axios
            .get(`${endpointPrefix}/railcontent/search`, {
                params: {
                    brand,
                    limit,
                    statuses,
                    term,
                    included_types,
                    included_fields,
                    required_fields,
                    required_parent_ids,
                    required_user_states,
                    page,
                    include_future,
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of Content
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getContent({
        brand = 'drumeo',
        limit = '20',
        statuses = ['published', 'scheduled', 'draft'],
        sort = '-published_on',
        term,
        included_types,
        included_fields,
        required_fields,
        required_parent_ids,
        required_user_states,
        page = '1',
        include_future = 1,
        only_from_my_list = false
    }) {
        return axios
            .get(`${endpointPrefix}/railcontent/content`, {
                params: {
                    brand,
                    limit,
                    statuses,
                    sort,
                    term,
                    included_types,
                    included_fields,
                    required_fields,
                    required_parent_ids,
                    required_user_states,
                    page,
                    include_future,
                    only_from_my_list
                },
            })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get railcontent content by ID
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getContentById(id) {
        return axios.get(`${endpointPrefix}/railcontent/content/${id}`)
            .then(response => response)
            .catch(ErrorHandler);
    },


    /**
     * Get railcontent content by an Array of IDs
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getContentByIds(ids) {
        return axios.get(`${endpointPrefix}/railcontent/content/get-by-ids`, {
            params: {
                ids,
            },
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Get an array of like users for a content id
     *
     * @returns {Promise} - resolved promise with the response object
     */
    getContentLikeUsers({ id, page = 1 }) {
        return axios.get(`${endpointPrefix}/railcontent/content-like/${id}`, {
            params: {
                page,
                limit: 10,
            },
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Like content by ID
     *
     * @param {Boolean} is_liked
     * @param {String|Number} content_id
     * @param {String|Number} user_id
     * @returns {Promise} - resolved promise with the response object
     */
    likeContentById({ is_liked, content_id, user_id }) {
        return axios({
            url: `${endpointPrefix}/railcontent/content-like`,
            method: is_liked ? 'put' : 'delete',
            data: {
                content_id,
                user_id,
            },
        });
    },

    /**
     * Follow to coach
     *
     * @param {String|Number} coachId
     */
     followCoach({ coachId }) {

        return axios({
            url: `${endpointPrefix}/railcontent/follow`,
            method: 'put',
            data: {
                content_id: coachId,
            },
        });
    },

    /**
     * Unfollow to coach
     *
     * @param {String|Number} coachId
     */
    unfollowCoach({ coachId }) {

        return axios({
            url: `${endpointPrefix}/railcontent/unfollow`,
            method: 'put',
            data: {
                content_id: coachId,
            },
        });
    },

    /**
     * Flag a piece of content as "complete"
     *
     * @param {String|Number} contentId - the content ID
     * @returns {Promise} resolved promise with the response.data object
     */
    markContentAsComplete(contentId) {
        return axios.put(`${endpointPrefix}/railcontent/complete`, {
            content_id: contentId,
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Flag a piece of content as "started"
     *
     * @param {String|Number} contentId - the content ID
     * @returns {Promise} resolved promise with the response.data object
     */
    markContentAsStarted(contentId) {
        return axios.put(`${endpointPrefix}/railcontent/start`, {
            content_id: contentId,
        })
            .then(response => response.data)
            .catch((error) => {
                console.error(error);
            });
    },

    /**
     * Reset your progress for a piece of content
     *
     * @param {String|Number} contentId - the content ID
     * @returns {Promise} resolved promise with the response.data object
     */
    resetContentProgress(contentId) {
        return axios.put(`${endpointPrefix}/railcontent/reset`, {
            content_id: contentId,
        })
            .then(response => response.data)
            .catch(ErrorHandler);
    },

    /**
     * Add or Remove content from your list
     *
     * @param content_id {String|Number}
     * @param is_added {boolean}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    addOrRemoveContentFromList(content_id, is_added, brand) {
        const delete_endpoint = `${endpointPrefix}/railcontent/remove-from-primary-playlist`;
        const put_endpoint = `${endpointPrefix}/railcontent/add-to-primary-playlist`;

        return axios.post(is_added ? delete_endpoint : put_endpoint, {
            content_id,
            type: is_added ? 'remove-from-list' : 'my-list-addition',
            brand: brand
        })
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Mark a learning path as started (this changes the users current active learning path for
     * progress tracking)
     *
     * @param content_id {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    markLearningPathAsStarted(content_id) {
        return axios.post(`${endpointPrefix}/members/start-learning-path/${content_id}`)
            .then(response => response)
            .catch(ErrorHandler);
    },

    /**
     * Get a vimeo video url by vimeo video ID
     *
     * @param vimeoId {String|Number}
     *
     * @returns {Promise} resolved promise with the response.data object
     */
    getVimeoUrlByVimeoId(vimeoId) {
        return axios.get(`${endpointPrefix}/railcontent/vimeo-video/${vimeoId}`)
            .then(response => response)
            .catch(ErrorHandler);
    },
};
