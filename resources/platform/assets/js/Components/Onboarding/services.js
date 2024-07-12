import axios from 'axios';

export const saveDisplayName = ({name, userId}) => {
    return axios.patch(`/user-management-system/user/update/${userId}`, {display_name: name});
};

export const checkDisplayName = ({name}) => {
    return axios.get(`/user-management-system/is-display-name-unique`, {params: {display_name: name}});
};

export const aboutStepCompleted = ({skipped}) => {
    return axios.post(`/musora-api/v1/onboarding/about-completed`, {skipped});
};

export const skipAccountSetup = ({brand, skippedStep}) => {
    return axios.post('/musora-api/v1/onboarding/skip-account-setup', {brand, skippedStep});
}

export const saveGear = ({data, brand}) => {
    return axios.post(`/musora-api/v1/onboarding/gears`, {data, brand});
};

export const saveExperience = ({level, brand}) => {
    return axios.post(`/musora-api/v1/onboarding/experience`, {experience_level: level, brand});
};

export const saveGenres = ({data, brand}) => {
    return axios.post(`/musora-api/v1/onboarding/genres`, {data, brand});
};

export const saveTopics = ({data, brand}) => {
    return axios.post(`/musora-api/v1/onboarding/topics`, {data, brand});
};

export const saveInstrumentHistoryData = ({instrument}) => {
    return axios.get(`/musora-api/v1/onboarding/answer-history-instrument?instrument=${instrument}`);
};

export const saveCoachHistoryData = ({coachName, coachId}) => {
    return axios.get(`/musora-api/v1/onboarding/answer-history-coach?coachName=${coachName}&coachId=${coachId}`);
}

export const saveGoals = ({goals, brand}) => {
    return axios.post(`/musora-api/v1/onboarding/goals`, {goals, brand});
};
