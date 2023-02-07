//Playlists Services

export default {
    //------------CREATE-------------//

    /**
     * CREATE Playlist
     *
     * @param {string} brand
     * @param {number} page - 
     * @param {number} limit - 
     */
    getCurrentUserPlaylists(brand = "drumeo", page = 1, limit = 10) {
        let payload = {
            "brand": brand,
            "limit":limit,
            "page":page
        }
        let playlists = fetch('/railcontent/playlists', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
            // body: payload,
        })
        return playlists;
    },


    //-------------READ--------------//

    /**
     * GET Playlists
     *
     * @param {string} brand
     * @param {number} page - 
     * @param {number} limit - 
     */
    getCurrentUserPlaylists(brand = "drumeo", page = 1, limit = 10) {
        let payload = {
            "brand": brand,
            "limit":limit,
            "page":page
        }
        let playlists = fetch('/railcontent/playlists', {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
            },
            // body: payload,
        })
        return playlists;
    },


    //-------------UPDATE--------------//

    /**
     * Pin Playlists
     *
     * @param {string} brand
     * @param {number} id - 
     */
    pinPlaylist(id, brand = "drumeo", csrf_token) {
        let payload = {
            "brand": brand,
            "playlist_id":id,
        }
        let pinRequest = fetch('/railcontent/pin-playlist', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token
            },
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(payload),
        })
        return pinRequest;
    },

    /**
     * Unpin Playlists
     *
     * @param {string} brand
     * @param {number} id - 
     */
    unpinPlaylist(id, brand = "drumeo") {
        let payload = {
            "brand": brand,
            "playlist_id":id,
        }
        let unpinRequest = fetch('/railcontent/unpin-playlist', {
            method: 'PUT',
            headers: {'Content-Type': 'application/json',},
            body: JSON.stringify(payload),
        })
        return unpinRequest;
    },

    //-------------DELETE--------------//


};
