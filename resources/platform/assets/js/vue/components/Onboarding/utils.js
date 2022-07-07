import { instrumentBrand } from './constants'

export const getMultiSelectOptions = ({ configOptions, property, brand }) => {
    return configOptions[brand][property].map(
        value => ({ text: value, value })
      )
};

const getFormatPerBrand = ({ brand, options, plural, singular, configOptions }) => {
  const formattedOptions = {};

  configOptions[brand][plural].forEach((configOption) => {
    const isChecked = options.findIndex((savedOption) => savedOption.brand === brand && savedOption[singular] === configOption) !== -1;
    formattedOptions[configOption] = isChecked;
  });

  return formattedOptions;
};

export const getSavedMultiSelect = (props) => {
  const multiSelectMap = {};
  Object.values(instrumentBrand).forEach((brand) => {
    multiSelectMap[brand] = getFormatPerBrand({ ...props, brand });
  });

  return multiSelectMap;
};

const getSavedExperience = (selectedExperience) => {
  const multiSelectMap = {};
  Object.values(instrumentBrand).forEach((brand) => {
    const experiencePerBrand = selectedExperience.find((experience) => experience.brand === brand);
    if(!!experiencePerBrand) {
      multiSelectMap[brand] = parseInt(experiencePerBrand.experience_level);
    }
  });

  return multiSelectMap;
};

export const getInitialInfo = ({ userId, userName, userAvatar, selectedGear, selectedTopics, selectedGenres, selectedExperience, configOptions }) => {
  return ({
      user: {
          id: userId,
          name: userName || null,
          avatarUrl: userAvatar || null
      },
      instrument: 'default',
      instrumentTypes: getSavedMultiSelect({ options: selectedGear, plural: 'gears', singular: 'gear', configOptions }),
      experience: getSavedExperience(selectedExperience),
      genres: getSavedMultiSelect({ options: selectedGenres, plural: 'genres', singular: 'genre', configOptions }),
      topics: getSavedMultiSelect({ options: selectedTopics, plural: 'topics', singular: 'topic', configOptions }),
  })
};
