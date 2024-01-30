<template>
    <header class="tw-relative tw-bg-black tw-py-[40px] tw-px-8 2xl:tw-px-0 tw-min-h-[360px] tw-flex tw-items-center">
        <!-- BG Image -->
        <img src="https://www.musora.com/musora-cdn/image/width=1000/https://musora-web-platform.s3.amazonaws.com/stc/SupportHeader.png"
             class="tw-transition-opacity tw-absolute tw-top-0 tw-left-0 tw-object-cover tw-object-top tw-h-full tw-w-full"
             loading="lazy"
             onload="this.classList.remove('tw-opacity-0')"
        >
        <section class="tw-z-10 tw-max-w-screen-lg tw-w-full tw-mx-auto tw-flex tw-flex-col md:tw-flex-row tw-items-center">
            <!-- Instrument Image -->
            <img src="https://www.musora.com/musora-cdn/image/width=300/https://musora-web-platform.s3.amazonaws.com/stc/instruments.png"
                 title="Image of musical instruments"
                 class="tw-w-[250px] tw-h-[250px] tw-flex-shrink-0 sm:tw-mr-8 tw-mb-4 md:tw-mb-0 tw-transition-opacity tw-opacity-0"
                 loading="lazy"
                 onload="this.classList.remove('tw-opacity-0')"
            >
            <!-- Content -->
            <div class="">
                <h1 class="tw-text-3xl tw-mb-4 tw-text-[#9EC0DC] tw-font-semibold">
                    Sign Up for Musora Student Experience Studies and get rewarded with free platform time
                </h1>
                <p class="tw-text-lg tw-text-white">Help us to test new student experiences and make our platforms even better.
                    Students selected to participate in studies will be rewarded with monthly passes.
                    Have questions? <a href="mailto:learning@musora.com" class="tw-font-bold tw-text-white">Get in touch.</a>
                </p>
            </div>
        </section>
    </header>
    <main class="tw-w-full tw-max-w-screen-md tw-mx-auto tw-px-4 md:tw-px-8 tw-my-10 dark:tw-text-white tw-transition-colors tw-flex tw-justify-center">
        <!-- Form Wrapper -->
        <section id="stc-form-wrapper" class="tw-mb-12 tw-w-full">
            <div class="tw-text-center tw-mb-4">
                <h2 class="tw-mb-1 tw-text-2xl md:tw-text-3xl tw-font-bold">Enrollment Questionnaire</h2>
                <p>Please fill out the enrollment questionnaire to be considered for studies</p>
            </div>

            <form id="stc-form" method="POST" class="tw-flex tw-flex-col" @submit.prevent="(event) => submitForm(event)">
                <input id="id" type="hidden" name="id" :value="userId" />
                <!-- Name -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Name</span>
                    <input required id="student_form_name" type="text" name="student_form_name" autocomplete="name" class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <!-- Email -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Email</span>
                    <input required id="student_form_email" type="email" name="student_form_email" autocomplete="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <!-- Age -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Age</span>
                    <select required name="student_form_age" id="student_form_age" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="age in ages" class="bg-white text-black" :value="age['value']">{{ age['value'] }}</option>
                    </select>
                </label>

                <!-- Gender -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Gender</span>
                    <select required name="student_form_gender" id="student_form_gender" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="gender in genders" class="bg-white text-black" :value="gender['value']">{{ gender['value'] }}</option>
                    </select>
                </label>

                <!-- Country -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Country</span>
                    <select required name="student_form_country" id="student_form_country" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="country in countries" class="bg-white text-black" :value="country">{{ country }}</option>
                    </select>
                </label>

                <!-- Languages: Multi-select -->
                <label id="multiSelect" class="tw-flex tw-flex-col tw-mb-2 tw-relative">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Spoken Languages<span>*</span></span>
                    <div class="tw-relative tw-flex tw-justify-start">
                        <select ref="languageInput" name="student_form_languages[]" id="student_form_languages" class="tw-bg-transparent tw-rounded-full tw-absolute tw-w-full tw-h-full tw-min-h-[24px]" @click="languageContainerClick" @change="(event) => selectLanguage(event.target.value)">
                            <option value="" class="bg-white text-black">Select</option>
                            <option v-for="language in languages" class="bg-white text-black" :value="language['value']">{{ language['value'] }}</option>
                        </select>
                        <div class="tw-max-w-[85%] tw-py-2 tw-px-3">
                            <div class="tw-flex tw-flex-wrap tw-gap-2 tw-z-20 tw-items-center tw-min-h-[26px] tw-bg-[#F9F9F9] dark:tw-bg-[#000C18] tw-relative tw-rounded-full">
                                <div v-for="language in selectedLanguages" class="tw-bg-[#FFAE00] tw-text-[#000C17] tw-rounded-full tw-py-[2px] tw-px-2 tw-font-semibold tw-flex tw-items-center">{{ language }} <span @click="selectLanguage(language)" class="tw-cursor-pointer tw-ml-1">x</span></div>
                            </div>
                        </div>
                        <div v-if="selectedLanguages.length" class="tw-absolute tw-right-10 tw-top-0 tw-h-full tw-flex tw-items-center"><XIcon class="tw-w-[13px] tw-h-[13px] tw-cursor-pointer" @click="resetSelectedLanguages" /></div>
                    </div>
                </label>

                <!-- Student Level -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Current Student Level</span>
                    <select required name="student_form_level" id="student_form_level" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="level in levels" class="bg-white text-black" :value="level['value']">{{ level['value'] }}</option>
                    </select>
                </label>

                <!-- Instrument -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Instrument</span>
                    <select v-model="instrumentInput" required name="student_form_instruments" id="student_form_instruments" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="instrument in instruments" class="bg-white text-black" :value="instrument['value']">{{ instrument['value'] }}</option>
                    </select>
                </label>
                <label v-if="instrumentInput === 'Other'" id="student_form_other-instrument" class="tw-flex tw-flex-col tw-ml-4 tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0 tw-capitalize">Your Instrument</span>
                    <input required id="student_form_instrument" type="text" name="student_form_instrument" autocomplete="student_form_instrument"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <!-- Learning Goal -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Learning Goal</span>
                    <select v-model="goalInput" required name="student_form_goals" id="student_form_goals" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="goal in goals" class="bg-white text-black" :value="goal['value']">{{ goal['value'] }}</option>
                    </select>
                </label>
                <label v-if="goalInput === 'Other'" id="student_form_other-goal" class="tw-flex tw-flex-col tw-ml-4 tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0 tw-capitalize">Learning Goal</span>
                    <input required id="student_form_goal" type="text" name="student_form_goal" autocomplete="student_form_goal"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <!-- Student Length -->
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">For how long have you been a Musora student?</span>
                    <select required name="student_form_student-length" id="student_form_student-length" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="year in experience" class="bg-white text-black" :value="year['value']">{{ year['value'] }}</option>
                    </select>
                </label>

                <!-- Membership Type -->
                <label class="tw-flex tw-flex-col tw-mb-6">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Membership Type</span>
                    <select required name="student_form_type" id="student_form_type" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        <option v-for="type in types" class="bg-white text-black" :value="type['value']">{{ type['value'] }}</option>
                    </select>
                </label>

                <!-- Note on Languages -->
                <small class="tw-text-sm tw-mb-2">
                    *Please select all languages in which you have a native or near-native proficiency
                    <i tabindex="0"  aria-describedby="stc_tooltip" class="tw-relative tw-group tw-cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-labelledby="info" version="1.1" width="36" height="35" viewBox="0 0 36 35" class="tw-inline-block tw-w-[20px] tw-h-[20px] group-focus:tw-text-drumeo"><use data-v-a55a9eb4="" xlink:href="#icon-info" x="0" y="0"></use></svg>
                        <!-- Tooltlip -->
                        <div role="tooltip" id="stc_tooltip" class="group-focus:tw-block tw-hidden tw-w-[250px] tw-p-1 tw-rounded tw-text-xs tw-text-black tw-bg-white tw-border tw-border-gray-500 tw-shadow tw-absolute tw-right-0 tw-bottom-full tw-z-10">
                            Some studies may involve rating the quality of content translation or subtitles in other languages.
                        </div>
                    </i>
                </small>

                <!-- Consent Message -->
                <label class="tw-mb-6">
                    <input
                        v-model="consentBox"
                        class="tw-mr-2 tw-rounded dark:tw-border-[#445F74] tw-border-[#D1D5DB] checked:tw-bg-black dark:checked:tw-bg-[#002039] dark:tw-bg-[#002039] tw-bg-[#E7EFF6]"
                        type="checkbox"
                        id="student_form_consent"
                        name="student_form_consent"
                    />
                    <span class="tw-text-sm">I consent to be occasionally contacted to participate in User Research Studies or interviews dedicated to
                        collecting feedback or improving Musora products and services.
                    </span>
                </label>

                <button
                    :disabled="!consentBox"
                    type="submit"
                    id="submit-button"
                    class="md:tw-ml-auto disabled:tw-opacity-70 tw-transition-all tw-btn tw-btn-primary dark:tw-bg-white dark:tw-text-black tw-bg-black tw-text-white"
                >
                    Submit
                </button>

                <!-- Error Message -->
                <div id="stc-error" class="tw-hidden tw-flex tw-rounded-lg tw-mt-8 tw-p-5 tw-text-base tw-shadow-lg tw-transition-all tw-duration-200 tw-ease-in-out tw-bg-red-100 tw-text-red-600">
                    There was an error submitting this form. Please Try again or contact support <a class="tw-font-bold tw-ml-1" :href="`/${brand }/support`">here</a>.
                </div>
            </form>
        </section>

        <!-- Thank you Wrapper -->
        <section id="stc-confirmation" class="tw-hidden tw-max-w-md tw-mx-auto">
            <div class="tw-text-center tw-my-8">
                <h2 class="tw-text-3xl tw-font-bold tw-mb-4">Thank You For Your Interest!</h2>
                <p>We have received your information and will be in touch
                    when the next User Study is scheduled.
                </p>
            </div>
        </section>
    </main>

    <ModalRenderer v-if="openLanguageModal">
        <div class="tw-w-full tw-h-full tw-font-medium tw-flex tw-flex-col">
            <header class="tw-flex tw-flex-col tw-justify-center tw-min-h-[90px] tw-px-5 tw-flex-shrink-0 tw-my-4">
                <div class="tw-text-white tw-font-semibold">Select Languages</div>
                <div class="tw-flex tw-flex-wrap tw-gap-2 tw-items-center tw-relative tw-mt-2">
                    <div v-for="language in selectedLanguages" class="tw-bg-[#FFAE00] tw-text-[#000C17] tw-rounded-full tw-py-[2px] tw-px-2 tw-font-semibold tw-flex tw-items-center">{{ language }} <span @click="selectLanguage(language)" class="tw-cursor-pointer tw-ml-1">x</span></div>
                </div>
            </header>
            <hr />
            <ul class="tw-flex-shrink tw-overflow-auto">
                <li v-for="language in languages" :class="`tw-text-lg tw-flex tw-justify-center tw-py-4 tw-cursor-pointer tw-font-semibold ${isLanguageSelected(language['value']) ? 'tw-text-white' : 'tw-text-[#80A0B9]'}`" @click="selectLanguage(language['value'])">{{ language['value'] }} <CheckIcon v-if="isLanguageSelected(language['value'])" class="tw-w-[20px] tw-ml-2 tw-text-white" /></li>
            </ul>
            <footer class="tw-font-bold tw-text-white tw-py-7 tw-flex tw-justify-center tw-items-center tw-text-lg tw-flex-shrink-0" @click="openLanguageModal = false">Done</footer>
        </div>
    </ModalRenderer>
</template>

<script setup>
import {computed, onMounted, onUnmounted, ref} from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../stores/user";
import ModalRenderer from "../components/Modal/ModalRenderer";

//icons
import { XIcon, CheckIcon } from '@heroicons/vue/outline';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    userId: {
        type: Number,
        default: 0,
    },
    authKey: {
        type: String,
        default: '',
    },
    ages: {
        type: Array,
        default: [],
    },
    genders: {
        type: Array,
        default: [],
    },
    countries: {
        type: Array,
        default: [],
    },
    languages: {
        type: Object,
        default: {},
    },
    levels: {
        type: Array,
        default: [],
    },
    instruments: {
        type: Array,
        default: [],
    },
    goals: {
        type: Array,
        default: [],
    },
    experience: {
        type: Array,
        default: [],
    },
    types: {
        type: Array,
        default: [],
    },
})

const instrumentInput = ref('');
const goalInput = ref('');
const openLanguageModal = ref(false);
const selectedLanguages = ref([]);
const languageInput = ref(null);
const consentBox = ref(false);

const languageContainerClick = () => {
    const screenSize = window.innerWidth;
    if(screenSize < 768) {
        languageInput.value.blur()
        openLanguageModal.value = true;
    }
}

const selectLanguage = (value) => {
    if(selectedLanguages.value.includes(value)){
        selectedLanguages.value = selectedLanguages.value.filter((lang) => lang !== value);
    } else {
        value && selectedLanguages.value.push(value);
    }
}

const resetSelectedLanguages = () => {
    selectedLanguages.value = [];
}

const screenDetect = () => {
    const screenSize = window.innerWidth;
    if(screenSize > 767) {
        openLanguageModal.value = false;
    }
}

const isLanguageSelected = (value) => {
    return selectedLanguages.value.includes(value);
}

const isCookieSet = () => {
    return document.cookie.split(';').some(c => c.trim().startsWith('stc_form_submitted='));
}

const submitForm = (event) => {
    const submitButton = document.querySelector('#submit-button');
    const formData = new FormData(event.target);
    const formID = '9e8885d4ad1545a';
    const formData2 = {
        data: {
            ...Object.fromEntries(formData),
            'student_form_languages[]': selectedLanguages.value,
        },
    };

    submitButton.innerHTML = `
    <div id="button-loading" class="tw-inline-flex">
        <svg class="tw-animate-spin tw--ml-1 tw-mr-3 tw-h-5 tw-w-5 dark:tw-text-black tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Processing...
    </div>`;

    fetch(`https://track.customer.io/api/v1/forms/${formID}/submit`, {
        method: 'POST',
        body:JSON.stringify(formData2),
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Basic ' + props.authKey,
        }
    })
    .then(data => {
        document.querySelector('#stc-form-wrapper').classList.add('tw-hidden');
        document.querySelector('#stc-confirmation').classList.remove('tw-hidden');
        //Set Cookie
        let date = new Date();
        date.setDate(date.getDate() + 1);
        let expires = date.toUTCString();
        document.cookie = `stc_form_submitted=true; expires=${expires}; path=/`;
    })
    .catch(error => {
        submitButton.innerHTML = 'Submit';
        document.querySelector('#stc-error').classList.remove('tw-hidden');
        console.error('Error:', error);
    });
}

onMounted(() => {
    if (isCookieSet()) {
        document.querySelector('#stc-form-wrapper').classList.add('tw-hidden');
        document.querySelector('#stc-confirmation').classList.remove('tw-hidden');
    }

    window.addEventListener('resize', screenDetect);
})

onUnmounted(() => {
    window.addEventListener('resize', screenDetect);
})
</script>
