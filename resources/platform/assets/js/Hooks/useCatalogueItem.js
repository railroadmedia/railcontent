import {ref, computed} from 'vue';
import ContentHelpers from "@vuesora/assets/js/helper-functions/content.js";
import ContentModel from '@vuesora/assets/js/models/_model.js';
import {useUserStore} from "@stores/user.js";
import {getProgressPercentage} from 'musora-content-services';
import {getDate} from "../utils";

export default function useCatalogueItem(props) {
    const userStore = useUserStore();

    const is_added = computed(() => props.item.is_added_to_primary_playlist);

    const progress_percent = ref(0);

    // Progress Percentage
    getProgressPercentage(props.item.id).then(value => {
        progress_percent.value = value;
    }).catch(error => {
        console.log('error fetching progress', error)
    })

    const noAccess = computed(() => {
        if (userStore.isAdmin) {
            return false;
        }

        return props.item.need_access || (props.lockUnowned && props.item.is_owned === false) || (props.lockUnowned && !isReleased.value);
    });

    const dateNow = computed(() => Date.now());

   const isReleased = computed(() => {
        const datePublishedOn = new Date(props.item.published_on).getTime();
        const dateQuarterPublishedOn = props.item.quarter_published ? new Date(props.item.quarter_published).getTime() : null;

        // if (userStore.isAdmin) {
        //     return true;
        // }

       if(Object.hasOwn(props.item, 'is_locked')){
           return !props.item.is_locked;
       }
       // If the item is a draft and has a quarter_published date, check if the current date is greater than the quarter_published date
       else if (dateQuarterPublishedOn && props.item.status === 'draft') {
            return dateNow.value > dateQuarterPublishedOn;
       }

        return dateNow.value > datePublishedOn;
    });

    const releaseDate = computed(() => {
        if(props.item.is_locked){
            return getDate(props.item.unlock_date);
        } else if (props.item.quarter_published) {
            return getDate(props.item.quarter_published);
        }

        return getDate(props.item.published_on);
    });

    const isCompleted = computed(() => props.item.completed || progress_percent.value === 100);

    const completedIcon = computed(() => props.item.type === 'course' ? 'fa-trophy' : 'fa-check-circle');

    const thumbnailIcon = computed(() => {
        const contentWithHierarchy = {
            drumeo: ['course', 'learning-path', 'learning-path-level', 'learning-path-course', 'pack',
                'pack-bundle', 'semester-pack'],
            guitareo: ['course', 'song', 'play-along', 'learning-path', 'pack', 'pack-bundle', 'semester-pack'],
            pianote: ['course', 'learning-path', 'pack', 'chord-and-scale'],
            singeo: ['course', 'learning-path', 'pack', 'chord-and-scale'],
        };

        if (!isReleased.value) {
            return 'fa-clock';
        }

        if (noAccess.value) {
            if (props.lockUnowned && props.item.is_owned === false) {
                return 'fa-lock';
            }
        }

        if (isCompleted.value) {
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
        dateNow,
        isReleased,
        releaseDate,
        completedIcon,
        thumbnailIcon,
        renderLink,
        thumbnailType,
        contentModel,
        isCompleted,
    };
}
