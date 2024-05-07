<script setup>
import { ref, provide, onBeforeMount, onMounted, onUnmounted, onUpdated } from "vue";
import { storeToRefs } from 'pinia';
import { useNotificationStore } from '../../../stores/notification';
import { useConfirmationStore } from '../../../stores/confirmation';
import { usePlaylistsStore } from '../../../stores/playlists';
import { usePageContainerStore } from '../../../stores/pageContainer';
import NotificationToasts from '../../vuesora/components/NotificationToasts/NotificationToasts.vue';
import Navbar from "../Navbar/Navbar.vue";
import ConfirmationModal from "../Modal/ConfirmationModal.vue";
import Sidebar from "../Sidebar/Sidebar.vue";
import Footer from "../Footer/Footer.vue";
// import { useRouter, useRoute } from "vue-router";
import SpriteSheet from "../MusoraIcons/SpriteSheet.vue";
import { setEndpointPrefix } from "../../utils"
import PlaylistsModal from "../Playlists/Modals/PlaylistsModal.vue";

const props = defineProps({
  isMobileAppWebView: {
    type: Boolean,
    default: false,
  },
  isLive: {
    type: Boolean,
    default: false
  },
  hasNotifications: {
    type: Boolean,
    default: false
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
  isOnboarding: {
    type: Boolean,
    default: false
  },
  playlists: {
    type: Array,
    default: [],
  },
  mostRecentPlaylists: {
    type: Array,
    default: []
  },
  showRecommendation: {
    type: Boolean,
    default: false
  },
});

const pageContainerStore = usePageContainerStore();
const notification = useNotificationStore();
const confirmation = useConfirmationStore();
const playlistsStore = usePlaylistsStore();
const { modalOpen: playlistModalProps } = storeToRefs(playlistsStore);

const isDarkModeSelected = ref(false);

provide('isDarkModeSelected', isDarkModeSelected);

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
    pageContainerStore.isSidebarCollapsed = val;
    pageContainerStore.isSidebarHidden = val;
  } else {
    const smallBreakpoint = window.matchMedia("(max-width: 1023px)");

    if (smallBreakpoint.matches) {
      pageContainerStore.isSidebarHidden = !pageContainerStore.isSidebarHidden;
      pageContainerStore.isSidebarCollapsed = false;
      localStorage.setItem("isSidebarHidden", pageContainerStore.isSidebarHidden);
    } else {
      pageContainerStore.isSidebarHidden = false;
      pageContainerStore.isSidebarCollapsed = !pageContainerStore.isSidebarCollapsed;
      //Dom manipulation...
      if (pageContainerStore.isSidebarCollapsed) {
        document.body.classList.add('sidebar-collapsed')
      } else {
        document.body.classList.remove('sidebar-collapsed')
      }
    }
  }
  //save to local storage
  localStorage.setItem("isSidebarCollapsed", pageContainerStore.isSidebarCollapsed);
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
    if (!pageContainerStore.isSidebarHidden) {
      pageContainerStore.isSidebarHidden = true;
      pageContainerStore.isSidebarCollapsed = false;
    }
  } else if (localStorage.getItem("isSidebarCollapsed") && !props.forceSidebarHidden) {
    // On desktop load the sidebar collapsed value saved on local storage, if the hidden state is not forced
    pageContainerStore.isSidebarCollapsed = JSON.parse(localStorage.getItem("isSidebarCollapsed"));
    //Dom manipulation...
    if (pageContainerStore.isSidebarCollapsed) {
      document.body.classList.add('sidebar-collapsed')
    } else {
      document.body.classList.remove('sidebar-collapsed')
    }
  } else if (props.forceSidebarHidden) {
    pageContainerStore.isSidebarCollapsed = true;
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

  // Attach pinia playlist modal to window
  window.openplaylistmodal = (modalOpen) => {
    playlistsStore.openModal(modalOpen);
    pageContainerStore.isPlaylistModalOpen = true;
  };

  // Initialize playlists pinia store
  playlistsStore.updateSidebarPlaylists({ sidebarPlaylists: props.mostRecentPlaylists })
  playlistsStore.update({ pinnedPlaylists: props.playlists });
});

const handleCloseConfirmationModal = () => {
  confirmation.callbacks.cancel();
  confirmation.reset();
};

const handleNotificationClear = () => {
  notification.clear();
};

const handleClosePlaylistModal = () => {
  playlistsStore.modalReset();
  pageContainerStore.isPlaylistModalOpen = false;
};

const onResize = (e) => {
  const smallBreakpoint = window.matchMedia("(max-width: 1023px)");
  if (smallBreakpoint.matches) {
    pageContainerStore.isSidebarHidden = true;
    pageContainerStore.isSidebarCollapsed = false;
  } else {
    pageContainerStore.isSidebarHidden = false;

    if (playlistsStore.playerExpanded) {
      pageContainerStore.isSidebarCollapsed = true;
    }
  }
}

const handleSubmit = () => {
  confirmation.callbacks.submit();
  confirmation.reset();
};

onMounted(() => {
  //Check if Mobile on Resize
  //   console.log('most recent ', props.mostRecentPlaylists)
  window.addEventListener("resize", onResize);
})

onUnmounted(() => {
  window.removeEventListener("resize", onResize);
})

onUpdated(() => {
  // console.log(playlistsStore.modalOpen)
});
</script>

<template>
  <main class="tw-min-h-screen" :class="isOnboarding ? 'tw-w-full' : 'tw-w-screen'">
    <sprite-sheet></sprite-sheet>
    <NotificationToasts :icon="notification.icon" :text="notification.text" :isError="notification.isError"
      :slideClass="notification.slideClass" :isSidebarCollapsed="pageContainerStore.isSidebarCollapsed"
      @onClose="handleNotificationClear" />
    <ConfirmationModal v-if="confirmation.title" modalId="confirmation-modal" @onClose="handleCloseConfirmationModal"
      :title="confirmation.title" :subtitle="confirmation.subtitle" :submitLabel="confirmation.submitLabel"
      :hideCancel="confirmation.hideCancel" @onCancel="handleCloseConfirmationModal" @onSubmit="handleSubmit" />
    <PlaylistsModal @onClosePlaylistsModal="handleClosePlaylistModal" key="playlists-modal-key"
      v-if="pageContainerStore.isPlaylistModalOpen" :modalProps="playlistModalProps"></PlaylistsModal>

    <Navbar v-if="!isOnboarding && !isMobileAppWebView" :forceSidebarHidden="forceSidebarHidden" :has-notifications="hasNotifications"
      :isSidebarHidden="pageContainerStore.isSidebarHidden" :isDarkModeSelected="isDarkModeSelected" :show-recommendation="showRecommendation"
      :isSidebarCollapsed="pageContainerStore.isSidebarCollapsed" :is-live="isLive" @onCollapseSidebar="onCollapseSidebar"
      @onColorModeToggle="onColorModeToggle" />

    <!-- Page Container -->
    <div v-if="!isOnboarding" class="
        tw-flex tw-flex-row tw-w-full tw-h-screen tw-transition-colors
        dark:tw-bg-[#000C17] tw-bg-[#F9F9F9]
        tw-overflow-hidden
      ">

      <!-- Sidebar -->
      <Sidebar v-if="!isOnboarding && !isMobileAppWebView" :isLive="isLive" :isSidebarCollapsed="pageContainerStore.isSidebarCollapsed"
        :isSidebarHidden="pageContainerStore.isSidebarHidden" @onCollapseSidebar="onCollapseSidebar"
        :forceSidebarHidden="forceSidebarHidden" />

      <!-- Content Container -->
      <main v-if="!isOnboarding" class="
          tw-flex
          tw-justify-between
          tw-w-full
          tw-h-full
          tw-min-h-screen
          tw-flex-col
          tw-relative
          tw-overflow-y-auto
          tw-overflow-x-hidden
          tw-scroll-smooth
        " :class="isMobileAppWebView ? '' : 'tw-pt-[58px]'" id="content-container">
        <h2 v-if="adminMessage && adminMessage.length"
          class="tw-text-[18px] tw-w-full tw-bg-yellow-200 tw-p-[20px] tw-text-center">
          {{ adminMessage }}
        </h2>
        <!-- Content -->
        <section class="tw-w-full">
          <slot :is-dark-mode="isDarkModeSelected" />
        </section>

        <!-- Footer -->
        <Footer v-if="!isMobileAppWebView" />

        <!-- Sidebar Content Wrapper -->
        <Transition name="fade">
          <div v-if="!pageContainerStore.isSidebarCollapsed && !pageContainerStore.isSidebarHidden"
            @click="pageContainerStore.isSidebarHidden = true" class="
              tw-fixed
              lg:tw-hidden
              tw-top-0 tw-left-0 tw-w-full tw-h-full tw-z-10 tw-bg-black/30
            "></div>
        </Transition>
      </main>
    </div>

    <!-- Onboarding Slot -->
    <slot v-if="isOnboarding" :is-dark-mode="isDarkModeSelected" />
  </main>
</template>
