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
export const updateLoginEmail = (token, userId, payload) => {
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
