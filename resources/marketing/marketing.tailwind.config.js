// tailwind.config.js
const stylesoraTheme = require('stylesora/theme');
const plugin = require('tailwindcss/plugin')
const colors = require("tailwindcss/colors");

module.exports = {
  important: true,
  mode: 'jit',
  darkMode: "class",
  content: require('fast-glob').sync([
    './resources/marketing/**/*.{blade.php,js}',
  ]),
  theme: {
    extend: {
      fontFamily: stylesoraTheme.fontFamily,
      fontSize: stylesoraTheme.fontSize,
      colors: {
        drumeo: stylesoraTheme.colors.drumeo,
        pianote: stylesoraTheme.colors.pianote,
        guitareo: stylesoraTheme.colors.guitareo,
        singeo: stylesoraTheme.colors.singeo,
      },
      spacing: stylesoraTheme.spacing,
      zIndex: stylesoraTheme.zIndex,
      inset: stylesoraTheme.inset
    },
  },
  plugins: [
    //Stylesora's Attributes
    require("stylesora/attributes")(),
    //Stylesora's Utility Classes
    require("stylesora/utilities/")(),
    //Stylesora's Component Styles
    require("stylesora/components/")(),
    //New Utilities
    plugin(function({ addUtilities }) {
      addUtilities({
        '[x-cloak]': {
          display: 'none', //For Alpine JS
        },
        '.text-musora': {
          background: 'linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30)',
          '-webkit-background-clip': 'text',
          '-webkit-text-fill-color': 'transparent',
        },
        '.bg-musora': {
          background: 'linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30)',
        },
      })
    }),

  ],
}
