module.exports = (theme) => {
    //Containers
    return {
        '.content-container': {
            display: 'block',
            margin: '0 auto',
            width: '100%',
            position: 'relative',

            '@media screen and (min-width: 40rem)': {
                maxWidth: '100%'
            },
            '@media screen and (min-width: 64rem)': {
                maxWidth: '64rem',
                padding: '0 .9375rem'
            },
            '@media screen and (min-width: 72.5rem)': {
                maxWidth: '72.5rem'
            },
            '@media screen and (min-width: 97.5rem)': {
                maxWidth: '97.5rem'
            },
        },
    }
}
