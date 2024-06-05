import axios from 'axios';

/**
 * Update Display Name
 *
 * @param {string} token
 * @param {string} userId
 * @param {object} payload
 */
export const updateUserName = (token, userId, payload) => {
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