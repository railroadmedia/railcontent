import { defineStore } from 'pinia';
import { updateUserProfile, updateUserSignature } from '../services/userService';

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
      const [year, month, day] = state.user.birthday.split('-');
      const date = new Date(Date.UTC(year, month - 1, day));
      return `${date.toLocaleString('default', { month: 'long' })} ${day}, ${year}`;
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
    async updateProfile(token, userId, data) {
      try {
          const response = await updateUserProfile(token, userId, data);
          
          //Update Pinia values if they exist
          data.hasOwnProperty('display_name') && (this.user.display_name = data.display_name);
          //About You
          data.hasOwnProperty('first_name') && (this.user.first_name = data.first_name);
          data.hasOwnProperty('last_name') && (this.user.last_name = data.last_name);
          data.hasOwnProperty('country') && (this.user.country = data.country);
          data.hasOwnProperty('birthday') && (this.user.birthday = data.birthday);
          data.hasOwnProperty('biography') && (this.user.biography = data.biography);
          //Drum Gear
          data.hasOwnProperty('drums_playing_since_year') && (this.user.drums_playing_since_year = data.drums_playing_since_year);
          data.hasOwnProperty('drums_gear_set_brands') && (this.user.drums_gear_set_brands = data.drums_gear_set_brands);
          data.hasOwnProperty('drums_gear_cymbal_brands') && (this.user.drums_gear_cymbal_brands = data.drums_gear_cymbal_brands);
          data.hasOwnProperty('drums_gear_hardware_brands') && (this.user.drums_gear_hardware_brands = data.drums_gear_hardware_brands);
          data.hasOwnProperty('drums_gear_stick_brands') && (this.user.drums_gear_stick_brands = data.drums_gear_stick_brands);
          //Piano Gear
          data.hasOwnProperty('piano_playing_since_year') && (this.user.piano_playing_since_year = data.piano_playing_since_year);
          data.hasOwnProperty('piano_gear_piano_brands') && (this.user.piano_gear_piano_brands = data.piano_gear_piano_brands);
          data.hasOwnProperty('piano_gear_keyboard_brands') && (this.user.piano_gear_keyboard_brands = data.piano_gear_keyboard_brands);
          //Guitar Gear
          data.hasOwnProperty('guitar_playing_since_year') && (this.user.guitar_playing_since_year = data.guitar_playing_since_year);
          data.hasOwnProperty('guitar_gear_guitar_brands') && (this.user.guitar_gear_guitar_brands = data.guitar_gear_guitar_brands);
          data.hasOwnProperty('guitar_gear_amp_brands') && (this.user.guitar_gear_amp_brands = data.guitar_gear_amp_brands);
          data.hasOwnProperty('guitar_gear_pedal_brands') && (this.user.guitar_gear_pedal_brands = data.guitar_gear_pedal_brands);
          data.hasOwnProperty('guitar_gear_string_brands') && (this.user.guitar_gear_string_brands = data.guitar_gear_string_brands);
          //Singing Gear
          data.hasOwnProperty('singing_since_year') && (this.user.singing_since_year = data.singing_since_year);
          data.hasOwnProperty('singing_gear_mic_brands') && (this.user.singing_gear_mic_brands = data.singing_gear_mic_brands);

          window.shownotification({
              icon: 'check',
              text: 'Profile successfully updated!'
          });
          return response;
      } catch (error) {
          window.shownotification({
            icon: 'error',
            text: 'Hmm, something has gone wrong. Your profile could not be updated.'
          });
          throw new Error('Failed to update profile');
      }
    },

    async updateSignature(token, userId, data) {
      try {
          const response = await updateUserSignature(token, userId, data);
          
          //Signature
          data.hasOwnProperty('signature') && (this.user.signature = data.signature);

          window.shownotification({
              icon: 'check',
              text: 'Signature successfully updated!'
          });
          return response;
      } catch (error) {
          window.shownotification({
            icon: 'error',
            text: 'Hmm, something has gone wrong. Your signature could not be updated.'
          });
          throw new Error('Failed to update signature');
      }
    }
  }
});