<template>
    <v-container>
        <v-row align="center">
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>

            <v-col
                class="column"
                cols="12"
                style="max-width:816px;margin:0 auto;"
            >
              <iframe src="https://docs.google.com/document/d/e/2PACX-1vRcVkYJXCkM9NNw1yixTaywYQsyLEoU8WxP3h0dSHO1rcR-TJ3odzAl05V68TE3zNWoxv303_QP81Or/pub?embedded=true"
              style="width: 100%; height: 1080px; border: 0;"></iframe>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs.vue';
import axios from 'axios';
import brandColors from '../../api/mixins';

export default {
    name: 'Changelog',
    components: {
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors],
    data() {
        return {
            breadcrumbs: [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: 'Changelog',
                    disabled: true,
                },
            ],
            changelog: '',
        };
    },
    mounted() {
        this.getChangelog();
    },
    methods: {
        getChangelog() {
            axios.get('/changelog.md')
                .then((response) => {
                    this.changelog = response.data;
                });
        },
    },
};
</script>
