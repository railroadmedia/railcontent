<script setup>
import { ref } from 'vue'
import { XIcon, PhotographIcon } from '@heroicons/vue/outline'
const emit = defineEmits(['onImageSelected'])

const dragged = ref(false);
const error = ref('');

function handleDragover (e) {
    e.preventDefault();
    if (!dragged.value) {
        dragged.value = true;
    }
}

function handleDragleave () {
    if (dragged.value) {
        dragged.value = false;
    }
}

function handleFile(file) {
   // Make sure `file.name` matches our extensions criteria
    if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
        var reader = new FileReader();
        reader.addEventListener("load", function () {
            emit('onImageSelected', this.result);
        }, false);
        reader.readAsDataURL(file);
    } else {
        error.value = 'The file type is not supported'
    }
}

function handleDropzoneClick(e) {
    e.preventDefault();
    document.getElementById('fileUploadInput').click();
}

function handleFileChange() {
    const input = document.getElementById('fileUploadInput');
    var file = input.files[0];
    handleFile(file);
}

function handleDrop(e) {
    e.preventDefault();
    dragged.value = false;

    if (e.dataTransfer.items && e.dataTransfer.items.length === 1) {
        if (e.dataTransfer.items[0].kind === 'file') {
            var file = e.dataTransfer.items[0].getAsFile();
            handleFile(file)
        }
    } else {
        error.value = 'Select a single image'
    }
}
</script>

<template>
    <div
        :class="`hover:tw-cursor-pointer tw-relative tw-mx-[40px] tw-border-2 tw-border-dashed tw-border-[#445F74] hover:tw-border-[#65656B] dark:hover:tw-border-[#9EC0DC] tw-w-auto tw-h-[223px] tw-rounded-[6px] tw-pb-[38px]  ${dragged ? 'tw-border-white' : ''}`"
    >
        <div
            v-on:drop="handleDrop"
            v-on:dragover="handleDragover"
            v-on:dragleave="handleDragleave"
            v-on:click="handleDropzoneClick"
            class="tw-absolute tw-h-full tw-w-full tw-bg-transparent tw-z-40"
        />
        <div v-if="dragged" class="tw-absolute tw-h-full tw-w-full tw-bg-black tw-bg-opacity-40 tw-flex tw-items-center tw-justify-center tw-rounded-[6px] tw-text-white tw-text-2xl">
            Drop image
        </div>
        <div class="tw-flex tw-w-full tw-h-full tw-flex-col">
            <div class="tw-flex tw-mt-[38px] tw-w-full tw-justify-center">
                <div class="tw-bg-[#445F74] tw-flex tw-items-center tw-justify-center tw-w-[72px] tw-h-[72px] tw-rounded-full">
                    <PhotographIcon class="tw-text-[#91acc1] tw-w-[32px] tw-h-[32px]" />
                </div>
            </div>
            <div class="tw-w-full tw-text-center dark:tw-text-white tw-mt-[18px] tw-text-[16px] tw-px-[8px]">Drop your image here, or <span class="tw-text-[#3B82F6] tw-font-bold">upload from your computer</span></div>
            <div class="tw-w-full tw-text-center dark:tw-text-white tw-italic tw-text-[14px]">Max file size: 15MB</div>
        </div>
        <input id="fileUploadInput" type="file" style="visibility:hidden" accept=".jpg,.jpeg,.png,.gif" @change="handleFileChange" />
    </div>
</template>
