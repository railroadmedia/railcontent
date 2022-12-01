<!-- Playlists -->
<script setup>
//Icons
import { ref } from 'vue'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
import { textColor, borderColor } from '../../../constants/brands.js'

const props = defineProps({
    isSidebarCollapsed: Boolean,
    playlists: Array,
    brand: String,
    isActivePath: Boolean,
    userId: String,
});

const emit = defineEmits('onCreatePlaylist');

// Format Playlist to add Url and filter it on mount
const formattedPlaylists = ref(
    props.playlists.map(
        ({ id, ...playlist }, index) => {
            if (index < 5) {
                return ({
                    ...playlist,
                    url: `/${props.brand}/playlist/${id}`
                })
            } else {
                return null;
            }
        }
    ).filter(n => n)
);

const handleCreatePlaylist = () => {
    console.log('internal create')
    emit('onCreatePlaylist');
};
</script>
<template>
    <section>
        <div class="tw-h-[42px] tw-flex tw-items-center tw-w-full">
            <a :href="`/${brand}/lists/my-list`" :title="[isSidebarCollapsed ? 'Playlists' : '']"
                class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-w-full"
                :class="[isActivePath ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']">
                <musora-icon icon-name="playlist" class="tw-w-[24px] tw-mx-4" />
                <span class="tw-transition tw-whitespace-nowrap tw-font-bold tw-text-sm tw-uppercase"
                    :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">Playlists</span>
            </a>

            <!-- Create Playlist -->
            <button
                @click="handleCreatePlaylist"
                class="tw-inline-flex tw-items-center tw-flex-shrink-0 tw-justify-center tw-transition tw-h-full tw-w-[42px] tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']" title="Create Playlist">
                <musora-icon icon-name="plus" class="tw-w-[20px]" />
            </button>

        </div>

        <Transition name="fade">
            <div v-if="!isSidebarCollapsed" class="tw-text-sm tw-transition tw-pb-8">
                <ul class="tw-font-open-sans tw-text-[#00101D] dark:tw-text-white tw-text-[14px] tw-overflow-hidden"
                    v-if="formattedPlaylists.length > 0">
                    <!-- Loop through User Playlists -->
                    <li class="tw-w-full tw-flex tw-flex-wrap tw-overflow-hidden" v-for="({ url, id, title }) in formattedPlaylists"
                        :key="id + '-playlist-li'">
                        <a :href="url" class="tw-flex tw-flex-wrap tw-px-[25px] tw-w-full tw-no-underline tw-text-inherit tw-py-[12px] dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]">
                            <span class="tw-min-w-0 tw-truncate">{{ title }}</span>
                        </a>
                    </li>
                    <li class="tw-flex tw-w-full tw-pt-[4px]" v-if="playlists.length > 5">
                        <a class="hover:tw-underline tw-px-[25px] tw-py-[12px] tw-flex tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-[14px]" :href="`/playlists/all/${userId}`">See all</a>
                    </li>
                </ul>

                <div v-else class="tw-mt-8 tw-flex tw-flex-col tw-items-center">
                    <div
                        class="tw-h-[50px] tw-w-[50px] tw-flex tw-items-center tw-justify-center tw-rounded-full tw-mb-2 tw-bg-[#3f3f46]/20 dark:tw-bg-[#445F74]/50 tw-text-[#111827] dark:tw-text-[#9EC0DC]">
                        <musora-icon icon-name="playlist" class="tw-mx-4 tw-mt-1" />
                    </div>

                    <span class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-whitespace-nowrap">No Playlist
                        yet</span>
                    <a class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-whitespace-nowrap hover:tw-underline"
                        :href="`/playlists/create`">Create a playlist now</a>
                </div>
            </div>
        </Transition>

    </section>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 150ms ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>