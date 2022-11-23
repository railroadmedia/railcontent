<!-- Playlists -->
<script>
    //Icons
    import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
    import { textColor, borderColor } from '../../../constants/brands.js'
    export default {
        name: 'PlaylistsSection',
        components: { MusoraIcon },
        props: {
            isSidebarCollapsed: Boolean,
            playlist: Array,
            brand: String,
            isActivePath: Boolean
        },
        setup(props) {
            return {
                textColor,
                borderColor,
            }
        },
    }
</script>
<template>
    <section>
        <div class="tw-h-[42px] tw-flex tw-items-center tw-w-full">

            <a :href=" `/${brand}/lists/my-list` " 
                :title="[ isSidebarCollapsed ? 'Playlists': '' ]"
                class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-w-full"
                :class="[isActivePath ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
            >
                <musora-icon icon-name="playlist" class="tw-w-[24px] tw-mx-4"/>
                <span class="tw-transition tw-whitespace-nowrap tw-font-bold tw-text-sm tw-uppercase" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">Playlists</span>
            </a>
                
            <!-- Add Playlist -->
            <button class="tw-inline-flex tw-items-center tw-flex-shrink-0 tw-justify-center tw-transition tw-h-full tw-w-[42px] tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                    :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']"
                    title="Create Playlist"
            >
                <musora-icon icon-name="plus" class="tw-w-[20px]"/>
            </button>
            
        </div>

        <Transition name="fade">
            <div v-if="!isSidebarCollapsed" class="tw-text-sm tw-transition tw-pb-8">
                
                <ul v-if="playlist.length > 0">
                    <!-- Loop through User Playlist -->
                </ul>
                
                <div v-else class="tw-mt-8 tw-flex tw-flex-col tw-items-center">

                    <div class="tw-h-[50px] tw-w-[50px] tw-flex tw-items-center tw-justify-center tw-rounded-full tw-mb-2 tw-bg-[#3f3f46]/20 dark:tw-bg-[#445F74]/50 tw-text-[#111827] dark:tw-text-[#9EC0DC]">
                        <musora-icon icon-name="playlist" class="tw-w-[] tw-mx-4 tw-mt-1"/>
                    </div>

                    <span class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-whitespace-nowrap">No Playlist yet</span>
                    <a class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-whitespace-nowrap hover:tw-underline" href="">Create a playlist now</a>
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