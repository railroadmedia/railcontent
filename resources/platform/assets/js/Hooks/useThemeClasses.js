import { reactive, computed, toRefs } from 'vue';
import Utils from '@vuesora/assets/js/helper-functions/utils';
import {useUserStore} from "@stores/user";
import {storeToRefs} from "pinia/dist/pinia";

export default function useThemeClasses(props) {
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

    const state = reactive({
        themeBgClass: computed(() => {
            if (props.useThemeColor) {
                return `bg-${brand.value}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `bg-${type}`;
        }),

        themeTextClass: computed(() => {
            if (props.useThemeColor) {
                return `text-${brand.value}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `text-${type}`;
        }),

        themeHoverBgClass: computed(() => {
            if (props.useThemeColor) {
                return `hover-bg-${brand.value}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `hover-bg-${type}`;
        }),

        themeHoverTextClass: computed(() => {
            if (props.useThemeColor) {
                return `hover-text-${brand.value}`;
            }

            const type = Utils.getThemeColorByContentType(props.contentType);

            return `hover-text-${type}`;
        }),
    });

    return toRefs(state);
}
