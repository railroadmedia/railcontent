import { defineStore } from 'pinia'

export const useNotificationStore = defineStore({
  id: 'Notification',
  state: () => ({
    isError: false,
    icon: '',
    text: '',
    slideClass: 'slide-in-bottom',
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
            slideClass: 'slide-out-bottom',
          });
          setTimeout(() => {
            this.$patch({
              icon: '',
              text: '',
              isError: false,
              slideClass: 'slide-in-bottom',
            });
            resolve();
          }, 500)
        }, 3000);
      })
    },
  },
})
