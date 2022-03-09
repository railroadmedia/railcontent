import drumeoBgImg from '../images/drumeo-bg.png'
import singeoBgImg from '../images/singeo-bg.png'
import pianoteBgImg from '../images/pianote-bg.png'
import guitareoBgImg from '../images/guitareo-bg.png'

export const brandUrl = {
    drumeo: 'https://musora-ui.s3.amazonaws.com/logos/drumeo.svg',
    singeo: 'https://musora-ui.s3.amazonaws.com/logos/singeo.svg',
    guitareo: 'https://musora-ui.s3.amazonaws.com/logos/guitareo.svg',
    pianote: 'https://musora-ui.s3.amazonaws.com/logos/pianote.svg'
}

export const bgColor = {
    singeo: 'tw-bg-singeo',
    drumeo: 'tw-bg-drumeo',
    pianote: 'tw-bg-pianote',
    guitareo: 'tw-bg-guitareo'
}

export const textColor = {
    drumeo: 'tw-text-drumeo',
    singeo: 'tw-text-singeo',
    guitareo: 'tw-text-guitareo',
    pianote: 'tw-text-pianote'
}

export const borderColor = {
    drumeo: 'tw-border-drumeo',
    singeo: 'tw-border-singeo',
    guitareo: 'tw-border-guitareo',
    pianote: 'tw-border-pianote'
}

export const bgImg = {
    drumeo: drumeoBgImg,
    singeo: singeoBgImg,
    pianote: pianoteBgImg,
    guitareo: guitareoBgImg
}

// do not delete this is needed for tailwind to generate what is needed, just add here any code generated style
const __usedVars = [
    'hover:tw-border-drumeo',
    'hover:tw-border-pianote',
    'hover:tw-border-singeo',
    'hover:tw-border-guitareo'
]
