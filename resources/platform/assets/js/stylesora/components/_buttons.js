module.exports = (theme) => {
    //Buttons
    return {
        '.btn-primary, .btn-secondary': {
            alignItems: 'center',
            borderStyle: 'solid',
            borderRadius: theme('borderRadius.full'),
            borderWidth: theme('borderWidth.2'),
            color: 'white',
            cursor: 'pointer',
            display: 'inline-flex',
            fontFamily: '"Bebas Neue", cursive',
            fontSize: '1.25rem',
            justifyContent: 'center',
            letterSpacing: '1px',
            lineHeight: '1',
            marginBottom: '0.25rem',
            minHeight: '50px',
            padding: '8px 70px',
            position: 'relative',
            textDecoration: 'none',
            textTransform: 'uppercase',
            transitionDuration: '150ms',
            transitionProperty: 'background-color, color, fill, stroke, opacity, box-shadow, transform',
            transitionTimingFunction: 'cubic-bezier(0.4, 0, 0.2, 1)',
            userSelect: 'none',
            whiteSpace: 'nowrap',
            '&:focus-visible': {
                outline: 'none'
            }
        },
        //Primary
        '.btn-primary': {
            borderColor: 'transparent',
            '&:visited': {
                backgroundColor: 'inherit',
                color: 'white'
            },
            '&:hover' : { textDecoration: 'none' },
            '&[disabled], &[disabled]:active': {
                backgroundColor: theme('backgroundColor.gray.200')+ '!important',
                color: theme('textColor.gray.400') + '!important',
                pointerEvents:'none',
            },
            //Brand Specific
            //hover
            '&.bg-drumeo:hover, &.bg-drumeo:focus-visible': {
                backgroundColor: theme('backgroundColor.drumeo.400'),
            },
            '&.bg-pianote:hover, &.bg-pianote:focus-visible': {
                backgroundColor: theme('backgroundColor.pianote.300'),
            },
            '&.bg-guitareo:hover, &.bg-guitareo:focus-visible': {
                backgroundColor: theme('backgroundColor.guitareo.400'),
            },
            '&.bg-singeo:hover, &.bg-singeo:focus-visible': {
                backgroundColor: theme('backgroundColor.singeo.400'),
            },
            '&.bg-recordeo:hover, &.bg-recordeo:focus-visible': {
                backgroundColor: theme('backgroundColor.recordeo.400'),
            },
            //active
            '&.bg-drumeo:active': {
                backgroundColor: theme('backgroundColor.drumeo.600'),
            },
            '&.bg-pianote:active': {
                backgroundColor: theme('backgroundColor.pianote.600'),
            },
            '&.bg-guitareo:active': {
                backgroundColor: theme('backgroundColor.guitareo.600'),
            },
            '&.bg-singeo:active': {
                backgroundColor: theme('backgroundColor.singeo.600'),
            },
            '&.bg-recordeo:active': {
                backgroundColor: theme('backgroundColor.recordeo.600'),
            }
        },
    
        //Secondary
        '.btn-secondary': {
            borderColor: 'currentColor',
            backgroundColor: 'transparent',
            '&:hover': {
                textDecoration: 'none',
            },
            '&[disabled], &[disabled]:active': {
                pointerEvents:'none',
                color: theme('textColor.gray.400') + '!important',
            },
            //Brand Colors
            '&.text-drumeo:hover, &.text-drumeo:focus-visible': {
                color: theme('textColor.drumeo.400'),
            },
            '&.text-pianote:hover, &.text-pianote:focus-visible': {
                color: theme('textColor.pianote.300'),
            },
            '&.text-guitareo:hover, &.text-guitareo:focus-visible': {
                color: theme('textColor.guitareo.400'),
            },
            '&.text-singeo:hover, &.text-singeo:focus-visible': {
                color: theme('textColor.singeo.300'),
            },
            '&.text-recordeo:hover, &.text-recordeo:focus-visible': {
                color: theme('textColor.recordeo.400'),
            },
            //Active Colors
            '&.text-drumeo:active': {
                color: theme('textColor.drumeo.600'),
            },
            '&.text-pianote:active': {
                color: theme('textColor.pianote.600'),
            },
            '&.text-guitareo:active': {
                color: theme('textColor.guitareo.600'),
            },
            '&.text-singeo:active': {
                color: theme('textColor.singeo.600'),
            },
            '&.text-recordeo:active': {
                color: theme('textColor.recordeo.600'),
            }
        },
        
        //Button Variants,
        '.btn-circle': {
            padding: '0',
            height: '50px',
            width: '50px'
        },
        //Sizes
        '.btn-small': {
            fontSize: '0.875rem',
            height: '34px',
            minHeight: 'auto',
            padding: '8px 48px',
        },
        '.btn-medium': {
            fontSize: '1rem',
            height: 'auto',
            minHeight: '50px'
        },
        '.btn-large': {
            fontSize: '1.875rem',
            height: '68px',
            minHeight: 'auto',
        },
        //Sizes + Circles
        '.btn-large.btn-circle': {
            height: '68px',
            width: '68px',
        },
        '.btn-small.btn-circle': {
            height: '34px',
            width: '34px'
        },
        '.btn-medium.btn-circle': {
            height: '50px',
            width: '50px'
        }
    }
}