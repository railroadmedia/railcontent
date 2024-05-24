<template>
    <div class="text-editor-container tw-flex tw-flex-col tw-w-full" v-if="renderTinyMCE">
        <ImageUploader v-if="showImageUploader" :skipCrop="true" :selfContained="true"
            uploadServiceRoute="/musora-api/v5/picture/upload-from-s3"
            successMessage="Your image was successfully uploaded" fieldKey="forum_post_photo" cropType="square"
            :selectedImage="selectedImage" :initialStep="initialUploaderStep" @uploadSuccess="handleUploadDone"
            @uploadError="handleUploadError" @onUploaderClose="closeUploader" />
        <input v-model="contentInterface" type="hidden" :name="fieldKey">
        <TinyEditor v-model="contentInterface" api-key="g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc"
            :init="initObject" :placeholder="placeholder" />
    </div>
</template>

<script setup>
import { ref, computed, watch, nextTick, inject, onMounted } from 'vue';
import TinyEditor from '@tinymce/tinymce-vue';
import ImageUploader from '../../../components/ImageUploader/ImageUploader.vue';

const props = defineProps({
    height: {
        type: Number,
        default: 300,
    },
    toolbar: {
        type: String,
        default: 'bold italic underline | bullist numlist | link | forecolor backcolor | emoticons',
    },
    hasImageUploader: {
        type: Boolean,
        default: false,
    },
    initialValue: {
        default: null,
    },
    fieldKey: {
        type: String,
        default: 'content',
    },
    placeholder: {
        type: String,
        default: '',
    },
    isStudentComment: {
        type: Boolean,
        default: true,
    },
});

const isDarkModeSelected = inject('isDarkModeSelected');
const renderTinyMCE = ref(true);
const contentInterface = defineModel();
const editorRef = ref(null);
const showImageUploader = ref(false);
const initialUploaderStep = ref('dropzone');
const selectedImage = ref(null);

const computedToolbar = computed(() => {
    if (props.hasImageUploader) {
        return 'bold italic underline | bullist numlist | link customImageUploader media | forecolor backcolor | emoticons';
    } else if (props.isStudentComment) {
        return 'link | emoticons';
    }

    return props.toolbar;
});

const initObject = computed(() => ({
    autoresize_min_height: props.height,
    body_class: `${isDarkModeSelected.value ? 'tw-dark' : ''}`,
    toolbar: computedToolbar.value,
    branding: false,
    content_id: '#textEditor',
    content_style: `body.tw-dark { color: white } body { font-family: sans-serif; font-size:16px; font-weight:400; } p { margin:0; } blockquote { margin: 0 0 0 1em !important; padding: 10px 30px !important; border-radius: 7px; border-left: 3px solid;} blockquote.pianote { border-color: #F61A30 !important; background-color: rgb(246 26 48 / 5%); } blockquote.drumeo { border-color: #0B76DB !important; background-color: rgb(11 118 219 / 5%); } blockquote.guitareo { border-color: #00C9AC !important; background-color: rgb(0 201 172 / 5%); } blockquote.singeo { border-color: #8300E9 !important; background-color: rgb(131 0 233 / 5%) } .quote-heading em { text-transform:uppercase; } span.post-id { display:none; } body.tw-dark.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #9EC0DC; } body.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before { color: #223F57; } `,
    convert_urls: false,
    default_link_target: '_blank',
    elementpath: false,
    entity_encoding: 'numeric',
    emoticons_database: 'emojis',
    file_picker_types: props.hasImageUploader ? 'image' : null,
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
    setup: (editor) => {
        setupCustomImageUploaderPlugin(editor);

        editor.on('input', () => {
            editor.save();
        });

        editor.on('drop', (e) => handleEditorDrop(e, editor));

        editorRef.value = editor;
    },
}));

watch(initObject, (newInit, oldInit) => {
    if (newInit.body_class !== oldInit.body_class) {
        forceReRender();
    }
});

onMounted(() => {
    if (props.initialValue != null) {
        contentInterface.value = props.initialValue;
    }
});

function forceReRender() {
    renderTinyMCE.value = false;
    nextTick(() => {
        renderTinyMCE.value = true;
    });
}

function closeUploader() {
    showImageUploader.value = false;
}

const getFileBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});

async function handleEditorDrop(event) {
    event.preventDefault();
    const files = event.dataTransfer.files;
    if (files.length) {
        selectedImage.value = await getFileBase64(files[0]);
        initialUploaderStep.value = 'upload';
        showImageUploader.value = true;
    }
}

function setupCustomImageUploaderPlugin(editor) {
    editor.ui.registry.addButton('customImageUploader', {
        icon: 'image', // You can choose an icon here or use text: 'Upload Image'
        tooltip: 'Upload image',
        onAction: function () {
            showImageUploader.value = true;
        }
    });
}

function handleUploadDone(uploadResponse) {
    editorRef.value.insertContent(`<img src="${uploadResponse.url}" class="tw-max-w-full tw-h-auto tw-rounded-lg tw-shadow" />`);
    showImageUploader.value = false;
    initialUploaderStep.value = 'dropzone';
    selectedImage.value = null;
}

function handleUploadError() {
    window.shownotification({
        icon: 'error',
        text: 'There was an error uploading this image, please try again later.'
    });
    showImageUploader.value = false;
}


</script>

<style scoped>
.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
    color: red;
}
</style>
