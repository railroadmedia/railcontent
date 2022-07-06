export const getOnboardingOptions = ({ configOptions, property, brand }) => {
    return configOptions[brand][property].map(
        value => ({ text: value, value })
      )
};
