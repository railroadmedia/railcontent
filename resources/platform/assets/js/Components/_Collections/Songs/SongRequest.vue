<script setup>
import { ref } from 'vue';
import RequestSongModal from "./RequestSongModal.vue";
import PageHeaderCta from "@collections/PageHeader/PageHeaderCta.vue";
const showModal = ref(false);

const handleShowModal = () => {
    showModal.value = !showModal.value;
};

</script>
<template>
    <PageHeaderCta v-bind="$attrs" musoraIconName="eigth-notes-filled" text="Request a song" @click="handleShowModal" />
    <RequestSongModal v-if="showModal" @onCloseModal="handleShowModal" />
</template>
