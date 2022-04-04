<!-- Playlists -->
<template>
    <section>
        <div class="tw-h-[42px] tw-flex tw-items-center tw-w-full tw-pl-1 tw-border-l-4 tw-border-transparent">
            <div class="tw-text-[#00101D] dark:tw-text-white tw-flex tw-w-full tw-items-center">
            
                <musora-icon icon-name="playlist" width="19" height="19" view-box="0 0 29 29" class="tw-mx-4 tw-mt-1"/>
                
                <div class="tw-transition tw-flex tw-items-center tw-w-full" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">
                    <p class="tw-uppercase tw-text-sm tw-font-bold tw-w-full">Playlists</p>
                    
                    <!-- Add Playlist -->
                    <button class="tw-h-7 tw-w-7 tw-inline-flex tw-items-center tw-flex-shrink-0 tw-justify-center tw-transition tw-rounded-full dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-mr-3">
                        <musora-icon icon-name="plus" width="14" height="14" viewBox="0 0 14 15"/>
                    </button>
                
                </div>
            </div>
        </div>

        <Transition name="fade">
            <div v-if="!isSidebarCollapsed" class="tw-text-sm tw-transition tw-pb-8">
                <!-- Loop through User Playlist -->
                <ul v-if="playlist.length > 0"></ul>
                
                <div v-else class="tw-mt-8 tw-flex tw-flex-col tw-items-center">

                    <div class="tw-h-[50px] tw-w-[50px] tw-flex tw-items-center tw-justify-center tw-rounded-full tw-mb-2 tw-bg-[#3f3f46]/20 dark:tw-bg-[#445F74]/50 tw-text-[#111827] dark:tw-text-[#9EC0DC]">
                    <musora-icon icon-name="playlist" width="21" height="19" view-box="0 0 29 29" class="tw-mx-4 tw-mt-1"/>
                    </div>

                    <span class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-whitespace-nowrap">No Playlist yet</span>
                    <a class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-whitespace-nowrap" href="">Create a playlist now</a>
                </div>
            </div>
        </Transition>

    </section>
</template>
<script>
    export default {
        name: 'PlaylistsSection',
    }
</script>
