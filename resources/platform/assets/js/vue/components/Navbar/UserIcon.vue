<script>
import { ref } from 'vue'
import OptionElement from '../AvatarMenu/OptionElement.vue'
import OptionGroup from '../AvatarMenu/OptionGroup.vue'
import AvatarMenu from '../AvatarMenu/AvatarMenu.vue'
import MenuHeader from '../AvatarMenu/MenuHeader.vue'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
  name: 'UserIcon',
  props: ['onColorModeToggle', 'userName', 'userPhoto', 'brand'],
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
  <div
    v-on:click="handleMenuOpen"
    class="tw-ml-[36px] tw-flex tw-h-full tw-flex-row tw-items-center tw-p-[6px] tw-cursor-pointer"
  >
    <img :src="userPhoto" class="tw-h-[42px] tw-w-[42px] tw-rounded-full" />
    <AvatarMenu v-if="isUserMenuOpen" @onCloseMenu="() => handleMenuOpen(false)">
      <MenuHeader
        :name="userName"
        :optionClick="() => {}"
        :userPhoto="userPhoto"
      />
      <OptionGroup>
        <OptionElement :href="`/members/profile/notifications?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 26 29" icon-name="bell" class="tw-mr-2"/>
          Notifications
        </OptionElement>
        <OptionElement :href="`/members/profile/lists?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="playlist" class="tw-mr-2"/>
          Playlists
        </OptionElement>
        <OptionElement :href="`/members/schedule?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="calendar" class="tw-mr-2"/>
          Schedule
        </OptionElement>
        <OptionElement :href="`/members/lessons/student-focus?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="board-complete" class="tw-mr-2"/>
          Apply For Review
        </OptionElement>
        <OptionElement :href="`/members/settings?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="settings" class="tw-mr-2"/>
          Settings
        </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement @optionClick="() => $emit('onColorModeToggle')">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="moon" class="tw-mr-2"/>
          Toogle Color Mode
        </OptionElement>
        <OptionElement :href="`/members/support?brand=${brand}`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="phone" class="tw-mr-2"/>
            Support
          </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement :href="`${brand}.com/shop`">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="cart" class="tw-mr-2"/>
          Shop
        </OptionElement>
        <OptionElement href="/usora/deauthenticate">
          <musora-icon width="14" height="14" viewBox="0 0 29 29" icon-name="sign-out" class="tw-mr-2"/>
          Logout 
        </OptionElement>
      </OptionGroup>
    </AvatarMenu>
  </div>
</template>
