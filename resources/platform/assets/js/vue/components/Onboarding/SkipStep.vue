<script setup>
import axios from "axios";
import Toasts from "../../vuesora/assets/js/classes/toasts";
import {skipAccountSetup} from "./services";

const props = defineProps({
    title: {
        type: String,
        default: 'SKIP ACCOUNT SETUP'
    },
    brand: {
        type: String,
        default: 'drumeo'
    },
    step: {
        type: String,
        default: null
    }
})

const handleError = (response) => {
    let title = 'Oops, something went wrong';
    let message = 'An error happened on the server, please contact support using the '
        + 'chat widget at the bottom of your screen';

    if (response.data.errors) {
        title = response.data.errors[0].title;
        message = response.data.errors[0].detail;
    }

    Toasts.push({
        icon: 'sad',
        themeColor: this.themeColor,
        title,
        message,
        timeout: 7500,
    });
}
const handleSkip = () => {
  skipAccountSetup(
    {
      skippedStep: props.step,
      brand,
    })
    .then(() => window.location.href = '/' + props.brand)
    .catch(handleError)
};
</script>

<template>
    <button
        class="tw-mt-[12px] tw-text-[18px] tw-text-white tw-underline tw-font-bebas-neue"
        v-on:click="handleSkip"
    >
        {{ title }}
    </button>
</template>
