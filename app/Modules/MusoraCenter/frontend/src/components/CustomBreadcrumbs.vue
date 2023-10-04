<template>
    <v-breadcrumbs
        divider="/"
        :items="breadcrumbs"
        :color="brandColor"
    >
        <template
            slot="item"
            slot-scope="props"
        >
            <router-link
                v-if="props.item.to"
                :to="props.item.to"
                class="v-breadcrumbs__item"
                :class="[[props.item.disabled && 'disabled'], brandTextColor]"
            >
                {{ props.item.text }}
            </router-link>
            <a
                v-else
                disabled="disabled"
                class="v-breadcrumbs__item v-breadcrumbs__item--disabled"
            >
                {{ props.item.text }}
            </a>
        </template>
    </v-breadcrumbs>
</template>
<script>
import brandColors from '../api/mixins.js';

export default {
    name: 'VCustomBreadcrumbs',
    mixins: [brandColors],
    props: {
        breadcrumbs: {
            type: Array,
            default: () => [],
        },
    },
};
</script>
