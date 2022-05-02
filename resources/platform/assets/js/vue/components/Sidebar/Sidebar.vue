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
  inject: ['sidebarNavigationLinks'],
  emits: ['onCollapseSidebar'],
  props: {
    isSidebarCollapsed: Boolean,
    isSidebarHidden: Boolean,
    brand: {
      type: String,
      default: 'drumeo'
    },
    isLive: {
      type: Boolean,
      default: false
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
    <section v-for="(section, i) in this.sidebarNavigationLinks" :key="i" class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li v-for="(link, j) in section" :key="j" :class="[pathName === `${link.path}` ? ` ${textColor[brand]}` : '']">
          <a :href="`${link.path}`"
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[pathName === `${link.path}` ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon :icon-name="link.icon" class="tw-w-[24px] tw-mx-4"/>
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
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
