<script setup>
    import { onBeforeMount, ref, reactive } from 'vue';
    import { onClickOutside } from '@vueuse/core'
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

    //Detect Click Outside of Dropdown
    onClickOutside(dropdownTarget, () => state.dropdownOpen = false );

    //Handle Pin/Unpin Request
    const pinHandler = (id, brand) => {
        if(!state.isPinned) { //If not pinned
            PlaylistService.pinPlaylist(id, brand)
                .then((response) => {
                    if(response.ok) { 
                        //handle pin
                        console.log(`${id} was pinned`)
                        state.isPinned = true;
                        //emit event or update pinia
                        //show success message
                    } 
                    return Promise.reject(response);
                })
                .catch(error => { 
                    //handle error
                    console.log('ERROR', error )
                    //show error message
                })
        } else { //if pinned
            PlaylistService.unpinPlaylist(id, brand)
                .then((response) => {
                    if(response.ok) { 
                        //handle unpin
                        console.log(`${id} was unpinned`)
                        state.isPinned = false;
                        //emit event or update pinia
                    } 
                    return Promise.reject(response);
                })
                .catch(error => { 
                    //handle error
                    console.log('ERROR', error ) 
                    //show error message
                })
        }


    }

    //-----------Lifecycle Methods-----------//
    
    onBeforeMount(() => {
        //check if it's pinned with request? Or prerender?
    });    

</script>
<template>
    <div class="tw-flex " 
         :class="props.isListView ? 'tw-flex-row  tw-h-[52px]' : 'tw-flex-col' "
    >
        <img :src="list.thumbnail_url" 
             class="tw-mb-1.5 tw-w-full" 
             :class="props.isListView ? 'tw-max-w-[48px]' : ''"
        >
        <div class="tw-flex tw-items-center">
            <div class="tw-flex tw-w-full"
                 :class="props.isListView ? 'tw-flex-row tw-items-center' : 'tw-flex-col' "
            >
                <p class="tw-font-bold tw-capitalize tw-inline-flex tw-max-w-[300px]"><span class="tw-mr-auto">{{ list.name }}</span> </p>
                <p class="tw-font-bold tw-capitalize tw-truncate tw-w-full tw-max-w-[512px]"
                   :class=" props.isListView ? 'tw-flex' : 'tw-hidden' " 
                > 
                    <span class="tw-truncate">{{ list.description }}</span>
                </p>
                <p class="tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-sm">
                    <span>{{ list.category }}</span> |
                    <span>{{ list.duration }}</span>
                </p>
            </div>
            <div class="tw-relative" ref="dropdownTarget">
                <button class="" @click.prevent="state.dropdownOpen = !state.dropdownOpen">
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