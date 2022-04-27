<script>
import { ref } from 'vue'
import OptionElement from '../AvatarMenu/OptionElement.vue'
import OptionGroup from '../AvatarMenu/OptionGroup.vue'
import AvatarMenu from '../AvatarMenu/AvatarMenu.vue'
import MenuHeader from '../AvatarMenu/MenuHeader.vue'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
  name: 'UserIcon',
  props: ['onColorModeToggle', 'userName', 'userPhoto', 'brand', 'isDarkModeSelected'],
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
    class="tw-flex tw-shrink-0 tw-h-full tw-rounded-full tw-flex-row tw-items-center tw-p-[6px] tw-cursor-pointer"
  >
    <!-- User Image -->
    <img :src="userPhoto" class="tw-h-[42px] tw-w-[42px] tw-rounded-full" />

    <AvatarMenu v-if="isUserMenuOpen" @onCloseMenu="() => handleMenuOpen(false)">
      <MenuHeader
        :name="userName"
        :optionClick="() => {}"
        :userPhoto="userPhoto"
      />
      <OptionGroup>
        <OptionElement :href="`/${brand}/profile/notifications`">
          <musora-icon icon-name="bell" class="tw-w-[20px] tw-mr-2"/>
          Notifications
        </OptionElement>
        <OptionElement :href="`/${brand}/profile/lists`">
          <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mr-2"/>
          Playlists
        </OptionElement>
        <OptionElement :href="`/${brand}/schedule`">
          <musora-icon icon-name="calendar" class="tw-w-[20px] tw-mr-2"/>
          Schedule
        </OptionElement>
        <OptionElement :href="`/${brand}/lessons/student-focus`">
          <musora-icon icon-name="board-complete" class="tw-w-[20px] tw-mr-2"/>
          Apply For Review
        </OptionElement>
        <OptionElement :href="`/${brand}/settings`">
          <musora-icon icon-name="settings" class="tw-w-[20px] tw-mr-2"/>
          Settings
        </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement @optionClick="() => $emit('onColorModeToggle')">

          <musora-icon v-if="!isDarkModeSelected" icon-name="sun" class="tw-w-[20px] tw-mr-2"/>
          <musora-icon v-if="isDarkModeSelected" icon-name="moon" class="tw-w-[20px] tw-mr-2"/>

          Appearance: {{ isDarkModeSelected ? 'Dark' : 'Light' }}
        </OptionElement>
        <OptionElement :href="`/${brand}/support`">
          <musora-icon icon-name="phone" class="tw-w-[20px] tw-mr-2"/>
            Support
          </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement :href="`${brand}.com/shop`">
          <musora-icon icon-name="cart" class="tw-w-[20px] tw-mr-2"/>
          Shop
        </OptionElement>
        <OptionElement href="/usora/deauthenticate">
          <musora-icon icon-name="sign-out" class="tw-w-[20px] tw-mr-2"/>
          Logout 
        </OptionElement>
      </OptionGroup>
    </AvatarMenu>
  </button>
</template>
