const colorsMap = {
    drumeo: {
        color: 'blue accent-3',
        text: 'blue--text text--accent-2',
    },
    pianote: {
        color: 'red',
        text: 'red--text',
    },
    guitareo: {
        color: 'teal lighten-1',
        text: 'teal--text text--lighten-1',
    },
    singeo: {
        color: 'purple lighten-1',
        text: 'purple--text text--lighten-1',
    },
    recordeo: {
        color: 'amber accent-4',
        text: 'amber--text text--accent-4',
    },
    default: {
        color: 'light-blue accent-3',
        text: 'light-blue--text accent-3',
        // color: 'indigo darken-1',
        // text: 'indigo--text text--lighten-1'
    },
};

export default {
    computed: {
        brandColor() {
            return colorsMap[this.state ? this.state.brand : 'default'].color;
        },
        brandTextColor() {
            return colorsMap[this.state ? this.state.brand : 'default'].text;
        },
    },
};
