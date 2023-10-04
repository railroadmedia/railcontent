<template>
    <v-icon
        size="20"
        dark
        style="vertical-align:middle;background-color:white;border-radius:3px;"
        :class="brandColor"
        :data-test-brand="brand"
        :data-test-icon="iconName"
    >
        {{ iconName }}
    </v-icon>
</template>

<script>
export default {
    name: 'VCustomBrandIcon',
    props: {
        brand: {
            type: String,
            default: () => '',
        },
    },
    computed: {
        brandColor() {
            const colorsMap = {
                musora: 'black--text text--accent-2',
                drumeo: 'blue--text text--accent-2',
                pianote: 'red--text',
                guitareo: 'teal--text text--lighten-1',
                recordeo: 'amber--text text--accent-4',
                singeo: 'purple--text text--lighten-1',
            };

            return colorsMap[this.brand] || 'white';
        },

        iconName(){
            const iconMap = {
                musora: 'icon-toolbox',
                drumeo: 'icon-drumeo-edge',
                pianote: 'icon-pianote',
                guitareo: 'icon-guitareo',
                recordeo: 'icon-recordeo',
                singeo: 'icon-singeo',
            };

            return iconMap[this.brand] || 'icon-musora';
        }
    },
};
</script>
