import axios from 'axios';
import ErrorHandler from './error-handler';

export default {

    /**
     * Get a list of all comments
     *
     * @static
     * @param {string} brand
     * @param {number} limit - the limit of comments per page
     * @param {number} page - the page to pull
     * @param {string} sort - the database column to order the results by
     * @returns {Promise} - resolved promise with the response object
     */
    getComments({
        brand = 'recordeo',
        limit = 20,
        page = 1,
        sort = 'created_on',
    }) {
        return axios.get('/railcontent/comment', {
            params: {
                brand,
                limit,
                page,
                sort,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Reply to a comment
     *
     * NOTE: CURRENTLY SOME OF THE APP DBs HAVE DIFFERENT USER IDs THAN MUSORA,
     * SO YOU WILL NEED TO PASS THEIR APP SPECIFIC ID NOT THEIR MUSORA ID (THIS WILL CHANGE LATER)
     *
     * @static
     * @param {number} id
     * @param {number} thread_id - The ID of the thread you are responding to
     * @param {number} content_id - The ID of the lesson content the thread is on
     * @param {string} comment
     * @param {string} brand
     * @returns {Promise} - resolved promise with the response object
     */
    replyToComment({
        user_id,
        thread_id,
        content_id,
        comment,
        brand,
    }) {
        const mappedUserId = this.getMappedUserId(user_id, brand);

        if (mappedUserId != null) {
            return axios.put(`/railcontent/comment/reply?override_user_id=${mappedUserId}`, {
                comment,
                parent_id: thread_id,
                content_id,
            })
                .then(response => response)
                .catch(ErrorHandler.push);
        }
        
        return Promise.resolve(
            'no_permission',
        );
    },

    /**
     * Edit a specific comment by ID
     *
     * @static
     * @param {number} id
     * @param {string} comment - the new comment
     * @returns {Promise} - resolved promise with the response object
     */
    editComment({
        id,
        comment,
    }) {
        return axios.patch(`/railcontent/comment/${id}`, {
            comment,
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Delete a specific comment by ID
     *
     * @static
     * @param {number} id
     * @returns {Promise} - resolved promise with the response object
     */
    deleteComment(id) {
        return axios.delete(`/railcontent/comment/${id}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a list of lessons based on an array of lesson IDs
     *
     * @static
     * @param {string} ids - a stringified array of ids (ex: 1232,13411,121,4543,12335)
     * @returns {Promise} - resolved promise with the response object
     */
    getLessonByIds(ids) {
        return axios.get(`/railcontent/content/get-by-ids?ids=${ids}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },

    /**
     * Get a mapped user ID with the intent of passing it through with a comment
     *
     * @static
     * @param {number} id
     * @param {string} brand - The brand to map the ID from
     * @returns {Promise} - resolved promise with the response object
     */
    getMappedUserId(id, brand) {
        /*
        * It might seem a bit weird that all of them are mapped to basically the same ID.
        * When we first decided to do this we found out we could just change Musora IDs to match
        * Their app specific ID, but in Jared and Nate's case they were both ID 7 on their
        * respective apps so it was better to just map everyones instead of just 2
        *
        * - Curtis, October 2018
        * */
        const userIdMap = {
            drumeo: {
                5814: '5814', // Aaron Edgar
                98085: '98085', // Adam Tuminaro
                136145: '136145', // Bruce Becker
                8: '8', // Dave Atkinson
                5: '5', // Janado
                7: '7', // Jared Falk,
                87011: '87011', // Justin MacAlpine
                70324: '70324', // Michael Schack
                63599: '63599', // Pat Petrillo
                102905: '102905', // Reuben Spyker
                40641: '40641', // Stephen Taylor
                128762: '7', // Curtis Conway
            },
            pianote: {
                136: '9', // Jordan Liebel
                149630: '10', // Lisa Witt
            },
            guitareo: {
                145: '7', // Nate Savage
            },
        };

        return userIdMap[brand] ? userIdMap[brand][id] : null;
    },
};
