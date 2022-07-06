export const initialSteps = [
    { label: 'ABOUT', checked: false },
    { label: 'INSTRUMENT', checked: false },
    { label: 'GEAR', checked: false },
    { label: 'EXPERIENCE', checked: false },
    { label: 'GENRES', checked: false },
    { label: 'TOPICS', checked: false },
    { label: 'COACHES', checked: false }
];

export const instrumentBrand = {
    piano: 'pianote',
    drums: 'drumeo',
    guitar: 'guitareo',
    singing: 'singeo',
    default: 'drumeo'
};

export const getInitialInfo = ({ userId, userName, userAvatar }) => ({
    user: {
        id: userId,
        name: userName || null,
        avatarUrl: userAvatar || null
    },
    instrument: 'default',
    instrumentTypes: {}
});