<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '@services/playlists.js';
    import { usePlaylistsStore } from '@stores/playlists';
    import LoadingSpinner from '@units/LoadingSpinner/LoadingSpinner.vue';
    import MuButton from '@units/Button/MuButton';

    //Emits
    const emit = defineEmits(['onCloseModal']);

    //Inject
    const token = inject('csrf_token');

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: 'drumeo'
        },
        data: {
            type: Object,
            default: {}
        },
        mode: {
            type: String,
            default: null
        },
        index: {
            type: Number,
            default: null
        }
    });

    //--------Computed Properties--------//
    const isSong = computed( ()=> {
        return props.data.type === 'song';
    })

    const ctaUrl = computed(() => {
        if(isSong.value){
            return `/${props.brand}/songs`;
        } else {
            return `https://${props.brand}.com/${props.brand === 'drumeo' ? 'drum' : ''}shop`;
        }
    })

    const ctaText = computed(() => {
        if(isSong.value){
            return 'Click Here To Learn More and Upgrade';
        } else {
            return 'Click Here To Learn More';
        }
    })

    //--------Reactive Data--------//
    const state = reactive({
        isLoading: false,
        title: '',
        packTitle: '',
        packUrl: '',
        thumbnail: ''
    })

    //-----------Lifecycle Hooks -----------//
    onBeforeMount(()=> {
        //Get Modal Data
        const title = props.data.title;
        const album = props.data.album;
        const thumbnail = props.data.thumbnail_url;
        const message = props.data.need_access_message;
        state.thumbnail = props.data.type === 'assignment' ? props.data.thumbnail_url : thumbnail;
        state.title = title ? title : '';
        state.album = album ? album : '';
        state.packTitle = props.data.type === 'song' ? '' : props.data.parent_title;
        state.message = message ? message: '';
    })
</script>

<template>
    <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
        <p class="dark:tw-text-white tw-text-center tw-mb-4">
        <span class="lg:tw-line-clamp-2" v-html="state.message"></span>
        </p>
<!--        <template v-if="!isSong">-->
<!--            <p class="dark:tw-text-white tw-text-center tw-mb-4">-->


<!--                <span class="tw-font-bold tw-whitespace-nowrap">{! state.message !}</span>-->
<!--            </p>-->
<!--        </template>-->
<!--        <template v-else>-->
<!--            <p class="dark:tw-text-white tw-text-center tw-mb-4">-->
<!--                This Song content is part of our Musora+ Membership-->
<!--            </p>-->
<!--        </template>-->
        <!-- Lesson Thumbnail -->
        <div class="tw-relative tw-inline-flex tw-overflow-hidden tw-rounded tw-shrink-0 tw-mb-8"
             :class="!isSong ? 'tw-aspect-video tw-w-[175px]' : 'tw-aspect-square tw-w-[120px]'"
        >
            <!-- Image Conatiner -->
            <img
                :src="`https://musora.com/cdn-cgi/image/width=175/${state.thumbnail}`"
                alt="playlist thumbnail"
                class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
            <!-- Image Mask -->
            <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                <img class="tw-h-full tw-object-contain"
                        :src="`https://musora.com/cdn-cgi/image/width=175/${state.thumbnail}`"
                        alt="playlist thumbnail"
                >
            </div>
        </div>

        <div class="tw-flex tw-items-center tw-justify-end tw-w-full">
            <MuButton :is-link="true" :href="ctaUrl" variant="secondary">{{ ctaText }}</MuButton>
        </div>
    </div>
</template>
../../_Units/Button/MuButton.js