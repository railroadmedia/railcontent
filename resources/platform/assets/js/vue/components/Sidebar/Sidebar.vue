<script>
import SidebarContainer from './SidebarContainer.vue'
import SidebarSection from './SidebarSection.vue'
import SidebarLink from './SidebarLink.vue'
import { textColor, borderColor } from '../../constants/brands.js'

export default {
  name: 'Sidebar',
  components: { SidebarContainer, SidebarSection, SidebarLink },
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
              icon: '',
              active: true,
            },
            {
              name: 'Method',
              url: '/members/method',
              icon: '',
              active: false,
            },
            {
              name: 'Songs',
              url: '/members/songs',
              icon: '',
              active: false,
            },
            {
              name: 'Coaches',
              url: '/members/coaches',
              icon: '',
              active: false,
            }
          ]
        },
        {
          links: [
            {
              name: 'Packs',
              url: '/members/packs',
              icon: '',
              active: false,
            },
            {
              name: 'Quick Tips',
              url: '/members/quick-tips',
              icon: '',
              active: false,
            },
            {
              name: 'Student Focus',
              url: '/members/student-focus',
              icon: '',
              active: false,
            },
            {
              name: 'Live',
              url: '/members/live',
              icon: '',
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
              icon: '',
              active: true,
            },
          ]
        },
        {
          brand: 'guitareo',
          links: [
            {
              name: 'Lessons',
              url: '/members/lessons',
              icon: '',
              active: true,
            },
            {
              name: 'Play Alongs',
              url: '/members/lessons',
              icon: '',
              active: true,
            },
            {
              name: 'Chords & Scales',
              url: '/members/chords-scales',
              icon: '',
              active: true,
            },
            {
              name: 'Archives',
              url: '/members/archives',
              icon: '',
              active: true,
            },
          ]
        },
        {
          brand: 'pianote',
          links: [
            {
              name: 'Foundation',
              url: '/members/foundation',
              icon: '',
              active: false,
            },
            {
              name: 'Podcast',
              url: '/members/podcast',
              icon: '',
              active: false,
            },
            {
              name: 'Bootcamps',
              url: '/members/bootcamps',
              icon: '',
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
              icon: '',
              active: false,
            },
            {
              name: 'Rudiments',
              url: '/members/rudiments',
              icon: '',
              active: false,
            },
            {
              name: 'Shows',
              url: '/members/shows',
              icon: '',
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
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-4"
             :class="[link.active ? `tw-border-l-4 tw-font-bold ${textColor[brand]} ${borderColor[brand]}` : 'tw-text-[#00101D] dark:tw-text-white' ]"
          >
             {{ link.name }}
          </a>
        </li>
      </ul>
    </section>


    <!-- Brand Specific Links -->
    <section v-for="(section, i) in brandSections" :key="i">
      <ul v-if="section.brand === brand" class="tw-border-b dark:tw-border-b-[#102230]">
        <li v-for="(link, j) in section.links" :key="j" >
          <a :href="`${link.url}?brand=${brand}`"  
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-4 tw-text-[#00101D] dark:tw-text-white ">
             {{ link.name }}
          </a>
        </li>
      </ul>
    </section>

    <!-- Forum -->
    <section class="tw-border-b dark:tw-border-b-[#102230]">
      <ul>
        <li>
          <a :href=" `/members/forums?brand=${brand }` " 
             class="tw-text-sm tw-h-[42px] tw-flex tw-items-center tw-pl-4 tw-text-[#00101D] dark:tw-text-white ">
             Forums
          </a>
        </li>
      </ul>
    </section>

    <!-- Playlists -->
    <section>
      <div class="tw-h-[42px] tw-flex tw-items-center tw-pl-4">
        <p class="tw-uppercase tw-text-sm tw-font-bold tw-text-[#00101D] dark:tw-text-white">Playlists</p>
      </div>
      <!-- Loop through User Playlist -->
    </section>


  </SidebarContainer>
</template>