<script setup>
    import { inject, onBeforeMount, computed, reactive } from 'vue';
    import PlaylistService from '../../../../services/playlists.js';
    import { usePlaylistsStore } from '../../../../stores/playlists';
    import LoadingSpinner from '../../LoadingSpinner/LoadingSpinner.vue';

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

    //--------Reactive Data--------//
    const state = reactive({
        isLoading: false,
        title: '',
        packTitle: '',
        packUrl: '',
        thumbnail: ''
    })

    //-----------Methods-----------//


    //-----------Lifecycle Hooks -----------//
    onBeforeMount(()=> {
        //Get Modal Data
        const title = props.data.fields.find(field => field.key === 'title');
        const album = props.data.fields.find(field => field.key === 'album');
        const thumbnail = props.data.data.find(data => data.key === 'original_thumbnail_url');
        state.thumbnail = props.data.type === 'assignment' ? props.data.thumbnail_url : thumbnail.value;
        state.title = title ? title.value : '';
        state.album = album ? album.value : '';
        state.packTitle = props.data.type === 'song' ? '' : props.data.parent.title;
    })
</script>

<template>
    <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center">
        <h2 class="tw-text-2xl tw-font-bold tw-w-full tw-text-[#0D0D0D] dark:tw-text-white tw-text-center tw-mb-3">
            Content Unavailable  
        </h2>
        <template v-if="!isSong">   
            <p class="dark:tw-text-white tw-text-center tw-mb-4">
                <span class="tw-font-bold tw-whitespace-nowrap">{{ state.title }}</span>
                is part of a premium pack 
                <span class="tw-font-bold tw-whitespace-nowrap">{{ state.packTitle }}</span>.
            </p>
        </template>
        <template v-else>
            <p class="dark:tw-text-white tw-text-center tw-mb-4">
                This Song content is part of our Musora+ Membership
            </p>
        </template>
        <!-- Lesson Thumbnail -->
        <div class="tw-relative tw-inline-flex tw-overflow-hidden tw-rounded tw-shrink-0 tw-mb-8"
             :class="!isSong ? 'tw-aspect-video tw-w-[175px]' : 'tw-aspect-square tw-w-[120px]'"
        >
            <!-- Image Conatiner -->
            <img
                :src="`https://musora.com/cdn-cgi/image/width=175/${state.thumbnail}`"
                alt="playlist thumbnail"
                class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                :class="{ '' : needAccess }"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
            <!-- Image Mask -->
            <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                <img class="tw-h-full tw-object-contain" 
                        :class="{ '' : needAccess }"
                        :src="`https://musora.com/cdn-cgi/image/width=175/${state.thumbnail}`" 
                        alt="playlist thumbnail"
                >
            </div>
        </div>

        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full">
            <!-- Go To Shop -->
            <a v-if="!isSong"
               :href="`https://${brand}.com/shop`" 
               target="_blank"
               class="tw-btn-secondary tw-text-[#0D0D0D] dark:tw-text-white">
               Click Here To Learn More
            </a>
            <!-- Go To Songs -->
            <a v-else :href="`/${brand}/songs`" class="tw-btn-secondary tw-text-[#0D0D0D] dark:tw-text-white">
                Click Here To Learn More and Upgrade
            </a>
        </div>
    </div>
</template>
