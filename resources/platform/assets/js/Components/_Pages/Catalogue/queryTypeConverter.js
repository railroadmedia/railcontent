export const queryTypeConverter = (type) => {
    const types = {
        'podcasts': 'podcast',
        'boot-camps': 'boot-camp',
        'backstage-secrets': 'backstage-secret',
        'student-collaborations': 'student-collaboration',
        'solos': 'solo',
        'gear-guides': 'gear-guide',
        'performances': 'performance',
        'diy-drum-experiments': 'diy-drum-experiment',
        'tama-drums': 'tama',
        'sonor-drums': 'sonor',
    }

    return types[type] || type;
}
