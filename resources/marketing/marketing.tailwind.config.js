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
    './resources/platform/**/*.vue',
  ]),
  safelist: [
    'hover:text-singeo','hover:text-drumeo','hover:text-guitareo','hover:text-pianote'
  ],
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
        'body': {
          fontFamily: 'Open Sans, sans-serif',
        },
        '.text-navy': {
          color: '#a1afc9'
        },
        '.bg-musora': {
          background: 'linear-gradient(20deg,#03c8ac, #0976db, #9a01ee, #f61a30)',
        },
        // '.bg-promo': {
        //     backgroundColor: '#ab000d',
        // },
        // '.text-promo': {
        //     color: '#ab000d',
        // },
        // '.border-promo': {
        //     borderColor: '#ab000d',
        // },
        '.font-bebas': {
          fontFamily: '"Bebas Neue", sans-serif'
        },
        '.border-musora::before':{
          content:"' '",
          position: 'absolute',
          top: '0',
          right: '0',
          bottom: '0',
          left: '0',
          zIndex: '-1',
          borderRadius: 'inherit',
          background: 'linear-gradient(20deg,#03c8ac, #0976db, #9a01ee, #f61a30)',
          margin: '-2px',
        },
        'img': {
          display: 'inline-block'
        },
      })
    }),

  ],
}
