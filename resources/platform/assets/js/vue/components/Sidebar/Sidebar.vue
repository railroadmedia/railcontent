<script>
import SidebarContainer from './SidebarContainer.vue'
import { textColor, borderColor } from '../../../constants/brands.js'
import { sidebarLinks } from '../../../constants/sidebar_links.js'
import PlaylistsSection from './PlaylistsSection.vue'
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
import SearchInput from './SearchInput.vue'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, MusoraIcon, PlaylistsSection, SearchInput },
  emits: ['onCollapseSidebar'],
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
  setup(props, { emit }) {
    const handleCollapse = (val) => {
      emit('onCollapseSidebar', val)
    };
    return {
      textColor,
      borderColor,
      sidebarLinks,
      handleCollapse
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
    <SearchInput :isSidebarCollapsed="isSidebarCollapsed" @onCollapse="handleCollapse" />

    <!-- Sidebar Link Sections -->
    <section v-for="(section, i) in sidebarLinks.sections" :key="i" class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li v-for="(link, j) in section.links" :key="j" :class="[pathName === `/${brand}${link.path}` ? ` ${textColor[brand]}` : '']">
          <a :href="`/${brand}${link.path}`" 
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === `/${brand}${link.path}` ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon :icon-name="link.icon" class="tw-w-[24px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a> 
        </li>
      </ul>
    </section>

    <!-- Brand Specific Links -->
    <section v-for="(section, i) in sidebarLinks.brandSections" :key="i">
      <ul v-if="section.brand === brand" class="tw-border-b dark:tw-border-b-[#102230]">
        <li v-for="(link, j) in section.links" :key="j" :class="[pathName === `/${brand}${link.path}` ? ` ${textColor[brand]}` : '']">
          <a :href="`/${brand}${link.path}`" 
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === `/${brand}${link.path}` ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon :icon-name="link.icon" class="tw-w-[24px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a> 
        </li>
      </ul>
    </section>

    <!-- Forum -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li :class="[pathName === `${brand}/forums` ? ` ${textColor[brand]}` : '']">
          <a :href="`/${brand}/forums`" 
             :title="[ isSidebarCollapsed ? 'Forums': '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === `${brand}/forums` ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon icon-name="messages" class="tw-w-[24px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">Forums</span>
          </a> 
        </li>
      </ul>
    </section>   

    <!-- My List -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li :class="[pathName === `${brand}/profile` ? ` ${textColor[brand]}` : '']">
          <a :href=" `/${brand}/profile/` " 
             :title="[ isSidebarCollapsed ? 'My List': '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === `${brand}/profile` ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon icon-name="playlist" class="tw-w-[24px] tw-mx-4 tw-mt-1"/>
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