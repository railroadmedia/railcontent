module.exports = {
    moduleFileExtensions: [
      "js",
      "vue"
    ],
    // Adjust the transform property to use vue-jest for .vue files and babel-jest for .js files
    transform: {
      ".*\\.(vue)$": "@vue/vue3-jest",
      ".*\\.(js)$": "babel-jest"
    },
    // Update the testMatch pattern to look for .test.js files within your specific directory structure
    testMatch: [
      "<rootDir>/resources/platform/assets/js/vue/components/**/*.test.js"
    ],
    // If you're using aliases in your Vue project, like '@' for the 'src' folder, you might need to map them here
    moduleNameMapper: {
      "^@/(.*)$": "<rootDir>/resources/platform/assets/js/vue/components/$1"
    },
    // Setup to handle static assets like images or stylesheets
    transformIgnorePatterns: [
      "node_modules/(?!vue-awesome)"
    ],
    // Setup for Vue 3 compatibility
    testEnvironment: "jsdom",

    testEnvironmentOptions: {
        customExportConditions: ["node", "node-addons"],
      },
  };
  