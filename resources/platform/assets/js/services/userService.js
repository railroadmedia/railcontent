import axios from 'axios';

export const updateUserName = (userId, displayName) => {
    return axios.post(`/user-management-system/user/update/${userId}`, {
        display_name: displayName
    });
};