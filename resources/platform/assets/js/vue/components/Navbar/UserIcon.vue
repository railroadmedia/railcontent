<script>
import { ref, onBeforeMount } from 'vue'
import OptionElement from '../AvatarMenu/OptionElement.vue'
import OptionGroup from '../AvatarMenu/OptionGroup.vue'
import AvatarMenu from '../AvatarMenu/AvatarMenu.vue'
import MenuHeader from '../AvatarMenu/MenuHeader.vue'
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import StudentReviewModal from '../IFrames/StudentReviewFormInModal.vue'
import { XIcon } from "@heroicons/vue/solid";

export default {
  name: 'UserIcon',
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
    MusoraIcon,
    ModalRenderer,
    StudentReviewModal,
    XIcon,
  },
  setup(props, context) {
    const isUserMenuOpen = ref(false)
    const isReviewModalOpen = ref(false)
    const userNavigationDropdownLinks = ref([])

    const handleMenuOpen = (val) => {
      if (typeof val === 'boolean') {
        isUserMenuOpen.value = val
      } else {
        isUserMenuOpen.value = !isUserMenuOpen.value
      }
    }

    const handleReviewOpen = (val) => {
      if (typeof val === 'boolean') {
        isReviewModalOpen.value = val
      } else {
        isReviewModalOpen.value = !isReviewModalOpen.value
      }
    }

    const handleLogout = () => {
      window.location.reload()
    }

    onBeforeMount(() => {
      userNavigationDropdownLinks.value = window.userNavigationDropdownLinks;
    });

    return {
      handleMenuOpen,
      handleLogout,
      isUserMenuOpen,
      isReviewModalOpen,
      handleReviewOpen,
      userNavigationDropdownLinks
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

    <ModalRenderer v-if="isReviewModalOpen" @onClose="() => handleReviewOpen(false)">
      <button @click="() => handleReviewOpen(false)" class="tw-absolute tw-right-3 tw-top-3">
          <XIcon class="tw-text-[#E5E5E5] tw-h-[30px] tw-w-[30px]" />
      </button>
      <StudentReviewModal :brand="brand" />
    </ModalRenderer>

    <AvatarMenu v-if="isUserMenuOpen" @onCloseMenu="() => handleMenuOpen(false)">
      <MenuHeader
        :name="userName"
        :onOptionClick="() => {}"
        :userPhoto="userAvatar"
        :href="accountUrl.length ? accountUrl : '/profile'"
      />
      <OptionGroup>
        <OptionElement :href="userNavigationDropdownLinks.notificationsPageUrl">
          <musora-icon icon-name="bell" class="tw-w-[20px] tw-mr-2"/>
          Notifications
          <!-- Notification Indicator -->
          <span v-if="hasNotifications" class="tw-absolute tw-top-[14px] tw-right-[12px] tw-flex tw-h-[8px] tw-w-[8px]">
            <!-- <span class="tw-animate-ping tw-absolute tw-inline-flex tw-h-full tw-w-full tw-rounded-full tw-bg-red-500 tw-opacity-75"></span> -->
            <span class="tw-relative tw-inline-flex tw-rounded-full tw-h-[8px] tw-w-[8px] tw-bg-red-500"></span>
          </span>
        </OptionElement>
        <!-- <OptionElement :href="userNavigationDropdownLinks.playlistsPageUrl">
          <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mr-2"/>
          Playlists
        </OptionElement> -->

        <OptionElement :href="`/${ brand }/playlists`">
          <musora-icon icon-name="playlist" class="tw-w-[20px] tw-mr-2"/>
          Playlists
        </OptionElement>
        <OptionElement :href="`/${ brand }/lesson-history/in-progress`">
          <musora-icon icon-name="bookmark" class="tw-w-[20px] tw-mr-2"/>
          Lesson History
        </OptionElement>
        <OptionElement @onOptionClick="() => handleReviewOpen(true)">
          <musora-icon icon-name="board-complete" class="tw-w-[20px] tw-mr-2"/>
          Apply For Review
        </OptionElement>
        <OptionElement :href="userNavigationDropdownLinks.settingsPageUrl">
          <musora-icon icon-name="settings" class="tw-w-[20px] tw-mr-2"/>
          Account
        </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement @onOptionClick="() => $emit('onColorModeToggle')">

          <musora-icon v-if="!isDarkModeSelected" icon-name="sun" class="tw-w-[20px] tw-mr-2"/>
          <musora-icon v-if="isDarkModeSelected" icon-name="moon" class="tw-w-[20px] tw-mr-2"/>

          Appearance: {{ isDarkModeSelected ? 'Dark' : 'Light' }}
          <!-- Dark/Light Toggle Placeholder -->
          <div class="tw-ml-auto">
            <div class="tw-relative tw-w-10 tw-h-5 tw-rounded-full tw-border-2 dark:tw-bg-[#002039] tw-bg-[#e5e7ea] dark:tw-border-[#1e3b53] tw-border-[#e5e7ea] tw-box-content">
              <div class="tw-transition-all tw-w-5 tw-h-5 tw-rounded-full tw-drop-shadow-md tw-bg-white tw-absolute tw-top-0 dark:tw-right-0 dark:tw-left-auto tw-left-0 tw-right-auto"></div>
            </div>
          </div>
        </OptionElement>
        <OptionElement :href="userNavigationDropdownLinks.supportPageUrl">
          <musora-icon icon-name="phone" class="tw-w-[20px] tw-mr-2"/>
            Get Help
          </OptionElement>
      </OptionGroup>
      <OptionGroup>
        <OptionElement :href="userNavigationDropdownLinks.logoutPageUrl">
          <musora-icon icon-name="sign-out" class="tw-w-[20px] tw-mr-2"/>
          Logout
        </OptionElement>
      </OptionGroup>
    </AvatarMenu>
  </button>
</template>
