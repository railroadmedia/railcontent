<script>
import { ref } from 'vue'
import OptionElement from '../AvatarMenu/OptionElement.vue'
import OptionGroup from '../AvatarMenu/OptionGroup.vue'
import AvatarMenu from '../AvatarMenu/AvatarMenu.vue'
import MenuHeader from '../AvatarMenu/MenuHeader.vue'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
  name: 'UserIcon',
  inject: ['userNavigationDropdownLinks'],
  props: {
    userName: {
      type: String
    },
    userAvatar: {
      type: String
    },
    accountUrl: {
      type: String
    },
    brand: {
      type: String
    },
    isDarkModeSelected: {
      type: Boolean,
    },
    hasNotifications: {
      type: Boolean,
      default: false,
    }
  },
  emits: ['onColorModeToggle'],
  components: {
    AvatarMenu,
    OptionGroup,
    OptionElement,
    MenuHeader,
    MusoraIcon
  },
  setup(props, context) {
    const isUserMenuOpen = ref(false)

    const handleMenuOpen = (val) => {
      if (typeof val === 'boolean') {
        isUserMenuOpen.value = val
      } else {
        isUserMenuOpen.value = !isUserMenuOpen.value
      }
    }

    const handleLogout = () => {
      window.location.reload()
    }

    return {
      handleMenuOpen,
      handleLogout,
      isUserMenuOpen
    }
  }
}
</script>

<template>
  <button
    v-on:click="handleMenuOpen"
    tabindex="0"
    class="tw-flex tw-shrink-0 tw-h-full tw-flex-row tw-transition tw-items-center tw-p-2 tw-relative tw-cursor-pointer hover:dark:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
  >
    <!-- User Image -->
    <div class="tw-relative tw-h-[42px] tw-w-[42px] tw-rounded-full tw-bg-cover">
      <img v-if="userAvatar" :src="userAvatar" class="tw-h-[42px] tw-w-[42px] tw-rounded-full"/>

      <!-- Notification Indicator -->
      <span v-if="hasNotifications" class="tw-absolute tw-top-0 tw-right-1 tw-flex tw-h-[8px] tw-w-[8px]">
        <!-- <span class="tw-animate-ping tw-absolute tw-inline-flex tw-h-full tw-w-full tw-rounded-full tw-bg-red-500 tw-opacity-75"></span> -->
        <span class="tw-relative tw-inline-flex tw-rounded-full tw-h-[8px] tw-w-[8px] tw-bg-red-500"></span>
      </span>
    </div>

    <AvatarMenu v-if="isUserMenuOpen" @onCloseMenu="() => handleMenuOpen(false)">
      <MenuHeader
        :name="userName"
        :onOptionClick="() => {}"
        :userPhoto="userAvatar"
        :accountUrl="accountUrl"
      />
      <OptionGroup>
        <OptionElement :href="this.userNavigationDropdownLinks.notificationsPageUrl">
          <musora-icon icon-name="bell" class="tw-w-[20px] tw-mr-2"/>
          Notifications
          <!-- Notification Indicator -->
          <span v-if="hasNotifications" class="tw-absolute tw-top-[14px] tw-right-[12px] tw-flex tw-h-[8px] tw-w-[8px]">
            <!-- <span class="tw-animate-ping tw-absolute tw-inline-flex tw-h-full tw-w-full tw-rounded-full tw-bg-red-500 tw-opacity-75"></span> -->
            <span class="tw-relative tw-inline-flex tw-rounded-full tw-h-[8px] tw-w-[8px] tw-bg-red-500"></span>
          </span>
        </OptionElement>
        <!-- <OptionElement :href="this.userNavigationDropdownLinks.playlistsPageUrl">
          <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mr-2"/>
          Playlists
        </OptionElement> -->

        <OptionElement :href="`/${ brand }/lists/my-list`">
          <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mr-2"/>
          My List
        </OptionElement>

        <OptionElement :href="this.userNavigationDropdownLinks.schedulePageUrl">
          <musora-icon icon-name="calendar" class="tw-w-[20px] tw-mr-2"/>
          Schedule
        </OptionElement>
        <OptionElement data-open-modal="applicationModal">
          <musora-icon icon-name="board-complete" class="tw-w-[20px] tw-mr-2"/>
          Apply For Review
        </OptionElement>
        <OptionElement :href="this.userNavigationDropdownLinks.settingsPageUrl">
          <musora-icon icon-name="settings" class="tw-w-[20px] tw-mr-2"/>
          Settings
        </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement @onOptionClick="() => $emit('onColorModeToggle')">

          <musora-icon v-if="!isDarkModeSelected" icon-name="sun" class="tw-w-[20px] tw-mr-2"/>
          <musora-icon v-if="isDarkModeSelected" icon-name="moon" class="tw-w-[20px] tw-mr-2"/>

          Appearance: {{ isDarkModeSelected ? 'Dark' : 'Light' }}
        </OptionElement>
        <OptionElement :href="this.userNavigationDropdownLinks.supportPageUrl">
          <musora-icon icon-name="phone" class="tw-w-[20px] tw-mr-2"/>
            Support
          </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement :href="this.userNavigationDropdownLinks.shopPageUrl">
          <musora-icon icon-name="cart" class="tw-w-[20px] tw-mr-2"/>
          Shop
        </OptionElement>
        <OptionElement :href="this.userNavigationDropdownLinks.logoutPageUrl">
          <musora-icon icon-name="sign-out" class="tw-w-[20px] tw-mr-2"/>
          Logout
        </OptionElement>
      </OptionGroup>
    </AvatarMenu>
  </button>
</template>
