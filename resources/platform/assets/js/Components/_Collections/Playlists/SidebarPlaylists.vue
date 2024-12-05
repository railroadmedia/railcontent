<!-- Playlists -->
<script setup>
//Icons
import { computed, onBeforeMount, inject } from 'vue';
import { storeToRefs } from 'pinia';
import MusoraIcon from '@units/MusoraIcons/MusoraIcon.vue';
import { textColor, borderColor } from '@constants/brands.js';
import PlaylistService from '@services/playlists.js';
import { usePlaylistsStore } from '@stores/playlists';
import { useUserStore } from '@stores/user';

const props = defineProps({
    isSidebarCollapsed: Boolean,
    isActivePath: Boolean,
});

//Inject
const token = inject('csrf_token');
//Pinia Stores
const playlistsStore = usePlaylistsStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

// Format Playlist to add Url and filter it on mount
const formattedPinnedPlaylists = computed(() => {
    return playlistsStore.pinnedPlaylists.map(
        ({ id, ...playlist }, index) => {
            if ( index < 5 ) {
                return ({
                    ...playlist,
                    id,
                    url: `/${brand.value}/playlist/${id}`
                })
            } else {
                return null;
            }
        }
    ).filter(n => n)
});
const formattedUnpinnedPlaylists = computed(() => {
    let unpinnedPlaylists = playlistsStore.sidebarPlaylists.filter((pl) => {
        return playlistsStore.pinnedPlaylists.find((p) => { return p.id === pl.id; }) === undefined;
    })

    return unpinnedPlaylists.map(
        ({ id, ...playlist }, index) => {
            if ( index < 5 ) {
                return ({
                    ...playlist,
                    id,
                    url: `/${brand.value}/playlist/${id}`
                })
            } else {
                return null;
            }
        }
    ).filter(n => n)
});

const handleCreatePlaylist = () => {
    window.openplaylistmodal({ modalType: 'create', brand: brand.value, data: { name: '', category: 'General', thumbnail_url: null, description: ''} });
};

const unpinPlaylist = (item, brand) => {
    PlaylistService.unpinPlaylist(item.id, brand, token)
        .then((response) => {
            if(response.status === 200) {
                //emit event or update pinia
                playlistsStore.unpinPlaylist(item.id)
                //Confirmation
                window.shownotification({
                    icon: 'playlist',
                    text: `${item.name} has been successfully unpinned from the menu.`
                })
            }
        })
        .catch(function (error) {
            if (error.response) {
                //handle error
                window.shownotification({
                    icon: 'error',
                    text: 'Woops! Something wrong happened, please try again later.'
                })
            }
        });
}

const pinPlaylist = (item, brand) => {
    if(playlistsStore.pinnedPlaylists.length < 5){
        PlaylistService.pinPlaylist(item.id, brand, token)
            .then((response) => {
                if (response.status === 200) {
                    //emit event or update pinia
                    playlistsStore.pinPlaylist(item)
                    //show success message
                    window.shownotification({
                        icon: 'playlist',
                        text: `${item.name} has been successfully pinned to the menu.`
                    })
                }
            })
            .catch(function (error) {
                if (error.response) {
                    //handle error
                    window.shownotification({
                        icon: 'error',
                        text: 'Woops! Something wrong happened, please try again later.'
                    })
                }
            });
    }

}

onBeforeMount(()=> {
    // console.log('playlists ', props.pinnedPlaylists)
})
</script>
<template>
    <section>
        <div class="tw-h-[42px] tw-flex tw-items-center tw-w-full">
            <a :href="`/${brand}/playlists`" :title="[isSidebarCollapsed ? 'My Playlists' : '']"
                class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 tw-w-full tw-group"
                :class="[isActivePath ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']">
                <musora-icon icon-name="playlist" class="tw-w-[24px] tw-mx-4" />
                <span class="tw-transition tw-whitespace-nowrap tw-font-bold tw-text-sm tw-uppercase group-hover:tw-underline"
                    :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">My Playlists</span>
            </a>

            <!-- Create Playlist -->
            <button @click="handleCreatePlaylist"
                class="tw-inline-flex tw-items-center tw-flex-shrink-0 tw-justify-center tw-transition tw-h-full tw-w-[42px] tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']" title="Create Playlist">
                <musora-icon icon-name="plus" class="tw-w-[25px]" />
            </button>

        </div>

        <Transition name="fade">
            <div v-if="!isSidebarCollapsed" class="tw-text-sm tw-transition tw-pb-2">
                <ul class="tw-font-open-sans tw-text-[#00101D] dark:tw-text-white tw-text-[14px] tw-overflow-hidden tw-border-b dark:tw-border-b-[#223F57]"
                    v-if="formattedPinnedPlaylists.length > 0 && !playlistsStore.loadingPinnedPlaylists">
                    <p class="tw-text-[#3f3f46] dark:tw-text-[#9EC0DC] tw-text-xs tw-pl-[24px] tw-font-bold tw-mt-2 tw-uppercase">Pinned</p>
                    <!-- Loop through User Pinned Playlists -->
                    <li class="tw-group tw-w-full tw-flex tw-items-center    tw-overflow-hidden dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                        v-for="item in formattedPinnedPlaylists" :key="item.id + '-playlist-li'"
                    >
                        <a :href="item.url"
                            class="tw-max-w-[185px] sm:tw-max-w-none tw-min-w-0 group-hover:tw-max-w-[185px] tw-flex tw-flex-wrap tw-px-[25px] tw-w-full tw-no-underline tw-text-inherit tw-h-[42px] tw-items-center">
                            <span class="tw-truncate tw-capitalize tw-text-sm group-hover:tw-underline">{{ item.name }}</span>
                        </a>
                        <div class="tw-opacity-0 group-hover:tw-opacity-100 tw-w-[30px] tw-shrink-0 tw-items-center tw-justify-center dark:tw-text-white">
                            <button title="Unpin Playlist" @click="unpinPlaylist(item, brand)">
                                <musora-icon icon-name="tack-filled" class="tw-w-[24px] tw-h-[24px] tw-mx-auto"  />
                            </button>
                        </div>
                        <div class="tw-opacity-0 group-hover:tw-opacity-100 dark:tw-text-white tw-w-[42px] tw-shrink-0 tw-items-center tw-justify-center">
                            <a :href="item.playback_url"
                                class="tw-text-[#00101D] dark:tw-text-white"
                                :class="!item.playback_url ? 'tw-opacity-20 tw-pointer-events-none' : 'hover:tw-opacity-80'"
                                :title="item.playback_url ? 'Go To Player' : '' "
                            >
                                <musora-icon icon-name="play-circle-filled" class="tw-w-[24px]" />
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- Skeleton Loader -->
                <div v-if="playlistsStore.loadingPlaylists" class="tw-flex-col tw-w-full tw-animate-pulse">
                    <div v-for="n in 5" :key="n" class="dark:tw-bg-[#102230] tw-bg-[#F5F5F6] tw-h-[32px] tw-mx-[25px] tw-mb-1 tw-border-rounded"></div>
                </div>

                <ul class="tw-font-open-sans tw-text-[#00101D] dark:tw-text-white tw-text-[14px] tw-overflow-hidden"
                    v-if="formattedUnpinnedPlaylists.length > 0 && !playlistsStore.loadingPlaylists">
                    <p class="tw-text-[#3f3f46] dark:tw-text-[#9EC0DC] tw-text-xs tw-pl-[24px] tw-font-bold tw-mt-2 tw-uppercase">Most Recent</p>
                    <!-- Loop through User Unpinned Playlists -->
                    <li class="tw-group tw-w-full tw-flex tw-items-center    tw-overflow-hidden dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                        v-for="item in formattedUnpinnedPlaylists" :key="item.id + '-playlist-li'"
                    >
                        <a :href="item.url"
                           class="tw-max-w-[185px] sm:tw-max-w-none tw-min-w-0 group-hover:tw-max-w-[185px] tw-flex tw-flex-wrap tw-px-[25px] tw-w-full tw-no-underline tw-text-inherit tw-h-[42px] tw-items-center">
                            <span class="tw-truncate tw-capitalize tw-text-sm group-hover:tw-underline">{{ item.name }}</span>
                        </a>
                        <div class="tw-opacity-0 group-hover:tw-opacity-100 tw-w-[30px] tw-shrink-0 tw-items-center tw-justify-center dark:tw-text-white unpinned-pin-container">
                            <button title="Pin Playlist" @click="pinPlaylist(item, brand)">
                                <musora-icon icon-name="tack" class="tw-w-[24px] tw-h-[24px] tw-mx-auto outlined-pin"  />
                                <musora-icon icon-name="tack-filled" class="tw-w-[24px] tw-h-[24px] tw-mx-auto solid-pin tw-hidden"  />
                            </button>
                        </div>
                        <div class="tw-opacity-0 group-hover:tw-opacity-100 dark:tw-text-white tw-w-[42px] tw-shrink-0 tw-items-center tw-justify-center">
                            <a :href="item.playback_url"
                               class="tw-text-[#00101D] dark:tw-text-white"
                               :class="!item.playback_url ? 'tw-opacity-20 tw-pointer-events-none' : 'hover:tw-opacity-80'"
                               :title="item.playback_url ? 'Go To Player' : '' "
                            >
                                <musora-icon icon-name="play-circle-filled" class="tw-w-[24px]" />
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- Skeleton Loader -->
                <div v-if="playlistsStore.loadingPlaylists" class="tw-flex-col tw-w-full tw-animate-pulse">
                    <div v-for="n in 5" :key="n" class="dark:tw-bg-[#102230] tw-bg-[#F5F5F6] tw-h-[32px] tw-mx-[25px] tw-mb-1 tw-border-rounded"></div>
                </div>

                <!-- <div v-else class="tw-flex tw-flex-col tw-items-center">
                    <p class="tw-text-xs tw-italic tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]">Your pinned playlists will show up here.</p>
                </div> -->
            </div>
        </Transition>

    </section>
</template>

<style scoped>
    .unpinned-pin-container:hover .outlined-pin {
        display: none !important;
    }
    .unpinned-pin-container:hover .solid-pin {
        display: block !important;
    }
</style>