<template>
    <v-app>
        <v-custom-navigation
            :is-mobile="isMobile"
            :version="currentVersion"
            :auth="auth"
        ></v-custom-navigation>

        <v-content>
            <v-fade-transition
                mode="out-in"
                origin="center center 0"
            >
                <router-view :key="$route.fullPath" />
            </v-fade-transition>
        </v-content>

        <!-- Global messages and notifications -->
        <v-snackbar
            v-model="snackbar.show"
            :timeout="snackbar.timeout"
            top
            right
            multi-line
            :color="snackbar.color"
        >
            {{ snackbar.text }}
            <v-btn
                text
                @click.native="snackbar.show = false"
            >
                Close
            </v-btn>
        </v-snackbar>

        <!-- Global loading animation -->
        <v-dialog
            v-model="loadingDialog"
            persistent
            max-width="290"
        >
            <v-card class="pa-12 text-center">
                <v-progress-circular
                    indeterminate
                    :color="brandColor"
                ></v-progress-circular>
                <p>Loading Please Wait...</p>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import brandColors from './api/mixins.js';
import Utils from './api/utils';
import Navigation from './components/Navigation.vue';
import { version } from '../package.json';

export default {
    name: 'App',
    components: {
        'v-custom-navigation': Navigation,
    },
    mixins: [brandColors],
    data() {
        return {
            title: 'Musora Center',
            isMobile: window.matchMedia('(max-width: 1441px)').matches,
            miniVariant: false,
            snackbar: {
                show: false,
                text: '',
                color: 'success',
                timeout: 3000
            },
            loadingDialog: false,
            userHistory: [],
        };
    },
    computed: {
        ...mapState({
            auth: state => state.auth,
        }),

        currentVersion() {
            return version;
        },
    },
    methods: {
        ...mapActions('auth', [
            'getUserInfo',
        ]),

        toCapitalCase: string => Utils.toCapitalCase(string),

        renderSnackbar(payload) {
            this.snackbar.show = false;

            setTimeout(() => {
                this.snackbar = {
                    show: true,
                    text: payload.text,
                    color: payload.color,
                    timeout: payload.timeout || 15000
                };
            }, 50);
        },
    },
    mounted() {
        this.$root.$on('displayMessage', this.renderSnackbar);
        this.$root.$on('pageLoading', () => { this.loadingDialog = true; });
        this.$root.$on('pageLoaded', () => { this.loadingDialog = false; });

        this.getUserInfo();

        const countryListByCode = JSON.parse(document.getElementById('countryList').value);

        window.countryList = [];

        for (const [countryCode, countryName] of Object.entries(countryListByCode)) {
            window.countryList.push({ name: countryName, code: countryCode });
        }
    },
};
</script>

<style>
    body .application.theme--light {
        background:#e4e4e4;
    }

    .theme--dark .user-payments-table tr, .theme--dark .user-payments-table .v-data-footer {
        background-color: #333;
    }

    .theme--light .user-payments-table tr, .theme--light .user-payments-table .v-data-footer {
        background-color: #fff;
    }

    .v-breadcrumbs {
        padding: 0 !important;
    }

    .floating-buttons {
        position:fixed;
        bottom:16px;
        right:32px;
        z-index:100;
    }

    .musora-logo {
        max-width:130px;
        position:relative;
        top:10px;
        cursor:pointer;
    }

    .musora-version {
        position:relative;
        top:7px;
    }

    .theme--light .musora-logo {
        filter:invert(100%);
    }

    .content {
        width:100%;
        max-width:1240px;
        margin:0 auto;
    }

    .edit-form {
        width:100%;
        max-width:640px;
        margin:0 auto;
    }

    .container:not(.fluid) {
        max-width:1680px!important;
        padding: 10px 30px 0 30px;
    }

    .theme--light .nested-table, .theme--light .selected-highlighted-item {
        background-color:#f2f2f2;
    }

    .theme--light .nested-table table {
        border-left:1px solid rgba(0,0,0,.12);
    }

    .theme--dark .nested-table, .theme--dark .selected-highlighted-item {
        background-color:#525252;
    }

    .theme--dark .nested-table table {
        border-left: 1px solid hsla(0,0%,100%,.12);
    }

    .theme--light .v-dialog > .v-card {
        background-color:#e4e4e4;
    }

    .theme--dark .v-dialog > .v-card  {
        background-color:#303030;
    }

    .truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .file-input .v-list__tile {
        padding:0;
    }

    .file-input .v-input {
        width:100%;
    }

    .file-input input[type='file']{
        position:absolute;
        opacity:0;
        visibility:hidden;
    }

    .v-data-footer {
        justify-content:flex-start;
        padding-left:10px;
    }

    tr.deleted-table-row {
        box-shadow: red 25px 0px 0px -5px inset;
    }

    td p {
        margin:0;
    }

    td {
        position:relative;
    }
    td a {
        position:absolute;
        top:0;
        left:0;
        bottom:0;
        right:0;
        z-index:4;
    }

    .recent-user-button .v-btn__content {
        font-size: 12px;
        text-transform: none;
    }

    .recent-user-button {
        margin: 0 5px 5px 0
    }
</style>
