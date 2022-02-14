import drumeoBgImg from '../images/drumeo-bg.png'
import singeoBgImg from '../images/singeo-bg.png'
import pianoteBgImg from '../images/pianote-bg.png'
import guitareoBgImg from '../images/guitareo-bg.png'

export const brandUrl = {
  drumeo: 'https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png',
  singeo: 'https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png',
  guitareo: 'https://musora-ui.s3.amazonaws.com/logos/guitareo.svg',
  pianote:
    'https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png'
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
  guitareo: pianoteBgImg,
  pianote: guitareoBgImg
}

// do not delete this is needed for tailwind to generate what is needed, just add here any code generated style
const __usedVars = [
  'hover:tw-border-drumeo',
  'hover:tw-border-pianote',
  'hover:tw-border-singeo',
  'hover:tw-border-guitareo'
]
