@extends('partials.layout')

@section('meta')
    <title>Student Experience Studies | Musora</title>
@endsection

@section('content')
    <header class="tw-relative tw-bg-black tw-py-[40px] tw-px-8 2xl:tw-px-0 tw-min-h-[380px] tw-flex tw-items-center">
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
                class="tw-w-[300px] tw-h-[300px] tw-flex-shrink-0 sm:tw-mr-8 tw-mb-4 md:tw-mb-0 tw-transition-opacity tw-opacity-0"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            >
            <!-- Content -->
            <div class="">
                <h1 class="tw-text-3xl tw-mb-2 tw-text-[#9EC0DC] tw-font-semibold">Sign Up for Musora Student Experience Studies and get rewarded with free platform time</h1>
                <p class="tw-text-lg tw-text-white">Help us to test new student experiences and make our platforms even better.
                    Students selected to participate in studies will be rewarded with monthly passes.
                    Have questions? <a href="mailto:learning@musora.com" class="tw-font-bold tw-text-white">Get in touch.</a>
                </p>
            </div>
        </section>
    </header>
    <main class="tw-w-full tw-max-w-screen-md tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-10 dark:tw-text-white tw-transition-colors tw-flex tw-justify-center">
        {{-- Form Wrapper --}}
        <section id="stc-form-wrapper" class="tw-mb-12">
            <div class="tw-text-center tw-mb-4">
                <h2 class="tw-mb-1 tw-text-3xl tw-font-bold">Enrollment Questionnaire</h2>
                <p>Please fill our the enrollment questionaire to be considered for studies</p>
            </div>

            <form action="" method="post" class="tw-flex tw-flex-col" id="stc-form">
                {{-- Name --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Name</span>
                    <input required id="name" type="text" name="name" autocomplete="name" class="tw-bg-transparent tw-rounded-full"/>
                </label>

                {{-- Email --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Email</span>
                    <input required id="email" type="email" name="email" autocomplete="email"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                {{-- Age --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Age</span>
                    <select required name="age" id="age" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($ages as $age)
                            <option class="bg-white text-black" value="{{ $age['value'] }}">{{ $age['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Gender --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Gender</span>
                    <select required name="gender" id="gender" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($genders as $gender)
                            <option class="bg-white text-black" value="{{ $gender['value'] }}">{{ $gender['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Country --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Country</span>
                    <select required name="country" id="country" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($countries as $country)
                            <option class="bg-white text-black" value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Languages: Multi-select --}}
                <label class="tw-flex tw-flex-col tw-mb-2 tw-relative">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Spoken Languages<span>*</span></span>
                    <div class="tw-relative tw-w-full">
                        <input required 
                                readonly
                                id="language" 
                                type="text" 
                                name="language" 
                                autocomplete="language" 
                                placeholder="Select" 
                                class="tw-w-full dark:placeholder:tw-text-white placeholder:tw-text-black tw-bg-transparent tw-rounded-full tw-cursor-pointer tw-pr-8"
                        />
                        <i class="tw-absolute tw-right-[14px] tw-top-[14px] tw-text-2xl tw-text-[#6b7280]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-4 tw-h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>                              
                        </i>
                    </div>
                    <select multiple name="languages[]" id="languages" class="tw-p-0 tw-absolute tw-w-full tw-top-full tw-hidden tw-h-[400px]">
                        @foreach ($languages as $code => $name)
                            <option class="bg-white text-black" value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Student Level --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Current Student Level</span>
                    <select required name="level" id="level" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($levels as $level)
                            <option class="bg-white text-black" value="{{ $level['value'] }}">{{ $level['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Instrument --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Instrument</span>
                    <select required name="instruments" id="instruments" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($instruments as $instrument)
                            <option class="bg-white text-black" value="{{ $instrument['value'] }}">{{ $instrument['value'] }}</option>
                        @endforeach
                    </select>
                </label>
                {{-- If Other: remove tw-hidden --}}
                <label id="other-instrument" class="tw-flex tw-flex-col tw-ml-4 tw-mb-2 tw-hidden">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Your Instrument</span>
                    <input required id="instrument" type="text" name="instrument" autocomplete="instrument"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                {{-- Learning Goal --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Learning Goal</span>
                    <select required name="goals" id="goals" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($goals as $goal)
                            <option class="bg-white text-black" value="{{ $goal['value'] }}">{{ $goal['value'] }}</option>
                        @endforeach
                    </select>
                </label>
                {{-- If Other: remove tw-hidden --}}
                <label id="other-goal" class="tw-flex tw-flex-col tw-ml-4 tw-mb-2 tw-hidden">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Your Goal</span>
                    <input required id="goal" type="text" name="goal" autocomplete="goal"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                {{-- Student Length --}}
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">For how long have you been a Musora student?</span>
                    <select required name="student-length" id="student-length" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($experience as $year)
                            <option class="bg-white text-black" value="{{ $year['value'] }}">{{ $year['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Membership Type --}}
                <label class="tw-flex tw-flex-col tw-mb-6">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Membership Type</span>
                    <select required name="type" id="type" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($types as $type)
                            <option class="bg-white text-black" value="{{ $type['value'] }}">{{ $type['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                {{-- Note on Languages --}}
                <small class="tw-text-sm tw-mb-2">
                    *Please select all languages in which you have a native or near-native proficiency 
                    <i title="Some studies may involve rating the quality of content translation or subtitles in other languages.">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-labelledby="info" version="1.1" width="36" height="35" viewBox="0 0 36 35" class="tw-inline-block tw-w-[20px] tw-h-[20px]"><use data-v-a55a9eb4="" xlink:href="#icon-info" x="0" y="0"></use></svg>
                    </i> 
                </small>

                {{-- Consent Message --}}
                <label class="tw-mb-6">
                    <input class="tw-mr-2 tw-rounded dark:tw-border-[#445F74] tw-border-[#D1D5DB] checked:tw-bg-black dark:checked:tw-bg-[#002039] dark:tw-bg-[#002039] tw-bg-[#E7EFF6]" 
                            type="checkbox" 
                            id="consent" 
                            name="consent"
                    >
                    <span class="tw-text-sm">I consent to be occasionally contacted to participate in User Research Studies or interviews dedicated to
                        collecting feedback or improving Musora products and services. 
                    </span>
                </label>

                <button disabled 
                        type="submit"
                        id="submit-button"
                        class="md:tw-ml-auto disabled:tw-opacity-70 tw-transition-all tw-btn tw-btn-primary dark:tw-bg-white dark:tw-text-black tw-bg-black tw-text-white"   
                >
                    {{-- If Submitting Form --}}
                    <div id="button-loading" class="tw-hidden tw-inline-flex">
                        <svg class="tw-animate-spin tw--ml-1 tw-mr-3 tw-h-5 tw-w-5 dark:tw-text-black tw-text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </div>    
                    {{-- Else --}}
                    <span>Submit<span>
                </button>
            </form>

        </section>
        
        {{-- Thank you Wrapper --}}
        <section id="stc-confirmation" class="tw-hidden">
            <div class="tw-text-center tw-mb-4">
                <h2 class="tw-mb-1 tw-text-3xl tw-font-bold">Thank You For Your Interest!</h2>
                <p>We have received your information and will be in touch <br>
                    when the next User Study is scheduled.
                <p>
            </div>
        </section>
    </main>
@endsection

{{-- Vanilla JS --}}
@section('inject-components')
    <script>
        //Dom Elements
        const form = document.querySelector('#stc-form');
        const consentBox = document.querySelector('#consent');
        const submitButton = document.querySelector('#submit-button');
        const instrumentSelect = document.querySelector('#instruments');
        const instrumentInput = document.querySelector('#other-instrument');
        const goalSelect = document.querySelector('#goals');
        const goalInput = document.querySelector('#other-goal');
        const languageInput = document.querySelector('#language');
        const languageSelect = document.querySelector('#languages')

        //Event Listeners
        instrumentSelect.addEventListener('change', (e)=> {
            if(e.target.value === 'Other') {
                instrumentInput.classList.remove('tw-hidden');
            } else {
                instrumentInput.classList.add('tw-hidden');
            }
        })
        goalSelect.addEventListener('change', (e)=> {
            if(e.target.value === 'Other') {
                goalInput.classList.remove('tw-hidden');
            } else {
                goalInput.classList.add('tw-hidden');
            }
        })
        consentBox.addEventListener('change', ()=> {
            submitButton.disabled = !submitButton.disabled;
        });
        languageInput.addEventListener('click', ()=> {
            languageSelect.classList.toggle('tw-hidden');
            languageSelect.focus();
        })
        languageSelect.addEventListener('change', function() {
            let selectedLanguages = Array.from(this.options) // Access all options
                .filter(option => option.selected) // Filter only selected options
                .map(option => option.value); // Map to their values
            languageInput.value = selectedLanguages.join(', ');
        })
        //Clicked outside of the language select?
        document.addEventListener('click', function(e) {
            if(!languageSelect.contains(e.target) && !languageInput.contains(e.target)) languageSelect.classList.add('tw-hidden');
        });

        //Methods
    </script>
@endsection