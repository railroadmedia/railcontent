import axios from 'axios';

/**
 * Update Display Name
 *
 * @param {string} token
 * @param {string} userId
 * @param {object} payload
 */
export const updateUserProfile = (token, userId, payload) => {
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };
    return axios({
        method: 'PATCH',
        url: `/user-management-system/user/update/${userId}`,
        data: payload,
        headers
    });
};

/**
 * Update User Signature
 *
 * @param {string} token
 * @param {object} payload
 */
export const updateUserSignature = (token, userId, payload) => {
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };
    return axios({
        method: 'PATCH',
        url: `/forums/api/signature/update/${userId}`,
        data: payload,
        headers
    });
};

/**
 * Update Login Email
 *
 * @param {string} token
 * @param {string} userId
 * @param {object} payload
 */
export const updateLoginEmail = (token, payload) => {
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': token
    };
    return axios({
        method: 'POST',
        url: `/user-management-system/email-change/request`,
        data: payload,
        headers
    });
};

/**
 * Update Login Password
 *
 * @param {string} token
 * @param {string} userId
 * @param {object} payload
 */
export const updateLoginPassword = (token, payload) => {
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': token
    };
    return axios({
        method: 'PATCH',
        url: `/user-management-system/password/update`,
        data: payload,
        headers
    });
};

//FETCH IN PROGRESS SONGS
export async function fetchSongsInProgress(userId, brand, token) {
    const url = `/content/in_progress/${userId}?content_type=song&brand=${brand}`;

    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    try {
        const response = await fetch(url, { headers });
        const result = await response.json();
        if(result){
        console.log('fetchSongsInProgress', result);
        return result;
        } else {
        console.log('result not json')
        }
    } catch (error) {
        console.error('Fetch error:', error);
        return null;
    }
}
  
//SONG IS COMPLETED BY CURRENT USER
export async function fetchCurrentSongComplete(userId, content_id, token) {
    const url = `/content/user_progress/${userId}?content_ids[]=${content_id}`;

    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    try {
        const response = await fetch(url, { headers });
        const result = await response.json();
        if(result){
        return result[userId];
        }
    } catch (error) {
        console.error('Fetch error:', error);
        return null;
    }
}
  
//SONG IS COMPLETED BY CURRENT USER
export async function fetchAllCompletedStates(userId, contentIds, token) {
    const url = `/content/user_progress/${userId}?${contentIds.map(id => `content_ids[]=${id}`).join('&')}`;

    // console.log(url)

    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    try {
        const response = await fetch(url, { headers });
        const result = await response.json();
        if(result){
        return result;
        } else {
        console.log('result not json');
        }
    } catch (error) {
        console.error('Fetch error:', error);
        return null;
    }
}
  