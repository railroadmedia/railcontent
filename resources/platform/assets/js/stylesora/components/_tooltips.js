module.exports = (theme) => {
    //Tooltips
    return {
        '.with-tooltip': {
            alignItems: 'center',
            display: 'inline-flex',
            justifyContent: 'center',
            overflow: 'visible',
            position: 'relative',

            '&:hover .tooltip, &:focus-visible .tooltip': {
                display: 'flex',
                opacity: 1
            },
        },
        '.tooltip': {
            backgroundColor: theme('backgroundColor.white'),
            backfaceVisibility: 'hidden',
            borderRadius: theme('borderRadius.md'),
            boxShadow: theme('boxShadow.md'),
            color: theme('textColor.black'),
            display: 'none',
            fontFamily: theme('fontFamily.primary'),
            fontSize: theme('fontSize.xs'),
            fontWeight: 400,
            fontStyle: 'normal',
            lineHeight: '15px',
            maxWidth: '190px',
            opacity: 0,
            padding: '0.375rem',
            position: 'absolute',
            textTransform: 'initial',
            top: 'calc(100% + 10px)',
            transitionDuration: '150ms',
            transitionProperty: 'opacity',
            transitionTimingFunction: 'cubic-bezier(0.4, 0, 0.2, 1)',
            width: 'max-content',
            whiteSpace: 'normal',
            zIndex: '100',
            
            '&::after': {
                backgroundColor: 'inherit',
                content: '"" !important',
                height: '7px',
                position: 'absolute',
                right: 'calc(50% - 3.5px)',
                top: '-3px',
                transform: 'rotate(45deg)',
                width: '7px',  
            },
        },
        '.tooltip-center': {
            justifyContent: 'center !important',

            '& > .tooltip::after': {
                right: 'calc(50% - 3.5px) !important'
            }
        },
        '.tooltip-left': {
            
            '& .tooltip': {
                left: 'calc(50% - 17px)',
            },

            '& > .tooltip::after': {
                left: '14px !important'
            }
        },
        '.tooltip-right': {
            
            '& .tooltip': {
                right: 'calc(50% - 17px)',
            },

            '& > .tooltip::after': {
                right: '14px !important'
            }
        },
        '.tooltip-top': {
            '& .tooltip': {
                bottom: 'calc(100% + 10px) !important',
                top: 'initial'
            },
            '& .tooltip:after': {
                bottom: '-3px !important',
                top: 'initial'
            }
        },
        '.tooltip-top.tooltip-center': {
            '& .tooltip:after': {
                bottom: '-3px !important',
                top: 'initial'
            }
        },
        '.tooltip-top.tooltip-right': {
            '& .tooltip:after': {
                bottom: '-3px !important',
                top: 'initial'
            }
        },
        '.tooltip-top.tooltip-left': {

            '& .tooltip:after': {
                bottom: '-3px !important',
                top: 'initial'
            }
        },

        '.tooltip-leftside .tooltip, .tooltip-rightside .tooltip': {
            top: 'initial !important',
            bottom: 'initial !importatnt'
        },
        '.tooltip-leftside .tooltip': {
            right: 'calc(100% + 10px)',

            '&:after': {
                bottom: 'initial',
                top: 'calc(50% - 3.5px) !important',
                right: '-3px !important'
            }
        },
        '.tooltip-rightside .tooltip': {
            left: 'calc(100% + 10px)',

            '&:after': {
                bottom: 'initial',
                top: 'calc(50% - 3.5px) !important',
                left: '-3px !important'
            }
        },

        //Dark Default
        '.tooltip-dark': {
            backgroundColor: theme('backgroundColor.true-gray.500'),
            color: theme('textColor.white')
        },
    }
}