import { defineStore } from 'pinia'

export const useNotificationStore = defineStore({
  id: 'Notification',
  state: () => ({
    isError: false,
    icon: '',
    text: '',
  }),

  actions: {
    clear() {
      this.$patch({
        icon: '',
        text: '',
        isError: false,
      });
    },
    async push({
      icon,
      text,
      isError
    }) {
      return new Promise((resolve) => {
        this.$patch({
          icon,
          text,
          isError
        });
        setTimeout(() => {
          this.$patch({
            icon: '',
            text: '',
            isError: false,
          });
          resolve();
        }, 3000);
      })
    },
  },
})
