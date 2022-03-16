<script>
import { ref } from 'vue'
import OptionElement from '../AvatarMenu/OptionElement.vue'
import OptionGroup from '../AvatarMenu/OptionGroup.vue'
import AvatarMenu from '../AvatarMenu/AvatarMenu.vue'
import MenuHeader from '../AvatarMenu/MenuHeader.vue'

export default {
  name: 'UserIcon',
  props: ['onColorModeToggle', 'userName', 'userPhoto'],
  emits: ['onColorModeToggle'],
  components: {
    AvatarMenu,
    OptionGroup,
    OptionElement,
    MenuHeader
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
    class="tw-ml-[36px] tw-flex tw-h-full tw-flex-row tw-items-center tw-px-[12px] tw-py-[6px] hover:tw-bg-[#002039]/80"
  >
    <img :src="userPhoto" class="tw-h-[42px] tw-w-[42px] tw-rounded-full" />
    <AvatarMenu v-if="isUserMenuOpen" @onCloseMenu="() => handleMenuOpen(false)">
      <MenuHeader
        :name="userName"
        :optionClick="() => {}"
        :userPhoto="userPhoto"
      />
      <OptionGroup>
        <OptionElement @optionClick="() => $emit('onColorModeToggle')"
          >Toogle Color Mode</OptionElement
        >
        <OptionElement href="/stuff">Playlists</OptionElement>
        <OptionElement>Stuff</OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement> More Stuff </OptionElement>
        <OptionElement> Other Stuff </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement @onOptionClick="handleLogout">Logout </OptionElement>
      </OptionGroup>
    </AvatarMenu>
  </div>
</template>
