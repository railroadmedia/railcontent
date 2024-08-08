import axios from 'axios';

export default {
    followCoach(coachId, isSubscribed, firstName) {
        return axios({
            url: `/railcontent/follow`,
            method: 'put',
            data: {
                content_id: coachId,
            },
        })
        .then(()=>{
            window.shownotification({
                icon: 'fa-bell',
                text: `You will now receive updates when ${firstName} releases new content!`
            });
        })
        .catch((e) => {
            isSubscribed.value = false;
            window.shownotification({
                isError: true
            })
        })
    },

    unfollowCoach(coachId, isSubscribed, firstName) {
        return axios({
            url: `/railcontent/unfollow`,
            method: 'put',
            data: {
                content_id: coachId,
            },
        })
        .then(()=>{
            window.shownotification({
                icon: 'fa-bell-slash',
                text: `You will no longer receive updates when ${firstName} releases new content!`
            });
        })
        .catch((e) => {
            isSubscribed.value = true;
            window.shownotification({
                isError: true
            })
        })
    },
}
