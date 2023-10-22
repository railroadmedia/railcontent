<template>
    <div>
        <v-card class="mb-10">
            <v-toolbar
                flat
                dark
                :color="brandColor"
            >
                <v-toolbar-title>Student Mentor</v-toolbar-title>
            </v-toolbar>

            <v-col
                cols="12"
                class="pa-4 column"
            >
                <v-form>
                    <v-row
                        align="center"
                    >
                        <v-col
                            class="column xs-6"
                        >
                            <v-select
                                v-model="$_mentor"
                                :items="this.mentors"
                                item-text="displayName"
                                item-value="mentorUserId"
                                label="Mentor"
                            >
                            </v-select>
                            <div class="text-right">
                                <v-btn
                                    :color="brandColor"
                                    class="white--text"
                                    @click.stop="submitStudentMentor"
                                >
                                    Save
                                </v-btn>
                            </div>
                        </v-col>
                    </v-row>
                </v-form>
            </v-col>
        </v-card>
        <v-card class="mb-10" v-if="userHasAccessToSection('mentors')">
            <v-toolbar
                flat
                dark
                :color="brandColor"
            >
                <v-toolbar-title>Mentor Info</v-toolbar-title>
            </v-toolbar>

            <v-col
                cols="12"
                class="pa-4 column"
            >
                <v-form
                    v-show="isMentor"
                >
                    <v-row
                        align="center"
                    >
                        <v-col
                            class="column xs-6"
                        >
                            <v-text-field
                                v-model="$_supportedBrands"
                                label="Supported Brands"
                                :color="brandColor"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="$_totalStudentCount"
                                label="Total Student Count"
                                :color="brandColor"
                                required
                                readonly
                            ></v-text-field>
                            <v-text-field
                                v-model="$_activeStudentCount"
                                label="Active Student Count"
                                :color="brandColor"
                                required
                                readonly
                            ></v-text-field>
                            <v-text-field
                                v-model="$_activeStudentMaxCount"
                                label="Active Student Max Count"
                                :color="brandColor"
                                required
                            ></v-text-field>
                            <div style="display:inline-block;float:left;">
                                <v-btn
                                    color="error"
                                    class="white--text"
                                    @click.stop="demoteMentor"
                                >
                                    Demote Mentor
                                </v-btn>
                            </div>
                            <div style="display:inline-block;float:right;">
                                <v-btn
                                    :color="brandColor"
                                    class="white--text"
                                    @click.stop="submitMentorInfo"
                                >
                                    Save
                                </v-btn>
                            </div>
                        </v-col>
                    </v-row>
                </v-form>
                <div
                    v-show="!isMentor"
                    class="text-right"
                >
                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        @click.stop="promoteMentor"
                    >
                        Promote Mentor
                    </v-btn>
                </div>
            </v-col>
        </v-card>
        <v-dialog
            v-model="demoteDialog"
            max-width="800px"
            persistent
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>Mentor Demoted</v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <div class="text-right">
                        <v-btn
                            text
                            class="mr-1"
                            @click="copyDemotedMentors"
                        >
                            Copy Emails
                        </v-btn>
                        <v-btn
                            text
                            class="mr-1"
                            @click="closeDemoteDialog"
                        >
                            Close
                        </v-btn>
                    </div>
                    <div>The following {{ this.demotedMentors.length }} users have been automatically assigned a new
                        mentor:
                    </div>
                    <div id="demotedMentorDiv">
                        <div v-for="mentor in this.demotedMentors"> {{ mentor }}</div>
                    </div>
                </v-col>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
import {mapState, mapActions} from 'vuex';
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';
import mentorAPI from '../../../api/mentors';

export default {
    name: 'UserMentor',
    mixins: [brandColors],
    props: {
        thisUser: Object,
    },
    data() {
        return {
            userId: this.$route.params.id,
            mentorId: 0,
            mentors: [this.noMentor],
            mentor: {
                supported_brands: 'drumeo, pianote, guitareo, singeo',
                total_student_count: 0,
                active_student_count: 0,
                active_student_max_count: 5000,
            },
            noMentor: {
                displayName: ''
            },
            isMentor: false,
            demoteDialog: false,
            demotedMentors: [],
        };
    },
    watch: {},
    mounted() {
        this.fetchData();
    },
    computed: {
        ...mapState({
            state: state => state.users,
            currentUser: state => state.auth.currentUser,
        }),

        $_mentor: {
            cache: false,
            get() {
                return this.mentorId;
            },
            set(val) {
                this.mentorId = val;
            },
        },
        $_supportedBrands: {
            get() {
                return this.mentor.supported_brands;
            },
            set(value) {
                this.mentor.supported_brands = value;
            },
        },
        $_totalStudentCount: {
            get() {
                return this.mentor.total_student_count;
            },
            set(value) {
                this.mentor.total_student_count = value;
            },
        },
        $_activeStudentCount: {
            get() {
                return this.mentor.active_student_count;
            },
            set(value) {
                this.mentor.active_student_count = value;
            },
        },
        $_activeStudentMaxCount: {
            get() {
                return this.mentor.active_student_max_count;
            },
            set(value) {
                this.mentor.active_student_max_count = value;
            },
        },
    },
    methods: {
        fetchData() {
            mentorAPI.getMentorIdByStudent(this.userId)
                .then((response) => {
                    if (response) {
                        this.mentorId = response.data;
                    }
                });
            mentorAPI.getMentors()
                .then((response) => {
                    if (response) {
                        this.mentors = response.data;
                        this.mentors.splice(0, 0, this.noMentor);
                    }
                });
            mentorAPI.getMentorInfo(this.userId)
                .then((response) => {
                    if (response && response.data) {
                        this.mentor = response.data;
                        this.isMentor = true;
                    }
                });
        },
        submitStudentMentor() {
            this.$root.$emit('pageLoading');
            mentorAPI.updateStudentMentor(this.userId, this.mentorId)
                .then(({response, error}) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Student Mentor successfully updated!',
                            color: 'success',
                        });

                        this.$emit('formSuccess');
                    } else {
                        let message = 'Oops something went wrong. Student Mentor not saved.';

                        if (error && error.message) {
                            message = `Error updating Student Mentor: ${error.message}`;
                        }

                        this.$root.$emit('displayMessage', {
                            text: message,
                            color: 'error',
                            timeout: 15000,
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },
        submitMentorInfo() {
            this.$root.$emit('pageLoading');
            mentorAPI.updateMentor(this.userId, this.mentor.supported_brands, this.mentor.active_student_max_count)
                .then(({response, error}) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Mentor Info successfully updated!',
                            color: 'success',
                        });

                        this.$emit('formSuccess');
                    } else {
                        let message = 'Oops something went wrong. Mentor Info not saved.';

                        if (error && error.message) {
                            message = `Error updating Mentor Info: ${error.message}`;
                        }

                        this.$root.$emit('displayMessage', {
                            text: message,
                            color: 'error',
                            timeout: 15000,
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },
        demoteMentor() {
            if (!confirm('Are you sure you wish to demote this mentor?  All students shall be automatically reassigned.')) return;
            this.$root.$emit('pageLoading');
            mentorAPI.demoteMentor(this.userId)
                .then(({response, error}) => {
                    if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Mentor Demoted successfully',
                            color: 'success',
                        });
                        this.demotedMentors = response.data;
                        this.demoteDialog = true;
                        this.isMentor = false;
                        this.mentor.active_student_count = 0;
                        this.mentor.total_student_count = 0;
                        this.$emit('formSuccess');
                    } else {
                        let message = 'Oops something went wrong. Mentor not demoted.';

                        if (error && error.message) {
                            message = `Error demoting Mentor: ${error.message}`;
                        }

                        this.$root.$emit('displayMessage', {
                            text: message,
                            color: 'error',
                            timeout: 15000,
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },
        promoteMentor() {
            this.isMentor = true;
        },
        closeDemoteDialog() {
            this.demoteDialog = false;
            this.demotedMentors = [];
        },
        copyDemotedMentors() {
            let copyText = document.getElementById('demotedMentorDiv').innerText;
            navigator.clipboard.writeText(copyText);
        },
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