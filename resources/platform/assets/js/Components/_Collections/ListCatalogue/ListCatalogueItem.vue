<template>
    <a class="
      tw-flex
      tw-flex-row
      tw-relative
      tw-text-[#3F3F46]
      dark:tw-text-[#9EC0DC]
      tw-border-b
      tw-border-[#E4E4E7]
      dark:tw-border-[#223457]
      tw-no-underline
    " :class="[class_object, isBranchPath ? [branchPathBG, branchPathText] : ' hover-text-black',  {'hover:tw-bg-[#E7EFF6] dark:hover:tw-bg-[#002039]' : isReleased}]"
       :href="renderLink && isReleased ? item.url : null">

        <!-- LESSON NUMBERS -->
        <div v-if="showNumbers" class="
        tw-flex
        tw-flex-col
        tw-text-[#00101D]
        dark:tw-text-white
        align-left
        tw-justify-center
        number-col
        title
        hide-xs-only
      ">
            {{ lesson_number }}
        </div>

        <!-- THUMBNAIL COLUMN -->
        <div v-if="!showStudentReviewThumbsAsAvatar" class="tw-flex tw-flex-col tw-justify-center tw-flex-shrink-0"
             :class="[thumbnailColumnClass, themeColor]">
            <div class="thumb-wrap corners-10">
                <div class="thumb-img corners-10 thumb-wrap corners-10 bg-grey-2 dark:tw-bg-[#081825]" :class="thumbnailType">
                    <img :src="`https://www.musora.com/musora-cdn/image/width=500,quality=95/${contentModel.list.thumbnail}`" alt="Lesson Thumbnail"
                         class="tw-transition-opacity tw-duration-500 tw-opacity-0" loading="lazy" onload="this.classList.remove('tw-opacity-0')" />

                    <div class="lesson-progress overflow">
                        <span class="progress" :class="themeBgClass" :style="'width:' + progress_percent + '%'"></span>
                    </div>

                    <div v-if="mappedData.thumb_title && overview" class="thumb-title flex-center text-center ph-1"
                         :class="brand">
                        <img v-if="mappedData.thumb_logo" :src="mappedData.thumb_logo" alt="Item Logo" style="max-width: 150px" />
                        <h5 v-if="mappedData.thumb_title" class="large-display uppercase text-white">
                            {{ mappedData.thumb_title }}
                        </h5>
                    </div>

                    <span
                        class="thumb-hover flex-center"
                        :class="{ 'tw-visible tw-opacity-100 tw-bg-[rgba(0,0,0,0.8)]' : !isReleased }"
                    >
            <i class="fas" :class="thumbnailIcon"></i>
            <p v-if="!isReleased" class="tw-text-white tw-font-bold" :class="overview ? 'tw-text-sm' : 'tw-text-xs'">
              {{ releaseDate }}
            </p>
          </span>
                </div>
            </div>
        </div>
        <!-- AVATAR INSTEAD OF THUMBNAIL -->
        <div v-if="showStudentReviewThumbsAsAvatar" class="tw-flex tw-flex-col tw-justify-center avatar-col">
            <div class="thumb-wrap rounded" style="border-radius: 50%">
                <div class="thumb-img corners-10 square rounded" :style="'background-image:url( ' + thumbnail + ' );'">
          <span class="thumb-hover rounded flex-center" style="border-radius: 50%">
            <i class="fas" :class="thumbnailIcon"></i>
            <p v-if="!isReleased" class="tw-text-xs tw-text-white tw-font-bold">
              {{ releaseDate }}
            </p>
          </span>
                </div>
            </div>
        </div>

        <!-- TITLES AND COLUMN DATA (on mobile) -->
        <div class="tw-flex tw-flex-col tw-justify-center tw-mr-auto title-column tw-flex-grow overflow">

            <!-- Is New -->
            <div v-if="isBranchPath"
                 class="tw-font-bebas-neue tw-tracking-tighter tw-leading-none tw-w-fit tw-mb-2 tw-text-sm tw-uppercase tw-text-white tw-bg-pianote tw-p-1 tw-rounded"
                 style="width: fit-content;">
                New Method Path
            </div>

            <p v-if="!isCoach"
               class="tw-text-xs font-compressed tw-uppercase text-truncate tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]" :class="[
          overview ? 'dense' : 'font-compressed',
        ]">
                {{ mappedData.color_title }}
            </p>

            <p class="tw-text-[#00101D] dark:tw-text-white tw-font-bold item-title"
               :class="overview ? 'heading' : 'tw-text-sm'">
                {{ mappedData.black_title }}
            </p>

            <p v-if="mappedData.grey_title && overview"
               class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] item-title body tw-mt-1 tw-mb-4">
                {{ mappedData.grey_title }}
            </p>

            <p v-if="overview && mappedData.description" class="tw-text-base text-grey-6 dark:tw-text-white mb-1 m-xs-only"
               v-html="mappedData.description">
            </p>

            <p v-if="!is_search" class="
          tw-text-xs
          font-compressed
          tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] text-truncate
          tw-uppercase
          xl:tw-hidden
          tw-flex
          tw-flex-wrap
          sm:tw-flex-nowrap
        " :class="`${overview ? 'tw-mt-4' : ''}`">
        <span v-for="(column_data, i) in mappedData.column_data" :key="`${item.id}-mappedData-${i}`">
          <span v-if="i > 0" class="bullet">-</span>
          {{ column_data }}
        </span>
                <!-- Difficulty Label -->
                <DifficultyLabel v-if="mappedData.difficulty" class="xl:tw-flex-shrink-0 tw-justify-center tw-text-center tw-text-xs tw-ml-2" :difficultyValue="mappedData.difficulty" textCase="uppercase" />
            </p>
        </div>

        <!-- SHEET MUSIC IMAGE IF IT EXISTS -->
        <div v-if="mappedData.sheet_music && !is_search"
             class="flex tw-flex-col tw-justify-center sheet-music-col ph-1 hide-xs-only">
            <img class="dark:tw-invert tw-transition-opacity tw-duration-500" alt="Rudiment Image"
                 :src="mappedData.sheet_music" loading="lazy" />
        </div>

        <!-- Difficulty Label -->
        <DifficultyLabel v-if="mappedData.difficulty" class="tw-hidden xl:tw-flex sm:tw-w-[110px] xl:tw-flex-shrink-0 tw-justify-center tw-text-center tw-text-xs" :difficultyValue="mappedData.difficulty" textCase="uppercase" />

        <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
        <template v-if="!is_search">
            <div v-for="(column_data, i) in mappedData.column_data" :key="`${item.id}-mappedData-${i}`" class="
          tw-hidden
          xl:tw-flex
          tw-uppercase
          tw-items-center
          tw-justify-center
          sm:tw-w-[110px] xl:tw-flex-shrink-0
          tw-text-center
          tw-text-xs
          font-compressed
        " :data-test="column_data">
                {{ column_data }}
            </div>
        </template>

        <!-- ONLY SHOW TYPE ON SEARCHES -->
        <template v-if="is_search">
            <div v-if="mappedData.column_data && mappedData.column_data.length"
                 class="
            tw-hidden
            sm:tw-flex
            tw-flex-col
            tw-uppercase
            tw-justify-center
            sm:tw-w-[110px] xl:tw-flex-shrink-0
            tw-text-center
            tw-text-xs"
            >
                {{ mappedData.column_data[0] }}
            </div>
            <div v-if="item.type !== 'song'" class="
          tw-hidden
          sm:tw-flex
          tw-flex-col
          tw-uppercase
          tw-justify-center
          sm:tw-w-[110px] xl:tw-flex-shrink-0
          tw-text-center
          tw-text-xs
        ">
                {{ item.type.replace("bundle-", "").replace(/-/g, " ") }}
            </div>
            <div class="
          tw-hidden
          sm:tw-flex
          tw-flex-col
          tw-uppercase
          tw-justify-center
          sm:tw-w-[110px] xl:tw-flex-shrink-0
          text-center
          tw-text-xs
          hide-sm-down
        ">
                {{ releaseDate }}
            </div>
        </template>

        <!-- ADD TO LIST OR RESET PROGRESS BUTTONS -->
        <div v-if="displayUserInteractions"
             class="flex tw-flex-col icon-col tw-justify-center" :class="is_search ? '' : 'hide-xs-only'">
            <div v-if="showResetProgress" class="body">
                <i class="flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] reset"
                   :class="`${resetIcon} ${isBranchPath ? branchPathText : 'text-grey-2 hover-text-black'}`" title="Reset Progress"
                   @click.stop.prevent="handleReset"></i>
            </div>
            <button
                v-if="!showResetProgress && !disableAddToListForMethods "
                class="add-to-list tw-inline-flex tw-rounded-full tw-justify-center tw-px-0.5 tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white tw-h-[50px] tw-items-center"
                :class="is_added ? 'is-added' + themeTextClass : 'tw-text-[#3F3F46] hover:tw-text-[#0B76DB] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white'"
                :title="is_added ? 'Remove from Playlist' : 'Add to Playlist'"
                @click.stop.prevent="addToList(null)"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div v-if="is_search && item.type === 'learning-path'" class="flex tw-flex-col icon-col tw-justify-center"></div>

        <!-- PROGRESS INDICATOR OR LOCK ICON -->
        <div class="flex tw-flex-col icon-col tw-justify-center" :class="is_search || overview ? 'hide-xs-only' : ''">

            <!-- LOCK ICON OR ADD TO CALENDAR -->
            <div v-if="noAccess" class="body tw-inline-flex tw-h-full tw-items-center"
                 tabindex="0"
                 :class="isBranchPath ? branchPathText : 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D]'"
                 title="Add to Calendar" data-open-modal="addToCalendarModal" @click="addEvent">
                <i class="fas flex-center rounded" :class="isReleased ? 'fa-lock' : 'fa-calendar-plus'"></i>
            </div>

            <!-- STARTED OR COMPLETED -->
            <div v-else class="body tw-inline-flex tw-h-full tw-items-center">
                <i v-if="item.started || item.completed"
                   class="fas flex-center rounded dark:hover:tw-text-white hover:tw-text-[#00101D]" :class="[
            item.completed ? completedIcon : 'fa-adjust',
            themeTextClass,
          ]"></i>

                <i v-else class="fas flex-center rounded" :class="[
          ['course', 'learning-path', 'pack', 'pack-bundle'].indexOf(item.type) !== -1 ? 'fa-arrow-circle-right' : 'fa-play-circle',
          isBranchPath ? branchPathText : 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D]'
        ]
        "></i>
            </div>
        </div>
    </a>
</template>

<script setup>
import {computed, ref} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import useCatalogueItem from "@hooks/useCatalogueItem";
import useThemeClasses from "@hooks/useThemeClasses";
import useUserCatalogueEvents from "@hooks/useUserCatalogueEvents";
import { useResetProgress } from "@hooks/useResetProgress";
import DifficultyLabel from '@units/DifficultyLabel/DifficultyLabel';


const props = defineProps({
    brand: {
        type: String,
        default: () => 'drumeo',
    },
    isCoach: {
        type: Boolean,
        default: () => false,
    },
    isBranchPath: {
        type: Boolean,
        default: () => false,
    },
    item: {
        type: Object,
        default: () => ({}),
    },
    userId: {
        type: String,
        default: () => '',
    },
    contentTypeOverride: {
        type: String,
        default: '',
    },
    forceWideThumbs: {
        type: Boolean,
        default: () => false,
    },
    lockUnowned: {
        type: Boolean,
        default: () => false,
    },
    showResetProgress: {
        type: Boolean,
        default: () => false,
    },
    overview: {
        type: Boolean,
        default: () => false,
    },
    index: {
        type: [Number, String],
        default: () => '',
    },
    active: {
        type: Boolean,
        default: () => false,
    },
    displayUserInteractions: {
        type: Boolean,
        default: () => true,
    },
    showNumbers: {
        type: Boolean,
        default: () => false,
    },
    noLink: {
        type: Boolean,
        default: () => false,
    },
    is_search: {
        type: Boolean,
        default: false,
    },
    destroyOnListRemoval: {
        type: Boolean,
        default: () => false,
    },
    compactLayout: {
        type: Boolean,
        default: () => false,
    },
    contentType: {
        type: String,
        default: () => 'drumeo',
    },
    themeColor: {
        type: String,
        default: () => 'drumeo',
    },
    useThemeColor: {
        type: Boolean,
        default: () => true,
    },
})

const userStore = useUserStore();
const { isAdmin, brand } = storeToRefs(userStore);
const {
    noAccess,
    contentModel,
    thumbnailIcon,
    renderLink,
    progress_percent,
    isReleased,
    releaseDate,
    thumbnailType,
    is_added,
    completedIcon,
} = useCatalogueItem(props);

const {
    themeBgClass,
    themeTextClass,
    themeHoverBgClass,
    themeHoverTextClass,
} = useThemeClasses(props);

const { addToList, addEvent } = useUserCatalogueEvents({ ...props });
const { resetProgress } = useResetProgress();

const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');

//Computed
const branchPathBG = computed(() => {
    return `tw-bg-${brand.value}/10`;
})

const branchPathText = computed(() => {
    return `tw-text-${brand.value}`;
});

const class_object = computed(() => {
    return {
        active: props.active,
        completed: props.item.completed,
        "content-overview": props.overview,
        "pv-2": props.overview,
        "content-table-row": !props.overview,
        "pv-1": !props.overview,
        "no-access": noAccess.value,
        "wrap-on-mobile": false,
        compact: props.compactLayout,
        "start-learning-path":
            props.contentTypeOverride === "learning-path-part",
    };
})

const disableAddToListForMethods = computed(() => {
    if(props.item.type === 'learning-path-level') {
        return props.brand === 'drumeo' || props.brand === 'pianote';
    }

    return false;
})

const itemStyle = computed(() => {
    const field = props.item.fields.find((field) => field.key === 'style');
    return field.value;
})

const lesson_number = computed(() => {
    if (props.item.type === "semester-pack-lesson") {
        return contentModel.value.getPostField("week");
    }

    return props.index;
})

const mappedData = computed(() => {
    const difficultyValue = contentModel.value.post.fields.find(field => field.key === 'difficulty')?.value;
    const newContentModel = JSON.parse(JSON.stringify(contentModel.value)) //Create a deep copy to not update reactive prop
    newContentModel.list.difficulty = difficultyValue;

    const excludeWords = ['novice', 'beginner', 'intermediate', 'advanced', 'expert', 'all'];
    const filteredColumnData = newContentModel.list.column_data.filter(item => item && !excludeWords.some(word => item.toLowerCase().includes(word)));
    newContentModel.list.column_data = filteredColumnData

    return newContentModel.list;
})

const showStudentReviewThumbsAsAvatar = computed(() => {
    return props.item.type === "student-review" && !props.forceWideThumbs;
})

const thumbnailColumnClass = computed(() => {
    return {
        "large-thumbnail": props.overview,
        "tw-w-[110px] sm:tw-w-[142px]": !props.overview,
        active: props.active,
        "background-cards tw-mt-3":
            props.item.type === "learning-path" ||
            props.item.type === "learning-path-course",
    };
})

const handleReset = () => {
    resetProgress(props.item.id, resetIcon, true);
}

</script>

