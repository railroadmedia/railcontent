const plugin = require('tailwindcss/plugin');

module.exports = () => {
    return plugin(function({ addUtilities }) {
        const stylesoraUtils = {
            '.list-square': { listStyleType: 'square' },
            '.overflow-initial': { overflow: 'initial'},
            '.scrolling-touch': { '-webkit-overflow-scrolling': 'touch' },
            '.scrollbar-none': {
                '-ms-overflow-style': 'none',
                'scrollbar-width': 'none'
            },
            '.scrollbar-none::webkit-scrollbar': { display: 'none' },
            '.scrolling-smooth': { scrollBehavior: 'smooth' },
            '@media (prefers-reduced-motion)': {
                '.scrolling-smooth': { scrollBehavior: 'auto' },
            },
        }

        addUtilities(stylesoraUtils);
    })
}
/* 
    Note: Anything added as a 'Utility' will not have it's properties overridden.
    This can be useful for values that are fixed, height, width, etc.
    If you want to ensure that the values can change, consider adding it
    as a component. 
*/