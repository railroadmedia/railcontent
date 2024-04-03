<template>
    <div class="text-editor-container tw-flex tw-flex-col tw-w-full" v-if="renderTinyMCE">
        <input v-model="contentInterface" type="hidden" :name="fieldKey" class="">
        <TinyEditor v-model="contentInterface" api-key="g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc"
            :init="initObject" @change="handleInput" :placeholder="placeholder" />
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, computed, watch, nextTick, inject, onUpdated } from 'vue';
import TinyEditor from '@tinymce/tinymce-vue';
import { isNull } from 'lodash';
// TODO: Add image upload functionality
// import { storeToRefs } from 'pinia';
// import { useUserStore } from '../../../../stores/user';
// import {v4 as uuidv4} from 'uuid';

// const userStore = useUserStore();
// const { userId } = storeToRefs(userStore);

const emit = defineEmits(['input']);

const props = defineProps({
    height: {
        type: Number,
        default: 300,
    },
    toolbar: {
        type: String,
        default: 'bold italic underline | bullist numlist | link media | forecolor backcolor | emoticons',
    },
    imageUploadEndpoint: {
        type: String,
        default: null,
    },
    initialValue: {
        default: null,
    },
    fieldKey: {
        type: String,
        default: 'content',
    },
    isReplySection: {
        type: Boolean,
        default: false,
    },
    placeholder: {
        type: String,
        default: '',
    },
});

const isDarkModeSelected = inject('isDarkModeSelected');
const currentValue = ref(props.initialValue);
const renderTinyMCE = ref(true);
const contentInterface = defineModel();

const initObject = computed(() => ({
    autoresize_min_height: props.height,
    body_class: `${isDarkModeSelected.value ? 'tw-dark' : ''}`,
    toolbar: props.toolbar,
    branding: false,
    content_id: '#textEditor',
    content_style: `body.tw-dark { color: white } body { font-family: sans-serif; font-size:16px; font-weight:400; } p { margin:0; } blockquote { margin: 0 0 0 1em !important; padding: 10px 30px !important; border-radius: 7px; border-left: 3px solid;} blockquote.pianote { border-color: #F61A30 !important; background-color: rgb(246 26 48 / 5%); } blockquote.drumeo { border-color: #0B76DB !important; background-color: rgb(11 118 219 / 5%); } blockquote.guitareo { border-color: #00C9AC !important; background-color: rgb(0 201 172 / 5%); } blockquote.singeo { border-color: #8300E9 !important; background-color: rgb(131 0 233 / 5%) } .quote-heading em { text-transform:uppercase; } span.post-id { display:none; } body.tw-dark.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #9EC0DC; } body.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #223F57; } `,
    convert_urls: false,
    default_link_target: '_blank',
    elementpath: false,
    entity_encoding: 'numeric',
    emoticons_database: 'emojis',
    file_picker_types: props.imageUploadEndpoint ? 'image' : null,
    height: props.height,
    image_description: false,
    image_dimensions: false,
    link_assume_external_targets: true,
    link_title: false,
    menubar: false,
    media_poster: false,
    media_dimensions: false,
    media_alt_source: false,
    paste_as_text: true,
    plugins: 'lists link image media autolink autoresize emoticons',
    images_file_types: 'jpg,svg,webp,png',
    relative_urls: false,
    resize: false,
    statusbar: false,
    target_list: false,
    images_upload_url: props.imageUploadEndpoint,
    automatic_uploads: !!props.imageUploadEndpoint,
    images_reuse_filename: true,
    images_upload_handler: handleImageUpload,
    setup: (editor) => {
        editor.on('input', () => {
            editor.save();
        });

        editor.on('drop', (e) => handleEditorDrop(e, editor));
    },
}));

watch(initObject, (newInit, oldInit) => {
    if (newInit.body_class !== oldInit.body_class) {
        forceReRender();
    }
});

function handleInput() {
    emit('input', {
        currentValue: currentValue.value,
    });
}

function forceReRender() {
    renderTinyMCE.value = false;
    nextTick(() => {
        renderTinyMCE.value = true;
    });
}

function handleEditorDrop(event, editor) {
    event.preventDefault();
    /*
    TODO: Add image upload functionality
    const files = event.dataTransfer.files;
    if (files.length) {
        const newFileName = `comment_${userId}_${uuidv4()}.png`;
        const formData = new FormData();
        formData.append('image', files[0]);
        formData.append('target', newFileName);
        formData.append('_method', 'POST');
        formData.append('fieldKey', 'comment_tinymce_image');

        Vapor.store(formData.get('image'), {
            visibility: 'public-read',
        }).then((response) => {
            editor.insertContent(`<img src="${response.url}" />`);
        });
    }
    */
}



async function handleImageUpload(blobInfo, success, failure, progress) {
    console.log(blobInfo, success, failure, progress);
    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    console.log(formData);

    try {
        const response = await axios({
            method: 'post',
            url: props.imageUploadEndpoint,
            data: formData,
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: function (e) {
                progress(parseInt(Math.round((e.loaded * 100) / e.total)));
            }
        });

        console.log('then response', response);
        // Handle success
        const json = response.data;
        if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + JSON.stringify(json));
            return;
        }
        success(json.location);
    } catch (error) {
        console.error(error);
        window.shownotification({
            icon: 'error',
            text: 'This is Embarrassing That didn\'t work. Refresh the page and try once more, if it happens again please let us know using the chat below.'
        });
    }
}

</script>

<style scoped>
.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
    color: red;
}
</style>
