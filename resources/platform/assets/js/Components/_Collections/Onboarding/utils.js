import { brands } from './constants'

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
  brands.forEach((brand) => {
    multiSelectMap[brand] = getFormatPerBrand({ ...props, brand });
  });

  return multiSelectMap;
};

const getSavedExperience = (selectedExperience) => {
  const multiSelectMap = {};
  brands.forEach((brand) => {
    const experiencePerBrand = selectedExperience.find((experience) => experience.brand === brand);
    if(!!experiencePerBrand) {
      multiSelectMap[brand] = parseInt(experiencePerBrand.experience_level);
    }
  });

  return multiSelectMap;
};

const getSavedGoals = (goals) => {
  const multiSelectMap = {};
  brands.forEach((brand) => {
    const goalsPerBrand = goals.find((goal) => goal.brand === brand);
    if(!!goalsPerBrand) {
      multiSelectMap[brand] = goalsPerBrand.goals;
    }
  });

  return multiSelectMap;
};

export const getInitialInfo = ({ userId, userDisplayName, userProfilePictureUrl, selectedGear, selectedTopics, selectedGenres, selectedExperience, configOptions, instrument, selectedGoals }) => {
  return ({
    user: {
      id: userId,
      name: userDisplayName || null,
      userProfilePictureUrl: userProfilePictureUrl || null
    },
    instrument: instrument || 'default',
    instrumentTypes: getSavedMultiSelect({ options: selectedGear, plural: 'gears', singular: 'gear', configOptions }),
    experience: getSavedExperience(selectedExperience.length ? selectedExperience : [selectedExperience]),
    genres: getSavedMultiSelect({ options: selectedGenres, plural: 'genres', singular: 'genre', configOptions }),
    topics: getSavedMultiSelect({ options: selectedTopics, plural: 'topics', singular: 'topic', configOptions }),
    goals: getSavedMultiSelect({ options: selectedGoals, plural: 'goals', singular: 'goals', configOptions }),
  })
};

export const getCheckedSteps = ({ selectedGear, selectedTopics, selectedGenres, selectedExperience, selectedGoals, brand, steps }) => {
  const newSteps = steps.map((step, index) => {
    if (index > 1) {
      return {...step, checked: false };
    } else {
      return step;
    }
  });
  const hasGear = !!selectedGear.find(gear => gear.brand === brand);
  const hasExperience = () => {
    if (!selectedExperience) {
      return false;
    }
    if (selectedExperience.length) {
      return !!selectedExperience.find(exp => exp.brand === brand);
    } else {
      return selectedExperience.brand === brand;
    }
  };

  const hasGenres = !!selectedGenres.find(genre => genre.brand === brand);
  const hasTopics = !!selectedTopics.find(topic => topic.brand === brand);
  const hasGoals = !!selectedGoals.find(goal => goal.brand === brand);

  if (hasGear) {
    newSteps[0].checked = true;
    newSteps[1].checked = true;
    newSteps[2].checked = true;
  }
  if (hasExperience()) {
    newSteps[3].checked = true;
  }
  if (hasGenres) {
    newSteps[4].checked = true;
  }
  if (hasTopics) {
    newSteps[5].checked = true;
  }
  if (hasGoals) {
    const index = newSteps.findIndex(item => item.key === 'goals');
    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }
  return newSteps;
};
