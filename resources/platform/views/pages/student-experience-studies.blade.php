@extends('partials.layout')

@section('meta')
    <title>Student Experience Studies | Musora</title>
@endsection

@section('content')
    <Stc
        :user-email="{{ json_encode(user()->email) }}"
        :auth-key="'{{ base64_encode(config('customer-io.accounts.musora.site_id') . ':' . config('customer-io.accounts.musora.track_api_key')) }}'"
        :ages="{{ json_encode($ages) }}"
        :genders="{{ json_encode($genders) }}"
        :countries="{{ json_encode($countries) }}"
        :languages="{{ json_encode($languages) }}"
        :levels="{{ json_encode($levels) }}"
        :instruments="{{ json_encode($instruments) }}"
        :goals="{{ json_encode($goals) }}"
        :experience="{{ json_encode($experience) }}"
        :types="{{ json_encode($types) }}"
    ></Stc>
{{--    <header class="tw-relative tw-bg-black tw-py-[40px] tw-px-8 2xl:tw-px-0 tw-min-h-[360px] tw-flex tw-items-center">--}}
{{--        <!-- BG Image -->--}}
{{--        <img src="https://www.musora.com/musora-cdn/image/width=1000/https://musora-web-platform.s3.amazonaws.com/stc/SupportHeader.png"--}}
{{--            class="tw-transition-opacity tw-absolute tw-top-0 tw-left-0 tw-object-cover tw-object-top tw-h-full tw-w-full"--}}
{{--            loading="lazy"--}}
{{--            onload="this.classList.remove('tw-opacity-0')"--}}
{{--        >--}}
{{--        <section class="tw-z-10 tw-max-w-screen-lg tw-w-full tw-mx-auto tw-flex tw-flex-col md:tw-flex-row tw-items-center">--}}
{{--            <!-- Instrument Image -->--}}
{{--            <img src="https://www.musora.com/musora-cdn/image/width=300/https://musora-web-platform.s3.amazonaws.com/stc/instruments.png"--}}
{{--                title="Image of musical instruments"--}}
{{--                class="tw-w-[250px] tw-h-[250px] tw-flex-shrink-0 sm:tw-mr-8 tw-mb-4 md:tw-mb-0 tw-transition-opacity tw-opacity-0"--}}
{{--                loading="lazy"--}}
{{--                onload="this.classList.remove('tw-opacity-0')"--}}
{{--            >--}}
{{--            <!-- Content -->--}}
{{--            <div class="">--}}
{{--                <h1 class="tw-text-3xl tw-mb-4 tw-text-[#9EC0DC] tw-font-semibold">--}}
{{--                    Sign Up for Musora Student Experience Studies and get rewarded with free platform time--}}
{{--                </h1>--}}
{{--                <p class="tw-text-lg tw-text-white">Help us to test new student experiences and make our platforms even better.--}}
{{--                    Students selected to participate in studies will be rewarded with monthly passes.--}}
{{--                    Have questions? <a href="mailto:learning@musora.com" class="tw-font-bold tw-text-white">Get in touch.</a>--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </header>--}}
{{--    <main class="tw-w-full tw-max-w-screen-md tw-mx-auto tw-px-4 md:tw-px-8 tw-my-10 dark:tw-text-white tw-transition-colors tw-flex tw-justify-center">--}}
{{--        --}}{{-- Form Wrapper --}}
{{--        <section id="stc-form-wrapper" class="tw-mb-12 tw-w-full">--}}
{{--            <div class="tw-text-center tw-mb-4">--}}
{{--                <h2 class="tw-mb-1 tw-text-2xl md:tw-text-3xl tw-font-bold">Enrollment Questionnaire</h2>--}}
{{--                <p>Please fill out the enrollment questionaire to be considered for studies</p>--}}
{{--            </div>--}}

{{--            <form id="stc-form" method="POST" class="tw-flex tw-flex-col">--}}
{{--                <input id="id" type="hidden" name="id" value="{{ user()->id }}"/>--}}
{{--                --}}{{-- Name --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Name</span>--}}
{{--                    <input required id="student_form_name" type="text" name="student_form_name" autocomplete="name" class="tw-bg-transparent tw-rounded-full"/>--}}
{{--                </label>--}}

{{--                --}}{{-- Email --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Email</span>--}}
{{--                    <input required id="student_form_email" type="email" name="student_form_email" autocomplete="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" class="tw-bg-transparent tw-rounded-full"/>--}}
{{--                </label>--}}

{{--                --}}{{-- Age --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Age</span>--}}
{{--                    <select required name="student_form_age" id="student_form_age" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($ages as $age)--}}
{{--                            <option class="bg-white text-black" value="{{ $age['value'] }}">{{ $age['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Gender --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Gender</span>--}}
{{--                    <select required name="student_form_gender" id="student_form_gender" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($genders as $gender)--}}
{{--                            <option class="bg-white text-black" value="{{ $gender['value'] }}">{{ $gender['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Country --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Country</span>--}}
{{--                    <select required name="student_form_country" id="student_form_country" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($countries as $country)--}}
{{--                            <option class="bg-white text-black" value="{{ $country }}">{{ $country }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Languages: Multi-select --}}
{{--                <label id="multiSelect" class="tw-flex tw-flex-col tw-mb-2 tw-relative">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Spoken Languages<span>*</span></span>--}}
{{--                    <div class="tw-relative tw-w-full">--}}
{{--                        <input required--}}
{{--                                id="student_form_language"--}}
{{--                                type="text"--}}
{{--                                name="student_form_language"--}}
{{--                                autocomplete="language"--}}
{{--                                placeholder="Select"--}}
{{--                                class="tw-w-full tw-pointer-events-none dark:placeholder:tw-text-white placeholder:tw-text-black tw-bg-transparent tw-rounded-full tw-cursor-pointer tw-pr-16"--}}
{{--                        />--}}
{{--                        <i id="clear-multi-select" class="tw-z-10 tw-absolute tw-right-10 tw-top-[14px] tw-text-2xl tw-text-[#6b7280] tw-hidden">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-4 tw-h-4">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />--}}
{{--                            </svg>--}}
{{--                        </i>--}}
{{--                        <i class="tw-z-0 tw-absolute tw-right-[14px] tw-top-[14px] tw-text-2xl tw-text-[#6b7280]">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-4 tw-h-4">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />--}}
{{--                            </svg>--}}
{{--                        </i>--}}
{{--                    </div>--}}
{{--                    <select multiple name="student_form_languages[]" id="student_form_languages" class="tw-p-0 tw-absolute tw-w-full tw-top-full tw-border-0 tw-h-0 focus:tw-border focus:tw-h-[400px] ">--}}
{{--                        @foreach ($languages as $code => $name)--}}
{{--                            <option class="bg-white text-black" value="{{ $name }}">{{ $name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    <small class="tw-text-xs tw-m-2 dark:tw-text-[#9EC0DC] tw-text-[#3F3F46]">On a keyboard. Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</small>--}}
{{--                </label>--}}

{{--                --}}{{-- Student Level --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Current Student Level</span>--}}
{{--                    <select required name="student_form_level" id="student_form_level" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($levels as $level)--}}
{{--                            <option class="bg-white text-black" value="{{ $level['value'] }}">{{ $level['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Instrument --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Instrument</span>--}}
{{--                    <select required name="student_form_instruments" id="student_form_instruments" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($instruments as $instrument)--}}
{{--                            <option class="bg-white text-black" value="{{ $instrument['value'] }}">{{ $instrument['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Learning Goal --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Learning Goal</span>--}}
{{--                    <select required name="student_form_goals" id="student_form_goals" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($goals as $goal)--}}
{{--                            <option class="bg-white text-black" value="{{ $goal['value'] }}">{{ $goal['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Student Length --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-2">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">For how long have you been a Musora student?</span>--}}
{{--                    <select required name="student_form_student-length" id="student_form_student-length" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($experience as $year)--}}
{{--                            <option class="bg-white text-black" value="{{ $year['value'] }}">{{ $year['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Membership Type --}}
{{--                <label class="tw-flex tw-flex-col tw-mb-6">--}}
{{--                    <span class="tw-m-2 tw-font-bold tw-leading-0">Membership Type</span>--}}
{{--                    <select required name="student_form_type" id="student_form_type" class="tw-bg-transparent tw-rounded-full">--}}
{{--                        <option value="" class="bg-white text-black">Select</option>--}}
{{--                        @foreach($types as $type)--}}
{{--                            <option class="bg-white text-black" value="{{ $type['value'] }}">{{ $type['value'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </label>--}}

{{--                --}}{{-- Note on Languages --}}
{{--                <small class="tw-text-sm tw-mb-2">--}}
{{--                    *Please select all languages in which you have a native or near-native proficiency--}}
{{--                    <i tabindex="0"  aria-describedby="stc_tooltip" class="tw-relative tw-group tw-cursor-pointer">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" aria-labelledby="info" version="1.1" width="36" height="35" viewBox="0 0 36 35" class="tw-inline-block tw-w-[20px] tw-h-[20px] group-focus:tw-text-drumeo"><use data-v-a55a9eb4="" xlink:href="#icon-info" x="0" y="0"></use></svg>--}}
{{--                        --}}{{-- Tooltlip --}}
{{--                        <div role="tooltip" id="stc_tooltip" class="group-focus:tw-block tw-hidden tw-w-[250px] tw-p-1 tw-rounded tw-text-xs tw-text-black tw-bg-white tw-border tw-border-gray-500 tw-shadow tw-absolute tw-right-0 tw-bottom-full tw-z-10">--}}
{{--                            Some studies may involve rating the quality of content translation or subtitles in other languages.--}}
{{--                        </div>--}}
{{--                    </i>--}}
{{--                </small>--}}

{{--                --}}{{-- Consent Message --}}
{{--                <label class="tw-mb-6">--}}
{{--                    <input class="tw-mr-2 tw-rounded dark:tw-border-[#445F74] tw-border-[#D1D5DB] checked:tw-bg-black dark:checked:tw-bg-[#002039] dark:tw-bg-[#002039] tw-bg-[#E7EFF6]"--}}
{{--                            type="checkbox"--}}
{{--                            id="student_form_consent"--}}
{{--                            name="student_form_consent"--}}
{{--                    >--}}
{{--                    <span class="tw-text-sm">I consent to be occasionally contacted to participate in User Research Studies or interviews dedicated to--}}
{{--                        collecting feedback or improving Musora products and services.--}}
{{--                    </span>--}}
{{--                </label>--}}

{{--                <button disabled--}}
{{--                        type="submit"--}}
{{--                        id="submit-button"--}}
{{--                        class="md:tw-ml-auto disabled:tw-opacity-70 tw-transition-all tw-btn tw-btn-primary dark:tw-bg-white dark:tw-text-black tw-bg-black tw-text-white"--}}
{{--                >--}}
{{--                    Submit--}}
{{--                </button>--}}

{{--                --}}{{-- Error Message --}}
{{--                <div id="stc-error" class="tw-hidden tw-flex tw-rounded-lg tw-mt-8 tw-p-5 tw-text-base tw-shadow-lg tw-transition-all tw-duration-200 tw-ease-in-out tw-bg-red-100 tw-text-red-600">--}}
{{--                    There was an error submitting this form. Please Try again or contact support <a class="tw-font-bold tw-ml-1" href="/{{ $brand }}/support">here</a>.--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </section>--}}

{{--        --}}{{-- Thank you Wrapper --}}
{{--        <section id="stc-confirmation" class="tw-hidden tw-max-w-md tw-mx-auto">--}}
{{--            <div class="tw-text-center tw-my-8">--}}
{{--                <h2 class="tw-text-3xl tw-font-bold tw-mb-4">Thank You For Your Interest!</h2>--}}
{{--                <p>We have received your information and will be in touch--}}
{{--                    when the next User Study is scheduled.--}}
{{--                <p>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </main>--}}
@endsection

{{-- Vanilla JS --}}
@section('inject-components')
{{--    <script>--}}
{{--        (function(){--}}
{{--            //Dom Elements--}}
{{--            const form = document.querySelector('#stc-form');--}}
{{--            const consentBox = document.querySelector('#student_form_consent');--}}
{{--            const submitButton = document.querySelector('#submit-button');--}}
{{--            const instrumentSelect = document.querySelector('#student_form_instruments');--}}
{{--            const goalSelect = document.querySelector('#student_form_goals');--}}
{{--            //MultiSelect--}}
{{--            const multiSelect = document.querySelector('#multiSelect');--}}
{{--            const languageInput = document.querySelector('#student_form_language');--}}
{{--            const languageSelect = document.querySelector('#student_form_languages');--}}
{{--            const clearLanguagesButton = document.querySelector('#clear-multi-select');--}}
{{--            const name = document.querySelector('#student_form_name');--}}
{{--            let MSOpen = false;--}}
{{--            //On Load--}}
{{--            if (isCookieSet('stc_form_submitted')) {--}}
{{--                document.querySelector('#stc-form-wrapper').classList.add('tw-hidden');--}}
{{--                document.querySelector('#stc-confirmation').classList.remove('tw-hidden');--}}
{{--            }--}}
{{--            //Event Listeners--}}
{{--            instrumentSelect.addEventListener('change', (e)=> {--}}
{{--                if(e.target.value === 'Other') {--}}
{{--                    e.target.insertAdjacentHTML('afterend', inputHTML('instrument'))--}}
{{--                } else {--}}
{{--                    document.getElementById('student_form_other-instrument')?.remove()--}}
{{--                }--}}
{{--            })--}}
{{--            goalSelect.addEventListener('change', (e)=> {--}}
{{--                if(e.target.value === 'Other') {--}}
{{--                    e.target.insertAdjacentHTML('afterend', inputHTML('goal'))--}}
{{--                } else {--}}
{{--                    document.getElementById('student_form_other-goal')?.remove()--}}
{{--                }--}}
{{--            })--}}
{{--            consentBox.addEventListener('change', ()=> submitButton.disabled = !submitButton.disabled);--}}
{{--            //Multi Select.....--}}
{{--            languageInput.addEventListener('focus', (e)=> {--}}
{{--                if(!MSOpen) {--}}
{{--                    MSOpen = true;--}}
{{--                    setTimeout(() => {--}}
{{--                        languageSelect.focus();--}}
{{--                    }, 0);--}}
{{--                } else {--}}
{{--                    MSOpen = false;--}}
{{--                    e.target.blur();--}}
{{--                    languageSelect.blur();--}}
{{--                }--}}
{{--            });--}}
{{--            document.addEventListener('click', e=> {--}}
{{--                if(!multiSelect.contains(e.target)) {--}}
{{--                    languageSelect.blur();--}}
{{--                    MSOpen = false;--}}
{{--                }--}}
{{--            });--}}
{{--            languageSelect.addEventListener('change', function() {--}}
{{--                let selectedLanguages = Array.from(this.options) // Access all options--}}
{{--                    .filter(option => option.selected) // Filter only selected options--}}
{{--                    .map(option => option.value); // Map to their values--}}
{{--                languageInput.value = selectedLanguages.join(', ');--}}
{{--                if(languageInput.value !== "") clearLanguagesButton.classList.remove('tw-hidden');--}}
{{--            })--}}
{{--            clearLanguagesButton.addEventListener('click', function(e) {--}}
{{--                languageInput.value = "";--}}
{{--                languageSelect.value = "";--}}
{{--            })--}}
{{--            //Functions--}}
{{--            function inputHTML(name) {--}}
{{--                return `--}}
{{--                    <label id="student_form_other-${name}" class="tw-flex tw-flex-col tw-ml-4 tw-mb-2">--}}
{{--                        <span class="tw-m-2 tw-font-bold tw-leading-0 tw-capitalize">Your ${name === 'goal' ? 'Learning Goal' : name}</span>--}}
{{--                        <input required id="student_form_${name}" type="text" name="student_form_${name}" autocomplete="student_form_${name}"  class="tw-bg-transparent tw-rounded-full"/>--}}
{{--                    </label>`;--}}
{{--            };--}}
{{--            function isCookieSet(cookieName) {--}}
{{--                return document.cookie.split(';').some(c => c.trim().startsWith(cookieName + '='));--}}
{{--            }--}}
{{--            //Submit Form--}}
{{--            form.addEventListener('submit', function(e) {--}}
{{--                e.preventDefault();--}}
{{--                //loading--}}
{{--                submitButton.innerHTML = `--}}
{{--                    <div id="button-loading" class="tw-inline-flex">--}}
{{--                        <svg class="tw-animate-spin tw--ml-1 tw-mr-3 tw-h-5 tw-w-5 dark:tw-text-black tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
{{--                            <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>--}}
{{--                            <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                        </svg>--}}
{{--                        Processing...--}}
{{--                    </div>`;--}}
{{--                //send form--}}
{{--                const formData = new FormData(this);--}}
{{--                const formID = '9e8885d4ad1545a';--}}
{{--                const authKey = '{{ base64_encode(config('customer-io.accounts.musora.site_id') . ':' . config('customer-io.accounts.musora.track_api_key')) }}'--}}
{{--                const formData2 = {--}}
{{--                    data:Object.fromEntries(formData),--}}
{{--                };--}}
{{--                fetch(`https://track.customer.io/api/v1/forms/${formID}/submit`, {--}}
{{--                    method: 'POST',--}}
{{--                    body:JSON.stringify(formData2),--}}
{{--                    headers: {--}}
{{--                        'Accept': 'application/json',--}}
{{--                        'Authorization': 'Basic ' + authKey--}}
{{--                    }--}}
{{--                })--}}
{{--                .then(data => {--}}
{{--                    document.querySelector('#stc-form-wrapper').classList.add('tw-hidden');--}}
{{--                    document.querySelector('#stc-confirmation').classList.remove('tw-hidden');--}}
{{--                    //Set Cookie--}}
{{--                    let date = new Date();--}}
{{--                    date.setDate(date.getDate() + 1);--}}
{{--                    let expires = date.toUTCString();--}}
{{--                    document.cookie = `stc_form_submitted=true; expires=${expires}; path=/`;--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    submitButton.innerHTML = 'Submit';--}}
{{--                    document.querySelector('#stc-error').classList.remove('tw-hidden');--}}
{{--                    console.error('Error:', error);--}}
{{--                });--}}
{{--            });--}}
{{--        })();--}}
{{--    </script>--}}
@endsection
