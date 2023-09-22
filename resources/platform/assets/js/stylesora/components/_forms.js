module.exports = (theme) => {
    //Forms
    return {
        //Inputs
        '.input-field': {
            marginBottom: theme('margin.4'),
            position: 'relative',
        
            '.label': {
                color: theme('textColor.black'),
                display: 'block',
                fontSize: theme('fontSize.sm'),
                fontWeight: 'bold',
                marginBottom: theme('margin.2'),
                textTransform: 'capitalize',
            },

            '.input-wrapper': {
                position: 'relative',
            },

            'input[type=date], input[type=email], input[type=number], input[type=search], input[type=tel], input[type=password], input[type=text], select, textarea, button': {
                appearance: 'none',
                backgroundColor: theme('backgroundColor.white'),
                border: '1px solid',
                borderColor: theme('textColor.gray.300'),
                borderRadius: theme('borderRadius.full'),
                boxShadow: theme('boxShadow.sm'),
                color: theme('textColor.gray.700'),
                display: 'block',
                fontSize: theme('fontSize.sm'),
                height: theme('height.12'),
                lineHeight: '1.5rem',
                marginBottom: theme('margin.2'),
                paddingTop: theme('padding.2'),
                paddingBottom: theme('padding.2'), 
                paddingLeft: theme('padding.4'),
                paddingRight: theme('padding.14'),
                width: '100%',

                '&:focus': {
                    outline: 'none', 
                },

                '& + .input-icon svg.invalid-icon, & .input-icon svg.invalid-icon ': {
                    display: 'none'
                },
            },
            'input[type=search]': {
                paddingRight: theme('padding.4'),
            },

            'textarea': {
                borderRadius: theme('borderRadius.lg'),
                fontSize: theme('fontSize.sm'),
                height: 'auto',
                paddingRight: theme('padding.10'),

                '& + .input-icon': {
                    height: theme('height.10')
                }
            },
            'button': {
                textAlign: 'left',
            },

            'ul.dropdown': {
                backgroundColor:theme('backgroundColor.white'),
                boxShadow: theme('boxShadow.lg'),
                border: '1px solid',
                borderColor: theme('textColor.gray.300'),
                borderRadius: theme('borderRadius.md'),
                fontSize: theme('fontSize.base'),
                listStyle: 'none',
                marginTop: theme('margin.1'),
                maxHeight: theme('maxHeight.60'),
                overflowY: 'scroll',
                overflowX: 'hidden',
                paddingTop: theme('padding.1'),
                paddingBottom: theme('padding.1'),
                paddingLeft: 0,
                position: 'absolute',
                width: '100%',
                zIndex: theme('zIndex.10'),

                'li': {
                    color: theme('textColor.gray.900'),
                    cursor: 'default',
                    position: 'relative',
                    userSelect: 'none',
                    
                    'a, .option': {
                        cursor: 'pointer',
                        display: 'block',
                        overflow: 'hidden',
                        position: 'relative',
                        paddingTop: theme('padding.2'),
                        paddingBottom: theme('padding.2'),
                        paddingLeft: theme('padding.3'),
                        paddingRight: theme('padding.9'),
                        transitionProperty: 'all',
                        transitionTimingFunction: 'cubic-bezier(0.4, 0, 0.2, 1)',
                        transitionDuration: '150ms',

                        '&:hover, .option': {
                            backgroundColor: theme('backgroundColor.gray.200'),
                        }
                    },
                    'input[type="checkbox"], input[type="radio"]': {
                        appearance: 'none',
                        display: 'none',
                        position: 'absolute'
                    },
                    'input[type="checkbox"] + .option .input-icon svg, input[type="radio"] + .option .input-icon svg': {
                        color: 'currentColor',
                        height: theme('height.4'),
                        opacity: 0,
                        width: theme('width.4'),
                    },
                    'input[type="checkbox"]:checked + .option .input-icon svg, input[type="radio"]:checked + .option .input-icon svg': {
                        opacity: 1,
                    },
                    'input[type="checkbox"]:checked + .option, input[type="radio"]:checked + .option': {
                        backgroundColor: theme('backgroundColor.gray.700'),
                        color: theme('textColor.white')
                    }
                },
            },

            '&[disabled=true]': {
                pointerEvents: 'none',

                'input[type=date], input[type=email], input[type=number], input[type=search], input[type=tel], input[type=password], input[type=text], select, textarea, button[type="button"]': {
                    backgroundColor: theme('backgroundColor.gray.100'),
                    color: theme('textColor.gray.400')
                },

                'label': {
                    color: theme('textColor.gray.300')
                }
            },

            '.input-icon': {
                alignItems: 'center',
                bottom: 0,
                display: 'flex',
                height: theme('height.12'),
                paddingRight: theme('padding.3'),
                position: 'absolute',
                pointerEvents: 'none',
                right: 0,
                top: 1,

                'svg': {
                    color: theme('textColor.gray.500'),
                    height: theme('height.5'),
                    width: theme('width.5'),
                }
            },
            '.input-message': {
                display: 'none',
                fontSize: theme('fontSize.sm'),
                fontStyle: 'italic',
            },
            'input[type=date], input[type=email], input[type=number], input[type=search], input[type=tel], input[type=password], input[type=text], select, textarea, button[type="button"]': {
                '&[aria-required="true"][aria-invalid="true"]': {
                    borderColor: theme('textColor.red.500') + ' !important', 
                    backgroundColor: theme('backgroundColor.red.50') + ' !important',

                    '&:-webkit-autofill, &:-webkit-autofill:hover, &:-webkit-autofill:focus, &:-webkit-autofill:active': {
                        '-webkit-box-shadow': '0 0 0 30px '+ theme('backgroundColor.red.50') +' inset !important',
                    },

                    '& + .input-icon svg.invalid-icon, & .input-icon svg.invalid-icon, & ~ .input-message': {
                        color: theme('textColor.red.500'),
                        display: 'block',
                    },

                    '& + .input-icon svg.invalid-icon, & .input-icon svg.invalid-icon': {
                        display: 'block'
                    },
                },
                '&[aria-required="true"][aria-invalid="false"]': {
                    '& + .input-icon svg.invalid-icon, & .input-icon svg.invalid-icon': {
                        display: 'none'
                    },
                }
            }
        },

        //File Input
        '.file-field': {
            marginBottom: theme('margin.4'),
            position: 'relative',

            'label': {
                width: '100%',
                marginBottom: theme('margin.2'),

                '.input-icon': {
                    marginRight: theme('margin.1'),

                },
                '.input-icon svg': {
                    height: theme('height.5'),
                    width: theme('width.5'),
                },
                '.input-icon svg.invalid-icon, .input-icon svg.valid-icon': {
                    display: 'none'
                },
                'input': {
                    display: 'none'
                }
            },
            '.input-messages': {
                fontFamily: '"Bebas Neue", cursive',
                fontSize: theme('fontSize.base'),
                fontStyle: 'italic',
                letterSpacing: '1px',
                textAlign: 'center',
                width: '100%',

                '.primary-message': {
                    color: theme('textColor.black'),
                    lineHeight: theme('leading.snug'),
                    marginBottom: theme('margin.2'),
                },
                '.secondary-message': {
                    lineHeight: theme('leading.snug'),
                    color: theme('textColor.gray.400')
                }
            },
            'label[aria-invalid="true"]': {
                color: theme('textColor.red.500') + ' !important', 
                backgroundColor: theme('backgroundColor.red.50') + ' !important',

                '.input-icon svg.invalid-icon': {
                    color: theme('textColor.red.500') + ' !important', 
                    display: 'block'
                },
                '.input-icon svg:not(.invalid-icon), .input-icon i': {
                    display: 'none'
                },
                '& ~ .input-messages .primary-message': {
                    color: theme('textColor.red.500') + ' !important',
                }
            },
            'label[aria-valid="true"]': {
                color: theme('textColor.green.500') + ' !important', 
                backgroundColor: theme('backgroundColor.green.50') + ' !important',

                '.input-icon svg.valid-icon': {
                    color: theme('textColor.green.500') + ' !important', 
                    display: 'block'
                },
                '.input-icon svg:not(.valid-icon), .input-icon i': {
                    display: 'none'
                },
            },
            '&[disabled=true]': {
                pointerEvents: 'none',
                'label': {
                    backgroundColor: theme('backgroundColor.gray.100') + ' !important',
                    borderColor: theme('textColor.gray.300') + ' !important',
                    color: theme('textColor.gray.400') + ' !important'
                },
                '.input-messages': {
                    display: 'none',
                }
            }
        },

        //Toggle Field
        '.toggle-field': {
            marginBottom: theme('margin.4'),
            position: 'relative',

            '.toggle-wrapper': {
                alignItems: 'center',
                display: 'inline-flex',
                marginBottom: theme('margin.2'),
            },
            'input[type="checkbox"]:focus + label' : {
                borderColor: 'currentColor !important'
            },
            'input[type="checkbox"]': {
                appearance: 'none'
            },
            'input[type="checkbox"] + label': {
                border: '2px solid',
                borderRadius: theme('borderRadius.full'),
                borderColor: 'transparent',
                cursor: 'pointer',
                display: 'inline-flex',

                '.toggle': {
                    border: '2px solid',
                    borderRadius: theme('borderRadius.full'),
                    borderColor: 'transparent',
                    display: 'inline-flex',
                    flexShrink: 0,
                    height: theme('height.6'),
                    margin: '0.125rem',
                    position: 'relative',
                    transitionProperty: 'background-color, border-color, color, fill, stroke',
                    transitionDuration: '200ms',
                    transitionTimingFunction: 'cubic-bezier(0.4, 0, 0.2, 1)',
                    width: theme('width.11'),
                },
                '.toggle-switch': {
                    backgroundColor: theme('backgroundColor.white'),
                    borderRadius: theme('borderRadius.full'),
                    display: 'inline-block',
                    height: theme('height.5'),
                    pointerEvents: 'none',
                    position: 'relative',
                    transitionDuration: '200ms',
                    transitionTimingFunction: 'cubic-bezier(0.4, 0, 0.2, 1)',
                    transitionProperty: 'background-color, border-color, color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter',
                    width: theme('width.5'),

                    '.toggle-off, .toggle-on': {
                        alignItems: 'center',
                        bottom: '0',
                        display: 'flex',
                        height: theme('height.full'),
                        justifyContent: 'center',
                        left: '0',
                        position: 'absolute',
                        right: '0',
                        top: '0',
                        transitionProperty: 'opacity',
                        width: theme('width.full'),

                        'svg': {
                            height: theme('height.3'),
                            width: theme('width.3')
                        }
                    },
                    '.toggle-off': {
                        transitionDuration: '200ms',
                        transitionTimingFunction: 'cubic-bezier(0.4, 0, 1, 1)',

                        'svg': {
                            color:theme('textColor.gray.400')
                        }
                    },
                    '.toggle-on': {
                        opacity: 0,
                        transitionDuration: '100ms',
                        transitionTimingFunction: 'cubic-bezier(0, 0, 0.2, 1) ',

                        'svg': {
                            color: 'currentColor',
                        }
                    },
                },
            },
            '.toggle-text': {
                marginLeft: theme('margin.2'),
                fontSize: theme('fontSize.sm'),
                fontWeight: 'bold',
                color: theme('textColor.black')
            },
            '& .input-message': {
                display: 'none',
                fontSize: theme('fontSize.sm'),
                fontStyle: 'italic',
            },
            '&[disabled=true]': {
                pointerEvents: 'none',

                '.toggle-text': {
                    color: theme('textColor.gray.400')
                },
            },
            '&[aria-required="true"][aria-invalid="true"]': {
                'input.toggle + label' : {
                    borderColor: theme('textColor.red.500')+' !important'
                },
                '.input-message': {
                    display: 'block',
                    color: theme('textColor.red.500'),
                }
            }
        },

        //Radio Buttonsd
        '.radio-group': {
            display: 'flex',
            marginBottom: theme('margin.2'),

            '.radio-field': {
                alignItems: 'center',
                display: 'inline-flex',
                marginRight: theme('margin.4'),
                
                input: { marginRight: theme('margin.2') },
                label: { fontSize: theme('fontSize.sm') }
            },

            '[disabled=true] & .radio-field label': {
                color: theme('textColor.gray.400')
            }
        },
        //Fieldset
        '.fieldset': {
            display: 'flex',
            flexDirection: 'column',
            marginBottom: theme('margin.4'),
            padding: 0,
            border: 0,

            '.fieldset-title': {
                fontWeight: 'bold',
                fontSize: theme('fontSize.sm'),
                marginBottom: theme('margin.2'),
            },
            '.input-message': {
                display: 'none',
                fontSize: theme('fontSize.sm'),
                fontStyle: 'italic',
            },
            '&[aria-required="true"][aria-invalid="true"]': {
                '.input-message': {
                    display: 'block',
                    color: theme('textColor.red.500')
                },
            },
            '&[disabled=true]': {
                pointerEvents: 'none',

                '.fieldset-title': {
                    color: theme('textColor.gray.300')
                },
                '.input-message': {
                    display: 'none',
                }
            },
        }
    }
}