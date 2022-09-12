import axios from 'axios';

export const setEndpointPrefix = () => {
    const { origin } = window.location;
    if (origin.includes('dev')) {
        window.ENDPOINT_PREFIX = `https://${location.hostname}:${location.port}`
    } else {
        window.ENDPOINT_PREFIX = 'https://' + location.hostname
    }
};

export const searchCoaches = (brand, term) => {
    const coachesUrl = `${window.ENDPOINT_PREFIX}/railcontent/content?brand=${brand}&limit=18&statuses[]=published&sort=-published_on&required_fields[]=is_coach,1&page=1${term ? '&term='+term : ''}`
    return axios.get(coachesUrl);
}

const getResultValue = (el, searchKey, searchObj) => {
    return el[searchObj] ? el[searchObj].find(({ key }) => key === searchKey).value : '';
};


export const transformCoachesCardData = (result) => {
    return result.data.data.map((coach) => {
        // console.log(coach)
        const img = getResultValue(coach, 'coach_card_image', 'data');
        const focusText = getResultValue(coach, 'focus_text', 'data');
        const name = getResultValue(coach, 'name', 'fields');
        const isFollowed = coach.current_user_is_subscribed;

        return {
            img,
            focusText,
            id: coach.id,
            url: coach.url,
            name,
            isFollowed
        }
    })
};