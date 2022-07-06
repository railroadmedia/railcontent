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

export const formatSavedMultiSelect = ({ options, brand, property, configOptions }) => {
    const formattedOptions = {};

    options.forEach((option) => {
        if (option.brand === brand) {
            formattedOptions[property] = true;
        }
    });

    return formattedOptions;
};

export const getInitialInfo = ({ userId, userName, userAvatar, props }) => {
    const { selectedGear, selectedTopics, selectedGenres, selectedExperience, configOptions } = props;

    return ({
        user: {
            id: userId,
            name: userName || null,
            avatarUrl: userAvatar || null
        },
        instrument: 'default',
        instrumentTypes: {},
    })
};