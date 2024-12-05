import { defineStore } from 'pinia';
import { updateUserProfile, updateLoginEmail, updateLoginPassword, updateUserSignature } from '../Services/userService';

export const useUserStore = defineStore({
  id: 'User',
  state: () => ({
    user: null,
    brand: 'drumeo',
    journeySection: null,
    token: null,
    showOnboardingBanner: null,
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
    isFirstAccess: (state) => state.user?.first_access_at,
    isLifetimeMember: (state) => state.user?.is_lifetime_member,
    userMembershipLevel: (state) => state.user?.membership_level,
    userMembershipExpiration: (state) => state.user?.membership_expiration_date,
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
    userSubscriptionIntervalType: (state) => state.user?.subscription_interval_type,
    userMicBrands: (state) => state.user?.singing_gear_mic_brands,
    userGuitarPhoto: (state) => state.user?.guitar_gear_photo,
    userPlayingGuitarSince: (state) => state.user?.guitar_playing_since_year,
    userGuitarBrands: (state) => state.user?.guitar_gear_guitar_brands,
    userAmpBrands: (state) => state.user?.guitar_gear_amp_brands,
    userPedalBrands: (state) => state.user?.guitar_gear_pedal_brands,
    userStringBrands: (state) => state.user?.guitar_gear_string_brands,
    useLegacyVideoPlayer: (state) => state.user?.use_legacy_video_player ? true : false,
    userBirthdayFormatted: (state) => {
      if (!state.user?.birthday) return '';
      const [year, month, day] = state.user.birthday.split('-');
      const date = new Date(Date.UTC(year, month - 1, day));
      return `${date.toLocaleString('default', { month: 'long' })} ${day}, ${year}`;
    },
    userMembershipExpirationFormatted: (state) => {
      if (!state.user?.membership_expiration_date) return '';
      const date = new Date(state.user?.membership_expiration_date);
      // Check if the year is 9999
      if (date.getFullYear() === 9999) return "Never Expires";
      //Else Return Date
      const options = { month: 'long', day: 'numeric', year: 'numeric' };
      const formattedDate = date.toLocaleDateString('default', options);
      return formattedDate;
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
    },
    userHas30Days: (state) => {
      if(state.user?.created_at) {
        const createdAt = new Date(state.user.created_at);
        const today = new Date();
        const diffTime = Math.abs(today - createdAt);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays >= 30;
      } else {
        return false;
      }
    },
    userNeedsAccess: (getters) => {
      return (contentType, userProductIDs) => {
        //If User is an admin
        if(getters.isAdmin) {
          return false;
        }
        //If user is not a member
        if( getters.isUserAMember ) {
          return true;
        }
        //Lifetime or Plus
        if(!getters.isLifetimeMember || getters.userMembershipLevel !== 'plus') {
          return true;
        }
      }
    }
  },
  actions: {
    setUser (user) {
      this.user = user;
    },
    setUserProfilePictureUrl (url) {
      this.user.profile_picture_url = url;
      window.shownotification({
          icon: 'check',
          text: `AHH, MUCH BETTER! The new "you" is being refreshed...`
      })
    },
    setDrumsPictureUrl (url) {
      this.user.drums_gear_photo = url;
      window.shownotification({
          icon: 'check',
          text: `Woohoo! Your Drum Gear Looks Fantastic!`
      })
    },
    setPianoPictureUrl (url) {
      this.user.piano_gear_photo = url;
      window.shownotification({
          icon: 'check',
          text: `Woohoo! Your Piano Gear Looks Fantastic!`
      })
    },
    setGuitarPictureUrl (url) {
      this.user.guitar_gear_photo = url;
      window.shownotification({
          icon: 'check',
          text: `Woohoo! Your Guitar Gear Looks Fantastic!`
      })
    },
    setSingingPictureUrl (url) {
      this.user.singing_gear_photo = url;
      window.shownotification({
          icon: 'check',
          text: `Woohoo! Your Singing Gear Looks Fantastic!`
      })
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
    setShowOnboardingBanner (value) {
      this.showOnboardingBanner = value;
    },
    setUserSignature (value) {
      this.userSignature = value;
    },
    async updateProfile(data) {
      try {
          const response = await updateUserProfile(this.token, this.userId, data);
          console.log('user store', response)

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
          //Video Settings
          data.hasOwnProperty('use_legacy_video_player') && (this.user.use_legacy_video_player = data.use_legacy_video_player);

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

    clearUserProfilePictureUrl() {
      window.showconfirmationmodal({
          title: 'Do you really want to reset your avatar?',
          subtitle: 'This cannot be undone.',
          callbacks: {
              submit: () => {
                  let url = '/user-management-system/user/update/' + this.userId;
                  axios.patch(url, {
                      'profile_picture_url': null
                  })
                  .then(response => {
                      if (response.data) {
                          window.shownotification({
                              icon: 'check',
                              text: 'Woohoo! Avatar Successfully reset. Refreshing the page.'
                          });
                          //Reset in Pinia Store
                          this.user.profile_picture_url = 'https://www.musora.com/musora-cdn/image/quality=75,width=250,height=250,metadata=none/https://s3.amazonaws.com/pianote/defaults/avatar.png';
                      }
                  })
                  .catch(error => {
                      console.error(error);
                      window.shownotification({
                          icon: 'warning',
                          text: 'An error happened on the server... Refresh the page to try once more, if it happens again please contact <a href="support">support</a>. '
                      });
                  });
              },
              cancel: () => {
                  console.log('Reset avatar cancelled');
              }
          }
      });
    },

    clearGearPictureUrl(instrument) {
      window.showconfirmationmodal({
        title: 'Do you really want to reset your gear photo?',
        subtitle: 'This cannot be undone.',
        callbacks: {
            submit: () => {
                let url = '/user-management-system/user/update/' + this.userId;
                let gearAttribute = { [`${instrument}_gear_photo`]: null };

                axios.patch(url, gearAttribute)
                .then(response => {
                    if (response.data) {
                        window.shownotification({
                            icon: 'check',
                            text: 'Woohoo! Gear Photo Successfully reset.'
                        });
                        //Update Pinia
                        switch (instrument) {
                          case 'drums':
                            this.user.drums_gear_photo = '';
                            break;
                          case 'piano':
                            this.user.piano_gear_photo = '';
                            break;
                          case 'guitar':
                            this.user.guitar_gear_photo = '';
                            break;
                          case 'singing':
                            this.user.singing_gear_photo = '';
                            break;
                          default:
                            break;
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                    window.shownotification({
                      icon: 'warning',
                      text: 'An error happened on the server... Refresh the page to try once more, if it happens again please contact <a href="support">support</a>. '
                  });
                });
            },
            cancel: () => {
                console.log('Reset gear photo cancelled');
            }
        }
      });
    },

    async updateEmail(data) {
      try {
          const response = await updateLoginEmail(this.token, data);
          const responseMessage = response.data;
          //Email
          //data.hasOwnProperty('email') && (this.user.email = data.email);
          window.shownotification({
              icon: 'check',
              text: `Success! ${responseMessage}`
          });
          return response;
      } catch (error) {
          const errorMessage = error.response?.data?.error || 'An unexpected error occurred.';
          window.shownotification({
            icon: 'error',
            text: `Your email could not be updated. ${errorMessage}`
          });
          throw new Error('Failed to update email');
      }
    },

    async updatePassword(data) {
      try {
          const response = await updateLoginPassword(this.token, data);
          window.shownotification({
              icon: 'check',
              text: 'Password successfully updated!'
          });
          return response;
      } catch (error) {
          const errorMessage = error.response?.data?.error || 'An unexpected error occurred.';
          window.shownotification({
            icon: 'error',
            text: `Your password could not be updated. ${errorMessage}`
          });
          throw new Error('Failed to update password');
      }
    },

    async updateSignature(data) {
      try {
          const response = await updateUserSignature(this.token, this.userId, data);
          //Signature
          data.hasOwnProperty('signature') && (this.userSignature = data.signature);

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
