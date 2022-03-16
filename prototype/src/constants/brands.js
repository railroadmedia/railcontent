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
    guitareo: 'tw-bg-guitareo',
    red: '',
    blue: '',
    yellow: '',
    green: ''
}

export const textColor = {
    drumeo: 'tw-text-drumeo',
    singeo: 'tw-text-singeo',
    guitareo: 'tw-text-guitareo',
    pianote: 'tw-text-pianote',
    red: 'tw-text-[#EF4444]',
    blue: 'tw-text-[#3B82F6]',
    yellow: 'tw-text-[#EAB308]',
    green: 'tw-text-[#22C55E]'
}

export const borderColor = {
    drumeo: 'tw-border-drumeo',
    singeo: 'tw-border-singeo',
    guitareo: 'tw-border-guitareo',
    pianote: 'tw-border-pianote',
    red: 'tw-border-[#EF4444]',
    blue: 'tw-border-[#3B82F6]',
    yellow: 'tw-border-[#EAB308]',
    green: 'tw-border-[#22C55E]'
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
    'hover:tw-border-guitareo',
    'hover:tw-border-[#EF4444]',
    'hover:tw-border-[#3B82F6]',
    'hover:tw-border-[#EAB308]',
    'hover:tw-border-[#22C55E]'
]
