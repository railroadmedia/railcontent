<script setup>
import { defineProps, defineEmits, inject } from 'vue';
import SidebarContainer from './SidebarContainer.vue';
import { textColor, borderColor } from '../../../constants/brands.js';
import SidebarPlaylists from '../Playlists/SidebarPlaylists.vue';
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue';
import SearchInput from './SearchInput.vue';

const emit = defineEmits(['onCollapseSidebar']);
const handleCollapse = (val) => {
  emit('onCollapseSidebar', val)
};

const props = defineProps({
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
  pinnedPlaylists: {
    type: Array,
    default: []
  },
  forceSidebarHidden: {
    type: Boolean,
    default: false,
  },
  userId: {
    type: String,
    default: null
  }
});

const sidebarNavigationLinks = inject('sidebarNavigationLinks');

const activePath = (path) => {
  let windowPathArray = window.location.pathname.split('/');
  let pathArray = path.split('/');

  //Page Check
  if (pathArray[3] !== '500-songs-in-5-days' && windowPathArray[3] !== '500-songs-in-5-days') {
    return windowPathArray[2] === pathArray[2];
  }

  // special case for guitareo 500 songs
  if (windowPathArray[3] === '500-songs-in-5-days' && pathArray[3] === '500-songs-in-5-days') {
    return true;
  }
}
</script>

<template>
  <SidebarContainer :isSidebarCollapsed="isSidebarCollapsed" :isSidebarHidden="isSidebarHidden" :brand="brand"
    :forceSidebarHidden="forceSidebarHidden">
    <!-- Sidebar Search -->
    <SearchInput :isSidebarCollapsed="isSidebarCollapsed" :brand="brand" @onCollapse="handleCollapse" />

    <!-- Sidebar Link Sections -->
    <section v-for="(section, i) in this.sidebarNavigationLinks" :key="i"
      class="tw-border-b dark:tw-border-b-[#1E364A]">
      <ul>
        <li v-for="(link, j) in section" :key="j" :class="[activePath(link.path) ? textColor[brand] : '']">
          <a :href="`${link.path}`"
             :target="link.name === 'Shop' ? '_blank' : '_self'"
             :title="[ isSidebarCollapsed ? `${link.name}`: '' ]"
             class="tw-text-sm tw-h-[42px] tw-mb-[5px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
             :class="[activePath(link.path) ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white']"
          >
            <musora-icon 
              :icon-name="activePath(link.path) ? `${link.icon}-filled` : `${link.icon}`" 
              class="tw-w-[24px] tw-mx-4"
            />
            <span class="tw-transition tw-whitespace-nowrap" :class="[isSidebarCollapsed ? 'md:tw-opacity-0' : 'tw-opacity-100']">
              <span class="tw-capitalize">{{ link.name }}</span>
              <!-- Live Indicator -->
              <span v-if="link.name === 'Live' && isLive" class="tw-relative  tw-w-[37px] tw-h-[18px] tw-ml-3">
                <span
                  class="tw-animate-grow-shrink tw-blur-sm tw-origin-center tw-scale-125 tw-absolute tw-left-0 tw-top-0 tw-inline-flex tw-h-full tw-w-full tw-rounded tw-bg-[#F71B26] tw-opacity-75"></span>
                <span
                  class="tw-relative tw-base tw-pt-[2px] tw-pb-0 tw-px-[3px] tw-rounded tw-leading-none tw-text-white tw-bg-[#DC2626] tw-uppercase tw-font-bebas-neue">On-Air</span>
              </span>
            </span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists Section -->
    <sidebar-playlists 
      :isSidebarCollapsed="isSidebarCollapsed" 
      :pinnedPlaylists="pinnedPlaylists"
      :isActivePath="activePath(`/${brand}/playlists`)" 
      :brand="brand" 
      :userId="userId"
    >
    </sidebar-playlists>

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
