<script setup>
    import { onBeforeMount, ref, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import PlaylistService from '../../../../services/playlists.js';

    //-----------Props-----------//
    const props = defineProps({
        brand: {
            type: String,
            default: "drumeo"
        },
        list: {
            type: Object,
            default: {}
        },
        isListView: {
            type: Boolean,
            default: false,
        },
        token: {
            type: String,
            required: true, 
        }
    });

    //-----------Refs-----------//
    const dropdownTarget = ref(null)

    //-----------Reactive Data-----------//
    const state = reactive({ 
            dropdownOpen: false,
            isPinned: false,
        });

    //-----------Methods-----------//

    //Handle Pin/Unpin Request
    const pinHandler = (id, brand) => {
        if(!state.isPinned) { //If not pinned
            PlaylistService.pinPlaylist(id, brand, props.token)
                .then((response) => {
                    if(response.ok) { 
                        //handle pin
                        state.isPinned = true;
                        //emit event or update pinia
                        //show success message
                    } else {
                        //handle error  
                    }
                })
        } else { //if pinned
            PlaylistService.unpinPlaylist(id, brand, props.token)
                .then((response) => {
                    if(response.ok) { 
                        //handle unpin
                        state.isPinned = false;
                        //emit event or update pinia
                    } else {
                        //handle error
                    }
                })
        }


    }

    //-----------Lifecycle Methods-----------//
    
    onBeforeMount(() => {
        //check if it's pinned with request? Or prerender?
        state.isPinned = props.list.pinned;
    });    

</script>
<template>
    <div class="tw-group tw-relative" 
         :class="props.isListView ? 'tw-h-[52px] tw-flex tw-flex-row tw-w-full tw-items-center tw-transition-colors tw-py-0.5 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 even:tw-bg-white dark:even:tw-bg-[#081825]' : 'tw-grid tw-grid-rows-5 tw-grid-cols-5 tw-gap-1' "
    >
        <!-- Playlist thumbnail -->
        <a :href="list.url"
            class="tw-relative tw-overflow-hidden tw-bg-white dark:tw-bg-[#081825] tw-aspect-square"
           :class="props.isListView ? 'tw-h-[48px] tw-w-[48px] tw-rounded tw-shrink-0' : 'tw-row-span-5 tw-col-span-5 tw-rounded-lg'"
        >
            <img
                :src="list.thumbnail_url"
                alt="playlist thumbnail"
                class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
            <!-- hover overlay -->
            <div v-if="!props.isListView" 
                 class="tw-h-full tw-w-full tw-absolute tw-top-0 tw-left-0 tw-transition-colors tw-z-10 group-hover:tw-bg-black/30">
            </div>
        </a>  

        <!-- PLAYLIST INFO: clickable link -->
        <a  :href="list.url"
            class="tw-flex tw-w-full tw-text-[#0D0D0D] dark:tw-text-white"
            :class="props.isListView ? '' : 'tw-col-span-4'"
        >
            <div :class="props.isListView ? 'tw-w-full tw-grid tw-grid-cols-10 tw-items-center' : '' ">
                <!--name-->
                <p class="tw-font-bold tw-capitalize" :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-2 tw-pl-2 md:tw-pl-[19px]' : '' ">
                    <span class="tw-mr-auto">{{ list.name }}</span> 
                </p>
                <!--description-->
                <p class="tw-font-bold tw-capitalize tw-truncate tw-hidden"
                    :class=" props.isListView ? 'tw-flex tw-pl-2 tw-col-span-5 md:tw-inline-flex' : '' " 
                > 
                    <span class="tw-truncate tw-max-w-[512px] tw-pr-4">{{ list.description }}</span>
                </p>
                <!--category / duration -->
                <div class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm tw-flex" 
                    :class="props.isListView ? 'tw-col-span-3 tw-w-full tw-pl-2 md:tw-pl-0 md:tw-text-base' : ''"
                >
                    <div :class="props.isListView ? 'md:tw-w-1/2 tw-inline-flex tw-items-center tw-justify-center' : '' ">
                        <span>{{ list.category }}</span>
                        <span class="tw-mx-1 tw-leading-none" :class="props.isListView ? 'md:tw-hidden' : '' ">|</span>
                    </div> 
                    <div :class="props.isListView ? 'md:tw-w-1/2 md:tw-w-1/2 tw-text-center' : '' ">
                        {{ list.duration || "0:00" }}
                    </div>
                </div>
            </div>
            <!-- Pinned Icon -->
            <div class="tw-inline-flex tw-items-center" 
                 :class="[ !props.isListView ? 'tw-absolute tw-top-3 tw-right-3' : 'tw-mx-4 xl:tw-mx-8',`tw-text-${brand}`, { 'tw-opacity-0' : !list.pinned } ]"
            >
                <musora-icon icon-name="tack" class="tw-w-[24px] tw-h-[24px] tw-mx-auto tw-hidden md:tw-flex" />
            </div>
        </a>
        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end" 
             :class="props.isListView ? 'tw-w-[100px] md:tw-justify-center md:tw-pr-[22px]' : 'tw-col-span-1'" 
        >
            <div class="tw-relative " 
                    v-click-outside="()=>{ state.dropdownOpen = false }"
            >
                <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#445F74] dark:tw-text-[#7E9AB1] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0" @click.prevent="state.dropdownOpen = !state.dropdownOpen" :class="props.isListView ? 'md:tw-rotate-90' : ''">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Dropdown-->
                <div v-if="state.dropdownOpen" class="tw-w-[157px] tw-shadow tw-rounded-md tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-top-[100%] tw-right-0 tw-py-2">
                    <ul class="tw-text-sm">
                        <li class=" tw-px-4 tw-py-2">
                            <button>Share</button>
                        </li>
                        <li class=" tw-px-4 tw-py-2">
                            <button>Edit</button>
                        </li>
                        <li class=" tw-px-4 tw-py-2">
                            <button>Delete</button>
                        </li>
                        <li class=" tw-px-4 tw-py-2">
                            <button>Duplicate</button>
                        </li>
                        <li class=" tw-px-4 tw-py-2">
                            <button @click.prevent="pinHandler(list.id)">Pin to Sidebar</button>
                        </li>
                        <!-- If not public -->
                        <li class=" tw-px-4 tw-py-2">Private</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>