import Vue from 'vue';
import LegacySoundslice from './LegacySoundslice';

export default {
    install(Vue, options) {
        Vue.component(
            LegacySoundslice.name,
            LegacySoundslice,
        );
    },
};
