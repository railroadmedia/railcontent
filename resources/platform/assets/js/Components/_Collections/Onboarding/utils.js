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
    if (!!experiencePerBrand) {
      multiSelectMap[brand] = parseInt(experiencePerBrand.experience_level);
    }
  });

  return multiSelectMap;
};

const getLastCheckedStep = (steps) => {
  let lastIndex = -1; // Start with -1, which indicates no checked steps were found if it remains -1
  for (let i = 0; i < steps.length; i++) {
    if (steps[i].checked) {
      lastIndex = i; // Update lastIndex each time a checked step is found
    }
  }
  return lastIndex; // Return the last index where checked is true
}

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
      return { ...step, checked: false };
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
    const index = newSteps.findIndex(item => item.key === 'instrumentType');
    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }
  if (hasExperience()) {
    const index = newSteps.findIndex(item => item.key === 'experience');
    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }
  if (hasGenres) {
    const index = newSteps.findIndex(item => item.key === 'genre');

    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }
  if (hasTopics) {
    const index = newSteps.findIndex(item => item.key === 'topics');
    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }
  if (hasGoals) {
    const index = newSteps.findIndex(item => item.key === 'goals');
    if (index !== -1) {
      newSteps[index].checked = true;
    }
  }

  const lastCheckedStep = getLastCheckedStep(newSteps);

  if (lastCheckedStep !== -1) {
    newSteps.forEach((step, index) => {
      if (index < lastCheckedStep) {
        step.checked = true;
      }
    });
  }

  return newSteps;
};