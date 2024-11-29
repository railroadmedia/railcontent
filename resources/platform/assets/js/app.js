require('./bootstrap');

import { createApp, defineAsyncComponent } from 'vue';

//Libraries
import axios from 'axios'
import { vMaska } from "maska"
import VueAxios from 'vue-axios'
import 'simplebar';
import 'simplebar/dist/simplebar.css';
import { createPinia } from 'pinia';
import { initializeService } from 'musora-content-services';

// Configuration object
const config = {
    sanityConfig: {
        token: process.env.SANITY_API_TOKEN,
        projectId:'4032r8py',
        dataset:'staging',
        version:'2021-06-07',
        debug: false,
        useCachedAPI: true
      },
      railcontentConfig: {
        token: window.railcontentConfig?.token,
        userId:  window.railcontentConfig?.userId,
      },
      localStorage: window.localStorage
};

// Initialize the service with the configuration
initializeService(config);

//App Pages
import Profile from '@pages/Settings/Profile.vue';
import LoginCredentials from '@pages/Settings/LoginCredentials.vue';
import Payments from '@pages/Settings/Payments.vue';
import NotificationSettings from '@pages/Settings/NotificationSettings.vue';
import AccountDetails from '@pages/Settings/AccountDetails.vue';
import Artists from '@pages/Artists/Artists.vue';
import ChildCatalog from '@pages/ChildCatalog.vue';
import Cohort from '@pages/Cohort';
import Home from '@pages/Home/Home.vue';
import LessonHistory from '@pages/LessonHistory';
import LessonPlayback from '@pages/LessonPlayback/LessonPlayback';
import Playlist from '@pages/Playlist';
import Playlists from '@pages/Playlists';
// import Referral from '@pages/Referral';
import Schedule from '@pages/Schedule';
import Songs from '@pages/Songs/Songs';
import Stc from '@pages/STC';
import CoachIndex from '@pages/CoachIndex';
import Support from '@pages/Support';
import Workouts from '@pages/Workouts';
// import WorkoutsPlayback from '@pages/WorkoutsPlayback/WorkoutsPlayback';
import Offline from '@pages/Live/Offline';
import Online from '@pages/Live/Online';
import CoachShow from '@pages/CoachShow';
import InviteFriend from '@pages/InviteFriend';
import StudentFocus from '@pages/StudentFocus';
import Shows from '@pages/Shows/Shows';
import Overview from '@pages/Overview/Overview';
import GuitareoLessons from '@pages/GuitareoLessons/GuitareoLessons';
import Catalogue from '@pages/Catalogue/Catalogue';
import Search from '@pages/Search';
import PackIndex from '@pages/PackIndex/PackIndex';
import PackOverview from '@pages/PackOverview/PackOverview';
import PackOverviewBundles from '@pages/PackOverviewBundles/PackOverviewBundles';
import DrummersToolbox from '@pages/DrummersToolbox';
import Login from '@pages/Login.vue';
import BestBeginnerDrumBook from '@pages/BestBeginnerDrumBook';
import sfsr from '@pages/SFSR/SFSR';
import Dashboard from '@pages/Dashboard';
import DevEndpoint from '@pages/DevEndpoint';
import AllContentUpdates from '@pages/ContentUpdate/All';
import ReturningContentUpdates from '@pages/ContentUpdate/Returning';
import ComingSoonContentUpdates from '@pages/ContentUpdate/ComingSoon';
import LeavingContentUpdates from '@pages/ContentUpdate/Leaving';
import Challenges from '@pages/Challenges/Challenges';

//App Components
import AppContainer from './Components/_Containers/AppContainer.vue';
import PageContainer from '@collections/PageContainer/PageContainer.vue';
import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel.vue'
import StaticHeader from '@collections/HeaderCarousel/StaticHeader.vue'
import ResetPassForm from '@collections/ResetPassForm/ResetPassForm.vue';
import MusoraIcon from '@units/MusoraIcons/MusoraIcon.vue'
import GearCarousel from '@collections/GearCarousel/GearCarousel.vue';
import ContentInfo from '@collections/ContentInfo/ContentInfo';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import ChildCollectionPage from '@collections/CollectionPage/ChildCollectionPage';
import PageHeader from '@collections/PageHeader/PageHeader'
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection';
import DeleteAccountModal from '@collections/Modal/DeleteAccountModal';
import NewMusoraIcon from '@collections/NewMusoraIcon/NewMusoraIcon';

//Vuesora Assets
import Forms from '@vuesora/assets/js/classes/forms';
import ContentService from '@vuesora/assets/js/Services/content';
import UserService from '@vuesora/assets/js/Services/user';
import ProgressTracker from '@vuesora/assets/js/classes/progress-tracker';

//Vuesora Functions
import '@vuesora/assets/js/functions/navigation';
import '@vuesora/assets/js/functions/user-events';
import '@vuesora/assets/js/functions/dropdown';
import '@vuesora/assets/js/functions/modal';
import '@vuesora/assets/js/functions/accordion';
import '@vuesora/assets/js/third-party/add-event-atc';

//Vuesora Components
import CoachEvent from '@vuesora/Components/Coaches/CoachEvent.vue';
import ContentCatalogue from '@vuesora/views/catalogues/ContentCatalogue.vue';
import PlayAlongs from '@vuesora/views/play-alongs/PlayAlongs.vue';
import NotificationsTable from '@vuesora/views/notifications/NotificationsTable.vue';
import AssignmentsContainer from '@vuesora/Components/AssignmentsContainer/AssignmentsContainer.vue';
import ContentAssignment from '@vuesora/Components/ContentAssignment/ContentAssignment.vue';
import LegacyLoops from '@vuesora/Components/LegacyLoops/LegacyLoops.vue';
import VideoResources from '@vuesora/Components/VideoResources/VideoResources.vue';

//Chatsora
import mitt from 'mitt'; //Temporary Event Bus library for Chatsora code (need full refactor for vue 3)
import Chatsora from './Libraries/Chatsora/Components/index';
const eventBus = mitt();

axios.defaults.withCredentials = true;

// laravel vapor library for file uploading to S3 directly
window.Vapor = require('laravel-vapor');

// This three variables come from Drumeo implementation, are tightly related to play functionality.
let progressTracker;
let hasBeenPlayed = false;

const app = createApp({
    provide: {
        sidebarNavigationLinks: window.sidebarNavigationLinks,
        userNavigationDropdownLinks: window.userNavigationDropdownLinks,
    },
    methods: {
        handleVideoPlay(payload) {
            if (['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed) {
                ContentService.markContentAsStarted(payload.contentId);
            }
            if (progressTracker == null) {
                progressTracker = new ProgressTracker();

                const { mediaElementVueInstance } = this.$refs;

                if (mediaElementVueInstance) {
                    window.addEventListener('visibilitychange', (event) => {
                      progressTracker.send({
                            mediaType: 'video',
                            mediaCategory: 'vimeo',
                            watchPosition: mediaElementVueInstance.currentTimeInSeconds
                                || mediaElementVueInstance.currentTime,
                            totalDuration: mediaElementVueInstance.videoLength
                                || mediaElementVueInstance.totalDuration,
                            brand:mediaElementVueInstance.brand,
                            contentId: mediaElementVueInstance.contentId
                        });
                    });
                }
            }
            hasBeenPlayed = true;
            progressTracker.start();
        },

        handleVideoPause() {
            progressTracker.stop();
        },
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
    .component('Home', Home)
    .component('HeaderCarousel', HeaderCarousel)
    .component('StaticHeader', StaticHeader)
    .component('CoachEvent', CoachEvent)
    .component('ResetPassForm', ResetPassForm)
    .component('NotificationsTable', NotificationsTable)
    .component('MusoraIcon', MusoraIcon)
    .component('LegacyLoops', LegacyLoops)
    .component('ContentCatalogue', ContentCatalogue)
    .component('PlayAlongs', PlayAlongs)
    .component('GearCarousel', GearCarousel)
    .component('VideoResources', VideoResources)
    .component('AssignmentsContainer', AssignmentsContainer)
    .component('ContentAssignment', ContentAssignment)
    .component('ContentInfo', ContentInfo)
    .component('CollectionWrapper', CollectionWrapper)
    .component('ChildCollectionPage', ChildCollectionPage)
    .component('Workouts', Workouts)
    .component('PageHeader', PageHeader)
    // .component('WorkoutsPlayback', WorkoutsPlayback)
    .component('LessonPlayback', LessonPlayback)
    .component('Songs', Songs)
    .component('Artists', Artists)
    .component('ChildCatalog', ChildCatalog)
    .component('Support', Support)
    .component('Schedule', Schedule)
    .component('Playlists', Playlists)
    .component('Playlist', Playlist)
    // .component('Referral', Referral)
    .component('Stc', Stc)
    .component('DeleteAccountModal', DeleteAccountModal)
    .component('Cohort', Cohort)
    .component('MiniCatalogueSection', MiniCatalogueSection)
    .component('LessonHistory', LessonHistory)
    .component('CoachShow', CoachShow)
    .component('CoachIndex', CoachIndex)
    .component('Profile', Profile)
    .component('LoginCredentials', LoginCredentials)
    .component('Payments', Payments)
    .component('NotificationSettings', NotificationSettings)
    .component('AccountDetails', AccountDetails)
    .component('InviteFriend', InviteFriend)
    .component('Offline', Offline)
    .component('Online', Online)
    .component('StudentFocus', StudentFocus)
    .component('Shows', Shows)
    .component('Overview', Overview)
    .component('GuitareoLessons', GuitareoLessons)
    .component('Catalogue', Catalogue)
    .component('Search', Search)
    .component('PackIndex', PackIndex)
    .component('PackOverview', PackOverview)
    .component('PackOverviewBundles', PackOverviewBundles)
    .component('Login', Login)
    .component('sfsr', sfsr)
    .component('Dashboard', Dashboard)
    .component('DevEndpoint', DevEndpoint)
    .component('AllContentUpdates', AllContentUpdates)
    .component('ReturningContentUpdates', ReturningContentUpdates)
    .component('ComingSoonContentUpdates', ComingSoonContentUpdates)
    .component('LeavingContentUpdates', LeavingContentUpdates)
    .component('NewMusoraIcon', NewMusoraIcon)

    .component('Challenges', Challenges)

    .component('PlaylistPlayback', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "playlist-playback" */
            `@pages/PlaylistPlayback.vue`
        )
    ))
    .component('BestBeginnerDrumBook', BestBeginnerDrumBook)
    .component('DrummersToolbox', DrummersToolbox)

    .component('MembershipUpdatePage', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "membership-update-page" */
            `@collections/Membership/MembershipUpdatePage.vue`
        )
    ))

    .component('Song', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "song" */
            `@pages/Song/Song.vue`
        )
    ))

    .component('ReportUser', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "report-user" */
            `@collections/ReportUser/ReportUser.vue`
        )
    ))

    .component('StudentReviewForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "student-review-form-iframe" */
            '@collections/IFrames/StudentReviewForm.vue'
        )
    ))

    .component('ContentSchedule', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "content-schedule-component" */
            '@vuesora/views/schedule/Schedule.vue'
        )
    ))

    .component('CommentsCatalogue', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "comments-catalogue-component" */
            '@vuesora/views/comments/catalogue/CommentsCatalogue.vue'
        )
    ))

    .component('Forums', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            '@pages/Forums.vue'
        )
    ))

    .component('ForumThreadsTable', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            '@vuesora/views/forum/ForumThreadsTable.vue'
        )
    ))

    .component('ForumThread', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            '@vuesora/views/forum/thread/ForumThread.vue'
        )
    ))

    .component('ForumThreads', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            '@vuesora/views/forum/thread/ForumThreads.vue'
        )
    ))

    .component('LatestForums', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "forum-thread-component" */
            '@pages/LatestForums.vue'
        )
    ))

    .component('TextEditor', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "text-editor-component" */
            '@vuesora/Components/TextEditor/TextEditor.vue'
        )
    ))

    .component('ContactMemberEmailForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "contact-member-form" */
            '@vuesora/Components/ContactMemberEmailForm/ContactMemberEmailForm.vue'
        )
    ))

    .component('CartSidebar', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "cart-sidebar" */
            '@vuesora/Components/CartSidebar/CartSidebar.vue'
        )
    ))

    .component('NavCartButton', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "nav-cart-button" */
            '@vuesora/Components/NavCartButton/NavCartButton.vue'
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
            '@vuesora/Components/ContactEmailForm/ContactEmailForm.vue'
        )
    ))

    .component('YoutubePlayer', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "youtube-player-component" */
            '@vuesora/Components/YoutubePlayer/YoutubePlayer.vue'
        )
    ))

    .component('Onboarding', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "onboarding-component" */
            '@collections/Onboarding/Onboarding.vue'
        )
    ))

    .component('VideoPlayer', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "video-player-component" */
            '@vuesora/Components/VideoPlayer/VideoPlayer.vue'
        )
    ))

    .component('VideoMediaElement', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "video-media-element-component" */
            '@vuesora/Components/MediaElement/MediaElement.vue'
        )
    ))

    .component('ImageCropper', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "image-cropper-component" */
            '@vuesora/Components/ImageCropper/ImageCropper.vue'
        )
    ))

    .component('Comments', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "comments-component" */
            '@vuesora/views/comments/Comments.vue'
        )
    ))

    .component('EmailForm', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "email-form-component" */
            '@vuesora/Components/EmailForm/EmailForm.vue'
        )
    ))
    .component('Breadcrumb', defineAsyncComponent(() =>
        import(
            /* webpackChunkName: "breadcrumb" */
            `@collections/Breadcrumb/Breadcrumb.vue`
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

app.directive('teleport-first', {
    mounted(el, binding) {
      const target = document.querySelector(binding.value);
      if (target) {
        target.insertBefore(el, target.firstChild);
      }
    },
    updated(el, binding) {
      const target = document.querySelector(binding.value);
      if (target && target.firstChild !== el) {
        target.insertBefore(el, target.firstChild);
      }
    }
});

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
            window.shownotification({
                icon: 'xp',
                text: 'Congratulations! You have earned the level of ' + newRank + '!'
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
