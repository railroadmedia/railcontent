require('./bootstrap');

import { createApp, defineAsyncComponent } from 'vue';

//Libraries
import axios from 'axios'
import { vMaska } from "maska"
import VueAxios from 'vue-axios'
import 'simplebar';
import 'simplebar/dist/simplebar.css';
import { createPinia } from 'pinia';

//App Pages
import Workouts from './vue/views/Workouts';

//App Components
import AppContainer from './vue/apps/AppContainer.vue';
import PageContainer from './vue/components/PageContainer/PageContainer.vue';
import HomeCardLinks from './vue/components/HomeCardLinks/HomeCardLinks.vue';
import CatalogSection from './vue/components/CatalogSection/CatalogSection.vue';
import CatalogueCardContainer from './vue/components/Catalogue/CatalogueCardContainer.vue';
import StatsSection from './vue/components/StatsSection/StatsSection.vue';
import HeaderCarousel from './vue/components/HeaderCarousel/HeaderCarousel.vue'
import StaticHeader from './vue/components/HeaderCarousel/StaticHeader.vue'
import TriggerBanner from './vue/components/Onboarding/TriggerBanner.vue';
import LoginForm from './vue/components/LoginForm/LoginForm.vue';
import ResetPassForm from './vue/components/ResetPassForm/ResetPassForm.vue';
import MusoraIcon from './vue/components/MusoraIcons/MusoraIcon.vue'
import GearCarousel from './vue/components/GearCarousel/GearCarousel.vue';
import InfoModal from './vue/components/Modal/InfoModal';
import SoundSlice from './vue/components/SoundSlice/SoundSlice.vue';
import CohortBanner from './vue/components/CohortBanner/CohortBanner.vue';
import ContentInfo from './vue/components/ContentInfo/ContentInfo';
import CollectionFilterWrapper from './vue/components/Filter/CollectionFilterWrapper';
import CollectionWrapper from './vue/components/CollectionWrapper/CollectionWrapper';
import ChildCollectionPage from './vue/components/CollectionPage/ChildCollectionPage';

//Vuesora Assets
import Forms from './vue/vuesora/assets/js/classes/forms';
import ContentService from './vue/vuesora/assets/js/services/content';
import UserService from './vue/vuesora/assets/js/services/user';
import Toasts from './vue/vuesora/assets/js/classes/toasts';
import ProgressTracker from './vue/vuesora/assets/js/classes/progress-tracker';

//Vuesora Functions
import './vue/vuesora/assets/js/functions/navigation';
import './vue/vuesora/assets/js/functions/user-events';
import './vue/vuesora/assets/js/functions/dropdown';
import './vue/vuesora/assets/js/functions/modal';
import './vue/vuesora/assets/js/functions/accordion';
import './vue/vuesora/assets/js/third-party/add-event-atc';

//Vuesora Components
import CoachEvent from './vue/vuesora/components/Coaches/CoachEvent.vue';
import AddEventModal from './vue/vuesora/components/AddEvent/AddEventModal.vue';
import ContentCatalogue from './vue/vuesora/views/catalogues/ContentCatalogue.vue';
import PlayAlongs from './vue/vuesora/views/play-alongs/PlayAlongs.vue';
import ContentCatalogueContainer from './vue/vuesora/views/catalogues/ContentCatalogueContainer.vue';
import NotificationsTable from './vue/vuesora/views/notifications/NotificationsTable.vue';
import PaymentMethods from './vue/vuesora/views/payment-methods/PaymentMethods.vue';
import AssignmentsContainer from './vue/vuesora/components/AssignmentsContainer/AssignmentsContainer.vue';
import ContentAssignment from './vue/vuesora/components/ContentAssignment/ContentAssignment.vue';
import LegacyLoops from './vue/vuesora/components/LegacyLoops/LegacyLoops.vue';
import VideoResources from './vue/vuesora/components/VideoResources/VideoResources.vue';
import ContentLessonActionButtons from './vue/vuesora/components/VideoResources/ContentLessonActionButtons.vue';

//Chatsora
import mitt from 'mitt'; //Temporary Event Bus library for Chatsora code (need full refactor for vue 3)
import Chatsora from './vue/Libraries/Chatsora/components/index';
const eventBus = mitt();

axios.defaults.withCredentials = true;

// laravel vapor library for file uploading to S3 directly
window.Vapor = require('laravel-vapor');

// This three variables come from Drumeo implementation, are tightly related to play functionality.
let progressTracker;
let playAlongsProgressTracker;
let hasBeenPlayed = false;

const app = createApp({
    provide: {
        sidebarNavigationLinks: window.sidebarNavigationLinks,
        userNavigationDropdownLinks: window.userNavigationDropdownLinks,
    },
    methods: {
        avatarUploaded(payload) {
            const avatarPhotos = document.querySelectorAll('[data-avatar-update]');
            window.closeAllModals();
            Array.from(avatarPhotos).forEach(photo => {
                photo.setAttribute(
                    'src', payload.image_url
                );
            });
            payload.cropper.resetCropper();
            Toasts.push({
                icon: 'happy',
                title: 'AHH, MUCH BETTER!',
                themeColor: 'black',
                message: 'The new "you" is being refreshed...'
            });
        },

        gearDrumeoPhotoUploaded(payload) {
            const gearPhoto = document.querySelector('[data-drumeo-gear-update]');
            window.closeAllModals();
            gearPhoto.setAttribute(
                'src', payload.image_url
            );
            gearPhoto.classList.remove('tw-hidden');
            payload.cropper.resetCropper();
            Toasts.push({
                icon: 'happy',
                title: 'WOOHOO!',
                themeColor: 'drumeo',
                message: 'Your drum gear looks fantastic!'
            });
        },

        gearPianotePhotoUploaded(payload) {
            const gearPhoto = document.querySelector('[data-pianote-gear-update]');
            window.closeAllModals();
            gearPhoto.setAttribute(
                'src', payload.image_url
            );
            gearPhoto.classList.remove('tw-hidden');
            payload.cropper.resetCropper();
            Toasts.push({
                icon: 'happy',
                title: 'WOOHOO!',
                themeColor: 'pianote',
                message: 'Your piano gear looks fantastic!'
            });
        },

        gearGuitareoPhotoUploaded(payload) {
            const gearPhoto = document.querySelector('[data-guitareo-gear-update]');
            window.closeAllModals();
            gearPhoto.setAttribute(
                'src', payload.image_url
            );
            gearPhoto.classList.remove('tw-hidden');
            payload.cropper.resetCropper();
            Toasts.push({
                icon: 'happy',
                title: 'WOOHOO!',
                themeColor: 'guitareo',
                message: 'Your gear looks fantastic!'
            });
        },

        gearSingeoPhotoUploaded(payload) {
            const gearPhoto = document.querySelector('[data-singeo-gear-update]');
            window.closeAllModals();
            gearPhoto.setAttribute(
                'src', payload.image_url
            );
            gearPhoto.classList.remove('tw-hidden');
            payload.cropper.resetCropper();
            Toasts.push({
                icon: 'happy',
                title: 'WOOHOO!',
                themeColor: 'singeo',
                message: 'Your singing gear looks fantastic!'
            });
        },

        handleVideoPlay(payload) {
            if (['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed) {
                ContentService.markContentAsStarted(payload.contentId);
            }
            if (progressTracker == null) {
                progressTracker = new ProgressTracker();

                const { mediaElementVueInstance } = this.$refs;
                const sessionTokenElement = document.querySelector('#sessionToken');

                if (mediaElementVueInstance) {
                    window.addEventListener('unload', (event) => {
                      progressTracker.send({
                            mediaId: mediaElementVueInstance.videoId,
                            mediaType: 'video',
                            mediaCategory: 'vimeo',
                            watchPosition: mediaElementVueInstance.currentTimeInSeconds
                                || mediaElementVueInstance.currentTime,
                            totalDuration: mediaElementVueInstance.videoLength
                                || mediaElementVueInstance.totalDuration,
                            sessionToken: sessionTokenElement.value || null,
                            brand:mediaElementVueInstance.brand,
                            contentId: mediaElementVueInstance.contentId
                        });
                    });
                }
            }
            hasBeenPlayed = true;
            progressTracker.start();
        },

        handleVideoPause(payload) {
            progressTracker.stop();
        },

        handlePlayAlongsPlay() {
            if (playAlongsProgressTracker == null) {
                playAlongsProgressTracker = new ProgressTracker();

                const { playAlongsVueInstance } = this.$refs;

                if (playAlongsVueInstance) {
                    window.addEventListener('unload', (event) => {
                        progressTracker.send({
                            mediaType: 'practice',
                            mediaCategory: 'play-alongs',
                            sessionToken: sessionTokenElement.value || null
                        });
                    });
                }
            }

            playAlongsProgressTracker.start();
        },

        handlePlayAlongsPause() {
            playAlongsProgressTracker.stop();
        }
    }
});

// in order to use provide/inject this will be default in vue v3.3
app.config.unwrapInjectedRef = true;
//Temporary Emitter for Chatsora
app.config.globalProperties.eventBus = eventBus;

app.config.productionTip = false;

//Register Global Components

app.component('AppContainer', AppContainer)
    .component('PageContainer', PageContainer)
    .component('HeaderCarousel', HeaderCarousel)
    .component('StaticHeader', StaticHeader)
    .component('HomeCardLinks', HomeCardLinks)
    .component('CatalogSection', CatalogSection)
    .component('StatsSection', StatsSection)
    .component('CoachEvent', CoachEvent)
    .component('ContentCatalogueContainer', ContentCatalogueContainer)
    .component('TriggerBanner', TriggerBanner)
    .component('LoginForm', LoginForm)
    .component('ResetPassForm', ResetPassForm)
    .component('NotificationsTable', NotificationsTable)
    .component('PaymentMethods', PaymentMethods)
    .component('MusoraIcon', MusoraIcon)
    .component('LegacyLoops', LegacyLoops)
    .component('ContentCatalogue', ContentCatalogue)
    .component('PlayAlongs', PlayAlongs)
    .component('GearCarousel', GearCarousel)
    .component('VideoResources', VideoResources)
    .component('ContentLessonActionButtons', ContentLessonActionButtons)
    .component('AssignmentsContainer', AssignmentsContainer)
    .component('ContentAssignment', ContentAssignment)
    .component('AddEventModal', AddEventModal)
    .component('InfoModal', InfoModal)
    .component('SoundSlice', SoundSlice)
    .component('CohortBanner', CohortBanner)
    .component('CatalogueCardContainer', CatalogueCardContainer)
    .component('ContentInfo', ContentInfo)
    .component('CollectionFilterWrapper', CollectionFilterWrapper)
    .component('CollectionWrapper', CollectionWrapper)
    .component('ChildCollectionPage', ChildCollectionPage)
    .component('Workouts', Workouts)

    .component('PlaylistPlaybackWrapper', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-playback-wrapper" */
            `./vue/components/Playlists/PlaylistPlaybackWrapper.vue`
        )
    ))

    .component('PlatformHeader', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "platform-header" */
            `./vue/components/PlatformHeader/platform-header.vue`
        )
    ))

    .component('MembershipUpdate', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "membership-update-" */
            `./vue/components/Membership/MembershipUpdate.vue`
        )
    ))

    .component('MembershipUpdatePage', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "membership-update-page" */
            `./vue/components/Membership/MembershipUpdatePage.vue`
        )
    ))

    .component('Song', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "song" */
            `./vue/components/Songs/Song.vue`
        )
    ))

    .component('SongRequest', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "song-request" */
            `./vue/components/Songs/SongRequest.vue`
        )
    ))

    .component('ReportUser', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "report-user" */
            `./vue/components/ReportUser/ReportUser.vue`
        )
    ))

    .component('PianoBackingTracks', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "piano-backing-tracks" */
            './vue/vuesora/components/PianoBackingTracks'
        )
    ))

    .component('StudentReviewForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "student-review-form-iframe" */
            './vue/components/IFrames/StudentReviewForm.vue'
        )
    ))

    .component('ContentSchedule', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "content-schedule-component" */
            './vue/vuesora/views/schedule/Schedule.vue'
        )
    ))

    .component('CommentsCatalogue', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "comments-catalogue-component" */
            './vue/vuesora/views/comments/catalogue/CommentsCatalogue.vue'
        )
    ))

    .component('OrderForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "order-form" */
            './vue/vuesora/views/order-form/OrderForm.vue'
        )
    ))

    .component('ForumThreadsTable', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            './vue/vuesora/views/forum/ForumThreadsTable.vue'
        )
    ))

    .component('ForumThread', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            './vue/vuesora/views/forum/thread/ForumThread.vue'
        )
    ))

    .component('TextEditor', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "text-editor-component" */
            './vue/vuesora/components/TextEditor/TextEditor.vue'
        )
    ))

    .component('ContactMemberEmailForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "contact-member-form" */
            './vue/vuesora/components/ContactMemberEmailForm/ContactMemberEmailForm.vue'
        )
    ))

    .component('CartSidebar', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "cart-sidebar" */
            './vue/vuesora/components/CartSidebar/CartSidebar.vue'
        )
    ))

    .component('NavCartButton', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "nav-cart-button" */
            './vue/vuesora/components/NavCartButton/NavCartButton.vue'
        )
    ))

    .component('ContactEmailFormMarketing', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "contact-email-form-marketing" */
            '../../../marketing/assets/js/vuesora/components/ContactEmailForm/ContactEmailForm.vue'
        )
    ))

    .component('ContactEmailForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "contact-email-form" */
            './vue/vuesora/components/ContactEmailForm/ContactEmailForm.vue'
        )
    ))

    .component('YoutubePlayer', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "youtube-player-component" */
            './vue/vuesora/components/YoutubePlayer/YoutubePlayer.vue'
        )
    ))

    .component('Onboarding', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "onboarding-component" */
            './vue/components/Onboarding/Onboarding.vue'
        )
    ))

    .component('VideoPlayer', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "video-player-component" */
            './vue/vuesora/components/VideoPlayer/VideoPlayer.vue'
        )
    ))

    .component('VideoMediaElement', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "video-media-element-component" */
            './vue/vuesora/components/MediaElement/MediaElement.vue'
        )
    ))

    .component('ImageCropper', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "image-cropper-component" */
            './vue/vuesora/components/ImageCropper/ImageCropper.vue'
        )
    ))

    .component('Comments', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "comments-component" */
            './vue/vuesora/views/comments/Comments.vue'
        )
    ))

    .component('EmailForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "email-form-component" */
            './vue/vuesora/components/EmailForm/EmailForm.vue'
        )
    ))

    .component('PlaylistHeader', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-header" */
            `./vue/components/Playlists/Playlist/PlaylistHeader.vue`
        )
    ))
    .component('PlaylistCatalog', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-collection-catalog" */
            `./vue/components/Playlists/Playlist/PlaylistCatalog.vue`
        )
    ))
    .component('Breadcrumb', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "breadcrumb" */
            `./vue/components/Breadcrumb/Breadcrumb.vue`
        )
    ))
    .component('PlaylistCollectionHeader', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-collection-header" */
            `./vue/components/Playlists/PlaylistCollection/PlaylistCollectionHeader.vue`
        )
    ))
    .component('PlaylistCollectionCatalog', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-collection-catalog" */
            `./vue/components/Playlists/PlaylistCollection/PlaylistCollectionCatalog.vue`
        )
    ))

app.directive('click-outside', {
    mounted(el, binding, vnode) {
        setTimeout(() => {
            el.clickOutsideEvent = (event) => {
                if (!(el === event.target || el.contains(event.target))) {
                    binding.value()
                }
            }
            document.body.addEventListener('click', el.clickOutsideEvent)
        }, 100)
    },
    unmounted(el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
    }
})

app.directive("maska", vMaska)

const pinia = createPinia();
// app.use(router);

app.use(VueAxios, axios);
app.use(Chatsora);


app.use(pinia);
app.mount('#app');

app.config.globalProperties.$showNotification = {
    showNotification: false,
    notificationIcon: '',
    notificationText:'',
};

//What does this do??
// i have no idea (Yalung)
window.onload = function () {
    // I'm commenting out this weird code unless something blows up
    //const x = 'SGdodzV2SHpzOThrUDhiRQ==';
    //var _0x4d18 = ['SW1naXhTZXJ2aWNl']; (function (_0x53a848, _0x3f6d9a) { var _0x3c80ef = function (_0x206808) { while (--_0x206808) { _0x53a848['push'](_0x53a848['shift']()); } }; _0x3c80ef(++_0x3f6d9a); }(_0x4d18, 0x125)); var _0x4a5d = function (_0x1cc2a6, _0x9e164c) { _0x1cc2a6 = _0x1cc2a6 - 0x0; var _0x208080 = _0x4d18[_0x1cc2a6]; if (_0x4a5d['yhkJpR'] === undefined) { (function () { var _0x4c4d9c = function () { var _0x246f0e; try { _0x246f0e = Function('return\x20(function()\x20' + '{}.constructor(\x22return\x20this\x22)(\x20)' + ');')(); } catch (_0x49160d) { _0x246f0e = window; } return _0x246f0e; }; var _0x1a3c9b = _0x4c4d9c(); var _0x150bcf = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='; _0x1a3c9b['atob'] || (_0x1a3c9b['atob'] = function (_0x19253c) { var _0x2ef832 = String(_0x19253c)['replace'](/=+$/, ''); for (var _0x4f607d = 0x0, _0x4e7985, _0x3640d4, _0x56e21e = 0x0, _0xb7aacb = ''; _0x3640d4 = _0x2ef832['charAt'](_0x56e21e++); ~_0x3640d4 && (_0x4e7985 = _0x4f607d % 0x4 ? _0x4e7985 * 0x40 + _0x3640d4 : _0x3640d4, _0x4f607d++ % 0x4) ? _0xb7aacb += String['fromCharCode'](0xff & _0x4e7985 >> (-0x2 * _0x4f607d & 0x6)) : 0x0) { _0x3640d4 = _0x150bcf['indexOf'](_0x3640d4); } return _0xb7aacb; }); }()); _0x4a5d['gpMDLH'] = function (_0x3b4561) { var _0x3abf1c = atob(_0x3b4561); var _0x4fd965 = []; for (var _0xd2fc36 = 0x0, _0x4aa56a = _0x3abf1c['length']; _0xd2fc36 < _0x4aa56a; _0xd2fc36++) { _0x4fd965 += '%' + ('00' + _0x3abf1c['charCodeAt'](_0xd2fc36)['toString'](0x10))['slice'](-0x2); } return decodeURIComponent(_0x4fd965); }; _0x4a5d['mZSrca'] = {}; _0x4a5d['yhkJpR'] = !![]; } var _0x6ae68b = _0x4a5d['mZSrca'][_0x1cc2a6]; if (_0x6ae68b === undefined) { _0x208080 = _0x4a5d['gpMDLH'](_0x208080); _0x4a5d['mZSrca'][_0x1cc2a6] = _0x208080; } else { _0x208080 = _0x6ae68b; } return _0x208080; }; (function () { const _0x38c62b = x; const _0x348f75 = atob(_0x38c62b); }());
};

document.addEventListener('DOMContentLoaded', event => {
    // Forms class initialize
    Forms.addInputEventListeners();
    Forms.initializeFlatpickrInputs();
    Forms.checkErrorsInModalForms();

    showLevelUpData();
    initTimezoneSelector();
});

/**
 * Pushes A Toast when user has been promoted to new rank
 */
function showLevelUpData() {
    const levelUpData = document.getElementById('levelUpData');

    if (levelUpData) {
        setTimeout(() => {
            const newRank = levelUpData.dataset['newRank'];

            Toasts.push({
                icon: 'xp',
                title: 'Congratulations!',
                themeColor: 'drumeo',
                message: 'You have earned the level of ' + newRank + '!'
            });
        }, 1000);
    }
}

/**
 * Changes timezone query string when timezoneSelector element changes
 */
function initTimezoneSelector() {
    const timezoneSelector = document.getElementById('timezoneSelector');

    if (timezoneSelector) {
        timezoneSelector.addEventListener('change', event => {
            window.location.href = location.protocol + '//' + location.host +
                location.pathname + '?timezone=' + event.target.value;
        });
    }
}
