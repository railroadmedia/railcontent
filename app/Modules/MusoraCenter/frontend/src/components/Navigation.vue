<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            left
            :temporary="isMobile"
            clipped
            enable-resize-watcher
            mobile-break-point="1200"
            app
        >
            <v-list>
                <v-list-group
                    v-show="userHasAccessToSection('content')"
                    v-model="contentCollapse"
                    prepend-icon="archive"
                    value="true"
                    no-action
                >
                    <template v-slot:activator>
                        <v-list-item-title>Content</v-list-item-title>
                    </template>

                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content', params:{brand: 'drumeo'}}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Drumeo</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content', params:{brand: 'pianote'}}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Pianote</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content', params:{brand: 'guitareo'}}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Guitareo</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content', params:{brand: 'singeo'}}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Singeo</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content', params:{brand: 'recordeo'}}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Recordeo</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item
                        link
                        dense
                        :to="{ name: 'content.statistics'}"
                        :active-class="brandTextColor"
                    >
                        <v-list-item-content>
                            <v-list-item-title>Statistics</v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-action>
                            <v-icon>table_chart</v-icon>
                        </v-list-item-action>
                    </v-list-item>
                </v-list-group>

                <v-list-item
                    v-for="(item, i) in menuItems"
                    v-show="userHasAccessToSection(item.name)"
                    :key="i"
                    :active-class="brandTextColor"
                    :to="{ name: item.name }"
                >
                    <v-list-item-action>
                        <v-icon v-html="item.icon"></v-icon>
                    </v-list-item-action>

                    <v-list-item-content>
                        <v-list-item-title v-text="item.label"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-divider></v-divider>
        </v-navigation-drawer>

        <v-app-bar
            clipped-left
            app
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer">
                <v-icon>menu</v-icon>
            </v-app-bar-nav-icon>

            <v-toolbar-title
                @click="$router.push({ name: 'home' })"
            >
                <img
                    class="musora-logo"
                    src="https://dmmior4id2ysr.cloudfront.net/logos/mc-logo-white.png"
                >
                <!--{{ title }}-->

                <span class="body-1 musora-version">
                    v{{ version }}
                </span>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-menu
                    bottom
                    left
                    offset-y
                >
                    <template v-slot:activator="{ on }">
                        <v-btn
                            icon
                            v-on="on"
                        >
                            <v-icon small>settings</v-icon>
                        </v-btn>
                    </template>

                    <v-list dense>
                        <v-list-item :to="{ name: 'users.edit', params: { id: auth.currentUser ? auth.currentUser.id : 0 } }">
                            <v-list-item-icon>
                                <v-icon>person</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    My Account
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item @click="toggleLightMode">
                            <v-list-item-icon>
                                <v-icon>opacity</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ $vuetify.theme.dark ? 'Light' : 'Dark' }} Mode
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item :to="{ name: 'changelog' }">
                            <v-list-item-icon>
                                <v-icon>menu_book</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    Changelog
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item @click="logout">
                            <v-list-item-icon>
                                <v-icon>undo</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    Logout
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-menu>

            </v-toolbar-items>

            <form
                ref="logoutForm"
                method="GET"
                style="display:none;"
                :action="auth.currentUser ? auth.currentUser.logoutUrl : ''"
            >
            </form>
        </v-app-bar>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import brandColors from '../api/mixins.js';

export default {
    name: 'VCustomNavigation',
    mixins: [brandColors],
    props: {
        isMobile: {
            type: Boolean,
            default: () => false,
        },

        auth: {
            type: Object,
            default: () => ({
                currentUser: {},
            }),
        },

        version: {
            type: String,
            default: () => '',
        },
    },
    data() {
        return {
            drawer: !this.isMobile,
            miniVariant: false,
            commentCollapse: false,
            contentCollapse: false,
            menuItems: [
                {
                    label: 'Users',
                    icon: 'person',
                    name: 'users',
                },
                {
                    label: 'Products',
                    icon: 'shopping_cart',
                    name: 'products',
                },
                {
                    label: 'Access Codes',
                    icon: 'power_input',
                    name: 'access-codes',
                },
                {
                    label: 'Mentors',
                    icon: 'person',
                    name: 'mentors',
                },
            ],
        };
    },

    computed: {
        ...mapState({
            currentUser: state => state.auth.currentUser,
        }),

        sectionsUserHasAccessTo: {
            cache: false,
            get() {
                if (this.currentUser) {
                    if (this.currentUser.permission_level === 'super_administrator') {
                        return this.ecomItems;
                    }

                    return this.ecomItems.filter(item => this.currentUser.permissions.indexOf(item.name) !== -1);
                }

                return [];
            },
        },
    },

    created() {
        this.$vuetify.theme.dark = localStorage.getItem('lightMode') === 'false';
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

        logout() {
            this.$refs.logoutForm.submit();
        },

        toggleLightMode() {
            this.$vuetify.theme.dark = !this.$vuetify.theme.dark;

            localStorage.setItem('lightMode', String(!this.$vuetify.theme.dark));
        },
    },
};
</script>
