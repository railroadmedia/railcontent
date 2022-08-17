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
          background: 'linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30)',
          margin: '-2px',
        },
        'h1':{
          fontSize: '24px',
          '@media (min-width: 768px)': {
            fontSize: '36px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '48px',
          },
        },
        'h2':{
          fontSize: '20px',
          '@media (min-width: 768px)': {
            fontSize: '30px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '36px',
          },
        },
        'h3':{
          fontSize: '18px',
          '@media (min-width: 768px)': {
            fontSize: '24px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '30px',
          },
        },
        'h4':{
          fontSize: '16px',
          '@media (min-width: 768px)': {
            fontSize: '20px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '24px',
          },
        },
        'h5':{
          fontSize: '15px',
          '@media (min-width: 768px)': {
            fontSize: '18px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '20px',
          },
        },
        'h6':{
          fontSize: '15px',
          '@media (min-width: 768px)': {
            fontSize: '16px',
          },
          '@media (min-width: 1024px)': {
            fontSize: '18px',
          },
        },
        'p':{
          lineHeight: '1.6em',
          fontSize: '15px',
          '@media (min-width: 768px)': {
            fontSize: '16px',
          },
        }
      })
    }),

  ],
}
