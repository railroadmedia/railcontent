<template>
    <v-container
        class="pa-0 fluid"
        style="max-width:100%;!important"
    >
        <v-col
            cols="12"
            :class="brandColor"
            class="py-12 align-center justify-center px-0"
        >
            <v-container class="fill-height">
                <v-col>
                    <h3 class="display-3 white--text">
                            <img
                                src="https://dmmior4id2ysr.cloudfront.net/logos/mc-logo-white.png"
                                style="position:relative;top:10px;max-width:100%;"
                            >
                        <span class="body-1">v{{ currentVersion }}</span>
                    </h3>

                    <span class="subtitle-1 white--text">
                        A simple content, user, and e-commerce management solution.
                    </span>

                    <v-divider
                        class="my-4"
                        color="white"
                    ></v-divider>
                </v-col>
            </v-container>
        </v-col>
        <v-row align="center" class="ml-0 mr-0">
            <v-container>
                <v-row align="center">
                    <v-col class="px-2 mb-2">
                        <v-card class="pa-4" v-if="userHasAccessToSection('content')">
                            <v-container class="pa-2 no-position">
                                <h2 class="headline header-icon">
                                    <v-icon
                                        x-large
                                        class="mr-2"
                                        :color="brandColor"
                                    >
                                        person
                                    </v-icon>
                                    Content
                                </h2>
                                <v-divider class="my-4"></v-divider>
                                <v-row
                                    class="fill-height"
                                    align="center"
                                >
                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="3"
                                        class="pa-2 column"
                                    >
                                        <v-card
                                            :to="{ name: 'content', params:{brand: 'drumeo'}}"
                                            height="150"
                                            color="blue accent-3"
                                            class="px-12"
                                            hover
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-img src="https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo-white.png"></v-img>
                                            </v-row>
                                        </v-card>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="3"
                                        class="pa-2 column"
                                    >
                                        <v-card
                                            :to="{ name: 'content', params:{brand: 'pianote'}}"
                                            height="150"
                                            color="red"
                                            class="px-12"
                                            hover
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-img src="https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo-white.png"></v-img>
                                            </v-row>
                                        </v-card>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="3"
                                        class="pa-2 column"
                                    >
                                        <v-card
                                            :to="{ name: 'content', params:{brand: 'guitareo'}}"
                                            height="150"
                                            color="teal lighten-1"
                                            class="px-12"
                                            hover
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-img src="https://dmmior4id2ysr.cloudfront.net/logos/guitareo-logo.svg"></v-img>
                                            </v-row>
                                        </v-card>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="3"
                                        class="pa-2 column"
                                    >
                                        <v-card
                                            :to="{ name: 'content', params:{brand: 'singeo'}}"
                                            height="150"
                                            color="purple lighten-1"
                                            class="px-12"
                                            hover
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-img src="https://musora-center.s3.amazonaws.com/logos/singeo-logo-white.png"></v-img>
                                            </v-row>
                                        </v-card>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="3"
                                        class="pa-2 column"
                                    >
                                        <v-card
                                            :to="{ name: 'content', params:{brand: 'recordeo'}}"
                                            height="150"
                                            color="amber accent-4"
                                            class="px-12"
                                            hover
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-img src="https://dmmior4id2ysr.cloudfront.net/logos/recordeo-logo.svg"></v-img>
                                            </v-row>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card>
                    </v-col>
                </v-row>

                <v-row
                    class="fill-height"
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="6"
                        md="6"
                        class="pa-2 column"
                    >
                        <v-card
                            v-if="userHasAccessToSection('users')"
                            height="200"
                            to="users"
                        >
                            <v-container class="pa-2 no-position">
                                <v-row class="title-box guitar">
                                    <v-col class="pa-4">
                                        <h2 class="headline header-icon">
                                            <v-icon
                                                x-large
                                                class="mr-2"
                                                :color="brandColor"
                                            >
                                                person
                                            </v-icon>
                                            Users
                                        </h2>

                                        <v-divider class="my-4"></v-divider>
                                        <p class="ma-0">
                                            Update User Info, Reset Passwords,
                                            Edit Subscriptions/Payments etc..
                                        </p>
                                    </v-col>
                                </v-row>
                            </v-container>

                            <v-footer
                                absolute
                            >
                                <v-card-actions>
                                    <v-btn text>
                                        Go to Users
                                    </v-btn>
                                </v-card-actions>
                            </v-footer>
                        </v-card>
                    </v-col>


                </v-row>
            </v-container>
        </v-row>
    </v-container>
</template>

<script>
import { mapState } from 'vuex';
import brandColors from '../api/mixins';
import { version } from '../../package.json';

export default {
    mixins: [brandColors],
    data() {
        return {
            lightMode: localStorage.getItem('lightMode') === 'true',
        };
    },
    computed: {
        ...mapState({
            currentUser: state => state.auth.currentUser,
        }),

        currentVersion() {
            return version;
        },
    },
    methods: {
        userHasAccessToSection(section) {
            if (this.currentUser == null) {
                return false;
            }

            if (this.currentUser.permission_level === 'super_administrator') {
                return true;
            }

            if (this.currentUser.permissions == null) {
                return false;
            }

            return this.currentUser.permissions.indexOf(section) !== -1;
        },
    },
};
</script>

<style lang="scss">


    .home-header .v-image__image--cover:after {
        content:'';
        position:absolute;
        top:50%;
        left:50%;
        width:100%;
        height:100%;
        transform:translate(-50%, -50%);
        z-index:1;

        .v-responsive__content {
            z-index:2;
        }
    }

    .header-icon {
        vertical-align:middle;

        i {
            vertical-align:middle;
        }
    }

    .theme--dark {
        .frosted-card .title-box .flex {
            background:transparentize(#212121, .5);
        }

        .home-header .v-image__image--cover:after {
            background:radial-gradient(ellipse at center, rgba(0,0,0,.7) 0%,rgba(0,0,0,.9) 80%,rgba(0,0,0,1) 100%);
        }
    }
    .theme--light {
        .frosted-card .title-box .flex {
            background-color:transparentize(#e4e4e4, .7);
        }

        .home-header .v-image__image--cover:after {
            background:radial-gradient(ellipse at center, rgba(255,255,255,.7) 0%,rgba(255,255,255,.9) 80%,rgba(255,255,255,1) 100%);
        }
    }
    .frosted-card {
        h2 {
            vertical-align:middle;

            i {
                vertical-align:middle;
            }
        }

        .no-position {
            position:initial;
        }
        .title-box {
            position:relative;
            overflow:hidden;

            .flex {
                z-index:2;
                border-radius:3px;
            }

            &.drums:before {
                background-image:url(https://dmmior4id2ysr.cloudfront.net/homepage/smaller/drums.jpg);
            }

            &.dave-drums:before {
                background-image:url(https://dmmior4id2ysr.cloudfront.net/homepage/smaller/dave-drums.jpg);
            }

            &.piano:before {
                background-image:url(https://dmmior4id2ysr.cloudfront.net/homepage/smaller/piano.jpg);
            }

            &.guitar:before {
                background-image:url(https://dmmior4id2ysr.cloudfront.net/homepage/smaller/guitar.jpg);
            }

            &.recording:before {
                background-image:url(https://dmmior4id2ysr.cloudfront.net/homepage/smaller/recording.jpg);
            }

            &:before {
                content:'';
                position:absolute;
                top:-8px;
                left:-8px;
                width:calc(100% + 16px);
                height:200px;
                background-size:cover;
                background-position:center;
                filter: blur(5px);
                z-index:1;
            }
        }
    }
</style>
