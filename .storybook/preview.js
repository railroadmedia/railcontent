import { setup } from '@storybook/vue3';
import { createPinia } from 'pinia';
import '../resources/platform/assets/css/app.scss';
import { vMaska } from "maska";

// Global Components
import MusoraIcon from '../resources/platform/assets/js/Components/_Units/MusoraIcons/MusoraIcon.vue';
import SpriteSheet from "../resources/platform/assets/js/Components/_Units/MusoraIcons/SpriteSheet.vue";

const pinia = createPinia();

export const decorators = [
  (story, context) => {
    const darkMode = context.globals.darkMode === 'dark' ? 'tw-dark' : '';

    return {
      components: { story, SpriteSheet },
      template: `
    <body id="app-body" class="tw-flex tw-flex-col tw-w-full tw-min-h-screen tw-relative ${darkMode}">
        <SpriteSheet />
        <div id="notifications-container"></div>

        <!-- Dropdowns Container -->
        <div id="dropdowns-container"></div>

        <!-- Modal Container -->
        <div role="dialog" aria-labelledby="dialog-modal" aria-describedby="dialog-modal-container" id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full" tabindex="0"></div>

        <!-- Confirmation Modal Container -->
        <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        <!-- App Container -->
        <div id="app" class="flex-1">
          <story />
        </div>
    </body>
    `,
      setup() {
        // Simulating setting a local storage item before component mount if needed
        // localStorage.setItem("darkMode", "false");
        return {
          // Define your reactive properties if needed
        };
      },
      // Include methods, computed properties, etc., as needed
    }
  },
];

setup((app) => {
  // Add Pinia to the app
  app.use(pinia);

  // Register Global Components
  app.component('MusoraIcon', MusoraIcon);
  app.component('SpriteSheet', SpriteSheet);

  // Register directives if there are any globally used in your project
  app.directive("maska", vMaska);

  // Set global properties or provide/inject values
  app.provide('sidebarNavigationLinks', {}); // Mock data or actual data from your app
  app.provide('userNavigationDropdownLinks', {}); // Mock data or actual data from your app
});

export const parameters = {
  actions: { argTypesRegex: "^on[A-Z].*" },
  controls: {
    matchers: {
      color: /(background|color)$/i,
      date: /Date$/,
    },
  },
};

export const globalTypes = {
  darkMode: {
    description: 'Color Theme',
    defaultValue: 'light',
    toolbar: {
      // The label to show for this toolbar item
      title: 'Theme',
      icon: 'circlehollow',
      // Array of plain string values or MenuItem shape (see below)
      items: ['light', 'dark'],
      // Change title based on selected value
      dynamicTitle: true,
    },
  },
};
