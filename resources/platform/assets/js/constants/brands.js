import drumeoBgImg from '../vue/images/drumeo-bg.png'; 
import singeoBgImg from '../vue/images/singeo-bg.png'; 
import pianoteBgImg from '../vue/images/pianote-bg.png'; 
import guitareoBgImg from '../vue/images/guitareo-bg.png';

import drumeoBgImgLight from '../vue/images/drumeo-bg-light.jpg'; 
import singeoBgImgLight from '../vue/images/singeo-bg-light.jpg'; 
import pianoteBgImgLight from '../vue/images/pianote-bg-light.jpg'; 
import guitareoBgImgLight from '../vue/images/guitareo-bg-light.jpg'; 

export const brandUrl = {
  drumeo: 'https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png',
  singeo: 'https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png',
  guitareo: 'https://musora-ui.s3.amazonaws.com/logos/guitareo.svg',
  pianote:
    'https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png'
}

export const whiteLogos = {
  drumeo:'https://musora-ui.s3.amazonaws.com/logos/drumeo-white.svg',
  singeo:'https://musora-ui.s3.amazonaws.com/logos/singeo-white.svg',
  guitareo:'https://musora-ui.s3.amazonaws.com/logos/guitareo-white.svg',
  pianote:'https://musora-ui.s3.amazonaws.com/logos/pianote-white.svg',
  musora: 'https://musora-ui.s3.amazonaws.com/logos/musora-white.svg'
}

export const bgColor = {
  singeo: 'tw-bg-singeo',
  drumeo: 'tw-bg-drumeo',
  pianote: 'tw-bg-pianote',
  guitareo: 'tw-bg-guitareo'
}

export const bgBottomGradients = {
  singeo: 'tw-from-singeo tw-to-singeo-700',
  drumeo: 'tw-from-drumeo tw-to-drumeo-700',
  pianote: 'tw-from-pianote tw-to-pianote-700',
  guitareo: 'tw-from-guitareo tw-to-guitareo-700'
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
  pianote: 'tw-border-pianote',
  red: 'tw-border-red-400',
  green: 'tw-border-green-400',
  blue: 'tw-border-blue-400',
  yellow: 'tw-border-yellow-400'
}

export const bgImg = {
  drumeo: drumeoBgImg,
  singeo: singeoBgImg,
  guitareo: guitareoBgImg,
  pianote: pianoteBgImg
}

export const bgImgLight = {
  drumeo: drumeoBgImgLight,
  singeo: singeoBgImgLight,
  guitareo: guitareoBgImgLight,
  pianote: pianoteBgImgLight
}

// do not delete this is needed for tailwind to generate what is needed, just add here any code generated style
const __usedVars = [
  'hover:tw-border-drumeo',
  'hover:tw-border-pianote',
  'hover:tw-border-singeo',
  'hover:tw-border-guitareo',
  'hover:tw-border-red-400',
  'hover:tw-border-green-400',
  'hover:tw-border-blue-400',
  'hover:tw-border-yellow-400',
  'md:tw-bg-drumeo',
  'md:tw-bg-singeo',
  'md:tw-bg-guitareo',
  'md:tw-bg-pianote'
]
