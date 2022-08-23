import axios from 'axios';

export const saveDisplayName = ({ name, userId }) => {
    return axios.patch(`/user-management-system/user/update/${userId}`, { display_name: name });
};

export const saveGear = ({ data, brand }) => {
    return axios.post(`/user-management-system/onboarding-gears`, { data, brand });
};

export const saveExperience = ({ level, brand }) => {
    return axios.post(`/user-management-system/onboarding-experience`, { experience_level: level, brand });
};

export const saveGenres = ({ data, brand }) => {
    return axios.post(`/user-management-system/onboarding-genres`, { data, brand });
};

export const saveTopics = ({ data, brand }) => {
    return axios.post(`/user-management-system/onboarding-topics`, { data, brand });
};

export const saveInstrumentHistoryData = ({instrument}) => {
    return axios.get(`/user-management-system/onboarding-answer-history-instrument?instrument=${instrument}`);
};

export const saveCoachHistoryData = ({coachName}) => {
    return axios.get(`/user-management-system/onboarding-answer-history-coach?coach=${coachName}`);
}
