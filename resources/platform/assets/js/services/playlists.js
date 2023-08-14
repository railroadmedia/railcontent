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

    /**
     * Duplicate Playlist
     *
     * @param {string} token
     * @param {object} payload -
     */
    duplicatePlaylist(payload, token) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'PUT',
            url: '/railcontent/copy-playlist',
            data: payload,
            headers
        });
    },

    /**
     * Like Playlist
     *
     * @param {string} token
     * @param {object} payload -
     */
        likePlaylist(payload, token) {
            const headers = {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            };
            return axios({
                method: 'PUT',
                url: '/railcontent/like-playlist',
                data: payload,
                headers
            });
        },

    /**
     * Unlike Playlist
     *
     * @param {string} token
     * @param {object} payload -
     */
        unlikePlaylist(playlist_id, token) {
            const headers = {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            };
            return axios({
                method: 'DELETE',
                url: '/railcontent/like-playlist',
                data: { playlist_id },
                headers
            });
        },

    //-------------READ--------------//

    /**
     * GET Playlists
     *
     * @param {object} payload
     * @param {string} token
     */
    getPlaylist(payload, token) {
        const playlistParams = {
            "playlist_id": 1,
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: '/railcontent/playlist',
            params: payload ? payload : playlistParams,
            headers
        });
    },

    /**
     * GET Playlists
     *
     * @param {object} payload
     * @param {string} token
     */
    getCurrentUserPlaylists(payload, token) {
        const playlistParams = {
            "limit": null,
            "page": 1
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: '/railcontent/playlists',
            params: payload ? payload : playlistParams,
            headers
        });
    },

    /**
     * GET Playlists Lessons
     *
     * @param {object} payload
     * @param {string} token
     */
    getPlaylistLessons(payload, token) {
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'GET',
            url: '/railcontent/playlist-lessons',
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
        console.log('pinPlaylist')
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

    /**
     * Update Playlist Details
     *
     * @param {number} id
     * @param {object} payload
     * @param {string} csrf_token
     *
     */
    updatePlaylist(id, payload, csrf_token) {
        return axios.patch(
            `/railcontent/playlist/${id}`,
            payload,
            {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                }
            }
        )
    },

    /**
     * Update Playlist ITEM
     *
     * @param {object} payload
     * @param {string} csrf_token
     *
     */
    updatePlaylistItem(payload, csrf_token) {
        return axios.put(
            `/railcontent/change-playlist-content`,
            payload,
            {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                }
            }
        )
    },

    /**
     * PUT Get Soundslice Assignments for content
     *
     * @param {string} brand
     * @param {number} contentId -
     * @param {string} token
     */
    addToPlaylist({ brand = "drumeo", token, contentId, playlistIds, importAssignments, addFull, addInstrumentless, addLowRoutine, addHighRoutine }) {
        const payload = {
            brand: brand,
            playlist_id: playlistIds,
            content_id: contentId,
            import_all_assignments: importAssignments,
            import_full_soundslice_assignment: addFull,
            import_instrumentless_soundslice_assignment: addInstrumentless,
            import_low_routine:addLowRoutine,
            import_high_routine:addHighRoutine
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

    //-------------DELETE--------------//

    /**
     * DELETE Playlist
     *
     * @param {string} id
     * @param {string} token
     */
    deletePlaylist(id, token) {
        const payload = {
            "playlist_id": id
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'DELETE',
            url: '/railcontent/playlist',
            data: payload,
            headers
        });
    },


    /**
     * DELETE Lesson
     *
     * @param {string} id
     * @param {string} token
     */
    deletePlaylistItem(id, token) {
        const payload = {
            "user_playlist_item_id": id
        }
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        };
        return axios({
            method: 'DELETE',
            url: '/railcontent/remove-item-from-list',
            data: payload,
            headers
        });
    },

};
