import axios from 'axios';

export const setEndpointPrefix = () => {
    const { origin } = window.location;
    if (origin.includes('dev')) {
        window.ENDPOINT_PREFIX = 'https://devplatform.musora.com:8443'
    } else {
        window.ENDPOINT_PREFIX = 'https://musora.com'
    }
};

export const searchCoaches = (brand, term) => {
    return axios.get(`${window.ENDPOINT_PREFIX}/railcontent/content?brand=${brand}&limit=18&statuses[]=published&sort=-published_on&required_fields[]=is_coach,1&page=1${term ? '&term='+term : ''}`);
}

const getResultValue = (el, searchKey, searchObj) => {
    return el[searchObj] ? el[searchObj].find(({ key }) => key === searchKey).value : '';
};


export const transformCoachesCardData = (result) => {
    return result.data.data.map((coach) => {
        const img = getResultValue(coach, 'coach_card_image', 'data');
        const focusText = getResultValue(coach, 'focus_text', 'data');
        const name = getResultValue(coach, 'name', 'fields');
        return {
            img,
            focusText,
            id: coach.id,
            url: coach.url,
            name
        }
    })
};