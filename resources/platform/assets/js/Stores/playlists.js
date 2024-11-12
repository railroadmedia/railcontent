import { defineStore } from 'pinia';
import PlaylistService from '../Services/playlists';
import {fetchUserPlaylists, fetchPlaylist} from "../../../../../../musora-content-services/src";

export const usePlaylistsStore = defineStore({
  id: 'Playlists',
  state: () => {
    return {
      playlists: [], // For Collection Page
      sidebarPlaylists: [],
      lessons: [], // For Detail Page
      pinnedPlaylists: [], // [{ id: '', title: '', isPinned: false}]
      activePlaylist: {}, //playlist a user is a currently viewing
      modalOpen: {
        modalType: null,
      },
      playerExpanded: false,
      pageHasPlaylistCatalog: false,
      loadingPlaylists: false,
      loadingLessons: false,
      sortingPlaylist: false,
      loadingPinnedPlaylists: false,
      filterOptions: [],
      playlistsQuantity: 0,
      resultsPage: 1
    }
  },
  getters: {
    pinnedQuantity: (state) => state.pinnedPlaylists.length,

    //Get Completed Lessons
    completedLessons: (state) => state.lessons.filter(l => l.progress_percent === 100),

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

    updateSidebarPlaylists({ sidebarPlaylists }) {
      this.$patch({
        sidebarPlaylists,
      })
    },

    updateFilterOptions({ filterOptions }) {
      this.$patch({
        filterOptions,
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
      try {
        const response = await fetchUserPlaylists(payload.brand, payload);
        this.loadingPlaylists = false;
        this.playlists = await response.data;
        this.playlistsQuantity = await response.meta.totalResults;
        this.filterOptions = await response.meta.filterOptions;
      } catch {
        console.log('there was an error with your request');
        //hard reload?
      }
    },
    async getPlaylist(payload, token) {
      try {
          const response = await fetchPlaylist(payload.playlist_id);
          this.loadingPlaylists = false;
          this.activePlaylist = response.data;
      } catch {
          console.log('there was an error with your request');
          //hard reload?
      }
    },
    async getPlaylistLessons(payload, token) {
      try {
        const response = await PlaylistService.getPlaylistLessons(payload, token);
        this.loadingLessons = false;
        this.lessons.concat(response.data.data);
      } catch {
        console.log('there was an error with your request');
        //hard reload?
      }
    },
    async getSidebarPlaylists(payload, token) {
      try {
          const response = await PlaylistService.getCurrentUserPlaylists(payload, token);
          this.loadingPlaylists = false;
          this.sidebarPlaylists = await response.data.data;
      } catch {
          console.log('there was an error with your request');
      }
    },

    //Static Updates
    deletePlaylist(playlist) {
      this.playlists = this.playlists.filter(p => {
        return p.id !== playlist.id;
      })
      this.playlistsQuantity--;
    },
    deletePlaylistItem(item) {
      //update duration from active playlist
      this.activePlaylist.duration = this.activePlaylist.duration - item.duration;
      //filter out item from lessons
      this.lessons = this.lessons.filter((l,i) => {
        return l.user_playlist_item_id !== item.user_playlist_item_id;
      })
    },

    updatePlaylistItem(item) {
      //update item in lessons
      this.lessons = this.lessons.map((lesson) => {
        if (lesson.user_playlist_item_id === item.user_playlist_item_id) {
          return item;
        } else {
          return lesson;
        }
      })
    },

    //Set/Update Playlist Data for Playlist page
    setActivePlaylist(list) {
      this.activePlaylist = list;
    },
    updateActivePlaylist(list) {
      this.activePlaylist.thumbnail_url = list.thumbnail_url,
      this.activePlaylist.name = list.name,
      this.activePlaylist.description = list.description
    },
    //Pin/Unpin
    pinPlaylist(list) {
      //Pin in Catalog IF Playlist Collection Page
      if( window.location.href.indexOf("/playlists") > -1 ) {
        let playlist = this.playlists.find(p => p.id === list.id);
        playlist.pinned = true;
      }
      //Pin in Sidebar
      this.pinnedPlaylists.unshift(list)
    },
    unpinPlaylist(id) {
      //Unpin from Playlist Detail Page
      if (window.location.href.indexOf("/playlist/") > -1 ) {
        this.activePlaylist.pinned = false;
      } else {
        //Unpin from Catalog (wherever there's a catalog)
        let playlist = this.playlists.find(p => p.id === id);
        if(playlist){
            playlist.pinned = false;
        }
      }

      //Unpin from Sidebar
      this.pinnedPlaylists = this.pinnedPlaylists.filter(p => {
        return p.id !== id;
      })
    },
    updatePinnedItem(id, name){
      if(this.pinnedPlaylists.length) {
        let pinnedList = this.pinnedPlaylists.find(l => l.id === id);
        if(pinnedList){
            pinnedList.name = name;
        }
      }
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
