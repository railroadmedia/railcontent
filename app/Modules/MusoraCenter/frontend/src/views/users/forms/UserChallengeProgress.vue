<template>
    <v-card class="mt-10">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Challenge Progress</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-tooltip left>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            icon
                            text
                            class="mx-0"
                            v-on="on"
                            @click="openAddForm"
                        >
                            <v-icon>add</v-icon>
                        </v-btn>
                    </template>
                    <span>Add Challenge Enrollment</span>
                </v-tooltip>
            </v-toolbar-items>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="challengeProgress"
            :items-per-page="5"
            no-results-text="No Results Found"
            class="elevation-1"
        >
            <template v-slot:item="{ item }">
                <tr>
                    <td class="text-center">
                        <v-custom-brand-icon :brand="item.brand"></v-custom-brand-icon>
                    </td>

                    <td class="text-left">
                        {{ item.challengeId }}
                    </td>

                    <td class="text-center">
                        {{ item.owned}}
                    </td>

                    <td class="text-left">
                        {{ item.name }}
                    </td>

                    <td class="text-center">
                        {{ item.isSolo ? 'Solo' : 'Community' }}
                    </td>

                    <td class="text-center">
                        {{ item.isCurrentlyEnrolled }}
                    </td>

                    <td class="text-center">
                        {{ item.isInUnguidedExperience }}
                    </td>

                    <td class="text-center">
                        {{ item.mostRecentEnrollDate }}
                    </td>

                    <td class="text-center">
                        {{ item.startDate }}
                    </td>
                </tr>
            </template>
        </v-data-table>


        <v-dialog
            v-model="openAddModal"
            max-width="500px"
        >
            <v-card>
                <v-toolbar flat dark :color="brandColor">
                    <v-toolbar-title>
                        Add Challenge Enrollment
                    </v-toolbar-title>
                </v-toolbar>

                <v-col cols="12" class="pa-4 column">
                    <v-form lazy-validation>
                        <v-text-field
                            v-model="challengeId"
                            type="number"
                            label="Challenge ID"
                            :color="brandColor"
                        ></v-text-field>
                        <div class="text-right">
                            <v-btn
                                text
                                @click.stop="closeAddForm"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :color="brandColor"
                                @click.stop="submitAddForm"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import api from '../../../api/users';
import brandColors from '../../../api/mixins.js';
import CustomBrandIcon from '../../../components/CustomBrandIcon.vue';

export default {
    name: 'UserChallengeProgress',
    components: {
        'v-custom-brand-icon': CustomBrandIcon,
    },
    mixins: [brandColors],
    props: {
        userId: {
            type: Number | String,
            default: () => 0,
        },
        challengeProgress: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            headers: [
                {
                    text: 'Brand',
                    align: 'center',
                    sortable: false,
                    width: 100,
                },
                {
                    text: 'Challenge ID',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Owned',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Name',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'Solo/Community',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Currently Enrolled',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'In Unguided Experience',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Most Recent Enroll Date',
                    align: 'center',
                    sortable: false,
                },
                {
                    text: 'Start Date',
                    align: 'center',
                    sortable: false,
                },
            ],
            openAddModal: false,
            challengeId: null,
        };
    },
    mounted() {

    },
    methods: {
        openAddForm(){
            this.openAddModal = true;
        },
        closeAddForm(){
            this.openAddModal = false;
            this.challengeId = null;
        },
        submitAddForm(){
            api.enrollUser(this.challengeId, this.userId)
                .then((response) => {
                    if(response){
                        this.$emit('getUserChallengeProgress');
                        this.closeAddForm();
                    } else {
                        this.$emit('displayMessage', {
                            color: 'error',
                            text: 'Something went wrong. Lesson likely not moved.',
                        });
                    }
                })


        }
    },
};
</script>
