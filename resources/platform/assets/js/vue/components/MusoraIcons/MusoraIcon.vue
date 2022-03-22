<template>
    <svg xmlns="http://www.w3.org/2000/svg"
        :aria-labelledby="iconName"
        version="1.1"
        :width="width" 
        :height="height" 
        :viewBox="viewBox"
    >
        <use 
            :xlink:href="iconID" 
            x="0" 
            y="0"
        >
        </use>
    </svg>
</template>
<script>

export default {
    name: 'MusoraIcon',
    props: {
        iconName: {
            type: String,
            default: 'box',
        },
        width: {
            type: [Number, String],
            default: '20px',
        },
        height: {
            type: [Number, String],
            default: '20px',
        },
        viewBox: {
            type: [Number, String],
            default: '0 0 20 20',
        },
    },
    computed: {
        iconID() {
            return `#icon-${this.iconName}`;
        },
    },
};
</script>

<style scoped>
    svg:not(:root) {
        overflow: visible;
    }
</style>
