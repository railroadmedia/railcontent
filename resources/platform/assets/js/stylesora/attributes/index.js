const plugin = require('tailwindcss/plugin');

module.exports = () => {
    return plugin(function({ addUtilities }) {
        const stylesoraAttributes = {
            '[x-cloak]': { display: 'none' },
        }

        addUtilities(stylesoraAttributes);
    })
}