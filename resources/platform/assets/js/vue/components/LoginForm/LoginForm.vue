<script setup>
import { bgColor } from "../../../constants/brands"
import InputLabel from "../InputLabel/InputLabel.vue"
const props = defineProps({
    brand: {
        type: String,
    },
    loginurl: {
        type: String,
    },
    reseturl: {
        type: String,
    },
    joinurl: {
        type: String,
    },
    usecsrftoken: {
        type: Boolean,
    },
    errors: {
        type: Array,
    },
    hassessionstatus: {
        type: Boolean,
    },
    sessionstatus: {
        type: String,
    }
})
</script>

<template>
<section id="loginForm" class="tw-flex tw-flex-col tw-bg-[#081825]/[90] tw-p-4 tw-mb-3 tw-rounded-xl tw-w-[423px] tw-h-[369px]">
    <form method="post" :action="loginurl" class="tw-flex tw-flex-col">
        <slot v-if="usecsrftoken" name="csrf"></slot>
        <ul v-if="errors.length > 0" class="tw-flex tw-flex-col tw-mb-3 tiny text-error list-style-none">
            <li v-for="(error, i) in errors" v-bind:key="i+'error'">{{ error }}</li>
        </ul>
        <ul v-if="hassessionstatus" class="tw-flex tw-flex-col tw-mb-2 tiny text-success list-style-none">
            <li>{{ sessionstatus }}</li>
        </ul>
        <div class="tw-flex tw-flex-col tw-mb-2">   
            <InputLabel
                :brand="brand"
                inputType="email"
                id="loginEmail"
                inputName="email"
                labelValue="Email Address"
                :inputErrors="[]"
            />
        </div>

        <div class="tw-flex tw-flex-col tw-mb-2">
            <InputLabel
                :brand="brand"
                inputType="password"
                id="loginPassword"
                inputName="password"
                labelValue="Password"
                :inputErrors="[]"
            />
        </div>

        <button type="submit" class="btn tw-mb-3" dusk="submit-button">
            <span :class="`tw-text-white ${bgColor[brand]}`">Sign In</span>
        </button>
    </form>

    <a id="resetToggle" class="tiny text-center text-grey-3 noselect">Forgot your password?</a>
</section>

<section id="resetForm" class="tw-flex tw-flex-col bg-grey-1 pa-3 tw-mb-3 corners-10 hide">

    <p class="tiny tw-mb-2 text-grey-3">Please enter your email address and we will send you instructions to reset your
        password.</p>

    <form method="post" :action="reseturl" class="tw-flex tw-flex-col">
        <slot v-if="useCsrfToken" name="csrf"></slot>

        <div class="form-group tw-mb-2">
            <input id="resetEmail" type="email" name="email">
            <label for="resetEmail" :class="brand ?? ''">Email Address</label>
        </div>

        <button type="submit" class="btn tw-mb-3">
            <span :class="`tw-text-white ${bgColor[brand]}`">Get New Password</span>
        </button>
    </form>

    <a id="loginToggle" class="tiny tw-text-center text-grey-3 noselect">Back to Login</a>
</section>
</template>