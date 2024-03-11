import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'User',
  state: () => ({
    user: null,
    brand: 'drumeo',
    currentPage: null,
    token: null,
  }),
  getters: {
    userId: (state) => state.user?.id,
    userDisplayName: (state) => state.user?.display_name,
    userProfilePictureUrl: (state) => state.user?.profile_picture_url,
    userDashboardUrl: (state) => state.user?.get_dashboard_url,
    isUserAMember: (state) => state.user?.is_a_member,
  },
  actions: {
    setUser (user) {
      this.user = user;
    },
    setCurrentBrand (brand) {
      this.brand = brand;
    },
    setCurrentPage (currentPage) {
      this.currentPage = currentPage;
    },
    setToken (token) {
      this.token = token;
    }
  }
});