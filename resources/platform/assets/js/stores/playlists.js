import { defineStore } from 'pinia';
import PlaylistService from '../services/playlists';

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      playlists: [], // For Collection Page
      pinnedPlaylists: [], // [{ id: '', title: '', isPinned: false}]
      modalOpen: {
        modalType: null,
      },
      loadingPlaylists: false,
      loadingPinnedPlaylists: false,
      playlistsQuantity: 0,
      resultsPage: 1
    }
  },
  getters: {
    pinnedQuantity: (state) => state.pinnedPlaylists.length,
  },
  actions: {
    update({ pinnedPlaylists }) {
      this.$patch({
        pinnedPlaylists,
      })
    },

    updatePlaylists({ playlists }) {
      this.$patch({
        playlists,
      })
    }, 

    //Dynamic Updates
    async getPinnedPlaylists(brand, token) {
      this.loadingPinnedPlaylists = true;
      PlaylistService.getPinnedPlaylists(brand, token)
        .then((response) => {
          if(response.status === 200) {    
            this.pinnedPlaylists = response.data;
            this.loadingPinnedPlaylists = false;
          } else {
            console.log('there was an error with getPinnedPlaylist')
          }
        })
    },
    async getPlaylists(payload, token) {
      const response = await PlaylistService.getCurrentUserPlaylists(payload, token);
      try {
        this.loadingPlaylists = false;
        this.playlists = await response.data.data;
        this.playlistsQuantity = await response.data.meta.totalResults;
      } catch {
        console.log('there was an error with your request');
        //hard reload?
      }
    },

    //Static Updates
    deletePlaylist(playlist) {
      this.playlists = this.playlists.filter(p => {
        return p.id !== playlist.id;
      })
      this.playlistsQuantity--;
    },
    pinPlaylist(list) {
      console.log('playlist ', list)
      //Pin in Catalog      
      let playlist = this.playlists.find(p => p === list);
      playlist.pinned = true;
      //Pin in Sidebar
      this.pinnedPlaylists.push(list)
    },
    unpinPlaylist(id) {
      //Unpin from Catalog
      let playlist = this.playlists.find(p => p.id === id)
      playlist.pinned = false;
      //Unpin from Sidebar
      this.pinnedPlaylists = this.pinnedPlaylists.filter(p => {
        return p.id !== id;
      })
    },

    openModal(modalOpen) {
      this.$patch({
        modalOpen,
      });
    },
    modalReset() {
      this.$patch({
        modalType: null,
      });
    }
  },
});
