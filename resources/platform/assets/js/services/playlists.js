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

    //-------------DELETE--------------//


};
