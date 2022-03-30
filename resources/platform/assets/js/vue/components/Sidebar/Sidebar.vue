<script>
import SidebarContainer from './SidebarContainer.vue'
import SidebarSection from './SidebarSection.vue'
import SidebarLink from './SidebarLink.vue'
import { textColor, borderColor } from '../../../constants/brands.js'
import { sidebarLinks } from '../../../constants/sidebar_links.js'
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, SidebarSection, SidebarLink, MusoraIcon },
  props: {
    isSidebarCollapsed: Boolean,
    isSidebarHidden: Boolean,
    brand: {
      type: String,
      default: 'drumeo'
    },
    playlist: {
      type: Array,
      default: []
    }
  },
  setup(props) {
    return {
      textColor,
      borderColor,
      sidebarLinks
    }
  },
  computed: {
    pathName() {
      return window.location.pathname;
    }
  },
}
</script>

<template>
  <SidebarContainer :isSidebarCollapsed="isSidebarCollapsed" 
                    :isSidebarHidden="isSidebarHidden"
                    :brand="brand"
  >
    
    <!-- Sidebar Search -->
    <div class="tw-m-4 tw-relative dark:tw-bg-[#000C17] tw-bg-[#E6E7E9] tw-rounded">
      <musora-icon icon-name="search" class="tw-absolute tw-top-3 tw-left-3 dark:tw-text-[#9EC0DC] tw-z-0"/>
      <input type="text" 
            placeholder="search" 
            class="tw-relative tw-z-10 tw-w-full tw-h-[37px] tw-border-none tw-text-xs tw-rounded tw-transition-color dark:tw-text-[#9EC0DC] tw-bg-transparent focus:tw-outline focus:tw-outline-1 dark:focus:tw-outline-[#9EC0DC] tw-shadow-none focus:tw-ring-transparent" 
            :class="[isSidebarCollapsed ? 'placeholder:tw-text-transparent tw-pl-6' : 'dark:placeholder:tw-text-[#9EC0DC] tw-pl-8']"
            @focus="isSidebarCollapsed = false"
      />  
    </div>

    <!-- Sidebar Link Sections -->
    <section v-for="(section, i) in sidebarLinks.sections" :key="i" class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li v-for="(link, j) in section.links" :key="j" :class="[pathName === link.path ? ` ${textColor[brand]}` : '']">
          <a :href="`${link.path}?brand=${brand}`" 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === link.path ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon :icon-name="link.icon" class="tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Brand Specific Links -->
    <section v-for="(section, i) in sidebarLinks.brandSections" :key="i">
      <ul v-if="section.brand === brand" class="tw-border-b dark:tw-border-b-[#102230]">
        <li v-for="(link, j) in section.links" :key="j" >
          <a :href="`${link.path}?brand=${brand}`"  
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === link.path ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon :icon-name="link.icon" :view-box="link.viewBox" :height="link.height" :width="link.width" class="tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Forum -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li>
          <a :href=" `/members/forums?brand=${brand }` " 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === '/forums' ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
             <musora-icon icon-name="messages" class="tw-mx-4"/>
             <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">Forums</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists -->
    <section>
      <div class="tw-h-[42px] tw-flex tw-items-center tw-w-full tw-pl-1 tw-border-l-4 tw-border-transparent">
        <div class="tw-text-[#00101D] dark:tw-text-white tw-flex tw-w-full tw-items-center">
          
          <musora-icon icon-name="playlist" width="19" height="19" view-box="0 0 29 29" class="tw-mx-4 tw-mt-1"/>
          
          <div class="tw-transition tw-flex tw-items-center tw-w-full" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">
            <p class="tw-uppercase tw-text-sm tw-font-bold tw-w-full">Playlists</p>
            
            <!-- Add Playlist -->
            <button class="tw-h-7 tw-w-7 tw-inline-flex tw-items-center tw-flex-shrink-0 tw-justify-center tw-transition tw-rounded-full hover:tw-bg-[#3f3f46]/10 dark:hover:tw-bg-[#445F74]/20 tw-mr-3">
              <musora-icon icon-name="plus" width="14" height="14" viewBox="0 0 14 15"/>
            </button>
          
          </div>
        </div>
      </div>

      <Transition name="fade">
        <div v-if="!isSidebarCollapsed" class="tw-text-sm tw-transition tw-pb-8">
          <!-- Loop through User Playlist -->
          <ul v-if="playlist.length"></ul>
          
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

  </SidebarContainer>
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