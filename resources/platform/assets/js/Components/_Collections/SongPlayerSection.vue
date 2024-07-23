<template>
    <div class="tw-flex tw-flex-col tw-pr-0 xl:tw-pr-8 tw-grow tw-w-full">
        <div v-if="!isLoading" class="tw-flex tw-flex-col sm:tw-flex-row tw-py-4">
            <div class="tw-flex tw-flex-col song-album-cover sm:tw-mr-6 tw-mb-6 sm:tw-mb-0">
                <div class="tw-flex tw-flex-shrink-0 tw-items-center tw-justify-center tw-aspect-square tw-w-full tw-min-w-[175px] sm:tw-max-w-[338px]  2xl:tw-w-screen tw-relative tw-overflow-hidden tw-rounded-[10px] tw-bg-white dark:tw-bg-[#0E2031]">
                    <!-- Song Image Background -->
                    <img :src="`https://www.musora.com/musora-cdn/image/width=500,quality=95/${thumbnailUrl}`"
                        class="tw-absolute tw-transition-opacity tw-duration-500 tw-opacity-0 tw-blur-sm"
                        loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')"
                    >
                    <!-- Song Image -->
                    <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                        <img class="tw-h-full tw-object-cover tw-opacity-0"
                            :src="thumbnailUrl"
                            :alt="`${songTitle} album cover`"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                    </div>
                    <div class="tw-z-10 tw-flex tw-items-center tw-justify-center tw-w-[80px] tw-h-[80px] thumb-title rounded ba-white-2 hover-border-drumeo">
                        <button @click="openFull"
                            class="square heading rounded pointer text-white hover-text-drumeo shadow-md tw-w-[80px] tw-h-[80px]">
                            <i class="fas fa-play absolute-center tw-ml-[2px]"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Song Details -->
            <div class="tw-flex flex-column tw-w-full">
                <div>
                    <h1 class="text-black font-bold item-title heading dark:tw-text-white tw-text-xl md:tw-text-2xl">{{ songTitle }}</h1>
                    <p class="text-grey-3 tw-text-lg dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] mt-1 tw-mb-3">
                        {{ songArtist }} -
                        {{ songAlbum }} -
                        {{ songMeta }}
                    </p>
                    <div class="tw-flex tw-flex-col 3xl:tw-flex-row">
                        <button v-if="hasInstrumentless" style="padding: 0 24px;"
                            @click="openInstrumentless"
                            :class="`tw-h-[50px] tw-btn-primary tw-bg-${brand} hover:tw-bg-${brand}-600 tw-mb-3 3xl:tw-mb-0 3xl:tw-mr-3`">
                            <svg class="tw-mr-2 tw-text-base " width="25" height="24" viewBox="0 0 25 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.47852 8.15625C0.94349 8.15625 0.509766 8.58997 0.509766 9.125V14.875C0.509766 15.41 0.94349 15.8438 1.47852 15.8438C2.01354 15.8438 2.44727 15.41 2.44727 14.875V9.125C2.44727 8.58997 2.01354 8.15625 1.47852 8.15625ZM5.79102 3.48438C5.25599 3.48438 4.82227 3.9181 4.82227 4.45312V19.5469C4.82227 20.0819 5.25599 20.5156 5.79102 20.5156C6.32604 20.5156 6.75977 20.0819 6.75977 19.5469V4.45312C6.75977 3.9181 6.32604 3.48438 5.79102 3.48438ZM10.1035 0.25C9.56849 0.25 9.13477 0.683724 9.13477 1.21875V22.7812C9.13477 23.3163 9.56849 23.75 10.1035 23.75C10.6385 23.75 11.0723 23.3163 11.0723 22.7812V1.21875C11.0723 0.683724 10.6385 0.25 10.1035 0.25ZM14.416 5.64062C13.881 5.64062 13.4473 6.07435 13.4473 6.60938V17.3906C13.4473 17.9256 13.881 18.3594 14.416 18.3594C14.951 18.3594 15.3848 17.9256 15.3848 17.3906V6.60938C15.3848 6.07435 14.951 5.64062 14.416 5.64062ZM18.7285 2.04688C18.1935 2.04688 17.7598 2.4806 17.7598 3.01562V20.9844C17.7598 21.5194 18.1935 21.9531 18.7285 21.9531C19.2635 21.9531 19.6973 21.5194 19.6973 20.9844V3.01562C19.6973 2.4806 19.2635 2.04688 18.7285 2.04688ZM23.041 8.875C22.506 8.875 22.0723 9.30872 22.0723 9.84375V14.1562C22.0723 14.6913 22.506 15.125 23.041 15.125C23.576 15.125 24.0098 14.6913 24.0098 14.1562V9.84375C24.0098 9.30872 23.576 8.875 23.041 8.875Z"
                                    fill="white" stroke="white" stroke-width="0.5" />
                            </svg>

                            {{ getInstrumentlessLabel() }}
                        </button>

                        <button style="padding: 0 24px;" @click="openFull"
                            :class="`tw-h-[50px] tw-btn-primary tw-bg-${brand} hover:tw-bg-${brand}-600 tw-mb-3 3xl:tw-mb-0 3xl:tw-mr-3`">
                            <i class="fas fa-play tw-mr-2 tw-text-base"></i>
                            PLAY FULL TRACK
                        </button>

                        <button style="padding: 0 24px;"
                            :class="`tw-h-[50px] ${lessonProgressRef === '100' ? `tw-bg-${brand} tw-text-white dark:tw-bg-${brand} dark:tw-text-white tw-btn-primary` : 'tw-text-[#00101D] tw-box-border tw-leading-none tw-btn-secondary dark:tw-text-white hover:tw-bg-black/10 dark:hover:tw-bg-white/10'}`"
                            data-tooltip="Mark Lesson as Complete" :data-content-id="contentId"
                            @click="markSongAsComplete">
                            <span v-if="lessonProgressRef !== '100'">
                                <i class="fas fa-check tw-mr-2 tw-text-base"></i>
                                Mark as Complete
                            </span>
                            <span v-if="lessonProgressRef === '100'">
                                <i class="fas fa-check tw-mr-2 tw-text-base"></i>
                                Completed
                            </span>
                        </button>
                    </div>
                    <ContentLessonActionButtons
                        :brand="brand"
                        :title="songTitle"
                        :description="songArtist"
                        :is-liked="isLiked"
                        :like-count="likeCount"
                        :is-added="isAdded"
                        :content-id="contentId"
                        :user-id="userId"
                        :resources="resources"
                        content-type="song"
                        :thumbnailUrl="thumbnailUrl"
                        :report-user-email="userEmail"
                        :report-user-name="userDisplayName"
                        :report-logo="reportLogo"
                    />
                </div>
            </div>
        </div>

        <!-- Else Show Skeleton Loader -->
        <div v-else>

        </div>

        <!-- Soundslice Modals -->
        <transition name="show-from-bottom">
            <div v-if="openSoundslice === 'instrumentless'" id="practiceOverlay" class="bg-white">
                <SoundSlice
                    :user-id="userId"
                    :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=2`"
                    :soundslice-slug="soundsliceObject.soundsliceSlug"
                    :contentId="contentId"
                >
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls
                            :title="`${songTitle} (Instrumentless)`"
                            :disable-next="true"
                            :disable-prev="true"
                            @onClose="handleCloseSoundslice"
                        />
                    </template>
                </SoundSlice>
            </div>
        </transition>
        <transition name="show-from-bottom">
            <div v-if="openSoundslice === 'full'" id="practiceOverlay" class="bg-white">
                <SoundSlice
                    :user-id="userId"
                    :theme-color="brand"
                    :additional-params="`${getBrandSpecificParams()}&layout=3&recording_idx=1`"
                    :soundslice-slug="soundsliceObject.soundsliceSlug"
                    :contentId="contentId"
                >
                    <template v-slot:soundsliceControls>
                        <SoundSliceControls
                            :title="`${songTitle} (Full)`"
                            :disable-next="true"
                            :disable-prev="true"
                            @onClose="handleCloseSoundslice"
                        />
                    </template>
                </SoundSlice>
            </div>
        </transition>
    </div>
</template>
<script setup>
    import { ref, onBeforeMount} from 'vue';
    import ContentLessonActionButtons from '@vuesora/Components/VideoResources/ContentLessonActionButtons.vue';
    import SoundSlice from "@collections/SoundSlice/SoundSlice.vue"
    import SoundSliceControls from "@collections/SoundSlice/SoundSliceControls.vue";
    import ContentService from "@vuesora/assets/js/Services/content";
    import { storeToRefs } from 'pinia';
    import { useUserStore } from '@stores/user';

    const userStore = useUserStore();
    const { brand, userId, userEmail, userDisplayName } = storeToRefs(userStore);

    const props = defineProps({
        isLoading: Boolean,
        contentId: Number,
        resources: Array,
        thumbnailUrl: String,
        songTitle: String,
        songArtist: String,
        songAlbum: String,
        songMeta: String,
        isLiked: Boolean,
        isAdded: Boolean,
        assignments: Array,
        hasInstrumentless: Boolean,
        lessonProgress: [Number, String],
        likeCount: [Number, String],
        reportLogo: String,
    });

    const soundsliceObject = ref(props.assignments.length ? props.assignments[0] : {});
    const openSoundslice = ref(null);
    const lessonProgressRef = ref(props.lessonProgress);

    const openInstrumentless = () => {
        openSoundslice.value = 'instrumentless';
    };

    const openFull = () => {
        openSoundslice.value = 'full';
    };

    const markSongAsComplete = () => {
        if (lessonProgressRef.value === '100') {
            window.showconfirmationmodal({
                title: 'Hold your horses… This will reset all of your progress, are you sure about this?',
                subtitle: 'This cannot be undone.',
                callbacks: {
                    submit: () => {
                        lessonProgressRef.value = null;
                        ContentService.resetContentProgress(props.contentId)
                            .then((resolved) => {
                                if (resolved) {
                                    window.shownotification({
                                        icon: 'check',
                                        text: `Removed! Your progress has been reset.`
                                    })
                                    lessonProgressRef.value = null;
                                }
                            }).catch(() => {
                                lessonProgressRef.value = '100';
                                window.shownotification({
                                    icon: 'error',
                                    text: 'Woops! Something wrong happened, please try again later.'
                                })
                            });
                    },
                },
            });
        } else {
            lessonProgressRef.value = '100';
            ContentService.markContentAsComplete(props.contentId).then(() => {
                window.shownotification({
                    icon: 'check',
                    text: `You completed this song!`
                })
                lessonProgressRef.value = '100';
            }).catch(() => {
                lessonProgressRef.value = null;
                window.shownotification({
                    icon: 'error',
                    text: 'Woops! Something wrong happened, please try again later.'
                })
            })
        }
    };

    const getInstrumentlessLabel = () => {
        return ({
            drumeo: 'PLAY DRUMLESS TRACK',
            singeo: 'PLAY VOICELESS TRACK',
            guitareo: 'PLAY GUITARLESS TRACK',
            pianote: 'PLAY PIANOLESS TRACK'
        }[brand.value]);
    };

    const getBrandSpecificParams = () => {
        return ({
            drumeo: '&show_chords=0',
            singeo: '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
            guitareo: '',
            pianote: '&show_chords=1'
        }[brand.value]);
    };

    const handleCloseSoundslice = () => {
        openSoundslice.value = null;

        document.body.classList.remove('no-scroll', 'dim-sidebar');

        Helpscout.showWidget();
        Intercom.showWidget();
    };

</script>
