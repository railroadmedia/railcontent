<script>
import { ref } from "vue";
import Navbar from "../Navbar/Navbar.vue";
import Sidebar from "../Sidebar/Sidebar.vue";
import Footer from "../Footer/Footer.vue";
import { useRouter, useRoute } from "vue-router";
import SpriteSheet from "../MusoraIcons/SpriteSheet.vue";
import simplebar from "simplebar-vue";
import "simplebar/dist/simplebar.min.css";

export default {
  name: "PageContainer",
  components: { Navbar, Sidebar, Footer, SpriteSheet },
  props: {
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
    userAvatar: {
      type: String
    },
    accountUrl: {
      type: String
    },
    searchUrl: {
      type: String
    },
    withReferralButton: {
      type: Boolean,
      default: false
    }
  },

  setup(props, context) {
    const isSidebarCollapsed = ref(false);
    const isSidebarHidden = ref(false);
    const isDarkModeSelected = ref(false);
    const route = useRoute();
    const router = useRouter();

    const setDarkMode = (isSelected) => {
      const body = document.getElementById("app-body");
      if (isSelected) {
        body.classList.add("tw-dark");
      } else {
        body.classList.remove("tw-dark");
      }
    };

    const onCollapseSidebar = (val) => {
      console.log("collapse sidebar called");
      if (typeof val === "boolean") {
        isSidebarCollapsed.value = val;
        isSidebarHidden.value = val;
      } else {
        const smallBreakpoint = window.matchMedia("(max-width: 767px)");
        if (smallBreakpoint.matches) {
          isSidebarHidden.value = !isSidebarHidden.value;
          isSidebarCollapsed.value = false;
        } else {
          isSidebarHidden.value = false;
          isSidebarCollapsed.value = !isSidebarCollapsed.value;
        }
      }
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

    return {
      isSidebarCollapsed,
      isSidebarHidden,
      isDarkModeSelected,
      onCollapseSidebar,
      onColorModeToggle,
      setDarkMode
    };
  },

  beforeMount() {
    //Set Dark Mode Based on User Preferences
    if (localStorage.getItem("darkMode")) {
      this.isDarkModeSelected = JSON.parse(localStorage.getItem("darkMode"));
      this.setDarkMode(this.isDarkModeSelected);
    } else {
      this.isDarkModeSelected = window.matchMedia(
        "(prefers-color-scheme: dark)"
      ).matches;
      this.setDarkMode(this.isDarkModeSelected);
    }
    //Set Sidebar State
    const smallBreakpoint = window.matchMedia("(max-width: 1023px)");
    if (smallBreakpoint.matches) {
      this.isSidebarHidden = true;
      this.isSidebarCollapsed = false;
    }
  },

  created() {
    //Check if Mobile on Resize
    window.addEventListener("resize", this.onResize);
  },

  destroyed() {
    window.removeEventListener("resize", this.onResize);
  },

  methods: {
    onResize(e) {
      const smallBreakpoint = window.matchMedia("(max-width: 1023px)");
      if (smallBreakpoint.matches) {
        this.isSidebarHidden = true;
        this.isSidebarCollapsed = false;
      }
    },
  },
};
</script>

<template>
  <main class="tw-min-h-screen tw-w-screen">
    <sprite-sheet></sprite-sheet>

    <Navbar
      :brand="brand"
      :has-notifications="hasNotifications"
      :user-name="userName"
      :user-avatar="userAvatar"
      :account-url="accountUrl"
      :isSidebarHidden="isSidebarHidden"
      :isDarkModeSelected="isDarkModeSelected"
      :isSidebarCollapsed="isSidebarCollapsed"
      :with-referral-button="withReferralButton"
      @onCollapseSidebar="onCollapseSidebar"
      @onColorModeToggle="onColorModeToggle"
    />

    <!-- Page Container -->
    <div
      class="
        tw-flex tw-flex-row tw-w-full tw-h-screen tw-transition-colors
        dark:tw-bg-[#000C17]
        tw-overflow-hidden
      "
    >
      <!-- Sidebar -->
      <Sidebar
        :brand="brand"
        :isLive="isLive"
        :isSidebarCollapsed="isSidebarCollapsed"
        :isSidebarHidden="isSidebarHidden"
        @onCollapseSidebar="onCollapseSidebar"
      />

      <!-- Content Container -->
      <main
        class="
          tw-flex
          tw-w-full
          tw-h-full
          tw-min-h-screen
          tw-pt-[58px]
          tw-flex-col
          tw-relative
          tw-overflow-y-auto
          tw-overflow-x-hidden
        "
      >
        <!-- Content -->
        <section class="tw-flex tw-flex-col tw-grow tw-w-full tw-pb-7">
          <slot />
        </section>

        <!-- Footer -->
        <Footer />

        <!-- Sidebar Content Wrapper -->
        <Transition name="fade">
          <div
            v-if="!isSidebarCollapsed && !isSidebarHidden"
            @click="isSidebarHidden = true"
            class="
              tw-absolute
              md:tw-hidden
              tw-top-0 tw-left-0 tw-w-full tw-h-full tw-z-10 tw-bg-black/30
            "
          ></div>
        </Transition>
      </main>
    </div>
  </main>
</template>
