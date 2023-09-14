const plugin = require('tailwindcss/plugin');

module.exports = () => {
    return function({ addBase, theme }) {
        addBase({
            //Misc Utilities
            '*': {
                boxSizing: 'border-box',
            },
            body: { 
                '-webkit-font-smoothing': 'antialiased', 
                '-moz-osx-font-smoothing': 'grayscale',
                fontFamily: '"Open Sans", sans-serif'
            },
            'h1,h2,h3,h4,h5,h6': { fontWeight: theme('fontWeight.semibold') },
            'h1': { fontSize: theme('fontSize.4xl') },
            'h2': { fontSize: theme('fontSize.3xl') },
            'h3': { fontSize: theme('fontSize.2xl') },
            'h4': { fontSize: theme('fontSize.xl') },
            'h5': { fontSize: theme('fontSize.lg') },
            'h6': { fontSize: theme('fontSize.base') },
            'p, a, ul, ol': { fontSize: theme('fontSize.base') },
            'a': {
                color: 'currentColor',
                textDecoration: 'none',
                '&:visited': { color: 'currentColor' }
            },
            '.font-bebas-neue': {
                letterSpacing: '0.1em',
            },
           
        });
    }
}