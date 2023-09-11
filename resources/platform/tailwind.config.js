// tailwind.config.js
const stylesoraTheme = require('../platform/assets/js/stylesora/theme');
const plugin = require('tailwindcss/plugin');
const colors = require("tailwindcss/colors");
const { keyframes } = require('tailwindcss/defaultTheme');

module.exports = {
  important: true,
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
      //New Breakpoints
      screens: {
        '3xl': '1815px',
        '4xl': '2256px',
        'hover-hover': {
          //only hover on non-touch devices
          'raw': '(hover: hover)',
        },
      },
      animation: {
        'grow-shrink': 'grow-shrink 1.25s infinite'
      },
      keyframes: {
        'grow-shrink': {
          '0%': {
            transform: 'scale(1)',
          },
          '50%': {
            transform: 'scale(1.25)',
          },
          '100%': {
            transform: 'scale(1)',
          }
        }
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/line-clamp'),
    //Stylesora's Base Styles
    require("../platform/assets/js/stylesora/base")(),
    //Stylesora's Attributes
    require("../platform/assets/js/stylesora/attributes")(),
    //Stylesora's Utility Classes
    require("../platform/assets/js/stylesora/utilities/")(),
    //Stylesora's Component Styles
    require("../platform/assets/js/stylesora/components/")(),
    //New Utilities
    plugin(function({ addUtilities }) {
      addUtilities({
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
        },
        '.container': {
          '@media (min-width: 1815px)': {
            maxWidth: '1815px',
          },
          '@media (min-width: 2256px)': {
            maxWidth: '2256px',
          }
        },
        '.font-bebas-neue': {
          fontWeight: '400 !important', //force font weight
          letterSpacing: '1px',
        },
        '.forum-post': {
          'ul, ol': {
            listStyle: 'revert',
            paddingLeft: '40px',
            margin: '10px 0',
          }
        },
        '.break-words': {
          wordBreak: 'break-word',
        },
        //Vue Transitions
        '.fade-enter-active, .fade-leave-active ': {
          transition: 'opacity 150ms ease'
        },
        '.fade-enter-from, .fade-leave-to': {
          opacity: 0,
        },
        '.v-enter-active, .v-leave-active': {
          transition: 'opacity 0.5s ease'
        },
        '.v-enter-from,.v-leave-to': {
          opacity: 0,
        }
      })
    })
  ],
}
