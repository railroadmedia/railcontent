// tailwind.config.js
const plugin = require('tailwindcss/plugin');
const stylesoraTheme = require('stylesora/theme');
const colors = require('tailwindcss/colors');

module.exports = {
  mode: 'jit',
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: stylesoraTheme.fontFamily,
      fontSize: stylesoraTheme.fontSize, 
      colors: {
        drumeo: stylesoraTheme.colors.drumeo,
        pianote: stylesoraTheme.colors.pianote,
        guitareo: stylesoraTheme.colors.guitareo,
        singeo: stylesoraTheme.colors.singeo,
        "true-gray": colors.trueGray,
        //Dark Mode
        dm: stylesoraTheme.colors.dm,
        inherit: 'inherit',
        'alert-red': '#FF0744'
      },
      spacing: stylesoraTheme.spacing,
      zIndex: stylesoraTheme.zIndex,
      inset: stylesoraTheme.inset
    },
  },
  variants: {
    extend: {
        backgroundColor: ['active', 'visited'],
        textColor: ['visited', 'active'],
    }
  },
  plugins: [
    require('stylesora/components/')(),
  ],
}