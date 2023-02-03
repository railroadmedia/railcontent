<script setup>
    import { onBeforeMount, reactive } from 'vue';
    import playlistService from '../../../services/playlists.js';

    //Props
    const props = defineProps({
            list: {
                type: Object,
                default: {}
            },
            isListView: {
                type: Boolean,
                default: false,
            }
        });

    //Reactive Data
    const state = reactive({ 
            dropdownOpen: false 
        });

    //Methods
    const pinPlaylist = () => {
        playlistServices.pinPlaylist();
    }

</script>
<template>
    <div class="tw-flex tw-flex-col">
        <img :src="list.thumbnail_url" class="tw-w-full tw-mb-1.5">
        <div class="tw-flex tw-items-center">
            <div class="tw-flex tw-flex-col tw-w-full">
                <p class="tw-font-bold tw-capitalize"> {{ list.name }} </p>
                <p class="tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-sm">
                    <span>{{ list.category }}</span> |
                    <span>{{ list.duration }}</span>
                </p>
            </div>
            <div class="tw-relative">
                <button class="" @click.prevent="state.dropdownOpen = !state.dropdownOpen">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Dropdown-->
                <div v-if="state.dropdownOpen" class="tw-w-[157px] tw-shadow tw-rounded-md tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-top-[100%] tw-right-0 tw-py-2">
                    <ul class="tw-text-[13px]">
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
                            <button>Pin to Sidebar</button>
                        </li>
                        <!-- If not public -->
                        <li class=" tw-px-4 tw-py-2">Private</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>