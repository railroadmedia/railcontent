import { reactive, computed, toRefs } from 'vue';
import Utils from '@vuesora/assets/js/helper-functions/utils.js';

export default function useThemeClasses(props) {
    const state = reactive({
        themeBgClass: computed(() => {
            if (props.useThemeColor) {
                return `bg-${props.themeColor}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `bg-${type}`;
        }),

        themeTextClass: computed(() => {
            if (props.useThemeColor) {
                return `text-${props.themeColor}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `text-${type}`;
        }),

        themeHoverBgClass: computed(() => {
            if (props.useThemeColor) {
                return `hover-bg-${props.themeColor}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `hover-bg-${type}`;
        }),

        themeHoverTextClass: computed(() => {
            if (props.useThemeColor) {
                return `hover-text-${props.themeColor}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `hover-text-${type}`;
        }),
    });

    return toRefs(state);
}
