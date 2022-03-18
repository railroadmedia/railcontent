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
              url: '/members',
              icon: 'home',
              active: true,
            },
            {
              name: 'Method',
              url: '/members/method',
              icon: 'home',
              active: false,
            },
            {
              name: 'Songs',
              url: '/members/songs',
              icon: 'home',
              active: false,
            },
            {
              name: 'Coaches',
              url: '/members/coaches',
              icon: 'home',
              active: false,
            }
          ]
        },
        {
          links: [
            {
              name: 'Packs',
              url: '/members/packs',
              icon: 'home',
              active: false,
            },
            {
              name: 'Quick Tips',
              url: '/members/quick-tips',
              icon: 'home',
              active: false,
            },
            {
              name: 'Student Focus',
              url: '/members/student-focus',
              icon: 'home',
              active: false,
            },
            {
              name: 'Live',
              url: '/members/live',
              icon: 'home',
              active: false,
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
              url: '/members/routines',
              icon: 'home',
              active: false,
            },
          ]
        },
        {
          brand: 'guitareo',
          links: [
            {
              name: 'Lessons',
              url: '/members/lessons',
              icon: 'home',
              active: false,
            },
            {
              name: 'Play Alongs',
              url: '/members/lessons',
              icon: 'home',
              active: false,
            },
            {
              name: 'Chords & Scales',
              url: '/members/chords-scales',
              icon: 'home',
              active: false,
            },
            {
              name: 'Archives',
              url: '/members/archives',
              icon: 'home',
              active: false,
            },
          ]
        },
        {
          brand: 'pianote',
          links: [
            {
              name: 'Foundation',
              url: '/members/foundation',
              icon: 'home',
              active: false,
            },
            {
              name: 'Podcast',
              url: '/members/podcast',
              icon: 'home',
              active: false,
            },
            {
              name: 'Bootcamps',
              url: '/members/bootcamps',
              icon: 'home',
              active: false,
            },
          ]
        },
        {
          brand: 'drumeo',
          links: [
            {
              name: 'Play-Alongs',
              url: '/members/play-alongs',
              icon: 'home',
              active: false,
            },
            {
              name: 'Rudiments',
              url: '/members/rudiments',
              icon: 'home',
              active: false,
            },
            {
              name: 'Shows',
              url: '/members/shows',
              icon: 'home',
              active: false,
            },
          ]
        },
      ]
    }
  }
}
</script>

<template>
  <SidebarContainer :isSidebarCollapsed="isSidebarCollapsed" :brand="brand">
    
    <sprite-sheet></sprite-sheet>
    
    <!-- Sidebar Search -->
    <div class="tw-p-4 tw-relative">
      <i class=""></i>
      <input type="text" placeholder="search" class="tw-w-full tw-h-[37px]  tw-border-none tw-text-xs tw-rounded tw-transition-color tw-bg-[#E6E7E9] dark:tw-bg-[#000C17] dark:placeholder:tw-text-[#9EC0DC]" :class="[]" />  
    </div>

    <!-- Sidebar Link Sections -->
    <section v-for="(section, i) in sections" :key="i" class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li v-for="(link, j) in section.links" :key="j" :class="[link.active ? ` ${textColor[brand]}` : '']">
          <a :href="`${link.url}?brand=${brand}`" 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 "
             :class="[link.active ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
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
          <a :href="`${link.url}?brand=${brand}`"  
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4"
             :class="[link.active ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
            <musora-icon :icon-name="link.icon" class="tw-mx-4"/>
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
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4"
             :class="[active ? `tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-border-transparent tw-text-[#00101D] dark:tw-text-white' ]"
          >
             <musora-icon icon-name="home" class="tw-mx-4"/>
             <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">Forums</span>
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists -->
    <section>
      <div class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-1 tw-border-l-4 tw-border-transparent">
        <p class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-flex">
          <musora-icon icon-name="home" class="tw-mx-4"/>
          <span class="tw-transition" :class="[isSidebarCollapsed ? 'tw-opacity-0' : 'tw-opacity-100']">Playlists</span>
        </p>
      </div>
      <!-- Loop through User Playlist -->
    </section>


  </SidebarContainer>
</template>