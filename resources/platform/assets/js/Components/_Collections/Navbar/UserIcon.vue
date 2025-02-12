<script>
import { ref, onBeforeMount } from 'vue'
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';
import OptionElement from '@collections/AvatarMenu/OptionElement.vue'
import OptionGroup from '@collections/AvatarMenu/OptionGroup.vue'
import AvatarMenu from '@collections/AvatarMenu/AvatarMenu.vue'
import MenuHeader from '@collections/AvatarMenu/MenuHeader.vue'
import MusoraIcon from '@units/MusoraIcons/MusoraIcon.vue'
import ModalRenderer from '@collections/Modal/ModalRenderer.vue'
import StudentReviewModal from '@collections/IFrames/StudentReviewFormInModal.vue'
import MuToggle from '@units/FormInputs/MuToggle.vue'
import { XIcon } from "@heroicons/vue/solid"

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
    },
    showRecommendation: {
      type: Boolean,
      default: false
    },
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
    MuToggle,
    XIcon,
  },
  setup(props, context) {
    const isUserMenuOpen = ref(false)
    const isReviewModalOpen = ref(false)
    const userNavigationDropdownLinks = ref([])
    const userStore = useUserStore();
    const { showAdminToggle, useStudentView } = storeToRefs(userStore);

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
   
    const toggleAdminView = async () => {
      try {
        const { status } = await userStore.updateProfile({ use_student_view: !useStudentView.value });
        if (status === 200) location.reload();
      } catch (e) {
        console.error(e);
      }
    };

    return {
      handleMenuOpen,
      handleLogout,
      isUserMenuOpen,
      isReviewModalOpen,
      handleReviewOpen,
      userNavigationDropdownLinks,
      showAdminToggle,
      useStudentView,
      toggleAdminView,
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

    <StudentReviewModal v-if="isReviewModalOpen" :brand="brand" @onCloseStudentReviewModal="handleReviewOpen(false)" />

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
          My Playlists
        </OptionElement>
        <OptionElement v-if="showRecommendation" :href="`/${ brand }/lessons/recommended`">
          <musora-icon icon-name="recommendation" class="tw-w-[20px] tw-mr-2"/>
          For You
          <!-- <musora-icon icon-name="info" class="tw-w-[14px] tw-h-[14px] tw-text-[#FFAE00] tw-ml-2"></musora-icon> -->
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
        <OptionElement v-if="showAdminToggle">
          <div @click.prevent class="tw-flex tw-items-center tw-w-full">
            <svg 
              id="Layer_2" 
              xmlns="http://www.w3.org/2000/svg" 
              viewBox="0 0 3391.86 2756.68" 
              class="tw-w-[20px] tw-h-[20px] tw-mr-2"
              :style="{ fill: isDarkModeSelected ? 'white' : '#0c1524' }">
              <path class="cls-1" d="m2603.55,2615.66c47.1,92,152.05,141.02,274.54,141.02,78.98,0,165.24-20.37,248.01-62.75,
              211.13-108.09,316.25-316.77,242.02-469.7-5.13-10.56-1008.13-2072.56-1008.13-2072.56,0,0-4.16-9.42-4.79-10.65C2308.1,
              49.02,2203.15,0,2080.66,0c-78.98,0-165.24,20.37-248.01,62.75-195.28,99.98-278.65,280.92-256.35,434.69l154.25,1056.08
              -339.5-698.44-3.06-6.41c-6-13-7.82-19.41-14.34-32.16-47.1-92-152.05-141.02-274.54-141.02-78.98,0-165.24,20.37-248.01,
              62.75-172.91,88.52-276.89,245.6-266.31,382.69h-.08l-2.43,967.49c-21.6-3.45-44.1-5.2-67.22-5.2-78.98,0-165.24,20.37-248.01,
              62.75-211.13,108.09-319.49,318.38-242.02,469.7,47.1,92,152.05,141.02,274.54,141.02,78.98,0,165.24-20.37,248.01-62.75,
              168.29-86.16,271.28-237.26,266.91-371.66l1.72-685.02,438.77,915.42c16,32,28.56,51.87,34.26,62.99,47.1,92,152.05,141.02,
              274.54,141.02,78.98,0,165.24-20.37,248.01-62.75,193.14-98.88,283.19-281.26,257.82-429.83l-9.63-67.43-147.2-1006.35,
              672.2,1393.35c7,13,13.36,21.84,18.55,31.99Z"/>
            </svg>
            Admin Mode: {{ useStudentView ? 'Off' : 'On' }}
              <div class="tw-ml-auto tw-py-1">
                <MuToggle
                  id="is_admin_view"
                  name="is_admin_view"
                  :value="!useStudentView"
                  @click.stop
                  @change="toggleAdminView"
                  :brand="brand"
                  class="!tw-w-11 [&>div]:!tw-w-11 [&>div>label:first-of-type]:!tw-bg-[#e5e7ea] [&>div>label:first-of-type]:!dark:tw-bg-[#001f3f] [&>div>label:first-of-type]:!tw-border-[#e5e7eb] [&>div>label:first-of-type]:!dark:tw-border-[#1e3b53] [&>label]:!tw-ml-0"
                  />
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
