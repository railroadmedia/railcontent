import axios from 'axios';

//Playlists Services

export default {
    //------------CREATE-------------//

    /**
     * CREATE Playlist
     *
     * @param {string} token
     * @param {object} payload -
     */

    createUserPlaylist({ token, payload }) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'POST',
            url: '/railcontent/playlist',
            data: payload,
            headers
        });
    },


    //-------------READ--------------//

    /**
     * GET Playlists
     *
     * @param {string} brand
     * @param {number} page -
     * @param {number} limit -
     * @param {string} token
     */
    getCurrentUserPlaylists({ brand = "drumeo", page = 1, limit = 10, token }) {
        const payload = {
            "brand": brand,
            "limit":limit,
            "page":page
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: '/railcontent/playlists',
            params: payload,
            headers
        });
    },

    /**
     * GET Pinned Playlists
     *
     * @param {string} brand
     * @param {string} token
     */
    getPinnedPlaylists(brand, token) {
        const payload = {
            "brand": brand,
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: '/railcontent/my-pinned-playlists',
            params: payload,
            headers
        })
    },

    //-------------UPDATE--------------//

    /**
     * Pin Playlists
     *
     * @param {number} id -
     * @param {string} brand
     * @param {string} csrf_token
     *
     */
    pinPlaylist(id, brand = "drumeo", csrf_token) {
        return axios.put(
            '/railcontent/pin-playlist',
            {
                "brand": brand,
                "playlist_id":id,
            },
            {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                }
            }
        )
    },

    /**
     * Unpin Playlists
     *
     * @param {number} id -
     * @param {string} brand
     * @param {string} csrf_token
     *
     */
    unpinPlaylist(id, brand = "drumeo", csrf_token) {
        return axios.put(
            '/railcontent/unpin-playlist',
            {
                "brand": brand,
                "playlist_id":id,
            },
            {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                }
            }
        )
    },

    /**
     * Set Playlist to Private/Public
     *
     * @param {number} id 
     * @param {boolean} isPrivate
     * @param {string} csrf_token
     *
     */
    setToPrivate(id, isPrivate, csrf_token) {
        console.log('set to private ', isPrivate)
        return axios.patch(
            `/railcontent/playlist/${id}`,
            {
                "private": isPrivate ? 0 : 1,
            },
            {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                }
            }
        )
    },

    //-------------DELETE--------------//


    /**
     * GET Get Soundslice Assignments for content
     *
     * @param {string} brand
     * @param {number} contentId -
     * @param {string} token
     */
    getAssignmentsForContent({ brand = "drumeo", token, contentId }) {
        const payload = {
            "brand": brand,
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: `/railcontent/lessons-and-assignments-count/${contentId}`,
            params: payload,
            headers
        });
    },

    /**
     * PUT Get Soundslice Assignments for content
     *
     * @param {string} brand
     * @param {number} contentId -
     * @param {string} token
     */
    addToPlaylist({ brand = "drumeo", token, contentId, playlistIds, importAssignments }) {
        const payload = {
            brand: brand,
            playlist_id: playlistIds,
            content_id: contentId,
            import_all_assignments: importAssignments,
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'PUT',
            url: `/railcontent/add-item-to-list`,
            data: payload,
            headers
        });
    },

};
