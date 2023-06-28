<script setup>
    import { onBeforeMount, watch, ref, inject, computed, reactive } from 'vue';
    import MusoraIcon from '../../MusoraIcons/MusoraIcon.vue';
    import PlaylistDropdown from '../PlaylistDropdown.vue';
    import PlaylistThumbnail from '../PlaylistThumbnail.vue';

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

    //-----------Computed Props-----------//
    const duration_formated = computed(()=> {
        return props.list.duration_formated === '00:00' ? '0:00' : props.list.duration_formated.replace(/^0(?:0:0?)?/, '');
    })
    const description = computed(() => {
        return props.list.description.replace(/(<([^>]+)>)/gi, "");
    })

    //-------------Refs-------------//
    const dropdownTarget = ref(null)

    //-----------Reactive Data-----------//
    const state = reactive({
        dropdownOpen: false,
        dropdownTop: false,
        isPinned: false,
        isPrivate: true,
    });

    //-----------Static Data-----------//
    const dropdownOptions = [
        {
            name: "Share",
            action: "sharePlaylist"
        },
        {
            name: "Edit",
            action: "editPlaylist"
        },
        {
            name: "Delete",
            action: "deletePlaylist"
        },
        {
            name: "Duplicate",
            action: "duplicatePlaylist"
        },
        {
            name: "Pin To Sidebar",
            action: "pinPlaylist"
        },
        {
            name: "Private",
            action: "privateToggle"
        },
    ]

    //-----------Watchers-----------//
    watch(props.list, async (newList) => {
        state.isPinned = newList.pinned;
    })

    //-----------Methods-----------//

    //Check Dropdown Distance
    const GetElementDistance = el => {
        let rect = el.getBoundingClientRect();
        let spaceBelow = window.innerHeight - rect.bottom;
        if(spaceBelow < 240) {
            state.dropdownTop = true;
        } else {
            state.dropdownTop = false;
        }
    }

    //Handle Dropdown Trigger
    const dropdownTriggerHandler = target => {
        GetElementDistance(event.target);
        state.dropdownOpen = !state.dropdownOpen;
    }

    //---------Lifecycle Methods---------//

    onBeforeMount(() => {
        //check if it's pinned with request? Or prerender?
        state.isPinned = props.list.pinned ? true : false;
        state.isPrivate = props.list.private;
    });

</script>
<template>
    <div class="tw-group tw-relative"
         :class="isListView ? 'tw-h-[56px] tw-flex tw-flex-row tw-w-full tw-items-center tw-transition-colors tw-py-1 hover:tw-bg-[#E6E7E9]/40 dark:hover:tw-bg-[#081825]/50 even:tw-bg-white dark:even:tw-bg-[#081825]' : 'tw-grid tw-grid-rows-5 tw-grid-cols-5 tw-gap-1' "
    >
        <!-- Playlist thumbnail -->
        <PlaylistThumbnail
            :list="list"
            :isListView="isListView"
            :brand="brand"
        />

        <!-- PLAYLIST INFO: clickable link -->
        <a  :href="list.url"
            class="tw-flex tw-w-full tw-text-[#0D0D0D] dark:tw-text-white"
            :class="props.isListView ? '' : 'tw-col-span-4'"
        >
            <div class="tw-w-full" :class="props.isListView ? 'tw-grid tw-grid-cols-10 tw-items-center' : '' ">
                <!--name-->
                <p class="tw-font-bold tw-truncate tw-w-full"
                   :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-7 xl:tw-col-span-2 tw-pl-2 md:tw-pl-[19px] tw-pr-2' : '' "
                >
                    {{ list.name }}
                </p>
                <!--description-->
                <p class="tw-truncate tw-hidden"
                    :class=" props.isListView ? 'tw-hidden xl:tw-inline-flex  xl:tw-col-span-5' : '' "
                >
                    <span class="tw-truncate tw-max-w-[512px] tw-pl-2 tw-pr-4 ">{{ description }}</span>
                </p>
                <!--category / duration -->
                <div class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-sm tw-flex"
                    :class="props.isListView ? 'tw-col-span-10 md:tw-col-span-3 tw-w-full tw-pl-2 md:tw-pl-0 md:tw-text-base' : ''"
                >
                    <div :class="props.isListView ? 'md:tw-w-1/2 tw-inline-flex tw-items-center tw-justify-center' : '' ">
                        <span v-if="list.category" :class="{'tw-text-center' : props.isListView}">
                            {{ list.category }}
                            <span class="tw-mx-1 tw-leading-none" :class="props.isListView ? 'md:tw-hidden' : '' ">|</span>
                        </span>
                    </div>
                    <div :class="props.isListView ? 'md:tw-w-1/2 md:tw-w-1/2 tw-inline-flex tw-justify-center tw-items-center' : '' ">
                        <span>{{ duration_formated }}</span>
                    </div>
                </div>
            </div>
            <!-- Pinned Icon -->
            <div class="tw-inline-flex tw-items-center tw-transition-colors"
                 :class="[ !props.isListView ? 'tw-z-20 tw-absolute tw-top-2 tw-right-2 tw-bg-[rgba(0,12,23,0.5)] tw-rounded-full tw-p-1.5' : 'tw-px-4 xl:tw-px-8',`dark:tw-text-white`, { 'tw-opacity-0' : !state.isPinned } ]"
            >
                <musora-icon icon-name="tack" class="tw-w-[20px] tw-h-[20px] tw-mx-auto tw-hidden md:tw-flex" />
            </div>
        </a>

        <!-- PLAYLISTS OPTIONS DROPDOWN -->
        <div class="tw-inline-flex tw-items-center tw-justify-end"
             :class="props.isListView ? 'tw-w-[100px] md:tw-justify-center md:tw-pr-[22px]' : 'tw-col-span-1'"
        >
            <div class="tw-relative " v-click-outside="()=>{ state.dropdownOpen = false }">
                <button class="tw-btn-primary tw-btn-small tw-btn-circle tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#E0E0E1] tw-transition-colors tw-p-0 tw-mb-0 focus-visible:tw-outline focus-visible:tw-outline-[#111827] dark:focus:tw-outline-[#9EC0DC] focus-visible:tw-outline-2 tw-rotate-0"
                        :class="props.isListView ? 'md:tw-rotate-90' : ''"
                        title="Playlist Options"
                        @click.prevent="dropdownTriggerHandler($event)"
                >
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Dropdown-->
                <PlaylistDropdown
                    :brand="brand"
                    :dropdownTop="state.dropdownTop"
                    :is-private="state.isPrivate"
                    :is-pinned="state.isPinned"
                    :dropdownOptions="dropdownOptions"
                    :data="list"
                    :is-open="state.dropdownOpen"
                    type="playlist"
                    @closeDropdown="state.dropdownOpen = false"
                    @pinItem="(val) => state.isPinned = val"
                />
            </div>
        </div>
    </div>
</template>
