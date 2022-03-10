const defaultTheme = require('tailwindcss/defaultTheme')
const stylesoraTheme = require("stylesora/theme");
const colors = require("tailwindcss/colors");

/** @type {import("@types/tailwindcss/tailwind-config").TailwindConfig } */
module.exports = {
  prefix: "tw-",
  darkMode: "class",
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    colors: {
      ...colors,
      ...stylesoraTheme.colors,
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
    //Stylesora's Base Styles
    require("stylesora/base")(),
    //Stylesora's Attributes
    require("stylesora/attributes")(),
    //Stylesora's Utility Classes
    require("stylesora/utilities/")(),
    //Stylesora's Component Styles
    require("stylesora/components/")(),
  ],
}
