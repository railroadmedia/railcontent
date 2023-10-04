<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Scheduling & Permissions</v-toolbar-title>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form
                v-if="contentModel"
                ref="editForm"
            >
                <v-select
                    v-if="contentModel.permissions"
                    :items="permissionsOptions"
                    :rules="contentModel.permissions.rules"
                    :loading="contentModel.permissions.loading"
                    :menu-props="{ maxHeight: '400' }"
                    :value="$_permissions"
                    :color="brandColor"
                    label="Permissions"
                    item-text="name"
                    item-value="id"
                    multiple
                    @input="handlePermissionChange"
                ></v-select>

                <v-select
                    v-if="contentModel.status"
                    v-model="$_status"
                    :items="['draft', 'scheduled', 'published', 'archived', 'deleted']"
                    :rules="contentModel.status.rules"
                    :loading="contentModel.status.loading"
                    :disabled="contentModel.status.loading"
                    :color="brandColor"
                    label="Status"
                ></v-select>

                <v-custom-datetime-input
                    v-if="contentModel.published_on"
                    v-model="$_published_on"
                    :color="brandColor"
                    label="Publish On"
                    input-key="published_on"
                    :loading="contentModel.published_on.loading"
                    :disabled="contentModel.published_on.loading"
                    @datechange="handleDateChange"
                ></v-custom-datetime-input>

                <v-col v-if="contentModel.live_event_start_time && contentModel.live_event_end_time">
                    <v-subheader class="mt-6">
                        Go Live
                    </v-subheader>
                    <v-divider class="mt-0 mb-4"></v-divider>
                </v-col>

                <v-text-field
                    v-if="contentModel.live_event_youtube_id"
                    v-model="$_live_event_youtube_id"
                    label="Live Event Youtube ID (if set, this always overrides automatic embed)"
                    :color="brandColor"
                    :rules="contentModel.live_event_youtube_id.rules"
                    :loading="contentModel.live_event_youtube_id.loading"
                    :disabled="contentModel.live_event_youtube_id.loading"
                    required
                ></v-text-field>

                <v-custom-datetime-input
                    v-if="contentModel.live_event_start_time"
                    v-model="$_live_event_start_time"
                    :color="brandColor"
                    label="Live Event Start Time"
                    input-key="live_event_start_time"
                    :loading="contentModel.live_event_start_time.loading"
                    :disabled="contentModel.live_event_start_time.loading"
                    @datechange="handleFieldDateChange"
                ></v-custom-datetime-input>

                <v-custom-datetime-input
                    v-if="contentModel.live_event_end_time"
                    v-model="$_live_event_end_time"
                    :color="brandColor"
                    label="Live Event End Time"
                    input-key="live_event_end_time"
                    :loading="contentModel.live_event_end_time.loading"
                    :disabled="contentModel.live_event_end_time.loading"
                    @datechange="handleFieldDateChange"
                ></v-custom-datetime-input>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import brandColors from '../../../api/mixins.js';
import CustomDateTimeInput from '../../../components/CustomDateTimeInput';
import PermissionsApi from '../../../api/permissions';
import ContentStore from '../../../mixins/content-store';
import Utils from '../../../api/utils';
import api from '../../../api/content';

export default {
    name: 'SchedulingPermissions',
    components: {
        'v-custom-datetime-input': CustomDateTimeInput,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            permissionsOptions: [],
        };
    },
    computed: {
        $_status: {
            get() {
                return this.thisPost.status;
            },
            set(val) {
                if (val === 'deleted') {
                    const confirmation = confirm('Are you sure you wish to delete this content? You will need to write down the ID if you wish to return to this page.');

                    if (confirmation) {
                        this.sendSetContentPropertyRequest('status', val, this.post_id);
                    }
                } else {
                    this.sendSetContentPropertyRequest('status', val, this.post_id);
                }
            },
        },

        $_published_on() {
            return this.thisPost.published_on;
        },

        $_permissions() {
            return this.thisPost.permissions;
        },

        $_live_event_youtube_id: {
            get() {
                return this.thisPost.live_event_youtube_id.value;
            },
            set(val) {
                this.sendSetFieldRequest({
                    key: 'live_event_youtube_id',
                    val,
                    deleted: this.isDeleted('live_event_youtube_id', val),
                    child: this.isChild,
                });
            },
        },

        $_live_event_start_time: {
            get() {
                return this.thisPost.live_event_start_time.value || null;
            },
            set(val) {
                return this.thisPost.live_event_start_time.value = val;
            },
        },

        $_live_event_end_time: {
            get() {
                return this.thisPost.live_event_end_time.value || null;
            },
            set(val) {
                this.thisPost.live_event_end_time.value = val;
            },
        },
    },
    mounted() {
        PermissionsApi.getPermissions({
            limit: 100,
        })
            .then((response) => {
                const options = response.data.data.filter(data => data.brand === this.state.brand || data.brand === 'musora');
                this.permissionsOptions = Utils.dynamicSort(options, 'name');
            });
    },
    methods: {
        handlePermissionChange(newArray) {
            function comparer(otherArray) {
                return function (current) {
                    return otherArray.filter(other => other === current).length === 0;
                };
            }

            const onlyInOriginal = this.$_permissions.filter(comparer(newArray));
            const onlyInNew = newArray.filter(comparer(this.$_permissions));

            const changedField = onlyInOriginal.concat(onlyInNew);

            api.handleArrayChange({
                oldArray: this.$_permissions,
                newArray,
                onCreated: () => this.sendSetPermissionRequest({
                    content_id: this.post_id,
                    permission_id: changedField[0],
                    brand: this.state.brand,
                    child: this.isChild,
                }),
                onDeleted: () => this.sendSetPermissionRequest({
                    content_id: this.post_id,
                    permission_id: changedField[0],
                    deleted: true,
                    child: this.isChild,
                }),
            });
        },

        handleDateChange(payload) {
            this.sendSetContentPropertyRequest(payload.key, payload.value, this.post_id, this.isChild);
        },

        handleFieldDateChange(payload) {
            this.sendSetFieldRequest({
                key: payload.key,
                val: payload.value,
                deleted: this.isDeleted(payload.key, payload.value),
                delay: 0,
                child: this.isChild,
            });
        },
    },
};
</script>
