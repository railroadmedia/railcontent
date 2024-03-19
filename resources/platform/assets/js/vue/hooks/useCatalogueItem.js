import { DateTime } from 'luxon';
import { reactive, computed, toRefs } from 'vue';
import ContentHelpers from "../vuesora/assets/js/helper-functions/content.js";
import ContentModel from '../vuesora/assets/js/models/_model.js';
import { useUserStore } from "../../stores/user";

export default function useCatalogueItem(props) {
    const userStore = useUserStore();

    const is_added = computed(() => props.item.is_added_to_primary_playlist);
    const progress_percent = computed(() => props.item.progress_percent);
    const noAccess = computed(() => {
            if (userStore.isAdmin) {
                return false;
            }

            return (props.lockUnowned && props.item.is_owned === false) || (props.lockUnowned && !isReleased.value);
    });
    const datePublshedOn = computed(() => DateTime.fromSQL(props.item.published_on, { zone: 'UTC' }).toFormat('x'));
    const dateNow = computed(() => Date.now());
    const isReleased = computed(() => {
            if (userStore.isAdmin) {
                return true;
            }

            return dateNow.value > datePublshedOn.value;
        });
    const releaseDate = computed(() => DateTime.fromSQL(props.item.published_on).toFormat('LLL d/yy'));
    const completedIcon = computed(() => props.item.type === 'course' ? 'fa-trophy' : 'fa-check-circle');
    const thumbnailIcon = computed(() => {
            const contentWithHierarchy = {
                drumeo: ['course', 'learning-path', 'learning-path-level', 'learning-path-course', 'pack',
                    'pack-bundle', 'semester-pack'],
                guitareo: ['course', 'song', 'play-along', 'learning-path', 'pack', 'pack-bundle', 'semester-pack'],
                pianote: ['course', 'learning-path', 'pack', 'chord-and-scale'],
                singeo: ['course', 'learning-path', 'pack', 'chord-and-scale'],
            };

            if (noAccess.value) {
                if (props.lockUnowned && props.item.is_owned === false) {
                    return 'fa-lock';
                }

                if (!isReleased.value) {
                    return 'fa-clock';
                }
            }

            if (props.item.completed) {
                return completedIcon.value;
            }

            return contentWithHierarchy[userStore.brand].indexOf(props.item.type) !== -1 ? 'fa-arrow-right' : 'fa-play';
        });
    const renderLink = computed(() => {
            if (props.noLink) {
                return false;
            }

            return !noAccess.value;
        });
    const thumbnailType = computed(() => {
            if (props.forceWideThumbs) {
                return 'widescreen';
            }

            return {
                drumeo: ['song', 'learning-path-level'],
                guitareo: ['song', 'chord-and-scale', 'learning-path-level'],
                pianote: ['song', 'unit', 'learning-path-level'],
                singeo: ['song', 'unit', 'learning-path-level'],
            }[userStore.brand].indexOf(props.item.type) !== -1 ? 'square' : 'widescreen';
        });

    const contentModel = computed(() => {
        const shows = ContentHelpers.shows();
        let type = props.contentTypeOverride || props.item.type;

        if (shows.indexOf(type) !== -1) {
            type = 'show';
        }

        return new ContentModel(type, {
            brand: userStore.brand,
            post: props.item,
        });
    });

    return {
        is_added,
        progress_percent,
        noAccess,
        datePublshedOn,
        dateNow,
        isReleased,
        releaseDate,
        completedIcon,
        thumbnailIcon,
        renderLink,
        thumbnailType,
        contentModel
    };
}
