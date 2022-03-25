// tailwind.config.js
const stylesoraTheme = require('stylesora/theme');
const plugin = require('tailwindcss/plugin');
const colors = require("tailwindcss/colors");

module.exports = {
  mode: 'jit',
  prefix: "tw-",
  darkMode: "class",
  content: [
    './resources/platform/**/*.blade.php',
    './resources/platform/**/*.vue',
    './resources/platform/**/*.js',
  ],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    colors: {
      ...colors,
      ...stylesoraTheme.colors,
    },
    extend: {
      fontFamily: stylesoraTheme.fontFamily,
      fontSize: stylesoraTheme.fontSize, 
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
    //New Utilities
    plugin(function({ addUtilities }) {
      addUtilities({
        '.text-musora': {
          background: 'linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30)',
          '-webkit-background-clip': 'text',
          '-webkit-text-fill-color': 'transparent',
        },
        '.bg-musora': {
          background: 'linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30)',
        },
        '.fade-enter-active, .fade-leave-active': {
          transition: 'opacity 150ms ease'
        },
        '.fade-enter-from,.fade-leave-to': {
          opacity: 0
        },
        '[v-cloak]': {
          display: 'none',
        },
        '.no-scrollbar::-webkit-scrollbar': {
          display: 'none'
        },
        '.no-scrollbar': {
          '-ms-overflow-style': 'none',  
          'scrollbar-width': 'none'
        } 
      })
    })
  ],
}