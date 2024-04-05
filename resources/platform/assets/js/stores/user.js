import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'User',
  state: () => ({
    user: null,
    brand: 'drumeo',
    journeySection: null,
    token: null,
  }),
  getters: {
    userId: (state) => state.user?.id,
    userDisplayName: (state) => state.user?.display_name,
    userProfilePictureUrl: (state) => state.user?.profile_picture_url,
    userDashboardUrl: (state) => state.user?.get_dashboard_url,
    isUserAMember: (state) => state.user?.is_a_member,
    isAdmin: (state) => state.user?.permission_level === 'administrator',
  },
  actions: {
    setUser (user) {
      this.user = user;
    },
    setCurrentBrand (brand) {
      this.brand = brand;
    },
    setJourneySection (journeySection) {
      this.journeySection = journeySection;
    },
    setToken (token) {
      this.token = token;
    }
  }
});