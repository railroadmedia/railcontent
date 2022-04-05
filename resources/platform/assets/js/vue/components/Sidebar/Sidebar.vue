<script>
import SidebarContainer from './SidebarContainer.vue'
import { textColor, borderColor } from '../../../constants/brands.js'
import { sidebarLinks } from '../../../constants/sidebar_links.js'
import PlaylistsSection from './PlaylistsSection.vue'
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, MusoraIcon, PlaylistsSection },
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
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === link.path ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon :icon-name="link.icon" class="tw-w-[20px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a> 
        </li>
      </ul>
    </section>

    <!-- Brand Specific Links -->
    <section v-for="(section, i) in sidebarLinks.brandSections" :key="i">
      <ul v-if="section.brand === brand" class="tw-border-b dark:tw-border-b-[#102230]">
        <li v-for="(link, j) in section.links" :key="j" :class="[pathName === link.path ? ` ${textColor[brand]}` : '']">
          <a :href="`${link.path}?brand=${brand}`" 
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === link.path ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon :icon-name="link.icon" class="tw-w-[20px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a> 
        </li>
      </ul>
    </section>

    <!-- Forum -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li :class="[pathName === '/members/forums' ? ` ${textColor[brand]}` : '']">
          <a :href="`/members/forums?brand=${brand}`" 
             :title="[ isSidebarCollapsed ? 'Forums': '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === '/members/forums' ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon icon-name="messages" class="tw-w-[20px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">Forums</span>
          </a> 
        </li>
      </ul>
    </section>   

    <!-- My List -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li :class="[pathName === '/members/profile' ? ` ${textColor[brand]}` : '']">
          <a :href=" `/members/profile/?brand=${brand }` " 
             :title="[ isSidebarCollapsed ? 'My List': '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === '/members/profile' ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mx-4 tw-mt-1"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">My List</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists Section -->
    <!-- <playlists-section
      :isSidebarCollapsed="isSidebarCollapsed"
      :playlist="playlist"
      :pathName="pathName"
      :brand="brand"
    ></playlists-section> -->

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