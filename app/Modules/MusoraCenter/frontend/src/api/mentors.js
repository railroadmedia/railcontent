import axios from 'axios/index';
import ErrorHandler from './error-handler';
const musoraWebAppURL = document.getElementById('musoraWebAppURL').value;

export default {
    getMentorIdByStudent(userId) {
        return axios.get(musoraWebAppURL + `/mentors/getMentorIdByStudent/${userId}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
    getMentors() {
        return axios.get(musoraWebAppURL + '/mentors/getMentors')
            .then(response => response)
            .catch(ErrorHandler.push);
    },
    updateStudentMentor(userId, mentorUserId) {
        return axios.get(musoraWebAppURL + `/mentors/updateStudentMentor`, {
            params: {
                userId,
                mentorUserId,
            },
        })
            .then(response => ({ response }))
            .catch(error => ({ error: { ...error.response.data } }));
    },
    getMentorsPaged(page, searchTerm) {
        return axios.get(musoraWebAppURL + `/mentors/getMentors/${page}`, {
            params: {
                searchTerm,
            },
        })
            .then(response => response)
            .catch(ErrorHandler.push);
    },
    getMentorInfo(userId) {
        return axios.get(musoraWebAppURL + `/mentors/getMentor/${userId}`)
            .then(response => response)
            .catch(ErrorHandler.push);
    },
    updateMentor(userId, supportedBrands, activeStudentMaxCount) {
        return axios.get(musoraWebAppURL + `/mentors/updateMentor`, {
            params: {
                userId,
                supportedBrands,
                activeStudentMaxCount,
            },
        })
            .then(response => ({ response }))
            .catch(error => ({ error: { ...error.response.data } }));
    },
    demoteMentor(userId) {
        return axios.get(musoraWebAppURL + `/mentors/demoteMentor/${userId}`)
            .then(response => ({ response }))
            .catch(error => ({ error: { ...error.response.data } }));
    },
};
