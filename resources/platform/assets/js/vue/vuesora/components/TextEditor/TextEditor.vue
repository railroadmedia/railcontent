<template>
    <div class="text-editor-container tw-flex tw-flex-col tw-w-full" v-if="renderTinyMCE">
        <input v-model="contentInterface" type="hidden" :name="fieldKey" class="">
        <tinymce-editor v-model="contentInterface" api-key="g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc"
            :init="initObject" @change="handleInput" :placeholder="placeholder"
        ></tinymce-editor>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    name: 'TextEditor',
    components: {
        'tinymce-editor': Editor,
    },
    inject: ['isDarkModeSelected'],
    model: {
        prop: 'contentInterface',
        event: 'input',
    },
    props: {
        height: {
            type: Number,
            default: () => 300,
        },
        toolbar: {
            type: String,
            default: () => 'bold italic underline | bullist numlist | link image media | forecolor backcolor | emoticons',
        },
        imageUploadEndpoint: {
            type: String,
            default: () => null,
        },
        initialValue: {
            default: () => null,
        },
        fieldKey: {
            type: String,
            default: () => 'content',
        },
        isReplySection: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String,
            default: () => '',
        },
    },

    data() {
        return {
            currentValue: this.initialValue,
            renderTinyMCE: true,
        };
    },

    watch: {
        initObject(newInit, oldInit) {
            if (newInit.body_class !== oldInit.body_class) {
                this.forceReRender();
            }
        }
    },

    computed: {
        contentInterface: {
            get() {
                return this.currentValue;
            },
            set(val) {
                this.currentValue = val;
            },
        },

        isDarkMode: {
            get() {
                return this.isDarkModeSelected;
            }
        },

        initObject() {
            return {
                autoresize_min_height: this.height,
                body_class: `${this.isDarkMode ? 'tw-dark' : ''}`,
                branding: false,
                content_id: '#textEditor',
                content_style: `body.tw-dark { color: white } body { font-family: sans-serif; font-size:16px; font-weight:400; } p { margin:0; } blockquote { margin: 0 0 0 1em !important; padding: 10px 30px !important; border-radius: 7px; border-left: 3px solid;} blockquote.pianote { border-color: #F61A30 !important; background-color: rgb(246 26 48 / 5%); } blockquote.drumeo { border-color: #0B76DB !important; background-color: rgb(11 118 219 / 5%); } blockquote.guitareo { border-color: #00C9AC !important; background-color: rgb(0 201 172 / 5%); } blockquote.singeo { border-color: #8300E9 !important; background-color: rgb(131 0 233 / 5%) } .quote-heading em { text-transform:uppercase; } span.post-id { display:none; } body.tw-dark.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #9EC0DC; } body.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #223F57; } `,
                convert_urls: false,
                default_link_target: '_blank',
                elementpath: false,
                entity_encoding: 'numeric',
                emoticons_database: 'emojis',
                file_picker_types: 'image',
                height: this.height,
                image_description: false,
                image_dimensions: false,
                images_upload_url: this.imageUploadEndpoint,
                link_assume_external_targets: true,
                link_title: false,
                menubar: false,
                media_poster: false,
                media_dimensions: false,
                media_alt_source: false,
                paste_as_text: true,
                plugins: 'lists link image media autolink autoresize emoticons',
                relative_urls: false,
                resize: false,
                statusbar: false,
                target_list: false,
                toolbar: this.toolbar,
                setup: (editor) => {
                    editor.on('input', () => {
                        editor.save();
                    });
                },
            };
        },
    },
    methods: {
        handleInput() {
            this.$emit('input', {
                currentValue: this.currentValue,
            });
        },
        forceReRender() {
            this.renderTinyMCE = false;

            this.$nextTick().then(() => {
                this.renderTinyMCE = true;
            });
        }
    },
}
</script>

<style scoped>
    .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
        color: red;
    }
</style>

