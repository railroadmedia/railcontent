<script>
import SidebarContainer from './SidebarContainer.vue'
import SidebarSection from './SidebarSection.vue'
import SidebarLink from './SidebarLink.vue'
import { textColor, borderColor } from '../../constants/brands.js'
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
import SpriteSheet from '../MusoraIcons/SpriteSheet.vue'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, SidebarSection, SidebarLink, SpriteSheet, MusoraIcon },
  props: ['brand', 'isSidebarCollapsed'],
  setup() {
    return {
      textColor,
      borderColor
    }
  },
  data() {
    return {
      sections: [
        {
          links: [
            {
              name: 'Home',
              path: '/members',
              icon: 'home',
            },
            {
              name: 'Method',
              path: '/members/method',
              icon: 'method',
            },
            {
              name: 'Songs',
              path: '/members/songs',
              icon: 'headphones',
            },
            {
              name: 'Coaches',
              path: '/members/coaches',
              icon: 'whistle',
            }
          ]
        },
        {
          links: [
            {
              name: 'Packs',
              path: '/members/packs',
              icon: 'box',
            },
            {
              name: 'Quick Tips',
              path: '/members/quick-tips',
              icon: 'light-bulb',
            },
            {
              name: 'Student Focus',
              path: '/members/student-focus',
              icon: 'person-plus',
            },
            {
              name: 'Live',
              path: '/members/live',
              icon: 'play-circle',
            },
          ]
        }
      ],
      brandSections: [
        {
          brand: 'singeo',
          links: [
            {
              name: 'Routines',
              path: '/members/routines',
              icon: 'routines',
              viewBox:"0 0 29 29"
            },
          ]
        },
        {
          brand: 'guitareo',
          links: [
            {
              name: 'Lessons',
              path: '/members/lessons',
              icon: 'acoustic-guitar',
              viewBox:"0 0 20 22",
              width: "22",
              height: "35",
            },
            {
              name: 'Play Alongs',
              path: '/members/lessons',
              icon: 'eigth-notes',
            },
            {
              name: 'Chords & Scales',
              path: '/members/chords-scales',
              icon: 'guitar-tabs',
            },
            {
              name: 'Archives',
              path: '/members/archives',
              icon: 'archives',
            },
          ]
        },
        {
          brand: 'pianote',
          links: [
            {
              name: 'Foundation',
              path: '/members/foundation',
              icon: 'foundation',
              viewBox: '0 0 27 27',
            },
            {
              name: 'Podcast',
              path: '/members/podcast',
              icon: 'podcast',
            },
            {
              name: 'Bootcamps',
              path: '/members/bootcamps',
              icon: 'keys',
            },
          ]
        },
        {
          brand: 'drumeo',
          links: [
            {
              name: 'Play-Alongs',
              path: '/members/play-alongs',
              icon: 'eigth-notes',
            },
            {
              name: 'Rudiments',
              path: '/members/rudiments',
              icon: 'drum',
            },
            {
              name: 'Shows',
              path: '/members/shows',
              icon: 'shows',
              viewBox: '0 0 30 27'
            },
          ]
        },
      ]
    }
  },
  computed: {
    pathName() {
      return window.location.pathname;
    }
  }
}
</script>

<template>
  <SidebarContainer :isSidebarCollapsed="isSidebarCollapsed" :brand="brand">
    
    <sprite-sheet></sprite-sheet>
    
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
    <section v-for="(section, i) in sections" :key="i" class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li v-for="(link, j) in section.links" :key="j" :class="[pathName === link.path ? ` ${textColor[brand]}` : '']">
          <a :href="`${link.path}?brand=${brand}`" 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 hover:tw-bg-black/[0.05]"
             :class="[pathName === link.path ? `tw-font-bold tw-bg-black/[0.05] ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon :icon-name="link.icon" class="tw-mx-4"/>
            <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Brand Specific Links -->
    <section v-for="(section, i) in brandSections" :key="i">
      <ul v-if="section.brand === brand" class="tw-border-b dark:tw-border-b-[#102230]">
        <li v-for="(link, j) in section.links" :key="j" >
          <a :href="`${link.path}?brand=${brand}`"  
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 hover:tw-bg-black/[0.05]"
             :class="[pathName === link.path ? `tw-font-bold tw-bg-black/[0.05] ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon :icon-name="link.icon" :view-box="link.viewBox" :height="link.height" :width="link.width" class="tw-mx-4"/>
            <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">{{ link.name }}</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Forum -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li>
          <a :href=" `/members/forums?brand=${brand }` " 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 hover:tw-bg-black/[0.05]"
             :class="[pathName === '/forums' ? `tw-font-bold tw-bg-black/[0.05] ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
             <musora-icon icon-name="messages" class="tw-mx-4"/>
             <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">Forums</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists -->
    <section>
      <div class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 tw-border-transparent">
        <p class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-flex">
          <musora-icon icon-name="playlist" view-box="0 0 29 29" class="tw-mx-4"/>
          <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">Playlists</span>
        </p>
      </div>
      <!-- Loop through User Playlist -->
    </section>


  </SidebarContainer>
</template>