import { setup } from '@storybook/vue3';
import { createPinia } from 'pinia';
import '../resources/platform/assets/css/app.scss';

const pinia = createPinia();

setup((app) => {
    app.use(pinia);
});

export const parameters = {
  actions: { argTypesRegex: "^on[A-Z].*" },
  controls: {
    matchers: {
      color: /(background|color)$/i,
      date: /Date$/,
    },
  },
}
