export const initialSteps = {
    guitareo: [
        { label: 'ABOUT', checked: false, key: 'userInfo' },
        { label: 'INSTRUMENT', checked: false, key: 'instrumentSelect' },
        { label: 'EXPERIENCE', checked: false, key: 'experience' },
        { label: 'GENRES', checked: false, key: 'genre' },
        { label: 'TOPICS', checked: false, key: 'topics' },
        { label: 'GEAR', checked: false, key: 'instrumentType' },
        { label: 'GOALS', checked: false, key: 'goals' }
    ],
    pianote: [
        { label: 'ABOUT', checked: false, key: 'userInfo' },
        { label: 'INSTRUMENT', checked: false, key: 'instrumentSelect' },
        { label: 'EXPERIENCE', checked: false, key: 'experience' },
        { label: 'GENRES', checked: false, key: 'genre' },
        { label: 'TOPICS', checked: false, key: 'topics' },
        { label: 'GOALS', checked: false, key: 'goals' }
    ],
    drumeo: [
        { label: 'ABOUT', checked: false, key: 'userInfo' },
        { label: 'INSTRUMENT', checked: false, key: 'instrumentSelect' },
        { label: 'EXPERIENCE', checked: false, key: 'experience' },
        { label: 'GENRES', checked: false, key: 'genre' },
        { label: 'TOPICS', checked: false, key: 'topics' },
        { label: 'GEAR', checked: false, key: 'instrumentType' },
        { label: 'GOALS', checked: false, key: 'goals' }
    ],
    singeo: [
        { label: 'ABOUT', checked: false, key: 'userInfo' },
        { label: 'INSTRUMENT', checked: false, key: 'instrumentSelect' },
        { label: 'EXPERIENCE', checked: false, key: 'experience' },
        { label: 'GENRES', checked: false, key: 'genre' },
        { label: 'TOPICS', checked: false, key: 'topics' },
        { label: 'GOALS', checked: false, key: 'goals' }
    ],
    default: [
        { label: 'ABOUT', checked: false, key: 'userInfo' },
        { label: 'INSTRUMENT', checked: false, key: 'instrumentSelect' },
        { label: 'GEAR', checked: false, key: 'instrumentType' },
        { label: 'EXPERIENCE', checked: false, key: 'experience' },
        { label: 'GENRES', checked: false, key: 'genre' },
        { label: 'TOPICS', checked: false, key: 'topics' },
        { label: 'GOALS', checked: false, key: 'goals' }
    ],
}

export const instrumentBrand = {
    piano: 'pianote',
    drums: 'drumeo',
    guitar: 'guitareo',
    singing: 'singeo',
    default: 'unselected'
};

export const brandInstrument = {
    pianote: 'piano',
    drumeo: 'drums',
    guitareo: 'guitar',
    singeo: 'singing',
    unselected: 'default'
};

export const brands = ['drumeo', 'singeo', 'pianote', 'guitareo'];
