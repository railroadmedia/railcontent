import { defineStore } from 'pinia';
import { updateUserName } from '../services/userService';

export const useUserStore = defineStore({
  id: 'User',
  state: () => ({
    user: null,
    brand: 'drumeo',
    journeySection: null,
    token: null,
    userCompletedAccount: null,
    userSignature: null,
  }),
  getters: {
    userId: (state) => state.user?.id,
    userDisplayName: (state) => state.user?.display_name,
    userFirstName: (state) => state.user?.first_name,
    userLastName: (state) => state.user?.last_name,
    userEmail: (state) => state.user?.email,
    userAccessLevel: (state) => state.user?.access_level,
    userCountry: (state) => state.user?.country,
    userBiography: (state) => state.user?.biography,
    userBirthday: (state) => state.user?.birthday,
    userProfilePictureUrl: (state) => state.user?.profile_picture_url,
    userXP: (state) => state.user?.total_xp,
    userDashboardUrl: (state) => state.user?.get_dashboard_url,
    isUserAMember: (state) => state.user?.is_a_member,
    isAdmin: (state) => state.user?.permission_level === 'administrator',
    userDrumPhoto: (state) => state.user?.drums_gear_photo,
    userDrummingSince: (state) => state.user?.drums_playing_since_year,
    userDrumBrands: (state) => state.user?.drums_gear_set_brands,
    userCymbalBrands: (state) => state.user?.drums_gear_cymbal_brands,
    userHardwareBrands: (state) => state.user?.drums_gear_hardware_brands,
    userStickBrands: (state) => state.user?.drums_gear_stick_brands,
    userPianoPhoto: (state) => state.user?.piano_gear_photo,
    userPlayingPianoSince: (state) => state.user?.piano_playing_since_year,
    userPianoBrands: (state) => state.user?.piano_gear_piano_brands,
    userKeyboardBrands: (state) => state.user?.piano_gear_keyboard_brands,
    userSingingPhoto: (state) => state.user?.singing_gear_photo,
    userSingingSince: (state) => state.user?.singing_since_year,
    userMicBrands: (state) => state.user?.singing_gear_mic_brands,
    userGuitarPhoto: (state) => state.user?.guitar_gear_photo,
    userPlayingGuitarSince: (state) => state.user?.guitar_playing_since_year,
    userGuitarBrands: (state) => state.user?.guitar_gear_guitar_brands,
    userAmpBrands: (state) => state.user?.guitar_gear_amp_brands,
    userPedalBrands: (state) => state.user?.guitar_gear_pedal_brands,
    userStringBrands: (state) => state.user?.guitar_gear_string_brands,
    userBirthdayFormatted: (state) => {
      if (!state.user?.birthday) return ''; 
      const date = new Date(state.user.birthday);
      return date.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
      });
    },
    userFullName: (state) => {
      if(state.user?.first_name && state.user?.last_name) {
        return `${state.user.first_name} ${state.user.last_name}`;
      }
    },
    userCreatedYear: (state) => {
      if(state.user?.created_at) {
        return new Date(state.user.created_at).getFullYear();
      } else {
        return new Date().getFullYear();
      }
    }
  },
  actions: {
    setUser (user) {
      this.user = user;
      console.log(this.user)
    },
    setUserProfilePictureUrl (url) {
      this.user.profile_picture_url = url;
    },
    setCurrentBrand (brand) {
      this.brand = brand;
    },
    setJourneySection (journeySection) {
      this.journeySection = journeySection;
    },
    setToken (token) {
      this.token = token;
    },
    setCompletedAccount (value) {
      this.userCompletedAccount = value;
    },
    setUserSignature (value) {
      this.userSignature = value;
    },
    async updateDisplayName(token, userId, displayName) {
      try {
          const response = await updateUserName(token, userId, { display_name });
          this.user.display_name = displayName; 
          window.shownotification({
              icon: 'check',
              text: 'Success! Your song request has been submitted.'
          });
          return response;
      } catch (error) {
          window.shownotification({
            icon: 'error',
            text: 'Hmm, something has gone wrong. Your display name could not be updated.'
          });
          throw new Error('Failed to update display name');
      }
    }
  }
});