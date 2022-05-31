require('./bootstrap');

import { createApp } from 'vue';

//Libraries
import store from './vue/store';
import router from './vue/router';
import Chatsora from '@musora/chatsora';
import axios from 'axios'
import VueAxios from 'vue-axios'
import 'simplebar';
import 'simplebar/dist/simplebar.css';
//App Components
import AppContainer from './vue/apps/AppContainer.vue';
import PageContainer from './vue/components/PageContainer/PageContainer.vue';
import HomeCardLinks from './vue/components/HomeCardLinks/HomeCardLinks.vue';
import CatalogSection from './vue/components/CatalogSection/CatalogSection.vue';
import StatsSection from './vue/components/StatsSection/StatsSection.vue';
import HeaderCarousel from './vue/components/HeaderCarousel/HeaderCarousel.vue'
import StaticHeader from './vue/components/HeaderCarousel/StaticHeader.vue'
import Onboarding from './vue/components/Onboarding/Onboarding.vue';
import TriggerBanner from './vue/components/Onboarding/TriggerBanner.vue';
import LoginForm from './vue/components/LoginForm/LoginForm.vue';
import MusoraIcon from './vue/components/MusoraIcons/MusoraIcon.vue'
//Vuesora Assets
import Forms from './vue/vuesora/assets/js/classes/forms';
import ContentService from './vue/vuesora/assets/js/services/content';
import UserService from './vue/vuesora/assets/js/services/user';
import Toasts from './vue/vuesora/assets/js/classes/toasts';
import ProgressTracker from './vue/vuesora/assets/js/classes/progress-tracker';
import ImgixService from './vue/vuesora/assets/js/services/imgix';
//Vuesora Functions
import './vue/vuesora/assets/js/functions/navigation';
import './vue/vuesora/assets/js/functions/user-events';
import './vue/vuesora/assets/js/functions/dropdown';
import './vue/vuesora/assets/js/functions/modal';
import './vue/vuesora/assets/js/functions/accordion';
import './vue/vuesora/assets/js/functions/instructor-info';
import './vue/vuesora/assets/js/third-party/add-event-atc';
//Vuesora Components
import CoachEvent from './vue/vuesora/components/Coaches/CoachEvent.vue';
import ContentCatalogue from './vue/vuesora/views/catalogues/ContentCatalogue.vue';
import ContentCatalogueContainer from './vue/vuesora/views/catalogues/ContentCatalogueContainer.vue';
import CommentsCatalogue from './vue/vuesora/views/comments/catalogue/CommentsCatalogue.vue';
import NotificationsTable from './vue/vuesora/views/notifications/NotificationsTable.vue';
import PaymentMethods from './vue/vuesora/views/payment-methods';
import ForumThreadsTable from './vue/vuesora/views/forum/ForumThreadsTable.vue';
import ForumThread from './vue/vuesora/views/forum/thread/ForumThread.vue';
import TextEditor from './vue/vuesora/components/TextEditor/TextEditor.vue';
import ContactMemberEmailForm from './vue/vuesora/components/ContactMemberEmailForm/ContactMemberEmailForm.vue';
import ContentSchedule from './vue/vuesora/views/schedule/Schedule.vue';
import YoutubePlayer from './vue/vuesora/components/YoutubePlayer/YoutubePlayer.vue';
import VideoPlayer from './vue/vuesora/components/VideoPlayer/VideoPlayer.vue';
import ImageCropper from './vue/vuesora/components/ImageCropper/ImageCropper.vue';
import Comments from './vue/vuesora/views/comments/Comments.vue';
import EmailForm from './vue/vuesora/components/EmailForm/EmailForm.vue';

window.onload = function(){
    window.ImgixService = new ImgixService('Hghw5vHzs98kP8bE');
};

const app = createApp({
    provide: {
        sidebarNavigationLinks: window.sidebarNavigationLinks,
        userNavigationDropdownLinks: window.userNavigationDropdownLinks,
    },
    methods: {
        avatarUploaded(payload){
            UserService.setUserAttributes(currentUserId, {
                'profile_picture_url': payload.image_url
            })
                .then(response => {
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
                        themeColor: 'singeo',
                        message: 'The new "you" is being refreshed...'
                    });
                });
        },

        gearPhotoUploaded(payload){
            UserService.setUserAttributes(currentUserId, {
                'piano_gear_photo': payload.image_url
            })
                .then(response => {
                    const gearPhoto = document.querySelector('[data-gear-update]');
                    window.closeAllModals();
                    gearPhoto.setAttribute(
                        'src', payload.image_url
                    );
                    payload.cropper.resetCropper();
                    Toasts.push({
                        icon: 'happy',
                        title: 'WOOHOO!',
                        themeColor: 'singeo',
                        message: 'Your gear looks fantastic!'
                    });
                });
        },

        handleVideoPlay(payload){
            if(['started', 'completed'].indexOf(payload.progressState) === -1 && !hasBeenPlayed){
                ContentService.markContentAsStarted(payload.contentId);
            }
            if(progressTracker == null){
                progressTracker = new ProgressTracker();

                const { mediaElementVueInstance } = this.$refs;

                if(mediaElementVueInstance){
                    window.addEventListener('unload', (event) => {
                        progressTracker.send({
                            mediaId: mediaElementVueInstance.videoId,
                            mediaType: 'video',
                            mediaCategory: 'vimeo',
                            watchPosition: mediaElementVueInstance.currentTimeInSeconds
                                || mediaElementVueInstance.currentTime,
                            totalDuration: mediaElementVueInstance.videoLength
                                || mediaElementVueInstance.totalDuration,
                            sessionToken: sessionTokenElement.value || null
                        });
                    });
                }
            }
            hasBeenPlayed = true;
            progressTracker.start();
        },

        handleVideoPause(payload){
            progressTracker.stop();
        }
    }
});

//Register Global Components
app.component('AppContainer', AppContainer)
   .component('PageContainer', PageContainer)
   .component('HeaderCarousel', HeaderCarousel)
   .component('HomeCardLinks', HomeCardLinks)
   .component('CatalogSection', CatalogSection)
   .component('StatsSection', StatsSection)
   .component('CoachEvent', CoachEvent)
   .component('ContentCatalogue', ContentCatalogue)
   .component('ContentCatalogueContainer', ContentCatalogueContainer)
   .component('CommentsCatalogue', CommentsCatalogue)
   .component('Onboarding', Onboarding)
   .component('TriggerBanner', TriggerBanner)
   .component('LoginForm', LoginForm)
   .component('NotificationsTable', NotificationsTable)
   .component('PaymentMethods', PaymentMethods)
   .component('ForumThreadsTable', ForumThreadsTable)
   .component('ForumThread', ForumThread)
   .component('TextEditor', TextEditor)
   .component('ContactMemberEmailForm', ContactMemberEmailForm)
   .component('ContentSchedule', ContentSchedule)
   .component('YoutubePlayer', YoutubePlayer)
   .component('ImageCropper', ImageCropper)
   .component('Comments', Comments)
   .component('MusoraIcon', MusoraIcon)
   .component('EmailForm', EmailForm)
   .component('StaticHeader', StaticHeader)

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

app.use(store);
// app.use(router);
app.use(VueAxios, axios);
app.use(Chatsora);
app.mount('#app');


window.onload = function(){
    const x = 'SGdodzV2SHpzOThrUDhiRQ==';
    var _0x4d18=['SW1naXhTZXJ2aWNl'];(function(_0x53a848,_0x3f6d9a){var _0x3c80ef=function(_0x206808){while(--_0x206808){_0x53a848['push'](_0x53a848['shift']());}};_0x3c80ef(++_0x3f6d9a);}(_0x4d18,0x125));var _0x4a5d=function(_0x1cc2a6,_0x9e164c){_0x1cc2a6=_0x1cc2a6-0x0;var _0x208080=_0x4d18[_0x1cc2a6];if(_0x4a5d['yhkJpR']===undefined){(function(){var _0x4c4d9c=function(){var _0x246f0e;try{_0x246f0e=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(_0x49160d){_0x246f0e=window;}return _0x246f0e;};var _0x1a3c9b=_0x4c4d9c();var _0x150bcf='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x1a3c9b['atob']||(_0x1a3c9b['atob']=function(_0x19253c){var _0x2ef832=String(_0x19253c)['replace'](/=+$/,'');for(var _0x4f607d=0x0,_0x4e7985,_0x3640d4,_0x56e21e=0x0,_0xb7aacb='';_0x3640d4=_0x2ef832['charAt'](_0x56e21e++);~_0x3640d4&&(_0x4e7985=_0x4f607d%0x4?_0x4e7985*0x40+_0x3640d4:_0x3640d4,_0x4f607d++%0x4)?_0xb7aacb+=String['fromCharCode'](0xff&_0x4e7985>>(-0x2*_0x4f607d&0x6)):0x0){_0x3640d4=_0x150bcf['indexOf'](_0x3640d4);}return _0xb7aacb;});}());_0x4a5d['gpMDLH']=function(_0x3b4561){var _0x3abf1c=atob(_0x3b4561);var _0x4fd965=[];for(var _0xd2fc36=0x0,_0x4aa56a=_0x3abf1c['length'];_0xd2fc36<_0x4aa56a;_0xd2fc36++){_0x4fd965+='%'+('00'+_0x3abf1c['charCodeAt'](_0xd2fc36)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x4fd965);};_0x4a5d['mZSrca']={};_0x4a5d['yhkJpR']=!![];}var _0x6ae68b=_0x4a5d['mZSrca'][_0x1cc2a6];if(_0x6ae68b===undefined){_0x208080=_0x4a5d['gpMDLH'](_0x208080);_0x4a5d['mZSrca'][_0x1cc2a6]=_0x208080;}else{_0x208080=_0x6ae68b;}return _0x208080;};(function(){const _0x38c62b=x;const _0x348f75=atob(_0x38c62b);window[_0x4a5d('0x0')]=new ImgixService(_0x348f75);}());
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
function showLevelUpData(){
    const levelUpData = document.getElementById('levelUpData');

    if(levelUpData){
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
function initTimezoneSelector(){
    const timezoneSelector = document.getElementById('timezoneSelector');

    if(timezoneSelector){
        timezoneSelector.addEventListener('change', event => {
            window.location.href = location.protocol + '//' + location.host +
                location.pathname + '?timezone=' + event.target.value;
        });
    }
}
