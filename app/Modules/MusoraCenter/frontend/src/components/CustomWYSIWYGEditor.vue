<template>
    <div class="v-custom-wysiwyg-editor">
        <v-subheader
            v-html="label"
            class="pl-0 text-left font-weight-bold text-sm-body-2"
        >
        </v-subheader>
        <div
            ref="textarea"
            class="text-left"
        ></div>
        <v-progress-linear
            v-if="loading"
            :indeterminate="true"
            :color="color"
            height="2"
            class="ma-0"
        ></v-progress-linear>
    </div>
</template>
<script>
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

export default {
    name: 'VCustomWysiwygEditor',
    props: {
        value: {
            type: String,
            default: () => '',
        },
        label: {
            type: String,
            default: () => '',
        },
        rules: {
            type: Array,
            default: () => [],
        },
        loading: {
            type: Boolean,
            default: () => false,
        },
        color: {
            type: String,
            default: () => 'light-blue accent-3',
        },
    },
    data() {
        return {
            quillInstance: null,
            toggle_multiple: [],
            permValue: this.value,
        };
    },
    computed: {
        formattedText: {
            get() {
                return this.permValue;
            },
            set() {
                this.permValue = this.quillInstance.root.innerHTML;
            },
        },
    },
    mounted() {
        const { textarea } = this.$refs;

        this.quillInstance = new Quill(textarea, {
            modules: { toolbar: [['bold', 'italic', 'underline'], ['link']] },
            theme: 'snow',
            formats: ['bold', 'italic', 'underline', 'link'],
        });

        this.quillInstance.root.innerHTML = this.permValue;

        setTimeout(() => {
            this.quillInstance.on('text-change', this.handleInput);
        }, 100);
    },
    methods: {
        handleInput() {
            if (this.quillInstance.getLength() > 1) {
                this.permValue = this.quillInstance.root.innerHTML;
            } else {
                this.permValue = '';
            }

            this.emitInput(this.permValue);
        },

        emitInput(value) {
            this.$emit('input', value);
        },

        emitChange(value) {
            this.$emit('change', value);
        },
    },
};
</script>
<style lang="scss">
    .theme--dark {
        .ql-snow .ql-stroke {
            stroke:#fff;
        }
    }
</style>
