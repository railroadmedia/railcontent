<script setup>
import { ref, provide, onBeforeMount, onMounted, onUnmounted, onUpdated } from "vue";
import { useNotificationStore } from '../../../stores/notification';
import { useConfirmationStore } from '../../../stores/confirmation';
import { usePlaylistsStore } from '../../../stores/playlists';
import NotificationToasts from '../../vuesora/components/NotificationToasts/NotificationToasts.vue';
import Navbar from "../Navbar/Navbar.vue";
import ConfirmationModal from "../Modal/ConfirmationModal.vue";
import Sidebar from "../Sidebar/Sidebar.vue";
import Footer from "../Footer/Footer.vue";
// import { useRouter, useRoute } from "vue-router";
import SpriteSheet from "../MusoraIcons/SpriteSheet.vue";
import { setEndpointPrefix } from "../../utils"

const props = defineProps({
  brand: {
    type: String,
    default: 'drumeo'
  },
  isLive: {
    type: Boolean,
    default: false
  },
  hasNotifications: {
    type: Boolean,
    default: false
  },
  userName: {
    type: String
  },
  userId: {
    type: String
  },
  userAvatar: {
    type: String
  },
  accountUrl: {
    type: String
  },
  searchUrl: {
    type: String
  },
  forceSidebarHidden: {
    type: Boolean,
    default: false
  },
  adminMessage: {
    type: String,
  },
  canReferNewStudents: {
      type: Boolean,
      default: true
  },
  playlists: {
    type: Array,
    default: [],
  }
});

const notification = useNotificationStore();
const confirmation = useConfirmationStore();
const playlistsStore = usePlaylistsStore();

const isSidebarCollapsed = ref(false);
const isSidebarHidden = ref(false);
const isDarkModeSelected = ref(false);

provide('isDarkModeSelected', isDarkModeSelected);
provide('userAvatar', props.userAvatar);
provide('userName', props.userName);
provide('userId', props.userId);
provide('isSidebarCollapsed', isSidebarCollapsed);

const setDarkMode = (isSelected) => {
  const body = document.getElementById("app-body");
  if (isSelected) {
    body.classList.add("tw-dark");
  } else {
    body.classList.remove("tw-dark");
  }
};

const onCollapseSidebar = (val) => {
  if (typeof val === "boolean") {
    isSidebarCollapsed.value = val;
    isSidebarHidden.value = val;
  } else {
    const smallBreakpoint = window.matchMedia("(max-width: 1023px)");

    if (smallBreakpoint.matches) {
      isSidebarHidden.value = !isSidebarHidden.value;
      isSidebarCollapsed.value = false;
      localStorage.setItem("isSidebarHidden", isSidebarHidden.value);
    } else {
      isSidebarHidden.value = false;
      isSidebarCollapsed.value = !isSidebarCollapsed.value;
      //Dom manipulation...
      if (isSidebarCollapsed.value) {
        document.body.classList.add('sidebar-collapsed')
      } else {
        document.body.classList.remove('sidebar-collapsed')
      }
    }
  }
  //save to local storage
  localStorage.setItem("isSidebarCollapsed", isSidebarCollapsed.value);
};

const onColorModeToggle = (val) => {
  if (typeof val === "boolean") {
    isDarkModeSelected.value = val;
    setDarkMode(val);
    localStorage.setItem("darkMode", val);
  } else {
    isDarkModeSelected.value = !isDarkModeSelected.value;
    setDarkMode(isDarkModeSelected.value);
    localStorage.setItem("darkMode", isDarkModeSelected.value);
  }
};

//LifeCycle Methods

onBeforeMount(() => {
  //Set Dark Mode Based on User Preferences
  if (localStorage.getItem("darkMode")) {
    isDarkModeSelected.value = JSON.parse(localStorage.getItem("darkMode"));
    setDarkMode(isDarkModeSelected.value);
  } else {
    isDarkModeSelected.value = window.matchMedia(
      "(prefers-color-scheme: dark)"
    ).matches;
    setDarkMode(isDarkModeSelected.value);
  }

  //Set Sidebar State
  const smallBreakpoint = window.matchMedia("(max-width: 1023px)");

  if (smallBreakpoint.matches) {
    //Close sidebar by default in mobile
    if (!isSidebarHidden.value) {
      isSidebarHidden.value = true;
      isSidebarCollapsed.value = false;
    }
  } else if (localStorage.getItem("isSidebarCollapsed") && !props.forceSidebarHidden) {
    // On desktop load the sidebar collapsed value saved on local storage, if the hidden state is not forced
    isSidebarCollapsed.value = JSON.parse(localStorage.getItem("isSidebarCollapsed"));
    //Dom manipulation...
    if (isSidebarCollapsed.value) {
      document.body.classList.add('sidebar-collapsed')
    } else {
      document.body.classList.remove('sidebar-collapsed')
    }
  } else if (props.forceSidebarHidden) {
    isSidebarCollapsed.value = true;
  }
  setEndpointPrefix();

  // Attach notification push to window
  window.shownotification = (n) => {
    notification.push(n);
  };

  // Attach confirmation update to window
  window.showconfirmationmodal = (n) => {
    confirmation.update(n);
  };

  // Initialize playlists pinia store
  playlistsStore.update({ playlists: props.playlists });
});

const handleCloseConfirmationModal = () => {
  confirmation.callbacks.cancel();
  confirmation.reset();
};

const handleNotificationClear = () => {
  notification.clear();
};;

const onResize = (e) => {
  const smallBreakpoint = window.matchMedia("(max-width: 1023px)");
  if (smallBreakpoint.matches) {
    isSidebarHidden.value = true;
    isSidebarCollapsed.value = false;
  }
}

onMounted(() => {
  //Check if Mobile on Resize
  window.addEventListener("resize", onResize);
})

onUnmounted(() => {
  window.removeEventListener("resize", onResize);
})

</script>

<template>
  <main class="tw-min-h-screen tw-w-screen">
    <sprite-sheet></sprite-sheet>
    <NotificationToasts :icon="notification.icon" :text="notification.text" :isError="notification.isError" :slideClass="notification.slideClass" @onClose="handleNotificationClear" />
    <ConfirmationModal
      v-if="confirmation.title"
      :brand="brand"
      modalId="confirmation-modal"
      @onClose="handleCloseConfirmationModal"
      :title="confirmation.title"
      :subtitle="confirmation.subtitle"
      @onCancel="handleCloseConfirmationModal"
      @onSubmit="confirmation.callbacks.submit"
    />

    <Navbar :forceSidebarHidden="forceSidebarHidden" :brand="brand" :has-notifications="hasNotifications"
      :user-name="userName" :userAvatar="userAvatar" :account-url="accountUrl" :isSidebarHidden="isSidebarHidden"
      :isDarkModeSelected="isDarkModeSelected" :isSidebarCollapsed="isSidebarCollapsed"
      :canReferNewStudents="canReferNewStudents"
      @onCollapseSidebar="onCollapseSidebar" @onColorModeToggle="onColorModeToggle" />

    <!-- Page Container -->
    <div class="
        tw-flex tw-flex-row tw-w-full tw-h-screen tw-transition-colors
        dark:tw-bg-[#000C17] tw-bg-[#F9F9F9]
        tw-overflow-hidden
      ">

      <!-- Sidebar -->
      <Sidebar :brand="brand" :isLive="isLive" :isSidebarCollapsed="isSidebarCollapsed"
        :isSidebarHidden="isSidebarHidden" @onCollapseSidebar="onCollapseSidebar"
        :forceSidebarHidden="forceSidebarHidden" :playlists="playlistsStore.playlists" :user-id="userId" />

      <!-- Content Container -->
      <main class="
          tw-flex
          tw-w-full
          tw-h-full
          tw-min-h-screen
          tw-pt-[58px]
          tw-flex-col
          tw-relative
          tw-overflow-y-auto
          tw-overflow-x-hidden
          tw-scroll-smooth
        " id="content-container">
        <h2 v-if="adminMessage && adminMessage.length" class="tw-text-[18px] tw-w-full tw-bg-yellow-200 tw-p-[20px] tw-text-center">
          {{ adminMessage }}
        </h2>
        <!-- Content -->
        <section class="tw-flex tw-flex-col tw-grow tw-w-full">
          <slot :is-dark-mode="isDarkModeSelected" />
        </section>

        <!-- Footer -->
        <Footer :brand="brand" />

        <!-- Sidebar Content Wrapper -->
        <Transition name="fade">
          <div v-if="!isSidebarCollapsed && !isSidebarHidden" @click="isSidebarHidden = true" class="
              tw-fixed
              lg:tw-hidden
              tw-top-0 tw-left-0 tw-w-full tw-h-full tw-z-10 tw-bg-black/30
            "></div>
        </Transition>
      </main>
    </div>
  </main>
</template>
