import axios from 'axios';

export const saveDisplayName = ({ name, userId }) => {
    return axios.patch(`/user-management-system/user/update/${userId}`, { display_name: name });
};

export const saveGear = ({ data, brand }) => {
    return axios.post(`/user-management-system/onboarding-gears`, { data, brand });
};